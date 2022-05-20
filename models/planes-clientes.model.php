<?php

require_once "connexion.php";

class  PlanesClientesModel{

 
                static public function MdlCargarClientes($table) {

                        
                    $stmt = Connexion::connect()->prepare("SELECT * from $table");

                    $stmt -> execute();

                    return $stmt -> fetchAll();

                // return $stmt;	


                    $stmt -> close();

                    $stmt =null;

            }



            static public function MdlCargarCategorias($table, $categoria) {

                        
                $stmt = Connexion::connect()->prepare("SELECT * from $table where plan = '$categoria'");

                $stmt -> execute();

                return $stmt -> fetchAll();

            // return $stmt;	


                $stmt -> close();

                $stmt =null;

        }

        static public function MdlCargarDatosCategoria($table, $categoria) {

                        
            $stmt = Connexion::connect()->prepare("SELECT * from $table where idtbl_categoria_planes = '$categoria'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }


        static public function MdlAgregarPrivilegio($table, $privilegio, $Cliente) { 

            $stmt = Connexion::connect()->prepare("UPDATE $table SET privilegio='$privilegio' where idtbl_clientes = '$Cliente'");
        
            if($stmt->execute()){
        
                return "ok";
            }
        
            else{
        
                // return $stmt;
        
                return $stmt->errorInfo()[2];
            }
        
            $stmt -> close();
        
            $stmt =null;
        
        }
        

        static public function MdlAgregarPlanesClientes($table, $clientes, $fecha_fin, $fecha_extencion, $idPlan, $nombrePlan, $precioPlan, $cantDocumentos, $total_pagar, $estado, $Clave, $RutFoto) { 

            $db = Connexion::connect();

            $stmt = $db->prepare("INSERT INTO $table(cliente, fecha_fin, fecha_extencion, idPlan, nombrePlan, precioPlan, cantDocumentos, total_pagar, estado, fotoComprobante, clave) VALUES(:cliente, :fecha_fin, :fecha_extencion, :idPlan, :nombrePlan, :precioPlan, :cantDocumentos, :total_pagar, :estado, :fotoComprobante, :clave)");
    
            $stmt->bindParam(":cliente",$clientes, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin",$fecha_fin, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_extencion",$fecha_extencion, PDO::PARAM_STR);
            $stmt->bindParam(":idPlan",$idPlan, PDO::PARAM_STR);
            $stmt->bindParam(":nombrePlan",$nombrePlan, PDO::PARAM_STR);
            $stmt->bindParam(":precioPlan",$precioPlan, PDO::PARAM_STR);
            $stmt->bindParam(":cantDocumentos",$cantDocumentos, PDO::PARAM_STR);
            $stmt->bindParam(":total_pagar",$total_pagar, PDO::PARAM_STR);
            $stmt->bindParam(":estado",$estado, PDO::PARAM_STR);
            $stmt->bindParam(":fotoComprobante",$RutFoto, PDO::PARAM_STR);
            $stmt->bindParam(":clave",$Clave, PDO::PARAM_STR);
    
            if($stmt->execute()){

                return $db->lastInsertId();
            }
    
            else{
    
                return $stmt->errorInfo()[2];
            }
    
            $stmt -> close();
    
            $stmt =null;
    
        }

        static public function MdlEditarPlanesClientes($table, $Editarclientes, $EditardiaPago, $EditardiaMax, $EditarplanSelect, $EditarcatSelect, $Editartotal) { 

            $stmt = Connexion::connect()->prepare("UPDATE $table SET fecha_corte='$EditardiaPago', fecha_extencion='$EditardiaMax', categoria = '$EditarcatSelect', total_pagar = '$Editartotal'  where cliente = '$Editarclientes' and plan = '$EditarplanSelect'");
        
            if($stmt->execute()){
        
                return "ok";
            }
        
            else{
        
                // return $stmt;
        
                return $stmt->errorInfo()[2];
            }
        
            $stmt -> close();
        
            $stmt =null;
        
        }


        static public function MdlCargarPlanesClientes($table, $idEmpresa) {

                        
            $stmt = Connexion::connect()->prepare("SELECT * FROM $table where cliente = '$idEmpresa'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }



        static public function MdlCargarDatosPaquetes($table1, $table2, $table3, $PackSelect) {

                        
            $stmt = Connexion::connect()->prepare("SELECT 
            a.*, b.nombre,c.monto,c.cant_documentos
        FROM
                $table1 a
                INNER JOIN
                $table2 b ON a.plan = b.idtbl_modulos_outthebox
                INNER JOIN
                $table3 c ON a.categoria = c.idtbl_categoria_planes WHERE cliente = '$PackSelect'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }

        static public function MdlElimianrPaquete($table, $deletePack) { 

            $stmt = Connexion::connect()->prepare("DELETE FROM $table WHERE idtbl_clientes_planes = '$deletePack'");
    
            if($stmt->execute()){
    
                return "ok";
            }
    
            else{
    
                return $stmt->errorInfo()[2];
            }
    
            $stmt -> close();
    
            $stmt =null;
    
        }
        
        
        static public function MdlCargarPaquetes($table, $IdEmp) {

                        
            $stmt = Connexion::connect()->prepare("SELECT 
            *
        FROM
            empresas.tbl_categoria_planes
        WHERE
           estado = 'Activo' and  idtbl_categoria_planes NOT IN (SELECT 
                    idPlan
                FROM
                    empresas.tbl_clientes_planes
                WHERE
                    cliente = '$IdEmp' and DATEDIFF(CURDATE(), fecha_fin) <= -15 and estado in ('Activo','Pendiente')) order by precio asc");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }


        static public function MdlCargarDatosPago($table, $tipoPago) {

                        
            $stmt = Connexion::connect()->prepare("SELECT * FROM  $table where nombre = '$tipoPago'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }

        static public function MdlCargarPaquetesID($table, $idPaquete) {

                        
            $stmt = Connexion::connect()->prepare("SELECT * FROM  $table where idtbl_categoria_planes = '$idPaquete'");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

        }


}