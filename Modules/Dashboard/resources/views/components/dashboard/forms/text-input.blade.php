@aware(['model' => null])
@props([
    'icon'        => 'fas fa-font',
    'required'    => false,
    'cols'        => 'col-span-12',
    'placeholder' => '',
    'dir'         => 'ltr',
    'name'        => 'INPUT_NAME',
    'value'       => old($name, $value ?? ($model[$name] ?? null)),
    'labelColor'  => 'text-black',
    'disabled'    => false,
    'label',
])

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label {{ $labelColor }}">
        <i class="{{ $icon }}"></i> {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
                type="text"
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-control"
                placeholder="{{ $placeholder }}"
                dir="{{ $dir }}"
                value="{{ $value }}"
                @if($disabled) disabled @endif
        >

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
