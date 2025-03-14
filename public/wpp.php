<?php
    // Cargar autoload de Composer
    require_once '/path/to/vendor/autoload.php';
    use Twilio\Rest\Client;

    // Tus credenciales de Twilio
    $sid    = "ACe9e8affbcd53f8a0125073a63fcd8922";  // Tu SID de Twilio
    $token  = "77b7f1a959cc9c11f6c64ddfc8b4ee53";     // Tu Auth Token de Twilio
    $twilio = new Client($sid, $token);               // Crear el cliente de Twilio

    // Número de WhatsApp de destino (debe ser el que esté vinculado a tu cuenta de Sandbox)
    $numeroDestino = "whatsapp:+5491138338669";      // Número de destino (remitente)

    // Número de WhatsApp de Twilio (remitente), este es el número de Sandbox
    $numeroTwilio  = "whatsapp:+14155238886";         // Número de Twilio

    // Enviar mensaje
    $message = $twilio->messages->create(
        $numeroDestino,  // Número de destino
        [
            'from' => $numeroTwilio,  // Número de WhatsApp de Twilio
            'body' => '¡Hola! Este es un mensaje de prueba desde Twilio.'
        ]
    );

    // Imprimir SID del mensaje
    echo "Mensaje enviado con SID: " . $message->sid;
?>
