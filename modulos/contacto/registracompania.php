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
        /**
         * contador para especialidades
         */ 
        var contador_especialidades = 0;
        
        /**
         * contador para representantes
         */
        var contador_representante = 0;
        
        /**
         * contador para direcciones = tipo de direccion, direccion, pais, departamento, distrito
         */
        var contador_tipodireccion = 0;
        var contador_direccion = 0;
        var contador_pais = 0;
        var contador_departamento = 0;
        var contador_distrito = 0;
        
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
        var contador_direcciones = 0;
        
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
        
        
        // eliminar direcciones de scrollbar del fomrulario principal
        $("#del-direccion").live("click",function(e) {
            e.preventDefault();
            contador_direcciones--;
            $(this).parent().parent().remove();
        })       
        
        
        /**
         * BOTON PARA CREAR UNA NUEVA ESPECIALIDAD
         */ 
        $("#btn-nuevaespecialidad").click(function(){
            var descripcion = $(".input-descripcion").attr('value');
            
            $.ajax({
                type:"POST",
                url:'../../bl/Contacto/mantenimiento/especialidadcompania_crear.php',
                data:"descripcion="+descripcion,
                success:function(){
                    alert("¡Nueva especialidad ingresada con éxito!");
                    recargarEspecialidad();
                }
            });
        });
        
        function recargarEspecialidad() {
            $.ajax({
                type:"GET",
                dataType:"json",
                url:"../../dl/contacto_bl/obtenerEspecialidadCompania.php",
                success:function(data){
                    
                    $.each(data,function(index,value){
                        alert(data[index].descripcion);
                        alert("*-*-*-*-*-*-");
                    });
                }
            });
        }
        
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
            /**
             * VARIABLES QUE AYUDARAN A DIFERENCIAR EL ATRIBUTO NAME DEL INPUT TYPE HIDDEN
             */
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
         
         /**
          * TOOL TIPO TEXT PARA LOS TELEFONOS
          */
         $("#fijo").live("mouseover",function(e){
             alert($(this).val());
             $.ajax({
                 data:{id:e},
                 type:"GET",
                 dataType:"json",
                 url:"",
                 success:function(data) {
                     mostrarTelefonos(data);
                 }
             });
         });
         
         function mostrarRepresentantesScroll(data)
         {
             /**
             * VARIABLES QUE AYUDARAN A DIFERENCIAR EL ATRIBUTO NAME DEL INPUT TYPE HIDDEN
             */
             contador_representante++;
             $.each(data,function(index,value){
                 datos = "<tr>"+
                "<td>"+data[index].dni+"</td>"+
                "<td>"+data[index].nombre+"</td>"+
                "<td>"+data[index].cargo+"</td>"+
                "<td>"+data[index].email+"</td>"+
                "<td>"+data[index].fax+"</td>"+
                "<td>"+data[index].qnt_tf+"</td>"+
                "<td>"+data[index].qnt_tm+"</td>"+
                "<td>"+data[index].qnt_tn+"</td>"+
                "<td>"+"<a href='#' id='del-representante' class='button delete'>Eliminar</a>"+"</td>"+
                '<input type="hidden" name="representante'+contador_representante+'" value="'+data[index].id+'" />'+
                "</tr>";
                $("#tbl-listarepresentantes tbody").append(datos);
             });
         }
        
        $("#agregarRegistroDireccion").click(function() {
            //contador para saber cuantas direcciones existen
            contador_direcciones++;
            /**
             * VARIABLES QUE AYUDARAN A DIFERENCIAR EL ATRIBUTO NAME DEL INPUT TYPE HIDDEN
             */
            contador_tipodireccion++;
            contador_direccion++;
            contador_pais++;
            contador_departamento++;
            contador_distrito++;
            //OBTENEMOS LOS ID DE LOS VALORES SELECCIONADOS EN EL COMBOBOX
            var tipodireccion_id = $('#tipodireccionid option:selected').val();
            var departamento_id = $('#departamentoid option:selected').val();
            var distrito_id = $('#distritoid option:selected').val();
            var pais_id = $('#paisid option:selected').val();
            
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
                "<tr name=\"direccion\">"+
                "<td name=\"tipodireccion\">"+tipodireccion_value+"</td>"+    
                '<input type="hidden" name="tipodireccion'+contador_tipodireccion+'" value="'+tipodireccion_id+'" />'+
                "<td>"+direccion_value+"</td>"+
                '<input type="hidden" name="direccion'+contador_direccion+'" value="'+direccion_value+'" />'+
                "<td>"+pais_value+"</td>"+
                '<input type="hidden" name="pais'+contador_pais+'" value="'+pais_id+'" />'+
                "<td>"+departamento_value+"</td>"+
                '<input type="hidden" name="departamento'+contador_departamento+'" value="'+departamento_id+'" />'+
                "<td>"+distrito_value+"</td>"+
                '<input type="hidden" name="distrito'+contador_distrito+'" value="'+distrito_id+'" />'+
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
            var valor_oculto = $('<input type="hidden" name="contador_direcciones" value="'+contador_direcciones+'" />');
            valor_oculto.appendTo("#cant_direcciones");
        })
        
        /**
         * funcion que no se utiliza en ningun sitio, posible a ser borrada
         */
        $("#delAddress").click(function(){
            alert("aaa");
           $("direccione"+contador).remove();
        });
        
       cargar_viasenvio();
       cargar_tipocompania();
       cargar_tipodireccion();
       cargar_paises();
       
       $("#paisid").change(function(){cargar_departamentos();})
       $("#departamentoid").change(function(){cargar_distritos();})
       $("#departamentoid").attr("disabled",true);
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
    <form action="registratest.php" method="POST">
       <div class="info">
       Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
       </div>
       <div> 
           <table id="titulo">
               <tr>
                   <td><label for="tipocompania">Tipo de Compania:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td>
                       <select name="tipocompaniaseleccionada" id="tipocompaniaid">
                           <option value="0">Seleccione un tipo de Compania</option>
                       </select>
                   </td>
               </tr>
               <tr class="alt">
                   <td><label for="ruc">RUC:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="ruc" /></td>
               </tr>
               <tr>
                   <td><label for="nombre">Nombre:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="nombre" /></td>
               </tr>
               <tr>
                   <td><label for="nombre_comercial">Nombre Comercial:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="nombrecomercial" /></td>
               </tr>
               <tr>
                   <td><label for="partida_registral">Partida Registral:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="partidaregistral" /></td>
               </tr>
               <tr>
                   <td><label for="giro">Giro:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td>
                       <table border='0' class="atable">
                           <tr>
                               <th>
                               <th colspan="2">
                           </tr>
                           <tr>
                                <td class="atable"><input type="text" size="30" name="giro" />
                                <td><input type="button" class="addRow" value="+" />
                                <td><input type="button" class="delRow" value="-" />
                           </tr>
                                    <input type="hidden" class="rowCount" name="filas_giro" />    
                       </table>
                   </td>
               </tr>
               <tr>
                   <td><label for="actividad_principal">Activida Principal:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="actividadprincipal" /></td>
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
                   <td><label for="telefono_movil">Tel&eacute;fono M&oacute;vil:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
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
                   <td><label for="telefono_nextel">Tel&eacute;fono Nextel:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
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
                   <td><label for="direccion">Direcci&oacute;n:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td>
                       <input type="button" id="agregarDireccion" value="Agregar Direcci&oacute;n" />
                       
                       <!-- ventana modal para seleccionar la direccion -->
                       <div id="seleccionaDireccion" title="Direcci&oacute;n" style="display: none" >
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
                                        <input class="derecha" id="direccion_text" type="text" size="25" name="direccion" />
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="tr-padding">
                                        <label>Pa&iacute;s:</label>
                                        <select class="derecha" name="paisseleccionada" id="paisid">
                                            <option value="0">Selecciona pa&iacute;s</option>
                                        </selected>
                                    </td>
                                  <tr>  
                                    <td class="tr-padding">
                                        <label>Departamento/Estado:</label>
                                        <select class="derecha" name="departamentoseleccionada" id="departamentoid">
                                            <option value="0">Selecciona departamento</option>
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
                   <td><label for="especialidad">Especialidad:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td>
                       <input type="button" id="btnAgregarEspecialidad" value="Agregar Especialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                      
                       <div id="divSeleccionaEspecialidad" title="Agregar Especialidad" style="display:none">
                           <table border="0" id="tbl-especialidades" class="atable">
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
                   <td><label for="representante">Representante:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
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
                                       <th> Nombres </th>
                                       <th> Cargo </th>
                                       <th> Email </th>
                                       <th> Fax </th>
                                       <th> T. Fijo </th>
                                       <th> T. M&oacute;vil </th>
                                       <th> T. Nextel </th>
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
                   <td><label for="observacion">Observaci&oacute;n:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><textarea name="observacion"></textarea></td>
               </tr>
               <tr>
                   <td><label for="email">Email:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="email" /></td>
               </tr>
               <tr>
                   <td><label for="web">Web:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="web" /></td>
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
       </div>
        <div id="footer">
            <hr />
        </div>
        <input type="submit" id="submit" value="test" />
    </form>
</div>
</body>
</html>