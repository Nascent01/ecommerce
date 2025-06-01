@extends('admin.layout.layout')

@section('title', $role->id ? 'Edit Role - ' . $role->name : 'Create Role')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ $role->id ? 'Edit Role - ' . $role->name : 'Create Role' }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST"
                        action="{{ $role->id ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                        @csrf
                        @if ($role->id)
                            @method('PUT')
                        @endif

                        <x-form.input name="name" label="Name" type="text" :value="$role->name ?? ''" />

                        <x-form.input name="description" label="Description" type="text" :value="$role->description ?? ''" />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="permission_ids" class="form-control-label">Permissions</label>
                                    <select multiple class="form-control" name="permission_ids[]" id="permission_ids">
                                        @foreach ($permissions ?? [] as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ in_array($permission->id, $selectedPermissionIds ?? []) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('permission_ids')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 justify-content-center">
                            <div class="col-auto">
                                <button type="submit"
                                    class="btn btn-primary btn-sm px-4 shadow-none">{{ $role->id ? 'Update' : 'Save' }}</button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm px-4 shadow-none">Go
                                    back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
