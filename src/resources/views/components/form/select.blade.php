@php
    $formControl = 'form-control custom-select';

    if(strpos(request()->route()->getName(), 'show') !== false) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

<li class="list-group-item">
    <div class="my-lg-2 row gutters-sm">
        {{ Form::label($label, null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
        <div class="col-xl-5">
            {{ Form::select($name, $options, $value, $attributes) }}

            @include('agenciafmd/form::partials.invalid-feedback')
        </div>
        @include('agenciafmd/form::partials.helper')
    </div>
</li>