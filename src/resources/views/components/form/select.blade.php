@php
    $formControl = 'form-control custom-select';
    $dottedName = str_replace(['[', ']'], ['.', ''], $name);
    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($dottedName) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

<li class="list-group-item">
    <div class="row gutters-sm">
        {{ Form::label($label, null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
        <div class="col-xl-5">
            {{ Form::select($name, $options, $value, $attributes) }}

            @include('agenciafmd/form::partials.invalid-feedback')
        </div>
        @include('agenciafmd/form::partials.helper')
    </div>
</li>