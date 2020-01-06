@php
    $action = $__data[0];
    $method = strtolower($__data[1]);
    $attributes = $__data[2] ?? [];

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = 'needs-validation ' . (($errors->{$bag}->any()) ? 'was-validated ' : '') . (($attributes['class']) ?? '');
    $attributes['novalidade'] = 'novalidate';

    $methodForm = (in_array($method, ['patch', 'put', 'delete', 'post'])) ? 'post' : 'get';
@endphp

<form action="{!! $action !!}" method="{!! $methodForm !!}"
      {!! attributesToString($attributes) !!} enctype="multipart/form-data" novalidate>

@if(($method != 'get') && ($method != 'post'))
    @method($method)
@endif

@if($method != 'get')
    @csrf
@endif
