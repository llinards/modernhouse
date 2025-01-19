<textarea rows="5" class="form-control description-text-area" name="{{ $name }}">
    {{ $slot }}
                    </textarea>

<script type="module">
  const LICENSE_KEY = 'GPL';
  const editorConfig = {
    toolbar: {
      items: [
        'sourceEditing',
        'showBlocks',
        '|',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'superscript',
        '|',
        'link',
        'blockQuote',
        '|',
        'bulletedList',
        'numberedList'
      ],
      shouldNotGroupWhenFull: false
    },
    plugins: [
      AutoLink,
      Autosave,
      BlockQuote,
      Bold,
      Essentials,
      Italic,
      Link,
      List,
      Paragraph,
      ShowBlocks,
      SourceEditing,
      Strikethrough,
      Superscript,
      TextTransformation,
      Underline
    ],
    licenseKey: LICENSE_KEY,
    link: {
      addTargetToExternalLinks: true,
      defaultProtocol: 'https://',
      decorators: {
        toggleDownloadable: {
          mode: 'manual',
          label: 'Downloadable',
          attributes: {
            download: 'file'
          }
        }
      }
    },
  };

  ClassicEditor.create(document.querySelector('.description-text-area'), editorConfig);
</script>

