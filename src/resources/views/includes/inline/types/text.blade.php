@php
    $label = $__data[0];
    $name = $__data[1];
    $value = $__data[2] ?? old($name, ($item = app()->make('form-model')->first()) ? $item->{$name} : null);
    $attributes = $__data[3] ?? [];
    $helper = ($__data[4]) ?? '';

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);
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
        @inputText([$name, $value, ['id' => $name] + $attributes])
    @endslot
@endcomponent
