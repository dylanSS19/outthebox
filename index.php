<?php 

 

require_once  "controllers/template.controller.php";

require_once  "controllers/users.controller.php";
require_once  "controllers/home.controller.php";
require_once  "controllers/clientes.controller.php";
require_once  "controllers/categoria-servicios.controller.php";
require_once  "controllers/subcategoria-servicios.controller.php";
require_once  "controllers/movimiento-saldos.controller.php";
require_once  "controllers/mover-saldo-bodegas.controller.php";
require_once  "controllers/creacion-usuarios-clientes.controller.php";
require_once  "controllers/recuperar-contrasena-frm1.controller.php";
require_once  "controllers/reporte-sistema-facturacion.controller.php";
require_once  "controllers/sucursal-cajas-facturacion.controller.php";
require_once  "controllers/sistema-facturas-productos.controller.php";
require_once  "controllers/sistema-facturas-clientes.controller.php";
require_once  "controllers/reporte-ventas-tiendas.controller.php";
require_once  "controllers/inicio-facturacion.controller.php";
require_once  "controllers/sistema-facturas-facturacion.controller.php";
require_once  "controllers/sistema-facturas-actividadEco.controller.php";
require_once  "controllers/ad-personal.controller.php";
require_once  "controllers/consulta-empleados.controller.php";
require_once  "controllers/sistema-facturas-crearFatura.controller.php";
require_once  "controllers/agregar-empleados.controller.php";
require_once  "controllers/salida-empleados.controller.php";
require_once  "controllers/aceptacion-inventarios.controller.php";
require_once  "controllers/reporte-control-calidad.controller.php";
require_once  "controllers/reporte-ventas-dth.controller.php";
require_once  "controllers/reporte-ventas-bodega.controller.php";
require_once  "controllers/sistema-facturas-reporte-gastos.controller.php";
require_once  "controllers/planes-categoria.controller.php";
require_once  "controllers/planes-clientes.controller.php";
require_once  "controllers/sidebar.controller.php";
require_once  "controllers/sistema-facturas-reporte-iva.controller.php";
require_once  "controllers/aceptacion-planes-clientes.controller.php";
require_once  "controllers/sistema-facturas-datosFacturacion.controller.php";
require_once  "controllers/sistema-facturas-clientes-masivo.controller.php";
require_once  "controllers/control-asistencia.controller.php";
require_once  "controllers/Dashboard-general.controller.php";
require_once  "controllers/emision-facturas.controller.php";
require_once  "controllers/emision-facturas-facturar.controller.php";




require_once  "models/reporte-ventas-tiendas-model.php";
require_once  "models/users.model.php";
require_once  "models/home.model.php";
require_once  "models/clientes.model.php";
require_once  "models/categoria-servicios.model.php";
require_once  "models/subcategoria-servicios.model.php";
require_once  "models/movimiento-saldos.model.php";
require_once  "models/mover-saldo-bodegas.model.php";
require_once  "models/creacion-usuarios-clientes.model.php";
require_once  "models/recuperar-contrasena-frm1.model.php";
require_once  "models/reporte-sistema-facturacion.model.php";
require_once  "models/sucursal-cajas-facturacion.model.php";
require_once  "models/sistema-facturas-productos.model.php";
require_once  "models/sistema-facturas-clientes.model.php";
require_once  "models/inicio-facturacion.model.php";
require_once  "models/sistema-facturas-facturacion.model.php";
require_once  "models/sistema-facturas-actividadEco.model.php";
require_once  "models/ad-personal.model.php";
require_once  "models/consulta-empleados.model.php";
require_once  "models/sistema-facturas-crearFatura.model.php";
require_once  "models/agregar-empleados.model.php";
require_once  "models/salida-empleados.model.php";
require_once  "models/aceptacion-inventarios.model.php";
require_once  "models/reporte-control-calidad.model.php";
require_once  "models/reporte-ventas-dth.model.php";
require_once  "models/reporte-ventas-bodega.model.php";
require_once  "models/sistema-facturas-reporte-gastos.model.php";
require_once  "models/planes-categoria.model.php";
require_once  "models/planes-clientes.model.php";
require_once  "models/sidebar.model.php";
require_once  "models/sistema-facturas-reporte-iva.model.php";
require_once  "models/aceptacion-planes-clientes.model.php";
require_once  "models/sistema-facturas-datosFacturacion.model.php";
require_once  "models/sistema-facturas-clientes-masivo.model.php";
require_once  "models/control-asistencia.model.php";
require_once  "models/Dashboard-general.model.php";
require_once  "models/emision-facturas.model.php";
require_once  "models/emision-facturas-facturar.model.php";





require_once  "extensions/vendor/autoload.php";

$template = new ControllerTemplate();
$template -> ctrTemplate();