@php
    $label = $__data[0];
    $name = $__data[1];
    $value = $__data[2] ?? old($name, app()->make('form-model')->first()->{$name});
    $attributes = $__data[3] ?? [];
    $helper = ($__data[4]) ?? '';

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = (isset($attributes['class'])) ? 'custom-select ' . $attributes['class'] : 'custom-select';
@endphp

@component('agenciafmd/form::includes.inline.form-inline', [
    'label' => $label,
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
    'bag' => $bag,
    'helper' => $helper,
])
    @slot('input')
        @inputBoolean([$name, $value, ['id' => $name] + $attributes])
    @endslot
@endcomponent
