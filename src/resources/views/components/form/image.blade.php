@php
    $formControl = 'form-control custom-select';

    if(strpos(request()->route()->getName(), 'show') !== false) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
    $attributes['id'] = $attributes['id'] ?? Str::slug($name);

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
    <div class="row gutters-sm single-upload">
        {{ Form::label("{$label} ({$width}x{$height})", null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
        <div class="col-xl-5">
            {{ Form::file("file", $attributes) }}
            @include('agenciafmd/form::partials.invalid-feedback')
        </div>
        @include('agenciafmd/form::partials.helper')
    </div>
</li>

@push('scripts')
    <script>
        $(function () {
            var el = $("#{{ $attributes['id'] }}");
            el.fileinput({
                theme: "fe",
                language: "pt-BR",
                uploadExtraData: function(previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                maxImageWidth: '{{ $width*2 }}',
                maxImageHeight: '{{ $height*2 }}',
                resizeImage: true,
                resizeImageQuality: '{{ number_format($quality/100, 2, '.', '') }}',
                @if($value->getFirstMedia($name))
                initialPreview: ['{{ $value->getFirstMediaUrl($name, 'thumb') }}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    {
                        caption: '{{ $value->getFirstMedia($name)->name }}',
                        downloadUrl: '{{ $value->getFirstMediaUrl($name, 'thumb') }}',
                        size: '{{ $value->getFirstMedia($name)->size }}',
                        key: '{{ $value->getFirstMedia($name)->getCustomProperty('uuid') }}',
                    },
                ],
                @endif
                // }).on('fileselect', function(event, data) {
                //     if(el.parents('.file-input').find('.file-preview .file-preview-thumbnails').html().trim() !== '') {
                //         console.log('parou');
                //         event.preventDefault();
                //     }
            }).on("filebatchselected", function(event, files) {
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function(event, data) {
                el.parents('form').append('<input type="hidden" name="media[' + data.response.uuid + '][name]" value="' + data.response.name + '" />');
                el.parents('form').append('<input type="hidden" name="media[' + data.response.uuid + '][collection]" value="' + data.response.collection + '" />');
            });
        });
    </script>
@endpush
