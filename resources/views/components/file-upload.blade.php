<input class="form-control file-upload" type="file" id="{{ $name }}" name="{{ $name }}[]" required="{{ $required }}">

<script type="module">
  const fileUpload = document.getElementById('{{$name}}');
  const fileId = fileUpload.getAttribute('id');
  FilePond.registerPlugin(FilePondPluginFileValidateType);
  FilePond.registerPlugin(FilePondPluginImagePreview);
  FilePond.registerPlugin(FilePondPluginFileValidateSize);
  const options = {
    server: {
      url: '/admin/upload',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    },
    allowFileSizeValidation: true,
    allowReorder: true,
    allowImagePreview: true,
  };
  const optionsConfig = {
    "gallery-images": {
      labelIdle: 'Pievienot bildes vai video',
      maxFileSize: '50MB',
      acceptedFileTypes: ['image/*', 'video/mp4'],
      allowMultiple: true
    },
    "product-cover-photo": {
      labelIdle: 'Pievienot bildi',
      maxFileSize: '500KB',
      acceptedFileTypes: ['image/*']
    },
    "product-cover-video": {
      labelIdle: 'Pievienot video',
      maxFileSize: '50MB',
      acceptedFileTypes: ['video/mp4']
    },
    "news-images": {
      labelIdle: 'Pievienot bildes',
      maxFileSize: '500KB',
      acceptedFileTypes: ['image/*'],
      allowMultiple: true
    },
    "news-attachments": {
      labelIdle: 'Pievienot pielikumus',
      maxFileSize: '50MB',
      acceptedFileTypes: ['application/pdf'],
      allowMultiple: true
    },
    "product-variant-images": {
      labelIdle: 'Pievienot bildes',
      maxFileSize: '500KB',
      acceptedFileTypes: ['image/*'],
      allowMultiple: true
    }
  };
  if (optionsConfig[fileId]) {
    Object.assign(options, optionsConfig[fileId]);
  }
  options.required = fileUpload.getAttribute('required') === 'true';
  FilePond.create(fileUpload, options);
</script>
