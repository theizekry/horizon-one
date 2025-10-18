@extends('dashboard::dashboard.layouts.master')

@section('content')

    <div class="row justify-content-between mb-10 scale-100">
        <x-dashboard::widgets.card
                class="bg-primary"
                count="{{ number_format($reportsCount) }}"
                label="{{ __('dashboard::dashboard.reports_count') }}"
                :isClickable='false'
        />

        <x-dashboard::widgets.card
                class="bg-green-500"
                count="{{ $adminsCount }}"
                label="{{ __('dashboard::dashboard.admins_count') }}"
                route="{{ route('dashboard.admins.index') }}"
                permissionsKey="admins"
        />

        <x-dashboard::widgets.card
                class="bg-info"
                count="{{ $clientsCount }}"
                label="{{ __('dashboard::dashboard.clients_count') }}"
                route="#"
                permissionsKey="customers"
        />
    </div>
@endsection