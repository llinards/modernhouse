@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagina tion Navigation">
    <ul class="pagination mt-4 mb-0 d-flex justify-content-center flex-wrap gap-0 gap-md-2">
      @if ($paginator->hasMorePages())
        <li class="page-item mb-2 mb-md-0 order-1 order-md-2">
          <a class="btn btn-primary d-flex justify-content-center align-items-center "
             href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('next') !!}</a>
        </li>
      @endif
      @if (!$paginator->onFirstPage())
        <li class="page-item order-2 order-md-1">
          <a class="btn btn-primary d-flex justify-content-center align-items-center "
             href="{{ $paginator->previousPageUrl() }}" rel="prev">
            {!! __('back') !!}
          </a>
        </li>
      @endif
    </ul>
  </nav>
@endif
