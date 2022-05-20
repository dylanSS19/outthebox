$("#email").change(function() {
    let email = $("#email").val();

    var data = new FormData();
    data.append("emailV",email);

    $.ajax({
        url:"ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
          dataType: "json",

        success: function(response){
            console.log(response);
            if (!response) {

            } else {
                Swal.fire(
                    "¡Atención!",
                    "¡Este correo ya existe en nuestra Base de Datos!",
                    "warning"
                ).then((result) => {
                    $("#email").val("");
                });
            }
        },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
    });
});


$("#password").change(function () {
    let password = $("#password").val();
    if (password.length < 6) {
        Swal.fire(
            "¡Atención!",
            "¡La contraseña debe contener al menos 6 caracteres!",
            "warning"
        ).then((result) => {

        });
    }
});

$('#imgUsuario').change( function() {
    $('#imgUsuario-label').text('Archivo: ' + $(this).val());
})











  

   
