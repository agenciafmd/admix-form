@php
    $label = $__data[0];
    $name = $__data[1];
    $value = $__data[2];
    $attributes = $__data[3] ?? [];
    $helper = ($__data[4]) ?? '';

    $formControl = 'form-control';

    //uso do admix somente
    if((strpos(request()->route()->getName(), 'show') !== false) && (strpos(request()->route()->getName(), 'admix') !== false)) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $bag = $attributes['bag'] ?? 'admix';
    unset($attributes['bag']);

    $attributes['class'] = $formControl . ' ' . ($errors->{$bag}->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
    $attributes['id'] = $attributes['id'] ?? Str::slug($name);
@endphp

<li class="list-group-item">
    <div class="row gutters-sm single-upload">
        @label([$label, $name, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']])
        <div class="col-xl-5">
            @inputMedia([$name, $user, $attributes])
            @invalidFeedback([$name, $label])
        </div>
        @helper([$name, $helper])
    </div>
</li>