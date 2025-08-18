<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Carta BL {{ $dirigido }}</title>
    <style>
        .cuerpo {
            margin: 1rem 1rem;
            /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
            font-family: 'Calibri', sans-serif;
            /* Calibri como fuente principal y sans-serif como fuente secundaria */
            font-size: 14px;
            /* Tamaño de letra de 16 píxeles */

        }

        .content {
            flex: 1 0 auto;
        }

        .indentado {
            text-indent: 30px;
            /* Cambia el valor según la cantidad de sangría que desees */
        }

        .indentado1 {
            text-indent: 30px;
            line-height: 0.01px;
        }

        .indentado2 {
            text-indent: 80px;
            line-height: 0.01px;
        }


        /* Estilo para el pie de página fijo */
        .footer {
            position: fixed;
            bottom: 20px;
            right: 0;
            left: 0;
            text-align: right;
            font-size: 10px;
            padding-right: 25px;
            /* Ajusta según tus márgenes */
        }

        /* Aumentar margen inferior para evitar solapamiento */
        @page {
            margin-bottom: 120px;
            /* Debe ser mayor que la altura del footer */
        }

        body {
            margin-bottom: 100px;
            /* Espacio reservado para el footer */
        }
    </style>
</head>

<body class="cuerpo">
    <div class="indentado1" align='justify'>
        <img width="30%" height="10%" src="{{ public_path() . '/storage/img/mgasociados.png' }}">
    </div>
    <div style="font-size: 10px;">
        <p align='justify' style="line-height: 0.01px">Consultores Generales del Comercio Internacional, C.A.</p>
        <p class="indentado1" align='justify'>Agentes de Aduana – Agentes Logísticos</p>
        <p class="indentado2" align='justify'>RIF J-08505621-1</p>
        <p class="indentado2" align='justify'>Registro N° 543</p>
    </div>
    <br>
    <p align='left'>Maiquetía, {{ now()->day }} de {{ strtoupper(now()->locale('es')->monthName) }} de
        {{ now()->year }}</p>
    <br>

    <div>
        <p align='left'>Señores:</p>
        <p align='left'><b>{{ $dirigido }}</b></p>
        <br>
        <p align='right'>Ref. Autorización para el retiro de acta de recepción.</p>
        <br>
        <p class="indentado" align='justify'>Por medio de la presente nosotros, M.G & ASOCIADOS CONSULTORES GENERALES
            DEL COMERCIO INTERNACIONAL, C.A., Rif J-08505621-1,
            autorizamos al ciudadano NELSON PERDOMO, titular de la cedula de Identidad V.- 16.115.999 al retiro del acta
            de
            recepción correspondiente al embarque que se describe a continuación:
        </p>
        <br>

        <p align='center'><b>CLIENTE: {{ $exportacion->consignatario }}</b></b></p>
        <p align='center'><b>B/L N°: {{ $exportacion->bl }}</b></p>
        <p align='center'><b>CONTENEDOR: {{ $exportacion->tipo . ' ' . $exportacion->contenedor }}</b></p>

        <br>
        <p align='center'>Sin más a que hacer referencia y agradeciendo la colaboración prestada, se
            despide.</p>
        <br><br>

    </div>

    <div class="footer">
        <div style="display: inline-block; text-align: left; line-height: 0.1; width: auto;">
            <p>Calle 2da. Transversal, Edificio Mirua, Piso 2, Local 2-1,</p>
            <p>Urbanización Miramar, Municipio Vargas - Estado La Guaira.</p>
            <p>Teléfono: (0212) 331.89.22 - (0412) 168.04.48</p>
            <p>Email: administracionmg@mgasociadosve.com</p>
            <p>Email: mglagauira@mgasociadosve.com</p>
        </div>
    </div>
</body>

</html>
