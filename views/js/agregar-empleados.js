$("#cedula-agregar-cliente").change(function () {


  var varempleado = $(this).val(); 
  console.log("varempleado", varempleado);

  var data = new FormData();

  data.append("varempleado", varempleado);

  $.ajax({
    url: "ajax/agregar-empleados.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",

    success: function (response) {
      //console.log("response", response);

      if (!response == "") {
        Swal.fire(
          "Cédula duplicada!",
          "¡La cédula ya existe en la Base de Datos!",
          "error"
        ).then((result) => {

          $("#cedula-agregar-cliente").val("");
        })

      }




    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response);
    }
  })





});




$(function () {
  $('.datetimepicker').datetimepicker({
    format: 'L'
  });
});



$("#departamento-agregar-cliente").change(function () {



  var combo = document.getElementById("departamento-agregar-cliente");
  var varDepartamento = combo.options[combo.selectedIndex].value;
  console.log("varDepartamento", varDepartamento);



  var data = new FormData();

  data.append("varDepartamento", varDepartamento);

  $.ajax({
    url: "ajax/agregar-empleados.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",

    success: function (response) {
      console.log("response", response);
      $("#puesto-agregar-cliente").empty();
      $("#puesto-agregar-cliente").append('<option disabled selected value="">Seleccionar Puesto...</option>');
      for (var i = 0; i < response.length; i++) {
        $("#puesto-agregar-cliente").append('<option value="' + response[i]["idtbl_puestos"] + '">' + response[i]["nombre"] + '</option>');

      }

    },

  })

})
$("#cuenta-agregar-cliente").change(function () {

  var varcuenta = $(this).val();


  if (varcuenta.length !== 22) {

    Swal.fire(
      "Cuenta no tiene longitud correcta!",
      " ",
      "error"
    )

  } else {


    var strFirstTwo = varcuenta.substring(0, 2);
    if (strFirstTwo !== "CR") {

      Swal.fire(
        "Cuenta debe de empezar con 'CR'!",
        " ",
        "error"
      )


    } else {
      var strLastTwentiTwo = varcuenta.substring(2, 22);
      //console.log("strLastTwentiTwo", strLastTwentiTwo);

      if (onlyDigits(strLastTwentiTwo)) {

      } else {


        Swal.fire(
          "Despues del 'CR' solo deben ser números!",
          " ",
          "error"
        )


      }

    }

  }



})



function onlyDigits(s) {
  for (let i = s.length - 1; i >= 0; i--) {
    const d = s.charCodeAt(i);
    if (d < 48 || d > 57) return false
  }
  return true
}


$("#correo-agregar-cliente").change(function () {

  /*var varcuenta= $(this).val();*/

  var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
  if (!re) {
    Swal.fire(
      "Correo no tiene formato correcto!",
      " ",
      "error"
    )
  } else {

  }


});

/**
 * Cargar texto de los selects
 */
$('#departamento-agregar-cliente').change(function () {
  
  $("#departamento").val($("option:selected", $(this)).text().trim());

});

$('#puesto-agregar-cliente').change(function () {
  
  $("#puesto").val($("option:selected", $(this)).text().trim());

});


$(document).ready(function(){
  $("#form-agregar-personal").on("submit", function(){
    $("#overlay2").fadeIn();
  });//submit
});//document ready