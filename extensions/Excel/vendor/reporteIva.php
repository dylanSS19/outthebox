<?php

require 'autoload.php';
require "../../../controllers/sistema-facturas-reporte-iva.controller.php";
require "../../../models/sistema-facturas-reporte-iva.model.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Alignament;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


session_start();
$idempresa =  $_SESSION["empresa"];
$fechaDesde = $_GET["fechaDesde"];
$FechaHasta = $_GET["fechaHasta"];
$ivaFavor = $_GET["ivaFavor"]; 
$response = ReporteIvaController::ctrCargarIva($idempresa, $fechaDesde, $FechaHasta);
$responseCompras = ReporteIvaController::ctrCargarCompras($idempresa, $fechaDesde, $FechaHasta);
$responserResuIva = ReporteIvaController::ctrCargarResumenIvaFacturas($idempresa, $fechaDesde, $FechaHasta);
$DatosEmpresa = ReporteIvaController::ctrCargarDatosEmpresa($idempresa);
$responserResuGastos = ReporteIvaController::ctrCargarResumenGastosFacturas($idempresa, $DatosEmpresa[0]["cedula"], $fechaDesde, $FechaHasta);

// echo '<pre>'; print_r($_GET["fechaDesde"]); echo '</pre>';
// echo '<pre>'; print_r($responserResuIva); echo '</pre>';
// exit();



$styleArrayBorder = [
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THICK,
            'color' => ['rgb' => 'FFFF0000'],
        ],
    ],
];

$styleArrayFill1 = array(
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('rgb' => 'DEE5E4')
    )
);

$styleArrayFill2 = array(
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('rgb' => 'B8BDBC')
    )
);

$styleArrayFill3 = array(
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('rgb' => 'DEE5E4')
    )
);


$Excel = new Spreadsheet();

//! REPORTE DE IVA 

 

$Excel ->createSheet();

$Excel->getDefaultStyle()->getFont()->setName('Calibri');

$HojaActiva2 =$Excel->setActiveSheetIndex(0);

$HojaActiva2 ->setTitle("Reporte Ventas");
$HojaActiva2 ->setCellValue('A1', "Fecha Factura");
$HojaActiva2 ->setCellValue('B1', "Origen");
$HojaActiva2 ->setCellValue('C1', "Estado");
$HojaActiva2 ->setCellValue('D1', "Nombre");
$HojaActiva2 ->setCellValue('E1', "Tipo Documento");
$HojaActiva2 ->setCellValue('F1', "Tipo Pago");
$HojaActiva2 ->setCellValue('G1', "Consecutivo");
$HojaActiva2 ->setCellValue('H1', "Clave");
$HojaActiva2 ->setCellValue('I1', "Monto Exento");
$HojaActiva2 ->setCellValue('J1', "Monto Base");
$HojaActiva2 ->setCellValue('K1', "IVA 1%");
$HojaActiva2 ->setCellValue('L1', "IVA 2%");
$HojaActiva2 ->setCellValue('M1', "IVA 4%");
$HojaActiva2 ->setCellValue('N1', "IVA 8%");
$HojaActiva2 ->setCellValue('O1', "IVA 13%");
$HojaActiva2 ->setCellValue('P1', "Total");
$HojaActiva2 ->setCellValue('Q1', "Factura Afecta");
$HojaActiva2->getStyle('A1:Q1')->getFont()->setBold(true);


foreach (range('A','Q') as $col) {
    $HojaActiva2->getColumnDimension($col)->setAutoSize(true);  
}


