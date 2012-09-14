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
        <link href="../../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/fieldset_edit.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="../../../js/cargarDatos.js" type="text/javascript"></script>
        
        <script>
        var tipobusqueda = "";    
        $(document).ready(function() {
            $.ajax({
                type:"GET",
                url:"../../../bl/Contacto/actualizaCompania.php?opcion=ruc",
                dataType:"html",
                data:{
                    ruc:<?=$_REQUEST['ruc']?>
                },
                success:function(data) {
                    toHtml(data);
                    cargarDireccionCompaniaRUC(<?=$_REQUEST['ruc']?>);
                }
            });
            
            // PRIMERA CARGA DE ESPECIALIDADES
            $("#modalEspecialidad").load("../modal_registracompania/modal-especialidadCompania.php");
            // PRIMERA CARGA DE REPRESENTANTES
            $("#modalRepresentante").load("../modal_registracompania/representantes_div_nocheckbox.php?ruc="+<?=$_REQUEST['ruc']?>);
            // PRIMERA CARGA DE ESPECIALIDADES
            $("#modalEspecialidad").load("../modal_registracompania/especialidades_div.php?filtro=3");
            
            function reload() {
                $.ajax({
                    type:"GET",
                    url:"../../../bl/Contacto/actualizaCompania.php?opcion=ruc",
                    dataType:"html",
                    data:{
                        ruc:<?=$_REQUEST['ruc']?>
                    },
                    success:function(data) {
                        toHtml(data);
                    }
                });
            }
            
            function toHtml(data)
            {
                $("#tmp").html(data);
            }
            
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
                        });
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
            });
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
                           if (!$("#tr_giro").length) 
                                reload();
                       }
                    });
            });
            //CANCELAR
            $("#btnCancelar").live("click",function() {
                $(this).parent().parent().remove();
                
            });
            // CREAR NUEVO GIRO
            $("#btnAgregarGiro").live("click",function() {
                var giro = '<tr id="tr_giro"><td>'+
                            '<input type="text" size="30" id="txtGiroNuevo" name="giro" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoGiroGiro"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_giro").after(giro);        
            });
            //GUARDAR NUEVO GIRO
            $("#btnNuevoGiroGiro").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevogiro:$(this).parent().parent().children().children("#txtGiroNuevo").attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=giro_nuevo",
                    success:function() {
                        reload();
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
                        if (!$("#tr_tfijo").length)
                            reload();
                    }
                });
            });
            //CREAR NUEVO TELEFONO FIJO
            $("#btnAgregarTF").live("click",function() {
                var giro = '<tr id="tr_tfijo"><td>'+
                            '<input type="text" size="30" id="txtTFNuevo" name="tf" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoTF"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_tfijo").after(giro);        
            });
            // GUARDAR NUEVO TELEFONO FIJO
            $("#btnNuevoTF").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevotf:$(this).parent().parent().children().children("#txtTFNuevo").attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tf_nuevo",
                    success:function() {
                        reload();
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
                        if (!$("#tr_tmobile").length)
                            reload();
                    }
                });
            });
            // CREAR NUEVO TM
            $("#btnAgregarTM").live("click",function() {
                var giro = '<tr id="tr_tmobile"><td>'+
                            '<input type="text" size="30" id="txtTMNuevo" name="tf" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoTM"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_tmobile").after(giro);        
            });
            // GUARDAR NUEVO TM
            $("#btnNuevoTM").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevotm:$(this).parent().parent().children().children("#txtTMNuevo").attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tm_nuevo",
                    success:function() {
                        reload();
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
                        if (!$("#tr_tnextel").length)
                            reload();
                    }
                });
            });
            
            // CREAR NUEVO TN
            $("#btnAgregarTN").live("click",function() {
                var giro = '<tr id="tr_tnextel"><td>'+
                            '<input type="text" size="30" id="txtTNNuevo" name="tf" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoTN"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_tnextel").after(giro);        
            });
            // GUARDAR NUEVO TN
            $("#btnNuevoTN").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevotn:$(this).parent().parent().children().children("#txtTNNuevo").attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=tn_nuevo",
                    success:function() {
                        reload();
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
            /** ESPECIALIDAD */
            // EDITAR ESPECIALIDAD
            $("#btnEditarEspecialidades").live("click",function(){
                $("#especialidadid").fadeIn("slow");
                if ($("#btnEditarEspecialidades").val() === "Editar") {
                    $("#txtEspecialidad").removeAttr("READONLY");
                    $("#btnEditarEspecialidades").attr("value","Guardar");
                } else {
                    if ($("#especialidadid").attr("value") == 0) {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                id_especialidad_new:$("#especialidadid").attr("value"),
                                id_especialidad_old:$(this).parent().parent().children().children('#idEspecialidad').attr("value"),
                                idCompania:$("#idCompania").val(),
                                idEmpresa:<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=especialidad_actualiza",
                            success:function() {
                                alertExito();
                                $("#txtEspecialidad").val($("#especialidadid option:selected").text());
                                $("#especialidadid").fadeOut("slow");
                                $("#btnEditarEspecialidades").attr('value', 'Editar');
                            }
                        });
                    }
                }
            });
            // ELIMINAR ESPECIALIDAD
            $("#btnEliminarEspecialidad").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        id_especialidad_old:$(this).parent().parent().children().children('#idEspecialidad').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=especialidad_elimina",
                    success:function() {
                        if (!$("#tr_especialidad").length)
                            reload();
                    }
                });
            });
            // NUEVA ESPECIALIDAD
            $("#btnNuevaEspecialidad").live("click",function() {
                $("#modalEspecialidad").dialog("open");
            });
            // GUARDAR ESPECIALIDAD
            $(".especialidades").live('click',function() {
                var especialidades = $(this).text().split("-");
                $.ajax({
                    type:"POST",
                    data:{
                        id_nuevoespecialidad:especialidades[0],
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=especialidad_nuevo",
                    success:function() {
                        reload();
                    }
                });
            });
            /** VIA DE ENVIO */
            // EDITAR VIA DE ENVIO
            $("#btnEditarViaEnvio").live("click", function() {
                if ($("#btnEditarViaEnvio").val() === "Editar"){
                    $("#viaenvioid").fadeIn("slow", function(){
                        $("#btnEditarViaEnvio").attr("value","Guardar");
                    });
                } else {
                    if ($("#viaenvioid").val() == 0) {
                        alert("Debe escoger una opcion");
                    } else {
                        $("#viaenvioid").fadeOut("slow", function(){
                        $("#btnEditarViaEnvio").attr("value","Editar");
                        $.ajax({
                            type:"POST",
                            data:{
                                viaenvio_id:$("#viaenvioid").val(),
                                idEmpresa:<?=$_SESSION['id']?>,
                                idCompania:$("#idCompania").val()
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=viaenvio",
                            success:function() {
                                $("#txtviaenvio").val($("#viaenvioid option:selected").text());
                                alert("Se ha actualizado correctamente su peticion");
                            }
                            });
                        });
                    }
                }
            });
            /** REPRESENTANTES */
            //EDITAR REPRESENTANTE
            $("#btnEditarRepresentante").live("click",function() {
                if ($("#btnEditarRepresentante").attr("value") === "Editar") {
                    $("#representanteid").fadeIn("slow", function(){
                        $("#btnEditarRepresentante").attr("value","Guardar");
                    });
                } else {
                    if ($("#representanteid").attr("value") == 0) {
                        alert("Debe escoger un representante.");
                    } else {
                        $("#representanteid").fadeOut("slow", function() {
                            $("#btnEditarRepresentante").attr("value","Editar");
                            $.ajax({
                                type:"POST",
                                data:{
                                    id_representante_new:$("#representanteid").attr("value"),
                                    id_representante_old:$(this).parent().parent().children().children('#idRepresentante').attr("value"),
                                    idCompania:$("#idCompania").val(),
                                    idEmpresa:<?=$_SESSION['id']?>
                                },
                                url:"../../../bl/editaCompania_BL.php?parameter=representante_actualiza",
                                success:function() {
                                    alertExito();
                                }
                            })
                        });
                    }
                }
            });
            // ELIMINAR REPRESENTANTE
            $("#btnEliminarRepresentante").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        id_representante_old:$(this).parent().parent().children().children('#idRepresentante').attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa:<?=$_SESSION['id']?>
                    },
                    url:"../../../bl/editaCompania_BL.php?parameter=representante_elimina",
                    success:function() {
                        if (!$("#tr_representante").length)
                            reload();
                    }
                });
            });

            // NUEVO REPRESENTANTE
            $("#btnNewRepresentante").live("click",function() {
                $("#modalRepresentante").dialog("open");
            });
           
            // GUARDAR REPRESENTANTE
            $(".contacto").live("click",function() {
               var especialidad = $(this).text().split("-");
               $.ajax({
                  type:"POST",
                  url:"../../../bl/editaCompania_BL.php?parameter=representante_nuevo",
                  data:{
                      id_nuevorepresentante:especialidad[0],
                      idCompania:$("#idCompania").val(),
                      idEmpresa:<?=$_SESSION['id']?>
                  },
                  success:function() {
                      reload();
                  }
               });
            });
            // CANCELAR NUEVO REPRESENTANTE
            $("#btnCancelarNuevoRepresentante").live("click",function(){
                $(this).parent().parent().remove();
                $("#representanteid").fadeOut("slow");
            });
            
            /** OBSERVACION */
            // EDITAR OOBSERVACION
            $("#btnEditarObservacion").live("click",function() {
                if ($('#btnEditarObservacion').val() === "Editar") {
                    $("#txtObservacion").removeAttr("READONLY");
                    $('#btnEditarObservacion').attr("value", "Guardar");
                } else {
                    $.ajax({
                       type:"POST",
                       data:{
                           txt_observacion:$("#txtObservacion").val(),
                           idCompania:$("#idCompania").val(),
                           idEmpresa:<?=$_SESSION['id']?>
                       },
                       url:"../../../bl/editaCompania_BL.php?parameter=editar_observacion",
                       success:function() {
                           $('#btnEditarObservacion').attr("value", "Editar");
                       },
                       error:function() {
                           alert("dammit");
                       }
                    });
                }
            });
            /** EMAIL */
            $("#btnEditarEmail").live("click",function() {
                if ($("#btnEditarEmail").val() === "Editar") {
                    $("#txtEmail").removeAttr("READONLY");
                    $("#btnEditarEmail").attr('value', "Guardar");
                } else {
                    if ($("#txtEmail").val() === "") {
                        alert("Este campo no deberia estar vacio");
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                txt_email :$("#txtEmail").val(),
                                idCompania:$("#idCompania").val(),
                                idEmpresa :<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=editar_email",
                            success:function() {
                                $("#btnEditarEmail").attr('value', "Editar");
                                alertExito();
                            }
                        });
                    }
                }
            });
            /** WEB */
            //EDITAR WEB
            $("#btnEditarWeb").live("click",function() {
                if ($("#btnEditarWeb").val() === "Editar") {
                    $("#txtweb").removeAttr("READONLY");
                    $("#btnEditarWeb").attr("value","Guardar");
                } else {
                    if ($("#txtweb").val() === "") {
                        alert("Este campo no ddeberia estar vacio");
                    } else {
                        $.ajax({
                            type:"POST",
                            data:{
                                txt_web :$("#txtweb").val(),
                                idCompania:$("#idCompania").val(),
                                idEmpresa :<?=$_SESSION['id']?>
                            },
                            url:"../../../bl/editaCompania_BL.php?parameter=editar_web",
                            success:function() {
                                $("#btnEditarWeb").attr('value', "Editar");
                                alertExito();
                            }
                        })
                    }
                }
            });
            function cargarDireccionCompaniaRUC(ruc_par)
            {
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url:"../../../dl/busca_persona/Direccion.json.php?parameter=ruc",
                    data:{
                        value:ruc_par
                    },
                    success:function(data) {
                        printAddress(data);
                    }
                });
            }
            
            function cargarDireccionCompaniaNOMBRE(nombre_par)
            {
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url:"../../../dl/busca_persona/Direccion.json.php?parameter=nombre",
                    data:{
                        value:nombre_par
                    },
                    success:function(data) {
                        printAddress(data);
                    }
                });
            }
            function printAddress(data) {
                var i = 1;
                $.each(data,function(index,value){
                    cargarPais(data[index].idpais,i)
                    cargarDepartamento(data[index].iddepartamento, i);
                    cargarDistrito(data[index].iddistrito, i);
                    cargarDomicilio(data[index].idtipodireccion, i)
                    $("#direccion_full tbody").append(
                        "<tr id='tbl_direccion'>"+
                        "<td><input type='text' id='direccion' value='"+data[index].direccion+"' READONLY/></td><tr />"+
                        "<td><select disabled='disabled' id='pa"+i+"'></select></td><tr />"+
                        "<td><select disabled='disabled' id='de"+i+"'></select></td><tr />"+
                        "<td><select disabled='disabled' id='di"+i+"'></select></td><tr />"+
                        "<td><select disabled='disabled' id='do"+i+"'></select></td><tr />"+
                        "<td><input type='button' id='btnEditarDireccion'  value='Editar' class='ui-button ui-widget ui-state-default ui-corner-all'/></td>"+
                        "<td><input type='button' class='delRow' id='btnEliminarDireccion' /></td>"+
                        "<td><input type='button' class='addRow' id='btnAgregarDireccion' /></td>"+
                        "<input type='hidden' id='idDireccionHidden' value='"+i+"' />"+
                        "<input type='hidden' id='idDireccion"+i+"' value='"+data[index].iddcc+"' />"+
                        "</tr>"
                    ),
                    i++
                });
            }
            
            /** CARGAS DE DIRECCION */
            //PAIS
            function cargarPais(idpais,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_pais:idpais},
                    url:"../../../bl/Contacto/cargarPaisesSelected.php",
                    success:function(data){
                        $("#pa"+i).append(data);
                    }
                })
            }
            // DEPARTAMENTO
            function cargarDepartamento(iddepartamento,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_departamento:iddepartamento},
                    url:"../../../bl/Contacto/cargarDepartamentosSelected.php",
                    success:function(data){
                        $("#de"+i).append(data);
                    }
                })
            }
            // DISTRITO
            function cargarDistrito(iddistrito,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_pais:iddistrito},
                    url:"../../../bl/Contacto/cargarDistritosSelected.php",
                    success:function(data){
                        $("#di"+i).append(data);
                    }
                })
            }
            // DOMICILIO
            function cargarDomicilio(iddomicilio,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_tipodomicilio:iddomicilio},
                    url:"../../../bl/Contacto/cargarTipoDireccionSelected.php",
                    success:function(data){
                        $("#do"+i).append(data);
                    }
                });
            }
            /** DIRECCION */
            // PAIS
            // EDITAR DIRECCION
            $("#btnEditarDireccion").live("click",function() {
                var idaddress = $(this).parent().parent().children("#idDireccionHidden").val();
                thisObj = $(this);
                
                if (thisObj.val() == "Editar") {
                    thisObj.attr('value', 'Guardar');
                    
                    $("#pa"+idaddress).removeAttr('disabled');
                    $("#de"+idaddress).removeAttr('disabled');
                    $("#di"+idaddress).removeAttr('disabled');
                    $("#do"+idaddress).removeAttr('disabled');
                    $("#direccion").removeAttr('readonly');
                } else {
                    if ($("#direccion").val() === "") {
                        alertCampoVacion();
                    } else {
                        alert($(this).parent().parent().parent().children().children().children("#pa"+idaddress).val());
                        $.ajax({
                            type:"POST",
                            url:"../../../bl/editaCompania_BL.php?parameter=actualizadireccion",
                            data:{
                                idDireccion:$(this).parent().parent().children("#idDireccion"+idaddress).val(),
                                txtdireccion:$("#direccion").val(),
                                idpais:$(this).parent().parent().parent().children().children().children("#pa"+idaddress).val(),
                                iddepartamento:$(this).parent().parent().parent().children().children().children("#de"+idaddress).val(),
                                iddistrito:$(this).parent().parent().parent().children().children().children("#di"+idaddress).val(),
                                idtipodireccion:$(this).parent().parent().parent().children().children().children("#do"+idaddress).val(),
                                idCompania:$("#idCompania").val(),
                                idEmpresa :<?=$_SESSION['id']?>
                            },
                            success:function() {
                                thisObj.attr('value', 'Editar');
                    
                                $("#pa"+idaddress).attr("disabled", "disabled");
                                $("#de"+idaddress).attr("disabled", "disabled");
                                $("#di"+idaddress).attr("disabled", "disabled");
                                $("#do"+idaddress).attr("disabled", "disabled");
                                $("#direccion").attr('readonly', 'true');
                            }
                        });    
                    }
                }
            });
            // ELIMINAR DIRECCION
            $("#btnEliminarDireccion").live("click",function() {
                var idaddress = $(this).parent().parent().children().children("#idDireccionHidden").attr("value");
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    url:"../../../bl/editaCompania_BL.php?parameter=eliminadireccion",
                    data:{
                        idregistro:$(this).parent().parent().children().children("#idDireccion"+idaddress).attr("value"),
                        idCompania:$("#idCompania").val(),
                        idEmpresa :<?=$_SESSION['id']?>
                    },
                    success:function() {
                        
                    }
                });
            });
            // CREAR NUEVA DIRECCION
            $("#btnAgregarDireccion").live("click",function() {
                alert("www");
                $("#seleccionaDireccion").dialog("open");
            });
            // MODAL CREAR NUEVA DIRECCION
            $("#seleccionaDireccion").dialog({
                autoOpen:false,
                height:280,
                width:450,
                modal:true,
                buttons:{
                    "Agregar":function() {
                        if ($("#direccion_text").val() === "" || $("#tipodireccionid").val() === "0")
                            alert("Hay un error en la direccion o el tipo de direccion.");
                        else {
                            $.ajax({
                                type:"POST",
                                url:"../../../bl/editaCompania_BL.php?parameter=nuevadireccion",
                                data:{
                                    txtdireccion:$("#direccion_text").val(),
                                    idpais:$("#paisid").val(),
                                    iddepartamento:$("#departamentoid").val(),
                                    iddistrito:$("#distritoid").val(),
                                    idtipodireccion:$("#tipodireccionid").val(),
                                    idCompania:$("#idCompania").val(),
                                    idEmpresa :<?=$_SESSION['id']?>
                                },
                                success:function() {
                                    reload();
                                }
                            });
                        }
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            function alertCampoVacion() {
                alert("Este campo debe contener datos.")
            }
            
            function alertExito() {
                alert("Su operacion ha sido satisfactoria");
            }
            
            /** MODALES */
            $("#modalEspecialidad").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modalRepresentante").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            })
        });
        </script>
    </head>
    <body class="fondo">
        <div id="modalEspecialidad" title="Seleccione una especialidad"></div>
        <div id="modalRepresentante" title="Seleccione un representante"></div>
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
            <hr />
            <div id="tmp"></div>
        </div>
    </body>
</html>