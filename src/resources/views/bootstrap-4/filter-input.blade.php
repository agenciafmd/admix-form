<h6 class="dropdown-header bg-gray-lightest p-2">{{ $label }}</h6>
<div class="p-2">
    <input {!! $attributes->merge([
        'class' => 'form-control form-control-sm',
    ]) !!}
           type="{{ $type }}"
           name="filter[{{ $name }}]"
           value="{{ filter($name) }}">
</div>
