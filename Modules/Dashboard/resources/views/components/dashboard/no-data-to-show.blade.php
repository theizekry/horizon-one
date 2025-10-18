@props([
    'message' => __('dashboard::dashboard.no-data-to-show')
])

<p class='font-bold text-start text-blue-800 my-10'>
    <i class="fa fa-info-circle text-blue-800"></i> {{ $message }}
</p>
