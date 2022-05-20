$(document).ready(function(){
  $("#form-ad-personal").on("submit", function(){
    $("#overlay2").fadeIn();
  });//submit
});//document ready
 
var salario_base=0;
var resultado2=0;  
var resultado_final =0;
$(".empleados_ad_personal").change(function(){


var varempleado= $(this).val();
var nomempleado = $('select[name="empleados_ad_personal"] option:selected').text().trim();
 
 var data = new FormData();

    data.append("varempleado",varempleado);
    
     $.ajax({
            url:"ajax/ad-personal.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
              dataType: "json",

            success: function(response){
                //console.log("response", response);

                 salario_base=response[0]; 

                n = parseFloat(salario_base).toFixed(2);

                var withCommas = Number(n).toLocaleString('en');   


           $("#salario_base_mensual").val("₡" +" "+(withCommas).toLocaleString());



            var salario_base_quincenal = salario_base / 2;

              n = parseFloat(salario_base_quincenal).toFixed(2);

                var withCommas = Number(n).toLocaleString('en');   
            $("#salario_base_quincenal").val("₡" +" "+(withCommas).toLocaleString());



            var salario_hora = salario_base / 30 / 8;


            n = parseFloat(salario_hora).toFixed(2);

                var withCommas = Number(n).toLocaleString('en'); 
          $("#salario_base_hora").val("₡" +" "+(withCommas).toLocaleString());


 
            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})





});


$(".conceptos_ad_personal").change(function(){

    if(salario_base==0){

     Swal.fire(
      "Favor seleccione un empleado!",
      " ",
            "error"
    )


    }else{

var varconcepto= $(this).val();

//console.log("varconcepto", varconcepto);
 
 var data = new FormData();

    data.append("varconcepto",varconcepto);
    
     $.ajax({
            url:"ajax/ad-personal.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             dataType: "json",

            success: function(response){
                //console.log("response", response);

                var variable=response["variable"];

                var codigo=response["codigo"];
$("#codigo_concepto_ad_personal").val(codigo);


                if(variable=="Horas"){

               $("#horas_extras_ad_personal").prop("readonly",false);
               $("#dias_ad_personal").prop("readonly",true);
               $("#monto_ad_personal").prop("readonly",true);

                 $("#horas_extras_ad_personal").val(1);
               $("#dias_ad_personal").val(0);
               $("#monto_ad_personal").val(0);
                $("#rango_fecha_ad_personal").css("pointer-events","none");
               $("#rango_fecha_ad_personal").css("cursor","default");



                 }else if (variable=="Dias"){

               $("#horas_extras_ad_personal").prop("readonly",true);
               $("#dias_ad_personal").prop("readonly",false);
               $("#monto_ad_personal").prop("readonly",true);
                     $("#horas_extras_ad_personal").val(0);
               $("#dias_ad_personal").val(1);
               $("#monto_ad_personal").val(0);

               $("#rango_fecha_ad_personal").css("pointer-events","");
               $("#rango_fecha_ad_personal").css("cursor","");
                }else if (variable=="Monto"){


                     $("#horas_extras_ad_personal").prop("readonly",true);
                     $("#dias_ad_personal").prop("readonly",true);
                     $("#monto_ad_personal").prop("readonly",false);
                           $("#horas_extras_ad_personal").val(0);
               $("#dias_ad_personal").val(0);
               $("#monto_ad_personal").val(0);
$("#rango_fecha_ad_personal").css("pointer-events","none");
               $("#rango_fecha_ad_personal").css("cursor","default");

                }

                var formula=response["formula"].trim();
                //console.log("formula", formula);
                 resultado2=0;                
                resultado2 = formula.replace("base", salario_base);
                //console.log("resultado2", resultado2);

           var valor1 = "";
           var valor2 = "";
           var valor3 = "";
           var valor4 = "";
           var valor5 = "";
           var valor6 = "";
           var valor7 = "";
           var valor8 = "";
           var valor9 = "";
           var operador = "";
           var cont  = 0;
            var answer = "";
            answer = resultado2.substring(0, 1);
            //console.log("answer", answer);
            if(answer== " "){
                //resultado2 = resultado2.Remove(0, 1)
            }
                              
           
            var strArr = resultado2.split(' '); 
            //console.log("strArr", strArr.length);
//strArr = strArr.reverse();
for (var count = 0; count < strArr.length; count++){
    //console.log("strArr[count]",strArr[count]);

           if(strArr[count] == "*"){
                    operador = "*";
                    cont += 1;
               }else if(strArr[count] == "+"){
                    operador = "+";
                    cont += 1;
                }else if (strArr[count] == "-"){
                    operador = "-";
                    cont += 1;
                }else if (strArr[count] == "/"){
                    operador = "/"
                    cont += 1
                }else{
                    if (valor1 == ""){
                        valor1 = strArr[count];
                        cont += 1;
                    }else if (valor2 == ""){
                        cont += 1;
                        valor2 = strArr[count];
                    }else if (valor3 == ""){
                        cont += 1;
                        valor3 = strArr[count];
                    }else if (valor4 == ""){
                        valor4 = strArr[count];
                        cont += 1;
                    }else if (valor5 == ""){
                        cont += 1;
                        valor5 = strArr[count];
                    }else if (valor6 == ""){
                        cont += 1;
                        valor6 = strArr[count];
                    }else if (valor7 == ""){
                        cont += 1;
                        valor7 = strArr[count];
                    }else if (valor8 == ""){
                        cont += 1;
                        valor8 = strArr[count];
                    }else if (valor9 == ""){
                        cont += 1;
                        valor9 = strArr[count];
                    }

                }


                if(cont == 1){
                    resultado_2 = valor1;
                }else if (cont == 2){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/")
                        resultado_2 = resultado_2 / 1;
                    }else if (cont == 3){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor2;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor2;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor2;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor2;}
                    
                }else if (cont == 4){
                    if (operador == "*"){
                        resultado_2 == resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 == resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 5){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor3;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor3;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor3;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor3;}
                    
                }else if (cont == 6){
                    if(operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 7){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor4;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor4;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor4;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor4;
                    }
                }else if (cont == 8){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 9){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor5;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor5;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor5;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor5;
                    }
                }else if (cont == 10){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 11){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor6;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor6;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor6;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor6;
                    }
                }else if (cont == 12){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 13){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor7;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor7;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor7;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor7;
                    }
                }else if (cont == 14){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 15){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor8;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor8;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor8;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor8;
                    }
                }else if (cont == 16){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * 1;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + 0;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - 0;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / 1;
                    }
                }else if (cont == 17){
                    if (operador == "*"){
                        resultado_2 = resultado_2 * valor9;
                    }else if (operador == "+"){
                        resultado_2 = resultado_2 + valor9;
                    }else if (operador == "-"){
                        resultado_2 = resultado_2 - valor9;
                    }else if (operador == "/"){
                        resultado_2 = resultado_2 / valor9;
                    }

                }
    





}


  

//console.log("resultado_2", resultado_2);


         $("#resultado_final").val(resultado_2);  

   
              resultado_2 = parseFloat(resultado_2).toFixed(2);

                var withCommas = Number(resultado_2).toLocaleString('en'); 
                //console.log("withCommas", withCommas);

           $("#monto_ad_personal").val("₡" +" "+(withCommas).toLocaleString());






            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})



    };








});


    /*=============================================
MODIFICACION HORAS AD PERSONAL
=============================================*/

