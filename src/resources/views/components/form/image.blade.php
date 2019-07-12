@php
    $formControl = 'form-control custom-select';

    if(strpos(request()->route()->getName(), 'show') !== false) {
        $formControl = 'form-control-plaintext';
        $attributes['disabled'] = true;
    }

    $attributes['class'] = $formControl . ' ' . ($errors->admix->has($name) ? 'is-invalid ' : '') . (($attributes['class']) ?? '');

    $attributes['id'] = $attributes['id'] ?? str_slug($name);
    $attributes['crop'] = $attributes['crop'] ?? true;

    $width = $attributes['width'] ?? 800;
    $height = $attributes['height'] ?? 600;
    $quality = $attributes['quality'] ?? 92;
    $crop = $attributes['crop'] ? 'true' : 'false';

    unset($attributes['width']);
    unset($attributes['height']);
    unset($attributes['quality']);
    unset($attributes['crop']);

@endphp

<li class="list-group-item">
    <div class="row gutters-sm">
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
            var btnCust = '<button type="button" class="btn btn-sm btn-kv btn-outline-secondary kv-file-tags-{{ Str::slug($attributes['id']) }}" title="Alterar descrição">' +
                '<i class="fe fe-tag"></i>' +
                '</button>';

            var el = $("#{{ $attributes['id'] }}");
            el.fileinput({
                theme: "fe",
                language: "pt-BR",
                overwriteInitial: true,
                showClose: false,
                showUpload: false,
                showCancel: false,
                showBrowse: false,
                uploadAsync: false,
                browseOnZoneClick: true,
                uploadUrl: '{{ route('admix.media.upload') }}',
                uploadExtraData: function(previewId, index) {
                    return {
                        key: index,
                        collection: '{{ $name }}'
                    };
                },
                layoutTemplates: {
                    main1: "{preview}\n" +
                        "<div class='input-group {class}'>\n" +
                        "   <div class='input-group-btn input-group-prepend'>\n" +
                        "       {browse}\n" +
                        "       {upload}\n" +
                        "   </div>\n" +
                        "   {caption}\n" +
                        "</div>",
                    actions: '<div class="file-actions">\n' +
                        '    <div class="file-footer-buttons">\n' +
                        '        {download} {upload} {delete} {zoom} {other} ' + btnCust +
                        '    </div>\n' +
                        '</div>\n' +
                        '{drag}\n' +
                        '<div class="clearfix"></div>',
                    size: '<span>({sizeText})</span>',

                },
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                resizeImage: true,
                maxImageWidth: '{{ $width }}',
                maxImageHeight: '{{ $height }}',
                resizePreference: 'height',
                resizeImageQuality: 0.{{ $quality }},
                minImageWidth: '{{ $width }}',
                minImageHeight: '{{ $height }}',
                fileActionSettings: {
                    showUpload: false,
                    showDrag: false,
                    dragIcon: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="fe fe-move"></i></span>',
                    indicatorNew: '<span class="btn btn-sm btn-kv btn-outline-warning"><i class="fe fe-star"></i></span>',
                    indicatorSuccess: '<span class="btn btn-sm btn-kv btn-outline-success"><i class="fe fe-check"></i></span>',
                    indicatorError: '<span class="btn btn-sm btn-kv btn-outline-danger"><i class="fe fe-alert-triangle"></i></span>',
                    indicatorLoading: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="fe fe-spinner fe-loader"></i></span>',
                },
                deleteUrl: '{{ route('admix.media.destroy') }}',
                deleteExtraData: function () {
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                },
                @if($value)
                    initialPreview: ['{{ Storage::url($value->name) }}'],
                    initialPreviewAsData: true,
                    initialPreviewDownloadUrl: '{{ asset(Storage::url('')) }}{filename}',
                    initialPreviewConfig: [
                        {
                            caption: '{{ $value->name }}',
                            filename: '{{ $value->name }}',
                            downloadUrl: '{{ Storage::url($value->name) }}',
                            size: '{{ $value->size }}',
                            key: '{{ $value->uuid }}',
                        },
                    ],
                @endif
            // }).on('fileselect', function(event, data) {
            //     if(el.parents('.file-input').find('.file-preview .file-preview-thumbnails').html().trim() !== '') {
            //         console.log('parou');
            //         event.preventDefault();
            //     }
            }).on("filebatchselected", function(event, files) {
                // triga o upload assim que o arquivo é enviado
                el.fileinput("upload");
            }).on('filebatchuploadsuccess', function(event, data) {
                //console.log(data);
                el.parents('form').append('<input type="hidden" name="media[' + data.response.uuid + '][name]" value="' + data.response.name + '" />');
                el.parents('form').append('<input type="hidden" name="media[' + data.response.uuid + '][collection]" value="' + data.response.collection + '" />');
            });

            $('.kv-file-tags-{{ Str::slug($attributes['id']) }}').on('click', function() {
                var uuid = $(this).parents('.file-footer-buttons').find('.kv-file-remove').attr('data-key');
                var modal = $("#modalMediaMetaPost");

                $.get("{{ route('admix.media.meta', ['key' => '']) }}/" + uuid, function(data) {
                    modal.find('.modal-body').html(data);
                    modal.modal('show');
                });

                modal.find('.btn-primary').off('click').on('click', function () {
                    var form = $("#formMediaMetaPost");
                    $.post(form.attr('action'), form.serialize()).done(function() {
                        modal.modal('hide');

                        $.toast({
                            title: 'Atenção',
                            content: 'Item atualizado com sucesso',
                            type: 'success',
                            delay: 3000,
                            pause_on_hover: true
                        });
                    });
                });

            });
        });
    </script>
@endpush