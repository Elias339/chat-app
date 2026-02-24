<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KOTHA BARTA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    @vite(['resources/js/app.js'])
</head>
<body>

<div class="container-fluid chat-container">
    <div class="row h-100">

        <!-- Sidebar -->
        @include('dashboard.layouts.sidebar')

        <!-- Chat Area -->
        @yield('content')

    </div>
</div>

</body>
</html>
