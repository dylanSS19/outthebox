<?php

require_once "../controllers/sistema-facturas-crearFatura.controller.php";
require_once "../models/sistema-facturas-crearFatura.model.php";

class ajaxCrearFactura{
 
     public $listPrecio;
     public $listTope;
     public $IdProd;

    public function ajaxCargarPrecioProductosXid(){

    $IdProd = $this->IdProd;
    $listPrecio = $this->listPrecio;
    $listTope = $this->listTope;

      $response = CrearFactController::ctrCargarPrecioProductosXid($listPrecio, $listTope, $IdProd);

      echo json_encode($response);

  }

  public $Idcliente;

  public function ajaxCargarClientes(){

  $Idcliente = $this->Idcliente;

    $response = CrearFactController::ctrCargarDatosClientes($Idcliente);

    echo json_encode($response);

}

public $Idbodega;

public function ajaxCargarBodega(){

$Idbodega = $this->Idbodega;

  $response = CrearFactController::ctrCargarBodega($Idbodega);

  echo json_encode($response);

}


public $bodega_ID;
public $producto;

public function ajaxCargarInvetarioStock(){

$bodega_ID = $this->bodega_ID;
$producto = $this->producto;

  $response = CrearFactController::ctrCargarInvetarioStock($bodega_ID, $producto);

  echo json_encode($response);

}

public $Lprecio;
public $Ltope;

public function ajaxCargarProductosCel(){

$Lprecio = $this->Lprecio;
$Ltope = $this->Ltope;

  $response = CrearFactController::ctrCargarProductosCel($Lprecio, $Ltope);

  echo json_encode($response);

}


public $fecha;
public $tipo_pago;
public $tipo_documento;
public $cedula;
public $nombre;
public $correo;
public $direccion;
public $usuario;
public $estado;
public $numero_consecutivo;
public $clave;
public $estado_hacienda;
public $id_empresa;
public $ruta;
public $tipo;
public $fecha_emision;

    public function ajaxInsertFactura(){

    $fecha = $this->fecha;
    $tipo_pago = $this->tipo_pago;
    $tipo_documento = $this->tipo_documento;
    $cedula = $this->cedula;
    $nombre = $this->nombre;
    $correo = $this->correo;
    $telefono = $this->telefono;
    $direccion = $this->direccion;
    $usuario = $this->usuario;
    $estado = $this->estado;
    $numero_consecutivo = $this->numero_consecutivo;
    $clave = $this->clave;
    $estado_hacienda = $this->estado_hacienda;
    $id_empresa = $this->id_empresa;
    $ruta = $this->ruta;
    $tipo = $this->tipo;
    $fecha_emision = $this->fecha_emision;

    $response = CrearFactController::ctrInsertFactura($fecha, $tipo_pago, $tipo_documento, $cedula, $nombre, $correo, $direccion, $telefono, $usuario, $estado, $numero_consecutivo, $clave, $estado_hacienda, $id_empresa, $ruta, $tipo, $fecha_emision);

    echo $response;

    }


    public $id_factura;
    public $descripcion;
    public $cantidad;
    public $precio_unitario;
    public $descuento;
    public $descuento_aplicado;
    public $impuesto;
    public $total;
    public $tasa_cambio;
    public $cabys;
    public $sku;
   
    
        public function ajaxInsertDetalleFactura(){
    
        $id_factura = $this->id_factura;
        $descripcion = $this->descripcion;
        $cantidad = $this->cantidad;
        $precio_unitario = $this->precio_unitario;
        $descuento = $this->descuento;
        $descuento_aplicado = $this->descuento_aplicado;
        $impuesto = $this->impuesto;
        $total = $this->total;
        $tasa_cambio = $this->tasa_cambio;
        $cabys = $this->cabys;
        $sku = $this->sku;
         
        $response = CrearFactController::ctrInsertDetalleFactura($id_factura, $descripcion, $cantidad, $precio_unitario, $descuento, $descuento_aplicado, $impuesto, $total, $tasa_cambio, $cabys, $sku);
    
        echo $response;
    
        }


