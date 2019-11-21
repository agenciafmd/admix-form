@php
    $name = $__data[0];
    $value = $__data[1] ?? old($name);
    $options = ['' => '-', '0' => 'Não', '1' => 'Sim'];
    $attributes = $__data[2] ?? [];
@endphp

@include('agenciafmd/form::includes.select.select-base', [
    'name' => $name,
    'selectedValue' => $value,
    'options' => $options,
    'attributes' => $attributes,
])
