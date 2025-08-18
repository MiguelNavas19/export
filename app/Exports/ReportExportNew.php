<?php

namespace App\Exports;

use App\Models\exportacion;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;


class ReportExportNew implements WithStyles, ShouldAutoSize
{

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }


    public function consulta()
    {
        return Exportacion::find($this->id); // Devuelve una colección con un solo registro

    }

    public function styles(Worksheet $sheet)
    {
        $registro = $this->consulta()->first();
        // Quitar todos los bordes
        $sheet->getStyle('A1:Z100')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE);
        $sheet->getColumnDimension('A')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('B')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('G')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('J')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('H')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('K')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('C')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('D')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('F')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('I')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('H')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('E')->setWidth(15);

        // Estilo para el título

        $sheet->getStyle('C2')->getFont()->setBold(true)->setSize(18);
        $sheet->mergeCells('C2:D2');
        $sheet->setCellValue('C2', 'CARGA AEREA');
        $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('E2')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THICK);


        $sheet->getStyle('E2')->getFont()->setBold(true)->setSize(18);
        if ($registro->envio == 1) {

            $sheet->setCellValue('E2', 'X');
        }

        $sheet->getStyle('E2')->getAlignment()->setHorizontal('center');




        $sheet->getStyle('G2')->getFont()->setBold(true)->setSize(18);
        $sheet->mergeCells('G2:H2');
        $sheet->setCellValue('G2', 'CARGA MARITIMA');
        $sheet->getStyle('G2:H2')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('I2')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('I2')->getFont()->setBold(true)->setSize(18);
        if ($registro->envio == 2) {

            $sheet->setCellValue('I2', 'X');
        }

        $sheet->getStyle('I2')->getAlignment()->setHorizontal('center');



        $sheet->getStyle('C5')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C5:E5');
        $sheet->setCellValue('C5', 'CONTRIBUYENTE ORDINARIO');
        $sheet->getStyle('C5:E5')->getAlignment()->setHorizontal('right');

        $sheet->getStyle('F5')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('C6')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C6:E6');
        $sheet->setCellValue('C6', 'CONTRIBUYENTE ESPECIAL');
        $sheet->getStyle('C6:E6')->getAlignment()->setHorizontal('right');

        $sheet->getStyle('F6')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);




        $sheet->getStyle('H5')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H5:I5');
        $sheet->setCellValue('H5', 'N° DE EXPEDIENTE:');
        $sheet->getStyle('H5:I5')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('H5:I7')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('H6')->getFont()->setSize(16);
        $sheet->mergeCells('H6:I7');
        $sheet->setCellValue('H6', $registro->expediente);
        $sheet->getStyle('H6:I7')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('D8')->getFont()->setSize(12);
        $sheet->setCellValue('D8', 'BL / GUIA');
        $sheet->getStyle('D8')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('E8')->getFont()->setSize(16);
        $sheet->mergeCells('E8:G8');
        $sheet->setCellValue('E8', $registro->bl);
        $sheet->getStyle('E8:G8')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('E8:G8')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);


        $sheet->getStyle('A11')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A11:I12');
        $sheet->setCellValue('A11', 'CONTROL DE EXPEDIENTE');
        $sheet->getStyle('A11:I12')->getAlignment()->setHorizontal('center');


        $style = $sheet->getStyle('A14');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A14')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A14:I14');
        $sheet->setCellValue('A14', 'DATOS GENERALES');
        $sheet->getStyle('A14:I14')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('A15:E15')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A15')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A15:E15');
        $sheet->setCellValue('A15', 'CONSIGNATARIO');
        $sheet->getStyle('A15:E15')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A16:E17')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A16')->getFont()->setSize(12);
        $sheet->mergeCells('A16:E17');
        $sheet->getStyle('A16')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('A16', $registro->consignatario);
        $sheet->getStyle('A16:E17')->getAlignment()->setVertical('top');


        $sheet->getStyle('F15:I15')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('F15')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F15:I15');
        $sheet->setCellValue('F15', 'EXPORTADOR');
        $sheet->getStyle('F15:I15')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('F16:I17')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('F16')->getFont()->setSize(12);
        $sheet->mergeCells('F16:I17');
        $sheet->getStyle('F16')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('F16', $registro->consignatario);
        $sheet->getStyle('F16:I17')->getAlignment()->setVertical('top');


        $sheet->getStyle('A18:D18')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A18')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A18:D18');
        $sheet->setCellValue('A18', 'RENUNCIA');
        $sheet->getStyle('A18:D18')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A19:D20')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A19:D20')->getFont()->setSize(12);
        $sheet->mergeCells('A19:D20');
        $sheet->setCellValue('A19', $registro->renuncia);
        $sheet->getStyle('A19')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A19:D20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A19:D20')->getAlignment()->setVertical('center');

        $sheet->getStyle('E18:G18')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E18')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E18:G18');
        $sheet->setCellValue('E18', 'BUQUE-VUELO');
        $sheet->getStyle('E18:G18')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('E19:G20')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('E19:G20')->getFont()->setSize(12);
        $sheet->mergeCells('E19:G20');
        $sheet->setCellValue('E19', $registro->motonave);
        $sheet->getStyle('E19')->getAlignment()->setWrapText(true);
        $sheet->getStyle('E19:G20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E19:G20')->getAlignment()->setVertical('center');

        $sheet->getStyle('H18:I18')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H18')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H18:I18');
        $sheet->setCellValue('H18', 'FECHA DE LLEGADA');
        $sheet->getStyle('H18:I18')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('H19:I20')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H19:I20')->getFont()->setSize(12);
        $sheet->mergeCells('H19:I20');
        $sheet->setCellValue('H19', $registro->eta);
        $sheet->getStyle('H19')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H19:I20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('H19:I20')->getAlignment()->setVertical('center');


        $sheet->getStyle('A21:C21')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A21')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A21:C21');
        $sheet->setCellValue('A21', 'LINEA');
        $sheet->getStyle('A21')->getAlignment()->setHorizontal('left');

        $sheet->getRowDimension(22)->setRowHeight(30); // 25 puntos de alto

        $sheet->getStyle('A22:C22')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A22:C22');
        if ($registro->linea > 0) {
            $sheet->setCellValue('A22', $registro->tipolinea->nombre);
        } else {
            $sheet->setCellValue('A22', $registro->linea);
        }
        $sheet->getStyle('A22')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A22')->getAlignment()->setVertical('center');



        $sheet->getStyle('D21:F21')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('D21')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('D21:F21');
        $sheet->setCellValue('D21', 'ALMACEN');
        $sheet->getStyle('D21')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('D22:F22')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('D22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('D22:F22');


        $sheet->getStyle('G21')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('G21')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('G21', 'BULTOS');

        $sheet->getStyle('G22')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);




        $sheet->getStyle('H21')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H21')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('H21', 'CONTENEDOR');
        $sheet->getStyle('H21')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H22')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('H22')->getFont()->setSize(12);
        $sheet->setCellValue('H22', $registro->tipo . ' ' . $registro->contenedor);
        $sheet->getStyle('H22')->getAlignment()->setWrapText(true);

        $sheet->getStyle('I21')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('I21')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('I21', 'N° DE REGRISTRO');
        $sheet->getStyle('I21')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('I22')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getRowDimension(24)->setRowHeight(30); // 25 puntos de alto

        $sheet->getStyle('A23:B23')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('A23')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A23:B23');
        $sheet->setCellValue('A23', 'PESO BRUTO');
        $sheet->getStyle('A23')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A24:B24')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A24')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A24:B24');
        $sheet->setCellValue('A24', $registro->peso);
        $sheet->getStyle('A24')->getAlignment()->setHorizontal('right');



        $sheet->getStyle('C23:D23')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('C23')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C23:D23');
        $sheet->setCellValue('C23', 'EMBALAJE');
        $sheet->getStyle('C23')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('C24:D24')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C24')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C24:D24');
        $sheet->setCellValue('C24', '');
        $sheet->getStyle('C24')->getAlignment()->setHorizontal('right');



        $sheet->getStyle('E23:I23')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('E23')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E23:I23');
        $sheet->setCellValue('E23', 'CONTENIDO');
        $sheet->getStyle('E23')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('E24:I24')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E24')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E24:I24');
        $sheet->setCellValue('E24', $registro->descripcion);
        $sheet->getStyle('E24')->getAlignment()->setHorizontal('right');






        $style = $sheet->getStyle('A26');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A26:I26');
        $sheet->setCellValue('A26', 'RECEPCION DE DOCUMENTOS EN OPERACIONES');
        $sheet->getStyle('A26:I26')->getAlignment()->setHorizontal('center');


        $sheet->getRowDimension(28)->setRowHeight(30); // 25 puntos de alto

        $sheet->getStyle('A27:C27')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('A27')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A27:C27');
        $sheet->setCellValue('A27', 'BL/GUIA');
        $sheet->getStyle('A27')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A28:C28')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A28')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A28:C28');
        $sheet->setCellValue('A28', $registro->bl);
        $sheet->getStyle('A28')->getAlignment()->setHorizontal('center');



        $sheet->getStyle('D27:E27')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('D27')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('D27:E27');
        $sheet->setCellValue('D27', 'ACTA DE RECEPCIÓN');
        $sheet->getStyle('D27')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('D28:E28')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('D28:E28');


        $sheet->getStyle('F27:G27')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('F27')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F27:G27');
        $sheet->setCellValue('F27', 'FACTURAS');
        $sheet->getStyle('F27')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('F28:G28')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('F28:G28');


        $sheet->getStyle('H27:I27')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('H27')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H27:I27');
        $sheet->setCellValue('H27', 'OTROS');
        $sheet->getStyle('H27')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H28:I28')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('H28:I28');



        $style = $sheet->getStyle('A30');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A30')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A30:I30');
        $sheet->setCellValue('A30', 'DECLARACIÓN');
        $sheet->getStyle('A30:I30')->getAlignment()->setHorizontal('center');



        $sheet->getStyle('A31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A31')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('A31', 'DAI');
        $sheet->getStyle('A31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);



        $sheet->getStyle('B31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('B31')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('B31', 'FECHA DAI');
        $sheet->getStyle('B31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('B32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('C31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C31')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('C31', 'DUA');
        $sheet->getStyle('C31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('C32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C32')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('C32', $registro->dua);
        $sheet->getStyle('C32')->getAlignment()->setHorizontal('left');



        $sheet->getStyle('D31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('D31')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('D31', 'DVA');
        $sheet->getStyle('D31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('D32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('E31:F31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E31:F31')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E31:F31');
        $sheet->setCellValue('E31', 'CANAL');
        $sheet->getStyle('E31:F31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('E32:F32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('E32:F32');


        $sheet->getStyle('G31:I31')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('G31:I31')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('G31:I31');
        $sheet->setCellValue('G31', 'FUNCIONARIO');
        $sheet->getStyle('G31:I31')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('G32:I32')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('G32:I32');
        $sheet->getStyle('G32:I32')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('G32', $registro->funcionario);
        $sheet->getStyle('G32:I32')->getAlignment()->setHorizontal('left');






        $style = $sheet->getStyle('A34');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A34')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A34:I34');
        $sheet->setCellValue('A34', 'CIERRE DEL PROCESO');
        $sheet->getStyle('A34:I34')->getAlignment()->setHorizontal('center');



        $sheet->getStyle('A35:B35')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A35:B35')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A35:B35');
        $sheet->setCellValue('A35', 'FECHA DE DESPACHO');
        $sheet->getStyle('A35:B35')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A36:B36')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('A36:B36');
        $sheet->getStyle('A36:B36')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('A36', $registro->fecha_despacho);
        $sheet->getStyle('A36:B36')->getAlignment()->setHorizontal('left');



        $sheet->getStyle('C35:D35')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C35:D35')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C35:D35');
        $sheet->setCellValue('C35', 'TRANSPORTISTA');
        $sheet->getStyle('C35:D35')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('C36:D36')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('C36:D36');



        $sheet->getStyle('E35:F35')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E35:F35')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E35:F35');
        $sheet->setCellValue('E35', 'CEDULA');
        $sheet->getStyle('E35:F35')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('E36:F36')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('E36:F36');


        $sheet->getStyle('G35:I35')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('G35:I35')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('G35:I35');
        $sheet->setCellValue('G35', 'DIRECCION DE DESTINO');
        $sheet->getStyle('G35:I35')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('G36:I36')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('G36:I36');



        $style = $sheet->getStyle('A38');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A38')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A38:I38');
        $sheet->setCellValue('A38', 'FACTURACION');
        $sheet->getStyle('A38:I38')->getAlignment()->setHorizontal('center');



        $sheet->getStyle('A39')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A39')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('A39', 'FACTURA Nº');
        $sheet->getStyle('A39')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A40')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A40')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('A40', $registro->factura);
        $sheet->getStyle('A40')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('B39')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('B39')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('B39', 'Nº CONTROL');
        $sheet->getStyle('B39')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('B40')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);



        $sheet->getStyle('C39:D39')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C39:D39')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C39:D39');
        $sheet->setCellValue('C39', 'FECHA FACTURACIÓN');
        $sheet->getStyle('C39:D39')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('C40:D40')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('C40:D40')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C40:D40');
        $sheet->setCellValue('C40', $registro->fecha_factura);
        $sheet->getStyle('C40:D40')->getAlignment()->setHorizontal('left');




        $sheet->getStyle('E39:F39')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('E39:F39')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E39:F39');
        $sheet->setCellValue('E39', 'FECHA ENVIO AL CLIENTE');
        $sheet->getStyle('E39:F39')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('E40:F40')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('E40:F40');
        $sheet->setCellValue('E40', $registro->fecha_despacho);
        $sheet->getStyle('E40:F40')->getAlignment()->setHorizontal('left');



        $sheet->getStyle('G39:I39')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('G39:I39')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('G39:I39');
        $sheet->setCellValue('G39', 'REALIZADO POR');
        $sheet->getStyle('G39:I39')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('G40:I40')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('G40:I40');



        $style = $sheet->getStyle('A42');

        // Fondo negro
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('000000'));

        // Texto blanco
        $style->getFont()
            ->getColor()->setRGB('FFFFFF');

        $sheet->getStyle('A42')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A42:I42');
        $sheet->setCellValue('A42', 'OBSERVACIONES');
        $sheet->getStyle('A42:I42')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('A43:I43')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('A43')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A43:I43');
        $sheet->setCellValue('A43', 'OPERACIONES');
        $sheet->getStyle('A43:I43')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('A44:I47')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('A44')->getFont()->setSize(12);
        $sheet->mergeCells('A44:I47');
        $sheet->setCellValue('A44', $registro->obs);
        $sheet->getStyle('A44')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A44:I47')->getAlignment()->setVertical('top');


        $sheet->getStyle('A49:I52')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('A49:I52');




        $sheet->getStyle('A53:B53')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('A53')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('A53:B53');
        $sheet->setCellValue('A53', 'EJECUTIVO DE CUENTAS');
        $sheet->getStyle('A53:B53')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('A54:B56')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('A54:B56');


        $sheet->getStyle('C53:E53')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('C53')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('C53:E53');
        $sheet->setCellValue('C53', 'VALORADOR');
        $sheet->getStyle('C53:E53')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('C54:E56')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('C54:E56');



        $sheet->getStyle('F53:G53')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('F53')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F53:G53');
        $sheet->setCellValue('F53', 'DESPACHADOR');
        $sheet->getStyle('F53:G53')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('F54:G56')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('F54:G56');



        $sheet->getStyle('H53:I53')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);


        $sheet->getStyle('H53')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H53:I53');
        $sheet->setCellValue('H53', 'ADMINISTRACIÓN');
        $sheet->getStyle('H53:I53')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('H54:I56')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->mergeCells('H54:I56');

        $sheet->getStyle('H54')->getFont()->setSize(12);
        $sheet->setCellValue('H54', $registro->cliente);
        $sheet->getStyle('H54')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H54:I56')->getAlignment()->setVertical('top');



        $drawing = new Drawing();
        $drawing->setName('Logo'); // Nombre de la imagen
        $drawing->setDescription('Logo de la empresa'); // Descripción
        $drawing->setPath(public_path('storage/img/logomg.png')); // Ruta de la imagen
        $drawing->setHeight(180); // Altura de la imagen
        $drawing->setWidth(300);
        $drawing->setCoordinates('A3'); // Coordenadas donde se insertará la imagen
        $drawing->setWorksheet($sheet); // Establecer la hoja de trabajo

    }
}
