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
  @if (is_array($selectedValue))
    @foreach ($options as $key => $value)
      <option value="{{ $key }}"{{ (in_array($key, $selectedValue)) ? ' selected="selected"' : '' }}>{{ $value }}</option>
    @endforeach
  @else
    @foreach ($options as $key => $value)
        <option value="{{ $key }}"{{ ($key == $selectedValue) ? ' selected="selected"' : '' }}>{{ $value }}</option>
    @endforeach
  @endif
</select>
