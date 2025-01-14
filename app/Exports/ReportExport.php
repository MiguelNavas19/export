<?php

namespace App\Exports;

use App\Models\exportacion;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ReportExport implements  WithStyles, ShouldAutoSize
{

    public $id;

    public function __construct($id) {
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
        $sheet->getColumnDimension('B')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('G')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('J')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('H')->setWidth(15); // Ajusta el ancho de la columna I
        $sheet->getColumnDimension('K')->setWidth(20); // Ajusta el ancho de la columna I
        $sheet->getRowDimension(1)->setRowHeight(70); // Establecer la altura de la fila 1 a 30


        // Estilo para el título
        $sheet->getStyle('I5')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('I5:K5'); // Unir celdas I5 a K5
        $sheet->setCellValue('I5', 'CONTROL DE EXPEDIENTE'); // Colocar el título en I5
        $sheet->getStyle('I5:K5')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B7')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B7:D7');
        $sheet->setCellValue('B7', 'CONTRIBUYENTE ORDINARIO');
        $sheet->getStyle('B7:D7')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B8')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B8:D8');
        $sheet->setCellValue('B8', 'CONTRIBUYENTE ESPECIAL');
        $sheet->getStyle('B8:D8')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('H7')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H7:K7');
        $sheet->setCellValue('H7', 'N° DE EXPEDIENTE:');
        $sheet->getStyle('H7:K7')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('H8')->getFont()->setSize(12);
        $sheet->mergeCells('H8:K8');
        $sheet->setCellValue('H8', $registro->expediente);
        $sheet->getStyle('H8:K8')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B10')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B10:K10');
        $sheet->setCellValue('B10', 'DATOS GENERALES');
        $sheet->getStyle('B10:K10')->getAlignment()->setHorizontal('center');


        $sheet->getStyle('B11')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B11:F11');
        $sheet->setCellValue('B11', 'CONSIGNATARIO:');
        $sheet->getStyle('B11:F11')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('G11')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('G11:K11');
        $sheet->setCellValue('G11', 'N° DE BL - GUIA:');
        $sheet->getStyle('G11:K11')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('B12')->getFont()->setSize(12);
        $sheet->mergeCells('B12:F13');
        $sheet->getStyle('B12')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('B12', $registro->consignatario);
        $sheet->getStyle('B12:F13')->getAlignment()->setVertical('top');


        $sheet->getStyle('G12')->getFont()->setSize(12);
        $sheet->mergeCells('G12:K13');
        $sheet->setCellValue('G12', $registro->bl);
        $sheet->getStyle('G12:K13')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G12:K13')->getAlignment()->setVertical('center');


        $sheet->getStyle('B14')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B14:F14');
        $sheet->setCellValue('B14', 'RENUNCIA:');
        $sheet->getStyle('B14:F14')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('G14')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('G14:I14');
        $sheet->setCellValue('G14', 'BUQUE - VUELO:');
        $sheet->getStyle('G14:I14')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('J14')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('J14:K14');
        $sheet->setCellValue('J14', 'FECHA DE LLEGADA:');
        $sheet->getStyle('J14:K14')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('B15:F16')->getFont()->setSize(12);
        $sheet->mergeCells('B15:F16');
        $sheet->setCellValue('B15', $registro->renuncia);
        $sheet->getStyle('B15')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B15:F16')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B15:F16')->getAlignment()->setVertical('center');

        $sheet->getStyle('G15')->getFont()->setSize(12);
        $sheet->mergeCells('G15:I16');
        $sheet->setCellValue('G15', $registro->motonave);
        $sheet->getStyle('G15:I16')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G15:I16')->getAlignment()->setVertical('center');


        $sheet->getStyle('J15')->getFont()->setSize(12);
        $sheet->mergeCells('J15:K16');
        $sheet->setCellValue('J15', $registro->eta);
        $sheet->getStyle('J15:K16')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('J15:K16')->getAlignment()->setVertical('center');


        $sheet->getStyle('B17')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B17:E17');
        $sheet->setCellValue('B17', 'BULTOS O CONTAINERS:');
        $sheet->getStyle('B17:E17')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('F17')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F17:G17');
        $sheet->setCellValue('F17', 'PESO:');
        $sheet->getStyle('F17:G17')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H17')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('H17', 'LINEA:');
        $sheet->getStyle('H17')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('I17')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('I17:J17');
        $sheet->setCellValue('I17', 'ALMACEN:');
        $sheet->getStyle('I17:J17')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('K17')->getFont()->setBold(true)->setSize(12);
        $sheet->setCellValue('K17', 'N° DE REGRISTRO:');
        $sheet->getStyle('K17')->getAlignment()->setHorizontal('left');



        $sheet->getStyle('B18')->getFont()->setSize(12);
        $sheet->mergeCells('B18:E20');
        $sheet->setCellValue('B18', $registro->tipo.' '.$registro->contenedor);
        $sheet->getStyle('B18:E20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B18:E20')->getAlignment()->setVertical('center');


        $sheet->mergeCells('F18:G20');

        $sheet->getStyle('H18')->getFont()->setSize(12);
        $sheet->mergeCells('H18:H20');

        if ($registro->linea > 0){
            $sheet->setCellValue('H18', $registro->tipolinea->nombre);
        }else{
            $sheet->setCellValue('H18', $registro->linea);
        }

        $sheet->getStyle('H18:H20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('H18:H20')->getAlignment()->setVertical('center');


        $sheet->getStyle('B18')->getFont()->setSize(12);
        $sheet->mergeCells('B18:E20');
        $sheet->setCellValue('B18', $registro->tipo.' '.$registro->contenedor);
        $sheet->getStyle('B18:E20')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B18:E20')->getAlignment()->setVertical('center');


        $sheet->mergeCells('I18:J20');
        $sheet->mergeCells('K18:K20');


        $sheet->getStyle('B21')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B21:K21');
        $sheet->setCellValue('B21', 'FECHA DE RECEPCIÓN DE DOCUMENTOS EN OPERACIONES');
        $sheet->getStyle('B21:K21')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B22:D22');
        $sheet->setCellValue('B22', 'BL - GUIA:');
        $sheet->getStyle('B22:D22')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('E22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E22:G22');
        $sheet->setCellValue('E22', 'ACTA DE RECEPCIÓN:');
        $sheet->getStyle('E22:G22')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H22:I22');
        $sheet->setCellValue('H22', 'FACTURAS:');
        $sheet->getStyle('H22')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('J22')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('J22:K22');
        $sheet->setCellValue('J22', 'OTROS:');
        $sheet->getStyle('J22:K22')->getAlignment()->setHorizontal('left');



        $sheet->getStyle('B23')->getFont()->setSize(12);
        $sheet->mergeCells('B23:D24');
        $sheet->setCellValue('B23', $registro->bl);
        $sheet->getStyle('B23:D24')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B23:D24')->getAlignment()->setVertical('center');



        $sheet->mergeCells('E23:G24');
        $sheet->mergeCells('H23:I24');
        $sheet->mergeCells('J23:K24');



        $sheet->getStyle('B25')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B25:K25');
        $sheet->setCellValue('B25', 'DECLARACIÓN');
        $sheet->getStyle('B25:K25')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B26:C26');
        $sheet->setCellValue('B26', 'N° DAI:');
        $sheet->getStyle('B26:C26')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('D26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('D26:E26');
        $sheet->setCellValue('D26', 'N° DUA:');
        $sheet->getStyle('D26:E26')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('F26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F26:G26');
        $sheet->setCellValue('F26', 'N° DVA:');
        $sheet->getStyle('F26')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H26:I26');
        $sheet->setCellValue('H26', 'CANAL:');
        $sheet->getStyle('H26:I26')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('J26')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('J26:K26');
        $sheet->setCellValue('J26', 'FUNCIONARIO:');
        $sheet->getStyle('J26:K26')->getAlignment()->setHorizontal('left');

        $sheet->mergeCells('B27:C28');
        $sheet->mergeCells('D27:E28');
        $sheet->mergeCells('F27:G28');
        $sheet->mergeCells('H27:I28');
        $sheet->mergeCells('J27:K28');


        $sheet->getStyle('B29')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B29:K29');
        $sheet->setCellValue('B29', 'CIERRE DEL PROCESO ADUANAL');
        $sheet->getStyle('B29:K29')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B30')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B30:E30');
        $sheet->setCellValue('B30', 'FECHA DE DESPACHO:');
        $sheet->getStyle('B30:E30')->getAlignment()->setHorizontal('LEFT');

        $sheet->getStyle('F30')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F30:K30');
        $sheet->setCellValue('F30', 'TRANSPORTISTA - DESTINO:');
        $sheet->getStyle('F30:K30')->getAlignment()->setHorizontal('left');

        $sheet->mergeCells('B31:E32');
        $sheet->mergeCells('F31:K32');



        $sheet->getStyle('B33')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B33:K33');
        $sheet->setCellValue('B33', 'FACTURACIÓN');
        $sheet->getStyle('B33:K33')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B34')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B34:C34');
        $sheet->setCellValue('B34', 'N° DE FACTURA:');
        $sheet->getStyle('B34:C34')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('D34')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('D34:E34');
        $sheet->setCellValue('D34', 'N° DE CONTROL:');
        $sheet->getStyle('D34:E34')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('F34')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('F34:H34');
        $sheet->setCellValue('F34', 'FECHA DE FACTURACIÓN:');
        $sheet->getStyle('F34:H34')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('I34')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('I34:K34');
        $sheet->setCellValue('I34', 'FECHA DE ENVIO AL CLIENTE:');
        $sheet->getStyle('I34:K34')->getAlignment()->setHorizontal('left');


        $sheet->mergeCells('B35:C36');
        $sheet->mergeCells('D35:E36');
        $sheet->mergeCells('F35:H36');
        $sheet->mergeCells('I35:K36');


        $sheet->getStyle('B37')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B37:K37');
        $sheet->setCellValue('B37', 'OBSERVACIONES');
        $sheet->getStyle('B37:K37')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B38')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B38:K38');
        $sheet->setCellValue('B38', 'OPERACIONES:');
        $sheet->getStyle('B38:K38')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('B44')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B44:K44');
        $sheet->setCellValue('B44', 'VALORACIÓN:');
        $sheet->getStyle('B44:K44')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('B39')->getFont()->setSize(12);
        $sheet->mergeCells('B39:K43');
        $sheet->setCellValue('B39', $registro->obs);
        $sheet->getStyle('B39')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B39:K43')->getAlignment()->setVertical('top');



        $sheet->mergeCells('B45:K47');


        $sheet->getStyle('B48')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('B48:D48');
        $sheet->setCellValue('B48', 'EJECUTIVA DE CUENTAS:');
        $sheet->getStyle('B48:D48')->getAlignment()->setHorizontal('left');


        $sheet->getStyle('E48')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('E48:G48');
        $sheet->setCellValue('E48', 'VALORADOR');
        $sheet->getStyle('E48:G48')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('H48')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('H48:I48');
        $sheet->setCellValue('H48', 'DESPACHADOR');
        $sheet->getStyle('H48:I48')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('J48')->getFont()->setBold(true)->setSize(12);
        $sheet->mergeCells('J48:K48');
        $sheet->setCellValue('J48', 'ADMINISTRACIÓN');
        $sheet->getStyle('J48:K48')->getAlignment()->setHorizontal('left');

        $sheet->mergeCells('B49:D50');
        $sheet->mergeCells('E49:G50');
        $sheet->mergeCells('H49:I50');

        $sheet->getStyle('J49:K50')->getFont()->setSize(12);
        $sheet->mergeCells('J49:K50');
        $sheet->setCellValue('J49', $registro->cliente);
        $sheet->getStyle('J49')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J49:K50')->getAlignment()->setVertical('top');


        //bordes
        $sheet->getStyle('B7:D7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B8:D8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B11:F11')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B12:F13')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B14:F14')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B15:F16')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B17:E17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F17:G17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('I17:J17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('K17')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('G11:K11')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('G12:K13')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('G14:I14')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('G15:I16')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J14:K14')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J15:K16')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H8:K8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H7:K7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('E7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('E8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B18:E20')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F18:G20')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H18:H20')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('I18:J20')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('K18:K20')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B21:K21')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B22:D22')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('E22:G22')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H22:I22')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J22:K22')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B23:D24')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('E23:G24')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H23:I24')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J23:K24')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B25:K25')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B26:C26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('D26:E26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F26:G26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H26:I26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J26:K26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);


        $sheet->getStyle('B27:C28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('D27:E28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F27:G28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H27:I28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J27:K28')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B29:K29')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B30:E30')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F30:K30')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B31:E32')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F31:K32')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B33:K33')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B34:C34')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('D34:E34')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F34:H34')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('I34:K34')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B35:C36')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('D35:E36')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('F35:H36')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('I35:K36')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B37:K37')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B38:K43')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('B44:K47')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);

        $sheet->getStyle('B48:D50')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('E48:G50')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('H48:I50')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);
        $sheet->getStyle('J48:K50')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THICK);



        $drawing = new Drawing();
        $drawing->setName('Logo'); // Nombre de la imagen
        $drawing->setDescription('Logo de la empresa'); // Descripción
        $drawing->setPath(public_path('storage/img/logo.png')); // Ruta de la imagen
        $drawing->setHeight(180); // Altura de la imagen
        $drawing->setWidth(300);
        $drawing->setCoordinates('B1'); // Coordenadas donde se insertará la imagen
        $drawing->setWorksheet($sheet); // Establecer la hoja de trabajo



    }
}
