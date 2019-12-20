@php
    $label = $__data[0];
    $name = $__data[1];
    $value = null;
    $attributes = $__data[2] ?? [];
    $helper = ($__data[3]) ?? '';

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
        @inputPassword([$name, ['id' => $name] + $attributes])
    @endslot
@endcomponent
