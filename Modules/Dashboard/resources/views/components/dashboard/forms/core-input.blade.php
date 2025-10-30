@aware(['model' => null])
@props([
    'name',
    'label',
    'icon'        => 'fas fa-font',
    'required'    => false,
    'cols'        => 'col-span-12',
    'placeholder' => '',
    'dir'         => 'ltr',
    'value'       => null,
    'labelColor'  => 'text-black',
    'disabled'    => false,
    'id'          => null,
    'type'        => 'text', // Default type
    'inputClass'  => 'form-control',
    'attributes'  => '',
])

@php
    // Generate ID if not provided
    $id = $id ?? $name;

    // Handle model binding
    $boundValue = old($name, $value ?? ($model ? data_get($model, $name) : null));

    // Error handling
    $hasError = $errors->has($name);
    $errorClass = $hasError ? 'has-error' : '';
    $inputErrorClass = $hasError ? 'is-invalid' : '';
@endphp

<div class="{{ $cols }} {{ $errorClass }}">
    @if($label)
        <label for="{{ $id }}" class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label {{ $labelColor }}">
            @if($icon)
                <i class="{{ $icon }}"></i>
            @endif
            {{ $label }}
        </label>
    @endif

    <div class="form-group">
        <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $id }}"
                class="{{ $inputClass }} {{ $inputErrorClass }}"
                placeholder="{{ $placeholder }}"
                dir="{{ $dir }}"
                value="{{ $type !== 'password' ? $boundValue : '' }}"
                @if($disabled) disabled @endif
                @if($required) required @endif
                {!! $attributes->except(['class', 'type']) !!}
        >

        @if($hasError)
            <small class="text-danger">{{ $errors->first($name) }}</small>
        @endif
    </div>
</div>