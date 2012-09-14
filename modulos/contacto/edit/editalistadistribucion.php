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
            // CARGA POR DEFECTO DE LISTA DE CONTACTOS
            $("#divAgregarContacto").load("../modal_registracompania/representantes_div_nocheckbox.php");
            
            // variable global que almacena el id de la lista
            var idListaDistribucion;
            /** AUTOCOMPLETAR POR NOMBRE DE LISTA */
            $(".txtnombre").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoListaDistribucionPorNombre.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            // RECARGA DE EDICION
            function reload()
            {
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
                });
            }
            
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
            
            //* EDITAR NOMBRE DE LISTA */
            $("#btnEditarNombreLista").live("click",function(){
                thisObj = $(this);
                if (thisObj.val() == 'Editar') {
                    thisObj.attr('value', 'Guardar');
                    $("#txtnombrelista").removeAttr('readonly');
                }
                else {
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaListaDistribucion_BL.php?parameter=editarnombrelista",
                        data:{
                            idlistadistribucion:$("#idlistadistribucion").val(),
                            nombrelista:$("#txtnombrelista").val()
                        },
                        success:function() {
                            $(".txtnombre").val($("#txtnombrelista").val());
                            $("#txtnombrelista").attr('readonly', 'true');
                            thisObj.attr('value','Editar');
                        }
                    });
                }
            });
            
            //* AGREGAR CONTACTOS  - ABRE MODAL*/
            $("#btnAgregarContacto").live("click",function() {
                $("#divAgregarContacto").dialog("open");
            });
            // MODAL AGREGAR CONTACTO - MODAL BY ITSELF
            $("#divAgregarContacto").dialog({
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
            // CLICK CONTACTO EN MODAL - AGREGAR A LA TABLA
            $(".contacto").live("click",function(){
                var contacto = $(this).text().split("-");
                $.ajax({
                    type:"POST",
                    url:"../../../bl/editaListaDistribucion_BL.php?parameter=agregacontacto",
                    data:{
                        idnewcontacto:contacto[0],
                        idlistadistribucion:$("#idlistadistribucion").val()
                    },
                    success:function() {
                        reload();
                    }
                })
            });
            // ELIMINAR CONTACTO
            $("#btnEliminarContacto").live("click",function() {
                var idcontactoeliminar = $(this).parent().parent().children("#idTContacto").attr('value')
                $(this).parent().parent().remove();
                $.ajax({
                    type:"POST",
                    url:"../../../bl/editaListaDistribucion_BL.php?parameter=eliminacontacto",
                    data:{
                        idcontactoeliminar:idcontactoeliminar,
                        idlistadistribucion:$("#idlistadistribucion").val()
                    }
                })
            });
            // EDITA OBSERVACION
            $("#btnEditarObservacion").live("click",function() {
                thisObj = $(this);
                if(thisObj.val() === 'Editar') {
                    thisObj.attr('value', 'Guardar');
                    $("#txtobservacion").removeAttr('readonly');
                } else {
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/editaListaDistribucion_BL.php?parameter=editaobs",
                        data:{
                            idlistadistribucion:$("#idlistadistribucion").val(),
                            observacion:$("#txtobservacion").val()
                        },
                        success:function(){
                            thisObj.attr('value','Editar');
                            $("#txtobservacion").attr('readonly', 'true');
                        }
                    });
                }
            });
            
            function toHtml(data)
            {
                $("#tmp").html(data);
            }
            
        })    
        </script>
    </head>
    <body class="fondo">
        <!-- agregar contacto -->
        <div id="divAgregarContacto" title="Escoge un contacto"></div>
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE LISTA DE DISTRIBUCION</h1>
            </div>
        </div>
        <div id="main">
            <label for="nombre">Escriba el nombre de la lista:</label>
            <div id="busqueda">
                <input type="text" size="50" name="txtnombre" class="txtnombre" placeholder="Nombre de la lista"/>
                <input type="button" value="Buscar" id="btnBuscar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </div>
            <hr />
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
