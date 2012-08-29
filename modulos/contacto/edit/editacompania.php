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
                    if ($("#tipocompaniaid").val() == 0) {
                        alert("Debe escoger una opcion");
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
                                $("#txttipocompania").val($("#tipocompaniaid option:selected").text());
                                alert("Se ha actualizado correctamente su peticion");
                            }
                            });
                        });
                    }
                    
                }
            });
            /** CAMBIAR RUC */
            // EDITAR RUC
            $("#btnUpdateRuc").live("click",function() {
                if ($("#btnUpdateRuc").val() === "Editar") {
                    $("#txtruc").removeAttr("READONLY");
                    $("#btnUpdateRuc").attr("value","Guardar");
                } else {
                    if ($("#txtruc").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                ruc:$("#txtruc").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()    
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=ruc",
                            success:function() {
                                $("#txtruc").attr("READONLY",true);
                                $("#btnUpdateRuc").attr("value","Editar");
                                alertExito();
                            }
                        })
                    }
                }
                
            });
            
            /** CAMBIAR NOMBRE */
            // EDITAR NOMBRE
            $("#btnUpdateNombre").live("click",function() {
                if ($("#btnUpdateNombre").val() === "Editar") {
                    $("#txtcompania").removeAttr("READONLY");
                    $("#btnUpdateNombre").attr("value","Guardar");
                } else {
                    if ($("#txtcompania").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                nombre:$("#txtcompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=nombre",
                            success:function() {
                                $("#txtcompania").attr("READONLY",true);
                                $("#btnUpdateNombre").attr("value","Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            
            /** CAMBIAR NOMBRE COMERCIAL */
            // EDITAR NOMBRE COMERCIAL
            $("#btnUpdateNombrecomercial").live("click",function() {
                if ($("#btnUpdateNombrecomercial").val() === "Editar") {
                    $("#txtcomercia").removeAttr("READONLY");
                    $("#btnUpdateNombrecomercial").attr("value","Guardar");
                } else {
                    if ($("#txtcomercia").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                nombrecomercial:$("#txtcomercia").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=nombrecomercial",
                            success:function() {
                                $("#txtcomercia").attr("READONLY",true);
                                $("#btnUpdateNombrecomercial").attr("value","Editar");
                                alertExito();
                            }
                        })
                    }
                }
            })
            
            /** CAMBIAR PARTIDA REGISTRAL */
            // EDITAR PARTIDA REGISTRAL
            $("#btnUpdatePartidaRegistral").live("click",function() {
                if($("#btnUpdatePartidaRegistral").val() === "Editar") {
                    $("#txtregistral").removeAttr("READONLY");
                    $("#btnUpdatePartidaRegistral").attr("value","Guardar");
                } else {
                    if ($("#txtregistral").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                partidaregistral:$("#txtregistral").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=partidaregistral",
                            success:function() {
                                $("#txtregistral").attr("READONLY",true);
                                $("#btnUpdatePartidaRegistral").attr("value","Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            
            /** CAMBIAR GIRO */
            // EDITAR GIRO
            $("#btnEditarGiro").live("click",function() {
                if ($("#btnEditarGiro").val() === "Editar") {
                    $("#txtGiro").removeAttr("READONLY");
                    $("#btnEditarGiro").attr("value","Guardar");
                } else {
                    if ($("#txtGiro").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                val_giro:$(this).parent().parent().children().children('#txtGiro').attr("value"),
                                id_giro:$(this).parent().parent().children('#idGiro').attr("value"),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=giro_actualiza",
                            success:function() {
                                $("#txtGiro").attr("READONLY",true);
                                $("#btnEditarGiro").attr("value","Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            // ELIMINAR GIRO
            $("#btnEliminarGiro").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                   type:"POST",
                   data:{
                        id_giro:$(this).parent().parent().children('#idGiro').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                   },
                   url:"../../../bl/editaCompania_BL.php?parameter=giro_elimina",
                   success:function() {
                       alertExito();
                   }
                });
            });
            
            /** ACTIVIDAD PRINCIPAL */
            // EDITAR ACTIVIDAD PRINCIPAL
            $("#btnEditarActividadPrincipal").live("click",function() {
                if($("#btnEditarActividadPrincipal").val() === "Editar") {
                    $("#txtactividad").removeAttr("READONLY");
                    $("#btnEditarActividadPrincipal").attr("value","Guardar");
                } else {
                    if ($("#txtactividad").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                actividadprincipal:$("#txtactividad").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=actividadprincipal",
                            success:function(){
                                alertExito();
                            }
                        });
                    }    
                }    
            });
            
            /** TELEFONO FIJO */
            // EDITAR TELEFONO FIJO
            $("#btnEditarTelefonoFijo").live("click",function() {
                if($("#btnEditarTelefonoFijo").val() === "Editar") {
                    $("#txtTelefonoFijo").removeAttr("READONLY");
                    $("#btnEditarTelefonoFijo").attr("value","Guardar");
                } else {
                    if ($("#txtTelefonoFijo").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                           type:"POST",
                           data:{
                                val_tf:$(this).parent().parent().children().children('#txtTelefonoFijo').attr("value"),
                                id_tf:$(this).parent().parent().children().children('#idTFijo').attr("value"),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                           },
                           url:"../../../bl/editaCompania_BL.php?parameter=tf_actualiza",
                           success:function() {
                               $("#txtTelefonoFijo").attr("READONLY",true);
                               $("#btnEditarTelefonoFijo").attr("value","Editar");
                               alertExito();
                           }
                        });
                    }
                }
            });
            // ELIMINAR TELEFONO FIJO
            $("#btnEliminarTF").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        id_tf:$(this).parent().parent().children().children('#idTFijo').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tf_elimina",
                    success:function() {
                        alertExito();
                    }
                });
            });
            
            /** TELEFONO MOBILE */
            // EDITAR T MOBILE
            $("#btnEditarTelefonoMobile").live("click",function() {
                if ($("#btnEditarTelefonoMobile").val() === "Editar") {
                    $("#txtTelefonoMobile").removeAttr("READONLY");
                    $(this).attr("value","Guardar");
                } else {
                    if ($("#txtTelefonoMobile").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                val_tm:$(this).parent().parent().children().children('#txtTelefonoMobile').attr("value"),
                                id_tm:$(this).parent().parent().children().children('#idTMobile').attr("value"),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=tm_edita",
                            success:function() {
                                $("#txtTelefonoMobile").attr("READONLY",true);
                                $("#btnEditarTelefonoMobile").attr("value","Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            // ELIMINAR T MOBILE
            $("#btnEliminarTM").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        id_tmobile:$(this).parent().parent().children().children('#idTMobile').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tm_elimina",
                    success:function() {
                        alertExito();
                    }
                });
            });
            
            /** TELEFONO NEXTEL */
            // EDITAR TELEFONO NEXTEL
            $("#btnEditarTelefonoNextel").live("click",function() {
                if($("#btnEditarTelefonoNextel").val() === "Editar") {
                    $("#txtTelefonoNextel").removeAttr("READONLY");
                    $("#btnEditarTelefonoNextel").attr("value","Guardar");
                } else {
                    if ($("#txtTelefonoNextel").attr("value") === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                val_tnextel:$(this).parent().parent().children().children('#txtTelefonoNextel').attr("value"),
                                id_tnextel:$(this).parent().parent().children().children('#idTNextel').attr("value"),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=tn_actualiza",
                            success:function() {
                                $("#txtTelefonoNextel").attr("READONLY", "true");
                                $("#btnEditarTelefonoNextel").attr("value","Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            
            // ELIMINAR TELEFONO NEXTEL
            $("#btnEliminarTN").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        id_tnextel:$(this).parent().parent().children().children('#idTNextel').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tn_elimina",
                    success:function() {
                        alertExito();
                    }
                });
            });
            
            /** FAX */
            // EDITAR FAX
            $("#btnEditarFax").live("click",function() {
                if ($("#btnEditarFax").val() === "Editar") {
                    $("#txtfax").removeAttr("READONLY");
                    $("#btnEditarFax").attr("value","Guardar");
                } else {
                    if ($("#txtfax").attr("value") === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                fax:$("#txtfax").val(),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=fax_actualiza",
                            success:function() {
                                alertExito();
                            }
                        });
                    }
                }
            });
            
            /** VIA DE ENVIO */
            // EDITAR
            $("#btnEditarViaEnvio").live("click",function() {
            
            })
            
            function alertCampoVacion() {
                alert("Este campo debe contener datos.")
            }
            
            function alertExito() {
                alert("Su operacion ha sido satisfactoria");
            }
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