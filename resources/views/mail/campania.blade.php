<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
    <style>
        html,
        body {
            color: black;
        }

        table {
            border-collapse: collapse;
        }

        table thead {
            background: black;

        }

        table thead tr th {
            color: white;
        }

        table thead tr th,
        table tbody tr td {
            padding: 5px;
            text-align: center;
        }

        .bg-black {
            background: black;
            color: white;
        }

        .text-md {
            font-size: 1.3em;
        }
    </style>
</head>

<body>
    <h1>{{ $campania->nombre }}</h1>
    <p>{!! $mensaje !!}</p>
    @if (count($array_multimedias) > 0)
        @foreach ($array_multimedias as $item)
            <img src="{{ $item }}" alt="Imagen" width="100px">
        @endforeach
    @endif
</body>

</html>