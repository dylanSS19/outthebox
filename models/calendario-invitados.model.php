<?php

require_once "connexion.php";

class CalendarioEvetosModel{

	/*=============================================
	=                 SEARCH CALENDARIO            =
	=============================================*/
	static public function MdlCargarEventos($table, $table2, $table3, $idusuario) {
	
        $stmt = Connexion::connect()->prepare("SELECT a.idtbl_calendario, a. titulo, a.nombre, a.inicio, a.fin, a.tipo,ifnull(b.id_evento,'No') as 'Invitado', a.detalle_evento, a.Ubicacion, a.lat, a.lon, a.limite_invitados,a.empresa FROM
        (SELECT idtbl_calendario, titulo, nombre, inicio, tipo, fin, detalle_evento, Ubicacion, lat, lon, limite_invitados, empresa FROM
        $table, $table2 WHERE empresa = idtbl_clientes and date(inicio) between CURRENT_DATE and CURRENT_DATE + INTERVAL 7 DAY ) as a
          left join ( SELECT id_evento FROM $table3 WHERE usuario='$idusuario' ) as b on b.id_evento=a.idtbl_calendario order by a.inicio desc");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;
}

    static public function MdlCargarDisponibilidad($table, $evento) {
        
        $stmt = Connexion::connect()->prepare("SELECT limite_invitados from $table where idtbl_calendario = '$evento'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetch();

        $stmt -> close();

        $stmt =null;
    }

    static public function MdlCargarCantInvitados($table, $evento) {
        
        $stmt = Connexion::connect()->prepare("SELECT ifnull(count(id_evento),0) from $table where id_evento = '$evento' and Estado_invitacion <> 'Pendiente'");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetch();

        $stmt -> close();

        $stmt =null;
    }

    static public function MdlValUsuarioEvento($table, $evento, $usuario) {
        
        $stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
            SELECT *
            FROM $table
            WHERE id_evento =  '$evento' AND usuario = '$usuario'), 1, 0)");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetch();

        $stmt -> close();

        $stmt =null;
    }



	static public function MdlModificarEvento($table, $acept, $estado, $usuario) {
	
        $stmt = Connexion::connect()->prepare("UPDATE $table SET Estado_invitacion = :Estado_invitacion where id_evento = :id_evento and usuario = :usuario");  
    
            $stmt->bindParam(":Estado_invitacion", $estado, PDO::PARAM_STR);

            $stmt->bindParam(":id_evento", $acept, PDO::PARAM_STR);

            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        
            if($stmt->execute()){
    
    
                return "ok";
            }
    
            else{
    
                return $stmt->errorInfo()[2];
            }
    
            $stmt -> close();
    
            $stmt =null;
        }

        static public function MdlIngresarEvento($table, $acept, $estado, $usuario) {
	
            $stmt = Connexion::connect()->prepare("INSERT INTO $table (id_evento, usuario, Estado_invitacion) VALUES (:id_evento, :usuario, :Estado_invitacion)");  
        
                $stmt->bindParam(":Estado_invitacion", $estado, PDO::PARAM_STR);
        
                $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);

                $stmt->bindParam(":id_evento", $acept, PDO::PARAM_STR);
        
                if($stmt->execute()){
        
        
                    return "ok";
                }
        
                else{
        
                    return $stmt->errorInfo()[2];
                }
        
                $stmt -> close();
        
                $stmt =null;
            }

    
            static public function MdlBuscarUsuario($table, $usuario) {
        
                $stmt = Connexion::connect()->prepare("SELECT nombre_perfil FROM $table WHERE idtbluser_2 = '$usuario'");
                
                $stmt -> execute();
        
                // return $stmt;
        
                return $stmt -> fetch();
        
                $stmt -> close();
        
                $stmt =null;
            }

            static public function MdlBuscarEmpresa($table, $empresa) {
        
                $stmt = Connexion::connect()->prepare("SELECT nombre_ficticio FROM $table WHERE idtbl_clientes = '$empresa'");
                
                $stmt -> execute();
        
                // return $stmt;
        
                return $stmt -> fetch();
        
                $stmt -> close();
        
                $stmt =null;
            }

            static public function MdlCargarEventoID($table, $idevento) {
        
                $stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbl_calendario = '$idevento'");
                
                $stmt -> execute();
        
                // return $stmt;
        
                return $stmt -> fetchAll();
        
                $stmt -> close();
        
                $stmt =null;
            }

            static public function MdlCargarUsuario($table, $usuario) {
        
                $stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idtbluser_2 = '$usuario'");
                
                $stmt -> execute();
        
                return $stmt;
        
                // return $stmt -> fetchAll();
        
                $stmt -> close();
        
                $stmt =null;
            }
        

}