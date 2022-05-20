$ ( ".privilegios" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});

$ ( ".bodega_usuario" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});


 


// var Rol = "ok";
// $.ajax({

         
//           url:'ajax/datatable-creacion-usuario-clientes.ajax.php?Rol='+Rol,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },
// error: function(response, err){ console.log('my message ' + err + " " + response );}
//       });









$(document).ready(function() {

	var Rol = "ok";


//  $.ajax({

           
//            url:'ajax/datatable-creacion-usuario-clientes.ajax.php?Rol='+Rol,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        }); 



 var table = $("#tablausuariosclientes").DataTable({

       "ajax": 'ajax/datatable-creacion-usuario-clientes.ajax.php?Rol='+Rol,  
       "async": "false",

      "responsive": true, "lengthChange": false, 
      "autoWidth": true,
   "deferRender": true,
  "retrieve": true,
  "processing": true,
 "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

     

  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último", 
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  },
  initComplete: function () {
                table.buttons().container()
                    .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
            }

    })
  

});



$("#tablausuariosclientes").on("click", "button.EstadoUsuario", function(){
// $(".EstadoUsuario").click(function(){

let varidusuario_selected = $(this).attr("id_tblusuario");
let estado_usuario = $(this).attr("estado_usuario");
// console.log("estado_usuario", estado_usuario);


var data = new FormData();

data.append("varidusuario_selected", varidusuario_selected);  
data.append("estado_usuario", estado_usuario); 
 
$.ajax({

            url:"ajax/creacion-usuarios-clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          // dataType: "json",    

          success: function(response){               
            // console.log("response", response);

if(response = "OK"){

 Swal.fire(
      "Actualización exitosa!",
      "El usuario ha sido actualizado",
      "success"
    ).then((result) => {

  window.location = "creacion-usuarios-clientes";
    });    


}else{

 Swal.fire(
      "Error al actualizar el estado del usuario, intente nuevamente!",
      "Error",
      "error"
    ).then((result) => {

  window.location = "creacion-usuarios-clientes";
    }); 


}






                    },



                error: function(response, err){ console.log('my message ' + err + " " + response );}
     });


});




$("#frmAsigbtnsearch").click(function () {


// is-valid
//! is-invalid


$("#frmAsigUsuariossearch").removeClass('is-invalid');
$("#frmAsigUsuariossearch").removeClass('is-valid');

let user = $("#frmAsigUsuariossearch").val();
let empresa  = $("option:selected", ".empresaheader").val();

var data = new FormData();
data.append("usuarios",user.trim());  
data.append("empresaSelected3",empresa);  

$.ajax({

            url:"ajax/creacion-usuarios-clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){

  //  console.log(response);
          if(response == "" || response.length == 0){

          $("#frmAsigUsuariossearch").addClass('is-invalid');
          $("#frmAsigModulos").attr('disabled', true);


          Swal.fire({
            title: 'Usuario no regitrado',
            text: "El usuario no se encuentra registrado en la empresa seleccionada, ¿Desea agregarlo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Agregar'
          }).then((result) => {

            let IDuser = cargarIdUser();
            AgregarUsuarioEmpresa(IDuser);


          });

      



          }else{

            $("#frmAsigUsuariossearch").addClass('is-valid');
            $("#frmAsigDatosUser").attr("iduser", response[0].idtbluser_2);
            $("#frmAsigDatosUser").attr("nombreuser",response[0].nombre);
            $("#frmAsigDatosUser").val(response[0].idtbluser_2);
            $("#frmAsigModulos").removeAttr("disabled");
            $("#frmAsigModulosUser").val(response[0].modulos);

            
          }


          },
                error: function(response, err){ console.log('my message ' + err + " " + response );}
           })

           
});



