<x-layouts.app :title="Lang::get('faq')">
  <x-slot name="header">
    @lang('faq')
  </x-slot>
  <x-slot name="slot">
    <x-faq/>
  </x-slot>
</x-layouts.app>
