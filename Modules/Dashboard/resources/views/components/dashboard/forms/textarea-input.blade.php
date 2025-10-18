@props([
    'icon'               => 'file-alt',
    'required'           => false,
    'rows'               => 3,
    'applySpecialEditor' => false,
    'cols'               => 'col-span-12',
    'placeholder'        => '',
    'name',
    'label',
])

@php
    $value = old($name);
@endphp

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="fa fa-{{ $icon }}"></i>
        {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                class="form-control {{ $applySpecialEditor ? 'editor' : '' }} {{ $attributes->get('class') }}"
        >{{ $value }}</textarea>

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
