

   $("#textobuscarservicio").keyup(function() {

if (!this.value) {
         	/*VACIO*/

    $('.servicio').each(function () { 

    sList =  $(this).attr("id");

         $("#"+sList+"").removeClass("d-none"); 
                 

});
 


	/*/VACIO*/
}else{

	/*NO VACIO*/

      var itemid ="";

   	var buscado = $("#textobuscarservicio").val();
          buscado= buscado.toLowerCase();

    	

    	  var listid = [];

             var sList = "";

$('.servicio').each(function () { 

    sList =  $(this).attr("id");


  if(sList.includes(buscado)){
    

         $("#"+sList+"").removeClass("d-none"); 


    }else{


    	   $("#"+sList+"").addClass("d-none"); 

                     

    	 

    }

  



});

	/*/NO VACIO*/

      }  


  });






/*buscar servicios*/


      $("#textobuscartiposervicio").keyup(function() {

      		var buscado = $("#textobuscartiposervicio").val();

      buscado= buscado.toLowerCase();

      	var listaremove = [];
      	var listaadd = [];

if (!this.value) {
         	/*VACIO*/
         	   var sList = "";

    $('.servicios').each(function () { 

    sList =  $(this).attr("id");

         $("#"+sList+"").removeClass("d-none"); 
                 

});

                 var sList = "";

    $('.tipo').each(function () { 

    sList =  $(this).attr("id");

         $("#"+sList+"").removeClass("d-none"); 
                 

});

        $('.collapse').each(function () { 

    sList =  $(this).attr("id");

         $("#"+sList+"").removeClass("d-none"); 
                 

});



	/*/VACIO*/
}else{

	/*NO VACIO*/

  

var classes = [];
var classessubtipo = [];
var classesservicios = [];

$('#accordion-services div').each(function() {


	  if($(this).attr('class').includes("tipo")){  

	  var tipo = $(this).attr('id');


$('#' +tipo+ ' div').each(function() {


	  if($(this).attr('class').includes("collapse")){ 

	  var subtipo = $(this).attr('id');
/*    console.log("subtipo", subtipo);
*/




$('#' +subtipo+ ' div').each(function() {


	  if($(this).attr('class').includes("servicios")){  

	  	var servicios = $(this).attr('id');
/*	  	console.log("servicios", servicios);

	  		  		console.log("buscado", buscado);*/


	  	if(servicios.includes(buscado)){


  	    classes.push(tipo);

	  	
	    classessubtipo.push(subtipo);

	    classesservicios.push(servicios);


		

}else{

    	   $("#"+servicios+"").addClass("d-none"); 
    	   $("#"+subtipo+"").addClass("d-none"); 
    	   $("#"+tipo+"").addClass("d-none"); 

/*    	   console.log("add class al " + "#"+servicios+"");
console.log("add class al " + "#"+subtipo+"");
console.log("add class al " + "#"+tipo+"");*/

    	 

}


}
});




}
});





	/*/NO VACIO*/

      }   
  });

/* console.log("classes", classes);

      
      console.log("classessubtipo", classessubtipo);

      console.log("classesservicios", classesservicios);
*/
for (i = 0; i < classes.length; i++) {

	 $("#"+classes[i]+"").removeClass("d-none");
	  		        
}

for (i = 0; i < classessubtipo.length; i++) {

	 $("#"+classessubtipo[i]+"").removeClass("d-none");
	  		       
};

for (i = 0; i < classesservicios.length; i++) {

	 $("#"+classesservicios[i]+"").removeClass("d-none");
	  		      
 
};



}

});



      $('.openmodal').on('click', function() {

        var nombre=$(this).attr("sub-tipo-nombre")

        var subtipo=$(this).attr("sub-tipo-id");

    $(".titulo-modal").text(nombre);


$( ".cargar-servicios" ).empty();
     var data = new FormData();

     data.append("subtipo",subtipo);

      $.ajax({

        url:"ajax/home.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        async: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
/*         console.log("response",response);
*/
            $(response).each(function (index, item) {


              $( ".cargar-servicios" ).append( '<div class="col-xs-6 servicio" id="'+ item.palabra_clave +'" >' +

    '<a id="">' +

'<div class="card text-center"> ' +

 ' <div class="card-body">' +

' '+ item.nombre+  ''+

'</div>' +

'</div>' +

'</a>  ' +

 '       </div>' );
                  

              
                });


                     
        },
           error: function(response, err){console.log('my message ' + err + " " + response + " " + subtipo );}



      });


             $('#modal-servicios').modal('show');



  
});

      $('#rd-menuxs').on('ifChecked', function(event){
/*        console.log("ifChecked");
*/
 $("#menuxs").removeClass("d-block d-md-none");

});

            $('#rd-menuxs').on('ifUnchecked', function(event){

/*                 console.log("ifUnChecked");
*/
               $("#menuxs").addClass("d-block d-md-none");

});



  




$(".empresaheader").change(function(){


var varempresa = $(this).val();
var nomempresa = $('select[name="empresaheader"] option:selected').text();
var varSubMod = $("option:selected", this).attr("subM");

console.log(varSubMod);
console.log(nomempresa);

  sessionStorage.setItem("empresa", varempresa);


 
 var data = new FormData();

    data.append("varempresa",varempresa);
    data.append("varnomEmpresa",nomempresa);
    data.append("varSubMod",varSubMod);
  

     $.ajax({
            url:"ajax/home.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             /*dataType: "json",*/

            success: function(response){
                console.log("response", response);

var split = response.split(' ');
// console.log("split", split);
 
var tabla_tiendas = split[0];
var tabla_dth = split[1];
var Idmpresa = split[2];


//console.log("Idmpresa", Idmpresa);
            sessionStorage.setItem("tabla_tiendas", tabla_tiendas.replace(/['"]+/g, ''));
            sessionStorage.setItem("tabla_dth", tabla_dth.replace(/['"]+/g, ''));

                 var nombre =sessionStorage.getItem('tabla_tiendas');
     var name="tabla_tiendas";
     document.cookie= name + "=" + nombre;
      
          
          document.cookie = "cookie_empresa="+Idmpresa;

     var nombredth =sessionStorage.getItem('tabla_dth');
     var namedth="tabla_dth";
     document.cookie= namedth + "=" + nombredth;
     
          window.location="home";


            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})




});

$(".badgeperfil").on('click',function() {
  console.log("badgeperfil");

  $('#modal-perfil').modal('show');


});
