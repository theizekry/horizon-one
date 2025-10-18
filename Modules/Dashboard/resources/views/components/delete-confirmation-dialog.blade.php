@props([
    'errorTitle'            => __('dashboard::dashboard.error'),
    'errorText'             => __('dashboard::dashboard.deletion-error-message'),
    'successTitle'          => __('dashboard::dashboard.deleted'),
    'successText'           => __('dashboard::dashboard.deleted-successfully'),
    'resourceCanBeRestored' => false
])

<script>
    class deleteConfirmationDialogClass {
        constructor() {
            this.configurations = this.getConfigurations();
        }

        showConfirmDialog(resource_id) {
            Swal.fire(this.configurations)
                .then((result) => {
                    if (!result.isConfirmed) return;

                    document.getElementById('delete-form-' + resource_id).submit();
                })
        }

        getConfigurations() {
            let configuration = {
                title: '{{ __('dashboard::dashboard.are_you_sure') }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fa fa-check"></i> {{ __('dashboard::dashboard.yes_delete_it') }}',
                cancelButtonText: '<i class="fa fa-times"></i> {{ __('dashboard::dashboard.no_cancel') }}',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary mx-2',
                    cancelButton: 'btn btn-danger mx-2',
                }
            };

            @unless($resourceCanBeRestored)
                configuration['text'] = "{{ __('dashboard::dashboard.deletion_alert_desc') }}"
            @endunless

            return configuration;
        }
    }

    const deleteConfirmationDialog = new deleteConfirmationDialogClass();

</script>
