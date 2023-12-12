<textarea rows="5" class="form-control description-text-area" name="{{ $name }}">
    {{ $slot }}
                    </textarea>

<script>
  const textArea = document.querySelector('.description-text-area');
  CKEDITOR.replace(textArea, {
    removeButtons: removeButtons = 'Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize',
    allowedContent: true
  });
</script>

