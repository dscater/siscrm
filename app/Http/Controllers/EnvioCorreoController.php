<?php

namespace App\Http\Controllers;

use App\Mail\CampaniaMail;
use App\Mail\CorreoOrdenProcesada;
use App\Mail\CorreoRecuperacion;
use App\Mail\MensajePortal;
use App\Models\Configuracion;
use App\Models\EnvioCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class EnvioCorreoController extends Controller
{
    public static function mensajeOrdenProcesada($orden_pedido)
    {
        $envio_correo = EnvioCorreo::first();
        if ($envio_correo) {
            // Configurar el servicio de correo con la configuración de Gmail dinámicamente
            Config::set([
                'mail.mailers.smtp.host' => $envio_correo->host,
                'mail.mailers.smtp.port' => $envio_correo->puerto,
                'mail.mailers.smtp.encryption' => $envio_correo->encriptado,
                'mail.mailers.smtp.username' => $envio_correo->email,
                'mail.mailers.smtp.password' => $envio_correo->password,
                'mail.from.address' => $envio_correo->email,
                'mail.from.name' => $envio_correo->nombre,
            ]);

            Mail::to($orden_pedido->user->cliente->correo)
                ->send(new CorreoOrdenProcesada($orden_pedido, $orden_pedido->orden_detalles));

            return true;
        }
        return false;
    }

    public static function mensajeRecuperacion($correo, $mensaje)
    {
        $envio_correo = EnvioCorreo::first();
        if ($envio_correo) {
            // Configurar el servicio de correo con la configuración de Gmail dinámicamente
            Config::set([
                'mail.mailers.smtp.host' => $envio_correo->host,
                'mail.mailers.smtp.port' => $envio_correo->puerto,
                'mail.mailers.smtp.encryption' => $envio_correo->encriptado,
                'mail.mailers.smtp.username' => $envio_correo->email,
                'mail.mailers.smtp.password' => $envio_correo->password,
                'mail.from.address' => $envio_correo->email,
                'mail.from.name' => $envio_correo->nombre,
            ]);

            Mail::to($correo)
                ->send(new CorreoRecuperacion($mensaje));

            return true;
        }
        return false;
    }

    public static function mensajeCampania($correo, $campania, $mensaje, $array_multimedias)
    {
        $envio_correo = EnvioCorreo::first();
        if ($envio_correo) {
            // Configurar el servicio de correo con la configuración de Gmail dinámicamente
            Config::set([
                'mail.mailers.smtp.host' => $envio_correo->host,
                'mail.mailers.smtp.port' => $envio_correo->puerto,
                'mail.mailers.smtp.encryption' => $envio_correo->encriptado,
                'mail.mailers.smtp.username' => $envio_correo->email,
                'mail.mailers.smtp.password' => $envio_correo->password,
                'mail.from.address' => $envio_correo->email,
                'mail.from.name' => $envio_correo->nombre,
            ]);

            Mail::to($correo)
                ->send(new CampaniaMail($campania, $mensaje, $array_multimedias));

            return true;
        }
        return false;
    }

    public function correo_portal(Request $request)
    {

        $request->validate([
            "nombre" => "required|min:2",
            "asunto" => "required|min:2",
            "correo" => "required|min:2|email",
            "mensaje" => "required|min:2",
        ], [
            "nombre.required" => "Este campo es obligatorio",
            "nombre.min" => "Debes ingresar al menos :min caracteres",

            "asunto.required" => "Este campo es obligatorio",
            "asunto.min" => "Debes ingresar al menos :min caracteres",

            "correo.required" => "Este campo es obligatorio",
            "correo.email" => "Debes ingresar un correo valido",
            "correo.min" => "Debes ingresar al menos :min caracteres",

            "mensaje.required" => "Este campo es obligatorio",
            "mensaje.min" => "Debes ingresar al menos :min caracteres",
        ]);

        try {
            $envio_correo = EnvioCorreo::first();
            $configuracion = Configuracion::first();
            Config::set([
                'mail.mailers.smtp.host' => $envio_correo->host,
                'mail.mailers.smtp.port' => $envio_correo->puerto,
                'mail.mailers.smtp.encryption' => $envio_correo->encriptado,
                'mail.mailers.smtp.username' => $envio_correo->email,
                'mail.mailers.smtp.password' => $envio_correo->password,
                'mail.from.address' => $envio_correo->email,
                'mail.from.name' => $envio_correo->nombre,
            ]);


            $datos = [
                "nombre" => $request->nombre,
                "asunto" => $request->asunto,
                "correo" => $request->correo,
                "fono" => $request->fono,
                "mensaje" => $request->mensaje,
            ];

            Mail::to($configuracion->correo)
                ->send(new MensajePortal($datos));


            return response()->JSON([
                "message" => "Tu mensaje se envío con éxito"
            ], 200);
        } catch (\Exception $e) {
            return response()->JSON([
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
