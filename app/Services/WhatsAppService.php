<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $sid;
    protected $token;
    protected $twilio;

    public function __construct()
    {
        // SID y Token de Twilio
        $this->sid = env('TWILIO_SID');
        $this->token = env('TWILIO_AUTH_TOKEN');
        $this->twilio = new Client($this->sid, $this->token);
    }

    public function sendMessage($to, $message)
    {
        $from = env('TWILIO_WHATSAPP_NUMBER'); // Número de WhatsApp de Twilio

        $this->twilio->messages->create(
            "whatsapp:$to", // Número de destino (incluye el prefijo 'whatsapp:')
            [
                'from' => "whatsapp:$from", // Número de WhatsApp de Twilio
                'body' => $message
            ]
        );
    }
}
