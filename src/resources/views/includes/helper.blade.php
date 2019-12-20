@php
    $name = $__data[0];
    $label = $__data[1];
@endphp

@if($label)
    <small id="{{ $name }}Help" class="mt-2 form-text col text-muted">
        {{ str_limit($label, 60, '') }}
    </small>
@endif