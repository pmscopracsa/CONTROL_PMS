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

$representantescompania = new RepresentanteCompaniaDL();
$representantes = $representantescompania->mostrarRepresentantes();
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
        /*
         * MODAL PARA SELECCIONAR ESPECIALIDAD
         */
        $("#divSeleccionaEspecialidad").dialog({
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
            },
            close:function(){
                //allFields.val("").removeClass("ui-state-error");
            }
        });
        
        /**
         * MODAL PARA SELECCIONAR REPRESENTANTE
         */
        $("#divSeleccionaRepresentante").dialog({
            autoOpen:false,
            height:300,
            width:350,
            modal:true,
            buttons:{
                "Agregar representate (Contactos)":function(){
                    $("#").dialog("open");
                },
                "Salir":function(){
                    $(this).dialog("close");
                }
            }
        })
        
        var contador = 1;
        var counter_strike = 0;
        
        /*
         * modal para direcciones
         */
        $("#dialog:ui-dialog").dialog("destroy");
        $("#seleccionaDireccion").dialog({
            autoOpen:false,
            height:250,
            width:350,
            modal:true,
            buttons:{
                "Cerrar":function(){
                    $(this).dialog("close");
                }
            },
            close:function(){
                //allFields.val("").removeClass("ui-state-error");
            }
        });
        
        /**
         * MODAL PARA CREAR UNA NUEVA ESPECIALIDAD
         */
        $.fx.speeds._default = 1000;
        $("#divNuevaEspecialidad").dialog({
            show:"blind",
            autoOpen:false,
            height:300,
            width:350,
            modal:true,
            buttons:{
                "Salir":function(){
                    $(this).dialog("close");
                }
            },
            close:function(){
                allFields.val("").removeClass("ui-state-error");
            }
        });
        
        /**
         * BOTON PARA ABRIR MODAL Y AGREGAR ESPECIALIDADES AL FORMULARIO PRINCIPAL
         */
        $("#btnAgregarEspecialidad").click(function(){
            $("#divSeleccionaEspecialidad").dialog("open");
        })
        
        /**
         * BOTON PARA ABRIR MODAL Y CREAR UNA NUEVA ESPECIALIDAD
         */
        $("#btnNuevaEspecialidad").click(function(){
            $("#divNuevaEspecialidad").dialog("open");
        });
        
        /**
         * abre modal para ingresar direccion
         */
        $("#agregarDireccion").button().click(function(){
            $("#seleccionaDireccion").dialog("open");
        })
        
        /**
         * BOTON PARA ABRIR MODAL Y AGREGAR REPRESENTANTES AL FOMRULARIO PRINCIPAL
         */
        $("#btnAgregarRepresentante").click(function(){
            $("#divSeleccionaRepresentante").dialog("open");
        })
        
        
        // eliminar direccione de scrollbar del fomrulario principal
        $("#del-direccion").live("click",function(e) {
            e.preventDefault();
            counter_strike--;
            $(this).parent().parent().remove();
        })       
        
        
        
        $("#btn-nuevaespecialidad").click(function(){
            var descripcion = $(".input-descripcion").attr('value');
            
            $.ajax({
                type:"POST",
                url:'../../bl/Contacto/mantenimiento/especialidadcompania_crear.php',
                data:"descripcion="+descripcion,
                success:function(){
                    $('.input-descripcion').val("")
                }
            });
        });
        
        /**
         * detectar seleccion en especialidad en base al click del checkbox
         * y agregar la descripcion a la lista que el usuario visualizará.
         */
        $('input:checkbox[name=especialidades[]]').click(function() {
            $.ajax({
                data:{id:$(this).val()},
                type:"GET",
                dataType:"json",
                url:"../../includes/query_repository/getEspecialidadCompania.php",
                success:function(data) {
                    mostrarEspecialidadesScroll(data);
                }
            });
        });
        
        $("#del-especialidad").live("click",function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })
        
        function mostrarEspecialidadesScroll(data)
        {
            $.each(data,function(index,value){
                $("#tbl-listaespecialidades tbody").append(
                "<tr>"+
                "<td>"+data[index].id+"</td>"+
                "<td>"+data[index].descripcion+"</td>"+
                "<td>"+"<a href='#' id='del-especialidad' class='button delete'>Eliminar</a>"+"</td>"+
                "</tr>"
                );
            });
        }
        
        /**
         * DETECTAR SELECCION EN REPRESENTANTE EN BASE A SU SELECCION
         * Y AGREGAR EL REPRESENTANTE A LA LISTA QUE EL USUARIO VISUALIZARA
         */
         $('input:checkbox[name=representantes[]]').click(function() {
            $.ajax({
                data:{id:$(this).val()},
                type:"GET",
                dataType:"json",
                url:"../../includes/query_repository/getRepresentante.php",
                success:function(data) {
                    mostrarRepresentantesScroll(data);
                }
            });
         });
         
         $("#del-representante").live("click",function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
         });
         
         function mostrarRepresentantesScroll(data)
         {
             $.each(data,function(index,value){
                $("#tbl-listarepresentantes tbody").append(
                "<tr>"+
                "<td>"+data[index].dni+"</td>"+
                "<td>"+data[index].nombre+"</td>"+
                "<td>"+data[index].cargo+"</td>"+
                "<td>"+data[index].fax+"</td>"+
                "<td>"+data[index].email+"</td>"+
                "<td>"+"<a href='#' id='del-representante' class='button delete'>Eliminar</a>"+"</td>"+
                "</tr>"
                );
             });
         }
        
        /**
         * DESPERDICIO DE CODIGO;:SETEARLA ONLINE CON CSS COMO ATRIBUTO DE ELEMENTO
         */
        $("#seleccionaDireccion").css("display", "none");
        $("#seleccionaEspecialidad").css("display", "none");
        $("#quitardireccion").css("display","none");
        $("#seleccionaRepresentante").css("display","none");

        
        $("#agregarRegistroDireccion").click(function() {
            //contador para saber cuantas direcciones existen
            counter_strike++;
            //OBTENEMOS LOS ID DE LOS VALORES SELECCIONADOS EN EL COMBOBOX
            var tipodireccion_id = $('#tipodireccionid option:selected').val();
            var departamento_id = $('#departamentoid option:selected').val();
            var distrito_id = $('#distritoid option:selected').val();
            
            //OBTENEMOS LOS VALORES A MOSTRAR DE LOS DATOS ELEGIDOS EN EL COMBOBX
            var tipodireccion_value = $('#tipodireccionid option:selected').html();
            var direccion_value = $('#direccion_text').val();
            var pais_value = $('#paisid option:selected').html();
            var departamento_value = $('#departamentoid option:selected').html();
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
       //selDefault();
       //cargar_departamentos(); ya no se cargara a menos que se cargue un pais
       $("#paisid").change(function(){cargar_departamentos();})
       $("#departamentoid").change(function(){cargar_distritos();})
       $("#departamentoid").attr("disabled",true);
       //$("#provinciaid").change(function(){cargar_distritos();})
       //$("#provinciaid").attr("disabled",true);
       $("#distritoid").attr("disabled",true);
       
       $("#submit").click(function(){
           
       });
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
                   <td>
                       <table border='0' class="atable">
                           <tr>
                               <th>
                               <th colspan="2">
                           <tr>
                                <td class="atable"><input type="text" size="30" name="grio" />
                                <td><input type="button" class="addRow" value="+" />
                                <td><input type="button" class="delRow" value="-" />
                                    <input type="hidden" class="rowCount" name="filas_giro" />    
                       </table>
                   </td>
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
                                <tr >
                                    <td class="tr-padding">
                                        <label>Tipo de Direcci&oacute;n:</label>
                                        <select class="derecha" name="tipodireccionseleccionada" id="tipodireccionid" name="tipodir">
                                            <option value="0" name="td">Seleccionar tipo de Direccion</option>
                                        </select>
                                    </td>
                                 <tr >   
                                    <td class="tr-padding">
                                        <label>Direccion:</label>
                                        <input class="derecha" id="direccion_text" type="text" size="15" name="direccion" />
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="tr-padding">
                                        <label>Pa&iacute;s:</label>
                                        <select class="derecha" name="paisseleccionada" id="paisid">
                                            <option value="0">Selecciona pa&iacute;s</option>
                                            <option value="-1">Selecciona pa&iacute;s -1</option>
                                        </selected>
                                    </td>
                                  <tr>  
                                    <td class="tr-padding">
                                        <label>Departamento/Estado:</label>
                                        <select class="derecha" name="departamentoseleccionada" id="departamentoid">
                                            <option value="2911">Lima</option>
                                        </selected>
                                    </td>
                                   <tr> 
                                    <tr>
                                    <td class="tr-padding">
                                        <label>Distrito/Ciudad:</label>
                                        <select class="derecha" name="distritoseleccionada" id="distritoid">
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
                       <input type="button" id="btnAgregarEspecialidad" value="Agregar Especialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                      
                       <div id="divSeleccionaEspecialidad" title="Agregar Especialidad" style="display:none">
                            <table border="0" class="atable">
                            <tr>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    foreach ($especialidades as &$valor) {
                                        echo '<input type="checkbox" name="especialidades[]" value="'.
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
                                        <th>Id</th>
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
                   <td><label for="representante">Representante:</label></td>
                   <td>
                       <input type="button" id="btnAgregarRepresentante" value="Agregar Representante" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                       <div id="divSeleccionaRepresentante" title="Agregar Representante" style="display: none">
                           <table border="0" class="atable">
                           <tr>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    foreach ($representantes as &$valor) {
                                        echo '<input type="checkbox" name="representantes[]" value="'.
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
                   </td>
               </tr>
               <tr>
                   <td><label>Lista de representantes</label></td>
                   <td>
                       <div class="areaScrollModal" id="lista-representantes">
                           <table id="tbl-listarepresentantes" class="ui-widget">
                               <thead>
                                   <tr class="ui-widget-header">
                                       <th> DNI </th>
                                       <th>Nombres</th>
                                       <th>Cargo</th>
                                       <th>Tel&eacute;fono</th>
                                       <th>Fax</th>
                                       <th>T. M&oacute;vil</th>
                                       <th>Email</th>
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