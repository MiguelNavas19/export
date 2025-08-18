<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>APENDI {{ $exportacion->consignatario }}</title>
    <style>
        .cuerpo {
            margin: 2rem 3rem;
        }

        p {
            line-height: 1.2;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body class="cuerpo">
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;text-indent:35.4pt;'>
        <strong><em><u><span style="font-size:27px;">{{ $exportacion->consignatario }}</span></u></em></strong>
    </p>
    <br>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:10px;font-family:"Times New Roman",serif;text-align:center;text-indent:35.4pt;'>
        <strong><em><u><span style="font-size:18px;">{{ $rif }}</span></u></em></strong>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;'>
        <span style="font-size:15px;color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span>
    </p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;text-indent:35.4pt;'>
        <span style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;&nbsp;</span><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>We, the
            undersigned</span><em>&nbsp;</em><em><span>{{ $exportacion->consignatario }}</span></em><em><span>
                {{ $direccion }}</span></em>
    </p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;text-indent:35.4pt;'>
        <span style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>being the receivers of the cargo
            mentioned on bill of lading number<em>&nbsp;</em></span><strong>;&nbsp;</strong><strong><span
                style='font-size:15px;font-family:"Arial",sans-serif;'>{{ $exportacion->bl }}</span></strong>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>hereby</span></em><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>&nbsp;acknowledge having received from:
            CMA CGM DE VENEZUELA, C.A. VALENCIA OFFICE <em><span style='font-family:"Arial",sans-serif;'>03</span></em>
            original bills of lading&nbsp;</span><strong><span
                style='font-size:15px;font-family:"Arial",sans-serif;'>{{ $exportacion->bl }}</span></strong><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>&nbsp; &nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>ON CARACAS
            {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;</span></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;&nbsp;</span></strong></em><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>JEFE DE OPERACIONES</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;'>&nbsp;</span></strong></em></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;font-style:normal;'>&nbsp;</span></strong></em>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;'><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;font-style:normal;'>&nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></strong></em><em><strong><span
                    style='font-size:13px;font-family:"Arial",sans-serif;font-style:normal;'>Company Stamp &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;Signature &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Position in the
                    company</span></strong></em></p>
</body>

</html>
