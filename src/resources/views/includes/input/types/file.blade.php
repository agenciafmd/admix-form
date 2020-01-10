@php
    $name = $__data[0];
    $value = $__data[1] ?? null;
    $attributes = [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
    'type' => 'file',
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])
