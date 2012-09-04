<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ERDICION DE PERSONA</title>
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
        function recargarEmpresa(filtro) 
        {
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro="+filtro);
        }
        
        function recargarEmpresaSF()
        {
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro=1");
        }
        
        $(document).ready(function() {
            /**
             * PRIMERA CARGA DE LA LISTA DE EMPRESAS
             */
            $("#divBuscarCompania").load("../../datosdeobra/modales/empcontratante_div.php?filtro=1");
            
            // BUSCAR CONTACTO A EDITAR
            $("#txtnombre").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoEmpresasPorContacto.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            
            function reload(){
                $.ajax({
                       type:"GET",
                       dataType:"html",
                       url:"../../../bl/Contacto/actualizaPersona.php",
                       data:{
                           nombre:$("#txtnombre").val()
                       },
                       success:function(data) {
                           toHtml(data);
                           cargarDireccionPersona($("#txtnombre").val());
                           cargarViaEnvio($("#idviaenvio").val());
                       }
               });
            }
            
            // BOTON PARA CARGAR DATOS DE CONTACTO A EDITAR
            $("#btnBuscar").click(function() {
                if ($("#txtnombre").val() === "")
                    alert("El campo esta vacio");
                else {
                    $.ajax({
                       type:"GET",
                       dataType:"html",
                       url:"../../../bl/Contacto/actualizaPersona.php",
                       data:{
                           nombre:$("#txtnombre").val()
                       },
                       success:function(data) {
                           toHtml(data);
                           cargarDireccionPersona($("#txtnombre").val());
                           cargarViaEnvio($("#idviaenvio").val());
                       }
                    });
                }
            });
            
            function cargarDireccionPersona(id_persona){
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{
                        idpersona:id_persona
                    },
                    url:"../../../dl/busca_persona/DireccionPersona.json.php",
                    success:function(data){
                        printAddress(data);
                    }
                })
            }
            
            function cargarViaEnvio(id_viaenvio) {
                cargarviaenvioseleccted(id_viaenvio);
                $("#idviaenvio tbody").append(
                    "<td><select disabled='disabled' id='viaenvio'><select></td>"+
                    "<td><input type='button' id='btnEditarViaEnvio'  value='Editar'/></td>"+
                    "<td><input type='button' class='delRow' id='btnEliminarViaEnvio' /></td>"+
                    "<td><input type='button' class='addRow' id='btnAgregarViaEnvio' /></td>"
                )
            }
            /*function cargarDireccionPersonaEmpresa(id_persona) {
                
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{
                        idpersona:id_persona
                    },
                    url:"../../../dl/busca_persona/DireccionPersonaEmpresa.json.php",
                    success:function(data) {
                        printAddressCo(data);
                    }
                })
            }*/
            
            function printAddress(data) {
                var i = 1;
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
                        "<td><input type='button' id='btnEditarDireccion'  value='Editar'/></td>"+
                        "<td><input type='button' class='delRow' id='btnEliminarDireccion' /></td>"+
                        "<td><input type='button' class='addRow' id='btnAgregarDireccion' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccionHidden' value='"+i+"' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccion"+i+"' value='"+data[index].id+"' /></td>"+
                        "</tr>"
                    ),
                    i++
                });
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
                                value:$(this).parent().parent().children().children('#txtTelefonoFijo').attr("value"),
                                idvalue:$(this).parent().parent().children('#idTFijo').attr("value"),
                                idpersonacontacto:$("#idpersonacontacto").val()
                           },
                           url:"../../../bl/editaPersona_BL.php?parameter=tf_actualiza",
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
            /** TELEFONO MOBILE*/
            //ACTUALIZA
            $("#btnEditarTM").live("click",function() {
                if($("#btnEditarTM").val() === "Editar") {
                    $("#txtTM").removeAttr("READONLY");
                    $("#btnEditarTM").attr("value","Guardar");
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
                               $("#txtTM").attr("READONLY",true);
                               $("#btnEditarTM").attr("value","Editar");
                               alertExito();
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
                        idvalue:$(this).parent().parent().children('#txtTM').attr("value"),
                        idpersonacontacto:$("#idpersonacontacto").val()
                    },
                    url:"../../../bl/editaPersona_BL.php?parameter=tm_elimina",
                    success:function() {
                        alertExito();
                        if (!$("#tr_tm").length)
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
            
            /*function printAddressCo(data) {
                var i = 1;
                $.each(data,function(index,value){
                    alert(data[index].idpais);
                    cargarPais(data[index].idpais,i)
                    cargarDepartamento(data[index].iddepartamento, i);
                    cargarDistrito(data[index].iddistrito, i);
                    cargarDomicilio(data[index].idtipodireccion, i)
                    $("#direccion_full_co tbody").append(
                        "<tr id='tbl_direccion'>"+
                        "<td><input type='text' id='direccion' value='"+data[index].direccion+"' READONLY/></td>"+
                        "<td><td><select disabled='disabled' id='pa"+i+"'></select></td></td>"+
                        "<td><td><select disabled='disabled' id='de"+i+"'></select></td>"+
                        "<td><td><select disabled='disabled' id='di"+i+"'></select></td>"+
                        "<td><td><select disabled='disabled' id='do"+i+"'></select></td>"+
                        "<td><input type='button' id='btnEditarDireccion'  value='Editar'/></td>"+
                        "<td><input type='button' class='delRow' id='btnEliminarDireccion' /></td>"+
                        "<td><input type='button' class='addRow' id='btnAgregarDireccion' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccionHidden' value='"+i+"' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccion"+i+"' value='"+data[index].direccion_id+"' /></td>"+
                        "</tr>"
                    ),
                    i++
                });
            }*/
            
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
                    url:"../../../bl/Contacto/cargarTipoDireccionSelected.php",
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
            
            function toHtml(data)
            {
                $("#tmp").html(data);  
            }
        });//end main
    </script>
    </head>
    <body class="fondo">
        <!-- editar compania -->
        <div id="divBuscarCompania" title="Escoge una empresa"></div>
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE PERSONA</h1>
            </div>
        </div>
        <div id="main">
            <h1>EDICION DE PERSONA | <?=$_SESSION['usr']?></h1>
            <label for="nombre">Escriba el nombre de la persona:</label>
            <div id="busqueda">
                <input type="text" size="30" name="txtnombre" id="txtnombre" placeholder="NOMBRE"/>
                <input type="button" value="Buscar" id="btnBuscar" />
            </div>
            <hr/>
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
