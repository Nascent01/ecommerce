@php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $range = 1;
    $hasResults = $paginator->count() > 0; 
@endphp

@if ($paginator->hasPages() && $hasResults)
    <ul class="pagination pagination-primary mb-0 {{ $position ?? '' }}">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <button type="button" class="page-link px-3 shadow-none" wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                aria-label="Previous" @if ($paginator->onFirstPage()) disabled @endif>
                <i class="fas fa-arrow-left"></i>
            </button>
        </li>

        @for ($page = 1; $page <= $last; $page++)
            @if ($page == 1 || $page == $last || ($page >= $current - $range && $page <= $current + $range))
                <li class="page-item {{ $page == $current ? 'active' : '' }}">
                    <button type="button" class="page-link px-3 shadow-none" wire:click="gotoPage({{ $page }})"
                        wire:loading.attr="disabled">
                        {{ $page }}
                    </button>
                </li>
            @elseif ($page == 2 && $current - $range > 2)
                <li class="page-item disabled"><span class="page-link">…</span></li>
                @php $page = $current - $range - 1; @endphp
            @elseif ($page == $current + $range + 1 && $current + $range + 1 < $last)
                <li class="page-item disabled"><span class="page-link">…</span></li>
                @php $page = $last - 1; @endphp
            @endif
        @endfor

        <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
            <button type="button" class="page-link px-3 shadow-none" wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                aria-label="Next" @if (!$paginator->hasMorePages()) disabled @endif>
                <i class="fas fa-arrow-right"></i>
            </button>
        </li>
    </ul>
@endif
