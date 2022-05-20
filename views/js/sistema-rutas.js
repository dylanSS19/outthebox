$("#frmRutasRuta").change(function () {
  let ruta = $("#frmRutasRuta").val();
  let diaVisita = $("option:selected","#frmRutasDias").val();

  CargarDivsClientes(ruta, diaVisita);
});

$("#frmRutasDias").change(function () {

    let ruta = $("option:selected","#frmRutasRuta").val();
    let diaVisita = $("option:selected","#frmRutasDias").val();

  CargarDivsClientes(ruta, diaVisita);
});


let RolUsuarioSesion =  sessionStorage.getItem('rol');
let idUsuarioSesion =  sessionStorage.getItem('id');
if(RolUsuarioSesion == "Administrador"){


}else{

  let fecha = new Date();
  let diasSemana = new Array("D","L","k","M","J","V","S");
  let diaLetras = diasSemana[fecha.getDay()]; 

  let ruta = cargarRuta(idUsuarioSesion);
  ruta = ruta[0]["IDruta"];
  let diaVisita = diaLetras;

console.log("hola",ruta);

  CargarDivsClientes(ruta, diaVisita);
}



function CargarDivsClientes(ruta, diaVisita) {

  $(".addclientes").empty();
  var data = new FormData();
  data.append("idRuta", ruta);
  data.append("diaVis", diaVisita);

  $.ajax({
    url: "ajax/sistema-rutas.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {
      // console.log("response", response);

for(var i = 0; i < response.length; i++){

  $(".addclientes").append(
    '<div class="col-sm-12 col-lg-12">' +
      '<div class="card card-secondary  shadow-sm collapsed-card">' +
      '<div class="card-header">' +
      '<h3 class="card-title">'+response[i].Nombre+'</h3>' +
      '<div class="card-tools">' +
      '<button type="button" class="btn btn-tool" data-card-widget="collapse">' +
      '<i class="fas fa-minus"></i>' +
      "</button>" +
      "</div>" +
      "</div>" +
      '<div class="card-body">' +
      '<div class="row">' +
      '<div class="col-xs-12 col-lg-6">' +
      '<div class="input-group mb-6" style=" width: 100%;">' +
      '<div class="input-group-prepend ">' +
      '<span style="font-size:15px;" class="input-group-text"><i ' +
      'class="fas fa-user"></i></span>' +
      "</div>" +
      '<input type="text" style="font-size:100%;" class="form-control"' +
      ' id="frmRutaNombreCli'+response[i].idtbl_empresas_clientes+'" name="frmRutaNombreCli" ' +
      'autocomplete="off" value="'+response[i].Nombre+'" idDiv="'+response[i].idtbl_empresas_clientes+'" long="'+response[i].longitud+'" lat="'+response[i].latitud+'" required placeholder="Nombre" readonly>' +
      "</div>" +
      "<br>" +
      "</div>" +
      '<div class="col-xs-12 col-lg-6">' +
      '<div class="input-group mb-6" style=" width: 100%;">' +
      '<div class="input-group-prepend ">' +
      '<span style="font-size:15px;" class="input-group-text"><i ' +
      ' class="far fa-address-card"></i></span>' +
      "</div>" +
      '<input type="text" style="font-size:100%;" class="form-control"' +
      'id="frmRutaCedCli'+response[i].idtbl_empresas_clientes+'" name="frmRutaCedCli"' +
      '   autocomplete="off" value="'+response[i].cedula+'" idDiv="'+response[i].idtbl_empresas_clientes+'" required placeholder="Cédula" readonly>' +
      " </div>" +
      "<br>" +
      "</div>" +
      '<div class="col-12 col-sm-12 col-md-4 col-lg-4">' +
      '<div class="input-group mb-2" style=" width: 100%;">' +
      '<div class="btn-group">' +
      '<button class="btn btn-outline-primary btnRutPedido" idDiv= "'+response[i].idtbl_empresas_clientes+'" id="btnRutPedido'+response[i].idtbl_empresas_clientes+'">Realizar Pedido</button>' +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="col-12 col-sm-12 col-md-4 col-lg-4">' +
      '<div class="input-group mb-2" style=" width: 100%;">' +
      '<div class="btn-group">' +
      '<button class="btn btn-outline-primary btnRutUbicacion" idDiv="'+response[i].idtbl_empresas_clientes+'" id="btnRutUbicacion'+response[i].idtbl_empresas_clientes+'">Ubicación</button>' +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="col-12 col-sm-12 col-md-4 col-lg-4 ">' +
      '<div class="input-group mb-2" style=" width: 100%;">' +
      '<div class="btn-group">' +
      '<button class="btn btn-outline-danger btnRutNoCompra" idDiv= "'+response[i].idtbl_empresas_clientes+'" id="btnRutNoCompra'+response[i].idtbl_empresas_clientes+'">No Compra</button>' +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>");

}
   
    },
        
  error: function(response, err){ console.log('my message ' + err + " " + response );}

  })
}


