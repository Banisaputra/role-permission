@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Role Management</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        + Add Role
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">
                            Edit
                        </button>
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form class="modal-content" method="POST" action="{{ route('roles.update', $role) }}">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control mb-3" required>
                                <label>Permissions</label>
                                <div class="row">
                                    @foreach($permissions as $perm)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $perm->name }}"
                                                    {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $perm->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control mb-3" placeholder="Role name" required>
                <label>Permissions</label>
                <div class="row">
                    @foreach($permissions as $perm)
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $perm->name }}">
                                <label class="form-check-label">{{ $perm->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
