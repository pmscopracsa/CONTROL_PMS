<?php
session_start();

$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

$especialidadcompania = new EspecialidadCompaniaDL();
$especialidades = $especialidadcompania->mostrarEspecialidades();
?>
<!DOCTYPE HTML>
<html>
    <head>
    <!-- zona css -->
    <?php
    foreach($css as $value) {
        if ($value === '.' || $value === '..'){continue;}
        echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
    }
    ?>
    <!-- ZONA JS -->
    <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
    <script src="../../js/tfijo.js" type="text/javascript"></script>
    <script src="../../js/cargarDatos.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        var contador = 1;
        var counter_strike = 0;
        
        /*
         * modal para direcciones
         */
        $("#dialog:ui-dialog").dialog("destroy");
        $("#seleccionaDireccion").dialog({
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
        
        $("#agregarDireccion").button().click(function(){
            $("#seleccionaDireccion").dialog("open");
        })
        
        // direcciones
        $("#del-direccion").live("click",function(e) {
            e.preventDefault();
            counter_strike--;
            $(this).parent().parent().remove();
        })
        
        //ocultar al inicio 
        $("#seleccionaDireccion").css("display", "none");
        $("#seleccionaEspecialidad").css("display", "none");
        $("#quitardireccion").css("display","none");
        $("#seleccionaRepresentante").css("display","none");
        
        // Efecto para direccion
//        $("#agregarDireccion").click(function(){
//            if($(this).attr("value") == "Agregar Direccion"){
//                $(this).attr("value", "Ocultar");
//                $("#seleccionaDireccion").fadeIn('slow');
//                $("#quitardireccion").fadeIn('slow');
//            }else{
//                $(this).attr("value","Agregar Direccion");
//                $("#seleccionaDireccion").fadeOut('slow');
//                $("#quitardireccion").fadeOut('slow')
//            }
//        });
        
        // Efecto para Especialidad
        $("#agregarEspecialidad").click(function(){
            if($(this).attr("value") == "Agregar Especialidad"){
                $(this).attr("value", "Ocultar");
                $("#seleccionaEspecialidad").fadeIn('slow');
            }else{
                $(this).attr('value', "Agregar Especialidad");
                $("#seleccionaEspecialidad").fadeOut('slow');
            }
        });
        
        /*
         * Efecto para representante
         */ 
        $("#agregarRepresentante").click(function(){
            if($(this).attr("value") == "Agregar Representante"){
                $(this).attr("value","Ocultar");
                $("#seleccionaRepresentante").fadeIn('slow');
            }else{
                $(this).attr("value","Agregar Representante");
                $("#seleccionaRepresentante").fadeOut('slow');
            }
        });
        
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
            var pais_value = $('#paisid option:selected').html();
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
                "<td>"+pais_value+"</td>"+
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
         * saber cuantas direcciones existen
         * variable que se crear antes de enviar el formulario
         */
        $("#submit").click(function(){
            //alert(counter_strike);
            var valor_oculto = $('<input type="hidden" name="contador" value="'+counter_strike+'" />');
            valor_oculto.appendTo("#cant_direcciones");
        })
        
        $("#delAddress").click(function(){
           $("direccione"+contador).remove();
        });
        
       cargar_viasenvio();
       cargar_tipocompania();
       cargar_tipodireccion();
       cargar_paises();
       //cargar_departamentos(); ya no se cargara a menos que se cargue un pais
       $("#paisid").change(function(){cargar_departamentos();})
       $("#departamentoid").change(function(){cargar_provincias();})
       $("#departamentoid").attr("disabled",true);
       $("#provinciaid").change(function(){cargar_distritos();})
       $("#provinciaid").attr("disabled",true);
       $("#distritoid").attr("disabled",true);
       
       $("#submit").click(function(){
           
       });
    });
    
    $('input:checkbox[name=especialidad]').click(function(){
        alert("checked");
    });
    </script>
