$ ( ".nombre_cliente" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});

$ ( ".banco_empresa" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});



 $(".nombre_cliente").change(function(){

 const var_cedula = $(this).val();

$(".monto_saldo").removeAttr("readonly");

 var data = new FormData();


data.append("var_cedula",var_cedula);  

$.ajax({

            url:"ajax/movimiento-saldos.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
          	// console.log("response", response);
var cont = 1;
 for (var i = 0; i < response.length; i++) {

    $(".bodegas_cliente").append(
'<div class="col-xs-12 col-lg-6">'+
'<label>&nbsp;&nbspLocal# '+ (i + 1) +'</label>'+
 '<div class="input-group mb-6 " style=" width: 100%;">'+
 '<div class="input-group-prepend">'+

            '<span style="font-size:15px;height: 100%" class="input-group-text"><i class="fas fa-bookmark"></i></span>'+

            '</div>'+

'<input type="text" style="font-size:20px;height: 35%" minlength="0" class="form-control bodega" id="bodega'+ (i + 1) +'" name="bodega'+ (i + 1) +'" value="'+ response[i][1] +'" id_bodega="'+ response[i][0] +'" posicion="'+ (i + 1) +'" required readonly>'+

 '</div>'  +               
  '</div>'+

'<br>'+

'<div class="col-xs-12 col-lg-6">'+
 '<div class="input-group mb-6 " style=" width: 100%;">'+
 '<div class="input-group-prepend">'+
            '<span style="font-size:15px;height: 100%" class="input-group-text"><i class="">₡</i></span>'+

            '</div>'+
'<input type="number" class="form-control monto_bodega" style="font-size:20px;height: 35%" minlength="0"  id="monto_bodega'+ (i + 1) +'" name="monto_bodega" id_bodega_monto="'+ (i + 1) +'" value="0" required readonly>'+


 '</div>'  +               
  '</div>'+
  '<br>');

}
         
 },
                error: function(response, err){ console.log('my message ' + err + " " + response );}
     })


 });


// .attr("id_bodega")

var monto_bodega = 0;
var monto_total = 0;
var total_montos_bodega =[];
var id_bodegas =[];
$(".bodegas_cliente").on("change", "input.monto_bodega", function() {


const monto_facturado = $("#monto_saldo").val();
const posicion = $(this).attr("id_bodega_monto");
const bodega = $("#bodega"+ posicion +"").attr("id_bodega");

var elements = document.querySelectorAll('input.monto_bodega');
Array.from(elements).forEach((element, index) => {

monto_bodega = Number($(this).val());


});

monto_total = Number(monto_total) + Number(monto_bodega);

if( monto_total > monto_facturado){


         Swal.fire(
      "Error!",
      "La suma de los montos no puede superar el monto de la factura",
      "error"
    ).then((result) => {

  // window.location = "clientes";
    }); 

$(this).val("0");

}else{

total_montos_bodega.push(monto_bodega);
id_bodegas.push(bodega);
$("#monto-saldo-bodega").val(total_montos_bodega);
$("#id-bodegas").val(id_bodegas);


}



  });



 $(".monto_saldo").change(function(){

  var elements = document.querySelectorAll('input.monto_bodega');
  Array.from(elements).forEach((element, index) => {

$(elements).removeAttr("readonly");

  });


});