$Fila = 2;
for($i =0; $i < count($response); $i++){

$HojaActiva2 ->setCellValue('A'.$Fila, date("d-m-Y", strtotime($response[$i]["fecha"])));
$HojaActiva2 ->setCellValue('B'.$Fila, $response[$i]["Origen"]);
$HojaActiva2 ->setCellValue('C'.$Fila, $response[$i]["estado"]);
$HojaActiva2 ->setCellValue('D'.$Fila, $response[$i]["nombre"]);
$HojaActiva2 ->setCellValue('E'.$Fila, $response[$i]["tipo_doc"]);
$HojaActiva2 ->setCellValue('F'.$Fila, $response[$i]["tipo_pago"]);
$HojaActiva2 ->setCellValue('G'.$Fila, $response[$i]["consecutivo"]);
$HojaActiva2 ->setCellValue('H'.$Fila, $response[$i]["clave"]);
$HojaActiva2 ->setCellValue('I'.$Fila, $response[$i]["exento"]);
$HojaActiva2 ->setCellValue('J'.$Fila, $response[$i]["base"]);
$HojaActiva2 ->setCellValue('K'.$Fila, $response[$i]["iva_uno"]);
$HojaActiva2 ->setCellValue('L'.$Fila, $response[$i]["iva_dos"]);
$HojaActiva2 ->setCellValue('M'.$Fila, $response[$i]["iva_cuatro"]);
$HojaActiva2 ->setCellValue('N'.$Fila, $response[$i]["iva_ocho"]);
$HojaActiva2 ->setCellValue('O'.$Fila, $response[$i]["iva_trece"]);
$HojaActiva2 ->setCellValue('P'.$Fila, $response[$i]["total"]);
$HojaActiva2 ->setCellValue('Q'.$Fila, $response[$i]["afecta"]);
// $HojaActiva2->getStyle('A'.$Fila.':Q'.$Fila)->applyFromArray($tablaColores);
$Fila = $Fila +1;
}

//! REPORTE DE GASTOS 

$Excel ->createSheet();
$HojaActiva3 =$Excel->setActiveSheetIndex(1);
$HojaActiva3 ->setTitle("Reporte Compras");
$HojaActiva3 ->setCellValue('A1', "Fecha Factura");
$HojaActiva3 ->setCellValue('B1', "Proveedor");
$HojaActiva3 ->setCellValue('C1', "Cedula Proveedor");
$HojaActiva3 ->setCellValue('D1', "Tipo Documento");
$HojaActiva3 ->setCellValue('E1', "Consecutivo");
$HojaActiva3 ->setCellValue('F1', "Clave");
$HojaActiva3 ->setCellValue('G1', "Tipo Pago");
$HojaActiva3 ->setCellValue('H1', "Monto Exento");
$HojaActiva3 ->setCellValue('I1', "Monto Base");
$HojaActiva3 ->setCellValue('J1', "IVA 1%");
$HojaActiva3 ->setCellValue('K1', "IVA 2%");
$HojaActiva3 ->setCellValue('L1', "IVA 4%");
$HojaActiva3 ->setCellValue('M1', "IVA 8%");
$HojaActiva3 ->setCellValue('N1', "IVA 13%");
$HojaActiva3 ->setCellValue('O1', "Total");
$HojaActiva3 ->setCellValue('P1', "Categoria");
$HojaActiva3->getStyle('A1:P1')->getFont()->setBold(true);

foreach (range('A','P') as $col) {

    $HojaActiva3->getColumnDimension($col)->setAutoSize(true);  
}

