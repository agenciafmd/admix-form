@php
    $formControl = 'form-control';

    //uso do admix somente
    if((strpos(request()->route()->getName(), 'show') !== false) && (strpos(request()->route()->getName(), 'admix') !== false)) {
        $formControl = 'form-control-plaintext';
        $attributes['class'] = str_replace('custom-select', '', $attributes['class']);
        $attributes['disabled'] = true;
    }

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = $formControl . ' ' . ($errors->{$bag}->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
@endphp

<select name="{{ $name }}" id="{{ $name }}" {!! attributesToString($attributes) !!}>
    @foreach ($options as $key => $value)
        @if ((string)$key === (string)$selectedValue)
            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
        @else
            <option value="{{ $key }}">{{ $value }}</option>
        @endif
    @endforeach
</select>
