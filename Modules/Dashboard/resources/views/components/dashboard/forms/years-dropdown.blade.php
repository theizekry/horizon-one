@props([
    'icon'     => 'fas fa-calendar',
    'required' => false,
    'cols'     => 'col-span-12',
    'name',
    'label' => '',
])

@php
    $selected = old($name);
    $startYear = 1923;
    $endYear = now()->year;
@endphp

<div class="col-sm {{ $cols }}">
    @if($label)
        <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
            <i class="fa fa-{{ $icon }}"></i>
            {{ $label }}
        </label>
    @endif

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <select
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-control"
        >
            <option value="">{{ __('dashboard::dashboard.select-a-year') }}</option>

            @foreach (range($endYear, $startYear) as $year)
                <option value="{{ $year }}" @selected($selected == $year)>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
