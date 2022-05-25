<?php

ini_set('memory_limit', '1024M');
ini_set('user_agent', 'My-Application/2.5');

$table = 'empresas.tbl_sistema_facturacion_facturas_P';
// CARGAR DATOS DE LAS FACTURAS EN ESTADO CONTINGENCIA 
$facturas = ClsEnviarFacturas::CargarFacturas($table);

for ($i = 0; $i < count($facturas); $i++) {

    $datosDetalleFactura = "";
    $datosFactura = "";

    $table = 'empresas.tbl_clientes';
    // CARGAR DATOS DEL CLIENTE
    $cliente = ClsEnviarFacturas::CargarDatosCliente($table, $facturas[$i]["id_compania"]);

    $table = 'empresas.tbl_sistema_facturacion_detalle_facturas_P';
    // CARGAR DETALLE DE LAS FACTURAS
    $detalleFactura = ClsEnviarFacturas::CargarDetalleFacturas($table, $facturas[$i]["idtbl_sistema_facturacion_facturas"]);

    // FOR QUE RECORRE EL DETALLE DE LAS FACTURAS Y CREA EL NODO DETALLE FACTURA EN EL JSON
    for ($j = 0; $j < count($detalleFactura); $j++) {
    
        $datosDetalleFactura .= '{							
                "numeroLinea":"'.($j + 1) .'",
                "cabys":"'.$detalleFactura[$j]["cabys"].'",
                "unidadMedida":"'.$detalleFactura[$j]["unidadMedida"].'",
                "tipoCodigoProducto":"01",
                "Codigo":"'.$detalleFactura[$j]["codigo"].'",
                "descripcionProducto":"'.$detalleFactura[$j]["nombre"].'",
                "cantidad":"'.$detalleFactura[$j]["cantidad"].'",
                "precioUnitario":"'.$detalleFactura[$j]["precio_unidad"].'",
                "costo":"'.$detalleFactura[$j]["costo"].'",
                "descuento":"'.$detalleFactura[$j]["descuento"].'",
                "motivoDescuento":"Descuento",
                "subTotal":"'.$detalleFactura[$j]["subtotal"].'",				
                "totalDetalle":"'.$detalleFactura[$j]["total"].'",									
                "tipoImpuesto":"'.$detalleFactura[$j]["codTasaImp"].'",
                "codTasaImpuesto":"'.$detalleFactura[$j]["codImpuesto"].'",
                "tasaImpuesto":"'.$detalleFactura[$j]["tasa_Impuesto"].'",
                "montoImpuesto":"'.$detalleFactura[$j]["impuesto"].'",
                "categoria":"'.$detalleFactura[$j]["categoria"].'"									
            },';
    }

    // RECORTAMOS LA ULTIMA (,) AGREGADA EN EL NODO
    $datosDetalleFactura = substr($datosDetalleFactura, 0, -1);

    // SE CREA EL NODO (FILECONTENT) DEL JSON
    $datosFactura = '{
        "fileContent":{
                    "datosEmisor":{
                        "usuario": "'.$cliente["usuario_facturacion"].'",
                        "password": "'.$cliente["contrasena_facturacion"].'",
                        "cedula":"'.$cliente["cedula"].'",
                        "id_empresa":"'.$facturas[$i]["id_compania"].'"						
                    } ,		
                    "datosReceptor":{
                        "nombre":"'.$facturas[$i]["correo_cliente"].'",
                        "tipoCedula":"'.$facturas[$i]["tipo_personeria"].'",
                        "cedula":"'.$facturas[$i]["cedula_cliente"].'",
                        "direccion": "LOCAL COMERCIAL",
                        "correo":"'.$facturas[$i]["correo_cliente"].'",
                        "telefono":"11111111",
                        "provincia": "",
                        "canton": "",
                        "distrito": "",
                        "senas": ""
                    },			
                    "datosFactura":{
                        "sucursal":"'.$facturas[$i]["sucursal"].'",
                        "caja":"'.$facturas[$i]["caja"].'",
                        "tipoDoc":"'.$facturas[$i]["tipo_documento"].'",
                        "moneda":"'.$facturas[$i]["codigo_moneda"].'",					
                        "condicionVenta":"'.$facturas[$i]["condicion_venta"].'",
                        "plazoCredito":"'.$facturas[$i]["plazo_credito"].'",
                        "medioPago":"'.$facturas[$i]["medios_pago"].'",
                        "tipoCambio":"'.$facturas[$i]["tipo_cambio"].'",
                        "actividadEconomica":"'.$facturas[$i]["codigo_actividad"].'",
                        "api":"'.$facturas[$i]["api"].'",
                        "estadoAnulacion":"'.$facturas[$i]["estado_anulacion"].'",
                        "comentario":"'.$facturas[$i]["comentarios"].'",
                        "consecutivoHacienda":"'.$facturas[$i]["consecutivo"].'",
                        "claveHacienda":"'.$facturas[$i]["clave"].'",	
                        "detalleFactura":['.$datosDetalleFactura.']															
                    }
            }              
    }';

    // SE ENVIAN LOS DATOS AL API DE FACTURAS CONTINGENCIA PARA SER ENVIADA A HACIENDA
    $Resultado = ClsEnviarFacturas::EnviarFacturaApi($datosFactura);

    echo $Resultado;
}

class ClsEnviarFacturas{


    static public function conexion(){

		$link = new PDO("mysql:host=midigitalsat.com;dbname=empresas",
			            "admin",
			            "Heriberto9109");

		$link->exec("set names utf8");

		return $link;
	}


    static public function CargarFacturas($table) {

        $stmt = ClsEnviarFacturas::conexion()->prepare("SELECT * FROM $table WHERE estado_factura = 'contingencia'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    static public function CargarDatosCliente($table, $idEmpresa) {

        $stmt = ClsEnviarFacturas::conexion()->prepare("SELECT usuario_facturacion, contrasena_facturacion, cedula FROM $table WHERE idtbl_clientes = '$idEmpresa'");

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt =null;

    }

    static public function CargarDetalleFacturas($table, $idFactura) {

        $stmt = ClsEnviarFacturas::conexion()->prepare("SELECT * FROM $table WHERE id_factura = '$idFactura'");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

    }

    public function EnviarFacturaApi($datosFactura){
 
        $ch = curl_init("http://localhost/outthebox/api/api-facturacion-contingencia-envio.controller.php");
  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$datosFactura);

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
            
    }

}



