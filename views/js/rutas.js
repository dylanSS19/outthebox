getLocationMasivo_noCompra();
 
 
$(document).ready(function(){
 
// sessionStorage.getItem("varid_ruta_masivo");
console.log("sessionStorage", sessionStorage.getItem("varid_ruta_masivo"));
     if(sessionStorage.getItem("varid_ruta_masivo")){

/*DESDE AQUI*/

$("#motivo_no_compra").val(sessionStorage.getItem('varid_ruta_masivo'));

 $('#motivo_no_compra').trigger('change');


   }

});


$(".btn_rutas").click(function(){

  sessionStorage.setItem("varid_ruta_masivo", "");

    
})




function getLocationMasivo_noCompra() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
/* console.log("Latitude: " + position.coords.latitude + 
  " Longitude: " + position.coords.longitude);*/

 $(".latitud_no_compra").val(position.coords.latitude);  


 $(".longitud_no_compra").val(position.coords.longitude);  
}
/*=============================================
=  		DIRIGIR AL MODULO DE RUTAS            =
=============================================*/



$(".rutas").on("click", "button.btn_nocompra", function(){
 // $(".btn_nocompra").click(function(){




document.getElementById("nombre").value = $(this).val();
document.getElementById("cedula").value = $(this).attr("cedula2");
document.getElementById("id_cliente").value = $(this).attr("cedula");
var nombre = $(this).val();

var cedula = $(this).attr("cedula");





})




 $(".btn_nocompra2").click(function(){

document.getElementById("nombre").value = $(this).val();
document.getElementById("cedula").value = $(this).attr("cedula2");
document.getElementById("id_cliente").value = $(this).attr("cedula");

var nombre = $(this).val();

var cedula = $(this).attr("cedula");



})





