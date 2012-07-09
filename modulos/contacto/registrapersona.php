<?php
session_start();

$CSS_PATH = '../../css/';
$JS_PATH = '../../js/';

$css = array();
$js = array();

$css = scandir($CSS_PATH);
$js = scandir($JS_PATH);

function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

$especialidadContacto = new EspecialidadPersonaDL();
$especialidades = $especialidadContacto->mostrarEspecialidades();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRO DE PERSONAS</title>
        <!-- zona css -->
        
        <?php
        foreach ($css as $value) {
            if ($value === '.' || $value === '..') {continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />';
        }
        ?>
        <!--    ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/tfijo.js" type="text/javascript"></script>
        <script src="../../js/cargarDatos.js" type="text/javascript"></script>
        <script src="../../js/jquery.form.js" type="text/javascript"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script type="text/javascript">
        
        function recargarEspecialidades()
        {
            $("#seleccionaEspecialidad").load("modal_registracompania/especialidades_div.php");
        }
            
        $(document).ready(function(){
            
            /**
             * PRIMERA CARGA DE LA LISTA DE ESPECIALIDADES
             */
            $("#seleccionaEspecialidad").load("modal_registracompania/especialidades_div.php");
            
            var contador_especialidades = 0;
            var con_especia = 0;
            /*
             * MODAL PÁRA SELECCIONAR ESPECIALIDAD(ES)
             */
            $("#seleccionaEspecialidad").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Crear nueva especialidad":function(){
                        $("#divNuevaEspecialidad").dialog("open");
                    },
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
            });
            
            /*
             * Modal para crear una nueva especialidad
             */
            $.fx.speeds._default = 1000;
            $("#divNuevaEspecialidad").dialog({
                show:"blind",
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            /*
             * boton para abrir ventana modal PARA AGREGAR ESPECIALIDAD AL FORMULARIO PRINCIPAL
             */
            $("#agregarEspecialidad").click(function(e){
                e.preventDefault();
                $("#seleccionaEspecialidad").dialog("open");
            });
             
            /*
             * CREAR NUEVA ESPECIALIDAD 
             */ 
            $("#btnNuevaEspecialidad").click(function() {
                $("#divNuevaEspecialidad").dialog("open");
            });
             
            cargar_companias(); 
            cargar_viasenvio();
            cargar_tipodireccion();
            cargar_tipodocumento();
            
            cargar_paises();
            cargar_departamentos();
            cargar_distritos();
            
                    
            /*$("#paisid").change(function(){cargar_departamentos();})
            $("#departamentoid").change(function(){cargar_distritos();})
            $("#departamentoid").attr("disabled",true);
            $("#distritoid").attr("disabled",true);
            */
            /*
             * DIRECCION
             */
            $("#agregarDireccion").click(function(){
                if($(this).attr("value") == "Agregar Direccion"){
                    $(this).attr('value', 'Ocultar');
                    $("#seleccionaDireccion").fadeIn('slow');
                }else{
                    $(this).attr('value', 'Agregar Direccion');
                    $("#seleccionaDireccion").fadeOut('slow');
                }
            });
            
            /*
             * AJAX CREAR NUEVA ESPECIALIDAD
             */
            $("#btn-nuevaespecialidad").click(function(){
                var descripcion = $('.input-descripcion').attr('value');
                //alert(descripcion);
                $.ajax({
                    type:"POST",
                    url:'../../bl/Contacto/mantenimiento/especialidadcompania_crear.php',
                    data:"descripcion="+descripcion,
                    success:function() {
                        $("#divNuevaEspecialidad").dialog('close');
                        recargarEspecialidades();
                    }
                });
            });
            
            /*
             * LISTA DE DIRECCIONES EN SCROLL
             */
            $("#agregarRegistroDireccion").click(function() {
                return false;
            });
            
            /*
             * SI TIENE RUC MOSTRAR CAJA DE TEXTO PARA PODERLA INGRESAR
             * REGISTRARLO COMO EMPRESA TAMBIEN.
             * SI NO TIENE RUC SOLO REGISTRALO COMO CONTACTO.
             */
            $("input:radio[name=tieneruc]").click(function() {
                if ($(this).val() == "si") {
                    $(".td-ruc-checkbox").css("display","block");
                }
                else { 
                    $(".td-ruc-checkbox").css("display","none");
                }
            });
            
            /*
             * si es dni cambiar el size del input a 8 y solo permitir numero
             */
            $("#tipo-documento").change(function() {
                if($(this).find("option:selected").val() == "dni") {
                    $(".input-tipo-documento").attr("size",8);
                    $(".input-tipo-documento").keydown(function(event){
                        if(event.keyCode < 48 || event.keyCode > 57) {
                            return false;
                        }
                    });
                } else {
                    $(".input-tipo-documento").attr("size",10);
                }
            });
            
            /**
             * detectar seleccion en especialidad en base al click del checkbox
             * y agregar la descripcion a la lista que el usuario visualizará.
             */
            $('input:checkbox[name=contacto[]]s').click(function() {
                $.ajax({
                    data:{id:$(this).val()},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getEspecialidadPersona.php",
                    success:function(data) {
                        mostrarEspecialidadesScroll(data);
                    }
                });
            });
            
            $('input:checkbox[name=contacto[]]').change(function(){
                var ch = $(this).attr("checked");
                if(ch){
                    $.ajax({
                        data:{id:$(this).val()},
                        type:"GET",
                        dataType:"json",
                        url:"../../includes/query_repository/getEspecialidadPersona.php",
                        success:function(data) {
                            mostrarEspecialidadesScroll(data);
                        }
                    });
                }else{
                   $(this).attr('checked',false); 
                   removerEspecialidad();
                }
            });
                        
            /**
             * eliminar especialidad de la lista del scrollbar
             */
            $("#del-especialidad").live("click",function(e) {
                con_especia--;
                contador_especialidades--;
                e.preventDefault();
                $(this).parent().parent().remove();
            })
            
            /**
             * lista de especialidades seleccionadas y
             * agregadas al scrollbar
             */
            function mostrarEspecialidadesScroll(data)
            {
                con_especia++;
                contador_especialidades++;
                $.each(data,function(index,value){
                    $("#tbl-listaespecialidades tbody").append(
                    "<tr>"+
                    "<td>"+data[index].descripcion+"</td>"+
                    "<td>"+"<a href='#' id='del-especialidad' class='button delete'>Eliminar</a>"+"</td>"+
                    '<input type="hidden" name="especialidad'+contador_especialidades+'" value="'+data[index].id+'"/>'+
                    "</tr>"
                    );
                });
            }
            
            $("#submit").click(function() {
                var valor_oculto_especialidadess = $('<input type="hidden" name="cont_especialidades" value="'+con_especia+'" />');
                valor_oculto_especialidadess.appendTo("#cant_especialidades");
                /**
                 *  VALIDACIONES PRE FORM
                 */
                if ($("#cmb_tipodocumento").val() == 0) {
                    alert("Escoja un Tipo de documento");
                    return false;
                }
                
                if ($("#companiaseleccionada").val() == 0) {
                    alert("Escoja una Compa\xf1 \xeda");
                    return false;
                }
                
                if ($("#viaenvioid").val() == 0) {
                    alert("Escoja una V\xeda de env\xedo");
                    return false;
                }
                
                if (!$("input").is(':checked')) {
                    alert("Tiene RUC no ha sido precisado. Marque una opcion por favor.");
                    return false;
                }
                
                if ((".direccion_lbl").val() =="") {
                    alert("NO ha especificado la direccion");
                    return false;
                }
            })
            
              /**
             * AUTOCOMPLETAR SEGUN NOMBRE DE LA PERSONA
             */
            $(".nombre_persona").autocomplete("../../bl/Contacto/mantenimiento/autocompletadoEmpresasPorContacto.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            
            /**
             * AUTOCOMPLETAR SEGUN NOMBRE DE LA EMPRESA
             */
            $(".nombre_empresa").autocomplete("../../bl/Contacto/mantenimiento/autocompletadoEmpresas.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });  
        });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                var options = {
                    success:muestraRespuesta
                    //clearForm:true
                };
                $("#frm-regpersona").ajaxForm(options);
            });
            
            function muestraRespuesta(responseText, statusText, xhr, $form) {
                alert("Los datos han sido ingresados correctamente");
                window.setTimeout('location.reload()',1000);
            }
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REGISTRO DE PERSONAS</h1>
            </div>
        </div>
        
        <div id="main">
            <form action="../../bl/busca_persona/registraPersona_BL.php" method="POST" id="frm-regpersona">
                
                <div class="info">
                Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
                </div>
                <table>
                    <tr>
                        <td><label>Tipo documento:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td>
                            <!-- VALIDAR -->
                            <select id="cmb_tipodocumento" name="tipo-documento">
                                <option value="0">Seleccionar tipo de documento</option>
                            </select>
                         <td>
                             <input  class="input-tipo-documento" size="8" type="text" name="numero-documento" id="inputext" required/>
                    </tr>
                    <tr>
                        <td><label>¿Tiene RUC?<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label>
                        <td>
                            <input type="radio" name="tieneruc" value="si">Si<br>
                            <input type="radio" name="tieneruc" value="no">No<br>
                            <td class="td-ruc-checkbox" style="display: none"><input placeholder="RUC" type="text" id="inputext" name="ruc"/>
                    <tr>
                        <td><label>Nombres y Apellidos:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td><input class="nombre_persona" id="inputext" type="text" size="25" name="nombre"</td>
                    </tr>
                    <tr>
                        <td>
                            <label>Compania:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td>
                            <select name="companiaseleccionada" id="companiaseleccionada">
                                <option value="0">Seleccione una compania</option>
                            </select>
                        </td>
                    </tr>
                        <td><label>Cargo:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td><input id="inputext" type="text" size="25" name="cargo"</td>
                    </tr>
                    <tr>
                    <td><label for="telefono_fijo">Tel&eacute;fono Fijo:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <table border="0" class="atable">
                            <tr>
                                <th></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <td><input type="text" size="15" name="telefonofijo" /></td>
                                <td><input type="button" class="addRow" /></td>
                                <td><input type="button" class="delRow" /></td>
                            </tr>
                            <input type="hidden" class="rowCount" name="filas_tfijo" />
                        </table>
                        <script type="text/javascript">
                        (function($){
                            $(document).ready(function(){
                                $(".addRow").btnAddRow({displayRowCountTo:"rowCount"});
                                $(".delRow").btnDelRow();
                            });
                        })(jQuery);
                        </script>
                    </td>
                </tr>
                <tr>
                    <td><label for="telefono_movil">Tel&eacute;fono M&oacute;vil:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                    <table>
                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <td><input type="text" size="15" name="telefonomovil" /></td>
                            <td><input type="button" class="addRow" /></td>
                            <td><input type="button" class="delRow" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tmovil" />
                    </table>

                </td>
                </tr>
                <tr>
                    <td><label for="telefono_nextel">Tel&eacute;fono Nextel:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <table>
                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <td><input type="text" size="15" name="telefononextel" /></td>
                            <td><input type="button" class="addRow" /></td>
                            <td><input type="button" class="delRow" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tnextel" />
                    </table>
                    </td>
                </tr>
                <tr>
                    <td><label for="direccion">Direcci&oacute;n Personal:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <input type="button" id="agregarDireccion" value="Agregar Direccion" class="ui-button ui-widget ui-state-default ui-corner-all" />
                        <div id="seleccionaDireccion" style="display:none">
                            <table border="0" class="atable">
                                 <tr>   
                                     <td class="tr-padding">
                                        <label>Direcci&oacute;n:</label>
                                        <input class="direccion_lbl" id="inputext" type="text" size="25" name="direccion" />
                                    </td>
                                 <tr>
                                     <td class="tr-padding">
                                         <label>Pa&iacute;s</label>
                                         <select class="derecha-inline" name="paisseleccionada" id="paisid">
