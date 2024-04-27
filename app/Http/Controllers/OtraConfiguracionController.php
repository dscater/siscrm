<?php

namespace App\Http\Controllers;

use App\Models\ApiMap;
use App\Models\EnvioCorreo;
use App\Models\EnvioWhatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtraConfiguracionController extends Controller
{
    public function index()
    {
        $api_map = ApiMap::first();
        $envio_correo = EnvioCorreo::first();
        $envio_whatsapp = EnvioWhatsapp::first();

        return response()->JSON([
            "api_map" => $api_map,
            "envio_correo" => $envio_correo,
            "envio_whatsapp" => $envio_whatsapp,
        ]);
    }

    public function store(Request $request)
    {

        $validacion = [
            'google_maps' => 'required',
            'map_id' => 'required',
            "host" => "required",
            "puerto" => "required",
            "encriptado" => "required",
            "email" => "required",
            "nombre" => "required",
            "password" => "required",
            "driver" => "required",
            "sid" => "required",
            "token" => "required",
            "from" => "required",
            "url_phone" => "required",
        ];
        $mensajes =  [
            'google_maps.required' => 'Este campo es obligatorio',
            'map_id.required' => 'Este campo es obligatorio',
            'host.required' => 'Este campo es obligatorio',
            'puerto.required' => 'Este campo es obligatorio',
            'encriptado.required' => 'Este campo es obligatorio',
            'email.required' => 'Este campo es obligatorio',
            'nombre.required' => 'Este campo es obligatorio',
            'password.required' => 'Este campo es obligatorio',
            'driver.required' => 'Este campo es obligatorio',
            'sid.required' => 'Este campo es obligatorio',
            'token.required' => 'Este campo es obligatorio',
            'from.required' => 'Este campo es obligatorio',
            'url_phone.required' => 'Este campo es obligatorio',
        ];

        $request->validate($validacion, $mensajes);

        DB::beginTransaction();
        try {
            $api_map = ApiMap::first();
            $envio_correo = EnvioCorreo::first();
            $envio_whatsapp = EnvioWhatsapp::first();
            if ($api_map) {
                $api_map->update([
                    "google_maps" => $request->google_maps,
                    "map_id" => $request->map_id,
                ]);
            } else {
                $api_map = ApiMap::create([
                    "google_maps" => $request->google_maps,
                    "map_id" => $request->map_id,
                ]);
            }

            if ($envio_correo) {
                $envio_correo->update([
                    "host" => $request->host,
                    "puerto" => $request->puerto,
                    "encriptado" => $request->encriptado,
                    "email" => $request->email,
                    "nombre" => $request->nombre,
                    "password" => $request->password,
                    "driver" => $request->driver,
                ]);
            } else {
                $envio_correo = EnvioCorreo::create([
                    "host" => $request->host,
                    "puerto" => $request->puerto,
                    "encriptado" => $request->encriptado,
                    "email" => $request->email,
                    "nombre" => $request->nombre,
                    "password" => $request->password,
                    "driver" => $request->driver,
                ]);
            }


            if ($envio_whatsapp) {
                $envio_whatsapp->update([
                    "sid" => $request->sid,
                    "token" => $request->token,
                    "from" => $request->from,
                    "url_phone" => $request->url_phone,
                ]);
            } else {
                $envio_whatsapp = EnvioWhatsapp::create([
                    "sid" => $request->sid,
                    "token" => $request->token,
                    "from" => $request->from,
                    "url_phone" => $request->url_phone,
                ]);
            }

            DB::commit();
            return response()->JSON([
                'sw' => true,
                'msj' => 'Los datos se actualizarón de forma correcta',
                'api_map' => $api_map,
                'envio_correo' => $envio_correo,
                'envio_whatsapp' => $envio_whatsapp,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'sw' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}