@aware(['model' => null])
@props([
    'icon'        => 'list',
    'required'    => false,
    'cols'        => 'col-span-12',
    'placeholder' => '',
    'name'        => 'INPUT_NAME',
    'label',
    'value'       => old($name, $value ?? ($model[$name] ?? null)),
])

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="fa fa-{{ $icon }}"></i>
        {{ $label }}
    </label>
    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
            type="email"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
        >
        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>