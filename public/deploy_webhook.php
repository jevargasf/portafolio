<?php

$secret = 'deed379e55ae4af0ba8ccf063fc5bc25d7f44f3a741045172bb6138c9626b8ad';

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (empty($signature)) {
    http_response_code(403);
    die("Acceso denegado: Firma no proporcionada.");
}


$payload = file_get_contents('php://input');

$expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($expectedSignature, $signature)) {
    http_response_code(403);
    die("Acceso denegado: Firma inválida");
}

$output = shell_exec('sh /var/www/html/portafolio/deploy.sh > /dev/null 2>&1 &');

http_response_code(200);
echo "Despliegue autorizado y en proceso.";

?>
