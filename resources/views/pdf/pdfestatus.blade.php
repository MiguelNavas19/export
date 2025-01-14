<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Estatus</title>
    <style>
        p {
            line-height: 1.5;
        }

        .cuerpo {
            /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
            font-family: 'Calibri', sans-serif;
            /* Calibri como fuente principal y sans-serif como fuente secundaria */
            font-size: 13px;
            /* Tamaño de letra de 16 píxeles */

        }

      table {
          font-size: 8px;
        width: 100%; /* La tabla ocupará el 100% del ancho del contenedor */
        max-width: 100%; /* No excederá el ancho del contenedor */
        border-collapse: collapse; /* Para que los bordes se vean bien */
        table-layout: auto; /* Permite que las columnas se ajusten al contenido */
    }
    th, td {
        padding: 8px; /* Espaciado interno */
        border: 1px solid black; /* Borde de las celdas */
        text-align: center; /* Centrar el texto */
        overflow: hidden; /* Oculta el desbordamiento */
        white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        text-overflow: ellipsis; /* Agrega '...' si el texto es demasiado largo */
    }
    thead {
        background: rgb(154, 224, 154); /* Color de fondo para el encabezado */
    }
    </style>
</head>

<body class="cuerpo">
    <div align='center'>
        <img width="80%" height="20%" src="{{ public_path() . '/storage/img/cabecera.png' }}">
    </div>

    <br>

    <div>
        <p align='justify'>
            Buenas tardes estimado <b>Cliente</b>
            <br>
            Reciba un cordial saludo junto a nuestros mejores deseos de salud y bienestar
        </p>
    </div>
    <div align='center'>
        <p align='center' style="background: rgb(154, 224, 154)">
            ESTATUS ACTUALIZADO EMBARQUES POR ARRIBAR
        </p>

        <table align="center">
            <thead>
                <tr>
                    <th>CLIENTE</th>
                    <th>EXPEDIENTE</th>
                    <th>CONSIGNATARIO</th>
                    <th>RENUNCIA</th>
                    <th>BL</th>
                    <th>CONTENEDOR</th>
                    <th>TIPO</th>
                    <th>ETA</th>
                    <th>MOTONAVE</th>
                    <th>LINEA / CONSOLIDADOR</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $datos)
                    <tr>
                        <td>{{ $datos->cliente }}</td>
                        <td>{{ $datos->expediente }}</td>
                        <td>{{ $datos->consignatario }}</td>
                        <td>{{ $datos->renuncia }}</td>
                        <td>{{ $datos->bl }}</td>
                        <td>{{ $datos->contenedor }}</td>
                        <td>{{ $datos->tipo }}</td>
                        <td>{{ $datos->eta }}</td>
                        <td>{{ $datos->motonave }}</td>
                        <td>{{ $datos->linea > 0 ? $datos->tipolinea->nombre : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
