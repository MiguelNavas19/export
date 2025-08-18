<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Carta Renuncia {{ $dirigido }}</title>
    <style>
        .cuerpo {
            margin: 1rem 2.5rem;
            /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
            font-family: 'Calibri', sans-serif;
            /* Calibri como fuente principal y sans-serif como fuente secundaria */
            font-size: 14px;
            /* Tamaño de letra de 16 píxeles */

        }

        .indentado {
            text-indent: 30px;
            /* Cambia el valor según la cantidad de sangría que desees */
        }

        .indentado2 {
            text-indent: 50px;
            /* Cambia el valor según la cantidad de sangría que desees */
        }

        p {
            line-height: 1.5;
        }
    </style>
</head>

<body class="cuerpo">
    <div align='center'>
        <h1 style="font-size: 2em; text-transform: uppercase; color: gray;"><b>{{ $dirigido }}</b></h1>
    </div>

    <p align='right'>Guanta, {{ now()->day }} de {{ strtoupper(now()->locale('es')->monthName) }} de
        {{ now()->year }}</p>


    <div>
        <p align='left'>Ciudadano:</p>
        <p align='left'><b>CARLOS ARMANDO RESPLANDOR DIAZ</b></p>
        <p align='left'><b>GERENTE DE LA ADUANA PRINCIPAL</b></p>
        <p align='left'><b>DE GUANTA - PUERTO LA CRUZ </b></p>
        <p align='left'>Su Despacho</p>

        <p class="indentado" align='justify'>
            Por medio de la presente y en conformidad con el Artículo No.
            52 de la Ley Decreto Constituyente de Reforma del Decreto con Rango,
            Valor y Fuerza de Ley Orgánica de Aduanas y 102 de su Reglamento, tengo el gusto de
            <b>RENUNCIAR</b> a favor de, <b>{{ $exportacion->renuncia }}</b>, portadora del Rif
            <b>{{ $rif }}</b>, la mercancía llegada a mi consignación, la cual le detallamos a continuación:


        </p>

        <p class="indentado2" align='left'><b>BUQUE:</b> {{ $exportacion->motonave }}</p>
        <p class="indentado2" align='left'><b>B/L:</b> {{ $exportacion->bl }}</p>
        <p class="indentado2" align='left'><b>FECHA:</b>
            {{ \Carbon\Carbon::parse($exportacion->eta)->format('d/m/Y') }}</p>
        <p class="indentado2" align='left'><b>PESO:</b> {{ $exportacion->peso }}</p>
        <p class="indentado2" align='left'><b>CANTIDAD:</b>({{ $exportacion->tipo }}) {{ $exportacion->contenedor }}
        </p>
        <p class="indentado2" align='left'>{{ $exportacion->cantidad_equipos }}
        </p>

        <p class="indentado" align='justify'>Sin otro particular, a que hacer referencia queda de Usted.</p>
        <p align='left'>Atentamente,</p>


        <p align='center'><b>Suarez Quiñonez Carlos Eduardo </b></p>
        <p align='center'><b>V-10.502.116</b></p>
    </div>
</body>

</html>
