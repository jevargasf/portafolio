<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Panel de Administración' }}</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
    <main class="main__panel">
        {{ $slot }}
    </main>
    @stack('scripts')
</body>
</html>