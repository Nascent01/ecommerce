@extends('admin.layout.layout')

@section('title', 'Role list')

@section('content')
    <livewire:admin.auth.roles.role-list />
@endsection

@section('scripts')
    @parent
@endsection
