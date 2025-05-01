@extends('admin.layout.layout')

@section('title', 'Permission list')

@section('content')
    <livewire:admin.auth.permissions.permission-list />
@endsection

@section('scripts')
    @parent
@endsection
