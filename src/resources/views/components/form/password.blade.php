@php
    $attributes['class'] = 'form-control ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

@if(strpos(request()->route()->getName(), 'show') === false)
    <li class="list-group-item">
        <div class="row gutters-sm">
            {{ Form::label($label, null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
            <div class="col-xl-5">
                {{ Form::password($name, $attributes) }}

                @include('agenciafmd/form::partials.invalid-feedback')
            </div>
            @include('agenciafmd/form::partials.helper')
        </div>
    </li>
@endif