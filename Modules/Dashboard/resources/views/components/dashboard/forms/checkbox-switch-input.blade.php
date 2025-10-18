@props([
    'name',
    'isChecked' => false,
    'value'     => false,
    'label'     => 'FILED NAME',
    'cols'      => 'col-span-6'
])

<!--begin::Switch-->
<div class="d-flex flex-stack my-7 {{ $cols }} {{ $attributes->get('class') }}">
    <label class="d-block form-check form-switch form-check-custom">
        <input
                type="checkbox"
                name="{{ $name }}"
                id="{{ $name }}"
                class="form-check-input"
                value="{{ $value }}"
                @checked(old($name, $isChecked))
        >
        <span class="form-check-label fw-bold text-muted">
            {{ $label }}
            <i class="fa fa-question-circle"></i>
        </span>
    </label>
</div>
<!--end::Switch-->
