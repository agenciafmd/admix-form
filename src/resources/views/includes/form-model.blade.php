@php
    //$model = $__data[0]
    //$action = $__data[1];
    //$method = $__data[2];
    //$attributes = $__data[3] ?? [];

    //$attributes['class'] = 'needs-validation ' . ((count($errors) > 0) ? 'was-validated ' : '') . (($attributes['class']) ?? '');

    app()->make('form-model')->push($model);
@endphp

@if(request()->is('*/create') || request()->is('*/create/*'))
    <form action="{!! $create !!}" method="post" id="{{ $id }}" class="{{ $class }}" enctype="multipart/form-data"
          novalidate>
        @endif
        <form action="{!! $update !!}" method="post" id="{{ $id }}" class="{{ $class }}" enctype="multipart/form-data"
              novalidate>
    @method('put')
    @csrf

    {{--@if(request()->is('*/create') || request()->is('*/create/*'))--}}
    {{--    <form action="{!! $action !!}" method="{!! $method !!}" {!! attributesToString($attributes) !!} enctype="multipart/form-data" novalidate>--}}
    {{--    @method($method)--}}

    {{--    {!! Form::open(['url' => $params['create'],--}}
    {{--        'class' => 'mb-0 card-list-group card needs-validation' . ((count($errors) > 0) ? ' was-validated' : ''),--}}
    {{--        'novalidate' => true, 'id' => 'formCrud', 'files' => true ]) !!}--}}
    {{--@else--}}
    {{--    {!! Form::model($params['model'], ['url' => $params['update'], 'method' => 'PUT',--}}
    {{--        'class' => 'mb-0 card-list-group card needs-validation' . ((count($errors) > 0) ? ' was-validated' : ''),--}}
    {{--        'novalidate' => true, 'id' => 'formCrud', 'files' => true]) !!}--}}
    {{--@endif--}}
    {{--@csrf--}}
