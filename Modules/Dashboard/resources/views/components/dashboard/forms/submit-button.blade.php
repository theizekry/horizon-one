@props([
    'label' => __('dashboard::dashboard.save-data'),
    'icon' => 'check-circle',
])

<button type="submit" class="btn btn-primary">
    <i class="fa fa-{{$icon}}"></i>
    {{ $label }}
</button>