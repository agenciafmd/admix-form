@php
    $name = $__data[0];
    $value = $__data[1];
    $attributes = $__data[2] ?? [];

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

<input type="file" name="file[]" {!! attributesToString($attributes) !!}/>

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
                maxImageWidth: '{{ $width*2 }}',
                maxImageHeight: '{{ $height*2 }}',
                resizeImage: true,
                resizeImageQuality: '{{ number_format($quality/100, 2, '.', '') }}',
                fileActionSettings: {
                    showDrag: true,
                },
                @if($value->getMedia($name)->count() > 0)
                initialPreview: ["{!! $value->getMedia($name)->map(function($item) { return asset($item->getUrl('thumb')); })->implode('", "') !!}"],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                        @foreach($value->getMedia($name) as $item)
                    {
                        caption: '{{ $item->name }}',
                        downloadUrl: '{{ asset($item->getUrl('thumb')) }}',
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
            });
        });
    </script>
@endpush
