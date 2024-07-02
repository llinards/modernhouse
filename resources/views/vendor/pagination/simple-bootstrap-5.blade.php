@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagina tion Navigation">
    <ul class="pagination mt-4 mb-0 d-flex justify-content-center flex-wrap gap-0 gap-sm-2">
      @if ($paginator->hasMorePages())
        <li class="page-item mb-2 mb-md-0 order-1 order-sm-2">
          <a class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center "
             href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('next') !!} &#8594;</a>
        </li>
      @endif
      @if (!$paginator->onFirstPage())
        <li class="page-item order-2 order-sm-1">
          <a class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center "
             href="{{ $paginator->previousPageUrl() }}" rel="prev">
            &#8592; {!! __('back') !!}
          </a>
        </li>
      @endif
    </ul>
  </nav>
@endif
