<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') &mdash; Medical Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f4f6f9; }
        .sidebar {
            width:250px; min-height:100vh; background:#1f2937; color:#cbd5e1;
            position:fixed; top:0; left:0; padding-top:0;
        }
        .sidebar .brand {
            padding:18px 20px; font-size:1.15rem; font-weight:700; color:#fff;
            border-bottom:1px solid rgba(255,255,255,.08); display:flex; align-items:center; gap:10px;
        }
        .sidebar .nav-link {
            color:#cbd5e1; padding:12px 20px; display:flex; align-items:center; gap:10px;
            border-left:3px solid transparent;
        }
        .sidebar .nav-link:hover { background:rgba(255,255,255,.05); color:#fff; }
        .sidebar .nav-link.active {
            background:rgba(59,130,246,.15); color:#fff; border-left-color:#3b82f6;
        }
        .content { margin-left:250px; padding:24px 32px; }
        .topbar {
            background:#fff; padding:14px 32px; margin:-24px -32px 24px;
            border-bottom:1px solid #e5e7eb; display:flex; align-items:center; justify-content:space-between;
        }
        .card { border:none; box-shadow:0 1px 3px rgba(0,0,0,.08); }
    </style>
</head>
<body>
    @php
        $navItems = [
            ['route' => 'bills',          'label' => 'Bills',         'icon' => 'bi-receipt'],
            ['route' => 'medical_stores', 'label' => 'Medical Stores','icon' => 'bi-shop'],
            ['route' => 'patients',       'label' => 'Patients',      'icon' => 'bi-person'],
            ['route' => 'medicines',      'label' => 'Medicines',     'icon' => 'bi-capsule'],
        ];
    @endphp
    <aside class="sidebar">
        <div class="brand"><i class="bi bi-hospital"></i> Medical Store</div>
        <nav class="nav flex-column mt-2">
            @foreach($navItems as $item)
                <a class="nav-link {{ request()->routeIs($item['route'].'*') ? 'active' : '' }}"
                   href="{{ route($item['route'].'.index') }}">
                    <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