function cargarRuta(idusuario){

let Ruta = [];

    var data = new FormData();
    data.append("idusuario", idusuario);

    $.ajax({
      url: "ajax/sistema-rutas.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",
      success: function (response) {
        
        Ruta.push({"IDruta": response[0].idtbl_rutas,
      "valCoordenadas": response[0].valida_coordenadas });

      

  },
            
error: function(response, err){ console.log('my message ' + err + " " + response );}

})


return Ruta;

}
 

$(".addclientes").on("click", "button.btnRutUbicacion", function(){

// $(".btnRutUbicacion").click(function() {
  
let idDiv = $(this).attr("idDiv");
let long = $("#frmRutaNombreCli"+idDiv).attr("long");
let lat = $("#frmRutaNombreCli"+idDiv).attr("lat");
  
  var a = document.createElement('A');
  var filePath = "https://www.google.com/maps/search/?api=1&query="+lat+","+ long;
  
  a.href = filePath;
  a.target = "_blank";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);

});


$(".addclientes").on("click", "button.btnRutPedido", function(){
// $(".btnRutPedido").click(function() {


  let idDiv = $(this).attr("idDiv");
  var a = document.createElement('A');
  var filePath = "index.php?route=sistema-facturas-crearFactura&idClient="+idDiv;
  
  a.href = filePath;
  // a.target = "_blank";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);

});

$(".addclientes").on("click", "button.btnRutNoCompra", function(){
// $(".btnRutNoCompra").click(function() {

let ruta;
let cliente = $(this).attr("idDiv");
let longitud = $("#frmRutaNombreCli"+cliente).attr("long");
let latitud = $("#frmRutaNombreCli"+cliente).attr("lat");
let validaCoord = "";
let rutaN ;

if(RolUsuarioSesion == "Administrador"){

  rutaN = $("option:selected","#frmRutasRuta").val();
  validaCoord = $("option:selected","#frmRutasRuta").attr("Valcoord");
}else{

  ruta = cargarRuta(idUsuarioSesion);
   rutaN = ruta[0]["IDruta"];
  validaCoord = ruta[0]["valCoordenadas"]; 
}

console.log(rutaN);
console.log(validaCoord);
  Swal.fire({
    title: 'Agregar Comentario No Compra',
    input: 'textarea',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Guardar',
    showLoaderOnConfirm: true,
    preConfirm: (comentario) => {
     
     
      // AgregarNocompra(comentario, ruta, cliente, longitud, latitud);
      ValidarCoordenadas(latitud,longitud, validaCoord, comentario, rutaN, cliente);

    },
    allowOutsideClick: () => !Swal.isLoading()
  })


});


function ValidarCoordenadas(latitud,longitud, validaCoord, comentario, rutaN, cliente){

      var diferencia = "";
      var lati2 = "";
      var long2 = "";

      console.log(validaCoord);

    

      if (navigator.geolocation) {
    
        navigator.geolocation.getCurrentPosition(
          (position) => {
             lati2 = position.coords.latitude ;  
             console.log("lat2", lati2);
         
              long2 = position.coords.longitude;
              console.log("lon2", long2);
               
              if(validaCoord == "Si"){

                diferencia = calcCrowDiferenciaRuta(latitud, longitud, lati2, long2);
                console.log(diferencia);
                      
                       if(diferencia > 0.2 || isNaN(diferencia)){
                                
                                Swal.fire(
                                  "Aviso",
                                  "Distancia entre punto inical y la ubicacion actual es mayor 200 m",
                                  "warning"
                                ).then((result) => {
                                                                   
                                }) 

                
                       }else{
       
                        AgregarNocompra(comentario, rutaN, cliente, long2, lati2)
                
                       }
                
            }else{


              AgregarNocompra(comentario, rutaN, cliente, long2, lati2)


            }

  
    
                 },
    
          () => {
    
            handleLocationError(true, infoWindow, map.getCenter());
          }
    
        );
    
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }


}

function calcCrowDiferenciaRuta(lat1, lon1, lat2, lon2) {
      
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


function AgregarNocompra(comentario, ruta, cliente, longitud, latitud){

  var data = new FormData();

  data.append("comentario", comentario);
  data.append("ruta", ruta); 
  data.append("cliente", cliente); 
  data.append("longitud", longitud); 
  data.append("latitud", latitud); 

      $.ajax({
  
          url:"ajax/sistema-rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          // dataType: "json",  
          success: function(response){
  
          console.log(response);
     
          },
              
          error: function(response, err){ console.log('my message ' + err + " " + response );}
      
          })



}