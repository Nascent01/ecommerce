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
                        <label for="search-email" class="form-label">Sku</label>
                        <div class="input-group">
                            <input wire:model.live="email" class="form-control" id="search-email"
                                placeholder="Search by email">
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
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-none mb-0">
                            <i class='fas fa-box me-2'></i>Add Product
                        </a>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th wire:click.prevent="sortBy('id')" class="text-center cursor-pointer" scope="col">
                                    ID
                                    <x-sort-indicator field="id" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th class="text-center cursor-pointer">Image</th>
                                <th wire:click.prevent="sortBy('sku')" class="text-center cursor-pointer"
                                    scope="col">Sku
                                    <x-sort-indicator field="sku" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th wire:click.prevent="sortBy('name')" class="text-center cursor-pointer"
                                    scope="col">Name
                                    <x-sort-indicator field="name" :sortField="$sortField" :sortDirection="$sortDirection" />
                                </th>
                                <th wire:click.prevent="sortBy('price')" class="text-center cursor-pointer"
                                    scope="col">Price
                                    <x-sort-indicator field="price" :sortField="$sortField" :sortDirection="$sortDirection" />
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
                            @forelse ($products as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <th class="text-center w-1-perc" scope="row">{{ $product->id }}</th>
                                    <td class="text-center w-20-perc">
                                        <img src="{{ asset('themes/custom/images/placeholder-image.jpg') }}"
                                            alt="No Image" class="img-fluid rounded shadow-sm product-thumbnail"
                                            style="height: auto; object-fit: contain; background-color: #f8f9fa;">
                                    </td>
                                    <td class="text-center w-20-perc">{{ $product->sku }}</td>
                                    <td class="text-center w-20-perc">{{ $product->name }}</td>
                                    <td class="text-center w-20-perc">{{ $product->price }}</td>
                                    <td class="text-center w-1-perc">
                                        <button wire:click="toggleActive({{ $product->id }})"
                                            class="btn btn-icon btn-2 {{ $product->is_active ? 'btn-outline-success' : 'btn-outline-danger' }} shadow-none"
                                            type="button">
                                            <span class="btn-inner--icon"><i
                                                    class="fas {{ $product->is_active ? 'fa-check' : 'fas fa-times' }} fa-lg"></i></span>
                                        </button>
                                    </td>
                                    <td class="text-center w-10-perc">
                                        {{ Carbon\Carbon::parse($product->created_at)->format('d.m.Y') }}</td>
                                    <td class="text-center w-20-perc">
                                        <div class="text-center">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" type="button"
                                                class="btn btn-primary shadow-none">
                                                <i class="fas fa-edit"></i></a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow-none"
                                                    onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
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
                    @if ($products->hasPages())
                        <div class="py-3 mx-3">
                            <x-pagination :items="$products" position="justify-content-end" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