        public $EditarFactId;
        public $Editarsubtotal;
        public $Editartotal;
        public $Editartotal_iva;
        public $Editardescuento;
        
            public function ajaxModificarTotalesFactura(){
        
            $EditarFactId = $this->EditarFactId;
            $Editarsubtotal = $this->Editarsubtotal;
            $Editartotal = $this->Editartotal;
            $Editartotal_iva = $this->Editartotal_iva;
            $Editardescuento = $this->Editardescuento;

                         
            $response = CrearFactController::ctrModificarTotalesFactura($EditarFactId, $Editarsubtotal, $Editartotal, $Editartotal_iva, $Editardescuento);
        
            echo $response;
        
            }

            public $bodegaStock;
            public $skuProd;
            public function ajaxCargarUltimoStock(){
        
            $bodegaStock = $this->bodegaStock;
            $skuProd = $this->skuProd;
                         
            $response = CrearFactController::ctrCargarUltimoStock($bodegaStock, $skuProd);
        
            echo json_encode($response);
        
            }

            public $cedulaProveedor;
            public $idEmpresa;
            public function ajaxCargarEstadoCredito(){
        
            $cedulaProveedor = $this->cedulaProveedor;
            $idEmpresa = $this->idEmpresa;
                
            $response = CrearFactController::ctrCargarEstadoCredito($cedulaProveedor, $idEmpresa);
        
            echo json_encode($response);
        
            }

            public $consecutivo;
            public $clave_Hacienda;    
            public $tipo_Factura;
            public $fechaFac;
            public $ced_proveedor;
            public $comentario;
            public $monto_exento;
            public $monto_base;
            public $porcentaje_iva;
            public $iva;
            public $descuentoFac;
            public $totalFac;
            public $dias_credito;
            public $fecha_vencimiento;
            public $usuarioFac;
            public $saldo;    
            public $estadoFac;
            public $factura;
            public $empresa;
            public function ajaxInsertFacCredito(){
        
            $consecutivo = $this->consecutivo;
            $clave_Hacienda = $this->clave_Hacienda;
            $fechaFac = $this->fechaFac;
            $tipo_Factura = $this->tipo_Factura;
            $ced_proveedor = $this->ced_proveedor;
            $comentario = $this->comentario;
            $monto_exento = $this->monto_exento;
            $monto_base = $this->monto_base;
            $porcentaje_iva = $this->porcentaje_iva;
            $iva = $this->iva;
            $descuentoFac = $this->descuentoFac;
            $totalFac = $this->totalFac;
            $dias_credito = $this->dias_credito;
            $fecha_vencimiento = $this->fecha_vencimiento;
            $usuarioFac = $this->usuarioFac;
            $saldo = $this->saldo;
            $estadoFac = $this->estadoFac;
            $factura = $this->factura;
            $empresa = $this->empresa;

            $response = CrearFactController::ctrInsertFacCredito($consecutivo, $clave_Hacienda, $fechaFac, $tipo_Factura, $ced_proveedor, $comentario, $monto_exento, $monto_base, $porcentaje_iva, $iva, $descuentoFac, $totalFac, $dias_credito, $fecha_vencimiento, $usuarioFac, $saldo, $estadoFac, $factura, $empresa);
        
            echo $response;
        
            }



            public $idFacturaMov;
            public $consecutivoMov;    
            public $tipo_movimientoMov;
            public $codigoMov;
            public $productoMov;
            public $stockMov;
            public $cantidadMov;
            public $costo_promedioMov;
            public $origenMov;
            public $destinoMov;
            public $usuarioMov;
            public $estadoMov;
            public $comentarioMov;
            public $bodegaMov;
            public $totalMov;
            public $fecha_ingresoMov;

