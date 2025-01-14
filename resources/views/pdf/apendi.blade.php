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
    <h4 style='margin-right:0cm;margin-left:0cm;font-size:14px;font-family:"Times New Roman",serif;'><span
            style='font-family:"Arial",sans-serif;'>ZHEJLANG RIFFLE AUTO PARTS CO, LTD&nbsp;</span></h4>
    <h4 style='margin-right:0cm;margin-left:0cm;font-size:13px;font-family:"Times New Roman",serif;'><u><span
                style='font-size:13px;font-family:"Arial",sans-serif;color:black;font-weight:normal;'>_____________________________________________________________________</span></u>
    </h4>
    <h4 style='margin-right:0cm;margin-left:0cm;font-size:14px;font-family:"Times New Roman",serif;'><span
            style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>Date:<span>{{ now()->format('d/m/Y') }}</span>
        </span></h4>
    <span style='margin-right:0cm;margin-left:0cm;font-size:14px;font-family:"Times New Roman",serif;'>To : CMA CGM S.A.
        -4, Quaid&apos;Arenc - 13002 Marseille, France</span>
    <br><br>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>Dear Sirs,</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-indent:35.4pt;'>
        <strong><span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>RE: Bill of Lading
                no.</span></strong>
        <strong><span style='font-size:14px;font-family:"Arial",sans-serif;'>;{{ $exportacion->bl }}</span></strong>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-indent:35.4pt;'>
        <strong>&nbsp;</strong><span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>With a view to
            speeding up the process of delivery of the Goods and avoiding the costs and risks of dispatch of the Bill of
            Lading to the consignee, we are asking you to issue this document at destination.</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>Subsequently, you have agreed, upon our
            express demand, to provide us with a copy of the Bill of Lading (front and back with the general
            conditions)&nbsp;as hereto attached.</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>Therefore, while we acknowledge having
            indeed received, read and approved the full terms and conditions stated in the Bill of Lading, including all
            mentions whether handwritten, typed, printed or stamped, and confirm that these terms and conditions fully
            bind us and while we further express our irrevocable and unconditional acceptance thereof by affixing our
            initials and stamp on both sides of the copy of the Bill of Lading hereto attached, without any reservation
            whatsoever, we now urge you to surrender the original copy of the Bill of Lading directly to the following
            consignee:</span>
    </p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;text-indent:35.4pt;'>
        <strong><em><u><span>{{ $exportacion->consignatario }}</span></u></em></strong>
    </p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;text-indent:35.4pt;'>
        <strong><em><u><span>{{ $direccion }}</span></u></em></strong>
    </p>
    <br>
    <p align='justify' style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>It is understood that this request is
            irrevocable and that by signing this Letter we waive any and all right to claim the delivery to us of any
            original copy of the Bill of Lading.</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>We also waive any and all right to
            contest your remittance of the original copy of the Bill of Lading to the Consignee or to claim any damages
            in connection therewith.</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>We of course understand that you will
            surrender the Bill of Lading to the Consignee at your convenience and without any undertaking to do so at a
            specific time and consequently waive any right or claim we may have against you, your agents,
            sub-contractors and/or servants by reason of any delay in the remittance of the Bill of Lading to the
            Consignee, howsoever arising.&nbsp;</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>We undertake to indemnify CMA-CGM, its
            agents, sub-contractors and/or servants, immediately and upon first demand, against any and all claims,
            damages or liabilities arising, directly or indirectly, by reason of the remittance of the original Bill of
            Lading to the Consignee.&nbsp;</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>We undertake to indemnify CMA-CGM, its
            agents, sub-contractors and/or servants, immediately and upon first demand, against any and all claims,
            damages or liabilities arising, directly or indirectly, by reason of the delay or failure of the Consignee
            or the holder of the Bill of Lading to take delivery of the Bill of lading and/or the Goods.&nbsp;</span>
    </p>
    <p align='justify'
        style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>It is agreed that this Letter is part
            of the contract of carriage concluded between ourselves and established in the Bill of Lading as per the
            attached copy.</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:14px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style='font-size:14px;font-family:"Arial",sans-serif;color:black;'>Yours Sincerely,</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:black;">&nbsp;</span>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Times New Roman",serif;text-align:justify;'>
        <strong><span style='font-family:"Arial",sans-serif;color:black;'>Signature of shipper
                _____________</span></strong>
    </p>
    <h4 style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Times New Roman",serif;'><span
            style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span><span
            style='font-size:15px;font-family:"Arial",sans-serif;color:black;'>ACKNOWLEDGED AND APPROVED
            ________________</span></h4>
    <h4 style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Times New Roman",serif;'><span
            style='font-family:"Arial",sans-serif;color:black;'>&nbsp;</span><span style="color:black;">Signature of
            agent at POL ____________________</span></h4>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:15px;font-family:"Times New Roman",serif;'>&nbsp;</p>

    <div class="page-break"></div>


    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;text-indent:35.4pt;'>
        <strong><em><u><span style="font-size:27px;">{{ $exportacion->consignatario }}</span></u></em></strong>
    </p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:center;'>
        <span style="font-size:15px;color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;'>
        <span style="color:blue;">&nbsp;</span></p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;text-indent:35.4pt;'>
        <span style='font-size:13px;font-family:"Arial",sans-serif;color:blue;'>&nbsp;&nbsp;</span><span
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>We, the
            undersigned</span><em>&nbsp;</em><em><span>{{ $exportacion->consignatario }}</span></em><em><span> {{ $direccion }}</span></em></p>
    <p
        style='margin:0cm;margin-bottom:.0001pt;font-size:16px;font-family:"Times New Roman",serif;text-align:justify;text-indent:35.4pt;'>
        <span style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>being the receivers of the cargo
            mentioned on bill of lading number<em>&nbsp;</em></span><strong>;&nbsp;</strong><strong><span
                style='font-size:15px;font-family:"Arial",sans-serif;'>{{ $exportacion->bl }}</span></strong></p>
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
            style='font-size:13px;font-family:"Arial",sans-serif;color:black;'>ON CARACAS {{ \Carbon\Carbon::now()->translatedFormat('d \d\e F \d\e Y') }}</span>
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
