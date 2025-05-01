@props(['message', 'type', 'icon', 'color'])

<div class="alert {{ $color }} alert-dismissible fade show" role="alert">
    <span class="alert-icon">{!! $icon !!}</span>
    <span class="alert-text">{{ $message }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
