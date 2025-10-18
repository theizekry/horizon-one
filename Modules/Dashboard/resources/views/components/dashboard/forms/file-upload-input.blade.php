@props([
    'name',
    'id'           => '',
    'note'         => '',
    'label'        => 'File Upload',
    'extensions'   => '.png, .jpg, .jpeg',
    'required'     => false,
    'multiple'     => false,
    'cols'         => 'col-span-12',
    'imagePreview' => false,
    'noteClass'    => ''
])

<div class='{{ $cols }}'>
    <label class="col-form-label {{ $required ? 'required' : '' }} fw-bold fs-6 control-label">
        <i class="fa fa-upload"></i>
        {{ $label }}
    </label>

    <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">

        <input type='file'
               class='form-control'
               name={{ $name }}
               accept='{{ $extensions }}'
               multiple='{{ $multiple }}'
               id="{{ $id }}"
        >

        <div class="row my-2 justify-between">
            <small class='text-info'>
                <i class="fa fa-info-circle"></i>
                {{ __('dashboard::dashboard.allowed-files-type', ['extensions' => strtoupper(str_replace('.', '', $extensions)) ])}}
            </small>
            @if($note)
                <small class="text-info {{ $noteClass }}">
                    <i class="fa fa-info-circle"></i>
                    {!! $note !!}
                </small>
            @endif
        </div>

        @if($imagePreview)
            <div class="d-flex mr-2 img-thumbs-hidden" id="img-preview"></div>
        @endif

        <small class="text-danger">{{ $errors->first($name) }}</small>
    </div>
</div>