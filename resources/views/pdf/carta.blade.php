<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Carta BL {{ $dirigido }}</title>
</head>
<style>
    .cuerpo {
    margin: 2rem 3.5rem; /* 2.5 unidades para arriba y abajo, 3 unidades para los lados */
    font-family: 'Calibri', sans-serif; /* Calibri como fuente principal y sans-serif como fuente secundaria */
    font-size: 15px; /* Tamaño de letra de 16 píxeles */

}
.indentado {
            text-indent: 30px; /* Cambia el valor según la cantidad de sangría que desees */
        }
p{
    line-height: 1.5;
}
</style>

<body class="cuerpo">
    <div align='center'>
        <img width="100%" height="15%" src="{{ public_path() . '/storage/img/cabecera.png' }}">
    </div>

    <br><br>

    <div>
        <p align='right'>Maiquetía, 18 de Octubre del 2024</p>
        <br>
        <p align='left'>Señores: {{ $dirigido }}</p>
        <p align='left'><b>{{ $exportacion->motonave }}</b></p>
        <p align='left'><b>{{ $exportacion->expediente }}</b></p>
        <br>
        <p align='right'>Ref. Autorización para el retiro de BL</p>

        <p class="indentado" align='justify'>Por medio de la presente nosotros, <b>MACHADO Y GUEDEZ, C.A</b>, Rif <b>J-00120803-8</b>, autorizamos a los ciudadanos:</p>
        <p align='center'><b>Luis E. Verde M. V. 19.852.898 / Steven Rojas. V-22.278.693</b></p>
        <p align='center'><b>Oswald Amundarain. V-18.535.483 / Edgar Vásquez. V-20.651.640</b></p>

        <p class="indentado" align='justify'>Al retiro del BL ORIGINAL correspondiente al embarque que se describe a continuación:</p>

        <p align='center'><b>CLIENTE: {{ $exportacion->consignatario }}</b></p>
        <p align='center'><b>BL: {{ $exportacion->bl }}</b></p>

        <p class="indentado" align='justify'>Sin más a que hacer referencia y agradeciendo la colaboración prestada, se despide.</p>
        <p align='left'>Dpto. de Atención al Cliente</p>

    </div>
</body>

</html>
