<div>
    <div class="mt-5">
        <h5>Product Attribute Choices</h5>
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header bg-light d-flex align-items-center">
                    <i class="fas fa-filter me-2"></i>
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-10">
                            <label for="search-name" class="form-label">Choice Name</label>
                            <div class="input-group">
                                <input wire:model.live="choiceNameFilter" class="form-control" id="search-name"
                                    placeholder="Search by name">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-column justify-content-end">
                            <label class="form-label invisible">Reset</label>
                            <button wire:click="clearFilters()" class="btn btn-outline-secondary mt-0-2 shadow-none"
                                type="reset">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-header d-flex align-items-center justify-content-between">
            <button wire:click="openProductAttributeChoiceModal()" data-bs-toggle="modal"
                data-bs-target="#editChoiceModal" type="button" class="btn btn-primary btn-sm shadow-none">
                <i class="fas fa-plus me-2"></i>Add New Choice
            </button>
        </div>

        @if (!empty($productAttributeChoices))
            @foreach ($productAttributeChoices as $choice)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-5 mb-3">
                                <label class="form-label fw-medium text-muted small">Choice Name</label>
                                <input disabled type="text" name="name"
                                    class="form-control form-control-sm border-0 bg-light"
                                    value="{{ $choice->name ?? '' }}" placeholder="Enter choice name">
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label fw-medium text-muted small">Slug</label>
                                <input disabled type="text" name="slug"
                                    class="form-control form-control-sm border-0 bg-light"
                                    value="{{ $choice->slug ?? '' }}" placeholder="Enter slug">
                            </div>
                            <div class="col-md-1">
                                <button wire:click="openProductAttributeChoiceModal({{ $choice->id }})"
                                    data-bs-toggle="modal" data-bs-target="#editChoiceModal" type="button"
                                    class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm transition-all">
                                    <i class="fas fa-edit fs-6"></i>
                                    <span class="fw-medium">Edit</span>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button wire:click="deleteChoice({{ $choice->id }})" type="button"
                                    class="btn btn-outline-danger btn-sm d-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm transition-all">
                                    <i class="fas fa-trash"></i>
                                    <span class="fw-medium">Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if ($productAttributeChoices->hasPages())
        <div class="py-3 mx-3">
            <x-pagination :items="$productAttributeChoices" position="justify-content-end" />
        </div>
    @endif

    @include('livewire.admin.products.product-attributes._edit_product_attribute_choice_modal')
</div>
