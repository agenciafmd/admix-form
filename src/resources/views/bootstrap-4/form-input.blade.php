<li class="@if($type === 'hidden') d-none @else list-group-item @endif">
    <div class="row gutters-sm">
        <x-form-label :label="$label" :for="$name" class="col-xl-3 col-form-label pt-0 pt-xl-2"/>
        <div class="col-xl-5">
            <input {!! $attributes->merge([
                            'class' => 'form-control ' . ($hasError($name, 'admix') ? 'is-invalid' : ''),
                        ]) !!}
                   type="{{ $type }}"

                   @if($isWired())
                   wire:model="{{ $name }}"
                   @else
                   name="{{ $name }}"
                   value="{{ $value }}"
                    @endif
            />
            <x-form-invalid-feedback :name="$name" :label="$label"/>
        </div>
        @if($attributes['title'])
            <x-form-help :name="$name" :message="$attributes['title']"/>
        @endif
    </div>
</li>
