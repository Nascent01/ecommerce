@props(['field', 'sortField', 'sortDirection'])

@if ($field === $sortField)
    @if ($sortDirection === 'asc')
        <i class="fa fa-sort-up"></i>
    @else
        <i class="fa fa-sort-down"></i>
    @endif
@endif
