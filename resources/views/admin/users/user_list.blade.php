@extends('admin.layout.layout')

@section('title', 'User list')

@section('content')
    <livewire:admin.users.user-list />
@endsection

@section('scripts')
    @parent
@endsection
