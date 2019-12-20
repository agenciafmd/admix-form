@php
    $name = $__data[0];
    $option = $__data[1];
    $value = $__data[2] ?? old($name, optional(app()->make('form-model')->first())->{str_replace('[]', '', $name)});
    $attributes = $__data[3] ?? [];

    $formControl = 'custom-control-input';

    //uso do admix somente
    if((strpos(request()->route()->getName(), 'show') !== false) && (strpos(request()->route()->getName(), 'admix') !== false)) {
        $formControl = 'custom-control-input';
        $attributes['disabled'] = true;
    }

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = $formControl . ' ' . ($errors->{$bag}->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');

    if(!is_array($value)) {
        $value = [];
    }

    if(in_array($option, $value)) {
        $attributes['checked'] = 'checked';
    }
@endphp

<input type="checkbox" name="{!! $name !!}" value="{!! $option !!}" {!! attributesToString($attributes) !!}>