            public function ajaxInsertMovimientoInventario(){
        
            $idFacturaMov = $this->idFacturaMov;
            $consecutivoMov = $this->consecutivoMov;
            $tipo_movimientoMov = $this->tipo_movimientoMov;
            $codigoMov = $this->codigoMov;
            $productoMov = $this->productoMov;
            $stockMov = $this->stockMov;
            $cantidadMov = $this->cantidadMov;
            $costo_promedioMov = $this->costo_promedioMov;
            $origenMov = $this->origenMov;
            $destinoMov = $this->destinoMov;
            $usuarioMov = $this->usuarioMov;
            $estadoMov = $this->estadoMov;
            $comentarioMov = $this->comentarioMov;
            $bodegaMov = $this->bodegaMov;
            $totalMov = $this->totalMov;
            $fecha_ingresoMov = $this->fecha_ingresoMov;

            $response = CrearFactController::ctrInsertMovimientoInventario($idFacturaMov, $consecutivoMov, $tipo_movimientoMov, $codigoMov, $productoMov, $stockMov, $cantidadMov, $costo_promedioMov, $origenMov, $destinoMov, $usuarioMov, $estadoMov, $comentarioMov, $bodegaMov, $totalMov , $fecha_ingresoMov);
        
            echo $response;
        
            }


            public $empresaSucursal;
            public function ajaxCargarSucursal(){
        
            $empresaSucursal = $this->empresaSucursal;
                
            $response = CrearFactController::ctrCargarSucursal($empresaSucursal);
        
            echo json_encode($response);
        
        }
            
}

