@php
    $label = $__data[0];
    $name = $__data[1];
    $value = null;
    $attributes = $__data[2] ?? [];

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);
@endphp

@component('agenciafmd/form::includes.group.form-group', [
    'label' => $label,
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
    'bag' => $bag,
])
    @slot('input')
        @inputPassword([$name, ['id' => $name] + $attributes])
    @endslot
@endcomponent
