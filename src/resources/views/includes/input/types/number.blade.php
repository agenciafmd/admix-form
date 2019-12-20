@php
    $name = $__data[0];
    $value = $__data[1] ?? old($name);
    $attributes = $__data[2] ?? [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
    'type' => 'number',
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])