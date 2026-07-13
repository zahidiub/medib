<?php
<!DOCTYPE html>
<html>
<head>
    <title>Medical Store App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Medical Store App</a>
            <div>
                <a class="nav-link" href="{{ route('medical_stores.index') }}">Medical Stores</a>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>