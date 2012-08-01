<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
require_once '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editar Obra</title>
        <link href="" rel="" type="text/css" />
        
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script>
        var tipobusqueda = "";    
        $(document).ready(function() {
            /*
             * DETECTAR SELECCION DE CRITERIO 
             */
            $("input:radio[name=criteriobusqueda]").click(function() {
                tipobusqueda = $(this).val();
                if ($(this).val() == "codigo")
                {
                    $(".nombreobra").val("");
                    $("#divnombre").css("display","none");
                    $("#divcodigo").css("display","block");
                    $("#divbtnBuscar").css("display","block");
                    $(".codigoobra").focus();
                }
                else if ($(this).val() == "nombre")
                {
                    $(".codigoobra").val("");
                    $("#divcodigo").css("display","none");
                    $("#divnombre").css("display","block");
                    $("#divbtnBuscar").css("display","block");
                    $(".nombreobra").focus();
                }    
            });
            
            //BOTON PARA BUSCAR
            $("#btnBuscar").click(function() {
                if ($(".nombreobra").val() == "" || $(".codigoobra").val() == "") {
                    $("#divmensaje").fadeIn("slow");
                    $("#divmensaje").fadeOut("slow");
                }
                else {
                    if (tipobusqueda == "codigo") {
                        $.ajax({
                            type:"GET",
                            url:"../../../bl/DatosObra/actualizaObra.php?opcion=codigo",
                            data:{codigo:$(".codigoobra").val()},
                            dataType:"html",
                            success:function(data) {
                                toHtml(data);
                            }
                        })
                    } else if(tipobusqueda == "nombre") {
                        $.ajax({
                            type:"GET",
                            url:"../../../bl/DatosObra/actualizaObra.php?opcion=nombre",
                            data:{nombre:$(".nombreobra").val()},
                            dataType:"html",
                            success:function(data) {
                                toHtml(data);
                            }
                        })
                    }
                }
            });
            
            $(".").autocomplete("",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            
            $("").autocomplete("",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
        });    
        </script>
    </head>
    <body>
        <h1>EDICION DE OBRA | <?=$_SESSION['usr']?></h1>
        <label for="criterioBusqueda">Criterio de b&uacute;squeda:</label><br />
        <input type="radio" name="criteriobusqueda" value="codigo" />Por C&oacute;digo<br />
        <input type="radio" name="criteriobusqueda" value="nombre" />Por Nombre<br />
        
        <div id="divcodigo" style="display: none">
            <label>CODIGO:</label> 
            <input type="text" size="30" name="txtcodigo" class="codigoobra" value="" />
        </div>
        
        <div id="divnombre" style="display: none">
            <label>NOMBRE:</label>
            <input type="text" size="30" name="txtnombre" class="nombreobra" value="" />
        </div>
        
        <div id="divbtnBuscar" style="display: none">
            <input type="button" id="btnBuscar" value="Buscar" />
        </div>    
        
        <div id="divmensaje" style="display: none">
            No ha especificado criterio de b&uacute;squeda.
        </div>    
        <hr />
        <div id="obra"></div>
    </body>
</html>
