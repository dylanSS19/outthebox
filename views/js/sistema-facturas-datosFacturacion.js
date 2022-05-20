

$(".btnGuardarDtsFact").click(function () {

    let imagen = $("#documento_p12");
    let pin = $("#pin_p12").val();
    let usuario = $("#usuario_token").val();
    let contrasena = $("#contrasena_token").val();
    let empresa = $("option:selected", "#empresaheader").val();

    enviarArchivop12(empresa, pin, usuario, contrasena, imagen);

});

$(".btnGuardarDtsFactP").click(function () {

    let imagen = $("#documento_p12_prueba");
    let pin = $("#pin_p12_prueba").val();
    let usuario = $("#usuario_token_prueba").val();
    let contrasena = $("#contrasena_token_prueba").val();
    let empresa = $("option:selected", "#empresaheader").val();

    enviarArchivop12P(empresa, pin, usuario, contrasena, imagen);

});

function enviarArchivop12(empresa, pin, usuario, contrasena, documento) {

    let ruta = "";
        
    documento = documento[0].files[0];

if(pin == ""){

    Swal.fire(
        "Aviso",
        "Datos incompletos, pin del token es un dato requerido.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      })    
      return false;

}

if(usuario == ""){

    Swal.fire(
        "Aviso",
        "Datos incompletos, usuario del token es un dato requerido.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      })    
      return false;

}

if(contrasena == ""){

    Swal.fire(
        "Aviso",
        "Datos incompletos, contraseña del token es un dato requerido.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      })    
      return false;

}

if(documento == undefined || documento == "undefined" || documento == ""){
    
        Swal.fire(
            "Aviso",
            "Datos incompletos, documento p12  es un dato requerido.",
            "warning"
          ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
          })    
          return false;
}
    

    // console.log(documento);
    
    // return false;
    
        var data = new FormData();
        data.append("pin", pin); 
        data.append("documento", documento); 
        data.append("usuario", usuario); 
        data.append("contrasena", contrasena); 
        data.append("empresa", empresa); 


           $.ajax({
         
                  url:"ajax/sistema-facturas-datosFacturacion.ajax.php", 
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                //   dataType: "json",  
        
                  success: function(response){
        
                    console.log(response);

                    if(response.trim() == "ok"){

                        Swal.fire(
                            "Exelente",
                            "Datos ingresados correctamente.",
                            "success"
                          ).then((result) => {
                        window.location = "sistema-facturas-datosFacturacion";
                          }) 

                    }else if(response.trim() == "Error tk"){

                        Swal.fire(
                            "Aviso",
                            "Datos del token incorrectos, favor validar la información y volver a intentar.",
                            "warning"
                          ).then((result) => {
                        // window.location = "sistema-facturas-datosFacturacion";
                          }) 


                    }else{

                        Swal.fire(
                            "Aviso",
                            "Error al ingresar los datos, intente nuevamente.",
                            "error"
                          ).then((result) => {
                        window.location = "sistema-facturas-datosFacturacion";
                          }) 

                    }

                    // ruta = response;
        
                  },
        
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            }) 
    
    // return ruta;
    
    }
    

    function enviarArchivop12P(empresa, pin, usuario, contrasena, documento) {
            
        documento = documento[0].files[0];
    
    if(pin == ""){
    
        Swal.fire(
            "Aviso",
            "Datos incompletos, pin del token es un dato requerido.",
            "warning"
          ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
          })    
          return false;
    
    }
    
    if(usuario == ""){
    
        Swal.fire(
            "Aviso",
            "Datos incompletos, usuario del token es un dato requerido.",
            "warning"
          ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
          })    
          return false;
    
    }
    
    if(contrasena == ""){
    
        Swal.fire(
            "Aviso",
            "Datos incompletos, contraseña del token es un dato requerido.",
            "warning"
          ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
          })    
          return false;
    
    }
    
    if(documento == undefined || documento == "undefined" || documento == ""){
        
            Swal.fire(
                "Aviso",
                "Datos incompletos, documento p12  es un dato requerido.",
                "warning"
              ).then((result) => {
            //window.location = "reporte-sistema-facturacion";
              })    
              return false;
    }
        
    
        console.log(documento);
        
        // return false;
        
            var data = new FormData();
            data.append("pin_P", pin); 
            data.append("documento_P", documento); 
            data.append("usuario_P", usuario); 
            data.append("contrasena_P", contrasena); 
            data.append("empresa_P", empresa); 
        
               $.ajax({
                   
                      url:"ajax/sistema-facturas-datosFacturacion.ajax.php", 
                      method: "POST",
                      data: data,
                      cache: false,
                      contentType: false,
                      processData: false,
                      async: false,
                    //   dataType: "json",  
            
                      success: function(response){
            
                        console.log(response);
    
                        if(response.trim() == "ok"){
    
                            Swal.fire(
                                "Exelente",
                                "Datos ingresados correctamente.",
                                "success"
                              ).then((result) => {
                            window.location = "sistema-facturas-datosFacturacion";
                              }) 
    
                        }else if(response.trim() == "Error tk"){
    
                            Swal.fire(
                                "Aviso",
                                "Datos del token incorrectos, favor validar la información y volver a intentar.",
                                "warning"
                              ).then((result) => {
                            // window.location = "sistema-facturas-datosFacturacion";
                              }) 
    
    
                        }else{
    
                            Swal.fire(
                                "Aviso",
                                "Error al ingresar los datos, intente nuevamente.",
                                "error"
                              ).then((result) => {
                            window.location = "sistema-facturas-datosFacturacion";
                              }) 
    
                        }
    
                        // ruta = response;
            
                      },
            
                      error: function(response, err){ console.log('my message ' + err + " " + response );}
            
                }) 
        
        // return ruta;
        
        }