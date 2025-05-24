@props(['items'])

@php
    $current = $items->currentPage();
    $last = $items->lastPage();
    $range = 1;
@endphp

<ul class="pagination pagination-primary mb-0 {{ $position ?? '' }}">
    <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link px-3 shadow-none" href="{{ $items->previousPageUrl() }}" aria-label="Previous">
            <i class="fas fa-arrow-left"></i>
        </a>
    </li>

    @for ($page = 1; $page <= $last; $page++)
        @if ($page == 1 || $page == $last || ($page >= $current - $range && $page <= $current + $range))
            <li class="page-item {{ $page == $current ? 'active' : '' }}">
                <a class="page-link px-3 shadow-none" href="{{ $items->url($page) }}">{{ $page }}</a>
            </li>
        @elseif ($page == 2 && $current - $range > 2)
            <li class="page-item disabled"><span class="page-link">…</span></li>
            @php $page = $current - $range - 1; @endphp
        @elseif ($page == $current + $range + 1 && $current + $range + 1 < $last)
            <li class="page-item disabled"><span class="page-link">…</span></li>
            @php $page = $last - 1; @endphp
        @endif
    @endfor

    <li class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}">
        <a class="page-link px-3 shadow-none" href="{{ $items->nextPageUrl() }}" aria-label="Next">
            <i class="fas fa-arrow-right"></i>
        </a>
    </li>
</ul>
