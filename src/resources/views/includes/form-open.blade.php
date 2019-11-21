@php
    $action = $__data[0];
    $method = strtolower($__data[1]);
    $attributes = $__data[2] ?? [];

    $attributes['class'] = 'needs-validation ' . ((count($errors) > 0) ? 'was-validated ' : '') . (($attributes['class']) ?? '');

    $methodForm = (in_array($method, ['patch', 'put', 'delete', 'post'])) ? 'post' : 'get';
@endphp

<form action="{!! $action !!}" method="{!! $methodForm !!}"
      {!! attributesToString($attributes) !!} enctype="multipart/form-data" novalidate>
@if(($method != 'get') && ($method != 'post'))
    @method($method)
@endif
@csrf