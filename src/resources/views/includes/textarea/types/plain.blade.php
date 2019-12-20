@php
    $name = $__data[0];
    $value = $__data[1];
    $attributes = $__data[3] ?? [];

    if (isset($attributes['class'])) {
        $attributes['class'] = 'form-control ' . str_replace('js-wysiwyg', '', $attributes['class']);
    }
    else {
        $attributes['class'] = 'form-control ';
    }

@endphp

@include('agenciafmd/form::includes.textarea.textarea-base', [
    'name' => $name,
    'value' => $value,
    'attributes' => $attributes,
])
