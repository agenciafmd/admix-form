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
    $quality = $attributes['quality'] ?? 85;
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
            {{ Form::file("media[{$name}]", $attributes) }}

            {{ Form::hidden("width[{$name}]", $width) }}
            {{ Form::hidden("height[{$name}]", $height) }}
            {{ Form::hidden("quality[{$name}]", $quality) }}
            {{ Form::hidden("crop[{$name}]", $crop) }}

            @include('agenciafmd/form::partials.invalid-feedback')
        </div>
        @include('agenciafmd/form::partials.helper')
    </div>
</li>

<!-- TODO: Atrelar este modal com o botão de alterar descrição
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
-->

@push('scripts')
    <script>
        $(function () {
            {{--var btnCust = '<button type="button" class="btn btn-sm btn-kv btn-outline-secondary kv-file-tags-{{ str_slug($attributes['id']) }}" title="Alterar descrição">' +--}}
            {{--    '<i class="fe fe-tag"></i>' +--}}
            {{--    '</button>';--}}
            var btnCust = ''; {{-- TODO --}}

            $("#{{ $attributes['id'] }}").fileinput({
                theme: "fe",
                language: "pt-BR",
                overwriteInitial: true,
                showClose: false,
                showUpload: false,
                showCancel: false,
                uploadUrl: '/',
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
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                minImageWidth: '{{ $width }}',
                minImageHeight: '{{ $height }}',
                fileActionSettings: {
                    showUpload: false,
                    showDrag: false,
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
            });

            $('.kv-file-tags-{{ str_slug($attributes['id']) }}').on('click', function() {
                var uuid = $(this).parents('.file-footer-buttons').find('.kv-file-remove').attr('data-key');

                $.get("{{ route('admix.media.meta', ['key' => '']) }}/" + uuid, function(data) {


                    // alertify.confirm('Descrição', data, function() {
                    //     var form = $('#formMediaMetaPost');
                    //
                    //     $.post(form.attr('action'), form.serialize()).done(function() {
                    //         alertify.success('Descrição atualizada!');
                    //     });
                    //
                    // },function(){
                    //     // alertify.error('Declined' + uuid);
                    // }).set({
                    //     labels: {
                    //         ok: 'Salvar',
                    //         cancel: 'Cancelar'
                    //     }
                    // });
                });
            });

            {{--$("#{{ $attributes['id'] }}").fileinput({--}}
            {{--    theme: 'fa',--}}
            {{--    language: 'pt-BR',--}}
            {{--    overwriteInitial: true,--}}
            {{--    showClose: false,--}}
            {{--    showUpload: false,--}}
            {{--    showCancel: false,--}}
            {{--    uploadUrl: '/',--}}
            {{--    browseLabel: '<i class="d-none d-sm-inline-block">Procurar</i>',--}}
            {{--    elErrorContainer: '#kv-wrapper-errors-{{ $attributes['id'] }}',--}}
            {{--    msgErrorClass: 'alert alert-block alert-danger',--}}
            {{--    layoutTemplates: {--}}
            {{--        main1: "{preview}\n" +--}}
            {{--            "<div class='input-group {class}'>\n" +--}}
            {{--            "   <div class='input-group-btn input-group-prepend'>\n" +--}}
            {{--            "       {browse}\n" +--}}
            {{--            "       {upload}\n" +--}}
            {{--            "   </div>\n" +--}}
            {{--            "   {caption}\n" +--}}
            {{--            "</div>",--}}
            {{--        actions: '<div class="file-actions">\n' +--}}
            {{--            '    <div class="file-footer-buttons">\n' +--}}
            {{--            '        {download} {upload} {delete} {zoom} {other} ' + btnCust +--}}
            {{--            '    </div>\n' +--}}
            {{--            '</div>\n' +--}}
            {{--            '{drag}\n' +--}}
            {{--            '<div class="clearfix"></div>',--}}
            {{--    },--}}
            {{--    allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],--}}
            {{--    minImageWidth: '{{ $width }}',--}}
            {{--    minImageHeight: '{{ $height }}',--}}
            {{--    fileActionSettings: {--}}
            {{--        showUpload: false,--}}
            {{--        showDrag: false,--}}
            {{--        removeIcon: '<i class="fa fa-close"></i>',--}}
            {{--        downloadIcon: '<i class="fa fa-download"></i>',--}}
            {{--        dragIcon: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="fa fa-arrows"></i></span>',--}}
            {{--        indicatorNew: '<span class="btn btn-sm btn-kv btn-outline-warning"><i class="fa fa-star"></i></span>',--}}
            {{--        indicatorSuccess: '<span class="btn btn-sm btn-kv btn-outline-success"><i class="fa fa-check"></i></span>',--}}
            {{--        indicatorError: '<span class="btn btn-sm btn-kv btn-outline-danger"><i class="fa fa-exclamation"></i></span>',--}}
            {{--        indicatorLoading: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="fa fa-spinner fa-pulse"></i></span>',--}}
            {{--    },--}}
            {{--    deleteUrl: '{{ route('admix.media.destroy') }}',--}}
            {{--    deleteExtraData: function () {--}}
            {{--        return {--}}
            {{--            _token: $('meta[name="csrf-token"]').attr('content')--}}
            {{--        };--}}
            {{--    },--}}
            {{--    previewZoomButtonIcons: {--}}
            {{--        prev: '<i class="fa fa-chevron-left"></i>',--}}
            {{--        next: '<i class="fa fa-chevron-right"></i>'--}}
            {{--    },--}}
            {{--    @if($value)--}}
            {{--    initialPreview: ['{{ (config("filesystems.default") == "cdn") ? config("filesystems.disks.cdn.url") . "/" . $value->name : Storage::url($value->name) }}'],--}}
            {{--    initialPreviewAsData: true,--}}
            {{--    initialPreviewDownloadUrl: '{{ (config("filesystems.default") == "cdn") ? config("filesystems.disks.cdn.url") . "/" : asset(Storage::url('')) }}{filename}',--}}
            {{--    initialPreviewConfig: [--}}
            {{--        {--}}
            {{--            caption: '{{ $value->name }}',--}}
            {{--            filename: '{{ $value->name }}',--}}
            {{--            downloadUrl: '{{ (config("filesystems.default") == "cdn") ? config("filesystems.disks.cdn.url") . "/" . $value->name : Storage::url($value->name) }}',--}}
            {{--            size: '{{ $value->size }}',--}}
            {{--            key: '{{ $value->uuid }}',--}}
            {{--        },--}}
            {{--    ],--}}
            {{--    @endif--}}
            {{--}).on('filesorted', function(e, params) {--}}
            {{--    console.log(params.stack);--}}
            {{--    var _token = $('meta[name="csrf-token"]').attr('content');--}}
            {{--    $.post('{{ route('admix.media.sort') }}', { _token: _token, stack: params.stack });--}}
            {{--    console.log('File sorted params', params);--}}
            {{--});--}}


            {{--$('.kv-file-tags-{{ str_slug($attributes['id']) }}').on('click', function() {--}}
            {{--    var uuid = $(this).parents('.file-footer-buttons').find('.kv-file-remove').attr('data-key');--}}

            {{--    $.get("{{ route('admix.media.meta', ['key' => '']) }}/" + uuid, function(data) {--}}
            {{--        alertify.confirm('Descrição', data, function() {--}}
            {{--            var form = $('#formMediaMetaPost');--}}

            {{--            $.post(form.attr('action'), form.serialize()).done(function() {--}}
            {{--                alertify.success('Descrição atualizada!');--}}
            {{--            });--}}

            {{--        },function(){--}}
            {{--            // alertify.error('Declined' + uuid);--}}
            {{--        }).set({--}}
            {{--            labels: {--}}
            {{--                ok: 'Salvar',--}}
            {{--                cancel: 'Cancelar'--}}
            {{--            }--}}
            {{--        });--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endpush