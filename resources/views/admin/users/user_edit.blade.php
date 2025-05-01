@extends('admin.layout.layout')

@section('title', $user->id ? 'Edit User - ' . $user->name : 'Create User')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <form method="POST" action="{{ $user->id ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
            @csrf
            @if ($user->id)
                @method('PUT')
            @endif

            <x-form.input name="name" label="Name" type="text" :value="$user->name ?? ''" />

            <x-form.input name="email" label="Email" type="email" :value="$user->email ?? ''" />

            <x-form.input name="password" label="Password" type="password" value="" />

            <x-form.input name="password_confirmation" label="Confirm Password" type="password" value="" />

            <div class="row mt-4 justify-content-center">
                <div class="col-auto">
                    <button type="submit"
                        class="btn btn-success btn-sm px-4 shadow-none">{{ $user->id ? 'Update' : 'Save' }}</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-sm px-4 shadow-none">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
