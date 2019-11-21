@php
    app()->make('form-model')->push($model);
    $class = 'needs-validation ' . ((count($errors) > 0) ? 'was-validated ' : '') . (($class) ?? '');
@endphp

@if(request()->is('*/create') || request()->is('*/create/*'))
    <form action="{!! $create !!}" method="post" id="{{ $id }}" class="{{ $class }}" enctype="multipart/form-data"
          novalidate>
        @else
            <form action="{!! $update !!}" method="post" id="{{ $id }}" class="{{ $class }}"
                  enctype="multipart/form-data"
                  novalidate>
    @method('put')
@endif
    @csrf
