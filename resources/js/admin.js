import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import 'livewire-sortable';
import {
  AutoLink,
  Autosave,
  BlockQuote,
  Bold,
  ClassicEditor,
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
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

window.FilePond = FilePond;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;
// window.LivewireSortable = livewireSortable;
window.ClassicEditor = ClassicEditor;
window.AutoLink = AutoLink;
window.Autosave = Autosave;
window.BlockQuote = BlockQuote;
window.Bold = Bold;
window.Essentials = Essentials;
window.Italic = Italic;
window.Link = Link;
window.List = List;
window.Paragraph = Paragraph;
window.ShowBlocks = ShowBlocks;
window.SourceEditing = SourceEditing;
window.Strikethrough = Strikethrough;
window.Superscript = Superscript;
window.TextTransformation = TextTransformation;
window.Underline = Underline;
