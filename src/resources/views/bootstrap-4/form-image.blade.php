<li class="list-group-item">
    <div class="row gutters-sm single-upload">
        <x-form-label :label="$label" :for="$name" class="col-xl-3 col-form-label pt-0 pt-xl-2"/>
        <div class="col-xl-5">
            <input {!! $attributes->merge([
                            'class' => 'form-control ' . ($hasError($name, 'admix') ? 'is-invalid' : ''),
                        ]) !!}
                   type="file"
                   name="file"
                   id="{{ $name }}"
            />
            <x-form-invalid-feedback :name="$name" :label="$label"/>
        </div>
        @if($attributes['title'])
            <x-form-help :name="$name" :message="$attributes['title']"/>
        @endif
    </div>
</li>

@push('scripts')
    <script>
        $(function () {
            var el = $("#{{ $name }}");
            el.fileinput({
                theme: "fe",
                language: "pt-BR",
                uploadExtraData: function (previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                maxImageWidth: '{{ $image['width']*1.2 }}', /* aceita 20% além do máximo permitido */
                maxImageHeight: '{{ $image['height']*1.2 }}',
                resizeImage: true,
                resizeImageQuality: '{{ number_format($image['quality']/100, 2, '.', '') }}',
                @if (isset($value) && $value->getFirstMedia($name))
                initialPreview: ['{{ $value->getFirstMediaUrl($name, $image['conversion']) }}'],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    {
                        caption: '{{ $value->getFirstMedia($name)->name }}',
                        downloadUrl: '{{ $value->getFirstMediaUrl($name, $image['conversion']) }}',
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
            });
        });
    </script>
@endpush