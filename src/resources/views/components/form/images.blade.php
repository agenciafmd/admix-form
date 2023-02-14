@php
    $formControl = 'form-control custom-select';

    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
    $attributes['id'] = $attributes['id'] ?? Str::slug($name);
    $attributes['multiple'] = true;

    $modelName = strtolower(class_basename($value));
    $fields = config("upload-configs.{$modelName}.{$name}.sources.0");

    if (isset($attributes['config'])) {
      $fields = $attributes['config'];
      unset($attributes['config']);
    }

    $width = $fields['width'] ?? 800;
    $height = $fields['height'] ?? 600;
    $quality = $fields['quality'] ?? 92;
    $crop = $fields['crop'] ?? false;
    $conversion = $fields['conversion'] ?? 'thumb';
    $maxSize = $fields['maxSize'] ?: min(convert_bytes(ini_get('post_max_size')), convert_bytes(ini_get('upload_max_filesize')))/1024/2;

    $preview = null;
    if(isset($value)){
        $preview = ($value->getMedia($name)) ?? null;
    }
@endphp

<li class="list-group-item">
    <div class="row gutters-sm multiple-upload">
        {{ Form::label("{$label} ({$width}x{$height})", null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
        <div class="col-xl-9">
            {{ Form::file("file[]", $attributes) }}
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
                overwriteInitial: false,
                uploadExtraData: function (previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                maxImageWidth: '{{ $width*1.2 }}',
                maxImageHeight: '{{ $height*1.2 }}',
                resizeImage: true,
                resizeImageQuality: '{{ number_format($quality/100, 2, '.', '') }}',
                fileActionSettings: {
                    showDrag: true,
                },
                maxFileSize: '{{ $maxSize }}',
                @if ($preview->count() > 0)
                initialPreview: ['{!! $preview->map(fn($item) => asset($item->getUrl($conversion)) . '?' . uniqid())->implode("', '") !!}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                        @foreach($preview as $item)
                    {
                        caption: '{{ $item->name }}',
                        downloadUrl: '{{ asset($item->getUrl($conversion)) . '?' . uniqid() }}',
                        size: '{{ $item->size }}',
                        key: '{{ $item->getCustomProperty('uuid') }}'
                    },
                    @endforeach
                ],
                @endif
            }).on('filesorted', function (e, params) {
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.post('{{ route('admix.upload.sort') }}', {_token: _token, stack: params.stack});
            }).on("filebatchselected", function (event, files) {
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function (event, data) {
                for (i = 0; i < data.response.length; i++) {
                    el.parents('form').append('<input type="hidden" name="media[' + data.response[i].uuid + '][name][' + i + ']" value="' + data.response[i].name + '" />');
                    el.parents('form').append('<input type="hidden" name="media[' + data.response[i].uuid + '][collection][' + i + ']" value="' + data.response[i].collection + '" />');
                }
            }).on('filebatchuploaderror', function (event, data) {
                $('.kv-fileinput-error.file-error-message ul > li:last').remove();
            });
        });
    </script>
@endpush
