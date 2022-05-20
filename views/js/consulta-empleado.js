var salario_base=0;
var resultado2=0;  
var resultado_final =0;

$(".empleados_consulta_empleados").change(function(){
  
 var idEmpleado = "";
  empresaEmpleado = $("option:selected", "#empresaheader").val();

  $(".imgFrontalView").empty();
  $(".imgTraseraView").empty();
  $(".imgEmpleadoView").empty();

   var varempleado= $(this).val();

   $("#idEmpleadoImg").val(varempleado);
   $("#idEmpresaImg").val(sessionStorage["empresa"]);
 

 var data = new FormData();

    data.append("varempleado",varempleado);
     
     $.ajax({
            url:"ajax/consulta-empleados.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             dataType: "json",

            success: function(response){
                // console.log("response", response);



           $("#cedula-consulta-cliente").val(response["cedula"]);
            var date ="";
            date = moment(response["fecha_nacimiento"]).format('DD-MM-YYYY');
         
        
         
            $("#fecha-nacimiento-consulta-cliente").val(date);


         date = moment(response["fecha_ingreso"]).format('DD-MM-YYYY');

         idEmpleado = response["idtbl_empleados"];
         $("#IdEmpleado-consulta-cliente").val(response["idtbl_empleados"]);
            $("#fecha-ingreso-consulta-cliente").val(date);
            $("#telefono-consulta-cliente").val(response["telefono"]);
            $("#direccion-consulta-cliente").val(response["direccion"]);
            $("#departamento-consulta-cliente").val(response["departamento"]);
            $("#nombre-consulta-cliente").val(response["nombre_completo"]);
            $("#puesto-consulta-cliente").val(response["puesto"]);
            $("#cuenta-consulta-cliente").val(response["cuenta"]);
            if(response["activo"]=="Si"){

               $("#activo-consulta-cliente").val("Activo");  
            }else{

                 $("#activo-consulta-cliente").val("Desactivo");
            };

            
            // activateMyDropzone(empresaEmpleado, response["idtbl_empleados"]);

          $('#modal-consultaEmpleado').modal('show'); // abrir

 
          var data = new FormData();

          data.append("idEmpleado",varempleado);
          data.append("idEmpresa",sessionStorage["empresa"])
          $.ajax({
            url:"ajax/consulta-empleados.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             //dataType: "json",

            success: function(response){
              console.log("response", response);
              if(response.trim()=="ok"){
          
                $(".imgFrontalView").append($("<img src='apiHacienda/clientes/" + sessionStorage["empresa"] + "/FotoTrabajadores/" +varempleado+ "/foto_cedula_frente.jpg' width='200px' height ='200px'>"));
                $(".imgTraseraView").append($("<img src='apiHacienda/clientes/" + sessionStorage["empresa"] + "/FotoTrabajadores/" +varempleado+ "/foto_cedula_atras.jpg' width='200px' height ='200px'>"));
                $(".imgEmpleadoView").append($("<img src='apiHacienda/clientes/" + sessionStorage["empresa"] + "/FotoTrabajadores/" +varempleado+ "/foto_empleado.jpg' width='200px' height ='200px'>"));
              
              } else {

                $(".imgFrontalView").append($("<p>Imagen Frontal de la cédula no registrada</p>"));
                $(".imgTraseraView").append($("<p>Imagen Trasera de la cédula no registrada</p>"));
                $(".imgEmpleadoView").append($("<p>Imagen Trasera de la cédula no registrada</p>"));

              }

            },
         error: function(response, err){ console.log('my message ' + err + " " + response);}
 })
         

      },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})
 
  
       cargarTablaDocumentos(idEmpleado, empresaEmpleado);






    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "ajax/Subir-archivos-empleados.ajax.php?empresa="+ empresaEmpleado +"&empleado="+ idEmpleado, // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button"// Define the element that should be used as click trigger to select files.
    });
  
    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); 
      
        Swal.fire(
          "Aviso",
          "Documento guardado exitosamente.",
          "success"
        ).then((result) => {
         
          window.location = "consulta-empleados";
  
        }) 
      };
    });
  
    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });
  
    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1";
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    });
  
    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0";
    });
  
    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
    
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      
      Swal.fire(
        "Aviso",
        "Documento guardado exitosamente.",
        "success"
      ).then((result) => {
       
        window.location = "consulta-empleados";

      }) 


      //cargarTablaDocumentos(idEmpleado, empresaEmpleado);
    };
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true);
    };
    // DropzoneJS Demo Code End
  

});





function cargarImagenes(varempleado) {
   idEmpresa = sessionStorage["empresa"];

   imgFrente = "/var/www/outthebox/apiHacienda/clientes/" + idEmpresa + "/FotoTrabajadores/" + varempleado + "/foto_cedula_frente.jpg"
   imgAtras = "/var/www/outthebox/apiHacienda/clientes/" + idEmpresa + "/FotoTrabajadores/" + varempleado + "/foto_cedula_atras.jpg"

   
}



function cargarTablaDocumentos(idEmpleado, empresaEmpleado){

  $("#tbodyDocs").empty();
  var data = new FormData();

  data.append("idEmpleadoT",idEmpleado);
  data.append("idEmpresaT", empresaEmpleado)
  $.ajax({
    url:"ajax/consulta-empleados.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
     //dataType: "json",
    success: function(response){
      // console.log("response", response);
      $("#tbodyDocs").append(response)

    },
 error: function(response, err){ console.log('my message ' + err + " " + response);}
})

}




