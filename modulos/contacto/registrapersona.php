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
        <script>
        $(document).ready(function(){
            
            //$("#dialog:ui-dialog").dialog("destroy");
            $("#seleccionaEspecialidad").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                },
                close:function(){
                    allFields.val("").removeClass("ui-state-error");
                }
            });
            
            $("#agregarEspecialidad").click(function(){
                $("#seleccionaEspecialidad").dialog("open");
            })
             
            cargar_viasenvio();
            cargar_tipodireccion();
            
            cargar_paises();
            $("#paisid").change(function(){cargar_departamentos();})
            $("#departamentoid").change(function(){cargar_provincias();})
            $("#departamentoid").attr("disabled",true);
            $("#provinciaid").change(function(){cargar_distritos();})
            $("#provinciaid").attr("disabled",true);
            $("#distritoid").attr("disabled",true);
            
            /*
             * Ocultar al inicio
             */
            $("#seleccionaDireccion").css("display","none");
            $("#seleccionaEspecialidad").css("display","none");
            
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
             * LISTA DE DIRECCIONES EN SCROLL
             */
            $("#agregarRegistroDireccion").click(function() {
            return false;
        });
            
            /*
            * funciones javascript
            */
            function cargar_compania()
            {//falta implementar porque no hay datos ni script php
                $.get("../../bl/Contacto/cargarCompania.php",function(resultado){
                    $("#companiaseleccionada").append(resultado);
                });
            }
        });
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REGISTRO DE PERSONAS</h1>
            </div>
        </div>
        
        <div id="main">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><label>D.N.I/Carn&eacute; de extranjer&iacute;a:</label></td>
                        <td><input id="inputext" type="text" size="9" name="dni"</td>
                    </tr>
                    <tr>
                        <td><label>Nombres y Apellidos</label></td>
                        <td><input id="inputext" type="text" size="25" name="nombre"</td>
                    </tr>
                    <tr>
                        <td><label>Compania</label></td>
                        <td>
                            <select name="companiaseleccionada" id="companiaseleccionada">
                                <option value="0">Seleccione una compania</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Cargo</label></td>
                        <td><input id="inputext" type="text" size="25" name="cargo"</td>
                    </tr>
                    <tr>
                    <td><label for="telefono_fijo">Tel&eacute;fono Fijo:</label></td>
                    <td>
                        <table border="0" class="atable">
                            <tr>
                                <th></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <td><input type="text" size="15" name="telefonofijo" /></td>
                                <td><input type="button" class="addRow" value="+" /></td>
                                <td><input type="button" class="delRow" value="-" /></td>
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
                    <td><label for="telefono_movil">Tel&eacute;fono M&oacute;vill:</label></td>
                    <td>
                    <table>
                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <td><input type="text" size="15" name="telefonomovil" /></td>
                            <td><input type="button" class="addRow" value="+" /></td>
                            <td><input type="button" class="delRow" value="-" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tmovil" />
                    </table>

                </td>
                </tr>
                <tr>
                    <td><label for="telefono_nextel">Tel&eacute;fono Nextel:</label></td>
                    <td>
                        <table>
                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <td><input type="text" size="15" name="telefononextel" /></td>
                            <td><input type="button" class="addRow" value="+" /></td>
                            <td><input type="button" class="delRow" value="-" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tnextel" />
                    </table>
                    </td>
                </tr>
                <tr>
                    <td><label for="direccion">Direcci&oacute;n Personal:</label></td>
                    <td>
                        <input type="button" id="agregarDireccion" value="Agregar Direccion" />
                        <div id="seleccionaDireccion">
                            <table border="0" class="atable">
                                <tr>
                                    <td>
                                        <label>Tipo de Direcci&oacute;n</label>
                                        <select name="tipodireccionseleccionada" id="tipodireccionid" name="tipodir">
                                            <option value="0" name="td">Seleccionar tipo de direccion</option>
                                        </select>
                                    </td>
                                 <tr>   
                                    <td>
                                        <label>Direcci&oacute;n:</label>
                                        <input id="inputext" type="text" size="25" name="direccion" />
                                    </td>
                                 <tr>
                                     <td>
                                         <label>Pa&iacute;s</label>
                                         <select name="paisseleccionada" id="paisid">
                                             <option value="0">Seleccionar Pa&iacute;s</option>
                                         </select>
                                     </td>
                                 <tr>   
                                    <td>
                                        <label>Departamento:</label>
                                        <select name="departamentoseleccionada" id="departamentoid">
                                                <option value="0">Seleccionar departamento</option>
                                            </selected>
                                    </td>
                                 <tr>   
                                    <td>
                                        <label>Provincia:</label>
                                        <select name="provinciaseleccionada" id="provinciaid">
                                                <option value="0">Seleccione una provincia</option>
                                            </select>
                                    </td>
                                  <tr>  
                                    <td>
                                        <label>Distrito:</label>
                                        <select name="distritoseleccionada" id="distritoid">
                                                <option value="0">Seleccione un distrito</option>
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
                    <td><label for="especialidad">Especialidad:</label></td>
                    <td>
                        <input type="button" id="agregarEspecialidad" value="Agregar Especialidad" />
                        <div id="seleccionaEspecialidad" >
                            <table border="0" class="atable">
                                <tr>
                                    <th></th>
                                </tr>
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
                    </td>
                </tr>
                <tr>
                    <td><label>Observaci&oacute;n</label></td>
                    <td><textarea></textarea></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="email"</td>
                </tr>
                <tr>
                    <td><label for="web">Web:</label></td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="web" /></td>
                </tr>
                <tr>
                    <td><label for="fax">Fax:</label></td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="fax" /></td>
                </tr>
                <tr>
                    <td><label for="via_envio">V&iacute;a de Env&iacute;o:</label></td>
                    <td>
                        <select name="viaenvioseleccionada" id="viaenvioid">
                            <option value="0">Seleccione una V&iacute;a de Env&iacute;o</option> 
                        </select>
                    </td>
                </tr>
                </table>
            </form>
        </div>
    </body>
</html>