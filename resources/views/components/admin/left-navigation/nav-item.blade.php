@props(['title', 'link', 'active', 'image'])

<li class="nav-item">
    <a class="nav-link {{ !empty($active) ? 'active' : '' }}" href="{{ $link }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        {!! $image !!}
      </div>
      <span class="nav-link-text ms-1">{{ $title }}</span>
    </a>
</li>