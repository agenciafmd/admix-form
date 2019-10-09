@php
  $name = $__data[0];
  $value = $__data[1] ?? old($name);
  $options = !empty($__data[2]) ? ['' => '-'] + $__data[2] : [false => 'Não', true => 'Sim'];
  $attributes = $__data[3] ?? [];

  if (count($options) > 3) {
    throw new \Exception('Input Booleano não pode conter mais de duas opções.', 500);
  }// if
@endphp

@include('agenciafmd/form::includes.select.select-base', [
  'name' => $name,
  'selectedValue' => $value,
  'options' => $options,
  'attributes' => attributesToString($attributes),
])
