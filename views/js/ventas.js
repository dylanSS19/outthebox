


$(".buscarcedulaventa").on('click',function() {

  var divsToHide = document.getElementsByClassName("datos-cliente-venta"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

      if( divsToHide[i].style.display== "none"){
    divsToHide[i].style.display = "block";

      }else{

           divsToHide[i].style.display = "none"; // depending on what you're doing
      }    
}}



});


