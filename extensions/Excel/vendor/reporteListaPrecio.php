<?php

require 'autoload.php';
require "../../../controllers/sistema-facturas-clientes-masivo.controller.php";
require "../../../models/sistema-facturas-clientes-masivo.model.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Alignament;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
 

// session_start();
$idempresa =  $_POST["empresa"];

$response = controladorClientesMasivos::ctrCargarListasPrecio($idempresa);

gc_collect_cycles();
clearstatcache();

if (file_exists("../../../extensions/DocumentacionClientes/'Reporte Lista Precio'.xlsx")) {
    unlink("../../../extensions/DocumentacionClientes/'Reporte Lista Precio.xlsx'");
 } else {
     // echo "The file $filename does not exist";
 }

 gc_collect_cycles();
 clearstatcache();
// exit();

$Excel = new Spreadsheet();

$Excel ->createSheet();

$Excel->getDefaultStyle()->getFont()->setName('Calibri');

$HojaActiva =$Excel->setActiveSheetIndex(0);

$HojaActiva ->setTitle("Listas Precio");

$HojaActiva ->setCellValue('A1', "ID LISTA PRECIO");
$HojaActiva ->setCellValue('B1', "NOMBRE LISTA PRECIO");

foreach (range('A','B') as $col) {
    $HojaActiva->getColumnDimension($col)->setAutoSize(true);  
}

$Fila = 2;
for($i =0; $i < count($response); $i++){

$HojaActiva ->setCellValue('A'.$Fila, $response[$i]["idtbl_listas_precio"]);
$HojaActiva ->setCellValue('B'.$Fila, $response[$i]["nombre"]);

$Fila = $Fila +1;
}


// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="Reporte_Lista_Precio_'.$idempresa.'.xlsx"');
// header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($Excel, 'Xlsx');
$writer->save('../../../extensions/DocumentacionClientes/Reporte Lista Precio.xlsx');

