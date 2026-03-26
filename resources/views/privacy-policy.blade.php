<x-layouts.app :title="Lang::get('privacy policy')">
  <x-slot name="header">
    @lang('privacy policy')
  </x-slot>
  <x-slot name="slot">
    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center align-items-start flex-column">
        @lang('privacy policy content')
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-12">
        <h2>@lang('cookies used on this website')</h2>
        <p class="text-muted mb-3">@lang('cookie info last updated'): 2026-03-26</p>
        @cookieconsentinfo
      </div>
    </div>
  </x-slot>
</x-layouts.app>
