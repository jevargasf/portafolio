<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Suscripción</title>
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
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 450px; background-color: #ffffff; border-bottom: 4px solid #0F4C5C; border-radius: 8px; text-align: center;">
                    
                    <tr>
                        <td style="padding: 24px; border-bottom: 1px solid #dee2e6;">
                            <h1 style="margin: 0; color: #0F4C5C; font-family: 'JetBrains Mono', monospace; font-size: 19px; font-weight: 700; letter-spacing: -1px;">>_ lohumanoquemequeda</h1>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 48px 32px;">
                            <p style="margin: 0 0 32px 0; color: #212529; line-height: 1.6; font-size: 15px; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;">
                                Se ha solicitado una suscripción a este blog con tu dirección de correo electrónico. Para completar el proceso y recibir notificaciones de nuevas publicaciones, es necesario verificar tu identidad.
                            </p>
                            
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $urlVerificacion }}" class="btn-action" target="_blank" style="display: inline-block; padding: 10px 25px; background-color: #0F4C5C; border: 2px solid #0F4C5C; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-family: 'JetBrains Mono', monospace; font-size: 14px;">CONFIRMAR SUSCRIPCIÓN</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 24px; background-color: #fcfcfc; border-top: 1px solid #dee2e6; text-align: center;">
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