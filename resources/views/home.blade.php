@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <p class="text-muted">Anda login sebagai <strong>{{ implode(', ', auth()->user()->roles->pluck('name')->toArray()) }}</strong></p>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <p class="fs-4">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Roles</h5>
                    <p class="fs-4">{{ \Spatie\Permission\Models\Role::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Permissions</h5>
                    <p class="fs-4">{{ \Spatie\Permission\Models\Permission::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Menus</h5>
                    <p class="fs-4">{{ \App\Models\Menu::count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
