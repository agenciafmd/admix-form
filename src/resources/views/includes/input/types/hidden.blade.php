@php
    $name = $__data[0];
    $value = $__data[1];
    $attributes = [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
    'type' => 'hidden',
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])
