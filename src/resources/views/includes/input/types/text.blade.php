@php
    $name = $__data[0];
    $value = $__data[1] ?? old($name, optional(app()->make('form-model')->first())->{$name});
    $attributes = $__data[2] ?? [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
    'type' => 'text',
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])
