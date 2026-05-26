<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel de Administración' }}</title>
    <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">
    @vite(['resources/css/app.scss'])
</head>
<body>
    <div class="dashboard__layout">
        <div class="dashboard__layout--sidebar">
            <x-nav.admin-sidebar/>
        </div>
        <main class="dashboard__layout--content">
            {{ $slot }}
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
    @stack('scripts')
</body>
</html>