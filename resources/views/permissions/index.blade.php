@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Permission Management</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
        + Add Permission
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $perm)
                <tr>
                    <td>{{ $perm->name }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPermissionModal{{ $perm->id }}">
                            Edit
                        </button>
                        <form action="{{ route('permissions.destroy', $perm) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this permission?')">Delete</button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editPermissionModal{{ $perm->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form class="modal-content" method="POST" action="{{ route('permissions.update', $perm) }}">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Permission</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control" value="{{ $perm->name }}" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Modal --}}
<div class="modal fade" id="createPermissionModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('permissions.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control" placeholder="Permission name" required>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
