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
        <script>
        $(function(){
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
            })
            /*
             * eliminar elemento
             **/
            $("#del-contacto").live("click", function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            /*
             * ventana modal para seleccionar los contactos
             */
            
            
            /*
             * Elegir que o cuale son los contactos a seleccionar
             */
            $('input:checkbox[name=contacto[]]').click(function(){
                var id = $(this).val();
                //alert(id);
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
             * Agregar datos a los input
             */
            $('.cliente').click(function(){
                var cli = $(this).text()
                $(".cliente-text").val(cli);
            });
            
            $('.contratante').click(function(){
                var cli = $(this).text()
                $(".empresacontratante-text").val(cli);
            });
            
            $('.gerenteproyecto').click(function(){
                var cli = $(this).text()
                $(".empresagerente-text").val(cli);
            });
            
            $('.supervisorproyecto').click(function(){
                var cli = $(this).text()
                $(".empresasupervisora-text").val(cli);
            });
            
            $('.proveedorfacturar').click(function(){
                var cli = $(this).text()
                $(".proveedorfacturar-text").val(cli);
            });
            
            /*
             * Agregar datos a tabla
             */
            function resultados(datos)
            {
                $.each(datos,function(index,value){
                    $("#contactos-agregados tbody").append(
                    "<tr>"+
                    "<td>"+datos[index].id+"</td>" +
                    "<td>"+datos[index].descripcion+"</td>"+
                    "<td>"+"<a href='#' id='del-contacto' class='button delete'>Eliminar</a>"+"</td>"
                    +"</tr>"    
                    );
                })
            }
        })    
        </script>
        <style>
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
        
        <div id="modal-contactos" title="Seleccionar contactos">
            <form autocomplete="off">
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
                                foreach ($especialidades as &$valor) {
                                    echo '<input type="checkbox" name="contacto[]" value="'.
                                            $valor[0].
                                            '"/>'.
                                            $valor[1].
                                            '<br />';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
        
        <div id="main">
            <table>
                <tr>
                    <td><label>C&oacute;digo:</label></td>
                    <td><input id="inputext" type="text" size="15" name="codigo"/></td>
                    <td><label>Nombre:</label></td>
                    <td><input id="inputext" type="text" size="35" name="nombre"/></td>
                    <td><label>Fecha inicio obra</label><input id="datepicker_i" type="text" name="f_inicio" /></td>
                    <td><label>Fecha fin de obra</label><input id="datepicker_f" type="text" name="f_fin" /></td>
                </tr>
                <tr>
                    <td><label>Direcci&oacute;n</label></td>
                    <td><input type="text" id="inputext" size="30" name="direccion" /></td>
                </tr>
                <tr>
                    <td><label>Departamento</label></td>
                    <td><input type="text" id="inputext" size="30" name="departamento" /></td>
                    <td><label>Moneda</label></td>
                    <td><input type="text" id="inputext" size="30" name="moneda" /></td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td>Cliente:</td>
                    <td><input id="inputext" class="cliente-text" type="text" size="30" name="cliente" READONLY /><input id="agregar-cliente"type="button" value="..." /></td>
                </tr>
                <tr>
                    <td>Empresa Contratante:</td>
                    <td><input type="text" id="inputext" class="empresacontratante-text" size="30" name="empresa-contratante" READONLY/><input id="agregar-contratante" type="button" value="..." /></td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td>Empresa Gerente de proyecto:</td>
                    <td><input id="inputext" class="empresagerente-text" type="text" size="30" name="cliente" READONLY/><input id="agregar-gerenteproyecto" type="button" value="..." /></td>
                </tr>
                <tr>
                    <td>Empresa Supervisora de proyecto:</td>
                    <td><input type="text" class="empresasupervisora-text" id="inputext" size="30" name="empresa-contratante" READONLY/><input id="agregar-supervisorproyecto" type="button" value="..." /></td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td>Proveedor a facturar:</td>
                    <td><input type="text" class="proveedorfacturar-text" id="inputext" size="30" name="proveedor-a-facturar" READONLY/><input id="agregar-proveedorfacturar" type="button" value="..." /></td>
                </tr>
                
                <tr>
                    <td>Lista de cont&aacute;ctos:</td>
                    <td>
                        <input type="button" id="mostrarcontactos" value="Mostrar contactos" />
                        <div class="areaScrollModal" id="lista-contactos">
                            <table id="contactos-agregados">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Id</th>
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
            <fieldset>
                <legend>Parametros obras(para proveedores)</legend>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="" size="5"/>
                            </td>
                            <td>
                                <label>Porcentaje de la carta fianza fiel cumplimiento para Contratistas/Proveedores</label>
                                <input type="checkbox" />
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="" size="5"/>
                            </td>
                            <td>
                                <label>Dias habiles para el desembolso, despues de presentada la factura</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="" size="5"/>
                            </td>
                            <td>
                                <label>Porcentaje de fondo de retencion</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" name="" size="5"/>
                            </td>
                            <td>
                                <label>Dias habiles para la devolucion del fondo de retencion, contados a partir de la retencion de obra sin observaciones(Acta definitiva)</label>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td><label>Monto contratado mayor a:</label></td>
                            <td><input type="text" id="inputext" name="mayora" size="5"/></td>
                        </tr>
                        <tr>
                            <td><label>Monto contratado entre:</label></td>
                            <td><input type="text" id="inputext" name="mayora" size="5" READONLY/></td>
                            <td> y </td>
                            <td><input type="text" id="inputext" name="mayora" size="5" READONLY/></td>
                        </tr>
                        <tr>
                            <td><label>Monto contratado menor a:</label></td>
                            <td><input type="text" id="inputext" name="menor" size="5"/></td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <br />
            <fieldset>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td><label>Selecione modelo de carta de adjudicacion y condiciones generales</label></td>
                            <td><input type="text" size="45" id="inputext"/><input type="button" value="..." /></td>
                        </tr>
                        <tr>
                            <td><label>Selecione modelo de contrato</label></td>
                            <td><input type="text" size="45" id="inputext"/><input type="button" value="..." /></td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <div id="footer"><hr/></div>
        <input type="submit" id="submit" value="test" />
        </div>
        
    </body>
</html>