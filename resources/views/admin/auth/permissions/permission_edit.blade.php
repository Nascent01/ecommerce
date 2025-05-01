@extends('admin.layout.layout')

@section('title', $permission->id ? 'Edit Permission - ' . $permission->name : 'Create Permission')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <form method="POST" action="{{ $permission->id ? route('admin.permissions.update', $permission->id) : route('admin.permissions.store') }}">
            @csrf
            @if ($permission->id)
                @method('PUT')
            @endif

            <x-form.input name="name" label="Name" type="text" :value="$permission->name ?? ''" />

            <x-form.input name="description" label="Description" type="text" :value="$permission->description ?? ''" />

            <div class="row mt-4 justify-content-center">
                <div class="col-auto">
                    <button type="submit"
                        class="btn btn-success btn-sm px-4 shadow-none">{{ $permission->id ? 'Update' : 'Save' }}</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-info btn-sm px-4 shadow-none">Go back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
