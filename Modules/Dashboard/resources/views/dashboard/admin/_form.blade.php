<x-dashboard::dashboard.card icon='fas fa-users' title="{{ __('dashboard::dashboard.manage_admins') }}">

    <div class="grid grid-cols-12 gap-x-5">

        <x-dashboard::dashboard.forms.text-input
                name="name"
                label="{{__('dashboard::dashboard.name')}}"
                required
                icon='fa fa-user'
                cols='col-span-6'
        />

        <x-dashboard::dashboard.forms.text-input
                name='username'
                label="{{__('dashboard::dashboard.username')}}"
                required
                icon='fa fa-user'
                cols='col-span-6'
        />

        <x-dashboard::dashboard.forms.text-input
                name='phone_number'
                label="{{__('dashboard::dashboard.phone_number')}}"
                icon='fa fa-phone'
                cols='col-span-6'
                required
        />

        <x-dashboard::dashboard.forms.email-input
                name="email"
                label="{{__('dashboard::dashboard.email')}}"
                icon='fa fa-envelope'
                cols="col-span-6"
        />

        @if($action_type === 'add')
            <x-dashboard::dashboard.forms.password-input
                    name='password'
                    label="{{__('dashboard::dashboard.password')}}"
                    required
                    cols='col-span-6'
                    icon='fas fa-key'
                    showLeaveBlankNote="{{ $action_type == 'edit' }}"
            />

            <x-dashboard::dashboard.forms.password-input
                name='password_confirmation'
                label="{{__('dashboard::dashboard.password_confirmation')}}"
                required
                cols='col-span-6'
                icon='fas fa-key'
            />
        @endif
    </div>

    <!--begin::Actions-->
    <x-dashboard::dashboard.forms.form-actions/>
    <!--End::Actions-->

</x-dashboard::dashboard.card>