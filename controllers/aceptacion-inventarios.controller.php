  
 <?php 
 

   ini_set('memory_limit', '1024M');

    use  PHPMailer\PHPMailer\PHPMailer ;
    use  PHPMailer\PHPMailer\Exception ;

/*require  './extensions/PHPMailer-master/src/Exception.php' ;*/
/*require  './extensions/PHPMailer-master/src/PHPMailer.php' ;
/*require  './extensions/PHPMailer-master/src/SMTP.php' ;*/
     
class controladorAceptacionInventarios {


 

  /*=============================================
=            LOAD CARGOS           =
=============================================*/

static public function ctrCargarCargos(){

 $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".tbl_movimiento_inventario";   
   
    $response = AceptacionInventariosModel::MdlCargarCargos($table); 

    return $response;

  }



  /*=============================================
=            LOAD ACEPTAR CARGOS          =
=============================================*/

static public function ctrAceptarCargos($value){

 $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".view_tblinventarios"; 

    $table2 = $schema.".view_tblmovimientos_inventarios";   
   
    $response = AceptacionInventariosModel::MdlAceptarCargos($table,$table2,$value); 

    return $response;

  }


  /*=============================================
=            LOAD ACEPTAR MOVIMIENTOS          =
=============================================*/

static public function ctrAceptarMovimientos($value){

 $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".view_tblinventarios"; 

    $table2 = $schema.".view_tblmovimientos_inventarios";   

    $table3 = $schema.".tbl_movimiento_inventario";
   
    $response = AceptacionInventariosModel::MdlAceptarMovimientos($table,$table2,$table3,$value); 

    return $response;

  }


  /*=============================================
=            LOAD CARGOS DEATLLE          =
=============================================*/

static public function ctrCargarCargosDetalle($item, $value){

 $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".tbl_movimiento_inventario";   
   
    $response = AceptacionInventariosModel::MdlCargarCargosDetalle($table,$item, $value); 

    return $response;

  }

    /*=============================================
=            LOAD MOVIMIENTOS DEATLLE          =
=============================================*/

static public function ctrCargarMovimientosDetalle($item, $value){

 $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".tbl_movimiento_inventario";   
   
    $response = AceptacionInventariosModel::MdlCargarMovimientosDetalle($table,$item, $value); 

    return $response;

  }


  /*=============================================
=            LOAD MOVIMIENTOS           =
=============================================*/

static public function ctrCargarMovimientos(){

 
    $schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".tbl_movimiento_inventario";   
      
    $response = AceptacionInventariosModel::MdlCargarMovimientos($table); 

    return $response;

  }

   
  
}