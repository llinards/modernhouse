<x-layouts.app :title="Lang::get('privacy policy')">
  <x-slot name="header">
    <h1 class="text-center text-uppercase title">@lang('privacy policy')</h1>
  </x-slot>
  <x-slot name="content">
    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center align-items-start flex-column">
        @lang('privacy policy content')
      </div>
    </div>
  </x-slot>
</x-layouts.app>
