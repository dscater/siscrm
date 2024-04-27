<?php

namespace App\Http\Controllers;

use App\Models\EnvioWhatsapp;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class EnviarWhatsappController extends Controller
{
    public static function enviarMensaje($mensaje, $numero)
    {
        $envio_whatsapp = EnvioWhatsapp::first();
        if ($envio_whatsapp) {
            $sid = $envio_whatsapp->sid;
            $from = $envio_whatsapp->from;
            $token = $envio_whatsapp->token;
            $twilio = new Client($sid, $token);

            // enviar el mensaje de twillio
            $message = $twilio->messages
                ->create(
                    "whatsapp:+591$numero", // to
                    array(
                        "from" => $from,
                        "body" => $mensaje
                    )
                );
            return $message->sid;
        }

        return false;
    }
}
