<?php

namespace App\Http\Controllers;

use App\Mail\CorreoOrdenProcesada;
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
}
