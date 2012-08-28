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
        <link href="../../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script> 
        <script src="../../../js/cargarDatos.js" type="text/javascript"></script>
        <script>
        var tipobusqueda = "";    
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
                    $(".ruc_empresa").focus();
                } else if ($(this).val() == "nombre") {
                    $(".ruc_empresa").val("");
                    $("#ruc_div").css("display","none");
                    $("#nombre_div").css("display","block");
                    $("#divbtn").css("display","block");
                    $(".nombre_empresa").focus();
                }
            });
            
            // DETECTAR CLICK PARA REALIZAR BUSQUEDA
            $("#btnBuscar").click(function() {
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
                            dataType:"html",
                            success:function(data) {
                                toHtml(data)
                            }
                        });
                    }
                    else // BUSQUEDA EN CASO DE QUE SEA POR NOMBRE
                    {
                        $.ajax({
                            type:"GET",
                            url:"../../../bl/Contacto/actualizaCompania.php?opcion=nombre",
                            data:{nombre:$(".nombre_empresa").val()},
                            dataType:"html",
                            success:function(data) {
                                toHtml(data);
                            }
                        });
                    }    
                }
            });
            
            function toHtml(data)
            {
                $("#tmp").html(data);
            }
            
            /**
             * detectar click 
             */
            $("#actualizar").live("click", function(e) {
                alert("Actualizar");
                
            })
            /**
             * ELIMINAR GIRO
             */
            $(".delRow").live("click",function() {
                 $(this).parent().parent().remove();
            });
            
            /**
             * AGREGAR NUEVO GIRO
             */
            $(".addRow").live("click",function() {
                alert($(this).parent().parent().html());
                var giro = '<tr id="tr_giro"><td>'+
                            '<input type="text" size="30" name="giro" value="" />'+
                            '<td><input type="button" class="addRow" value="+" /></td>'+
                            '<td><input type="button" class="delRow" value="-" /></td>'+
                            '</td></tr>';
                $("#tr_giro").after(giro);        
            });
            //DETECTAR INTENCION DE CAMBIO DE TIPO DE COMPANIA
            $("#btnEditarTipoCompania").live("click", function() {
                if ($("#btnEditarTipoCompania").val() === "Editar"){
                    $("#tipocompaniaid").fadeIn("slow", function(){
                        $("#btnEditarTipoCompania").attr("value","Guardar");
                    });
                } else {
                    $("#tipocompaniaid").fadeOut("slow", function(){
                        $("#btnEditarTipoCompania").attr("value","Editar");
                        $.ajax({
                            type:"POST",
                            data:{
                                tipocompania_id:$("#tipocompaniaid").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val(),    
                                idTipoCompania:$("#tipocompaniaid").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=tipocompania",
                            success:function() {
                                alert("Se ha actualizado correctamente su peticion");
                            }
                        });
                    });
                }
            });
            //DETECTAR INTENCION DE CAMBIO VIA DE ENVIO
            // DETECTAR ACTUALIZACION EN GIRO
            $("#btnEditarGiro").live("click",function() {
                alert($(this).parent().parent().html());
            });
        });
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE COMPANIA</h1>
            </div>
        </div>
        <div id="main">
            <?php
            // VERIFICAR SI EXISTE SESIONA CTIVA
            ?>
            <h1>EDICION DE COMPAÑIA | <?=$_SESSION['usr']?></h1>
            
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
                    <input type="hidden" id="txtidCiaToSearch" />
                    <input type="button" id="btnBuscar" value="Buscar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                </div>
            </div>
            
                <div id="divmensajebusqueda" style="display: none">
                    No ha especificado criterio alguno para su búsqueda. Rellene un campo e intente de nuevo.
                </div>
            <hr />
            <div id="tmp"></div>
        </div>
    </body>
</html>