<!--                                             <option value="0">Seleccionar Pa&iacute;s</option>-->
                                         </select>
                                     </td>
                                 <tr>   
                                    <td class="tr-padding">
                                        <label>Departamento/Estado:</label>
                                        <select class="derecha-inline" name="departamentoseleccionada" id="departamentoid">
<!--                                                <option value="0">Seleccionar departamento</option>-->
                                            </selected>
                                    </td>
                                 <tr>   
                                  <tr>  
                                    <td class="tr-padding">
                                        <label>Distrito:</label>
                                        <select class="derecha-inline" name="distritoseleccionada" id="distritoid">
<!--                                                <option value="0">Seleccione un distrito</option>-->
                                            </select>
                                    </td>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label>Direcci&oacute;n del centro de trabajo:</label>
                </tr>
                <tr>
                    <td><label for="especialidad">Especialidad:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <input type="button" id="agregarEspecialidad" value="Agregar Especialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        <div id="seleccionaEspecialidad" title="Agregar Especialidad" style="display: none" ></div>
                    </td>
                    
                    <div id="divNuevaEspecialidad" title="Crear nueva especialidad" style="display: none">
                        <label>Especialidad:</label>
                        <input id="inputext" class="input-descripcion" type="text" />
                        <input id="btn-nuevaespecialidad" type="button" value="Crear" />
                    </div> 
                </tr>
                <tr>
                    <td><label>Lista de especialidades:</label></td>
                    <td>
                        <div class="areaScrollModal" id="lista-especialidades">
                            <table id="tbl-listaespecialidades" class="ui-widget">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>    
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label>Observaci&oacute;n</label></td>
                    <td><textarea name="observacion"></textarea></td>
                </tr>
                <tr>
                    <td><label for="email">Email principal:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" type="email" size="30" placeholder="" name="email"</td>
                </tr>
                <tr>
                    <td><label>Email secundario(s):</label>
                    <td>
                        <table border="0" class="atable">
                            <tr>
                                <th>
                                <th colspan="2">
                            </tr>
                            <tr>
                                <td class="atable"><input type="text" size="15" size="50" name="emailsecundario" />
                                <td><input type="button" class="addRow" />
                                <td><input type="button" class="delRow" />
                            </tr>
                            <input type="hidden" class="rowCount" name="filas_emailsecundario" />   
                        </table>
                       
                <tr>
                    <td><label for="web">Web:</label></td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="web" /></td>
                </tr>
                <tr>
                    <td><label for="fax">Fax:</label></td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="fax" /></td>
                </tr>
                <tr>
                    <td><label for="via_envio">V&iacute;a de Env&iacute;o:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td>
                        <select name="viaenvioseleccionada" id="viaenvioid">
                            <option value="0">Seleccione una V&iacute;a de Env&iacute;o</option> 
                        </select>
                    </td>
                </tr>
                </table>
                <!-- VALORES OCULTOS -->
                <div id="cant_especialidades"></div>
                <div id="footer">
            <hr />
        </div>
        <input type="submit" id="submit" value="test" />
            </form>
        </div>
        
    </body>
</html>