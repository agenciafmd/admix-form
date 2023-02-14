@php
    $formControl = 'form-control custom-select';

    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');
    $attributes['id'] = $attributes['id'] ?? Str::slug($name);
    $maxSize = $attributes['maxSize'] ?? min(convert_bytes(ini_get('post_max_size')), convert_bytes(ini_get('upload_max_filesize')))/1024/2;
    unset($attributes['maxSize']);
@endphp

<li class="list-group-item">
    <div class="row gutters-sm single-upload">
        {{ Form::label("{$label}", null, ['class' => 'col-xl-3 col-form-label pt-0 pt-xl-2']) }}
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
                allowedFileExtensions: null,
                resizeImage: false,
                preferIconicPreview: true,
                previewFileIcon: '<i class="icon fe-file"></i>',
                fileActionSettings: {
                    showZoom: false,
                },
                uploadExtraData: function (previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                maxFileSize: '{{ $maxSize }}',
                @if (isset($value) && $value->getFirstMedia($name))
                initialPreview: ['{{ $value->getFirstMediaUrl($name) . '?' . uniqid() }}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    {
                        caption: '{{ $value->getFirstMedia($name)->name }}',
                        downloadUrl: '{{ $value->getFirstMediaUrl($name) . '?' . uniqid() }}',
                        size: '{{ $value->getFirstMedia($name)->size }}',
                        key: '{{ $value->getFirstMedia($name)->getCustomProperty('uuid') }}',
                    },
                ],
                @endif
            }).on("filebatchselected", function (event, files) {
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function (event, data) {
                el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][name]" value="' + data.response[0].name + '" />');
                el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][collection]" value="' + data.response[0].collection + '" />');
            }).on('filebatchuploaderror', function (event, data) {
                $('.kv-fileinput-error.file-error-message ul > li:last').remove();
            });
        });
    </script>
@endpush
