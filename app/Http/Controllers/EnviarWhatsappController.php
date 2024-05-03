<?php

namespace App\Http\Controllers;

use App\Models\EnvioWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class EnviarWhatsappController extends Controller
{
    public static function enviarMensaje($mensaje, $numero)
    {
        $envio_whatsapp = EnvioWhatsapp::first();
        if ($envio_whatsapp) {
            // enviar el mensaje de twillio
            // $sid = $envio_whatsapp->sid;
            // $from = $envio_whatsapp->from;
            // $token = $envio_whatsapp->token;
            // $twilio = new Client($sid, $token);
            // $message = $twilio->messages
            //     ->create(
            //         "whatsapp:+591$numero", // to
            //         array(
            //             "from" => $from,
            //             "body" => "Your appointment is coming up on July 21 at 3PM"
            //         )
            //     );

            // VONAGE-NEXMO
            $apiKey = $envio_whatsapp->sid;
            $apiSecret = $envio_whatsapp->token;
            $fromNumber = $envio_whatsapp->from;
            $toNumber = "591" . $numero;
            $data = array(
                'from' => $fromNumber,
                'to' => $toNumber,
                'message_type' => 'text',
                'text' => $mensaje,
                'channel' => 'whatsapp'
            );

            $ch = curl_init('https://messages-sandbox.nexmo.com/v1/messages');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));
            curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':' . $apiSecret);

            $response = curl_exec($ch);
            curl_close($ch);
            Log::debug("*******************************");
            Log::debug($response);
            return $response;
        }

        return false;
    }

    public static function enviarMensajeMultimedia($mensaje, $numero, $array_multimedia)
    {
        $envio_whatsapp = EnvioWhatsapp::first();
        if ($envio_whatsapp) {
            $res = self::enviarMensaje($mensaje, $numero);

            foreach ($array_multimedia as $am) {
                self::enviarImagenes($am, $numero);
            }

            return true;
        }

        return false;
    }

    public static function enviarImagenes($url_imagen, $numero)
    {

        $envio_whatsapp = EnvioWhatsapp::first();
        if ($envio_whatsapp) {
            $apiKey = $envio_whatsapp->sid;
            $apiSecret = $envio_whatsapp->token;
            $fromNumber = $envio_whatsapp->from;
            $toNumber = "591" . $numero;
            $data = array(
                'from' => $fromNumber,
                'to' => $toNumber,
                'message_type' => 'image',
                'image' => [
                    "url" => $url_imagen,
                    "caption" => $url_imagen,
                ],
                'channel' => 'whatsapp'
            );

            $ch = curl_init('https://messages-sandbox.nexmo.com/v1/messages');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));
            curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':' . $apiSecret);

            $response = curl_exec($ch);
            return true;
        }
        return false;
    }
}
