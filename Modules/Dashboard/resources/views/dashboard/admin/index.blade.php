@extends('dashboard::dashboard.layouts.master')

@section('title', __('dashboard::dashboard.manage_admins'))

@section('breadcrumbs')
    <x-dashboard::dashboard.breadcrumb.breadcrumb>
        <x-dashboard::dashboard.breadcrumb.breadcrumb-item
                label="{{ __('dashboard::dashboard.manage_admins') }}"
                route="{{ route('dashboard.admins.index') }}"
                active
        />
    </x-dashboard::dashboard.breadcrumb.breadcrumb>
@endsection

@section('content')
    <x-dashboard::dashboard.card icon='fas fa-users' title="{{ __('dashboard::dashboard.manage_admins') }}" searchResults="{{ $admins->total() }}">

        <div class='overflow-x-auto'>
            <div class='flex my-5 justify-content-between'>
                <div class='justify-start'>
                    <a type='button' href='{{ route('dashboard.admins.create') }}' class='justify-content-end bg-blue-500 text-white py-2 px-4 rounded'>
                        <i class='fas fa-plus mr-2 text-white'></i>
                        {{ __('dashboard::dashboard.add-new') }}
                    </a>
                </div>
                <x-dashboard::dashboard.forms.search route="dashboard.admins.index" :data="$admins"></x-dashboard::dashboard.forms.search>
            </div>

            @if($admins->isEmpty())
                <x-dashboard::dashboard.no-data-to-show />
            @else
                <table class='w-full table table-responsive'>
                    <thead>
                    <tr>
                        <th class='px-4 py-2 text-gray-600'>ID</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.name') }}</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.username') }}</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.phone_number') }}</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.email') }}</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.image') }}</th>
                        <th class='px-4 py-2 text-gray-600 text-uppercase'>{{ __('dashboard::dashboard.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                        <tr class="{{ $admin->id == auth()->id() ? 'bg-blue-50' : '' }} ">
                            <td class='px-4 py-2'>{{ $admin->id }}</td>
                            <td class='px-4 py-2'>{{ $admin->name }}</td>
                            <td class="px-4 py-2 text-black font-bold">
                                <span class="badge badge-light-primary font-bold">{{ $admin->username }}</span>
                            </td>
                            <td class="px-4 py-2 text-black">
                                {{ $admin->phone_number }}
                            </td>
                            <td class='px-4 py-2'>{!! $admin->email ?? ' - ' !!}</td>
{{--                            <td class="px-4 py-2 text-black">--}}
{{--                                {{ $admin->roleName }}--}}
{{--                            </td>--}}
{{--                            <td class="px-4 py-2">--}}
{{--                                <span class="badge badge-light-{{ $admin->is_blocked ? 'danger' : 'success' }}">{{ $admin->is_blocked ? __('dashboard::dashboard.yes') : __('dashboard::dashboard.no') }}</span>--}}
{{--                            </td>--}}
                            <td class='px-4 py-2'>
                                <img src="{{ $admin->image ?? '' }}" alt="-" class="rounded-full border border-gray-100" height='30' width='30'>
                            </td>
                            <td class='d-flex text-center justify-content-start'>

                                @if($admin->id !== auth()->id())
                                    <x-dashboard::dashboard.forms.edit-action-anchor route="{{ route('dashboard.admins.edit', [$admin->id]) }}"/>
                                @endif

                                <x-dashboard::dashboard.forms.view-action-anchor route="{{ route('dashboard.admins.show', [$admin->id]) }}" for="{{ $admin->name }}"/>

{{--                                @if(auth()->user()->hasPermission('update-admins') && $admin->id !== auth()->id())--}}
{{--                                    <x-dashboard::dashboard.forms.delete-form resourceId="{{ $admin->id }}" route="{{ route('dashboard.admins.destroy', [$admin->id]) }}"/>--}}
{{--                                @endif--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>

        <div class='row my-8'>
            {{ $admins->withQueryString()->links() }}
        </div>

    </x-dashboard::dashboard.card>

@endsection