<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Carta Renuncia {{ $dirigido }}</title>
    <style>
        .cuerpo {
        margin: 1rem 2.5rem; /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
        font-family: 'Calibri', sans-serif; /* Calibri como fuente principal y sans-serif como fuente secundaria */
        font-size: 14px; /* Tamaño de letra de 16 píxeles */

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
        <h1 style="font-size: 2em; text-transform: uppercase; color: gray;"><b>{{ $dirigido }}</b></h1>
    </div>

    <p align='right'>La Guaira, {{ now()->day }} de {{ strtoupper(now()->locale('es')->monthName) }} de {{ now()->year }}</p>


    <div>
        <p align='left'>Señores:</p>
        <p align='left'><b>GERENTE DE LA ADUANA PRINCIPAL DE LA GUAIRA (SENIAT)</b></p>
        <p align='left'><b>Presente.-</b></p>
        <p align='center'><b><u>CARTA RENUNCIA</u></b></p>

        <p class="indentado" align='justify'>Por medio de la presente nosotros, <b>{{ $dirigido }}</b>. basado en los art. Nro. 32 de la ley orgánica de aduana y 52 de la ley vigente,
            renunciamos a favor de los  Sres <b>{{ $exportacion->renuncia }}</b>. a su orden, la mercancía llegada a nuestra consignación según lo detallado a continuación:
        </p>

        <p class="indentado2" align='left'><b>VIAJE / BUQUE:</b> {{ $exportacion->motonave }}</p>
        <p class="indentado2" align='left'><b>GUIA / BL:</b> {{ $exportacion->bl }}</p>
        <p class="indentado2" align='left'><b>MERCANCIA:</b> MERCANCIA GENERAL</p>
        <p class="indentado2" align='left'><b>FECHA LLEGADA:</b>  {{ \Carbon\Carbon::parse($exportacion->eta)->format('d/m/Y') }}</p>

        <p class="indentado" align='justify'>Quedando entendido que todos los gastos que por cualquier concepto se deriven de la importación de mercancía, objeto de renuncia,
            son a cargo del beneficiario <b>{{ $exportacion->renuncia }}</b>, quedando <b>{{ $dirigido }}</b>., relevado de responsabilidades tanto por este concepto como por cualquier otro seleccionado con dicha importación.</p>
        <br>
        <p align='indentado'><b>AGENTE ADUANAL: MACHADO Y GUEDEZ, C.A</b></p>
        <p align='indentado'><b>N° DE REGISTRO: 203</b></p>
        <p class="indentado" align='justify'>Sin más que hacer referencia aprovechamos la ocasión para saludarle.</p>
        <p align='left'>Atentamente,</p>
    </div>
</body>

</html>
