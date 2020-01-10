@php
  $name = $__data[0];
  $value = $__data[1] ?? null;
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

<input type="file" name="file" {!! attributesToString($attributes) !!}/>

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
          @if (!empty($value))
            @if ($value->getFirstMedia($name))
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
          @endif
        }).on("filebatchselected", function(event, files) {
          el.fileinput("upload");
        }).on('filebatchuploadsuccess', function(event, data) {
          el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][name]" value="' + data.response[0].name + '" />');
          el.parents('form').append('<input type="hidden" name="media[' + data.response[0].uuid + '][collection]" value="' + data.response[0].collection + '" />');
        });
      });
  </script>
@endpush