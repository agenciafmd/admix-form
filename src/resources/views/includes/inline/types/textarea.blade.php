@php
    $label = $__data[0];
    $name = $__data[1];
    $value = $__data[2] ?? old($name, optional(app()->make('form-model')->first())->{$name});
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
    'col' => 'col-xl-9'
])
    @slot('input')
        @inputTextareaPlain([$name, $value, ['id' => $name] + $attributes])
    @endslot
@endcomponent
