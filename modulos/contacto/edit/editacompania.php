<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDICION DE COMPAÑIA</title>
        <!-- CSS ZONE -->
        <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script> 
        <script>
        var tipobusqueda = "";    
        //auto completar
        $(document).ready(function() {
            $(".ruc_empresa").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoEmpresasPorRuc.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            $(".nombre_empresa").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoEmpresas.php", {
                width:260,
                matchContains:true,
                selectFirst:false
            });
            // DETECTAR EL CAMBIO EN EL RADIO BUTTON DEL CRITERIO DE BUSQUEDA
            $("input:radio[name=criteriobusqueda]").click(function() {
                tipobusqueda = $(this).val();
                if ($(this).val() == "ruc") {
                    $(".nombre_empresa").val("");
                    $("#nombre_div").css("display","none");
                    $("#ruc_div").css("display","block");
                    $("#divbtn").css("display","block");
                } else if ($(this).val() == "nombre") {
                    $(".ruc_empresa").val("");
                    $("#ruc_div").css("display","none");
                    $("#nombre_div").css("display","block");
                    $("#divbtn").css("display","block");
                }
            });
            
            // DETECTAR CLICK PARA REALIZAR BUSQUEDA
            $("#divbtn").click(function() {                
                if ($(".nombre_empresa").val().length < 0 || $(".ruc_empresa").val().length < 0) {
                    $("#divmensajebusqueda").fadeIn("slow");
                    $("#divmensajebusqueda").fadeOut("slow");
                    
                } else {
                    if (tipobusqueda == "ruc") //BUSQUEDA EN CASO DE QUE SEA POR RUC
                    {   
                        $.ajax({
                            type:"GET",
                            url:"../../../bl/Contacto/actualizaCompania.php?opcion=ruc",
                            data:{ruc:$(".ruc_empresa").val()},
                            success:function(data) {
                                
                            }
                        });
                    }
                    else // BUSQUEDA EM CASO DE QUE SEA POR NOMBRE
                    {
                        $.ajax({
                            type:"GET",
                            url:"../../../bl/Contacto/actualizaCompania.php?opcion=nombre",
                            data:{nombre:$(".nombre_empresa").val()},
                            success:function(data) {

                            }
                        });
                    }    
                    
                    
                }
            });
        });
        </script>
    </head>
    <body>
        <?php
        // VERIFICAR SI EXISTE SESIONA CTIVA
        ?>
        <h1>EDICION DE COMPAÑIA</h1>
        <label>Criterio de b&uacute;squeda:</label><br />
        <input type="radio" name="criteriobusqueda" value="ruc" />Por RUC<br /> 
        <input type="radio" name="criteriobusqueda" value="nombre" />Por Nombre<br />
        <div id="divbusqueda">
            <div id="ruc_div" style="display: none">
                <label>RUC:</label>
                <input type="text" size="12" name="txtruc" class="ruc_empresa" placeholder="Ingrese RUC" value="" />
            </div>
            <div id="nombre_div" style="display: none">
                <label>Nombre de Compa&ncaron;&iacute;a:</label>
                <input type="text" size="30"  name="txtnombre" class="nombre_empresa" placeholder="Ingrese nombre de la Compañía" value="" />
            </div>    
            <div id="divbtn" style="display: none">
                 <input type="button" id="btnBuscar" value="¡Buscar!" />
                 <input type="button" name="imprimir" value="Imprimir" onclick="window.print();"
            </div>
        </div>    
            <div id="divmensajebusqueda" style="display: none">
                No ha especificado criterio alguno para su búsqueda. Rellene un campo e intente de nuevo.
            </div>
        <hr />
        <!-- ZONA DONDE SE MUESTRA LOS DATOS A MODIFICAR -->
        <table>
            <tr>
                <td>Tipo de Compañia:</td><td><select id="" name=""><option></option></select></td>
            </tr>
            <tr>
                <td>RUC:</td><td><input type="text" id="txtruc" name="txtruc" /></td>
            </tr>
            <tr>
                <td>Nombre de Compañía:</td><td><input type="text" id="txtcompania" name="txtcompania" /></td>
            </tr>
            <tr>
                <td>Nombre Comercial:</td><td><input type="text" id="txtcomercia" name="txtcomercial" /></td>
            </tr>    
            <tr>
                <td>Partida Registral:</td><td><input type="text" id="txtregistral" name="txtregistral" /></td>
            </tr>    
            <tr>
                <td>Giro:</td><td></td>
            </tr>    
            <tr>
                <td>Actividad Principal:</td><td><input type="text" id="txtactividad" name="txtactividad" /></td>
            </tr>
            <tr>
                <td>T. Fijo</td>
            </tr>
            <tr>
                <td>T. Mobile</td>
            </tr>
            <tr>
                <td>T. Nextel</td>
            </tr>
            <tr>
                <td>Fax:</td><td><input type="text" name="txtfax" /></td>
            </tr>
            <tr>
                <td>Direccion</td>
            </tr>
            <tr>
                <td>Especialidad:</td>
            </tr>
            <tr>
                <td>Representantes:</td>
            </tr>
            <tr>
                <td>Observacion:</td>
            </tr>
            <tr>
                <td>Email:</td><td><input type="text" name="txtemail" /></td>
            </tr>
            <tr>
                <td>Web:</td><td><input type="text" name="txtweb" /></td>
            </tr>
            <tr>
                <td>Vía de Envío:</td>
            </tr>
        </table>    
    </body>
</html>
