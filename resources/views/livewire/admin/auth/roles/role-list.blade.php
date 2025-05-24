<div>
    <div class="container-fluid py-4">
        <div class="card mb-4">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="fas fa-filter me-2"></i>
                <h5 class="mb-0">Filters</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-10">
                        <label for="search-name" class="form-label">Name</label>
                        <div class="input-group">
                            <input wire:model.live="name" class="form-control" id="search-name"
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

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.flash_messages')
                <div class="table-responsive card">
                    <div class="py-3 mx-3 justify-content-start d-flex">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary shadow-none mb-0">
                            <i class="fas fa-id-badge me-2"></i> Add Role
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
                                <th wire:click.prevent="sortBy('description')" class="text-center cursor-pointer"
                                    scope="col">Description
                                    <x-sort-indicator field="description" :sortField="$sortField" :sortDirection="$sortDirection" />
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
                            @forelse ($roles as $role)
                                <tr wire:key="{{ $role->id }}">
                                    <th class="text-center w-1-perc" scope="row">{{ $role->id }}</th>
                                    <td class="text-center w-20-perc">{{ $role->name }}</td>
                                    <td class="text-center w-40-perc">{{ $role->description }}</td>
                                    <td class="text-center w-20-perc">
                                        {{ Carbon\Carbon::parse($role->created_at)->format('d.m.Y') }}</td>
                                    <td class="text-center w-20-perc">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary shadow-none">
                                                <i class="fas fa-edit"></i></button>
                                            <button wire:click="openRolePermissionsModal({{ $role->id }})"
                                                data-bs-toggle="modal" data-bs-target="#assaignPermissionModal"
                                                type="button" class="btn btn-info shadow-none">
                                                <i class="fas fa-user-cog"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger shadow-none"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No results found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-3 mx-3">
                        {{ $roles->links('custom-pagination-links') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.admin.auth.roles._assign_permissions_modal')
</div>