$("#horas_extras_ad_personal").change(function(){

var horas =$("#horas_extras_ad_personal").val();
   resultado_final = resultado_2 * horas;
   $("#resultado_final").val(resultado_final);  
  var withCommas = Number(resultado_final).toLocaleString('en'); 

  $("#monto_ad_personal").val("₡" +" "+(withCommas).toLocaleString());

});


    /*=============================================
MODIFICACION DIAS AD PERSONAL
=============================================*/

$("#dias_ad_personal").change(function(){

var dias =$("#dias_ad_personal").val();
   resultado_final = resultado_2 * dias;
    $("#resultado_final").val(resultado_final);  
  var withCommas = Number(resultado_final).toLocaleString('en'); 

  $("#monto_ad_personal").val("₡" +" "+(withCommas).toLocaleString());

});


    /*=============================================
MODIFICACION MONTO TOTAL AD PERSONAL
=============================================*/

$("#monto_ad_personal").change(function(){

var dias =$("#monto_ad_personal").val();
   resultado_final = resultado_2 * dias;
    $("#resultado_final").val(resultado_final);  
  var withCommas = Number(resultado_final).toLocaleString('en'); 

  $("#monto_ad_personal").val("₡" +" "+(withCommas).toLocaleString());

});

    /*=============================================
SELECCION FECHAS DE NOMINA
=============================================*/

$("#nomina_ad_personal").change(function(){

var idnomina =$("#nomina_ad_personal").val();


 var data = new FormData();

    data.append("idnomina",idnomina);
    
     $.ajax({
            url:"ajax/ad-personal.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
              dataType: "json",

            success: function(response){
                console.log("response", response);

             
           $("#rango_fecha_ad_personal_desde").val(response[0]);

          
            $("#rango_fecha_ad_personal_hasta").val(response[1]);

 
            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})









});




    /*=============================================
RANGO DE FECHAS
=============================================*/

$(function(){
  $("#rango_fecha_ad_personal").daterangepicker({
    opens: 'left'
  }, function(start, end, label){

    $("#rango_fecha_ad_personal_desde").val(start.format('YYYY-MM-DD'));
    $("#rango_fecha_ad_personal_hasta").val(end.format('YYYY-MM-DD'));
  });
});



$(".numbers-only").keypress(function (e) {
    if(e.which == 46){
        if($(this).val().indexOf('.') != -1) {
            return false;
        }
    }

    if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});


$('#empleados_ad_personal').change(function () {

    $("#nomEmpleado").val($("option:selected", $(this)).text().trim());
    
    var cedEmpleado = $("option:selected", $(this)).val().trim();
  
    var data = new FormData();
  
      data.append("cedEmpleado",cedEmpleado);
    
       $.ajax({
              url:"ajax/ad-personal.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",
  
              success: function(response){
                console.log("response", response);
                $("#correoEmpleado").val(response[0][0]);
  
              },
  
      })
    
  });
  
  $('#conceptos_ad_personal').change(function () {
  
    $("#concepto").val($("option:selected", $(this)).text().trim());
  
  });

  $('#nomina_ad_personal').change(function () {
  
    $("#nominaTxt").val($("option:selected", $(this)).text().trim());
  
  });

  