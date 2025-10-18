@extends('dashboard::dashboard.layouts.master')

@section('title', __('dashboard::dashboard.manage_integrations'))

@section('breadcrumbs')

    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.manage_integrations') }}"
                route="{{ route('dashboard.integrations.index') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')
    <x-dashboard::dashboard.card icon='fas fa-users' title="{{ __('dashboard::dashboard.manage_integrations') }}" searchResults="{{ $integrations->total() }}">
        <div class='overflow-x-auto'>
            <div class='flex my-5 justify-content-between'>
                    <div class='justify-start'>
                        <a type='button' href='{{ route('dashboard.integrations.create') }}' class='justify-content-end bg-blue-500 text-white py-2 px-4 rounded'>
                            <i class='fas fa-plus mx-2 text-white'></i>
                            {{ __('dashboard::dashboard.add-new') }}
                        </a>
                    </div>
{{--                <x-dashboard::dashboard.forms.search route="dashboard.integrations.index" :data="$integrations"></x-dashboard::dashboard.forms.search>--}}
            </div>

            @if($integrations->isEmpty())
                <x-dashboard::dashboard.no-data-to-show />
            @else
                <table class='w-full table table-responsive'>
                    <thead>
                    <tr>
                        <th class='px-4 py-2 text-gray-600'>ID</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>Client Name</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>Status</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>Setup Progress</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>Created At</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($integrations as $integration)
                        <tr>
                            <td class='px-4 py-2'>{{ $integration->uuid }}</td>
                            <td class='px-4 py-2'>{{ $integration->name }}</td>
                            <td class='px-4 py-2'>{{ $integration->status }}</td>
                            <td class='px-4 py-2'>
                                2/4 Steps done
                            </td>
                            <td class='px-4 py-2' title="{{ $integration->created_at }}">{{ $integration->created_at }}</td>
                            <td class='d-flex text-center justify-content-start'>
                                <x-dashboard::dashboard.forms.edit-action-anchor route="{{ route('dashboard.integrations.edit', [$integration->uuid]) }}"/>
                                <x-dashboard::dashboard.forms.delete-form resourceId="{{ $integration->uuid }}" route="{{ route('dashboard.integrations.destroy', [$integration->uuid]) }}"/>
                                <x-dashboard::dashboard.forms.view-action-anchor route="{{ route('dashboard.integrations.show', [$integration->uuid]) }}" for="{{ $integration->name }}"/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class='row my-8'>
            {{ $integrations->withQueryString()->links() }}
        </div>

    </x-dashboard::dashboard.card>
@endsection