<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Carta BL {{ $dirigido }}</title>
    <style>
        .cuerpo {
        margin: 2rem 3.5rem; /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
        font-family: 'Calibri', sans-serif; /* Calibri como fuente principal y sans-serif como fuente secundaria */
        font-size: 15px; /* Tamaño de letra de 16 píxeles */

    }
    .indentado {
                text-indent: 30px; /* Cambia el valor según la cantidad de sangría que desees */
            }
            .indentado2 {
                text-indent: 50px; /* Cambia el valor según la cantidad de sangría que desees */
            }
    p{
        line-height: 1.5;
    }
    </style>
</head>
<body class="cuerpo">
    <div align='center'>
        <img width="100%" height="15%" src="{{ public_path() . '/storage/img/cabecera.png' }}">
    </div>
    <br>
    <p align='right'>Maiquetía, {{ now()->day }} de {{ strtoupper(now()->locale('es')->monthName) }} de {{ now()->year }}</p>
    <br>

    <div>
        <p align='left'>Señores:</p>
        <p align='left'><b>{{ $dirigido }}</b></p>
        <br>
        <p align='right'>Ref. Autorización para el retiro de acta de recepción.</p>

        <p class="indentado" align='justify'>Por medio de la presente nosotros, <b>MACHADO Y GUEDEZ, C.A</b>, Rif <b>J-00120803-8</b>,
            autorizamos al ciudadano LUIS VERDE, titular de la cedula de Identidad V.- 19.852.898 al retiro del acta de recepción correspondiente al embarque que se describe a continuación:
        </p>

        <p class="indentado2" align='left'>CLIENTE: {{ $exportacion->consignatario }}</p>
        <p class="indentado2" align='left'>B/L N°: {{ $exportacion->bl }}</p>
        <p class="indentado2" align='left'>BUQUE: {{ $exportacion->motonave }}</p>
        <p class="indentado2" align='left'>CONTENEDOR: {{$exportacion->tipo.' '.$exportacion->contenedor }}</p>
        <p class="indentado2" align='left'>ETA:  {{ \Carbon\Carbon::parse($exportacion->eta)->format('d/m/Y') }}</p>

        <p class="indentado" align='justify'>Sin más a que hacer referencia y agradeciendo la colaboración prestada, se despide.</p>
<br><br>
        <p align='center'>Luis J. González</p>
        <p align='center'>Dpto. de Operaciones</p>
    </div>
</body>

</html>
