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
        <script src="../../js/tfijo.js" type="text/javascript"></script>
        <script src="../../js/cargarDatos.js" type="text/javascript"></script>
        <script>
        $(document).ready(function(){
            var contador = 1;
            var counter_strike = 0;
            
            $("#del-direccion").live("click",function(e) {
                e.preventDefault();
                counter_strike--;
                $(this).parent().parent().remove();
            })
            
            
            $("#seleccionaDireccion").css("display","none");
            $("#seleccionaEspecialidad").css("display","none");
            cargar_viasenvio();
            cargar_tipodireccion();
            
            cargar_departamentos();
            $("#departamentoid").change(function(){cargar_provincias();})
            $("#provinciaid").change(function(){cargar_distritos();})
            $("#provinciaid").attr("disabled",true);
            $("#distritoid").attr("disabled",true);
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
            //contador para saber cuantas direcciones existen
            counter_strike++;
            //OBTENEMOS LOS ID DE LOS VALORES SELECCIONADOS EN EL COMBOBOX
            var tipodireccion_id = $('#tipodireccionid option:selected').val();
            var departamento_id = $('#departamentoid option:selected').val();
            var provincia_id = $('#provinciaid option:selected').val();
            var distrito_id = $('#distritoid option:selected').val();
            
            //OBTENEMOS LOS VALORES A MOSTRAR DE LOS DATOS ELEGIDOS EN EL COMBOBX
            var tipodireccion_value = $('#tipodireccionid option:selected').html();
            var direccion_value = $('#direccion_text').val();
            var departamento_value = $('#departamentoid option:selected').html();
            var provincia_value = $('#provinciaid option:selected').html();
            var distrito_value = $('#distritoid option:selected').html();
            
            /*
             * Scroll de direcciones
             * con la opcionde eliminar
             **/
            $("#direcciones tbody").append(
                "<tr>"+
                "<td>"+tipodireccion_value+"</td>"+    
                "<td>"+direccion_value+"</td>"+
                "<td>"+departamento_value+"</td>"+
                "<td>"+provincia_value+"</td>"+
                "<td>"+distrito_value+"</td>"+
                "<td>"+"<a href='#' id='del-direccion' class='button delete'>Eliminar</a>"+"</td>"+
                "</tr>"
            );
           
            contador++;
            
            return false;
        });
            
            
            /*
             * ESPECIALIDAD
             */
            $("#agregarEspecialidad").click(function(){
                if($(this).attr("value") == "Agregar Especialidad"){
                    $(this).attr("value", "Ocultar");
                    $("#seleccionaEspecialidad").fadeIn('slow');
                }else{
                    $(this).attr('value', 'Agregar Especialidad');
                    $("#seleccionaEspecialidad").fadeOut('slow');
                }
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
                        <td><label>D.N.I</label></td>
                        <td><input id="inputext" type="text" size="9" name="dni"</td>
                    </tr>
                    <tr>
                        <td><label>Nombre</label></td>
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
                    <td><label for="direccion">Direcci&oacute;n:</label></td>
                    <td>
                        <input type="button" id="agregarDireccion" value="Agregar Direccion" />
                        <div id="seleccionaDireccion">
                            <table border="0" class="atable">
                                <tr>
                                    <th>Tipo de Direcci&oacute;n</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="tipodireccionseleccionada" id="tipodireccionid" name="tipodir">
                                            <option value="0" name="td">Seleccionar tipo de direccion</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" size="25" name="direccion" />
                                    </td>
                                    <td>
                                        <select name="departamentoseleccionada" id="departamentoid">
                                                <option value="0">Seleccionar departamento</option>
                                            </selected>
                                    </td>
                                    <td>
                                        <select name="provinciaseleccionada" id="provinciaid">
                                                <option value="0">Seleccione una provincia</option>
                                            </select>
                                    </td>
                                    <td>
                                        <select name="distritoseleccionada" id="distritoid">
                                                <option value="0">Seleccione un distrito</option>
                                            </select>
                                    </td>
                                    <td>
                                        <input type="button" id="agregarRegistroDireccion" value="Agregar" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Lista de Direcciones</td>
                    <td>
                        <div class="areaScroll">
                            <table id="direcciones">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Tipo de direcci&oacute;n</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Departamento</th>
                                        <th>Provincia</th>
                                        <th>Distrito</th>
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
                    <td><label for="especialidad">Especialidad:</label></td>
                    <td>
                        <input type="button" id="agregarEspecialidad" value="Agregar Especialidad" />
                        <div id="seleccionaEspecialidad" class="areaScroll">
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