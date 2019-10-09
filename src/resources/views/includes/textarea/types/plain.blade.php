@php
    $name = $__data[0];
    $value = $__data[1];
    $attributes = $__data[3] ?? [];

    if (isset($attributes['class'])) {
        $attributes['class'] = str_replace('js-wysiwyg', '', $attributes['class']);
    }// if
@endphp

@include('agenciafmd/form::includes.textarea.textarea-base', [
    'name' => $name,
    'value' => $value,
    'attributes' => attributesToString($attributes + config('admix.forms.textarea.plain')),
])
