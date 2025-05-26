@extends('admin.layout.layout')

@section('title', $user->id ? 'Edit User - ' . $user->name : 'Create User')

@section('content')
    <div class="container-fluid py-4">
        @include('partials.flash_messages')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $user->id ? 'Edit User - ' . $user->name : 'Create User' }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ $user->id ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                                @csrf
                                @if ($user->id)
                                    @method('PUT')
                                @endif

                                <x-form.input name="name" label="Name" type="text" :value="$user->name ?? ''" />

                                <x-form.input name="email" label="Email" type="email" :value="$user->email ?? ''" />

                                <x-form.input name="password" label="Password" type="password" value="" />

                                <x-form.input name="password_confirmation" label="Confirm Password" type="password"
                                    value="" />

                                <div class="row mt-4 justify-content-center">
                                    <div class="col-auto">
                                        <button type="submit"
                                            class="btn btn-primary btn-sm px-4 shadow-none">{{ $user->id ? 'Update' : 'Save' }}</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="btn btn-light btn-sm px-4 shadow-none">Go back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
