 $("#valid_contrasena").keyup(function() {
 
     if ($(this).val() == $("#contrasena").val()) {

         var intro = document.getElementById('valid_contrasena');
         intro.style.borderColor = 'green';

         $(".span_contrasena").removeClass("fas fa-lock");
         $(".span_contrasena").addClass("fas fa-lock-open");
         $(".span_confirmacion_contrasena").removeClass("fas fa-lock");
         $(".span_confirmacion_contrasena").addClass("fas fa-lock-open");

     } else {

         var intro = document.getElementById('valid_contrasena');
         intro.style.borderColor = 'red';

         $(".span_contrasena").removeClass("fas fa-lock-open");
         $(".span_contrasena").addClass("fas fa-lock");
         $(".span_confirmacion_contrasena").removeClass("fas fa-lock-open");
         $(".span_confirmacion_contrasena").addClass("fas fa-lock");

     }


 });



 $("#contrasena").keyup(function() {


     if ($(this).val() == $("#valid_contrasena").val()) {

         var contrasena = document.getElementById('valid_contrasena');
         contrasena.style.borderColor = 'green';

         $(".span_contrasena").removeClass("fas fa-lock");
         $(".span_contrasena").addClass("fas fa-lock-open");
         $(".span_confirmacion_contrasena").removeClass("fas fa-lock");
         $(".span_confirmacion_contrasena").addClass("fas fa-lock-open");



     } else {

         var contrasena = document.getElementById('valid_contrasena');
         contrasena.style.borderColor = 'red';

         $(".span_contrasena").removeClass("fas fa-lock-open");
         $(".span_contrasena").addClass("fas fa-lock");
         $(".span_confirmacion_contrasena").removeClass("fas fa-lock-open");
         $(".span_confirmacion_contrasena").addClass("fas fa-lock");

     }



 });


 $("#cod_validacion").change(function() {


     var data = new FormData();

     data.append("codigo_validacion", $(this).val());
     data.append("user_validacion", $(".user_cambio").val());
     $.ajax({

         url: "ajax/recuperar-contrasena-frm2.ajax.php",
         method: "POST",
         data: data,
         cache: false,
         contentType: false,
         processData: false,
         dataType: "json",

         success: function(response) {


             $(".mensaje_error").empty();

             if (response == "false" || response == false) {

                 var codigo = document.getElementById('cod_validacion');
                 codigo.style.borderColor = 'red';

                 $(".span_codigo").removeClass("fas fa-lock-open");
                 $(".span_codigo").addClass("fas fa-lock");

                 $(".mensaje_error").append('<div class="col-xs-12 col-lg-12 alert alert-danger" role="alert">El código ingresado no es correcto.</div>');

             } else {


                 var codigo = document.getElementById('cod_validacion');
                 codigo.style.borderColor = 'green';

                 $(".contrasena").removeAttr("readonly");

                 $(".valid_contrasena").removeAttr("readonly");

                 $(".span_codigo").removeClass("fas fa-lock");
                 $(".span_codigo").addClass("fas fa-lock-open");

                 $(".btn_recuperar_contrasena").removeAttr("disabled");



             }



         },

         error: function(response, err) { console.log('my message ' + err + " " + response); }
     })


 });


 $(".revelar_contrasena1").click(function() {
     var element = document.getElementById("lockbtn1");
     var $pwd = $(".contrasena");
     if ($pwd.attr('type') === 'password') {
         $pwd.attr('type', 'text');

         element.classList.remove("fa-eye");
         element.classList.add("fa-lock");

     } else {
         $pwd.attr('type', 'password');
         element.classList.remove("fa-lock");
         element.classList.add("fa-eye");

     }
 });



 $(".revelar_contrasena2").click(function() {
     var element = document.getElementById("lockbtn2");
     var $pwd = $(".valid_contrasena");
     if ($pwd.attr('type') === 'password') {
         $pwd.attr('type', 'text');

         element.classList.remove("fa-eye");
         element.classList.add("fa-lock");

     } else {
         $pwd.attr('type', 'password');
         element.classList.remove("fa-lock");
         element.classList.add("fa-eye");

     }
 });






 $(".btn_recuperar_contrasena").click(function() {


     var data = new FormData();

     data.append("codigo_modificar", $(".cod_validacion").val());
     data.append("contrasena_modificar", $(".contrasena").val());
     console.log("contrasena", $(".contrasena").val());


        $.ajax({

             url:"ajax/recuperar-contrasena-frm2.ajax.php",
             method: "POST",
             data: data,
             cache: false,
             contentType: false,
             processData: false,
             dataType: "json",  

             success: function(response){

                 if(response == "OK"){

                   Swal.fire(
                   "Correcto!",
                   "La contrasena se modifico correctamente.",
                   "success"
                 ).then((result) => {
                window.location = "login";
                 });

                         }else{

             Swal.fire(
                   "Error!",
                   "Error al actualizar los datos, intente nuevamente.",
                   "error"
                 ).then((result) => {
                //window.location = "login";
                 });

            }

     },

              error: function(response, err){ console.log('my message ' + err + " " + response);}
        })





 });





 // const inputs = document.querySelectorAll('.mostrar');

 // inputs.forEach((input) => {

 // input.addEventListener('blur',mostrar_contrasena);


 // });

 // const mostrar_contrasena = (e) => {

 // console.log("(e.target.name", (e.target.type));
 // switch(e.target.name){

 // case "contrasena":

 // if(e.target.type == "password"){


 // console.log(e.val())

 // }else{




 // }


 // break;


 // case "valid_contrasena":


 // console.log("precionado2");


 // break;


 // }


 // }