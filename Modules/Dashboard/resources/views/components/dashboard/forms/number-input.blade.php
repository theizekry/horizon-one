@props([
    'icon'          => 'list',
    'required'      => false,
    'allowDecimals' => false,
    'cols'          => 'col-span-12',
    'placeholder'   => '',
    'min'           => 0,
    'max'           => 9999999999,
    'dir'           => 'ltr',
    'disabled'      => false,
    'value'         => null,
    'labelColor'    => 'text-black',
    'name',
    'label',
])

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label {{ $labelColor }}">
        <i class="fa fa-{{ $icon }}"></i>
        {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
                type="number"
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-control"
                step="{{ $allowDecimals ? 'any' : 1 }}"
                min="{{ $min }}"
                max="{{ $max }}"
                placeholder="{{ $placeholder }}"
                dir="{{ $dir }}"
                value="{{ old($name, $value) }}"
                @if($disabled) disabled @endif
        >

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
