@php
    $name = $__data[0];
    $label = $__data[1];
    $attributes = $__data[2] ?? [];

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $defaultClass = 'invalid-feedback';
    $attributes['class'] = $defaultClass . ' ' . (($attributes['class']) ?? '');
@endphp

<div {!! attributesToString($attributes) !!}>
    @if($errors->{$bag}->has($name))
        {{ ucfirst($errors->{$bag}->first($name)) }}
    @else
        o campo {{ strtolower($label) }} é obrigatório
    @endif
</div>
