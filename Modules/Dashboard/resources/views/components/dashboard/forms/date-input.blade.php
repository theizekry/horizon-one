@props([
    'icon'        => 'fas fa-calendar',
    'required'    => false,
    'cols'        => 'col-span-12',
    'placeholder' => '',
    'value'       => null,
    'name',
    'label',
])

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="{{ $icon }}"></i> {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
                type="date"
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-control flatpickr-input"
                placeholder="{{ $placeholder }}"
                value="{{ old($name, $value) }}"
        >

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
