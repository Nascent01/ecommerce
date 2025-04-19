@extends('admin.layout.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive card">
                    <table class="table table-bordered margin-bottom-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Created_at</th>
                                <th class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th class="text-center" scope="row">{{ $user->id }}</th>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->created_at }}</td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
