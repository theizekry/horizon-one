@props([
    'title' => __('dashboard::dashboard.delete'),
    'label' => false,
    'icon'  => true,
    'resourceId',
    'route',
])

<form id="delete-form-{{ $resourceId }}" class="mx-2" action="{{ $route }}" method='POST'>
    @csrf
    @method('DELETE')

    <a type="submit" href='#' class='hover:text-white text-red' title="{{ $title }}" onClick="deleteConfirmationDialog.showConfirmDialog({{ $resourceId }})">

        @if($icon)
            <i class='fas fa-trash text-red-400'></i>
        @endif

        {{ $slot }}
    </a>
</form>