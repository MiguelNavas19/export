<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            color: #333;
        }
        .container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .greeting {
            font-size: 18px;
            font-weight: bold;
        }
        .closing {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Buenas tardes,<br>Un gusto en saludarles.</p>

        <p>Por favor, pueden apoyarnos con el estatus de impresión del BL <strong>{{ $bl }}</strong> y los días libres otorgados en destino.</p>

        <p class="closing">Quedamos atentos.<br>Saludos cordiales.</p>
    </div>
</body>
</html>
