<?php
 
require_once "connexion.php";

class apiCorreoMahindraModel {

	static public function MdlInsertarDatosMahindra($table, $data) {
			
        $db = Connexion::connect();

        $stmt = $db->prepare("INSERT IGNORE  INTO  $table (usuario_entrega, usuario_recibe, numero_transferencia, fuente, sub_tipo_transferencia, fecha_transferencia, nombre_producto, categoria_emisor, categoria_destinatario, cantidad_requerimiento, mrp, comision, cbc, impuesto, monto_debitado_emisor, monto_acreditado_destinatario, monto_pagado, monto_neto) VALUES(:usuario_entrega, :usuario_recibe, :numero_transferencia, :fuente, :sub_tipo_transferencia, :fecha_transferencia, :nombre_producto, :categoria_emisor, :categoria_destinatario, :cantidad_requerimiento, :mrp, :comision, :cbc, :impuesto, :monto_debitado_emisor, :monto_acreditado_destinatario, :monto_pagado, :monto_neto)");				

            $stmt->bindParam(":usuario_entrega",$data["usuario_entrega"], PDO::PARAM_STR);					
            $stmt->bindParam(":usuario_recibe",$data["usuario_recibe"], PDO::PARAM_STR);	
            $stmt->bindParam(":numero_transferencia",$data["numero_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fuente",$data["fuente"], PDO::PARAM_STR);
            $stmt->bindParam(":sub_tipo_transferencia",$data["sub_tipo_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_transferencia",$data["fecha_transferencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_transferencia",$data["fecha_transferencia"], PDO::PARAM_STR);	
            $stmt->bindParam(":nombre_producto",$data["nombre_producto"], PDO::PARAM_STR);	
            $stmt->bindParam(":categoria_emisor",$data["categoria_emisor"], PDO::PARAM_STR);	
            $stmt->bindParam(":categoria_destinatario",$data["categoria_destinatario"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad_requerimiento",$data["cantidad_requerimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":mrp",$data["mrp"], PDO::PARAM_STR);			
            $stmt->bindParam(":comision",$data["comision"], PDO::PARAM_STR);	
            $stmt->bindParam(":cbc",$data["cbc"], PDO::PARAM_STR);	
            $stmt->bindParam(":impuesto",$data["impuesto"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_debitado_emisor",$data["monto_debitado_emisor"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_acreditado_destinatario",$data["monto_acreditado_destinatario"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_pagado",$data["monto_pagado"], PDO::PARAM_STR);	
            $stmt->bindParam(":monto_neto",$data["monto_neto"], PDO::PARAM_STR);
           

        if($stmt->execute()){
            return $db->lastInsertId();
        }else{
            return $stmt->errorInfo()[2];
        }

        $stmt -> close();

        $stmt =null;


    }

}