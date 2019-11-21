@php
    $name = $__data[0];
    $value = null;
    $attributes = $__data[1] ?? [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
    'type' => 'password',
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])