if(isset($_POST["IdProducto"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> IdProd = $_POST["IdProducto"];
    $edit -> listPrecio = $_POST["listPrecio"];
    $edit -> listTope = $_POST["listTope"];
  
    $edit -> ajaxCargarPrecioProductosXid();
  
  }

  if(isset($_POST["idCliente"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> Idcliente = $_POST["idCliente"];
  
    $edit -> ajaxCargarClientes();
  
  }

  if(isset($_POST["idbodega"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> Idbodega = $_POST["idbodega"];
  
    $edit -> ajaxCargarBodega();
  
  }

  if(isset($_POST["bodega_ID"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> bodega_ID = $_POST["bodega_ID"];
    $edit -> producto = $_POST["product"];
  
    $edit -> ajaxCargarInvetarioStock();
  
  }

  if(isset($_POST["listPrecio2"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> Lprecio = $_POST["listPrecio2"];
    $edit -> Ltope = $_POST["listTope2"];
  
    $edit -> ajaxCargarProductosCel();
  
  }

  if(isset($_POST["cedula"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> fecha = $_POST["fecha"];
    $edit -> tipo_pago = $_POST["tipo_pago"];
    $edit -> tipo_documento = $_POST["tipo_documento"];
    $edit -> cedula = $_POST["cedula"];
    $edit -> nombre = $_POST["nombre"];
    $edit -> correo = $_POST["correo"];
    $edit -> telefono = $_POST["telefono"];
    $edit -> direccion = $_POST["direccion"];
    $edit -> usuario = $_POST["usuario"];
    $edit -> estado = $_POST["estado"];
    $edit -> numero_consecutivo = $_POST["numero_consecutivo"];
    $edit -> clave = $_POST["clave"];
    $edit -> estado_hacienda = $_POST["estado_hacienda"];
    $edit -> id_empresa = $_POST["id_empresa"];
    $edit -> ruta = $_POST["ruta"];
    $edit -> tipo = $_POST["tipo"];
    $edit -> fecha_emision = $_POST["fecha_emision"];

    $edit -> ajaxInsertFactura();
  
  }

  if(isset($_POST["id_factura"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> id_factura = $_POST["id_factura"];
    $edit -> descripcion = $_POST["descripcion"];
    $edit -> cantidad = $_POST["cantidad"];
    $edit -> precio_unitario = $_POST["precio_unitario"];
    $edit -> descuento = $_POST["descuento"];
    $edit -> descuento_aplicado = $_POST["descuento_aplicado"];
    $edit -> impuesto = $_POST["impuesto"];
    $edit -> impuesto = $_POST["impuesto"];
    $edit -> total = $_POST["total"];
    $edit -> tasa_cambio = $_POST["tasa_cambio"];
    $edit -> cabys = $_POST["cabys"];
    $edit -> sku = $_POST["sku"];

    $edit -> ajaxInsertDetalleFactura();
  
  }

  if(isset($_POST["EditFactId"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> EditarFactId = $_POST["EditFactId"];
    $edit -> Editarsubtotal = $_POST["Edisubtotal"];
    $edit -> Editartotal = $_POST["Editotal"];
    $edit -> Editartotal_iva = $_POST["Editotal_iva"];
    $edit -> Editardescuento = $_POST["Edidescuento"];

    $edit -> ajaxModificarTotalesFactura();
  
  }

  if(isset($_POST["bodegaStock"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> bodegaStock = $_POST["bodegaStock"];
    $edit -> skuProd = $_POST["skuProd"];

    $edit -> ajaxCargarUltimoStock();
  
  }
  
  if(isset($_POST["cedulaProv"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> cedulaProveedor = $_POST["cedulaProv"];
    $edit -> idEmpresa = $_POST["empresaID"];
    
    $edit -> ajaxCargarEstadoCredito();
  
  }

  if(isset($_POST["cedula_proveedor"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> consecutivo = $_POST["numero_consecutivo"];
    $edit -> clave_Hacienda = $_POST["clave_Hacienda"];
    $edit -> tipo_Factura = $_POST["tipo_Factura"];
    $edit -> fechaFac = $_POST["fecha"];
    $edit -> ced_proveedor = $_POST["cedula_proveedor"];
    $edit -> comentario = $_POST["descripcion"];
    $edit -> monto_exento = $_POST["monto_exento"];
    $edit -> monto_base = $_POST["monto_base"];
    $edit -> porcentaje_iva = $_POST["porcentaje_iva"];
    $edit -> iva = $_POST["iva"];
    $edit -> descuentoFac = $_POST["descuento"];
    $edit -> totalFac = $_POST["total"];
    $edit -> dias_credito = $_POST["dias_credito"];
    $edit -> fecha_vencimiento = $_POST["fecha_vencimiento"];
    $edit -> usuarioFac = $_POST["usuario"];
    $edit -> saldo = $_POST["saldo"];
    $edit -> estadoFac = $_POST["estado"];
    $edit -> factura = $_POST["factura"];
    $edit -> empresa = $_POST["empresa"];
    
    $edit -> ajaxInsertFacCredito();
  
  }

  if(isset($_POST["idFacturaMov"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> idFacturaMov = $_POST["idFacturaMov"];
    $edit -> consecutivoMov = $_POST["consecutivoMov"];
    $edit -> tipo_movimientoMov = $_POST["tipo_movimientoMov"];
    $edit -> codigoMov = $_POST["codigoMov"];
    $edit -> productoMov = $_POST["productoMov"];
    $edit -> stockMov = $_POST["stockMov"];
    $edit -> cantidadMov = $_POST["cantidadMov"];
    $edit -> costo_promedioMov = $_POST["costo_promedioMov"];
    $edit -> origenMov = $_POST["origenMov"];
    $edit -> destinoMov = $_POST["destinoMov"];
    $edit -> usuarioMov = $_POST["usuarioMov"];
    $edit -> estadoMov = $_POST["estadoMov"];
    $edit -> comentarioMov = $_POST["comentarioMov"];
    $edit -> bodegaMov = $_POST["bodegaMov"];
    $edit -> totalMov = $_POST["total_prodMov"];
    $edit -> fecha_ingresoMov = $_POST["fecha_ingresoMov"];

    $edit -> ajaxInsertMovimientoInventario();
  
  }

  if(isset($_POST["empresaSucursal"])){

    $edit = new ajaxCrearFactura();
  
    $edit -> empresaSucursal = $_POST["empresaSucursal"];
    
    $edit -> ajaxCargarSucursal();
  
  }

  