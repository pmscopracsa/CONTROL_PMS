$(document).ready(function(){
   function cargar_tipodireccion() 
   {
       $.get("../../bl/Contacto/cargarTipoDireccion.php",function(resultado){
           $("#tipodireccionid").append(resultado);
       })
   }
});