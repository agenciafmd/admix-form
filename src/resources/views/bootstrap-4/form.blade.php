<form method="{{ (in_array($method, ['PUT', 'DELETE'])) ? 'POST' : $method }}" {!! $attributes->merge([
    'class' => 'mb-0 card-list-group card needs-validation ' . ($hasError('admix') ? 'was-validated' : ''),
    'accept-charset' => 'UTF-8',
    'novalidate' => '',
    'id' => 'formCrud',
    'enctype' => 'multipart/form-data',
]) !!} >
    @if(in_array($method, ['PUT', 'DELETE']))
        {{ method_field($method) }}
    @endif

    @unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
        @csrf
    @endunless

    {!! $slot !!}
</form>