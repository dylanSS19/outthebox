<?php

class CalendarioEventosController{

        static public function ctrCargarEventos($idusuario){

        $table = "empresas.tbl_calendario"; 	
        $table2 = "empresas.tbl_clientes"; 
        $table3 = "empresas.tbl_calendario_invitados"; 

            $response = CalendarioEvetosModel::MdlCargarEventos($table, $table2, $table3, $idusuario);		

            return $response;

        }

        static public function ctrCargarDisponibilidad($evento){

            $table = "empresas.tbl_calendario"; 	
    
                $response = CalendarioEvetosModel::MdlCargarDisponibilidad($table, $evento);		
    
                return $response;
    
        }

        static public function ctrCargarCantInvitados($evento){

            $table = "empresas.tbl_calendario_invitados"; 	
    
                $response = CalendarioEvetosModel::MdlCargarCantInvitados($table, $evento);		
    
                return $response;
    
        }

        static public function ctrValUsuarioEvento($evento, $usuario){

            $table = "empresas.tbl_calendario_invitados"; 	
    
                $response = CalendarioEvetosModel::MdlValUsuarioEvento($table, $evento, $usuario);		
    
                return $response;
    
        }

        static public function ctrIngresarEvento($acept, $estado, $usuario){

            $table = "empresas.tbl_calendario_invitados"; 	
    
                $response = CalendarioEvetosModel::MdlIngresarEvento($table, $acept, $estado, $usuario);		
    
                return $response;
    
        }

        static public function ctrModificarEvento($acept, $estado, $usuario){

            $table = "empresas.tbl_calendario_invitados"; 	
    
                $response = CalendarioEvetosModel::MdlModificarEvento($table, $acept, $estado, $usuario);		
    
                return $response;
    
        }

        static public function ctrBuscarUsuario($usuario){

            $table = "empresas.tbluser_2"; 	
    
                $response = CalendarioEvetosModel::MdlBuscarUsuario($table, $usuario);		
    
                return $response;
    
        }

        static public function ctrBuscarEmpresa($empresa){

            $table = "empresas.tbl_clientes"; 	
    
                $response = CalendarioEvetosModel::MdlBuscarEmpresa($table, $empresa);		
    
                return $response;
    
        }

}