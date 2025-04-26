@extends('admin.layout.layout')

@section('content')
    <livewire:admin.users.user-list />
@endsection

@section('scripts')
    @parent
    @vite('resources/js/admin/users/user-list.js')
@endsection
