@props(['items'])

<ul class="pagination pagination-primary mb-0 {{ $position }}">

    <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link px-3 shadow-none" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
            <i class="fas fa-arrow-left"></i>
        </a>
    </li>

    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
        <li class="page-item {{ $items->currentPage() == $page ? 'active' : '' }}">
            <a class="page-link px-3 shadow-none" href="{{ $url }}">{{ $page }}</a>
        </li>
    @endforeach

    <li class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}">
        <a class="page-link px-3 shadow-none" href="{{ $items->nextPageUrl() }}" aria-label="Next">
            <i class="fas fa-arrow-right"></i>
        </a>
    </li>
</ul>
