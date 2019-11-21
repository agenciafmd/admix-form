@php
    $name = $__data[0];
    $options = $__data[1];
    $value = $__data[2] ?? old($name);
    $attributes = $__data[3] ?? [];
@endphp

@include('agenciafmd/form::includes.select.select-base', [
    'name' => $name,
    'options' => $options,
    'selectedValue' => $value,
    'attributes' => $attributes,
])
