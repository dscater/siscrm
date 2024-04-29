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
                        "body" => "Your appointment is coming up on July 21 at 3PM"
                    )
                );
            return $message->sid;
        }

        return false;
    }

    public static function enviarMensajeMultimedia($mensaje, $numero, $array_multimedia)
    {
        $envio_whatsapp = EnvioWhatsapp::first();
        if ($envio_whatsapp) {
            $sid = $envio_whatsapp->sid;
            $from = $envio_whatsapp->from;
            $token = $envio_whatsapp->token;
            $twilio = new Client($sid, $token);

            // Enviar el mensaje de texto
            $messageOptions = array(
                "from" => $from,
                "body" => $mensaje
            );

            // Si tienes imágenes para enviar,  Fagregar las URLs de las imágenes
            if (!empty($array_multimedia)) {
                $mediaUrls = [];
                foreach ($array_multimedia as $imagenURL) {
                    $mediaUrls[] = $imagenURL;
                }
                $messageOptions["mediaUrls"] = $mediaUrls;
            }

            // Enviar el mensaje con las imágenes
            $message = $twilio->messages->create("whatsapp:+591$numero", $messageOptions);

            return $message->sid;
        }

        return false;
    }
}
