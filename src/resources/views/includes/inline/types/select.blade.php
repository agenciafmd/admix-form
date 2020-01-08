@php
    $label = $__data[0];
    $name = $__data[1];
    $options = $__data[2];
    $value = $__data[3] ?? old($name, ($item = app()->make('form-model')->first()) ? $item->{$name} : null);
    $attributes = $__data[4] ?? [];
    $helper = ($__data[5]) ?? '';

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
        @inputSelect([$name, $options, $value, ['id' => $name] + $attributes])
    @endslot
@endcomponent
