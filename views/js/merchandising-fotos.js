// $("#fotoDisplay").change(function(){

// let idDiv = $("#fotoDisplay").attr("idDiv");

// console.log(idDiv);

//     var image = this.files[0];
//     //console.log("image", image);
  
//   /*=============================================
//   =    FILTER FORMAT PICTURE ONLY PNG - JPG     =
//   =============================================*/
  
//   if(image["type"] != "image/jpeg" && image["type"] != "image/png"){
  
//     $(".fotoDisplay").val("");
  
//     swal({
  
//           type: "error",
//           text: "La imagen debe estar en formato JPG o PNG",
//           title: "¡Error al subir la imagen!",
//           confirmButtonText: "Cerrar"
  
//         }); 
  
//   } else if(image["size"] > 4000000){
  
//     $(".fotoDisplay").val("");
  
//     swal({
  
//           type: "error",
//           text: "La imagen no debe pesar más de 4MB",
//           title: "¡Error al subir la imagen!",
//           confirmButtonText: "Cerrar"
  
//         }); 
//   } else {
  
//     var ImageData = new FileReader;
  
//     ImageData.readAsDataURL(image);
  
//     $(ImageData).on("load", function(event){
   
//       var ImageRoute = event.target.result;
  
//       $("#fotoDisplay_vista").attr("src",ImageRoute);
  
      
  
//     })
  
//   }
  
//   agregardivsFotos ();
// //   $(this).parent().parent().after('<div class="col-lg-12 ">' +
// //   '<div class="col-xs-12 col-lg-4">'+
// //           '<div class="input-group mb-6 mt-2" style=" width: 100%;">'+
// //           '<img src="views/img/users/default/anonymous.png" class="img-thumbnail" width = "400px" '+
// //              ' id="fotoDisplay_vista" idDiv="'+(idDiv + 1)+'"  width="100px">'+
// //           '<input type="file" class="fotoDisplay" idDiv="'+(idDiv + 1)+'" id="fotoDisplay" '+
// //              ' name="fotoDisplay">'+
// //           '<p class="help-block">Peso máximo de la foto 4MB</p>'+
// //       '</div>'+
// //   '</div>' +                   
// // '</div>');


//   });


// function agregardivsFotos (){

//     let idDiv = 1;

//     $(".contFotos").append(
//     '<div class="col-xs-12 col-lg-6">'+
//             '<div class="input-group mb-6 mt-2" style=" width: 100%;">'+
//             '<img src="views/img/users/default/anonymous.png" class="img-thumbnail" width = "400px" '+
//                ' id="fotoDisplay_vista" idDiv="'+(idDiv + 1)+'"  width="100px">'+
//             '<input type="file" class="fotoDisplay" idDiv="'+(idDiv + 1)+'" id="fotoDisplay" '+
//                ' name="fotoDisplay">'+
//             '<p class="help-block">Peso máximo de la foto 4MB</p>'+
//         '</div>'+
//     '</div>');

// }


var lista = [];

(function () {

	var file = document.getElementById('file');
	var preload = document.querySelector('.preload');
	var publish = document.getElementById('btnGuardarClienteMerc');
	var formData = new FormData();
    
	file.addEventListener('change', function (e) {

		for ( var i = 0; i < file.files.length; i++ ) {
			var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();
			createThumbnail(file, i, thumbnail_id);
			// formData.append("fotosAnaquel", file.files[i]);
            lista.push({"fotosAnaquel": file.files[i],
        "ramdon": thumbnail_id})

		}

		e.target.value = '';

	});

	publish.addEventListener('click', function (e) {
		e.preventDefault();
		// preload.classList.add('activate-preload');
console.log(lista);


for ( var i = 0; i < lista.length; i++ ) {

    formData.append("fotosAnaquel", lista[i]["fotosAnaquel"]);

    $.ajax({
 
        url:"ajax/merchandising-fotos.ajax.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        // dataType: "json",  
        success: function(response){
    
        console.log(response);
    
    
        },
          
      })

}


		
	});

	var createThumbnail = function (file, iterator, thumbnail_id) {
		var thumbnail = document.createElement('div');
		thumbnail.classList.add('thumbnail', thumbnail_id);
		thumbnail.dataset.id = thumbnail_id;

		thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);
		document.getElementById('preview-images').appendChild(thumbnail);
		createCloseButton(thumbnail_id);
	}

	var createCloseButton = function (thumbnail_id) {
		var closeButton = document.createElement('div');
		closeButton.classList.add('close-button');
		closeButton.innerText = 'X';
		document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
	}

	var clearFormDataAndThumbnails = function () {
		for ( var key of formData.keys() ) {
			formData.delete(key);
		}

		document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
			thumbnail.remove();
		});
	}

	document.body.addEventListener('click', function (e) {
		if ( e.target.classList.contains('close-button') ) {
			e.target.parentNode.remove();
			formData.delete(e.target.parentNode.dataset.id);
		}
	});

})();



// fetch('ajax/merchandising-fotos.ajax.php', {
//     method: 'POST',
//     body: formData
// })
// .then(function (response) {

//     console.log(response);
//     return response.json();

// })
// .then(function (data) {
//     preload.classList.remove('activate-preload');
//     clearFormDataAndThumbnails();
//     document.getElementById('success').innerText = data.message;
// })
// .catch(function (err) {
//     console.log(err);
// });

