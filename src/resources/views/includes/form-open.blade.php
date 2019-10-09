@php
  $action = $__data[0];
  $method = $__data[1];
  $attributes = $__data[2] ?? [];
@endphp

<form action="{!! $action !!}" method="{!! $method !!}" {!! attributesToString($attributes + config('admix.forms.form')) !!}>
  @method($method)
  @csrf

