@props([
    'label' => __('dashboard::dashboard.reset'),
    'icon'  => 'fas fa-times mr-2',
])

<button type="reset" class="btn btn-danger">
    <i class="fas fa-sync-alt mr-2"></i>
    {{ $label }}
</button>