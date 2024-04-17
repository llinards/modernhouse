<x-layouts.app-secondary :title="Lang::get('faq')">
  <x-slot name="header">
    @lang('faq')
  </x-slot>
  <x-slot name="content">
    <x-faq/>
  </x-slot>
</x-layouts.app-secondary>
