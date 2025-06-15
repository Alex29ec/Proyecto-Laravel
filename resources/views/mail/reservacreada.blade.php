<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #000000;
        }

        .info {
            margin-top: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación de tu reserva</h1>
        <p>Hola {{ $reserva->cliente->name }},</p>

        <p>Gracias por reservar con nosotros. Aquí tienes los detalles de tu cita:</p>

        <div class="info">
            <p><strong>Tatuador:</strong> {{ $reserva->tatuador->nombre }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}</p>
            <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
        </div>

        @if ($reserva->foto_referencia)
            <p><strong>Foto de referencia:</strong></p>
            <img src="{{ asset('storage/' . $reserva->foto_referencia) }}" alt="Foto de referencia" style="width:100%; max-width: 300px;">
        @endif

        <div class="footer">
            <p>Si tienes alguna duda o necesitas modificar tu cita, contáctanos respondiendo este correo.</p>
            <p>Gracias por confiar en Tattoo Studio.</p>
        </div>
    </div>
</body>
</html>