$(".nombre_rutas").change(function(){



  $(".rutas").empty();


var rutero = $(this).val();
console.log("rutero", rutero);
 var varid_ruta = $('option:selected', '.nombre_rutas').attr("codigo");
 var data = new FormData();

        sessionStorage.setItem('varid_ruta_masivo', rutero);


data.append("varid_ruta",varid_ruta);  

$.ajax({

            url:"ajax/rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
         
          

               if(response){
              

               for (var i = 0; i < response.length; i++) {


var str = moment(response[i]["fecha"]).format('DD/MM/YYYY');



     $(".rutas").append( 

        
            '<div class="box box-default collapsed-box my_box" id ='+response[i][0]+' >'+
          '<div class="box-header with-border ">'+

         '<h3 class="box-title nombres" >'+response[i][4]+'</h3>'+

        '<div class="box-tools pull-right">'+
            ' <button type="button" class="btn btn-box-tool boton_ruta" id="boton_ruta"  atts="0"  caja='+response[i][0]+' latitud ='+response[i][15]+' longitud = '+response[i][16]+' data-widget="collapse"><i class="fa fa-plus"></i>'+
          '</button>'+             
         '</div>'+

          '<div class="box box-success" >'+
             '<div class="box box-primary" >'+

                '<form role="form" method="POST">'+
                       '<div class="box-body">'+

                           '<div class="form-group" >'+
                           '<label for="exampleInputEmail1">Nombre</label>'+
                           '<input type="text" class="form-control" cedula ='+response[i][5]+' value="'+response[i][2]+'" placeholder="Nombre" readonly>'+
                          '</div>'+

                           '<div class="form-group">'+
                            '<label for="exampleInputEmail1">Comercio</label>'+
                            '<input type="text" class="form-control nombre_comercio"  name="nombre_comercio" value="'+response[i][3]+'" placeholder="Nombre Comercio" readonly>'+
                          '</div>'+

                             '<div class="form-group">'+
                            '<label for="exampleInputEmail1">Dirección</label>'+
                            '<input type="text" class="form-control"  value="'+response[i][14]+'" placeholder="Dirección"readonly>'+
                          '</div>'+

                        '</div>'+ 
                ' </form>'+

                  '<div class="box-footer">'+


                    '<a href="index.php?route=facturacion&valor='+response[i][4]+'&rutero='+rutero+'&id='+response[i][0]+'" style="padding:5px 10px">'+

                    '<span class=" btn btn-primary factura_ruta">Facturar</span>'+

                    '</a>'+

                     '<a href="https://www.google.com/maps/search/?api=1&query='+response[i][15]+','+response[i][16]+'" style="padding:5px 10px">'+

                  '<span class=" btn btn-primary">Ubicación</span>'+

               ' </a>'  +   

                '<a href="index.php?route=historico-facturas&perfil='+rutero+'&nombre='+response[i][4]+'" style="padding:5px 10px">'+

                '<span class=" btn btn-primary">Detalle</span>'+

                ' </a>'  + 

                  '</div>'+  

                    '<div class="box-footer">'+
                                                 
                    '<button class="btn btn-danger pull-right btn_nocompra" value="'+response[i][4]+'" data-toggle="modal" cedula="'+response[i][0]+'" cedula2="'+response[i][5]+'" data-target="#modalNocompra" style="padding:5px 10px">No Compra</button>'+
           
                      '</div>'+

              '</div>'+   


'<h6>Ultima Compra: '+str+' </h6>'+
'<h6>Monto:₡'+ Number(response[i]["total"],2).toLocaleString("en-US") +' </h6>'+

            '</div>'+
            '</div>'+                                    
            '</div>');    

   }


$( ".boton_ruta" ).click(function() {

var  dataName =  $(this).attr("caja");


$('#'+dataName+'').boxWidget('toggle')

});


                $('.my_box').boxWidget({
  animationSpeed: 500,
  collapseTrigger: '#my-collapse-button-trigger',
  removeTrigger: '#my-remove-button-trigger',
  collapseIcon: 'fa-minus',
  expandIcon: 'fa-plus',
  removeIcon: 'fa-times'
});  



         
              
                       
               }

               },
                error: function(response, err){ console.log('my message ' + err + " " + response );}
     })




var varfacturados = $('option:selected', '.nombre_rutas').val();
console.log("varfacturados", varfacturados);

$(".ruta_no_compra").val(varfacturados);

var data = new FormData();

data.append("varfacturados",varfacturados); 

$.ajax({
 
          url:"ajax/rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
           

         $(".facturados").css("display", "block");       
            $(".facturados").val(response[0]);

     

          },
           
                   error: function(response, err){ console.log('my message ' + err + " " + response );}

        })


var varno_compra = $('option:selected', '.nombre_rutas').val();




var data = new FormData();

data.append("varno_compra",varno_compra); 

$.ajax({
 
          url:"ajax/rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
            console.log("response", response);
           

           $(".no_compra").css("display", "block");
            $(".no_compra").val(response[0]);
 
     

          },
           
                   error: function(response, err){ console.log('my message ' + err + " " + response );}

        })



var pendientes_vicita = $('option:selected', '.nombre_rutas').attr("codigo");


var data = new FormData();

data.append("pendientes_vicita",pendientes_vicita); 

$.ajax({
 
          url:"ajax/rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
        

              $(".pendientes_vicita").css("display", "block");
            $(".pendientes_vicita").val(response[0]);

          },
           
                   error: function(response, err){ console.log('my message ' + err + " " + response );}

        })


});



// alert(calcCrow(59.3293371,13.4877472,59.3225525,13.4619422).toFixed(1));

/*=============================================
= CALCULAR LA DIFERENCIA ENTRE 2 DISTANCIAS =
=============================================*/


 function calcCrow(lat1, lon1, lat2, lon2) {
      
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;
}

    // Converts numeric degrees to radians
    function toRad(Value) {
      
      return Value * Math.PI / 180;

    }






