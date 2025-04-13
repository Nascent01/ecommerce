@extends('admin.layout.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive card">
            <table class="table table-bordered margin-bottom-0">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($users as $user)
                <tr>
                  <th scope="row">{{ $user->id }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>
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