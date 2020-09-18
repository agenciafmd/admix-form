<li class="list-group-item">
    <div class="row gutters-sm">
        <x-form-label :label="$label" :for="$name" class="col-xl-3 col-form-label pt-0 pt-xl-2"/>
        <div class="col-xl-5">
            <select
                    @if($isWired())
                    wire:model="{{ $name }}"
                    @else
                    name="{{ $name }}"
                    @endif

                    @if($multiple)
                    multiple
                    @endif

                    {!! $attributes->merge([
                            'class' => 'form-control ' . ($hasError($name, 'admix') ? 'is-invalid' : ''),
                        ]) !!}>
                @foreach($options as $key => $option)
                    <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            <x-form-invalid-feedback :name="$name" :label="$label"/>
        </div>
        @if($attributes['title'])
            <x-form-help :name="$name" :message="$attributes['title']"/>
        @endif
    </div>
</li>
