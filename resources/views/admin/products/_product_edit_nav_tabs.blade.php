<div class="nav-wrapper position-relative end-0">
    <ul class="nav nav-pills nav-fill p-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#main-characteristics-tab" role="tab"
                aria-controls="preview" aria-selected="true">
                <i class="fas fa-list-alt"></i> Basic Info
            </a>
        </li>
        @if ($product->id)
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#product-attribute-choices-tab"
                    role="tab" aria-controls="code" aria-selected="false">
                    <i class="fas fa-tags"></i> Product Attributes
                </a>
            </li>
        @endif
    </ul>
</div>
