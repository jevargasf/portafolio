<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación | {{ config('app.name') }}</title>
    
    <style>
        /* Reutilización de Variables de app.css */
        :root {
            --primary: #0F4C5C;
            --primary-hover: #09313b;
            --bg-body: #f8f9fa;
            --bg-card: #ffffff;
            --text-main: #212529;
            --text-muted: #6C757D;
            --success: #10B981;
            --danger: #EF4444;
            --font-code: 'JetBrains Mono', monospace;
            --font-body: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: var(--font-body);
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Estilo de Tarjeta (Basado en .form-admin y .verification-container) */
        .card-verification {
            width: 100%;
            max-width: 450px;
            background-color: var(--bg-card);
            border-bottom: 4px solid var(--primary); /* Estilo Hard Border de tu Navbar */
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            text-align: center;
        }

        /* Header con tipografía de marca (font-code) */
        .card-header {
            background-color: var(--bg-card);
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }

        .brand {
            font-family: var(--font-code);
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            font-size: 1.2rem;
            letter-spacing: -1px;
        }

        .content {
            padding: 3rem 2rem;
        }

        /* Iconografía basada en estados funcionales */
        .icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            line-height: 1;
        }

        .icon-success { color: var(--success); }
        .icon-error { color: var(--danger); }

        .message {
            font-size: 1.1rem;
            color: var(--text-main);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Botón Reutilizado (.btn-primary-custom) */
        .btn-primary-custom {
            display: inline-block;
            background-color: var(--primary);
            border: 2px solid var(--primary);
            color: white;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            font-family: var(--font-code);
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .footer {
            padding: 1.5rem;
            background-color: #fcfcfc;
            border-top: 1px solid #dee2e6;
        }

        .text-muted {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-family: var(--font-code);
        }
    </style>
</head>
<body>

    <div class="card-verification">
        <div class="card-header">
            <h1 class="brand">>_ lohumanoquemequeda</h1>
        </div>

        <div class="content">
            <div class="icon {{ str_contains($message, 'exitosamente') ? 'icon-success' : 'icon-error' }}">
                @if(str_contains($message, 'exitosamente'))
                    ✓
                @else
                    ✕
                @endif
            </div>

            <p class="message">
                {{ $message }}
            </p>

            <a href="{{ route('public.blog-personal') }}" class="btn-primary-custom">
                VOLVER AL INICIO
            </a>
        </div>

        <div class="footer">
            <p class="text-muted">
                &copy; {{ date('Y') }} — lohumanoquemequeda.blog
            </p>
        </div>
    </div>

</body>
</html>