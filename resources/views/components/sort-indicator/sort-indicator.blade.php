<span class="ml-1">
    @if ($field === $sortField)
        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
    @else
        <i class="fas fa-sort-up"></i>
    @endif
</span>
