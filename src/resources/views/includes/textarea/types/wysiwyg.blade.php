@php
    $name = $__data[0];
    $value = $__data[1];
    $attributes = $__data[2] ?? [];

    if (isset($attributes['class'])) {
        $attributes['class'] .= ' js-wysiwyg';
    } else {
        $attributes['class'] = 'js-wysiwyg';
    }// else
@endphp

@include('agenciafmd/form::includes.textarea.textarea-base', [
    'name' => $name,
    'value' => $value,
    'attributes' => attributesToString($attributes + config('admix.forms.textarea.plain')),
])
