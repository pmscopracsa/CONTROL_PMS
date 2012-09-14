<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDICION DE PERSONA</title>
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
        var data_newesp = new Array();
        
        function recargarEmpresa(filtro) 
        {
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro="+filtro);
        }
        
        function recargarEmpresaSF()
        {
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro=1");
        }  
        $(document).ready(function(){
            /** PRIMERA CARGA DE LA LISTA DE EMPRESAS */
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro=1");
            
            /** PRIMERA CARGA DE LA LISTA DE ESPECIALIDADES */
            $("#divEditarEspecialidad").load("../../../modulos/contacto/modal_registracompania/modal-especialidadPersona.php");
            $("#divEditarEspecialidadNuevo").load("../../../dl/contacto_bl/modal-especialidadPersonaNew.php");
            
            /** FUNCION PARA RECARGAR */
            function reload(){
                $.ajax({
                       type:"GET",
                       dataType:"html",
                       url:"../../../bl/Contacto/actualizaPersonaPorDocumento.php",
                       data:{
                           documento:<?=$_REQUEST['documentodni']?>
                       },
                       success:function(data) {
                           toHtml(data);
                           cargarDireccionPersona(<?=$_REQUEST['documentodni']?>);
                           cargarViaEnvio($("#idviaenvio").val());
                           alert($("#idviaenvio").val());
                       }
               });
            }
            
            $.ajax({
                type:"GET",
                url:"../../../bl/Contacto/actualizaPersonaPorDocumento.php",
                dataType:"html",
                data:{
                    documento:<?=$_REQUEST['documentodni']?>
                },
                success:function(data){
                    toHtml(data);
                    cargarDireccionPersona(<?=$_REQUEST['documentodni']?>);
                    cargarViaEnvio($("#idviaenvio").val());
                }
            });
            
            function cargarDireccionPersona(id_persona){
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{
                        idpersona:id_persona
                    },
                    url:"../../../dl/busca_persona/DireccionPersonaPorDNI.php",
                    success:function(data){
                        printAddress(data);
                    }
                })
            }
            
            function cargarViaEnvio(id_viaenvio) {
                cargarviaenvioseleccted(id_viaenvio);
                $("#idviaenvio tbody").append(
                    "<td><select disabled='disabled' id='viaenvio'><select></td>"+
                    "<td><input type='button' id='btnEditarViaEnvio'  value='Editar' class='ui-button ui-widget ui-state-default ui-corner-all'/></td>"
                )
            }
            
            function printAddress(data) {
                var i = 1;
                if(!data){
                    $("#direccion_full tbody").append(
                        "<tr id='tbl_direccion'>"+
                            "<td><input type='button' class='addRow' id='btnAgregarDireccion' /></td>"+
                        "</tr>"    
                    )
                }else {
                    $.each(data,function(index,value){
                    cargarPais(data[index].idpais,i)
                    cargarDepartamento(data[index].iddepartamento, i);
                    cargarDistrito(data[index].iddistrito, i);
                    
                    $("#direccion_full tbody").append(
                            "<tr id='tbl_direccion'>"+
                            "<td><input type='text' id='direccion' value='"+data[index].direccion+"' READONLY/></td>"+
                            "<td><td><select disabled='disabled' id='pa"+i+"'></select></td></td>"+
                            "<td><td><select disabled='disabled' id='de"+i+"'></select></td>"+
                            "<td><td><select disabled='disabled' id='di"+i+"'></select></td>"+
                            "<td><input type='button' id='btnEditarDireccion'  value='Editar' class='ui-button ui-widget ui-state-default ui-corner-all'/></td>"+
                            "<td style='display:none'><input type='hidden' id='idDireccionHidden' value='"+i+"' /></td>"+
                            "<td style='display:none'><input type='hidden' id='idDireccion"+i+"' value='"+data[index].id+"' /></td>"+
                            "</tr>"
                        ),
                        i++
                    });
                }
            }
            
            /** EDITAR */
            // NUMERO DE DOCUMENTO
            $("#btnEditarNumeroDocumento").live("click",function() {
                
                if($("#btnEditarNumeroDocumento").val() === 'Editar') {
                    $("#btnEditarNumeroDocumento").attr('value', 'Guardar');
                    $("#txtnumerodocumento").removeAttr('readonly');
                } else {
                    if ($("#txtnumerodocumento").val() == "")
                        alert("Este campo debe tener datos")
                    else {
                        $.ajax({
                            type:"POST",
                            url:"../../../bl/editaPersona_BL.php?parameter=editaNumDoc",
                            data:{
                                idpersonacontacto:$("#idpersonacontacto").val(),
                                value:$("#txtnumerodocumento").val()
                            },
                            success:function() {
                                $("#btnEditarNumeroDocumento").attr('value', 'Editar'); 
                            }
                        });
                    }
                    
                }
            });
            // NOMBRES Y APELLIDOS
            $("#btnEditarNombres").live("click",function() {
                if($("#btnEditarNombres").val() === 'Editar') {
                    $("#btnEditarNombres").attr('value', 'Guardar');
                    $("#txtnombres").removeAttr('readonly');
                } else {
                    if ($("#txtnombres").val() == "")
                        alert("Este campo debe tener datos")
                    else {
                        $.ajax({
                            type:"POST",
                            url:"../../../bl/editaPersona_BL.php?parameter=editaNombres",
                            data:{
                                idpersonacontacto:$("#idpersonacontacto").val(),
                                value:$("#txtnombres").val()
                            },
                            success:function() {
                                $("#btnEditarNombres").attr('value', 'Editar'); 
                            }
                        });
                    }
                }
            });
            // COMPANIA
            $("#btnEditarCompania").live("click",function() {
                if($("#btnEditarCompania").val() === "Editar"){
                    $("#btnEditarCompania").attr('value','Guardar');
                    $("#divBuscarCompania").dialog("open");
                } else {
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaPersona_BL.php?parameter=editaCompania",
                        data:{
                            idpersonacontacto:$("#idpersonacontacto").val(),
                            value:$("#txtidempresa").val()
                        },
                        success:function() {
                            $("#btnEditarCompania").attr('value','Editar');
                        }
                    });
                }    
            });
            
            $("#btnSearchEmpContratante").live("click",function() {
                recargarEmpresa($("#txt_divEmpContratanteBuscar").val());  
            });
            // ASIGNAR EMPRESA A CAMPO
            $('.contratante').live("click",function(){
                 var contratante_array = $(this).text().split("-");
                 $("#txtcompania").val(contratante_array[1]);
                 $("#txtidempresa").val(contratante_array[0]);
            });
            // CARGO
            $("#btnEditarCargo").live("click",function() {
                if($("#btnEditarCargo").val() === 'Editar') {
                    $("#btnEditarCargo").attr('value', 'Guardar');
                    $("#txtcargo").removeAttr('readonly');
                } else {
                    if ($("#txtcargo").val() == "")
                        alert("Este campo debe tener datos")
                    else {
                        $.ajax({
                            type:"POST",
                            url:"../../../bl/editaPersona_BL.php?parameter=editaCargo",
                            data:{
                                idpersonacontacto:$("#idpersonacontacto").val(),
                                value:$("#txtcargo").val()
                            },
                            success:function() {
                                $("#btnEditarCargo").attr('value', 'Editar'); 
                            }
                        });
                    }
                    
                }
            })
            /** TELEFONO FIJO */
            // EDITAR TELEFONO FIJO
            $("#btnEditarTelefonoFijo").live("click",function() {
                if($(this).val() === "Editar") {
                    $(this).parent().parent().children().children("#txtTelefonoFijo").removeAttr('readonly');
                    $(this).attr("value","Guardar");
                } else {
                    if ($("#txtTelefonoFijo").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                           type:"POST",
                           data:{
                                value:$(this).parent().parent().children().children('#txtTelefonoFijo').attr("value"),
                                idvalue:$(this).parent().parent().children('#idTFijo').attr("value"),
                                idpersonacontacto:$("#idpersonacontacto").val()
                           },
                           url:"../../../bl/editaPersona_BL.php?parameter=tf_actualiza",
                           success:function() {
                               reload();
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
                        idvalue:$(this).parent().parent().children('#idTFijo').attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tf_elimina",
                    success:function() {
                        alertExito();
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
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tf_nuevo",
                    success:function() {
                        reload();
                    }
                });
            });
            // CANCELAR CREAR TELEFONO FIJO
            $("#btnCancelar").live("click",function() {
                $(this).parent().parent().remove();
            });
            /** TELEFONO MOBILE*/
            //ACTUALIZA - EDITO
            $("#btnEditarTM").live("click",function() {
                if($(this).val() === "Editar") {
                    $(this).parent().parent().children().children("#txtTM").removeAttr('readonly');
                    $(this).attr("value","Guardar");
                } else {
                    if ($("#txtTM").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                           type:"POST",
                           data:{
                                value:$(this).parent().parent().children().children('#txtTM').attr("value"),
                                idvalue:$(this).parent().parent().children('#idtm').attr("value"),
                                idpersonacontacto:$("#idpersonacontacto").val()
                           },
                           url:"../../../bl/editaPersona_BL.php?parameter=tm_actualiza",
                           success:function() {
                               reload();
                           }
                        });
                    }
                }
            });
            // ELIMINAR
            $("#btnEliminarTM").live("click",function() {
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        idvalue:$(this).parent().parent().children('#idtm').attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tm_elimina",
                    success:function() {
                        if (!$("#tr_tm").length)
                            reload();
                    }
                });
            });
            //CREAR NUEVO TELEFONO MOBILE
            $("#btnAgregarTM").live("click",function() {
                var giro = '<tr id="tr_tm"><td>'+
                            '<input type="text" size="30" id="txtTM" name="tf" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoTM"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_tm").after(giro);        
            });
            // GUARDAR NUEVO TELEFONO MOBILE
            $("#btnNuevoTM").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevotf:$(this).parent().parent().children().children("#txtTM").attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tm_nuevo",
                    success:function() {
                        reload();
                    }
                });
            });
            $("#btnCancelar").live("click",function(){
                $(this).parent().parent().remove();
            })
            /** TELEFONO NEXTEL*/
            //ACTUALIZA - EDITO
            $("#btnEditarTN").live("click",function() {
                if($(this).val() === "Editar") {
                    $(this).attr("value","Guardar");
                    $(this).parent().parent().children().children("#txtTN").removeAttr('readonly');
                } else {
                    if ($("#txtTN").val() === "") {
                        alertCampoVacion();
                    } else {
                        $.ajax({
                           type:"POST",
                           data:{
                                value:$(this).parent().parent().children().children('#txtTN').attr("value"),
                                idvalue:$(this).parent().parent().children('#idTN').attr("value"),
                                idpersonacontacto:$("#idpersonacontacto").val()
                           },
                           url:"../../../bl/editaPersona_BL.php?parameter=tn_actualiza",
                           success:function() {
                               reload();
                           }
                        });
                    }
                }
            });
            // ELIMINAR
            $("#btnEliminarTN").live("click",function() {
            alert($(this).parent().parent().children('#idTN').attr("value"));
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    data:{
                        idvalue:$(this).parent().parent().children('#idTN').attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tn_elimina",
                    success:function() {
                        if (!$("#tr_tn").length)
                            reload();
                    }
                });
            });
            //CREAR NUEVO TELEFONO NEXTEL
            $("#btnAgregarTN").live("click",function() {
                var giro = '<tr id="tr_tn"><td>'+
                            '<input type="text" size="30" id="txtTN" name="tf" value="" />'+
                            '<td><input type="button" value="Guardar" id="btnNuevoTN"/></td>'+
                            '<td><input type="button" value="Cancelar" id="btnCancelar"/></td>'+
                            '</td></tr>';
                $("#tr_tn").after(giro);        
            });
            // GUARDAR NUEVO TELEFONO NEXTEL
            $("#btnNuevoTN").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        val_nuevotn:$(this).parent().parent().children().children("#txtTN").attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tn_nuevo",
                    success:function() {
                        reload();
                    }
                });
            });
            $("#btnCancelar").live("click",function(){
                $(this).parent().parent().remove();
            })
            /** EDITAR DIRECCION */
            $("#btnEditarDireccion").live("click",function() {
                var idaddress = $(this).parent().parent().children().children("#idDireccionHidden").attr("value");
                if($("#btnEditarDireccion").val() == 'Editar') {
                    $("#btnEditarDireccion").attr('value','Guardar');
                    $("#pa"+idaddress).removeAttr('disabled');
                    $("#de"+idaddress).removeAttr('disabled');
                    $("#di"+idaddress).removeAttr('disabled');
                    $("#direccion").removeAttr('readonly');
                } else {
                    if ($("#direccion").val() === "") {
                        alert("El campo direccion esta vacio");
                    } else {
                        $.ajax({
                            type:"POST",
                            url:"../../../bl/editaPersona_BL.php?parameter=actualizadireccion",
                            data:{
                                txtdireccion:$("#direccion").val(),
                                idpais:$(this).parent().parent().children().children("#pa"+idaddress).attr("value"),
                                iddepartamento:$(this).parent().parent().children().children("#de"+idaddress).attr("value"),
                                iddistrito:$(this).parent().parent().children().children("#di"+idaddress).attr("value"),
                                idpersonacontacto:$("#idpersonacontacto").val()
                            },
                            success:function() {
                                $("#btnEditarDireccion").attr('value', 'Editar');
                    
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
            /** ESPECIALIDADES */
           // EDITAR ESPECIALIDAD
           $("#btnEditarES").live("click",function() {
                if ($(this).val() === 'Editar') {
                    $(this).attr('value', 'Guardar');
                    $("#divEditarEspecialidad").dialog("open");
                } else {
                    //var idespecialidadacambiar = $(this).parent().parent().children("#txtES").val();
                    //alert(data_newesp[0]);
                    //alert(data_newesp[1]);
                    var oldyespecialidad = $(this).parent().parent().children("#idES").val();
                    //$(this).parent().parent().children().children("#txtES").val(data_newesp[1]);
                    //alert(oldyespecialidad);
                    //setEspecialidadObj($(this).parent().parent().children().html());
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaPersona_BL.php?parameter=editaEspecialidad",
                        data:{
                            idespecialidadnueva:data_newesp[0],
                            idespecialidadactualizar:oldyespecialidad,
                            idpersonacontacto:$("#idpersonacontacto").val()
                        },
                        success:function() {
                            reload();
                        }
                    })
                }
           });
           $(".especialidad").live("click",function() {
               
               var especialidad_array = $(this).text().split("-");
               //$("#idES").val(especialidad_array[0]);
               //$("#txtES").val(especialidad_array[1]);
               nuevaEspecialidad(especialidad_array[0], especialidad_array[1])
           });
           function nuevaEspecialidad(id,desc){
               data_newesp[0]=id;
               data_newesp[1]=desc;
           }
           // ELIMINAR ESPECIALIDAD
           $("#btnEliminarES").live("click",function() {
               var idespecialidad = $("#idES").val();
               $(this).parent().parent().remove();
               $.ajax({
                   type:"POST",
                   url:"../../../bl/editaPersona_BL.php?parameter=eliminarEspecialidad",
                   data:{
                      idpersonacontacto:$("#idpersonacontacto").val(),
                      idespecialidad:idespecialidad
                   },
                   success:function() {
                       
                   }
               })
           })
           // AGREGAR ESPECIALIDAD
           $("#btnAgregarES").live("click",function() {
               $("#divEditarEspecialidadNuevo").dialog("open");
           });
           $(".especialidad_new").live("click",function() {
               var especialidad_array = $(this).text().split("-");
               $.ajax({
                   type:"POST",
                   data:{
                       idespecialidad:especialidad_array[0],
                       idpersonacontacto:$("#idpersonacontacto").val()
                   },
                   url:"../../../bl/editaPersona_BL.php?parameter=nuevaEspecialidad",
                   success:function() {
                       reload();
                   }
               })
           });
           
           /** OBSERVACION */
           $("#btnEditaObservacion").live("click",function() {
               if($("#btnEditaObservacion").val() === 'Editar'){
                   $("#btnEditaObservacion").attr('value', 'Guardar');
                   $("#txtobservacion").removeAttr('readonly');
               } else {
                   
                   $.ajax({
                       type:"POST",
                       url:"../../../bl/editaPersona_BL.php?parameter=editaObservacion",
                       data:{
                           observacion:$("#txtobservacion").val()
                       },
                       success:function() {
                           reload();
                       }
                   })
               }
           });
           /** EMAIL PRINCIPAL */ 
            $("#btnEditaEmail").live("click",function() {
                if($("#btnEditaEmail").val() === 'Editar'){
                   $("#btnEditaEmail").attr('value','Guardar'); 
                   $("#txtemailprincipal").removeAttr('readonly');
                } else {
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaPersona_BL.php?parameter=editEmail",
                        data:{
                            email:$("#txtemailprincipal").val(),
                            idpersonacontacto:$("#idpersonacontacto").val()
                        },
                        success:function() {
                            reload();
                        }
                    });
                }
            });
            /** EMAIL SECUNDARIO(S) */
            // EDITAR EMAIL SECUNDARIO
            $("#btnEditarMAIL").live("click",function() {
                if($(this).val() === 'Editar'){
                   $(this).attr('value','Guardar'); 
                   $(this).parent().parent().children().children("#txtMAIL").removeAttr('readonly');
                } else {
                    //alert($(this).parent().parent().children().children("#txtMAIL").attr('value'));
                    //alert($(this).parent().parent().children("#idMAIL").attr('value'));
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaPersona_BL.php?parameter=editEmailSecundario",
                        data:{
                            email:$(this).parent().parent().children().children("#txtMAIL").attr('value'),
                            idemail:$(this).parent().parent().children("#idMAIL").attr('value'),
                            idpersonacontacto:$("#idpersonacontacto").val()
                        },
                        success:function() {
                            reload();
                        }
                    });
                }
            });
            // ELIMINAR EMAIL SECUNDARIO
            $("#btnEliminarMAIL").live("click",function() {
                var id_email = $(this).parent().parent().children("#idMAIL").attr('value');
                $(this).parent().parent().remove();
                $.ajax({
                   type:"POST",
                   url:"../../../bl/editaPersona_BL.php?parameter=eliminaEmailSecundario",
                   data:{
                       idemail:id_email,
                       idpersonacontacto:$("#idpersonacontacto").val()
                   },
                   success:function() {
                       
                   }
                });
            });
            // CREAR NUEVO EMAIL SECUNDARIO
            $("#btnAgregarMAIL").live("click",function() {
                var mailsecundarionew = '<tr id="tr_mail"><td>'+
                                        '<input type="text" size="45" id="txtNewEmailSec"  />'+
                                        '<td><input type="button" value="Guardar" id="btnNuevoES"/></td>'+
                                        '<td><input type="button" value="Cancelar" id="btnCancelarES"/></td>'+
                                        '</td></tr>';
                                    $("#tr_mail").after(mailsecundarionew);
            });
            // GUARDAR NUEVO EMAIL SECUNDARIO
            $("#btnNuevoES").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{
                        newmail:$("#txtNewEmailSec").val(),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=guardarEmailSecundario",
                    success:function() {
                        reload();
                    }
                });
            });
            /** WEB */
            $("#btnEditarWeb").live("click",function() {
                var thisObj = $(this);
                if(thisObj.val() === 'Editar') {
                    thisObj.attr('value', 'Guardar');
                    $("#txtweb").removeAttr('readonly');
                } else {
                    $.ajax({
                        type:"POST",
                        data:{
                            newweb:$("#txtweb").val(),
                            idpersonacontacto:$("#idpersonacontacto").val()
                        },
                        url:"../../../bl/editaPersona_BL.php?parameter=editarWeb",
                        success:function() {
                            thisObj.attr('value', 'Editar'); 
                            $("#txtweb").attr('readonly', 'true');
                        }
                    })
                }
            })
            // FAX
            $("#btnEditarFax").live("click",function() {
                var thisObj = $(this);
                if (thisObj.val() === 'Editar') {
                    thisObj.attr('value', 'Guardar');
                    $("#txtfax").removeAttr('readonly');
                } else {
                    $.ajax({
                        type:"POST",
                        data:{
                            newfax:$("#txtfax").val(),
                            idpersonacontacto:$("#idpersonacontacto").val()
                        },
                        url:"../../../bl/editaPersona_BL.php?parameter=editarFax",
                        success:function() {
                            $("#txtfax").attr('readonly', 'true');
                            thisObj.attr('value', 'Editar');
                        }
                    });
                }
            })
            // VIA ENVIO
            $("#btnEditarViaEnvio").live("click",function() {
                var thisObj = $(this);
                if (thisObj.val() === "Editar") {
                    $("#viaenvio").removeAttr('disabled');
                    thisObj.attr('value', 'Guardar');
                } else {
                    $.ajax({
                       type:"POST",
                       url:"../../../bl/editaPersona_BL.php?parameter=editarViaEnvio",
                       data:{
                           new_viaenvio:$("#viaenvio").val(),
                           idpersonacontacto:$("#idpersonacontacto").val()
                       },
                       success:function() {
                           thisObj.attr('value', 'Editar');
                           $("#viaenvio").attr('disabled', 'true');
                       }
                    });
                }
            });
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
            
            // VIA ENVIO
            function cargarviaenvioseleccted(idviaenvio) {
                $.ajax({
                    dataType:"html",
                    data:{id_viaenvio:idviaenvio},
                    url:"../../../bl/Contacto/cargarViaEnvioSelected.php",
                    success:function(data){
                        $("#viaenvio").append(data);
                    }
                });
            }
            // MODAL PARA LA BUSQUEDA DE EMPRESA
            $("#divBuscarCompania").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Limpiar":function() {
                        recargarEmpresaSF();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            // MODAL PARA ESPECIALIDAD
            $("#divEditarEspecialidad").dialog({
                autoOpen:false,
                heigth:300,
                width:350,
                modal:true,
                buttons:{
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            $("#divEditarEspecialidadNuevo").dialog({
                autoOpen:false,
                heigth:300,
                width:350,
                modal:true,
                buttons:{
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
             // HTML
             function toHtml(data)
             {
                $("#tmp").html(data);  
             }
        });
        </script>
    </head>
    <body class="fondo">
        <!-- editar compania -->
        <div id="divBuscarCompania" title="Escoge una empresa"></div>
        <div id="divEditarEspecialidad" title="Escoge una especialidad"></div>
        <div id="divEditarEspecialidadNuevo" title="Escoge una especialidad nueva"></div>
        
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE PERSONA</h1>
            </div>
        </div>
        <div id="main">
            <h1>EDICION DE PERSONA | <?=$_SESSION['usr']?></h1>
            <hr/>
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
