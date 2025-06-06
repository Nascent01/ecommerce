<div wire:ignore.self class="modal fade" id="assaignPermissionModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="saveRolePermissions" id="assignRoleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input wire:model="selectedPermissions" class="form-check-input" type="checkbox"
                                value="{{ $permission->id }}" id="role-{{ $permission->id }}">
                            <label class="form-check-label" for="role-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @error('selectedRoles')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-primary shadow-none">Save changes</button>
                    <button type="button" class="btn bg-gradient-secondary shadow-none"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