$("#frmAsigModulos").change(function() {

let modulo = $(this).val();
$(".divsSubmodulos").empty();
  var data = new FormData();
  data.append("modulos",modulo);  
  
  $.ajax({
  
              url:"ajax/creacion-usuarios-clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
  
            success: function(response){
  
            // console.log(response);

                for(var i = 0; i < response.length; i++){ 

                    if(response[i].tipoRama == "Multiple"){

                      $(".divsSubmodulos").append(                                  
                        '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" class="chkModulos2" id="'+ response[i].idtbl_subModulos_outthebox +'" >'+
                        '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                        '</div>');

                      cargarchkMultiple(response[i].idtbl_subModulos_outthebox);

                    }else{

                      $(".divsSubmodulos").append(                                  
                        '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" class="chkModulos2" id="'+ response[i].idtbl_subModulos_outthebox +'">'+
                        '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                        '</div>');

                    }

                  

                }

            },
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
             })

});



// $('#selectTodos').on('ifChanged', function(event){

// $('input[type="checkbox"]').each(function() {

//     console.log($(this).val());

//    });
// });

$('.divsSubmodulos').change(function() {

 

  $('input[type="checkbox"]').change(function(){

    
    if($(this).is(':checked')){

      $(this).attr('checked', true);
      
      
    }else{
     
      $(this).removeAttr("checked");
     
    }


  });

})



$('.selectTodos').on('ifChecked', function(event){


$('input[type="checkbox"]').each(function() {

    // console.log($(this).val());

    $(this).attr('checked', true);

   });

  });


  $('.selectTodos').on('ifUnchecked', function (event) {

    $('input[type="checkbox"]').each(function() {

      // $(this).prop('checked', true);
      $(this).removeAttr('checked');
  
     });

});


$(".btnAgregarMods").click(function () {

  let listaSubMods = [];
  let listaSubMods2 = [];

  let modulos = $("#frmAsigModulosUser").val();

  modulos = JSON.parse(modulos);

  for (let i = 0; i < modulos.length; i++) {

      listaSubMods.push(modulos[i]);
  }


// console.log(modulos);
// console.log(listaSubMods);

// return false;
  Swal.fire({
    title: 'Agregar Privilegios',
    text: "Se agregaran los privilegios al usuario seleccionado, desea continuar con el proceso?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Agregar'
  }).then((result) => {

    if (result.isConfirmed) {
     
      
      $('input[type="checkbox"]').each(function() {
    
        // console.log($(this).val());
    
        if($(this).is(':checked') && $(this).attr("id") != "chktodos"){
    
          
        listaSubMods2.push($(this).attr("id"));             
 
        }else{
    
    
        }
    
      });
    

// console.log(listaSubMods2);


    let existencia = 0;
        for (let j = 0; j < listaSubMods.length; j++) {
        
          existencia = 0;

            for (let i = 0; i < listaSubMods2.length; i++) {
              
                if(listaSubMods2[i] == listaSubMods[j]){

                  existencia = 1;
                  break;

                }else{
                      
                } 

              }

          if(existencia == 0){

            listaSubMods2.push(listaSubMods[j]);

          }
            
        }
        
    
      agregarPrivilegios(listaSubMods2);     
      cargarPrivilegios();
      $(".selectTodos").removeAttr('checked');
    }


  })

});



function agregarPrivilegios(listaSubMods) {
 

// console.log(listaSubMods);

// return false;

let IdUser = $("#frmAsigDatosUser").attr("iduser");
let empresa = $("option:selected", ".empresaheader").val();

if(IdUser == ""){

  Swal.fire(
    "Aviso",
    "Seleccione un cliente para continuar con el proceso.",
    "warning"
  ).then((result) => {
//window.location = "reporte-sistema-facturacion";
  })    
  return false;

}

  var data = new FormData();
  data.append("privilegio",JSON.stringify(listaSubMods));  
  data.append("user",IdUser);  
  data.append("empresaSelected",empresa);  

  $.ajax({
  
            url:"ajax/creacion-usuarios-clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
  
            success: function(response){
  
            // console.log(response);


      if(response.trim() == "ok"){

        Swal.fire(
          "Aviso",
          "Privilegios asignados correctamente.",
          "success"
        ).then((result) => {

        // window.location = "creacion-usuarios-clientes";

      }) 


        $(".divsSubmodulos").empty();

      }else{

        Swal.fire(
          "Aviso",
          "Error al ingresar los datos intente nuevamente.",
          "warning"
        ).then((result) => {

        window.location = "creacion-usuarios-clientes";

      })    


      }
          
            },
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
             })

}



function cargarPrivilegios(){
  

let usuario = $("#frmAsigDatosUser").attr("iduser");
let empresa = $("option:selected", ".empresaheader").val();


// console.log(usuario);
 
  var data = new FormData();

  data.append("usuario2",usuario);
  data.append("empresaSelected2",empresa);  

  
  $.ajax({
  
              url:"ajax/creacion-usuarios-clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
  
            success: function(response){
  
            // console.log(response);
            if(response == "" || response.length == 0){
  
              Swal.fire(
                "Aviso",
                "Error en el proceso intente nuevamente.",
                "warning"
              ).then((result) => {
            
              window.location = "creacion-usuarios-clientes";
            
            })    
  
            }else{
  
             
              $("#frmAsigModulosUser").val(response[0].modulos);
  
              
            }
  
  
            },
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
             })
  
}


function AgregarUsuarioEmpresa(IDuser){
  
  let IDempresa = $("option:selected",".empresaheader").val();
  let nombreEmpresa = $("option:selected",".empresaheader").text();

  console.log(IDuser);
  console.log(IDempresa);
  console.log(nombreEmpresa);

// return false;

    var data = new FormData();
  
    data.append("IDuser",IDuser);  
    data.append("IDempresa",IDempresa);  
    data.append("nombreEmpresa",nombreEmpresa);  
    // data.append("privilegios",privilegios);  

    $.ajax({
    
                url:"ajax/creacion-usuarios-clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              // dataType: "json",  
    
              success: function(response){
    
              console.log(response);
              
                if(response.trim() == "ok"){

                  Swal.fire(
                    "Aviso",
                    "Usuario registrado correctamente",
                    "success"
                  ).then((result) => {
                
                  window.location = "creacion-usuarios-clientes";
                
                })   

                }else{

                  Swal.fire(
                    "Aviso",
                    "Error al ingresar el usuario, intente nuevamente.",
                    "warning"
                  ).then((result) => {
                
                  window.location = "creacion-usuarios-clientes";
                
                })   

                }
    
              },
                    error: function(response, err){ console.log('my message ' + err + " " + response );}
               })
    
  }


function cargarIdUser (){

  let nombreUser = $("#frmAsigUsuariossearch").val();
  let idusuario;

  var data = new FormData();
  
  data.append("nombreUser",nombreUser);  
   
  $.ajax({
  
              url:"ajax/creacion-usuarios-clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
  
            success: function(response){
  
            
            idusuario = response[0]["idtbluser_2"];
  
            },
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
             })

return idusuario;

}





  function cargarchkMultiple(idSubmod){

console.log(idSubmod);
    var data = new FormData();
    data.append("modulosSB",idSubmod);  
    
    $.ajax({
    
                url:"ajax/creacion-usuarios-clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
    
              success: function(response){
    
              console.log(response);
  
                  for(var i = 0; i < response.length; i++){ 
  
                    if(response[i].tipoRama != 'Multiple'){

                      $(".divsSubmodulos").append(                                  
                        '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" class="chkModulos2" id="'+ response[i].idtbl_subModulos_outthebox +'">'+
                        '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                        '</div>');

                    }else{

                      $(".divsSubmodulos").append(                                  
                        '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" class="chkModulos2" id="'+ response[i].idtbl_subModulos_outthebox +'">'+
                        '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                        '</div>');

                      cargarchkMultiple2(response[i].idtbl_subModulos_outthebox);

                    }

                    
  
                  }
  
              },
                    error: function(response, err){ console.log('my message ' + err + " " + response );}
               })

  }


  function cargarchkMultiple2(idSubmod){

    console.log(idSubmod);
        var data = new FormData();
        data.append("modulosSB",idSubmod);  
        
        $.ajax({
        
                    url:"ajax/creacion-usuarios-clientes.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
        
                  success: function(response){
        
                  console.log(response);
      
                      for(var i = 0; i < response.length; i++){ 
      
                        $(".divsSubmodulos").append(                                  
                        '<div class="form-check">'+
                        '<input class="form-check-input" type="checkbox" class="chkModulos2" id="'+ response[i].idtbl_subModulos_outthebox +'">'+
                        '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                        '</div>');
      
                      }
      
                  },
                        error: function(response, err){ console.log('my message ' + err + " " + response );}
                   })
    
      }



  $("#tablausuariosclientes").on("click", "button.modPrivilegios", function(){


    let usuario = $(this).attr("id_usuario");
    let empresa = $("option:selected", ".empresaheader").val();
    
    $("#frmAsigEditModIDuser").val(usuario);
    console.log(usuario);

    // return false;
     
      var data = new FormData();
    
      data.append("usuario2",usuario);
      data.append("empresaSelected2",empresa);  
    
      
      $.ajax({
      
                  url:"ajax/creacion-usuarios-clientes.ajax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                dataType: "json",  
      
                success: function(response){
      
                // console.log(response);
            
      
                //   Swal.fire(
                //     "Aviso",
                //     "Error en el proceso intente nuevamente.",
                //     "warning"
                //   ).then((result) => {
                
                //   window.location = "creacion-usuarios-clientes";
                
                // })    
       
              
      let modulos = JSON.parse(response[0].modulos);
                 

for (let i = 0; i < modulos.length; i++) {
  
  // console.log(modulos[i]);
  cargarchkSubMods(modulos[i]);
  
}

                  // $("#frmAsigModulosUser").val(response[0].modulos);
                  
                  // console.log(JSON.parse(response[0].modulos));
                  
                
      
      
                },
                      error: function(response, err){ console.log('my message ' + err + " " + response );}
    })






$('#modaleditar_usuarios').modal('show'); // abrir
//$('#myModalExito').modal('hide'); // cerrar


 
    
});


function cargarchkSubMods(idSubmod){

  // console.log(idSubmod);
      var data = new FormData();
      data.append("modulosUser",idSubmod);  
      
      $.ajax({
      
                  url:"ajax/creacion-usuarios-clientes.ajax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                dataType: "json",  
      
                success: function(response){
      
                console.log(response);
    
                    for(var i = 0; i < response.length; i++){ 
    
                      $(".divsSubmodulosEditar").append(                                  
                      '<div class="form-check">'+
                      '<input class="form-check-input" type="checkbox" class="chkModulos" id="'+ response[i].idtbl_subModulos_outthebox +'" checked="checked">'+
                      '<label class="form-check-label" for="'+ response[i].idtbl_subModulos_outthebox +'">'+ response[i].nombre +'</label>'+
                      '</div>');
    
                    }
    
                },
                      error: function(response, err){ console.log('my message ' + err + " " + response );}
                 })
  
    }




    $(".divsSubmodulosEditar").on("change", "input.chkModulos", function(){


      console.log("hola");
      
      
      
      });


      $('.divsSubmodulosEditar').change(function() {

 

        $('input[type="checkbox"]').change(function(){

          
          if($(this).is(':checked')){

            $(this).attr('checked', true);
            
            console.log("No");
          }else{
           
            $(this).removeAttr("checked");
            console.log("Si");
          }


        });

      })


    $(".btnUodateMods").click( function(){

      let listaSubModEditar = [];

let usuario = $("#frmAsigEditModIDuser").val();
let empresa  = $("option:selected", ".empresaheader").val();

      $('input[type="checkbox"]').each(function() {
    
        // console.log($(this).val());
    
        if($(this).is(':checked') && $(this).attr("id") != "chktodos"){
    
          
          listaSubModEditar.push($(this).attr("id"));             
 
        }else{
    
    
        }
    
      });
      
      modificarPrivilegios(listaSubModEditar, usuario, empresa);
         
  });




  function modificarPrivilegios(listaSubModEditar, usuario, empresa){

var data = new FormData();
data.append("modulosEdit",JSON.stringify(listaSubModEditar));
data.append("UserEdit",usuario);  
data.append("empresaEdit",empresa);

$.ajax({

            url:"ajax/creacion-usuarios-clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          // dataType: "json",  

          success: function(response){

          console.log(response);

          if(response.trim() == "ok"){

            Swal.fire(
              "Aviso",
              "Datos modificados exitosamente",
              "success"
            ).then((result) => {
          
            window.location = "creacion-usuarios-clientes";
          
          })   

          }else{

            Swal.fire(
              "Aviso",
              "Error al modificar los datos, intente nuevamente.",
              "warning"
            ).then((result) => {
          
            window.location = "creacion-usuarios-clientes";
          
          })   

          }

             

          },
                error: function(response, err){ console.log('my message ' + err + " " + response );}
           })



 


  }