@extends('dashboard::dashboard.layouts.master')

@section('title', 'Horizon Pulse - Live Monitoring')

@section('breadcrumbs')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Horizon Pulse
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('dashboard.home') }}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Horizon Pulse</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')
<div id="horizon-pulse-dashboard">
    <horizon-pulse-dashboard></horizon-pulse-dashboard>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Vue app for Horizon Pulse
    const { createApp } = Vue;
    
    createApp({
        components: {
            HorizonPulseDashboard: {
                template: `@include('horizonpulse::components.horizon-pulse-dashboard')`,
                setup() {
                    // Vue 3 Composition API setup
                    const projects = Vue.ref([]);
                    const loading = Vue.ref(false);
                    const testingConnection = Vue.ref(null);
                    const showAddProject = Vue.ref(false);
                    const addingProject = Vue.ref(false);
                    const refreshInterval = Vue.ref(null);

                    const newProject = Vue.ref({
                        name: '',
                        environment: 'local',
                        redis_host: '',
                        redis_port: 6379,
                        redis_password: '',
                        redis_db: 0,
                        horizon_prefix: 'horizon'
                    });

                    // Computed properties
                    const activeProjects = Vue.computed(() => projects.value.filter(p => p.status === 'active').length);
                    const inactiveProjects = Vue.computed(() => projects.value.filter(p => p.status !== 'active').length);
                    const totalFailedJobs = Vue.computed(() => projects.value.reduce((sum, p) => sum + (p.failed_jobs?.count || 0), 0));

                    // Methods
                    const loadProjects = async () => {
                        try {
                            loading.value = true;
                            const response = await fetch('/horizon-pulse/metrics');
                            const data = await response.json();
                            projects.value = data;
                        } catch (error) {
                            console.error('Error loading projects:', error);
                        } finally {
                            loading.value = false;
                        }
                    };

                    const testConnection = async (project) => {
                        testingConnection.value = project.id;
                        try {
                            const response = await fetch(`/horizon-pulse/projects/${project.id}/test-connection`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });
                            const result = await response.json();
                            
                            if (result.success) {
                                // Show success toast
                                toastr.success('Connection test successful!');
                            } else {
                                // Show error toast
                                toastr.error('Connection test failed: ' + result.message);
                            }
                        } catch (error) {
                            console.error('Error testing connection:', error);
                            toastr.error('Connection test failed');
                        } finally {
                            testingConnection.value = null;
                        }
                    };

                    const addProject = async () => {
                        try {
                            addingProject.value = true;
                            const response = await fetch('/dashboard/projects', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify(newProject.value)
                            });
                            
                            if (response.ok) {
                                showAddProject.value = false;
                                newProject.value = {
                                    name: '',
                                    environment: 'local',
                                    redis_host: '',
                                    redis_port: 6379,
                                    redis_password: '',
                                    redis_db: 0,
                                    horizon_prefix: 'horizon'
                                };
                                await loadProjects();
                                toastr.success('Project added successfully!');
                            }
                        } catch (error) {
                            console.error('Error adding project:', error);
                            toastr.error('Failed to add project');
                        } finally {
                            addingProject.value = false;
                        }
                    };

                    // Lifecycle
                    Vue.onMounted(() => {
                        loadProjects();
                        // Set up auto-refresh every 30 seconds
                        refreshInterval.value = setInterval(loadProjects, 30000);
                    });

                    Vue.onUnmounted(() => {
                        if (refreshInterval.value) {
                            clearInterval(refreshInterval.value);
                        }
                    });

                    return {
                        projects,
                        loading,
                        testingConnection,
                        showAddProject,
                        addingProject,
                        newProject,
                        activeProjects,
                        inactiveProjects,
                        totalFailedJobs,
                        loadProjects,
                        testConnection,
                        addProject
                    };
                }
            }
        }
    }).mount('#horizon-pulse-dashboard');
</script>
@endpush
