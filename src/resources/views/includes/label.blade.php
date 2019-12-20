@php
    $name = $__data[0];
    $for = $__data[1];
    $attributes = $__data[2] ?? [];
@endphp

<label for="{{ $for }}" {!! attributesToString($attributes) !!}>{{ $name }}</label>
