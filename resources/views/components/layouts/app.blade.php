<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Portafolio Javier Vargas' }}</title>
    @vite(['resources/css/app.scss'])
</head>
<body class="layout">
    <x-nav.navbar/>
    <div class="layout__main wrapper">
        {{ $slot }}
    </div>
    <x-nav.footer :perfil=$perfil />
    <script src="{{ asset('js/public/nav.js') }}"></script>
    @stack('scripts')
</body>
</html>