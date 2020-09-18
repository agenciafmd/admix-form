<h6 class="dropdown-header bg-gray-lightest p-2">{{ $label }}</h6>
<div class="p-2">
    <select
            @if($isWired())
            wire:model="{{ $name }}"
            @else
            name="filter[{{ $name }}]"
            @endif

            @if($multiple)
            multiple
            @endif

            {!! $attributes->merge([
                    'class' => 'form-control form-control-sm',
                ]) !!}>
        @foreach($options as $key => $option)
            <option value="{{ $key }}" {{ (filter($name) == $key) ? 'selected="selected"' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</div>
