<script>
    class ConfirmationDialogClass {
        constructor() {
            this.actionCannotBeRevert = true;

            this.configurations = this.getDefaultConfiguration();
        }

        getDefaultConfiguration() {

            let warningOfCannotRevertText =  this.actionCannotBeRevert === true ? "{{ __('dashboard::dashboard.deletion_alert_desc') }}" : '';

            return {
                title: '{{ __('dashboard::dashboard.are_you_sure') }}',
                icon: 'question',
                text: warningOfCannotRevertText,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fa fa-check"></i> {{ __('dashboard::dashboard.yes_delete_it') }}',
                cancelButtonText: '<i class="fa fa-times"></i> {{ __('dashboard::dashboard.no_cancel') }}',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary mx-2',
                    cancelButton: 'btn btn-danger mx-2',
                },
                actionCanBeRevert: true,
            };
        }

        showConfirmDialog(form_id)
        {
            // Form id => the form that you need to submit if the user decide to confirm his action.
            Swal.fire(this.configurations)
                .then((result) => {
                    if (!result.isConfirmed) return;

                    document.getElementById(form_id).submit();
                })
        }

        confirmWithCallback(callback)
        {
            Swal.fire(this.configurations)
                .then((result) => {
                    if (!result.isConfirmed) return;

                    // Invoke the callback function.
                    if (typeof callback === 'function') {
                        callback();
                    }
                })
        }

        fireSuccessAlert(title = null)
        {
            Swal.fire({
                iconHtml: '<img class="foo" src="{{ asset('general/images/thumb/success-tick.png') }}">',
                title: title ?? "{{ __('dashboard::dashboard.success_done') }}",
                showConfirmButton: false,
                timer: 1500
            })
        }

        fireErrorAlert(title = null)
        {
            Swal.fire({
                icon: 'error',
                title: title ?? "{{ __('dashboard::dashboard.something_went_wrong') }}",
                showConfirmButton: false,
                timer: 1500
            })
        }
    }

    const confirmationDialog = new ConfirmationDialogClass();
</script>