$Fila = 2;
for($i =0; $i < count($responseCompras); $i++){
    
$HojaActiva3 ->setCellValue('A'.$Fila, date("d-m-Y", strtotime($responseCompras[$i]["fechaEmision"])));
$HojaActiva3 ->setCellValue('B'.$Fila, $responseCompras[$i]["Proveedor"]);
$HojaActiva3 ->setCellValue('C'.$Fila, $responseCompras[$i]["Cedula_Proveedor"]);
$HojaActiva3 ->setCellValue('D'.$Fila, $responseCompras[$i]["tipo_doc"]);
$HojaActiva3 ->setCellValue('E'.$Fila, $responseCompras[$i]["consecutivo"]);
$HojaActiva3 ->setCellValue('F'.$Fila, $responseCompras[$i]["clave"]);
$HojaActiva3 ->setCellValue('G'.$Fila, $responseCompras[$i]["condicion_venta"]);
$HojaActiva3 ->setCellValue('H'.$Fila, $responseCompras[$i]["exento"]);
$HojaActiva3 ->setCellValue('I'.$Fila, $responseCompras[$i]["base"]);
$HojaActiva3 ->setCellValue('J'.$Fila, $responseCompras[$i]["iva_uno"]);
$HojaActiva3 ->setCellValue('K'.$Fila, $responseCompras[$i]["iva_dos"]);
$HojaActiva3 ->setCellValue('L'.$Fila, $responseCompras[$i]["iva_cuatro"]);
$HojaActiva3 ->setCellValue('M'.$Fila, $responseCompras[$i]["iva_ocho"]);
$HojaActiva3 ->setCellValue('N'.$Fila, $responseCompras[$i]["iva_trece"]);
$HojaActiva3 ->setCellValue('O'.$Fila, $responseCompras[$i]["total"]);
$HojaActiva3 ->setCellValue('P'.$Fila, $responseCompras[$i]["categoria"]);

$Fila = $Fila +1;
}


//! RESUMEN REPORTES


$HojaActiva = $Excel->setActiveSheetIndex(2);

if($DatosEmpresa[0]["logo"] == ""){

}else{

$drawing = new Drawing();
$drawing->setName('Logo Empresa');
$drawing->setDescription('Logo Empresa');
$drawing->setPath('../../'.$DatosEmpresa[0]["logo"]);
$drawing->setCoordinates('A1');
$drawing->setWidthAndHeight(100, 500);
// $drawing->setWidth(325);
// $drawing->setHeight(100);
// $drawing->setOffsetX(50);
// $drawing->setRotation(25);
$drawing->getShadow()->setVisible(true);
// $drawing->getShadow()->setDirection(45);
$drawing->setWorksheet($Excel->setActiveSheetIndex(2));


}

$HojaActiva->mergeCells("A1:B1");
$HojaActiva->mergeCells("A2:B2");
$HojaActiva->mergeCells("A3:B3");
$HojaActiva->mergeCells("A4:B4");
$HojaActiva->mergeCells("A5:B5");
$HojaActiva->getStyle('A1')->getAlignment()->setHorizontal('center');

// $Excel->setActiveSheetIndex(0)->getStyle('A1:D1')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A2:D2')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A3:D3')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A4:D4')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A5:D5')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A6:D6')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A7:D7')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A8:D8')->applyFromArray($tablaColores);
// $Excel->setActiveSheetIndex(0)->getStyle('A9:D9')->applyFromArray($tablaColores);

$HojaActiva -> setTitle("Resumen de totales");
$HojaActiva->setCellValue('C1', 'Empresa: '.$DatosEmpresa[0]["nombre_ficticio"]);
$HojaActiva->setCellValue('C2', 'Cédula: '.$DatosEmpresa[0]["cedula"]);
$HojaActiva->setCellValue('C3', 'Dirección: '.$DatosEmpresa[0]["direccion"]);
$HojaActiva->setCellValue('C4', 'Teléfono: '.$DatosEmpresa[0]["telefono"]);

$HojaActiva->mergeCells("C1:H1");
$HojaActiva->mergeCells("C2:H2");
$HojaActiva->mergeCells("C3:H3");
$HojaActiva->mergeCells("C4:H4");
$HojaActiva->mergeCells("C5:H5");


// $HojaActiva->getStyle('D1')->applyFromArray($styleArrayBorder);
// $HojaActiva->getStyle('D2')->applyFromArray($styleArrayBorder);
// $HojaActiva->getStyle('D3')->applyFromArray($styleArrayBorder);
// $HojaActiva->getStyle('D4')->applyFromArray($styleArrayBorder);

