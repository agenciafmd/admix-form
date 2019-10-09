<select name="{{ $name }}" id="{{ $name }}" {!! $attributes !!}>
  @foreach ($options as $key => $value)
    @if ($key != $selectedValue)
      <option value="{{ $key }}">{{ $value }}</option>
    @else
      <option value="{{ $key }}" selected>{{ $value }}</option>
    @endif
  @endforeach
</select>
