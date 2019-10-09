@php
    $name = $__data[0];
    $label = $__data[1];
    $attributes = $__data[2] ?? [];
@endphp

<label for="{{ $name }}" {!! attributesToString($attributes) !!}>{{ $label }}</label>
