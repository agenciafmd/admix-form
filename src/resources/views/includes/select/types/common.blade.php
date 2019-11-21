@php
    $name = $__data[0];
    $value = $__data[1] ?? old($name);
    $options = ['' => '-'] + $__data[2];
    $attributes = $__data[3] ?? [];
@endphp

@include('agenciafmd/form::includes.select.select-base', [
    'name' => $name,
    'selectedValue' => $value,
    'options' => $options,
    'attributes' => $attributes,
])
