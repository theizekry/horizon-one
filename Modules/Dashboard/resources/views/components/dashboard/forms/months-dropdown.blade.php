@props([
    'icon'     => 'fas fa-calendar',
    'required' => false,
    'cols'     => 'col-span-12',
    'name',
    'label',
])

@php
    $selectedMonth = old($name);
@endphp

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="fa fa-{{ $icon }}"></i>
        {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
            <option value="">{{ __('dashboard::dashboard.select-a-month') }}</option>
            @foreach(range(1, 12) as $month)
                <option value="{{ $month }}" @selected($selectedMonth == $month)>
                    {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
