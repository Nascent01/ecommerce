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
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input wire:model.live="name" class="form-control" id="search-name"
                                placeholder="Search by name">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="search-email" class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input wire:model.live="email" class="form-control" id="search-email"
                                placeholder="Search by email">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex flex-column justify-content-end">
                        <label class="form-label invisible">Reset</label>
                        <button class="btn btn-outline-secondary mt-0-2" type="reset">
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
                <div class="table-responsive card">
                    <table class="table table-bordered margin-bottom-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Created</th>
                                <th class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th class="text-center" scope="row">{{ $user->id }}</th>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->created_at }}</td>
                                    <td class="text-center">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                style="margin-right: 8px;"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
