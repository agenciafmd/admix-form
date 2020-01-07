@php
    $label = $__data[0];
    $name = $__data[1];
    $value = $__data[2] ?? old($name, app()->make('form-model')->first()->{$name});
    $attributes = $__data[3] ?? [];

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
        @inputText([$name, $value, ['id' => $name] + $attributes])
    @endslot
@endcomponent
