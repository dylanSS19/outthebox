<?php

 
class sidebarController{

    static public function ctrCargarModulos(){

       $table = "empresas.tbl_modulos_outthebox";    
      
        $response = sidebarModel::MdlCargarModulos($table); 

        return $response;


    }

    static public function ctrCargarSubModulos($idModulo){

        $table = "empresas.tbl_subModulos_outthebox";    
       
         $response = sidebarModel::MdlCargarSubModulos($table, $idModulo); 
 
         return $response;
 
 
     }

     static public function ctrUsuariosModulos($usuario, $empresa){

        $table = "empresas.tbl_empresas_usuarios";    
       
         $response = sidebarModel::MdlUsuariosModulos($table, $usuario, $empresa); 
 
         return $response;
 
 
     }


     static public function ctrUsuariosInvitadosModulos($usuario){

        $table = "empresas.tbluser_2";    
       
         $response = sidebarModel::MdlUsuariosInvitadosModulos($table, $usuario); 
 
         return $response;
 

     }

     static public function ctrIDSubModulo($subMod, $modulos){

        $table = "empresas.tbl_subModulos_outthebox";    
       
         $response = sidebarModel::MdlIDSubModulo($table, $subMod, $modulos); 
 
         return $response;
 
 
     }

     static public function ctrCargarRolUsuario($idUser){

        $table = "empresas.tbluser_2";    
       
         $response = sidebarModel::MdlCargarRolUsuario($table, $idUser); 
 
         return $response;
 
 
     }

     static public function ctrCargarSubmodulosUser($idUser, $idempresa){

        $table = "empresas.tbl_empresas_usuarios";    
       
         $response = sidebarModel::MdlCargarSubmodulosUser($table, $idUser, $idempresa); 
 
         return $response;
 
 
     }

     static public function ctrCargarModulosCliente($idempresa){

        $table = "empresas.tbl_clientes";    
       
         $response = sidebarModel::MdlCargarModulosCliente($table, $idempresa); 
 
         return $response;
 
 
     }


     static public function ctrCargarPlanesClientes($idempresa){

        $table = "empresas.tbl_clientes_planes";    
       
         $response = sidebarModel::MdlCargarPlanesClientes($table, $idempresa); 
 
         return $response;
 
 
     }


     static public function ctrCargarPlanesid($idPlan){

        $table = "empresas.tbl_categoria_planes";    
       
         $response = sidebarModel::MdlCargarPlanes($table, $idPlan); 
 
         return $response;
 
 
     }
 
     static public function ctrCargarCantFacturas($empresa, $fechaDesde, $fechaHasta){

        $table = "empresas.tbl_sistema_facturacion_facturas";    
       
         $response = sidebarModel::MdlCargarCantFacturas($table, $empresa, $fechaDesde, $fechaHasta); 
 
         return $response;
 
 
     }
}