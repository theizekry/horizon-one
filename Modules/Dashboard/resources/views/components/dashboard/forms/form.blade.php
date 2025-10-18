@props([
    'action',
    'method',
    'multipart' => false
])

<form
  method="POST"
  action="{{ $action }}"
  {{ $multipart ? "enctype='multipart/form-data'" : '' }}
  {{ $attributes->merge(['class' => 'form']) }}
>
    @csrf
    @method($method)

    {{ $slot }}

</form>