<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDICION DE LISTA DE DISTRIBUCION</title>
        <!-- CSS ZONE -->
        <link href="../../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script> 
        <script src="../../../js/cargarDatos.js" type="text/javascript"></script>
        <script>
        $(document).ready(function(){
            // variable global que almacena el id de la lista
            var idListaDistribucion;
            /** AUTOCOMPLETAR POR NOMBRE DE LISTA */
            $(".txtnombre").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoListaDistribucionPorNombre.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            /** BOTON DE BUSQUEDA DE REGISTRO */
            $("#btnBuscar").click(function() {
                if ($(".txtnombre").val()===""){alert("No ha especificado lista a buscar");}
                else {
                    $.ajax({
                        type:"GET",
                        dataType:"html",
                        url:"../../../bl/Contacto/actualizaListaDistribucion.php",
                        data:{
                            nombrelista:$(".txtnombre").val()
                        },
                        success:function(data) {
                            toHtml(data);
                        }
                    })
                }
            });
            
            //* AGREGAR CONTACTOS */
            $("#btnAgregarContacto").live("click",function() {
                
            });
            
            function toHtml(data)
            {
                $("#tmp").html(data);
            }
            
        })    
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE LISTA DE DISTRIBUCION</h1>
            </div>
        </div>
        <div id="main">
            <label for="nombre">Escriba el nombre de la lista:</label>
            <div id="busqueda">
                <input type="text" size="50" name="txtnombre" class="txtnombre" placeholder="Nombre de la lista"/>
                <input type="button" value="Buscar" id="btnBuscar" />
            </div>
            <hr />
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