$(".fotoCedulaEmpleadoFrontal").change(function () {

   var image = this.files[0];
   // console.log("image", image);

   /*=============================================
   =FILTER FORMAT PICTURE ONLY PNG - JPG        =
   =============================================*/

   if (image["type"] != "image/jpeg") {

     $(".fotoCedulaEmpleadoFrontal").val("");

     swal({

       type: "error",
       text: "La imagen debe estar en formato JPG",
       title: "¡Error al subir las imagenes!",
       confirmButtonText: "Cerrar"

     });

   } else {

     var ImageData = new FileReader;

     ImageData.readAsDataURL(image);

     $(ImageData).on("load", function (event) {

       var ImageRoute = event.target.result;

       $(".fotoCedulaEmpleadoFrontalVista").attr("src", ImageRoute);


     })

   }

 })


 $(".fotoCedulaEmpleadoTrasera").change(function () {

   var image = this.files[0];
   // console.log("image", image);

   /*=============================================
   =FILTER FORMAT PICTURE ONLY PNG - JPG        =
   =============================================*/

   if (image["type"] != "image/jpeg") {

     $(".fotoCedulaEmpleadoTrasera").val("");

     swal({

       type: "error",
       text: "La imagen debe estar en formato JPG",
       title: "¡Error al subir la imagen!",
       confirmButtonText: "Cerrar"

     });

   } else {

     var ImageData = new FileReader;

     ImageData.readAsDataURL(image);

     $(ImageData).on("load", function (event) {

       var ImageRoute = event.target.result;

       $(".fotoCedulaEmpleadoTraseraVista").attr("src", ImageRoute);


     })

   }

 });



 $(".fotoEmpleado").change(function () {

  var image = this.files[0];
  // console.log("image", image);

  /*=============================================
  =FILTER FORMAT PICTURE ONLY PNG - JPG        =
  =============================================*/

  if (image["type"] != "image/jpeg") {

    $(".fotoEmpleado").val("");
 
    swal({

      type: "error",
      text: "La imagen debe estar en formato JPG",
      title: "¡Error al subir la imagen!",
      confirmButtonText: "Cerrar"

    });

  } else {

    var ImageData = new FileReader;

    ImageData.readAsDataURL(image);

    $(ImageData).on("load", function (event) {

      var ImageRoute = event.target.result;

      $(".fotoEmpleadoVista").attr("src", ImageRoute);


    })

  }

});


$("#btnCargarImgIdentificacion").click(function (e) {
  
  imgFrontal = $("#imgIdefntificacionFrontal").val();
  imgTrasera = $("#imgIdefntificacionTrasera").val();

  if(imgFrontal == "" || imgTrasera == "") {
    
    e.preventDefault();
  //   Swal.fire(
  //     "¡ATENCIÓN!",
  //     "Debes completar los campos de imagenes.",
  //     "warning"
  // ).then((result) => {
   
  // })
    

  } else {

    $("#overlay2").fadeIn();
  }
})


 

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false;

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);





const  generateRandomString = (num) => {
  const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  let result1= ' ';
  const charactersLength = characters.length;
  for ( let i = 0; i < num; i++ ) {
      result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result1;
}



$(".sortable").on("click", "button.btnElimArch", function(){
  // $(".btnElimArch").click(function () {
  
  let ruta = $(this).attr("rut");
  let empresaclient = $("option:selected", "#empresaheader").val();
  let idEmpleado = $(this).attr("empl");
  

    var data = new FormData();
  
    data.append("RutaDelete",ruta);
    // data.append("idEmpresaT", empresaEmpleado)
    $.ajax({
      url:"ajax/consulta-empleados.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      //  dataType: "json",
      success: function(response){
        console.log("response", response);

        if(response.trim() == "OK"){

          Swal.fire(
            "Aviso",
            "Documento Eliminado exitosamente",
            "success"
          ).then((result) => {
           
        // window.location = "reporte-sistema-facturacion";
          }) 

          cargarTablaDocumentos(idEmpleado, empresaclient);

        }else{

          Swal.fire(
            "Error",
            "Error al Eliminar Documento, Intente nuevamente.",
            "error"
          ).then((result) => {
           
            window.location = "consulta-empleados";
          }) 


        }
       
  
      },
   error: function(response, err){ console.log('my message ' + err + " " + response);}
  })
  
  
  });


  $(".sortable").on("click", "button.btnRename", function(){

    let ruta = $(this).attr("rut");
    let empresaclient = $("option:selected", "#empresaheader").val();
    let idEmpleado = $(this).attr("empl");

    Swal.fire({
      title: "Ingrese el nombre del documento",
      text: "Nombre",
      input: 'text',
      showCancelButton: true        
  }).then((result) => {
      if (result.value) {
            
        var data = new FormData();

        data.append("RenameNombre",result.value.replace(/\./g, ''));
        data.append("RenameRuta", ruta);
        data.append("RenameEmpresa", empresaclient);
        data.append("RenameEmpleado", idEmpleado);
        $.ajax({
          url:"ajax/consulta-empleados.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          //  dataType: "json",
          success: function(response){
           
          console.log(response);

            if(response.trim() == "OK"){

              Swal.fire(
                "Aviso",
                "Documento Renombrado exitosamente",
                "success"
              ).then((result) => {
               
            // window.location = "reporte-sistema-facturacion";
              }) 
    
              cargarTablaDocumentos(idEmpleado, empresaclient);
    
            }else{
    
              Swal.fire(
                "Error",
                "Error al Renombrado Documento, Intente nuevamente.",
                "error"
              ).then((result) => {
               
                window.location = "consulta-empleados";
              }) 
    
            }
      
          },
       error: function(response, err){ console.log('my message ' + err + " " + response);}
      })

         
      }else{
  
        Swal.fire(
          "Error",
          "!Ingrese un nombre para continuar¡",
          "error"
        ).then((result) => {
         
      // window.location = "reporte-sistema-facturacion";
        }) 
      }
  });


});






