
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'User Management System') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background: #1e293b;
            color: white;
            padding: 1rem;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: .5rem 1rem;
            border-radius: .25rem;
            margin-bottom: .25rem;
            text-decoration: none;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #334155;
        }
        .content {
            flex: 1;
            padding: 1rem;
            background: #f8fafc;
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="mb-4">Dashboard</h4>
        @php
            use App\Models\Menu;
            use Illuminate\Support\Str;
            $menus = Menu::orderBy('order')->get();
        @endphp
        @foreach ($menus as $menu)
            @can(Str::replace('-', ' ', $menu->name))
                <a href="{{ $menu->route ? route($menu->route) : '#' }}" 
                   class="{{ request()->routeIs($menu->route) ? 'active' : '' }}">
                    <i class="bi bi-{{ $menu->icon }}"></i> {{ $menu->name }}
                </a>
            @endcan
        @endforeach
        <hr>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