// $HojaActiva->getStyle('C1')->applyFromArray($styleArrayFill3);
// $HojaActiva->getStyle('C2')->applyFromArray($styleArrayFill3);
// $HojaActiva->getStyle('C3')->applyFromArray($styleArrayFill3);
// $HojaActiva->getStyle('C4')->applyFromArray($styleArrayFill3);

$HojaActiva->setCellValue('A10', 'RESUMEN DATOS VENTAS');
$HojaActiva->mergeCells("A10:N10");
$HojaActiva->getStyle('A10')->getFont()->setSize(20);
$HojaActiva->getStyle('A10')->getAlignment()->setHorizontal('center');

$HojaActiva->setCellValue('A11', 'Tipo');
$HojaActiva->setCellValue('B11', 'Exentas No Sujetas');
$HojaActiva->setCellValue('C11', 'Gravadas No Sujetas');
$HojaActiva->setCellValue('D11', 'IVA No Sujetas');
$HojaActiva->setCellValue('E11', 'Total No Sujetas');
$HojaActiva->setCellValue('F11', 'Exentas Servicios');
$HojaActiva->setCellValue('G11', 'Gravadas Servicios');
$HojaActiva->setCellValue('H11', 'IVA Servicios');
$HojaActiva->setCellValue('I11', 'Total Servicios');
$HojaActiva->setCellValue('J11', 'Exentas Bienes');
$HojaActiva->setCellValue('K11', 'Gravadas Bienes');
$HojaActiva->setCellValue('L11', 'IVA Bienes');
$HojaActiva->setCellValue('M11', 'Total Bienes');
$HojaActiva->setCellValue('N11', 'Total Ivas');


