@props([
    'href',
    'title' => '',
    'phoneNumber',
])

<a class="mx-2" title="{{ $title ?: __('dashboard::dashboard.chat_via_whatsapp') }}" href="{{ $href }}" >
    <i class="fab fa-whatsapp text-success"></i>
    @isset($phoneNumber)
        {{ $phoneNumber }}
    @endisset
</a>