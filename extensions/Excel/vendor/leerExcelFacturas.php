<?php
 
# Cargar librerias y cosas necesarias
require_once "autoload.php";
require "../../../controllers/emision-facturas.controller.php";
require "../../../models/emision-facturas.model.php";
  
# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
# Recomiendo poner la ruta absoluta si no está junto al script
# Nota: no necesariamente tiene que tener la extensión XLSX

$idempresa =  $_POST["empresa"];
$Documento =  $_POST["Documento"];
$sucursal =  $_POST["sucursal"];
$caja =  $_POST["caja"];
$actividad =  $_POST["actividad"];

$rutaArchivo = "../../../extensions/ExcelFacturas/".$idempresa."/".$Documento.".xlsx";

$documento = IOFactory::load($rutaArchivo);

# Recuerda que un documento puede tener múltiples hojas
# obtener conteo e iterar
$totalDeHojas = $documento->getSheetCount();

# Iterar hoja por hoja
// for ($indiceHoja = 0; $indiceHoja < $totalDeHojas; $indiceHoja++) {
    $indiceHoja = 0;
    # Obtener hoja en el índice que vaya del ciclo
    $hojaActual = $documento->getSheet($indiceHoja);
  
    # Calcular el máximo valor de la fila como entero, es decir, el
    # límite de nuestro ciclo
    $numeroMayorDeFila = $hojaActual->getHighestRow(); // Numérico
    $letraMayorDeColumna = $hojaActual->getHighestColumn(); // Letra
    # Convertir la letra al número de columna correspondiente
    $numeroMayorDeColumna = Coordinate::columnIndexFromString($letraMayorDeColumna);

    # Iterar filas con ciclo for e índices
    for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {

        // $coordenadas = "A".$indiceFila;
    $CoorNombre = "A".$indiceFila;
    $celdaNombre = $hojaActual->getCell($CoorNombre);
    $Nombre = $celdaNombre->getValue();

    $CoorCedula = "B".$indiceFila;
    $celdaCedula = $hojaActual->getCell($CoorCedula);
    $Cedula = $celdaCedula->getValue();

    $CoorCodigo_cliente = "C".$indiceFila;
    $celdaCodigo_cliente = $hojaActual->getCell($CoorCodigo_cliente);
    $Codigo_cliente = $celdaCodigo_cliente->getValue();

    $CoorTipo = "D".$indiceFila;
    $celdaTipo = $hojaActual->getCell($CoorTipo);
    $Tipo = $celdaTipo->getValue();

    $CoorConcepto = "E".$indiceFila;
    $celdaConcepto = $hojaActual->getCell($CoorConcepto);
    $Concepto = $celdaConcepto->getValue();

    $CoorCodigo_articulo = "F".$indiceFila;
    $celdaCodigo_articulo = $hojaActual->getCell($CoorCodigo_articulo);
    $Codigo_articulo = $celdaCodigo_articulo->getValue();

    $CoorCodigo_cabys = "G".$indiceFila;
    $celdaCodigo_cabys = $hojaActual->getCell($CoorCodigo_cabys);
    $Codigo_cabys = $celdaCodigo_cabys->getValue();

    $CoorCosto = "H".$indiceFila;
    $celdaCosto = $hojaActual->getCell($CoorCosto);
    $Costo = $celdaCosto->getValue();

    $CoorDescuento = "I".$indiceFila;
    $celdaDescuento = $hojaActual->getCell($CoorDescuento);
    $Descuento = $celdaDescuento->getValue();

    $CoorPorcentaje_descuento = "J".$indiceFila;
    $celdaPorcentaje_descuento = $hojaActual->getCell($CoorPorcentaje_descuento);
    $Porcentaje_descuento = $celdaPorcentaje_descuento->getValue();

    $CoorTotal = "K".$indiceFila;
    $celdaTotal = $hojaActual->getCell($CoorTotal);
    $Total = $celdaTotal->getValue();

    $CoorComentarios = "L".$indiceFila;
    $celdaComentarios = $hojaActual->getCell($CoorComentarios);
    $Comentarios = $celdaComentarios->getValue();

    $CoorProcentaje_impuesto = "M".$indiceFila;
    $celdaProcentaje_impuesto = $hojaActual->getCell($CoorProcentaje_impuesto);
    $Procentaje_impuesto = $celdaProcentaje_impuesto->getValue();

    $CoorMonto_impuesto = "N".$indiceFila;
    $celdaMonto_impuesto = $hojaActual->getCell($CoorMonto_impuesto);
    $Monto_impuesto = $celdaMonto_impuesto->getValue();

    $CoorSubtotal = "O".$indiceFila;
    $celdaSubtotal = $hojaActual->getCell($CoorSubtotal);
    $Subtotal = $celdaSubtotal->getValue();

    $CoorGran_total = "P".$indiceFila;
    $celdaGran_total = $hojaActual->getCell($CoorGran_total);
    $Gran_total = $celdaGran_total->getValue();

    $CoorCorreoelectronico = "Q".$indiceFila;
    $celdaCorreoelectronico = $hojaActual->getCell($CoorCorreoelectronico);
    $Correoelectronico = $celdaCorreoelectronico->getValue();
    // $CoorNombre = "R1"; consecutivo
    // $CoorNombre = "S1"; clave
    $CoorNumero_factura = "T".$indiceFila;
    $celdaNumero_factura = $hojaActual->getCell($CoorNumero_factura);
    $Numero_factura = $celdaNumero_factura->getValue();

    $CoorCantidad = "U".$indiceFila;
    $celdaCantidad = $hojaActual->getCell($CoorCantidad);
    $Cantidad = $celdaCantidad->getValue();

    $CoorVendedor = "V".$indiceFila;
    $celdaVendedor = $hojaActual->getCell($CoorVendedor);
    $Vendedor = $celdaVendedor->getValue();

    $CoorAgente_Reparto = "W".$indiceFila;
    $celdaAgente_Reparto = $hojaActual->getCell($CoorAgente_Reparto);
    $Agente_Reparto = $celdaAgente_Reparto->getValue();


if(strlen($Cedula) == 9){
    $tipo_documento = "01";
    $tipo_personeria = "01";
}elseif(strlen($Cedula) == 10){
    $tipo_documento = "01";
    $tipo_personeria = "02";
}elseif(strlen($Cedula) >= 11 && strlen($Cedula) <= 12){
    $tipo_documento = "01";
    $tipo_personeria = "03";
}else{
    $tipo_documento = "04";
    $tipo_personeria = "01";
    $Cedula = "111111111";
}

date_default_timezone_set('America/Costa_Rica');
    $data = array("nombreCliente" => $Nombre,
    "cedulaCliente" => $Cedula,
    "codigoCliente" => $Codigo_cliente,
    "tipoCliente" => $Tipo,
    "CorreoCliente" =>  $Correoelectronico,
    "numFactura"=> $Numero_factura,
    "sucursal" => $sucursal,
    "caja" => $caja,
    "fecha_factura" => date('Y-m-d h:i:s'),
    "codigo_actividad" => $actividad,
    "tipo_documento" => $tipo_documento,
    "tipo_personeria" => $tipo_personeria,
    "tipo_cambio" => "1",
    "codigo_moneda" => "CRC",
    "estado_factura" => "Pendiente",
    "plazo_credito" => "0",
    "medios_pago" => "01",
    "empresa" => $idempresa,
    "vendedor" => $Vendedor,
    "Agente_Reparto" => $Agente_Reparto
    );

    $response = EmisionFacturasController::ctrAgregarFactura($data);

    if($Procentaje_impuesto == 13){
        $codImpuesto = "08";
    }elseif($Procentaje_impuesto == 0){
        $codImpuesto = "0";
    }elseif($Procentaje_impuesto == 1){
        $codImpuesto = "02";
    }elseif($Procentaje_impuesto == 2){
        $codImpuesto = "03";  
    }elseif($Procentaje_impuesto == 4){
        $codImpuesto = "04";  
    }


    $dataDetalle = array("id_factura" => $Numero_factura,
    "codigo" => $Codigo_articulo,
    "nombre" => $Concepto,
    "cantidad" => $Cantidad,
    "precio_unidad" =>  $Costo,
    "subtotal"=> $Subtotal,
    "descuento" => $Descuento,
    "impuesto" => $Monto_impuesto,
    "total" => $Gran_total,
    "costo" => 0,
    "cabys" => $Codigo_cabys,
    "tasa_Impuesto" => $Procentaje_impuesto,
    "codImpuesto" => "01",
    "codTasaImp" => $codImpuesto,
    "porcentaje_descuento" => $Porcentaje_descuento
    );
    
    $response = EmisionFacturasController::ctrAgregarDetalleFactura($dataDetalle);
        // echo json_encode($data);
       

        // exit();

        // for ($indiceColumna = 1; $indiceColumna <= $numeroMayorDeColumna; $indiceColumna++) {
        //     # Obtener celda por columna y fila
        //     $celda = $hojaActual->getCellByColumnAndRow($indiceColumna, $indiceFila);
        //     # Y ahora que tenemos una celda trabajamos con ella igual que antes
        //     # El valor, así como está en el documento
        //     $valorRaw = $celda->getValue();

        //     # Formateado por ejemplo como dinero o con decimales
        //     $valorFormateado = $celda->getFormattedValue();

        //     # Si es una fórmula y necesitamos su valor, llamamos a:
        //     $valorCalculado = $celda->getCalculatedValue();

        //     # Fila, que comienza en 1, luego 2 y así...
        //     $fila = $celda->getRow();
        //     # Columna, que es la A, B, C y así...
        //     $columna = $celda->getColumn();

        //     // echo "En $columna $fila tenemos el valor $valorRaw ";
            
        // }
    }

    echo "ok";


// }