<?php
$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

$especialidadCompania = new EspecialidadCompaniaDL();
$especialidades = $especialidadCompania->mostrarEspecialidades();

$clienteCompania = new CompaniaContactoDL();
$clientes = $clienteCompania->mostrarCompaniaContacto();
$empresa_contacto = $clienteCompania->mostrarEmpresaContacto();

$contactoPersona = new ContactoPersona();
$contactos = $contactoPersona->mostrarContactos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRAR DATOS DE OBRA</title>
        <?php
        foreach($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }
        ?>
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/calendar/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/calendar/jquery.ui.datepicker-es.js" type="text/javascript"></script>
        <script src="../../js/cargarDatos.js" type="text/javascript"></script>
        <script src="../../js/jquery-tooltip/js/jtip.js" type="text/javascript"></script>
        <link href="../../js/jquery-tooltip/css/global.css" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dijit/themes/claro/claro.css">
     <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" data-dojo-config="async:true"></script>
        <script>
        $(function(){
            /**
             * dojo floating
             */
           
            
            /**
             * CONTADOR PARA LOS CONTACTOS
             */
            var contador_contactos = 0;
            var contador_firmas = 0;
            var contador_puesto = 0;
            var contador_contacto = 0;
            var Contador_empresa = 0;
            
            $("#datepicker_i,#datepicker_f").datepicker({dateFormat:'yy-mm-dd'},{showAnim:'fold'});
            
            /*
             * MODALES
             */            
            $("#mostrarcontactos").click(function(){
                $("#modal-contactos").dialog("open");
                return false;
            });
            
            $("#modal-contactos").dialog({
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
            
            $("#agregar-cliente").click(function() {
                $("#modal-cliente").dialog("open");
                return false;
            })
            
            $("#modal-cliente").dialog({
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
            
            $("#agregar-contratante").click(function() {
                $("#modal-contratante").dialog("open");
                return false;
            })
            
            $("#modal-contratante").dialog({
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
            
            $("#agregar-gerenteproyecto").click(function() {
                $("#modal-gerenteproyecto").dialog("open");
                return false;
            })
            
            $("#modal-gerenteproyecto").dialog({
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
            
            $("#agregar-supervisorproyecto").click(function() {
                $("#modal-supervisorproyecto").dialog("open");
                return false;
            })
            
            $("#modal-supervisorproyecto").dialog({
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
            
            $("#agregar-proveedorfacturar").click(function() {
                $("#modal-proveedorfacturar").dialog("open");
                return false;
            })
            
            $("#modal-proveedorfacturar").dialog({
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
            
            /**
             * MODAL PRESUPUESTO VENTA
             */
            $("#btn-parametrospptoventa").click(function(){
                $("#div-modal-pptoventa").dialog("open");
                return false;
            }); 
            $("#div-modal-pptoventa").dialog({
                autoOpen:false,
                heigh:900,
                width:450,
                modal:true,
                buttons:{
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            }); 
            
            /**
             * MODAL ASIGNAR USUARIOS PARA APROBACION
             */
             $("#usuarios-aprobacion").click(function(){
                $("#div-modal-asigna_aprobacion").dialog("open");
                return false;
             });
             $("#div-modal-asigna_aprobacion").dialog({
                 autoOpen:false,
                 heigh:900,
                 width:450,
                 modal:true,
                 buttons:{
                     "Cerrar":function(){
                         $(this).dialog("close");
                     }
                 }
             })
            
            /**
             * MODAL ASIGNAR FIRMAS (1)
             */
             $("#btn-asignarfirmasreportes").click(function(){
                $("#div-firmas-1").dialog("open");
                return false;
             });
             $("#div-firmas-1").dialog({
                 autoOpen:false,
                 height:300,
                 width:450,
                 modal:true,
                 buttons:{
                     "Asignar firmas a reportes ":function(){
                         $("#div-firmas-reportes").dialog("open");
                     },
                     "Agregar contactos":function(){
                         $("#div-addcontactos").dialog("open");
                     },
                     "Cerrar":function(){
                         $(this).dialog("close");
                     }
                 }
             });
             
             $("#div-addcontactos").dialog({
                show:"blind",
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
             });   

            /**
            * AGREGAR CONTACTO PARA LAS FIRMAS
            * POR NOMBRE DE CONTACTO
            */
             $("#btn-addContacto").click(function(){
                $("#modal-addContacto").dialog("open");
                return false;
            });
            
            $("#modal-addContacto").dialog({
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
            
            /**
             * OBTENER DATO DEL MODAL HIJO Y PASARLO AL INPUT PADRE
             */
             $(".contactofirma").click(function(){
                var data_array = $(this).text().split("-");
                var persona = data_array[1];
                var empresa = data_array[0];
                $(".txt-contacto").val(persona);
                $(".txt-compania").val(empresa);
             });
             
             /**
              * OBTENER LOS 3 DATOS DELPADRE(AHORA HIJO) Y PASARLO A SU PADRE
              */
             $("#btn-agregarContacto").click(function(){
                 if ($(".txt-puesto").val() == ""){
                     alert("¡No has ingresado el puesto del contacto!");
                     $(".txt-puesto").focus();
                     return false;
                 }
                 
                 if ($(".txt-contacto").val() == "" || $(".txt-compania").val() == ""){
                     alert("¡No has seleccionado contacto alguno!");
                     $(".txt-contacto").focus();
                     return false;
                 }
                 
                 
                contador_firmas++; //fixed bug, not my bug, desktop bug
                /*
                 * TODO: Obtener los ID
                 * OBTENER LOS ID DE LOS DATOS PARA EL SISTEMA
                 */
                
                /*
                 * OBTENER LOS VALORES PARA EL USUARIO
                 */
                var puesto = $(".txt-puesto").val();
                var contacto = $(".txt-contacto").val();
                var empresa = $(".txt-compania").val();
                
                /*
                 * AGREGAR A SCROLL
                 */
                $("#tbl-firmas1 tbody").append(
                    "<tr name=\"firmas\">"+
                    '<td name="puesto'+contador_firmas+'" id="id-puesto">'+puesto+'</td>'+
                    '<td name="contacto'+contador_firmas+'">'+contacto+"</td>"+
                    '<td name="empresa'+contador_firmas+'">'+empresa+"</td>"+
                    '<td>'+'<a href="#" id="del-firma" class="button delete">Eliminar</a>'+'</td>'+
                    "</tr>"    
                );
                return false;    
             });
             
             /**
              * botón de eliminar firma
              */
             $("#del-firma").live("click",function(e){
                 e.preventDefault();
                 contador_firmas--;
                 $(this).parent().parent().remove();
             })
             
             $("#id-puesto").live("click",function(e){
                 alert($(this).html());
             })
             
            /**
             * CARGA DE DATA PARA COMBOS DEL FOMRULARIO
             */
            cargar_departamentos_peru();
            cargar_monedas();
            cargar_tipovalorizacion();
            cargar_formatopresupuesto();
            
            /*
             * SELECCIONAR Y AGREGAR CONTACTOS PARA DATOS DE OBRA
             */
            $('input:checkbox[name=contacto[]]').click(function(){
                var id = $(this).val();
                $.ajax({
                    data:{id:id},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getAllContacto.php",
                    success:function(data) {
                        resultados(data);
                    }
                });
            });
            
            /*
             * AGREGAR DATOS DE CONTACTOS A TABLA
             */
            function resultados(datos)
            {
                contador_contactos++;
                $.each(datos,function(index,value){
                    $("#contactos-agregados tbody").append(
                    "<tr>"+
                    "<td>"+datos[index].nombre+"</td>"+
                    "<td>"+"<a href='#' id='del-contacto' class='button delete'>Eliminar</a>"+"</td>"+
                    '<input type="hidden" name="contacto'+contador_contactos+'" value="'+datos[index].id+'" />'+
                    "</tr>"    
                    );
                });
            }
            
            /*
             * ELIMINAR CONTACTO DE TABLA
             **/
            $("#del-contacto").live("click", function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            
            /*
             * Agregar datos a los input
             */
            $('.cliente').click(function(){
                var cliente_array = $(this).text().split("-");
                var cli = cliente_array[1];
                var id_cliente =  cliente_array[0];
                $(".cliente-text").val(cli);
                $(".cliente-id").val(id_cliente);
            });
            
            $('.contratante').click(function(){
                var contratante_array = $(this).text().split("-");
                var cli = contratante_array[1];
                var contratante_id = contratante_array[0];
                $(".empresacontratante-text").val(cli);
                $(".contratante_id").val(contratante_id);
            });
            
            $('.gerenteproyecto').click(function(){
                var gerente_array = $(this).text().split("-");
                var cli = gerente_array[1];
                var gerente_id = gerente_array[0];
                $(".empresagerente-text").val(cli);
                $(".gerente_id").val(gerente_id);
            });
            
            $('.supervisorproyecto').click(function(){
                var supervisor_array = $(this).text().split("-");
                var cli = supervisor_array[1];
                var supervisor_id = supervisor_array[0];
                $(".empresasupervisora-text").val(cli);
                $(".supervisor_id").val(supervisor_id);
            });
            
            $('.proveedorfacturar').click(function(){
                var proveedor_array = $(this).text().split("-");
                var cli = proveedor_array[1];
                var proveedor_id = proveedor_array[0];
                $(".proveedorfacturar-text").val(cli);
                $(".proveedor_id").val(proveedor_id);
            });
            
            
        })    
        </script>
        <style>
            #inner-textfield-modal{padding: 5px 5px 5px 5px;}
            #inner-textfield{padding: 25px 25px 25px 25px;}
            #hr{padding-top: 10px;padding-bottom: 15px;}
        </style>
    </head>
    <body class="fondo">
        <div id="barra-superior"><div id="barra-superior-dentro"><h1 id="titulo_barra">REGISTRO DE DATOS DE OBRA</h1></div></div>
        
        <!--VENTANA MODAL PARA SELECCIONAR LOS CONTACTOS-->
        <?php include_once 'modales/cliente-modal.php';?>
        <?php include_once 'modales/modal-contratante.php';?>
        <?php include_once 'modales/modal-gerenteproyecto.php';?>
        <?php include_once 'modales/modal-supervisorproyecto.php';?>
        <?php include_once 'modales/modal-proveedorfacturar.php';?>
        <?php include_once 'modales/modal-addContacto.php';?>
        
        <div id="modal-contactos" title="Seleccionar contactos">
                <div class="" >
                    <table id="contactos" style="width:550px;height250px" 
                           url=""
                           toolbar="toolbar"
                           rownumber="true"
                           borde="0">
                        <thead>
                            <tr>
                                <th field="nombre">Nombre</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <?php
                                foreach ($contactos as &$valor) {
                                    echo '<input type="checkbox" name="contacto[]" value="'.
                                            $valor[0].
                                            '"/>'.
                                            strtoupper($valor[3]).
                                            '<br />';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
        
        <!--VENTANA MODAL PARA SETEO DEL PRESUPUESTO DE VENTA-->
        <div style="display: none" id="div-modal-pptoventa" title="Seteo Presupuesto Venta">
            <div class="">
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <td><label>Tipo de valorizaci&oacute;n</label></td>
                                <td>
                                    <select name="cmb_tipovalorizacion-name" id="cmb_tipovalorizacion">
                                        <option value="0">Seleccionar tipo de valorizaci&oacute;n</option> 
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <td><label>Formato presupuesto</label></td>
                                <td>
                                    <select name="cmb_formatopresupuesto-name" id="cmb_formatopresupuesto">
                                        <option value="0">Seleccionar formato de presupuesto</option> 
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Factor de correcci&oacute;n</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-factorcorreccion" /></td>
                            </tr>
                            <tr>
                                <td><label>Retenci&oacute;n Fondo de Garant&iacute;a</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-retenciongarantia" />&#37;</td>
                            </tr>
                            <tr>
                                <td><label>Retenci&oacute;n Fiel Cumplimiento</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-retencioncumplimiento" />&#37;</td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                        <legend>Presupuesto Contractual</legend>
                        <div id="inner-textfield-modal">
                        <table>    
                        <tr>
                            <td><label>Gasto General</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-gastogeneral_gg" />&#37;<td>
                        </tr>
                        <tr>
                            <td><label>Utilidad</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-utilidad_gg" />&#37;</td>
                        </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                        <legend>Presupuesto con &oacute;rdenes de cambio</legend>
                        <div id="inner-textfield-modal">
                        <table>
                        <tr>
                            <td><label>Gasto General</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-gastogeneral_oc" />&#37;</td>
                        </tr>
                        <tr>
                            <td><label>Utilidad</label></td>
                            <td><input size="5" type="text" id="inputext" name="tx-utilidad_oc" />&#37;</td>
                        </tr>
                        </table>
                    </div>
                </fieldset>
            </div>    
        </div>
        
        <!--VENTANA MODAL PARA ASIGNAR LAS FIRMAS A LOS REPORTES-->
        <div style="display: none" id="div-firmas-1" title="Firmas">
            <table id="tbl-firmas1">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Puesto</th>
                        <th>Contacto</th>
                        <th>Compa&ncaron;&iacute;a</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
        
        <!-- VENTANA MODAL PARA ASIGNAR USUARIOS PARA APROBACION -->
        <div style="display: none" id="div-modal-asigna_aprobacion" title="Usuarios acr&eacute;ditados">
            <table>
                <thead>
                    <th>
                    <th>
                    <th>    
                </thead>
                <tbody>
                    <tr>
                        <td><input type="button" id="btn-asign-selecciona" value="Seleccionar usuarios" class="ui-button ui-widget ui-state-default ui-corner-all" /></td>
                        <td><input type="button" id="btn-asign-elimina" value="Eliminar usuarios" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                        <td><input type="button" id="btn-asign-elimina" value="Asignar opciones" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table>
                <thead>
                    <tr class="ui-widget-header">
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Id</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- AGREGAR CONTACTOS DE MANERA DISTINTA A LA VERSION DESKTOP-->
        <!-- ESTO PORQUE EXISTEN ERRORES EN LA DESKTOP-->
        <div style="display: none" id="div-addcontactos" title="Contactos">
            <table border="0" class="atable">
                <tr>
                    <td class="tr-padding">
                        <label>Puesto</label>
                        <input type="text" class="txt-puesto" id="inputext" name="posicion" />
               <tr>
                    <td class="tr-padding">
                        <label>Contacto</label>
                        <input type="text" size="30" class="txt-contacto" id="inputext" name="contacto" READONLY />
                        <input type="button" id="btn-addContacto" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/>
               <tr>
                    <td class="tr-padding">
                        <label>Compa&nacute;&iacute;a</label>
                        <input type="text" size="30" class="txt-compania" id="inputext" name="compania" READONLY />
                        
               <tr>
                   <td class="tr-padding">
                       <input type="button" id="btn-agregarContacto" class="ui-button ui-widget ui-state-default ui-corner-all" value="Agregar" />
            </table>
            
        </div>
        
        <div style="display: none" id="div-firmas-reportes" title="Reportes">
            
        </div>
        
        <form action="datosdeobratest.php" method="POST">
           
        <div id="main">
             <div class="info">
            Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
            </div>
            <table>
                <tr>
                    <td><label>C&oacute;digo:</label></td>
                    <td><input id="inputext" type="text" size="15" name="codigo" /><span class="formInfo"><a href="../../js/jquery-tooltip/ajax.htm" class="jTip" id="one" name="El codigo debe tener el siguiente formato">?</a></span></td>
                    <td><label>Nombre:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" type="text" size="35" name="nombre"/></td>
                    <td><label>Fecha inicio obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input id="datepicker_f" type="text" name="f_inicio" /></td>
                    <td><label>Fecha fin de obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input id="datepicker_f" type="text" name="f_fin" /></td>
                </tr>
                <tr>
                    <td><label>Direcci&oacute;n de la obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" id="inputext" size="30" name="direccion" /></td>
                </tr>
                <tr>
                    <td><label>Departamento:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <select name="departamento" id="departamento-peru">
                            <option value="0">Seleccionar departamento</option> 
                        </select>
                    </td>
                    <td><label>Moneda:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <select name="moneda" id="moneda-id">
                            <option value="0">Seleccionar moneda</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <!-- tb_companiacontacta -->
                    <td><label>Cliente:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" class="cliente-text" type="text" size="30" name="cliente" READONLY /><input id="agregar-cliente"type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="cliente-id" name="cliente--id"</td>
                </tr>
                <tr>
                    <td><label>Empresa Contratante:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" id="inputext" class="empresacontratante-text" size="30" name="empresa-contratante" READONLY/><input id="agregar-contratante" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="contratante_id" name="contratante--id" /></td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td><label>Empresa Gerente de proyecto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" class="empresagerente-text" type="text" size="30" name="gerente-proyecto" READONLY/><input id="agregar-gerenteproyecto" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="gerente_id" name="gerente--id" /></td>
                </tr>
                <tr>
                    <td><label>Empresa Supervisora de proyecto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" class="empresasupervisora-text" id="inputext" size="30" name="supervisora-proyecto" READONLY/><input id="agregar-supervisorproyecto" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <input type="hidden" class="supervisor_id" name="supervisor--id" />
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
<!--                <tr>
                    <td><label>Asignar firmas a reportes:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="btn-asignarfirmasreportes" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>-->
                
                <tr>
                    <td><label>Par&aacute;metros Ppto. de ventas:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="btn-parametrospptoventa" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>
                <tr>
                    <td><label>Usuarios para aprobaci&oacute;n:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="usuarios-aprobacion" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td><label>Proveedor facturar a:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" class="proveedorfacturar-text" id="inputext" size="30" name="proveedor-a-facturar" READONLY/><input id="agregar-proveedorfacturar" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <input type="hidden" class="proveedor_id" name="proveedor--id" />
                </tr>
                
                <tr>
                    <td>Lista de cont&aacute;ctos:</td>
                    <td>
                        <input type="button" id="mostrarcontactos" value="Buscar contactos" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        <div class="areaScrollModal" id="lista-contactos">
                            <table id="contactos-agregados">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
            <br />
            <hr />
            <table>
                <tr>
                    <td><label>Asignar firmas a reportes:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="btn-asignarfirmasreportes" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>
            </table>
            <br />
            <hr/>
            <fieldset>
                <legend>Par&aacute;metros obras(para proveedores)</legend>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="carta-fianza" size="5"/>
                            </td>
                            <td>
                                <p>Porcentaje de la carta fianza fiel cumplimiento para Contratistas/Proveedores<input name="porcentage_fielcumplimiento" type="checkbox" /></p>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="dias-desembolso" size="5"/>
                            </td>
                            <td>
                                <p>Dias habiles para el desembolso, despues de presentada la factura</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="fondo-retencion" size="5"/>
                            </td>
                            <td>
                                <p>Porcentaje de fondo de retencion</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="dias-devolucion-fondoretencion" size="5"/>
                            </td>
                            <td>
                                <p>Dias habiles para la devolucion del fondo de retencion, contados a partir de la retencion de obra sin observaciones(Acta definitiva)</p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td><p>Monto contratado mayor a:</p></td>
                            <td><input type="text" id="inputext" name="mayor-a" size="5"/></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_mayora"/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_mayora"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_mayora"/>Contrato</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Monto contratado entre:</p></td>
                            <td><input type="text" id="inputext" name="entre-a" size="5" READONLY/></td>
                            <td> y </td>
                            <td><input type="text" id="inputext" name="entre-b" size="5" READONLY/></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_entre"/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_entre"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_entre"/>Contrato</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Monto contratado menor a:</p></td>
                            <td><input type="text" id="inputext" name="menor-a" size="5"/></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_menora"/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_menora"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_menora"/>Contrato</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <br />
            <fieldset>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td><p>Selecione modelo de carta de adjudicacion y condiciones generales</p></td>
                            <td><input type="text" size="45" id="inputext"/><input type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td><p>Selecione modelo de contrato</p></td>
                            <td><input type="text" size="45" id="inputext"/><input type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <div id="footer"><hr/></div>
        <input type="submit" id="submit" value="test" />
        </div>
        </form>
    </body>
</html>