var contador;
$(".boton_ruta").on("click", function() {


var lon2="";

var lat2="";

    if (navigator.geolocation) {
      
      navigator.geolocation.getCurrentPosition(
        (position) => {
           lat2 = position.coords.latitude ;  
           console.log("lat2", lat2);
       

            lon2 = position.coords.longitude;
            console.log("lon2", lon2);
             

var lat1 =  $(this).attr("latitud");
console.log("lat1", lat1);

var lon1 =  $(this).attr("longitud");
console.log("lon1", lon1);
console.log("lat2", lat2);

var diferencia = calcCrow(lat1, lon1, lat2, lon2);
console.log("diferencia", diferencia);


    if(diferencia > 0.2 || isNaN(diferencia)){

    $(".btn_nocompra").prop('disabled', "true");



var atts = $(this).attr("atts");

  if(atts==0){

swal({

                    type: "warning",
                    text: "Distancia entre la tienda y la ubicacion actual es mayor 200 m",   
                    title: "Error!",
                    confirmButtonText: "Cerrar",
                    showConfirmButton: true,    
                    closeOnConfirm: false
                  });

atts=1

  }else{



atts=0

}

   $(this).attr("atts", atts);


        }else{

    $(".btn_nocompra").removeAttr("disabled");

        }

      contador = $(this).attr("caja");

               },

        () => {

          handleLocationError(true, infoWindow, map.getCenter());
        }

      );

    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }


})


/*=============================================
= OBTENER ACCESO A UN BOTON QUE CARGA DESDE JS =
=============================================*/
var contador;
$(".rutas").on("click", "button.boton_ruta", function(){


var lon2="";

var lat2="";

    if (navigator.geolocation) {

      navigator.geolocation.getCurrentPosition(
        (position) => {
           lat2 = position.coords.latitude ;  
           console.log("lat2", lat2);
       

            lon2 = position.coords.longitude;
            console.log("lon2", lon2);
             

var lat1 =  $(this).attr("latitud");
console.log("lat1", lat1);

var lon1 =  $(this).attr("longitud");
console.log("lon1", lon1);
console.log("lat2", lat2);

var diferencia = calcCrow(lat1, lon1, lat2, lon2);
console.log("diferencia", diferencia);


    if(diferencia > 0.2 || isNaN(diferencia)){

    $(".btn_nocompra").prop('disabled', "true");

    if(contador == $(this).attr("caja")){


    }else{

    swal({

                    type: "warning",
                    text: "Distancia entre la tienda y la ubicacion actual es mayor 200 m",   
                    title: "Error!",
                    confirmButtonText: "Cerrar",
                    showConfirmButton: true,    
                    closeOnConfirm: false
                  });

    }

      

        }else{

    $(".btn_nocompra").removeAttr("disabled");

        }

      contador = $(this).attr("caja");

               },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }




})




  $(".btn_colapse").on('shown.bs.collapse', function(){
 


var lon2="";

var lat2="";

    if (navigator.geolocation) {
      
      navigator.geolocation.getCurrentPosition(
        (position) => {
           lat2 = position.coords.latitude ;  
           console.log("lat2", lat2);
       

            lon2 = position.coords.longitude;
            console.log("lon2", lon2);
             

var lat1 =  $(this).attr("latitud");
console.log("lat1", lat1);

var lon1 =  $(this).attr("longitud");
console.log("lon1", lon1);
console.log("lat2", lat2);

var diferencia = calcCrow(lat1, lon1, lat2, lon2);
console.log("diferencia", diferencia);


    if(diferencia > 0.2 || isNaN(diferencia)){

    $(".btn_nocompra").prop('disabled', "true");

    if(contador == $(this).attr("caja")){


    }else{

    swal({

                    type: "warning",
                    text: "Distancia entre la tienda y la ubicacion actual es mayor 200 m",   
                    title: "Error!",
                    confirmButtonText: "Cerrar",
                    showConfirmButton: true,    
                    closeOnConfirm: false
                  });

    }

      

        }else{

    $(".btn_nocompra").removeAttr("disabled");

        }

      contador = $(this).attr("caja");

               },

        () => {

          handleLocationError(true, infoWindow, map.getCenter());
        }

      );

    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }





  });
