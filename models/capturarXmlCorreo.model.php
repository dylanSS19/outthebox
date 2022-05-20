<?php

require_once "connexion.php";

class BotXmlModel{


            static public function MdlInsertDatosFactura($table, $datosFactura) {

                
                $stmt = Connexion::connect()->prepare("INSERT IGNORE INTO $table(clave, consecutivo, actividadEconomica, fechaEmision, nombreEmisor, nombreComerEmisor, cedulaEmisor, tipoCedEmisor, nombreReceptor, nombreComerReceptor, cedulaReceptor, tipoCedReceptor, condicionVenta, MedioPago, moneda, tipoCambio, totalGabado, totalExento, totalDescuento, totalIva, totalComprobante) VALUES (:clave, :consecutivo, :actividadEconomica, :fechaEmision, :nombreEmisor, :nombreComerEmisor, :cedulaEmisor, :tipoCedEmisor, :nombreReceptor, :nombreComerReceptor, :cedulaReceptor, :tipoCedReceptor, :condicionVenta, :MedioPago, :moneda, :tipoCambio, :totalGabado, :totalExento, :totalDescuento, :totalIva, :totalComprobante)");

                $stmt->bindParam(":clave",$datosFactura["Clave"], PDO::PARAM_STR);
                $stmt->bindParam(":consecutivo",$datosFactura["Consecutivo"], PDO::PARAM_STR);
                $stmt->bindParam(":actividadEconomica",$datosFactura["ActividadEconomica"], PDO::PARAM_STR);	
                $stmt->bindParam(":fechaEmision",$datosFactura["FechaEmision"], PDO::PARAM_STR);
                $stmt->bindParam(":nombreEmisor",$datosFactura["NombreEmisor"], PDO::PARAM_STR);
                $stmt->bindParam(":nombreComerEmisor",$datosFactura["NombreComercialEmisor"], PDO::PARAM_STR);
                $stmt->bindParam(":cedulaEmisor",$datosFactura["CedulaEmisor"], PDO::PARAM_STR);
                $stmt->bindParam(":tipoCedEmisor",$datosFactura["TipoCedulaEmisor"], PDO::PARAM_STR);
                $stmt->bindParam(":nombreReceptor",$datosFactura["NombreReceptor"], PDO::PARAM_STR);
                $stmt->bindParam(":nombreComerReceptor",$datosFactura["NombreComercialReceptor"], PDO::PARAM_STR);
                $stmt->bindParam(":cedulaReceptor",$datosFactura["CedulaReceptor"], PDO::PARAM_STR);
                $stmt->bindParam(":tipoCedReceptor",$datosFactura["TipoCedulaReceptor"], PDO::PARAM_STR);
                $stmt->bindParam(":condicionVenta",$datosFactura["CodicionVenta"], PDO::PARAM_STR);
                $stmt->bindParam(":MedioPago",$datosFactura["MedioPago"], PDO::PARAM_STR);
                $stmt->bindParam(":moneda",$datosFactura["Moneda"], PDO::PARAM_STR);
                $stmt->bindParam(":tipoCambio",$datosFactura["TipoCambio"], PDO::PARAM_STR);
                $stmt->bindParam(":totalGabado",$datosFactura["TotalGravado"], PDO::PARAM_STR);
                $stmt->bindParam(":totalExento",$datosFactura["TotalExento"], PDO::PARAM_STR);
                $stmt->bindParam(":totalDescuento",$datosFactura["TotalDescuento"], PDO::PARAM_STR);
                $stmt->bindParam(":totalIva",$datosFactura["TotalIva"], PDO::PARAM_STR);
                $stmt->bindParam(":totalComprobante",$datosFactura["TotalFactura"], PDO::PARAM_STR);
                
                
                if($stmt->execute()){

                    return "ok";
                }

                else{

                    return $stmt->errorInfo()[2];
                }

                $stmt -> close();

                $stmt =null;


        }

}