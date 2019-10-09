@php
  $type = 'password';

  $name = $__data[0];
  $value = null;
  $attributes = $__data[1] ?? [];
@endphp

@include('agenciafmd/form::includes.input.input-base', [
  'type' => $type,
  'name' => $name,
  'value' => $value,
  'attributes' => attributesToString($attributes + config("admix.forms.input.{$type}")),
])
