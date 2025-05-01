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
                        <label for="search-name" class="form-label"><i class="fas fa-user me-1"></i> Name</label>
                        <div class="input-group">
                            <input wire:model.live="name" class="form-control" id="search-name"
                                placeholder="Search by name">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="search-email" class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
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
                    <div class="py-3 mx-1 justify-content-end d-flex">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-none mb-0">
                            <i class="fas fa-user me-2"></i>Add User
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
                                <th wire:click.prevent="sortBy('email')" class="text-center cursor-pointer"
                                    scope="col">Email
                                    <x-sort-indicator field="email" :sortField="$sortField" :sortDirection="$sortDirection" />
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
                            @forelse ($users as $user)
                                <tr>
                                    <th class="text-center" scope="row">{{ $user->id }}</th>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}</td>
                                    <td class="text-center">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary shadow-none">
                                                <i class="fas fa-edit"></i></button>
                                            <button wire:click="openUserRolesModal({{ $user->id }})"
                                                data-bs-toggle="modal" data-bs-target="#assignRolesModal" type="button"
                                                class="btn btn-info shadow-none">
                                                <i class="fas fa-user-plus"></i></button>
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
                    @if ($users->hasPages())
                        <div class="py-3 mx-1">
                            <x-pagination :items="$users" position="justify-content-end" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('livewire.admin.users._assign_role_modal')
</div>
