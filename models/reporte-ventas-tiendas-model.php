<?php

require_once "connexion.php";

class reporteVentasTiendasModel{
  
 

static public function Mdlventastiendas($table,$table2,$table3,$table4, $startDate, $endDate, $table9,$supervisor,$table5) {
			
		
if($supervisor==""){	

			$stmt = Connexion::connect()->prepare("SELECT a.fecha_venta,ifnull(b.pospago,0) as pospago,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0)  as accesorios from (Select  fecha as fecha_venta from $table9 where fecha between '$startDate' and  '$endDate' group by fecha order by fecha) as a
      left join (select count(contrato) as pospago,fecha_venta from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by fecha_venta) as b on a.fecha_venta=b.fecha_venta
      left join (select count(cantidad) as claro,fecha from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' group by fecha)  as c on c.fecha=a.fecha_venta
      left join (select count(cantidad) as digital,fecha from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' group by fecha)  as d on d.fecha=a.fecha_venta
       left join (select count(cantidad) as accesorios,fecha from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' group by fecha)  as e on e.fecha=a.fecha_venta
	"); 

	}else{

$stmt = Connexion::connect()->prepare("SELECT a.fecha_venta,ifnull(b.pospago,0) as pospago,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0)  as accesorios from (Select  fecha as fecha_venta from $table9 where fecha between '$startDate' and  '$endDate' group by fecha order by fecha) as a
      left join (select count(contrato) as pospago,fecha_venta from $table where fecha_venta between '$startDate' and  '$endDate' and  tienda in(SELECT tienda FROM  $table5 where usuario='$supervisor') and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by fecha_venta) as b on a.fecha_venta=b.fecha_venta
      left join (select count(cantidad) as claro,fecha from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda in(SELECT tienda FROM $table5 where usuario='$supervisor') group by fecha)  as c on c.fecha=a.fecha_venta
      left join (select count(cantidad) as digital,fecha from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda in(SELECT tienda FROM $table5 where usuario='$supervisor') group by fecha)  as d on d.fecha=a.fecha_venta
       left join (select count(cantidad) as accesorios,fecha from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda in(SELECT tienda FROM $table5 where usuario='$supervisor')group by fecha)  as e on e.fecha=a.fecha_venta
	"); 

	}	
				
			$stmt -> execute();

		    return $stmt -> fetchAll();
		 //return $stmt;

		$stmt -> close();

		$stmt =null;





			

	}
  
/*=============================================
= Cargar Combo Tiendas Reporte Ventas Tiendas       = 
=============================================*/

static public function MdlTiendasReporteVentas($table) { 

	$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE estadistica ='Si' "); 

// return $stmt;

	$stmt->execute();

 
	return $stmt -> fetchAll();
	// return $stmt;

		$stmt -> close();

		$stmt =null;
		

}
 
/*=============================================
= Cargar Ventas Totales      =
=============================================*/

static public function MdlCargarVentasTotales($table,$table2,$table3,$table4,$table5,$startDate, $endDate,$supervisor,$table6) { 

		if($supervisor==""){

		$stmt = Connexion::connect()->prepare("SELECT a.tienda,ifnull(b.pospago,0) as pospago,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0)  as accesorios from (Select  nombre as tienda from $table5 where estadistica = 'Si' group by tienda order by tienda) as a
      left join (select count(contrato) as pospago,tienda from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by tienda) as b on a.tienda=b.tienda
      left join (select count(cantidad) as claro,tienda from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as c on c.tienda=a.tienda
      left join (select count(cantidad) as digital,tienda from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as d on d.tienda=a.tienda
       left join (select sum($table3.total) as accesorios,tienda from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as e on e.tienda=a.tienda
	"); 

	}else{



		$stmt = Connexion::connect()->prepare("SELECT a.tienda,ifnull(b.pospago,0) as pospago,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0)  as accesorios from (Select  nombre as tienda from $table5 where estadistica = 'Si' and  nombre in(SELECT tienda FROM  $table6 where usuario='$supervisor') group by tienda order by tienda) as a
      left join (select count(contrato) as pospago,tienda from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by tienda) as b on a.tienda=b.tienda
      left join (select count(cantidad) as claro,tienda from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as c on c.tienda=a.tienda
      left join (select count(cantidad) as digital,tienda from $table3,$table2,$table4 where $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as d on d.tienda=a.tienda
       left join (select sum($table3.total) as accesorios,tienda from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as e on e.tienda=a.tienda
	"); 

	}




	$stmt->execute();


/*	return $stmt -> fetchAll();*/
	
 return $stmt;

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasTotalesCompararTablas($table,$table2,$table3,$table4,$table5,$table6,$table7,$Vardesde1, $Varhasta1,$Vardesde2, $Varhasta2) { 


	$stmt = Connexion::connect()->prepare("SELECT a.tienda,a.supervisor,ifnull(b.pospago,0) as pospago,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0)  as accesorios,ifnull(f.pospago2,0) as pospago2,ifnull(g.claro2,0) as claro2,ifnull(h.digital2,0) as digital2,ifnull(i.accesorios2,0)  as accesorios2 from (Select  $table5.nombre as tienda,$table6.nombre as supervisor from $table5,$table6,$table7 where estadistica = 'Si' and id_tienda=idtbl_tiendas and id_supervisor=idtbl_supervisores group by tienda order by tienda) as a
      left join (select count(contrato) as pospago,tienda from $table where fecha_venta between '$Vardesde1' and  '$Varhasta1' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by tienda) as b on a.tienda=b.tienda
      left join (select count(cantidad) as claro,tienda from $table3,$table2,$table4 where $table2.fecha between '$Vardesde1' and  '$Varhasta1' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as c on c.tienda=a.tienda
      left join (select count(cantidad) as digital,tienda from $table3,$table2,$table4 where $table2.fecha between '$Vardesde1' and  '$Varhasta1' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as d on d.tienda=a.tienda
       left join (select sum($table3.total) as accesorios,tienda from $table3,$table2,$table4 where  $table2.fecha between '$Vardesde1' and  '$Varhasta1' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as e on e.tienda=a.tienda
         left join (select count(contrato) as pospago2,tienda from $table where fecha_venta between '$Vardesde2' and  '$Varhasta2' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by tienda) as f on a.tienda=f.tienda
      left join (select count(cantidad) as claro2,tienda from $table3,$table2,$table4 where $table2.fecha between '$Vardesde2' and  '$Varhasta2' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as g on g.tienda=a.tienda
      left join (select count(cantidad) as digital2,tienda from $table3,$table2,$table4 where $table2.fecha between '$Vardesde2' and  '$Varhasta2' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as h on h.tienda=a.tienda
       left join (select sum($table3.total) as accesorios2,tienda from $table3,$table2,$table4 where  $table2.fecha between '$Vardesde2' and  '$Varhasta2' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table4.nombre=$table3.producto and $table4.familia='ACCESORIOS' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda)  as i on i.tienda=a.tienda"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;
		

}



/*=============================================
= Cargar Ventas Totales      =
=============================================*/

static public function MdlCargarDatosDetalleVentasPospago($table,$item, $value, $item2, $value2,$startDate, $endDate) { 



	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,tipo_venta,fecha_venta,cedula,nombre from $table where fecha_venta between '$startDate' and  '$endDate' and tienda ='$value2' and gestor='$value' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'  order by fecha_venta"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return "SELECT tienda,gestor,tipo_venta,fecha_venta,cedula,nombre from $table where fecha_venta between '$startDate' and  '$endDate' and tienda ='$value2' and gestor='$value' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'  order by fecha_venta";*/

		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarVentasTablaPospago($table,$startDate, $endDate) { 


/**/

	$stmt = Connexion::connect()->prepare("SELECT a.tienda,a.gestor,ifnull(b.subsidiado,0) as subsidiado,ifnull(c.aportado,0) as aportado,ifnull(d.financiado,0) as financiado,ifnull(e.portabilidad,0) as portabilidad , ifnull(b.subsidiado,0) + ifnull(c.aportado,0) + ifnull(d.financiado,0) + ifnull(e.portabilidad,0)  as total
      from (select distinctrow tienda,gestor from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by gestor order by tienda) as a
      left join (select count(contrato) as subsidiado,gestor from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tipo_venta='Plan Subsidiado' group by gestor) as b on b.gestor=a.gestor
      left join (select count(contrato) as aportado,gestor from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tipo_venta='Plan Aportados' group by gestor)  as c on c.gestor=a.gestor
      left join (select count(contrato) as financiado,gestor from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tipo_venta='Financiados Puros' group by gestor)  as d on d.gestor=a.gestor
       left join (select count(contrato) as portabilidad,gestor from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tipo_venta='Portabilidad' group by gestor)  as e on e.gestor=a.gestor;"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarVentasTablaKitsDigital($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5) { 








		if($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' group by tienda,gestor order by tienda "); 

	}else{



		$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor') group by tienda,gestor order by tienda "); 

	}


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasKitsDigital($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,COUNT(cantidad) as cantidad,$table3.producto,sum($table3.total) as total,($table3.total/cantidad) as promedio from $table3,$table2,$table where  $item2 ='$value2' and $item='$value' and $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table.nombre=$table3.producto and $table.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by $table3.producto;"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return "SELECT tienda,gestor,COUNT(cantidad) as cantidad,$table3.producto,sum($table3.total) as total,($table3.total/cantidad) as promedio from $table3,$table2,$table where  $item2 ='$value2' and $item='$value' and $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table.nombre=$table3.producto and $table.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by $table3.producto;";*/

		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasKitsClaro($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,COUNT(cantidad) as cantidad,$table3.producto,sum($table3.total) as total,($table3.total/cantidad) as promedio from $table3,$table2,$table where  $item2 ='$value2' and $item='$value' and $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table.nombre=$table3.producto and $table.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by $table3.producto;"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return "SELECT tienda,gestor,COUNT(cantidad) as cantidad,$table3.producto,sum($table3.total) as total,($table3.total/cantidad) as promedio from $table3,$table2,$table where  $item2 ='$value2' and $item='$value' and $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table.nombre=$table3.producto and $table.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by $table3.producto;";*/

		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasAccesorios($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,COUNT(cantidad) as cantidad,$table3.producto,sum($table3.total) as total,($table3.total/cantidad) as promedio from $table3,$table2,$table where  $item2 ='$value2' and $item='$value' and $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and $table.nombre=$table3.producto and $table.familia='ACCESORIOS' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by $table3.producto;"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	


		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasRecaudaciones($table,$table2,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,fecha_ingreso,cedula,$table.nombre,$table2.nombre as tipo,monto from $table,$table2 where  fecha_ingreso between '$startDate' and  '$endDate'  and $item2  = '$value2' and $item = '$value' and id_recaudacion=idtbl_tipos_recuadacion;"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	


		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasActivaciones($table,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,tipo_operacion,fecha,cedula,nombre from $table where  fecha between '$startDate' and  '$endDate'  and $item2  = '$value2' and $item = '$value' and  tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%';"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	


		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarDatosDetalleVentasTae($table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2) { 


	

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,fecha,$table3.producto,$table3.total from $table3,$table2 where  fecha between '$startDate' and  '$endDate'  and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table3.producto in('TAE','Pago servicio DTH')  and $item2  = '$value2' and $item = '$value';"); 


	$stmt->execute();

/*return $stmt ;
*/	return $stmt -> fetchALL();
	


		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasTAE($table2,$table3,$startDate, $endDate) { 


	

	$stmt = Connexion::connect()->prepare("SELECT sum($table3.total) from $table3,$table2 where  fecha between '$startDate' and  '$endDate'  and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table3.producto in('TAE','Pago servicio DTH')  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';"); 


	$stmt->execute();

/*return $stmt ;
*/	return $stmt -> fetch();
	


		$stmt -> close();

		$stmt =null;

	

}


static public function MdlCargarVentasActivaciones($table,$startDate, $endDate,$supervisor,$table4) { 


	

	

		if($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT count(tipo_operacion) from $table where fecha between '$startDate' and  '$endDate' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';"); 

	}else{

	$stmt = Connexion::connect()->prepare("SELECT count(tipo_operacion) from $table where fecha between '$startDate' and  '$endDate' and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor');"); 

	}


	$stmt->execute();

/*return $stmt ;
*/	return $stmt -> fetch();
	


		$stmt -> close();

		$stmt =null;


		

}


static public function MdlCargarVentasTablaRecaudaciones($table,$startDate, $endDate,$supervisor,$table4) { 


	




		if($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT  a.tienda,a.gestor,ifnull(b.total,0) as total
      from (select distinctrow tienda,gestor from $table where fecha_ingreso between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and tienda REGEXP '[a-zA-Z]' group by gestor order by tienda) as a
      left join (select sum(monto) as total,gestor from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' group by gestor ) as b on a.gestor=b.gestor;"); 

	}else{

		$stmt = Connexion::connect()->prepare("SELECT  a.tienda,a.gestor,ifnull(b.total,0) as total
      from (select distinctrow tienda,gestor from $table where fecha_ingreso between '$startDate' and  '$endDate' and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor') group by gestor order by tienda) as a
      left join (select sum(monto) as total,gestor from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor') group by gestor ) as b on a.gestor=b.gestor;"); 

	}


	$stmt->execute();


	return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasTablaActivaciones($table,$startDate, $endDate,$supervisor,$table4) { 


	



		if($supervisor==""){

	$stmt = Connexion::connect()->prepare(" SELECT tienda,gestor,count(tipo_operacion) as total from $table where  fecha between '$startDate' and  '$endDate'   and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' group by tienda,gestor order by tienda"); 

	}else{

			$stmt = Connexion::connect()->prepare(" SELECT tienda,gestor,count(tipo_operacion) as total from $table where  fecha between '$startDate' and  '$endDate'   and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor') group by tienda,gestor order by tienda"); 


	}

	$stmt->execute();


	return $stmt -> fetchAll();

		$stmt -> close();

		$stmt =null;

		
		

}

static public function MdlCargarVentasTablaTae($table,$table2,$startDate, $endDate,$supervisor,$table4) { 


	




	if($supervisor==""){

	
	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,sum($table2.total) as total from $table2,$table where  fecha between '$startDate' and  '$endDate'  and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and  $table2.producto in('TAE','Pago servicio DTH')  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' group by tienda,gestor;"); 


	}else{


	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,sum($table2.total) as total from $table2,$table where  fecha between '$startDate' and  '$endDate'  and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and  $table2.producto in('TAE','Pago servicio DTH')  and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor') group by tienda,gestor;"); 
	}

	$stmt->execute();


	return $stmt -> fetchAll();

	

		$stmt -> close();

		$stmt =null;

		

}

static public function MdlCargarVentasRecaudaciones($table,$startDate, $endDate,$supervisor,$table4) { 


	if($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT sum(monto) from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';"); 
	}else{


	$stmt = Connexion::connect()->prepare("SELECT sum(monto) from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor');"); 
	}



	$stmt->execute();


	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

	
		

}


static public function MdlCargarVentasArpuPospago($table,$startDate, $endDate,$supervisor,$table4) { 


	




	if($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT avg(monto_renta) from $table where fecha_venta between '$startDate' and  '$endDate'and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tienda not like '%CEDI%'");  
	}else{

			$stmt = Connexion::connect()->prepare("SELECT avg(monto_renta) from $table where fecha_venta between '$startDate' and  '$endDate'and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor')"); 
	
	}


	$stmt->execute();

/*return $stmt;*/

	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;


		

}


static public function MdlCargarVentasTablaKitsClaro($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5) { 




	


 if ($supervisor==""){
$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' group by tienda,gestor order by tienda "); 


}else{

$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and  tienda in(SELECT tienda FROM  $table5 where usuario='$supervisor') group by tienda,gestor order by tienda "); 

		

}

	$stmt->execute();


	return $stmt -> fetchAll();
	
/* return $stmt;*/

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasArpuPrepagoDigital($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4) { 





 if ($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT avg($table3.total)  from $table2,$table,$table3 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table.nombre=$table3.producto and  $table.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';");

}else{

		$stmt = Connexion::connect()->prepare("SELECT avg($table3.total)  from $table2,$table,$table3 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table.nombre=$table3.producto and  $table.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor');");

		

}


	$stmt->execute();


	return $stmt -> fetch();
	
 /*return $stmt;*/

		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarVentasArpuPrepagoClaro($table,$table2,$table3,$startDate, $endDate) { 

 	



	        if ($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT avg($table3.total)  from $table2,$table,$table3 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table.nombre=$table3.producto and  $table.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';");

}else{

			$stmt = Connexion::connect()->prepare("SELECT avg($table3.total)  from $table2,$table,$table3 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table.nombre=$table3.producto and  $table.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and  tienda in(SELECT tienda FROM  $table4 where usuario='$supervisor');");

}
 


	$stmt->execute();


	return $stmt -> fetch();
	
/* return $stmt;*/

		$stmt -> close();

		$stmt =null;
		

}

static public function MdlCargarVentasTablaAccesorios($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5) { 



		        if ($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='ACCESORIOS' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' group by tienda,gestor order by tienda;"
       
); 
}else{


	$stmt = Connexion::connect()->prepare("SELECT tienda,gestor,ifnull(count(cantidad),0) as cantidad,ifnull(sum($table3.total),0) as total ,ifnull((ifnull(sum($table3.total),0)/ifnull(count(cantidad),0)),0) as promedio from $table3,$table2,$table4 where  $table2.fecha between '$startDate' and  '$endDate' and $table2.estado='OK' and $table2.idtbl_facturas=$table3.id_factura and  $table4.nombre=$table3.producto and  $table4.familia='ACCESORIOS' and producto not like 'SIM-KIT-PREPAGO' and  tienda in(SELECT tienda FROM  $table5 where usuario='$supervisor') group by tienda,gestor order by tienda;"
       
); 

}


	$stmt->execute();


	/*return $stmt -> fetchAll();*/
	
 return $stmt;

		$stmt -> close();

		$stmt =null;
		

}


/*=============================================
= Cargar Ventas Pospago      =
=============================================*/

static public function MdlCargarVentasPospago($table,$table2,$startDate, $endDate,$supervisor) { 
if ($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT count(contrato) from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%CEDI%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'"); 

}else{

		$stmt = Connexion::connect()->prepare("SELECT count(contrato) from $table where fecha_venta between '$startDate' and  '$endDate' and  tienda in(SELECT tienda FROM  $table2 where usuario='$supervisor') and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'"); 

}



	$stmt->execute();


	return $stmt -> fetch();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;

		

}

/*=============================================
= Cargar Ventas Prepago Digital      =
=============================================*/

static public function MdlCargarVentasPrepagoDigital($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4) { 




if ($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'"); 

}else{

			$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and  tienda in (SELECT tienda FROM  $table4 where usuario='$supervisor')"); 

}

	$stmt->execute();


	return $stmt -> fetch();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;


}

/*=============================================
= Cargar Ventas Prepago Claro      =
=============================================*/

static public function MdlCargarVentasPrepagoClaro($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4) { 


if ($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'"); 

}else{

			$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and  tienda in (SELECT tienda FROM  $table4 where usuario='$supervisor')"); 

}

	$stmt->execute();


	return $stmt -> fetch();
	
/* return $stmt;
*/
		$stmt -> close();

		$stmt =null;

		
		

}

/*=============================================
= Cargar Ventas Acceosrios      =
=============================================*/

static public function MdlCargarVentasAccesorios($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4) { 

	
if ($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT sum($table2.total) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='ACCESORIOS' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'");  

}else{


	$stmt = Connexion::connect()->prepare("SELECT sum($table2.total) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='ACCESORIOS' and  tienda in (SELECT tienda FROM  $table4 where usuario='$supervisor')"); 

		

}

	$stmt->execute();


	return $stmt -> fetch();
	
/* return $stmt;*/

		$stmt -> close();

		$stmt =null;
		

}


/*=============================================
= Cargar Tiendas      =
=============================================*/

static public function MdlCargarTiendas($table, $table2, $supervisor) { 

 if ($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT distinct * FROM $table where operativa= 'Si' and nombre not like '%DTH%' order by nombre asc");

 }else{

	$stmt = Connexion::connect()->prepare("SELECT distinct idtbl_tiendas,nombre as nombre FROM $table2,$table where usuario = '$supervisor' and tienda =nombre order by tienda asc");

 }

 


	$stmt->execute();


	 return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;

			

}

/*=============================================
= ctrCargarEstadoTiendas     =
=============================================*/

static public function MdlCargarEstadoTiendas($table, $table2, $table3, $table4, $supervisor) { 

 if($supervisor==""){
	$stmt = Connexion::connect()->prepare("SELECT a.idtienda,a.nombre,ifnull(b.tipo,'Cerrado') as estado from
(select idtbl_tiendas as idtienda,nombre from $table where operativa='Si' and estadistica='Si') as a
left join(SELECT tienda,tbl_motivos_horarios.tipo as tipo FROM $table2,$table3 where $table2.motivo=idtbl_motivos_horarios and date(hora) = date(CURRENT_DATE ) and idtbl_horarios_tiendas IN (SELECT 
            MAX(idtbl_horarios_tiendas)
        FROM
             $table2
        GROUP BY tienda) group by tienda order by idtbl_horarios_tiendas desc  ) as b on a.idtienda=b.tienda order by a.nombre;
");
 }else{
	$stmt = Connexion::connect()->prepare("SELECT a.idtienda,a.nombre,ifnull(b.tipo,'Cerrado') as estado from
(select idtbl_tiendas as idtienda,nombre from $table where operativa='Si' and estadistica='Si' and  nombre in (SELECT tienda FROM  $table4 where usuario='$supervisor')) as a
left join(SELECT tienda,tbl_motivos_horarios.tipo as tipo FROM $table2,$table3 where $table2.motivo=idtbl_motivos_horarios and date(hora) = date(CURRENT_DATE ) and idtbl_horarios_tiendas IN (SELECT 
            MAX(idtbl_horarios_tiendas)
        FROM
             $table2
        GROUP BY tienda) group by tienda order by idtbl_horarios_tiendas desc  ) as b on a.idtienda=b.tienda order by a.nombre;
");
 }



 

	$stmt->execute();


	// return $stmt -> fetchAll();
	 return $stmt;

		$stmt -> close();

		$stmt =null;

			

}

/*=============================================
= ctrCargarDatosDetalleEstadoTienda     =
=============================================*/

static public function MdlCargarDatosDetalleEstadoTienda($table,$table2,$table3,$table4,$item, $value) { 


	$stmt = Connexion::connect()->prepare("SELECT  $table.nombre as tienda,$table4.nombre as gestor, $table3.motivo AS motivo,hora
FROM
    $table2,
    $table3,
    $table4,
    $table
WHERE
    tienda=idtbl_tiendas
    and $table2.motivo = idtbl_motivos_horarios
    and usuario=user
    AND DATE(hora) = DATE(CURRENT_DATE) and tienda='$value'
ORDER BY idtbl_horarios_tiendas asc;
");

 

	$stmt->execute();


	 return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;

			

}


/*=============================================
= ctrCargarContratosIndexados     =
=============================================*/

static public function MdlCargarContratosIndexados($table,$table2,$table3,$table4,$startDate,$endDate) { 


	$stmt = Connexion::connect()->prepare("SELECT a.tienda,a.backoffice,ifnull(h.cantidad,0)+ifnull(i.cantidad,0) as totalventas,ifnull(b.cantidad,0)+ifnull(c.cantidad,0) as verde,ifnull(d.cantidad,0)+ifnull(e.cantidad,0) as amarillo,ifnull(f.cantidad,0)+ifnull(g.cantidad,0) as rojo,ifnull(j.cantidad,0)+ifnull(k.cantidad,0) as indexadas from
(Select idtbl_tiendas,nombre as tienda,backoffice from $table where operativa='Si' and estadistica='Si' order by nombre) as a
left join (select count(idtblinforme) as cantidad,tienda  from $table2 where fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta)<=2 group by tienda) as b on a.tienda=b.tienda
left join (select count(idtbldth) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta)<=2 group by tienda) as c on a.tienda=c.tienda
left join (select count(idtblinforme) as cantidad,tienda  from $table2 where fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta) between 3 and 4 group by tienda) as d on a.tienda=d.tienda
left join (select count(idtbldth) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta)  between 3 and 4  group by tienda) as e on a.tienda=e.tienda
left join (select count(idtblinforme) as cantidad,tienda  from $table2 where fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta) >= 5 group by tienda) as f on a.tienda=f.tienda
left join (select count(idtbldth) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta between '$startDate' and '$endDate' and 
indexado ='No' and datediff(CURDATE(),fecha_venta)  >= 5  group by tienda) as g on a.tienda=g.tienda
left join (select count(idtblinforme) as cantidad,tienda  from $table2 where fecha_venta between '$startDate' and '$endDate'  group by tienda) as h on a.tienda=h.tienda
left join (select count(idtbldth) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta between '$startDate' and '$endDate'   group by tienda) as i on a.tienda=i.tienda
            left join (select count(idtblinforme) as cantidad,tienda  from $table2 where fecha_venta between '$startDate' and '$endDate' and indexado ='Si'  group by tienda) as j on a.tienda=j.tienda
left join (select count(idtbldth) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta between '$startDate' and '$endDate' and indexado ='Si'   group by tienda) as k on a.tienda=k.tienda order by a.tienda;
");

 

	$stmt->execute();


	 return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;

			

}


/*=============================================
= ctrCargarCriticasxBO     =
=============================================*/

static public function MdlCargarCriticasxBO($table,$startDate,$endDate) { 


	$stmt = Connexion::connect()->prepare("SELECT bo,count(idtbl_criticas) as total FROM $table where fecha_venta between '$startDate' and '$endDate' and estatus_rev_1 <> 'Validado'  group by bo order by bo;

");

 

	$stmt->execute();


	 return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;

			

}

/*=============================================
= ctrCargarPendientesEncomiendas     =
=============================================*/

static public function MdlCargarPendientesEncomiendas($table,$table2,$table3,$table4,$table5,$supervisor,$table6) { 



if ($supervisor==""){

	$stmt = Connexion::connect()->prepare("SELECT a.tienda,a.backoffice,ifnull(b.cantidad,0)+ifnull(c.cantidad,0) as pendientes from
(Select idtbl_tiendas,nombre as tienda,backoffice from $table where operativa='Si' and estadistica='Si' order by nombre) as a
left join (select count(codigo_barras) as cantidad,tienda  from $table2 where fecha_venta >='2021-10-01' and 
codigo_barras not in(select codigo_barras from $table5) group by tienda) as b on a.tienda=b.tienda
left join (select count(codigo_barras) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta >='2021-10-01' and 
codigo_barras not in(select codigo_barras from $table5) group by tienda) as c on a.tienda=c.tienda order by a.tienda;

");

}else{

	$stmt = Connexion::connect()->prepare("SELECT a.tienda,a.backoffice,ifnull(b.cantidad,0)+ifnull(c.cantidad,0) as pendientes from
(Select idtbl_tiendas,nombre as tienda,backoffice from $table where operativa='Si' and estadistica='Si' and  nombre in (SELECT tienda FROM  $table6 where usuario='$supervisor') order by nombre) as a
left join (select count(codigo_barras) as cantidad,tienda  from $table2 where fecha_venta >='2021-10-01' and 
codigo_barras not in(select codigo_barras from $table5) group by tienda) as b on a.tienda=b.tienda
left join (select count(codigo_barras) as cantidad,tienda  from $table3,$table4 WHERE
			$table3.solicitud = $table4.solicitud and fecha_venta >='2021-10-01' and 
codigo_barras not in(select codigo_barras from $table5) group by tienda) as c on a.tienda=c.tienda order by a.tienda;

");
	

}




 

	$stmt->execute();


	 return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;

			

}

/*=============================================
= Cargar Metas Tiendas      =
=============================================*/

static public function MdlCargarMetasTiendas($table1,$table2,$table3, $startDate, $endDate,$tienda,$supervisor) { 

	$idEmpresa=$_SESSION['id_empresa'];

 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="UsuarioOTB" ){


$stmt = Connexion::connect()->prepare("SELECT nombre ,sum(cantidad) as total FROM $table1 where fecha_desde between '$startDate' and '$endDate' and id_tienda like '$tienda' and id_empresa = '$idEmpresa'  group by nombre ");




 }elseif ($_SESSION["rol"]=="Supervisor-Tiendas" ){

 	if($tienda=="%"){

$stmt = Connexion::connect()->prepare("SELECT nombre ,sum(cantidad) as total FROM $table1 where fecha_desde between '$startDate' and '$endDate' and id_tienda in(SELECT tbl_tiendas.idtbl_tiendas FROM  $table2,$table3  where  nombre=tienda and usuario='$supervisor') and id_empresa = '$idEmpresa'  group by nombre ");

 	}else{
$stmt = Connexion::connect()->prepare("SELECT nombre ,sum(cantidad) as total FROM $table1 where fecha_desde between '$startDate' and '$endDate' and id_tienda like '$tienda' and id_empresa = '$idEmpresa'  group by nombre ");

 	}


 }

 


	$stmt->execute();


	return $stmt -> fetchAll();
	 //return $stmt;

		$stmt -> close();

		$stmt =null;
		

}

	
/*=============================================
= Cargar Ventas Acceosrios  x Tienda    =
=============================================*/

static public function MdlCargarVentasAccesoriosTienda($table,$table2,$table3,$startDate, $endDate, $tienda) { 
if($tienda == "null"){

	$stmt = Connexion::connect()->prepare("SELECT ifnull(sum($table2.total),0) as Total from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='ACCESORIOS' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'"); 


	$stmt->execute();


	return $stmt -> fetch();
	
 // return $stmt;

		$stmt -> close();

		$stmt =null;


}else{

	$stmt = Connexion::connect()->prepare("SELECT ifnull(sum($table2.total),0) as Total from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='ACCESORIOS' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' AND tienda like '%$tienda%'"); 


	$stmt->execute();


	return $stmt -> fetch();
	
 // return $stmt;

		$stmt -> close();

		$stmt =null;


}


		

}


static public function MdlCargarVentasActivacionesTiendas($table, $startDate, $endDate, $supervisor) { 


if($supervisor == "null"){

	$stmt = Connexion::connect()->prepare("SELECT ifnull(count(tipo_operacion),0) as Total from $table where fecha between '$startDate' and  '$endDate' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';"); 


	$stmt->execute();


return $stmt -> fetch();
	


		$stmt -> close();

		$stmt =null;

	


}else{

	$stmt = Connexion::connect()->prepare("SELECT ifnull(count(tipo_operacion),0) as Total from $table where fecha between '$startDate' and  '$endDate' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' AND tienda  LIKE '%$supervisor%';"); 


	$stmt->execute();


	return $stmt -> fetch();
	


		$stmt -> close();

		$stmt =null;
		


}


		

}


static public function MdlCargarVentasArpuPospagoTiendas($table,$startDate, $endDate, $tienda) { 


if($tienda == "null"){


	$stmt = Connexion::connect()->prepare("SELECT ifnull(avg(monto_renta),0) as Total from $table where fecha_venta between '$startDate' and  '$endDate'and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tienda not like '%CEDI%'"); 


}else{


	$stmt = Connexion::connect()->prepare("SELECT ifnull(avg(monto_renta),0) as Total from $table where fecha_venta between '$startDate' and  '$endDate'and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' and tienda not like '%CEDI%' and tienda = '$tienda'"); 

}

	$stmt->execute();

// return $stmt;

	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasDTHTiendas($table, $table2, $startDate, $endDate, $tienda) { 

if($tienda == "null"){


	$stmt = Connexion::connect()->prepare("SELECT 
   ifnull(COUNT(*),0) as Total
FROM
    $table,
    $table2
WHERE
    $table.solicitud = $table2.solicitud
        AND $table.fecha_venta BETWEEN '$startDate' AND '$endDate'
        "); 

}else{


	$stmt = Connexion::connect()->prepare("SELECT 
   ifnull(COUNT(*),0) as Total
FROM
    $table,
    $table2
WHERE
    $table.solicitud = $table2.solicitud
        AND $table.fecha_venta BETWEEN '$startDate' AND '$endDate'
        AND $table2.tienda = '$tienda'");

}

	$stmt->execute();

// return $stmt;

	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasPrepagoDigitalTiendas($table,$table2,$table3,$startDate, $endDate, $tienda) { 

if($tienda == "null"){

	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'"); 

}else{

	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO DIGITAL SAT' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' and tienda like '%$tienda%'"); 

}

	$stmt->execute();


	return $stmt -> fetch();
	
        // return $stmt;

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasPrepagoClaroTiendas($table,$table2,$table3,$startDate, $endDate, $tienda) { 

if($tienda == "null"){

	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%'"); 

}else{

	$stmt = Connexion::connect()->prepare("SELECT count(cantidad) from $table,$table2,$table3 where  $table.fecha between '$startDate' and  '$endDate' and $table.estado='OK' and $table.idtbl_facturas=$table2.id_factura and $table3.nombre=$table2.producto and $table3.familia='PRE PAGO CLARO' and producto not like 'SIM-KIT-PREPAGO' and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' and tienda like '%$tienda%'"); 

}

	$stmt->execute();


	return $stmt -> fetch();
	
        // return $stmt;

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasPospagoTiendas($table,$startDate, $endDate, $tienda) { 

if($tienda == "null"){

$stmt = Connexion::connect()->prepare("SELECT count(contrato) from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%CEDI%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'"); 

}else{

$stmt = Connexion::connect()->prepare("SELECT count(contrato) from $table where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%CEDI%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]'  and tienda like '%$tienda%'"); 

}

	$stmt->execute();

	return $stmt -> fetch();
	
//return $stmt;

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasRecaudacionesTiendas($table,$startDate, $endDate, $tienda) { 

if($tienda == "null"){ 

	$stmt = Connexion::connect()->prepare("SELECT sum(monto) from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%';"); 

}else{

	$stmt = Connexion::connect()->prepare("SELECT sum(monto) from $table where  fecha_ingreso between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' and tienda like '%$tienda%'"); 
}





	$stmt->execute();


	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasMetaLlaveTiendas($table,$startDate, $endDate, $tienda) { 

if($tienda == "null"){

	$stmt = Connexion::connect()->prepare("SELECT count(idtblinforme) from $table where  fecha_venta between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' and monto_renta >= '13000' and tipo_venta NOT in ('FONATEL','IFI') ;"); 

}else{

	$stmt = Connexion::connect()->prepare("SELECT count(idtblinforme) from $table where  fecha_venta between '$startDate' and  '$endDate'  and tienda not like '%MASIVO%' and tienda not like '%ACTIVADORES%' and tienda not like '%CEDI%' and tienda like '%$tienda%' and monto_renta >= '13000' and tipo_venta NOT in ('FONATEL','IFI')"); 
}





	$stmt->execute();


	return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;
		

}


static public function MdlCargarVentasTotalesXSupervisortiendas($table,$table1,$table2,$table3,$table4,$table5,$table6,$startDate, $endDate) { 


	$stmt = Connexion::connect()->prepare("SELECT a.nombre,ifnull(b.pospago,0) as pospago ,ifnull(c.claro,0) as claro,ifnull(d.digital,0) as digital,ifnull(e.accesorios,0) as accesorios from (SELECT b.nombre FROM $table a inner join $table1 b on a.id_supervisor = b.idtbl_supervisores  group by b.idtbl_supervisores) as a
left join (SELECT d.nombre, count(contrato) as pospago from $table2 a inner join $table3 b on a.tienda = b.nombre inner join $table c on c.id_tienda = b.idtbl_tiendas inner join $table1 d on c.id_supervisor = d.idtbl_supervisores where fecha_venta between '$startDate' and  '$endDate' and tienda not like '%GPON%' and tienda not like '%DTH%' and tienda not like '%MASIVO%' and tienda not like '%CALL CENTER%' and tienda not like '%ACTIVADORES%' and estado in ('Criticado','Completado') and tienda REGEXP '[a-zA-Z]' group by c.id_supervisor order by c.id_supervisor) as b on  a.nombre = b.nombre
left join (SELECT COUNT(cantidad) AS claro, $table1.nombre FROM $table4,$table5,$table6,$table3,$table, $table1 WHERE $table5.fecha BETWEEN '$startDate' AND '$endDate' AND $table5.estado = 'OK' AND $table5.idtbl_facturas = $table4.id_factura AND $table6.nombre = $table4.producto  AND $table6.familia = 'PRE PAGO CLARO' AND producto NOT LIKE 'SIM-KIT-PREPAGO' AND tienda NOT LIKE '%GPON%' AND tienda NOT LIKE '%DTH%' AND tienda NOT LIKE '%MASIVO%' AND tienda NOT LIKE '%CALL CENTER%' AND tienda NOT LIKE '%ACTIVADORES%' AND $table5.tienda = $table3.nombre AND $table.id_tienda = $table3.idtbl_tiendas and $table1.idtbl_supervisores = $table.id_supervisor GROUP BY $table.id_supervisor) as c on c.nombre = a.nombre
left join (SELECT COUNT(cantidad) AS digital, $table1.nombre FROM $table4,$table5,$table6,$table3,$table, $table1 WHERE $table5.fecha BETWEEN '$startDate' AND '$endDate' AND $table5.estado = 'OK' AND $table5.idtbl_facturas = $table4.id_factura AND $table6.nombre = $table4.producto AND $table6.familia = 'PRE PAGO DIGITAL SAT' AND producto NOT LIKE 'SIM-KIT-PREPAGO' AND tienda NOT LIKE '%GPON%' AND tienda NOT LIKE '%DTH%' AND tienda NOT LIKE '%MASIVO%' AND tienda NOT LIKE '%CALL CENTER%' AND tienda NOT LIKE '%ACTIVADORES%' AND $table5.tienda = $table3.nombre AND $table.id_tienda = $table3.idtbl_tiendas and $table1.idtbl_supervisores = $table.id_supervisor GROUP BY $table.id_supervisor) as d on d.nombre = a.nombre
left join (SELECT SUM($table4.total) AS accesorios, $table1.nombre FROM $table4, $table5, $table6, $table3, $table, $table1 WHERE $table5.fecha BETWEEN '$startDate' AND '$endDate' AND $table5.estado = 'OK' AND $table5.idtbl_facturas = $table4.id_factura AND $table6.nombre = $table4.producto AND $table6.familia = 'ACCESORIOS' AND tienda NOT LIKE '%GPON%' AND tienda NOT LIKE '%DTH%' AND tienda NOT LIKE '%MASIVO%' AND tienda NOT LIKE '%CALL CENTER%' AND tienda NOT LIKE '%ACTIVADORES%' AND $table5.tienda = $table3.nombre AND $table.id_tienda = $table3.idtbl_tiendas and $table1.idtbl_supervisores = $table.id_supervisor GROUP BY $table.id_supervisor) as e on a.nombre = e.nombre"); 


	$stmt->execute();


	return $stmt -> fetchAll();
	
// return $stmt;


		$stmt -> close();

		$stmt =null;
		

}





}