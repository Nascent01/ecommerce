@extends('admin.layout.layout')

@section('title', $role->id ? 'Edit Role - ' . $role->name : 'Create Role')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <form method="POST" action="{{ $role->id ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
            @csrf
            @if ($role->id)
                @method('PUT')
            @endif

            <x-form.input name="name" label="Name" type="text" :value="$role->name ?? ''" />

            <x-form.input name="description" label="Description" type="text" :value="$role->description ?? ''" />

            <div class="row mt-4 justify-content-center">
                <div class="col-auto">
                    <button type="submit"
                        class="btn btn-success btn-sm px-4 shadow-none">{{ $role->id ? 'Update' : 'Save' }}</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-info btn-sm px-4 shadow-none">Go back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
