@props([
    'icon'          => 'fas fa-tags',
    'required'      => false,
    'cols'          => 'col-span-12',
    'multiple'      => false,
    'selectedValue' => null,
    'select2'       => false,
    'label'         => '',
    'labelColor'    => 'text-black',
    'extraNote'     => '',
    'data',
    'name',
    'placeholder',
])

@php
    $selected = old($name, $selectedValue);
    $options = collect($data);
    $selectClasses = 'form-control' . ($select2 ? ' select2-class' : '');
@endphp

<div class="col-sm {{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label {{ $labelColor }}">
        <i class="{{ $icon }}"></i> {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <select
                name="{{ $multiple ? $name . '[]' : $name }}"
                id="{{ $name }}"
                class="{{ $selectClasses }}"
                @if($multiple) multiple @endif
        >
            <option value="">{{ $placeholder ?: __('dashboard::dashboard.choose_option') }}</option>

            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}"
                        @if($multiple && is_array($selected) && in_array($optionValue, $selected))
                            selected
                        @elseif(!$multiple && $selected == $optionValue)
                            selected
                        @endif
                >
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        @if($extraNote)
            <small class="text-danger">{{ $extraNote }}</small>
        @endif

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
