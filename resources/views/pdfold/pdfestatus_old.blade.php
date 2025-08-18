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
        font-size: 10px; /* Tamaño un poco más grande para mejor legibilidad */
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
        word-wrap: break-word;
    }
    
    th, td {
        padding: 4px;
        border: 1px solid black;
        text-align: center;
        white-space: normal; /* Permite saltos de línea */
        word-break: break-word; /* Rompe palabras largas */
        max-width: 120px; /* Ancho máximo para forzar ajuste */
        vertical-align: top; /* Alinea el contenido en la parte superior */
    }
    
    thead {
        background: rgb(154, 224, 154);
    }
    
    /* Ajustes específicos para columnas críticas */
    td:nth-child(1), th:nth-child(1) { /* CLIENTE */
        max-width: 100px;
    }
    
    td:nth-child(3), th:nth-child(3) { /* CONSIGNATARIO */
        max-width: 150px;
    }
    
    td:nth-child(9), th:nth-child(9) { /* MOTONAVE */
        max-width: 130px;
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
