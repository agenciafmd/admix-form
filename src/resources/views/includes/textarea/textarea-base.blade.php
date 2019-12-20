@php
    $formControl = '';

    //uso do admix somente
    if((strpos(request()->route()->getName(), 'show') !== false) && (strpos(request()->route()->getName(), 'admix') !== false)) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['rows'] = ($attributes['rows']) ?? 7;

    $attributes['class'] = $formControl . ' ' . ($errors->{$bag}->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

<textarea name="{{ $name }}" id="{{ $name }}" {!! attributesToString($attributes) !!}>{!! $value !!}</textarea>
