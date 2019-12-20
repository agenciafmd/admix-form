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
    $attributes['multiple'] = true;

    $modelName = strtolower(class_basename($value));
    $fields = config("upload-configs.{$modelName}");

    if(isset($attributes['config'])) {
        $fields = $attributes['config'];
        unset($attributes['config']);
    }

    $width = $fields[$name]['width'] ?? 800;
    $height = $fields[$name]['height'] ?? 600;
    $quality = $fields[$name]['quality'] ?? 92;
    $crop = $fields[$name]['crop'] ?? false;
@endphp

<li class="list-group-item">
    <div class="row gutters-sm multiple-upload">
        @label([$label . " ({$width}x{$height})", $name, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']])
        <div class="col-xl-9">
            @inputImages([$name, $value, $attributes])
            @invalidFeedback([$name, $label])
        </div>
        @helper([$name, $helper])
    </div>
</li>