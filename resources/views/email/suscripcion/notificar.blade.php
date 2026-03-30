<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Publicación</title>
    <style>
        /* Degradación elegante para clientes de correo con soporte de hojas de estilo internas */
        .btn-action:hover {
            background-color: #09313b !important;
            border-color: #09313b !important;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed; background-color: #f8f9fa;">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-bottom: 4px solid #0F4C5C; border-radius: 8px; text-align: left;">
                    
                    <tr>
                        <td style="padding: 30px; border-bottom: 1px solid #dee2e6;">
                            <h1 style="margin: 0; color: #0F4C5C; font-size: 22px; font-weight: 700;">Nueva Entrada Publicada</h1>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 30px; color: #495057; font-size: 16px; line-height: 1.6;">
                            <h2 style="margin-top: 0; margin-bottom: 15px; color: #212529; font-size: 20px;">{{ $tituloEntrada }}</h2>
                            <p style="margin-top: 0; margin-bottom: 25px;">{{ $bajadaEntrada }}</p>
                            
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('blog-personal.entrada', ['slug' => $slugEntrada]) }}" class="btn-action" target="_blank" style="display: inline-block; padding: 12px 30px; background-color: #0F4C5C; border: 2px solid #0F4C5C; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-family: 'JetBrains Mono', monospace; font-size: 14px;">LEER ARTÍCULO</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 24px; background-color: #fcfcfc; border-top: 1px solid #dee2e6; text-align: center;">
                            <p style="margin: 0 0 10px 0; color: #6C757D; font-size: 12px; font-family: 'JetBrains Mono', monospace;">
                                Recibes este mensaje porque estás suscrito a las actualizaciones del blog.<br>
                                Si deseas dejar de recibir estas notificaciones, puedes utilizar la opción de desuscripción de tu cliente de correo.
                            </p>
                            <p style="margin: 0; color: #6C757D; font-size: 13px; font-family: 'JetBrains Mono', monospace;">
                                &copy; {{ date('Y') }} — lohumanoquemequeda.blog
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>