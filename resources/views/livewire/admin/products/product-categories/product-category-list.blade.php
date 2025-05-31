<div>
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="fas fa-filter me-2"></i>
                <h5 class="mb-0">Filters</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="search-name" class="form-label">Name</label>
                        <div class="input-group">
                            <input wire:model.live="name" class="form-control" id="search-name"
                                placeholder="Search by name">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="search-active">Status</label>
                            <select class="form-control" id="search-active" wire:model.live="isActive">
                                <option value="">All</option>
                                <option value="active">Show active</option>
                                <option value="not-active">Show inactive</option>
                            </select>
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

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.flash_messages')
                <div class="table-responsive card">
                    <div class="py-3 mx-3 justify-content-start d-flex">
                        <a href="{{ route('admin.product-categories.create') }}"
                            class="btn btn-primary shadow-none mb-0">
                            <i class='fas fa-th-large me-2'></i>Add Product Category
                        </a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th wire:click.prevent="sortBy('id')" class="text-center cursor-pointer" scope="col">
                                    ID
                                    <x-sort-indicator field="id" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th wire:click.prevent="sortBy('name')" class="text-center cursor-pointer"
                                    scope="col">Name
                                    <x-sort-indicator field="name" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th wire:click.prevent="sortBy('is_active')" class="text-center cursor-pointer"
                                    scope="col">Active
                                    <x-sort-indicator field="is_active" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th wire:click.prevent="sortBy('created_at')" class="text-center cursor-pointer"
                                    scope="col">
                                    Created
                                    <x-sort-indicator field="created_at" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productCategories as $productCategory)
                                <tr wire:key="{{ $productCategory->id }}">
                                    <th class="text-center w-5-perc" scope="row">{{ $productCategory->id }}</th>
                                    <td class="text-center w-40-perc">{{ $productCategory->name }}</td>
                                    <td class="text-center w-1-perc">
                                        <button wire:click="toggleActive({{ $productCategory->id }})"
                                            class="btn btn-icon btn-2 {{ $productCategory->is_active ? 'btn-outline-success' : 'btn-outline-danger' }} shadow-none"
                                            type="button">
                                            <span class="btn-inner--icon"><i
                                                    class="fas {{ $productCategory->is_active ? 'fa-check' : 'fas fa-times' }} fa-lg"></i></span>
                                        </button>
                                    </td>
                                    <td class="text-center w-10-perc">
                                        {{ Carbon\Carbon::parse($productCategory->created_at)->format('d.m.Y') }}</td>
                                    <td class="text-center w-10-perc">
                                        <div class="text-center">
                                            <a href="{{ route('admin.product-categories.edit', $productCategory->id) }}"
                                                type="button" class="btn btn-primary shadow-none">
                                                <i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">No results found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-3 mx-3">
                        {{ $productCategories->links('custom-pagination-links') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
