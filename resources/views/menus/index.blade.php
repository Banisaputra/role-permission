@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Menu Management</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createMenuModal">
        + Add Menu
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Route</th><th>Icon</th><th>Parent</th><th>Order</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->route }}</td>
                    <td>{{ $menu->icon }}</td>
                    <td>{{ $menu->parent_id ? $menu->parent->name : '-' }}</td>
                    <td>{{ $menu->order }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMenuModal{{ $menu->id }}">Edit</button>
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete menu?')">Delete</button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form class="modal-content" method="POST" action="{{ route('menus.update', $menu) }}">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control mb-2" value="{{ $menu->name }}" required>
                                <input type="text" name="route" class="form-control mb-2" value="{{ $menu->route }}" placeholder="Route name">
                                <input type="text" name="icon" class="form-control mb-2" value="{{ $menu->icon }}" placeholder="Icon name (optional)">
                                <input type="number" name="order" class="form-control mb-2" value="{{ $menu->order }}">
                                <select name="parent_id" class="form-control">
                                    <option value="">No Parent</option>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}" {{ $parent->id == $menu->parent_id ? 'selected' : '' }}>
                                            {{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
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
<div class="modal fade" id="createMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('menus.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control mb-2" placeholder="Menu name" required>
                <input type="text" name="route" class="form-control mb-2" placeholder="Route name">
                <input type="text" name="icon" class="form-control mb-2" placeholder="Icon name (optional)">
                <input type="number" name="order" class="form-control mb-2" placeholder="Order">
                <select name="parent_id" class="form-control">
                    <option value="">No Parent</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
