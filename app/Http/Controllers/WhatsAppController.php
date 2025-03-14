<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendMessage()
    {
        // Credenciales de Twilio
        $sid    = "ACe9e8affbcd53f8a0125073a63fcd8922"; // Tu SID de Twilio
        $token  = "77b7f1a959cc9c11f6c64ddfc8b4ee53";  // Tu Auth Token de Twilio
        $twilio = new Client($sid, $token);           // Crear el cliente de Twilio

        // Números de WhatsApp
        $numeroDestino = "whatsapp:+5491138338669";  // Número de destino (remitente)
        $numeroTwilio  = "whatsapp:+14155238886";     // Número de Twilio (remitente)

        // Enviar el mensaje
        $message = $twilio->messages->create(
            $numeroDestino,  // Número de destino
            [
                'from' => $numeroTwilio,  // Número de WhatsApp de Twilio
                'body' => '¡Hola! Este es un mensaje de prueba desde Twilio.'
            ]
        );

        // Retornar el SID del mensaje
        return "Mensaje enviado con SID: " . $message->sid;
    }
}
