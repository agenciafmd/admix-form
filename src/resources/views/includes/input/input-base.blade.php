@php
    $formControl = 'form-control';

    //uso do admix somente
    if((strpos(request()->route()->getName(), 'show') !== false) && (strpos(request()->route()->getName(), 'admix') !== false)) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = $formControl . ' ' . ($errors->{$bag}->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

<input type="{!! $type !!}" name="{!! $name !!}" id="{!! $name !!}"
       value="{!! $value !!}" {!! attributesToString($attributes) !!}/>