$HojaActiva->getStyle('A11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('B11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('C11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('D11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('E11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('F11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('G11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('H11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('I11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('J11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('K11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('L11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('M11')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('N11')->getAlignment()->setHorizontal('center');


$HojaActiva->getStyle('A11:N11')->getFont()->setBold(true);
// $HojaActiva->getStyle('A16:E16')->getFont()->setBold(true);

$HojaActiva->getStyle('A11:N11')->applyFromArray($styleArrayBorder);
// $HojaActiva->getStyle('A11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('B11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('C11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('D11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('E11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('F11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('G11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('H11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('I11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('J11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('K11')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('L11')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('M11')->applyFromArray($styleArrayFill1);


// foreach (range('A','E') as $col) {
//     $HojaActiva->getColumnDimension($col)->setAutoSize(true);  
// }


$TotalIVAVentas = 0;

$totIvaV2 = 0;
$totIvaV3 = 0;
$Fila = 12;
for($i =0; $i < count($responserResuIva); $i++){

    $totIvaV1 = 0;

$TotalIVAVentas = $TotalIVAVentas + $responserResuIva[$i]["ivanosujetas"] + $responserResuIva[$i]["ivaservicios"] + $responserResuIva[$i]["ivabienes"];
$totIvaV1 =  $responserResuIva[$i]["ivanosujetas"] + $responserResuIva[$i]["ivaservicios"] + $responserResuIva[$i]["ivabienes"];
// $totIvaV2 = $totIvaV2 + $responserResuIva[$i]["ivaservicios"];
// $totIvaV3 = $totIvaV3 + $responserResuIva[$i]["ivabienes"];

$HojaActiva->getColumnDimension('A')->setWidth(20);
$HojaActiva ->setCellValue('A'.$Fila, $responserResuIva[$i]["tipo"]);

$HojaActiva->getStyle('B'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('B')->setWidth(20);
$HojaActiva ->setCellValue('B'.$Fila, $responserResuIva[$i]["exentasnosujetas"]);

$HojaActiva->getStyle('C'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('C')->setWidth(20);
$HojaActiva ->setCellValue('C'.$Fila, $responserResuIva[$i]["gravadasnosujetas"]);

$HojaActiva->getStyle('D'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('D')->setWidth(20);
$HojaActiva ->setCellValue('D'.$Fila, $responserResuIva[$i]["ivanosujetas"]);

$HojaActiva->getStyle('E'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('E')->setWidth(20);
$HojaActiva ->setCellValue('E'.$Fila, $responserResuIva[$i]["totalnosujetas"]);

$HojaActiva->getStyle('F'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('F')->setWidth(20);
$HojaActiva ->setCellValue('F'.$Fila, $responserResuIva[$i]["exentasservicios"]);

$HojaActiva->getStyle('G'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('G')->setWidth(20);
$HojaActiva ->setCellValue('G'.$Fila, $responserResuIva[$i]["gravadasservicios"]);

$HojaActiva->getStyle('H'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('H')->setWidth(20);
$HojaActiva ->setCellValue('H'.$Fila, $responserResuIva[$i]["ivaservicios"]);

$HojaActiva->getStyle('I'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('I')->setWidth(20);
$HojaActiva ->setCellValue('I'.$Fila, $responserResuIva[$i]["totalservicios"]);

$HojaActiva->getStyle('J'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('J')->setWidth(20);
$HojaActiva ->setCellValue('J'.$Fila, $responserResuIva[$i]["exentasbienes"]);

$HojaActiva->getStyle('K'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('K')->setWidth(20);
$HojaActiva ->setCellValue('K'.$Fila, $responserResuIva[$i]["gravadasbienes"]);

$HojaActiva->getStyle('L'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('L')->setWidth(20);
$HojaActiva ->setCellValue('L'.$Fila, $responserResuIva[$i]["ivabienes"]);

$HojaActiva->getStyle('M'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('M')->setWidth(20);
$HojaActiva ->setCellValue('M'.$Fila, $responserResuIva[$i]["totalbienes"]);

$HojaActiva->getStyle('A'.$Fila.':N'.$Fila)->applyFromArray($styleArrayBorder);


$HojaActiva->getStyle('N'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('N')->setWidth(20);
$HojaActiva->setCellValue('N'.$Fila , $totIvaV1);

if($Fila % 2 == 0){

    $HojaActiva->getStyle('A'.$Fila.':N'.$Fila)->applyFromArray($styleArrayFill1);
    // $HojaActiva->getStyle('A'.$Fila)->applyFromArray($styleArrayFill1);
    // $HojaActiva->getStyle('B'.$Fila)->applyFromArray($styleArrayFill2);
    // $HojaActiva->getStyle('C'.$Fila)->applyFromArray($styleArrayFill1);
    // $HojaActiva->getStyle('D'.$Fila)->applyFromArray($styleArrayFill2);
    // $HojaActiva->getStyle('E'.$Fila)->applyFromArray($styleArrayFill1);

}else{

    // $HojaActiva->getStyle('A'.$Fila.':M'.$Fila)->applyFromArray($styleArrayFill2);
    // $HojaActiva->getStyle('A'.$Fila)->applyFromArray($styleArrayFill2);
    // $HojaActiva->getStyle('B'.$Fila)->applyFromArray($styleArrayFill1);
    // $HojaActiva->getStyle('C'.$Fila)->applyFromArray($styleArrayFill2);
    // $HojaActiva->getStyle('D'.$Fila)->applyFromArray($styleArrayFill1);
    // $HojaActiva->getStyle('E'.$Fila)->applyFromArray($styleArrayFill2);
}

$Fila = $Fila +1;
}



// $HojaActiva->getColumnDimension('N')->setWidth(20);
// $HojaActiva->getStyle('N12')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N12', $totIvaV1);
// $HojaActiva->getStyle('N13')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N13', $totIvaV2);
// $HojaActiva->getStyle('N14')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N14', $totIvaV3);
// $HojaActiva->getStyle('N15')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N15', '0');
// $HojaActiva->getStyle('N16')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N16', '0');
// $HojaActiva->getStyle('N17')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// // $HojaActiva ->setCellValue('N17', '0');

$HojaActiva->setCellValue('A18', 'Total IVA');

$HojaActiva->getStyle('B18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('B18', '=SUM(B12:B17)');

$HojaActiva->getStyle('C18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('C18', '=SUM(C12:C17)');

$HojaActiva->getStyle('D18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('D18', '=SUM(D12:D17)');

$HojaActiva->getStyle('E18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('E18', '=SUM(E12:E17)');

$HojaActiva->getStyle('F18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('F18', '=SUM(F12:F17)');

$HojaActiva->getStyle('G18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('G18', '=SUM(G12:E17)');

$HojaActiva->getStyle('H18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('H18', '=SUM(H12:H17)');

$HojaActiva->getStyle('I18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('I18', '=SUM(I12:I17)');

$HojaActiva->getStyle('J18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('J18', '=SUM(J12:J17)');

$HojaActiva->getStyle('K18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('K18', '=SUM(K12:K17)');

$HojaActiva->getStyle('L18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('L18', '=SUM(L12:L17)');

$HojaActiva->getStyle('M18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('M18', '=SUM(M12:M17)');

$HojaActiva->getStyle('N18')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('N18', '=SUM(N12:N17)');
$HojaActiva->getStyle('A18:N18')->getFont()->setBold(true);

// $HojaActiva->setCellValue('A19', $TotalIVAVentas);

$HojaActiva->setCellValue('A20', 'RESUMEN DATOS COMPRAS');
$HojaActiva->mergeCells("A20:N20");
$HojaActiva->getStyle('A20')->getFont()->setSize(20);
$HojaActiva->getStyle('A20')->getAlignment()->setHorizontal('center');

$HojaActiva->setCellValue('A21', 'Tipo');
$HojaActiva->setCellValue('B21', 'Exentas No Sujetas');
$HojaActiva->setCellValue('C21', 'Subtotal No Sujetas');
$HojaActiva->setCellValue('D21', 'IVA No Sujetas');
$HojaActiva->setCellValue('E21', 'Total No Sujetas');
$HojaActiva->setCellValue('F21', 'Exentas Servicios');
$HojaActiva->setCellValue('G21', 'Subtotal Servicios');
$HojaActiva->setCellValue('H21', 'IVA Servicios');
$HojaActiva->setCellValue('I21', 'Total Servicios');
$HojaActiva->setCellValue('J21', 'Exentas Bienes');
$HojaActiva->setCellValue('K21', 'Subtotal Bienes');
$HojaActiva->setCellValue('L21', 'IVA Bienes');
$HojaActiva->setCellValue('M21', 'Total Bienes');
$HojaActiva->setCellValue('N21', 'Total IVAS');

$HojaActiva->getStyle('A21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('B21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('C21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('D21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('E21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('F21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('G21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('H21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('I21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('J21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('K21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('L21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('M21')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('N21')->getAlignment()->setHorizontal('center');


$HojaActiva->getStyle('A21:N21')->getFont()->setBold(true);

$HojaActiva->getStyle('A21:N21')->applyFromArray($styleArrayBorder);
// $HojaActiva->getStyle('A21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('B21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('C21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('D21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('E21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('F21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('G21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('H21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('I21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('J21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('K21')->applyFromArray($styleArrayFill1);
// $HojaActiva->getStyle('L21')->applyFromArray($styleArrayFill2);
// $HojaActiva->getStyle('M21')->applyFromArray($styleArrayFill1);


$TotalIVACompras = 0;
$totIvaC1 = 0;
$totIvaC2 = 0;
$totIvaC3 = 0;

$Fila = 22;
for($i =0; $i < count($responserResuGastos); $i++){

    $totIvaC1 = 0;

    $TotalIVACompras = $TotalIVACompras + $responserResuGastos[$i]["ivaNOSUJETAS"] + $responserResuGastos[$i]["ivaSERVICIOS"] + $responserResuGastos[$i]["ivaBIENES"];
    $totIvaC1 =  $responserResuGastos[$i]["ivaNOSUJETAS"] + $responserResuGastos[$i]["ivaSERVICIOS"] + $responserResuGastos[$i]["ivaBIENES"];
    // $totIvaC2 = $totIvaC2 + $responserResuGastos[$i]["ivaSERVICIOS"];
    // $totIvaC3 = $totIvaC3 + $responserResuGastos[$i]["ivaBIENES"];

$HojaActiva->getColumnDimension('A')->setWidth(20);
$HojaActiva ->setCellValue('A'.$Fila, $responserResuGastos[$i]["tipo"]);

$HojaActiva->getStyle('B'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('B')->setWidth(20);
$HojaActiva ->setCellValue('B'.$Fila, $responserResuGastos[$i]["exentasNOSUJETAS"]);

$HojaActiva->getStyle('C'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('C')->setWidth(20);
$HojaActiva ->setCellValue('C'.$Fila, $responserResuGastos[$i]["subtotalNOSUJETAS"]);

$HojaActiva->getStyle('D'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('D')->setWidth(20);
$HojaActiva ->setCellValue('D'.$Fila, $responserResuGastos[$i]["ivaNOSUJETAS"]);

$HojaActiva->getStyle('E'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('E')->setWidth(20);
$HojaActiva ->setCellValue('E'.$Fila, $responserResuGastos[$i]["totalNOSUJETAS"]);

$HojaActiva->getStyle('F'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('F')->setWidth(20);
$HojaActiva ->setCellValue('F'.$Fila, $responserResuGastos[$i]["exentasSERVICIOS"]);

$HojaActiva->getStyle('G'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('G')->setWidth(20);
$HojaActiva ->setCellValue('G'.$Fila, $responserResuGastos[$i]["subtotalSERVICIOS"]);

$HojaActiva->getStyle('H'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('H')->setWidth(20);
$HojaActiva ->setCellValue('H'.$Fila, $responserResuGastos[$i]["ivaSERVICIOS"]);

$HojaActiva->getStyle('I'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('I')->setWidth(20);
$HojaActiva ->setCellValue('I'.$Fila, $responserResuGastos[$i]["totalSERVICIOS"]);

$HojaActiva->getStyle('J'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('J')->setWidth(20);
$HojaActiva ->setCellValue('J'.$Fila, $responserResuGastos[$i]["exentasBIENES"]);

$HojaActiva->getStyle('K'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('K')->setWidth(20);
$HojaActiva ->setCellValue('K'.$Fila, $responserResuGastos[$i]["subtotalBIENES"]);

$HojaActiva->getStyle('L'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('L')->setWidth(20);
$HojaActiva ->setCellValue('L'.$Fila, $responserResuGastos[$i]["ivaBIENES"]);

$HojaActiva->getStyle('M'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('M')->setWidth(20);
$HojaActiva ->setCellValue('M'.$Fila, $responserResuGastos[$i]["totalBIENES"]);

$HojaActiva->getStyle('N'.$Fila)->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getColumnDimension('N')->setWidth(20);
$HojaActiva ->setCellValue('N'.$Fila, $totIvaC1);



$HojaActiva->getStyle('A'.$Fila.':N'.$Fila)->applyFromArray($styleArrayBorder);

if($Fila % 2 == 0){

    $HojaActiva->getStyle('A'.$Fila.':N'.$Fila)->applyFromArray($styleArrayFill1);

}else{

    // $HojaActiva->getStyle('A'.$Fila.':M'.$Fila)->applyFromArray($styleArrayFill2);
}

$Fila = $Fila +1;
}

// $HojaActiva->getColumnDimension('N')->setWidth(20);
// $HojaActiva->getStyle('N22')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N22', $totIvaC1);
// $HojaActiva->getStyle('N23')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N23', $totIvaC2);
// $HojaActiva->getStyle('N24')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N24', $totIvaC3);
// $HojaActiva->getStyle('N25')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N25', '0');
// $HojaActiva->getStyle('N26')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N26', '0');
// $HojaActiva->getStyle('N27')->getNumberFormat()->setFormatCode('₡ #,##0.00');
// $HojaActiva ->setCellValue('N27', '0');

// IMPUESTO A FAVOR DE PERIODOS ANTERIORES
// CALCULO TOTAL IVA = SUM(IVA VENTAS) - SUM(IVA COMPRAS) - IMPUESTO A FAVOR DE PERIODOS ANTERIORES

$HojaActiva->setCellValue('A28', 'Total IVA');
$HojaActiva->getStyle('B28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('B28', '=SUM(B22:B27)');
$HojaActiva->getStyle('C28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('C28', '=SUM(C22:C27)');
$HojaActiva->getStyle('D28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('D28', '=SUM(D22:D27)');
$HojaActiva->getStyle('E28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('E28', '=SUM(E22:E27)');
$HojaActiva->getStyle('F28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('F28', '=SUM(F22:F27)');
$HojaActiva->getStyle('G28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('G28', '=SUM(G22:G27)');
$HojaActiva->getStyle('H28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('H28', '=SUM(H22:H27)');
$HojaActiva->getStyle('I28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('I28', '=SUM(I22:I27)');
$HojaActiva->getStyle('J28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('J28', '=SUM(J22:J27)');
$HojaActiva->getStyle('K28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('K28', '=SUM(K22:K27)');
$HojaActiva->getStyle('L28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('L28', '=SUM(L22:L27)');
$HojaActiva->getStyle('M28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('M28', '=SUM(M22:M27)');
$HojaActiva->getStyle('N28')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->setCellValue('N28', '=SUM(N22:N27)');

$HojaActiva->getStyle('A28:N28')->getFont()->setBold(true);
// $HojaActiva->setCellValue('A29', $TotalIVACompras);

// $HojaActiva->setCellValue('A29', '=D28+H28+L28');

// $TotalIVACompras

$HojaActiva->setCellValue('A33', 'TOTAL IVA A PAGAR');
$HojaActiva->mergeCells("A33:B33");
$HojaActiva->getStyle('A33')->getAlignment()->setHorizontal('center');
$HojaActiva->getStyle('A33:B33')->getFont()->setBold(true);
$HojaActiva->getStyle('A33:B33')->applyFromArray($styleArrayBorder);
$HojaActiva->setCellValue('A34', 'Total IVA Ventas');
$HojaActiva->setCellValue('A35', 'Total IVA Compras');
$HojaActiva->setCellValue('A36', 'IVA a Favor de Periodos Anteriores');
$HojaActiva->setCellValue('A37', 'TOTAL IVA A PAGAR');

$resultIva = $TotalIVAVentas - $TotalIVACompras - $ivaFavor;
$HojaActiva->getStyle('B34')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getStyle('A34:B34')->applyFromArray($styleArrayBorder);
$HojaActiva->setCellValue('B34', $TotalIVAVentas);

$HojaActiva->getStyle('B35')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getStyle('A35:B35')->applyFromArray($styleArrayBorder);
$HojaActiva->setCellValue('B35', '-'.$TotalIVACompras);

$HojaActiva->getStyle('B36')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getStyle('A36:B36')->applyFromArray($styleArrayBorder);
$HojaActiva->setCellValue('B36', '-'.$ivaFavor);

$HojaActiva->getStyle('B37')->getNumberFormat()->setFormatCode('₡ #,##0.00');
$HojaActiva->getStyle('A37:B37')->applyFromArray($styleArrayBorder);
$HojaActiva->setCellValue('B37', $resultIva);

// $HojaActiva->getStyle('A'.$Fila.':M'.$Fila)->applyFromArray($styleArrayBorder);







// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment;filename="Reporte Iva.xls"');
// header('Cache-Control: max-age=0');

// $writer = IOFactory::createWriter($Excel, 'Xls');
// $writer->save('php://output');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Iva-'.$DatosEmpresa[0]["nombre_ficticio"].'-'.$fechaDesde.'-'.$FechaHasta.'.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($Excel, 'Xlsx');
$writer->save('php://output');