<title>REGISTRO DE COMPANIAS</title>
</head>
<body class="fondo">
    <div id="barra-superior">
        <div id="barra-superior-dentro">
            <h1 id="titulo_barra">REGISTRO DE COMPA&Ncaron;IAS</h1>
        </div>
    </div>
    
<div id="main">
    <form action="registracompaniatest.php" method="POST">
       <div> 
           <table id="titulo">
               <tr>
                   <td><label for="tipocompania">Tipo de Compania:</label></td>
                   <td>
                       <select name="tipocompaniaseleccionada" id="tipocompaniaid">
                           <option value="0">Seleccione un tipo de Compania</option>
                       </select>
                   </td>
               </tr>
               <tr class="alt">
                   <td><label for="ruc">RUC:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="ruc" /></td>
               </tr>
               <tr>
                   <td><label for="nombre">Nombre:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="nombre" /></td>
               </tr>
               <tr>
                   <td><label for="nombre_comercial">Nombre Comercial:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="nombrecomercial" /></td>
               </tr>
               <tr>
                   <td><label for="partida_registral">Partida Registral:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="partidaregistral" /></td>
               </tr>
               <tr>
                   <td><label for="giro">Giro:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="giro" /></td>
               </tr>
               <tr>
                   <td><label for="actividad_principal">Activida Principal:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="actividadprincipal" /></td>
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
                               <td class="atable"><input type="text" size="15" name="telefonofijo" /></td>
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
                   <td><label for="telefono_movil">Tel&eacute;fono M&oacute;vil:</label></td>
                   <td>
                        <table>
                            <tr>
                                <th></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <td><input id="inputext" type="text" size="15" name="telefonomovil" /></td>
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
                       <input type="button" id="agregarDireccion" value="Agregar Direcci&oacute;n" />
                       
                       <!-- ventana modal para seleccionar la direccion -->
                       <div id="seleccionaDireccion">
                           <table border="0" class="atable">
                                <tr>
                                    <td>
                                        <label>Tipo de Direcci&oacute;n:</label>
                                        <select name="tipodireccionseleccionada" id="tipodireccionid" name="tipodir">
                                            <option value="0" name="td">Seleccionar tipo de Direccion</option>
                                        </select>
                                    </td>
                                 <tr>   
                                    <td>
                                        <label>Direccion:</label>
                                        <input id="direccion_text" type="text" size="15" name="direccion" />
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                        <label>Pa&iacute;s:</label>
                                        <select name="paisseleccionada" id="paisid">
                                            <option value="0">Seleccionar Pa&iacute;s</option>
                                        </selected>
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
                                    <tr>
                                    <td>
                                        <input type="button" id="agregarRegistroDireccion" value="Agregar" />
                                    </td>
                                </tr>
                            </table>
                       </div>
                   </td>
               </tr>
               <!-- INPUT CON LA CANTIDAD DE DIRECCIONES -->
               <div id="cant_direcciones"></div>
               <tr>
                   <td>Lista de Direcciones</td>
                   <td>
                       <div class="areaScroll">
                           <table id="direcciones">
                               <thead>
                                   <tr class="ui-widget-header">
                                       <th>Tipo de direcci&oacute;n</th>
                                       <th>Direcci&oacute;n</th>
                                       <th>Pa&iacute;s
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
                   <td><label for="representante">Representante:</label></td>
                   <td>
                       <input type="button" id="agregarRepresentante" value="Agregar Representante" />
                       <div id="seleccionaRepresentante" class="areaScroll">
                           <table border="0" class="atable">
                           <tr>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    /*
                                     * CAMBIAR EL ARREGLO contacto Y LA CONSULTA SQL
                                     */
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
                   <td><label for="observacion">Observaci&oacute;n</label></td>
                   <td><textarea name="observacion"></textarea></td>
               </tr>
               <tr>
                   <td><label for="email">Email:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="email" /></td>
               </tr>
               <tr>
                   <td><label for="web">Web:</label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="web" /></td>
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
       </div>
        <div id="footer">
            <hr />
        </div>
        <input type="submit" id="submit" value="test" />
    </form>
</div>
</body>
</html>