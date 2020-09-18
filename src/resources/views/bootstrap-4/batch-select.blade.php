<select
        name="batch"
        {!! $attributes->merge([
                'class' => 'js-batch-select form-control custom-select',
            ]) !!}>
    @foreach($options as $key => $option)
        <option value="{{ $key }}">
            {{ $option }}
        </option>
    @endforeach
</select>
