<template>
  <div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            Horizon Pulse
          </h1>
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
              <a href="/dashboard" class="text-muted text-hover-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Horizon Pulse</li>
          </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
          <button @click="refreshAllMetrics" class="btn btn-sm fw-bold btn-primary" :disabled="loading">
            <i class="ki-duotone ki-arrows-circle fs-2"></i>
            {{ loading ? 'Refreshing...' : 'Refresh All' }}
          </button>
          <button @click="showAddProject = true" class="btn btn-sm fw-bold btn-success">
            <i class="ki-duotone ki-plus fs-2"></i>
            Add Project
          </button>
        </div>
      </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
      <div class="container-xxl" id="kt_content_container">
        
        <!--begin::Overview Cards-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
          <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
              <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                  <div class="d-flex align-items-center">
                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Total Projects</span>
                  </div>
                  <span class="text-gray-400 pt-1 fw-bold fs-6">{{ projects.length }}</span>
                </div>
              </div>
              <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                  <div class="symbol symbol-50px me-5">
                    <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                      <i class="ki-duotone ki-server fs-2x text-primary"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Active:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ activeProjects }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Inactive:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ inactiveProjects }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
              <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                  <div class="d-flex align-items-center">
                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Failed Jobs</span>
                  </div>
                  <span class="text-gray-400 pt-1 fw-bold fs-6">{{ totalFailedJobs }}</span>
                </div>
              </div>
              <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                  <div class="symbol symbol-50px me-5">
                    <div class="symbol-label fs-2 fw-semibold text-danger bg-light-danger">
                      <i class="ki-duotone ki-cross-circle fs-2x text-danger"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Critical:</span>
                      <span class="fs-6 fw-bold text-danger">{{ criticalFailedJobs }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Warning:</span>
                      <span class="fs-6 fw-bold text-warning">{{ warningFailedJobs }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
              <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                  <div class="d-flex align-items-center">
                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Throughput</span>
                  </div>
                  <span class="text-gray-400 pt-1 fw-bold fs-6">{{ averageThroughput }}</span>
                </div>
              </div>
              <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                  <div class="symbol symbol-50px me-5">
                    <div class="symbol-label fs-2 fw-semibold text-success bg-light-success">
                      <i class="ki-duotone ki-chart-simple fs-2x text-success"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Peak:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ peakThroughput }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Jobs/min</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
              <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                  <div class="d-flex align-items-center">
                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Memory Usage</span>
                  </div>
                  <span class="text-gray-400 pt-1 fw-bold fs-6">{{ averageMemoryUsage }}</span>
                </div>
              </div>
              <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                  <div class="symbol symbol-50px me-5">
                    <div class="symbol-label fs-2 fw-semibold text-info bg-light-info">
                      <i class="ki-duotone ki-memory fs-2x text-info"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Peak:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ peakMemoryUsage }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">MB</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end::Overview Cards-->

        <!--begin::Projects Grid-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10" v-if="projects.length > 0">
          <div class="col-md-6 col-lg-4 col-xl-3 col-xxl-3 mb-md-5 mb-xl-10" v-for="project in projects" :key="project.id">
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
              <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                  <div class="d-flex align-items-center">
                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">{{ project.name }}</span>
                  </div>
                  <span class="text-gray-400 pt-1 fw-bold fs-6">{{ project.environment }}</span>
                </div>
              </div>
              <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                  <div class="symbol symbol-50px me-5">
                    <div class="symbol-label fs-2 fw-semibold" :class="getStatusColor(project.status)">
                      <i :class="[getStatusIcon(project.status), getStatusTextColor(project.status)]"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Status:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ project.status.charAt(0).toUpperCase() + project.status.slice(1) }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row mb-2">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Failed Jobs:</span>
                      <span class="fs-6 fw-bold" :class="project.failed_jobs?.count > 0 ? 'text-danger' : 'text-success'">{{ project.failed_jobs?.count || 0 }}</span>
                    </div>
                  </div>
                  <div class="d-flex fw-semibold align-items-center flex-lg-row">
                    <div class="d-flex align-items-center">
                      <span class="fs-6 fw-bold text-gray-500 me-2">Last Updated:</span>
                      <span class="fs-6 fw-bold text-gray-800">{{ formatTime(project.last_updated) }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer pt-0">
                <div class="d-flex flex-stack">
                  <button @click="testConnection(project)" class="btn btn-sm btn-light-primary" :disabled="testingConnection === project.id">
                    <i class="ki-duotone ki-wifi fs-2"></i>
                    {{ testingConnection === project.id ? 'Testing...' : 'Test Connection' }}
                  </button>
                  <div class="d-flex align-items-center">
                    <span class="badge" :class="getStatusBadgeClass(project.status)">
                      {{ getStatusText(project.status) }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end::Projects Grid-->

        <!--begin::Empty State-->
        <div v-else class="row g-5 g-xl-10 mb-5 mb-xl-10">
          <div class="col-12">
            <div class="card card-flush">
              <div class="card-body text-center py-10">
                <div class="mb-5">
                  <i class="ki-duotone ki-folder-up fs-3x text-gray-400"></i>
                </div>
                <h3 class="text-gray-600 mb-5">No Projects Found</h3>
                <p class="text-gray-500 mb-5">No projects are configured yet. Add your first project to start monitoring Horizon.</p>
                <button @click="showAddProject = true" class="btn btn-primary">
                  <i class="ki-duotone ki-plus fs-2"></i>Add Your First Project
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--end::Empty State-->

      </div>
    </div>
    <!--end::Content-->

    <!--begin::Add Project Modal-->
    <div v-if="showAddProject" class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Project</h5>
            <button @click="showAddProject = false" type="button" class="btn-close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="addProject">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Project Name</label>
                  <input v-model="newProject.name" type="text" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Environment</label>
                  <select v-model="newProject.environment" class="form-select" required>
                    <option value="local">Local</option>
                    <option value="staging">Staging</option>
                    <option value="production">Production</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Redis Host</label>
                  <input v-model="newProject.redis_host" type="text" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Redis Port</label>
                  <input v-model="newProject.redis_port" type="number" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Redis Password</label>
                  <input v-model="newProject.redis_password" type="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Redis Database</label>
                  <input v-model="newProject.redis_db" type="number" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="form-label">Horizon Prefix</label>
                  <input v-model="newProject.horizon_prefix" type="text" class="form-control" placeholder="horizon">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button @click="showAddProject = false" type="button" class="btn btn-secondary">Cancel</button>
            <button @click="addProject" type="button" class="btn btn-primary" :disabled="addingProject">
              {{ addingProject ? 'Adding...' : 'Add Project' }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--end::Add Project Modal-->

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

// Reactive data
const projects = ref([])
const loading = ref(false)
const testingConnection = ref(null)
const showAddProject = ref(false)
const addingProject = ref(false)
const refreshInterval = ref(null)

const newProject = ref({
  name: '',
  environment: 'local',
  redis_host: '',
  redis_port: 6379,
  redis_password: '',
  redis_db: 0,
  horizon_prefix: 'horizon'
})

// Computed properties
const activeProjects = computed(() => projects.value.filter(p => p.status === 'active').length)
const inactiveProjects = computed(() => projects.value.filter(p => p.status !== 'active').length)
const totalFailedJobs = computed(() => projects.value.reduce((sum, p) => sum + (p.failed_jobs?.count || 0), 0))
const criticalFailedJobs = computed(() => projects.value.filter(p => (p.failed_jobs?.count || 0) > 10).length)
const warningFailedJobs = computed(() => projects.value.filter(p => (p.failed_jobs?.count || 0) > 0 && (p.failed_jobs?.count || 0) <= 10).length)
const averageThroughput = computed(() => {
  const total = projects.value.reduce((sum, p) => {
    const throughput = p.measures?.throughput || '0/min'
    return sum + parseInt(throughput.split('/')[0]) || 0
  }, 0)
  return projects.value.length > 0 ? Math.round(total / projects.value.length) + '/min' : '0/min'
})
const peakThroughput = computed(() => {
  const max = Math.max(...projects.value.map(p => {
    const throughput = p.measures?.throughput || '0/min'
    return parseInt(throughput.split('/')[0]) || 0
  }))
  return max + '/min'
})
const averageMemoryUsage = computed(() => {
  const total = projects.value.reduce((sum, p) => {
    const memory = p.measures?.memory_usage || '0MB'
    return sum + parseInt(memory.replace('MB', '')) || 0
  }, 0)
  return projects.value.length > 0 ? Math.round(total / projects.value.length) + 'MB' : '0MB'
})
const peakMemoryUsage = computed(() => {
  const max = Math.max(...projects.value.map(p => {
    const memory = p.measures?.memory_usage || '0MB'
    return parseInt(memory.replace('MB', '')) || 0
  }))
  return max + 'MB'
})

// Methods
const loadProjects = async () => {
  try {
    loading.value = true
    const response = await fetch('/dashboard/test-metrics')
    const data = await response.json()
    projects.value = data
  } catch (error) {
    console.error('Error loading projects:', error)
  } finally {
    loading.value = false
  }
}

const refreshAllMetrics = async () => {
  await loadProjects()
}

const testConnection = async (project) => {
  testingConnection.value = project.id
  try {
    const response = await fetch(`/dashboard/projects/${project.id}/test-connection`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    const result = await response.json()
    
    if (result.success) {
      // Show success message
      console.log('Connection test successful:', result.message)
    } else {
      // Show error message
      console.error('Connection test failed:', result.message)
    }
  } catch (error) {
    console.error('Error testing connection:', error)
  } finally {
    testingConnection.value = null
  }
}

const addProject = async () => {
  try {
    addingProject.value = true
    const response = await fetch('/dashboard/projects', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify(newProject.value)
    })
    
    if (response.ok) {
      showAddProject.value = false
      newProject.value = {
        name: '',
        environment: 'local',
        redis_host: '',
        redis_port: 6379,
        redis_password: '',
        redis_db: 0,
        horizon_prefix: 'horizon'
      }
      await loadProjects()
    }
  } catch (error) {
    console.error('Error adding project:', error)
  } finally {
    addingProject.value = false
  }
}

const getStatusColor = (status) => {
  switch(status) {
    case 'active': return 'text-success bg-light-success'
    case 'warning': return 'text-warning bg-light-warning'
    case 'inactive': return 'text-gray bg-light-gray'
    default: return 'text-danger bg-light-danger'
  }
}

const getStatusIcon = (status) => {
  switch(status) {
    case 'active': return 'ki-duotone ki-check fs-2x text-success'
    case 'warning': return 'ki-duotone ki-warning fs-2x text-warning'
    case 'inactive': return 'ki-duotone ki-pause fs-2x text-gray'
    default: return 'ki-duotone ki-cross-circle fs-2x text-danger'
  }
}

const getStatusTextColor = (status) => {
  switch(status) {
    case 'active': return 'text-success'
    case 'warning': return 'text-warning'
    case 'inactive': return 'text-gray'
    default: return 'text-danger'
  }
}

const getStatusBadgeClass = (status) => {
  switch(status) {
    case 'active': return 'badge-light-success'
    case 'warning': return 'badge-light-warning'
    case 'inactive': return 'badge-light-gray'
    default: return 'badge-light-danger'
  }
}

const getStatusText = (status) => {
  switch(status) {
    case 'active': return 'Healthy'
    case 'warning': return 'Warning'
    case 'inactive': return 'Inactive'
    default: return 'Error'
  }
}

const formatTime = (timestamp) => {
  return new Date(timestamp).toLocaleTimeString()
}

// Lifecycle
onMounted(() => {
  loadProjects()
  // Set up auto-refresh every 30 seconds
  refreshInterval.value = setInterval(loadProjects, 30000)
})

onUnmounted(() => {
  if (refreshInterval.value) {
    clearInterval(refreshInterval.value)
  }
})
</script>
