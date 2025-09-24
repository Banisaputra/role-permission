@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">User Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Roles</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ implode(', ', $u->roles->pluck('name')->toArray()) }}</td>
                    <td>
                        <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
