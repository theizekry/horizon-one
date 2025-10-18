<form id="logout-admin-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div class="menu-item">
    <a class="menu-link" href="#" onclick="logoutAdmin()">
        <span class="menu-icon">
             <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
             </span>
        </span>
        <span class="menu-title">{{ __('dashboard::dashboard.sign-out') }}</span>
    </a>
</div>

<script>

    function logoutAdmin() {

        let configurations = {
            title: '{{ __('dashboard::dashboard.are_you_sure') }}',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-check-circle"></i> {{ __('dashboard::dashboard.yes_sign_out') }}',
            cancelButtonText: '<i class="fa fa-times"></i> {{ __('dashboard::dashboard.no_cancel') }}',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary mx-2',
                cancelButton: 'btn btn-danger mx-2',
            }
        };

        Swal.fire(configurations)
            .then((result) => {
                if (!result.isConfirmed) return;
                document.getElementById('logout-admin-form').submit();
            })
    }
</script>