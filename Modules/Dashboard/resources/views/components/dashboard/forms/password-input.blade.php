@props([
    'icon'               => 'fas fa-font',
    'required'           => false,
    'cols'               => 'col-span-12',
    'placeholder'        => '',
    'showLeaveBlankNote' => false,
    'name',
    'label',
])

<div class="{{ $cols }}">
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="{{ $icon }}"></i> {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
        <input
                type="password"
                name="{{ $name }}"
                id="{{ $name }}"
                placeholder="{{ $placeholder }}"
                class="form-control"
                autocomplete="off"
        >

        @if($showLeaveBlankNote)
            <small class="text-primary font-bold">
                <i class="fas fa-info-circle"></i>
                {{ __('dashboard::dashboard.leave_it_blank') }}
            </small>
        @endif

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>
