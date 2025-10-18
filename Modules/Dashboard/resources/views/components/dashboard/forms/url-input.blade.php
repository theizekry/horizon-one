@props([
    'icon'        => 'link',
    'required'    => false,
    'cols'        => 'col-span-12',
    'placeholder' => '',
    'name',
    'label',
])

@php
    $value = old($name);
@endphp

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="{{ $icon }}"></i> {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
                type="url"
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-control"
                placeholder="{{ $placeholder }}"
                value="{{ $value }}"
        >

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
