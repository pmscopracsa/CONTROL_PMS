<?php
session_start();
include_once '../../dl/contacto_bl/EspecialidadCompaniaDL.php';
$especialidadcompania = new EspecialidadCompaniaDL();
$especialidades = $especialidadcompania->mostrarEspecialidades();
?>
<!DOCTYPE HTML>
<html>
    <head>
    <!-- zona css -->
    <link href="../../css/cuerpo.css" rel="stylesheet" type="text/css" />
    
    <link href="../../css/areascroll.css" rel="stylesheet" type="text/css" />
    <!-- ZONA JS -->
    <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
    <script src="../../js/tfijo.js" type="text/javascript"></script>
    <script src="../../js/cargacombobox.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
        //ocultar al inicio 
        $("#seleccionaDireccion").css("display", "none");
        $("#seleccionaEspecialidad").css("display", "none");
        
        $("#agregarDireccion").click(function(evento) {
            $("#seleccionaDireccion").css("display", "block",function(e){
                $("#agregarDireccion").attr("value", "Ocultar");
            });
        });
        
        $("#agregarEspecialidad").click(function(evento) {
            $("#seleccionaEspecialidad").css("display","block");    
        });
        
        $("#ocultarBotonAgregaDireccion").click(function(evento) {
            $("#seleccionaDireccion").css("display","none") ;
        });
        
        $("#ocultarBotonAgregaEspecialidad").click(function(evento){
            $("#seleccionaEspecialidad").css("display","none")
        })
        
    $("#agregarRegistro").click(function(evento) {
       agregar_direccion(); 
    });
        
       cargar_viasenvio();
       cargar_tipocompania();
       cargar_tipodireccion();
        
       cargar_departamentos();
       $("#departamentoid").change(function(){cargar_provincias();})
       $("#provinciaid").change(function(){cargar_distrito();})
       $("#provinciaid").attr("disabled",true);
       $("#distritoid").attr("disabled",true);
    });
    
    function agregar_direccion()
    {
        var contador = 1;
        //obtenermos el valor del campo: TIPO DE DIRECCION
        var tipodireccion = $('#tipodireccionid option:selected').val();
        var departamento = $('#departamentoid option:selected').val();
        var provincia = $('#provinciaid option:selected').val();
        var distrito = $('#distritoid option:selected').val();
        //alert(tipodireccion);
        
        $(".areaScroll").append("<input type=\"text\" name=\"tipodireccion\""+">"+ tipodireccion +"</input>");
        $(".areaScroll").append("<input type=\"text\" name=\"departamento\""+">"+ departamento +"</input>");
    }
    
    function cargar_viasenvio()
    {
        $.get("../../bl/Contacto/cargarViaEnvio.php",function(resultado){
           $("#viaenvioid").append(resultado);
        });
    }
    
    function cargar_tipocompania()
    {
        $.get("../../bl/Contacto/cargarTipoCompania.php",function(resultado){
           $("#tipocompaniaid").append(resultado); 
        });
    }
    
    function cargar_tipodireccion()
    {
        $.get("../../bl/Contacto/cargarTipoDireccion.php",function(resultado){
            $("#tipodireccionid").append(resultado);
        })
    }
    
    function cargar_departamentos()
    {
        $.get("../../bl/Contacto/cargarDepartamentos.php",function(resultado) {
               $('#departamentoid').append(resultado);
        });
    }
    
    function cargar_provincias()
    {
        var code = $("#departamentoid").val();
        $.get("../../bl/Contacto/cargarProvincias.php",{code:code},function(resultado) {
                $("#provinciaid").attr("disabled",false);
                document.getElementById("provinciaid").options.length = 1;
                $('#provinciaid').append(resultado);
        });
    }
    
    function cargar_distritos()
    {
        var code=$("#provinciaid").val();
        $.get("../../bl/Contacto/cargarDistritos.php",{code:code},
            function(resultado)
            {
                if(resultado == false)
                {
                    alert("No hay distritos");
                }
                else
                {
                    $("#distritoid").attr("disabled",false);
                    document.getElementById("distritoid").options.length = 1;
                    $("#distritoid").append(resultado);
                }
            }
        );
    }
    </script>
<title>REGISTRO DE COMPANIAS</title>
</head>
<body>
    <h1>REGISTRO DE COMPANIAS</h1>
<div class="container">
    <form action="registracompaniatest.php" method="POST">
       <div class="span-24 last"> 
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
                   <td><input type="text" size="30" placeholder="" name="ruc" /></td>
               </tr>
               <tr>
                   <td><label for="nombre">Nombre:</label></td>
                   <td><input type="text" size="30" placeholder="" name="nombre" /></td>
               </tr>
               <tr>
                   <td><label for="nombre_comercial">Nombre Comercial:</label></td>
                   <td><input type="text" size="30" placeholder="" name="nombrecomercial" /></td>
               </tr>
               <tr>
                   <td><label for="partida_registral">Partida Registral:</label></td>
                   <td><input type="text" size="30" placeholder="" name="partidaregistral" /></td>
               </tr>
               <tr>
                   <td><label for="giro">Giro:</label></td>
                   <td><input type="text" size="30" placeholder="" name="giro" /></td>
               </tr>
               <tr>
                   <td><label for="actividad_principal">Activida Principal:</label></td>
                   <td><input type="text" size="30" placeholder="" name="actividadprincipal" /></td>
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
                       <input type="button" id="agregarDireccion" value="Agrega Direcci&oacute;n" />
                       <input type="button" id="ocultarBotonAgregaDireccion" value="Ocultar Direcci&oacute;n" />
                       <div id="seleccionaDireccion">
                           <table border="0" class="atable">
                                <tr>
                                    <th>Tipo de Direcci&oacute;n</th>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="tipodireccionseleccionada" id="tipodireccionid" name="tipodir">
                                            <option value="0" name="td">Seleccionar tipo de Direccion</option>
                                        </select>
                                    </td>
                                    <td><input type="text" size="25" name="direccion" /></td>
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
                                    <td><input type="button" id="agregarRegistro" value="Agregar" /></td>
                                </tr>
                            </table>
                       </div>
                   </td>
                   <td>
                       <div class="areaScroll">
                           
                       </div>
                   </td>
               </tr>
               <tr>
                   <td><label for="especialidad">Especialidad:</label></td>
                   <td>
                       <input type="button" id="agregarEspecialidad" value="Agrega Especialidad" />
                       <input type="button" id="ocultarBotonAgregaEspecialidad" value="Ocultar Especialidad" />
                       <div id="seleccionaEspecialidad">
                            <table border="0" class="atable">
                            <tr>
                                <th>Especialidad</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    for($i=0;$i < (count($especialidades));$i++) {
                                    ?>
                                        <?php echo '<input type="checkbox" name="" value="'.
                                            ($especialidades[$i]['nombre']).
                                            '"/>'.
                                            ($especialidades[$i]['nombre']).
                                            '<br />'?>
                                    <?php
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
                   <td><textarea></textarea></td>
               </tr>
               <tr>
                   <td><label for="email">Email:</label></td>
                   <td><input type="text" size="30" placeholder="" name="email" /></td>
               </tr>
               <tr>
                   <td><label for="web">Web:</label></td>
                   <td><input type="text" size="30" placeholder="" name="web" /></td>
               </tr>
               <tr>
                   <td><label for="via_envio">V&iacute;a de Env&iacute;o:</label></td>
                   <td>
                       <select name="viaenvioseleccionada" id="viaenvioid">
                           <option value="0">Seleccione una V&iacute;a de Env&iacute;o</option> 
                       </select>
                   </td>
               </tr>
               <tr>
                   <td><label for="contacto">Cont&aacute;cto:</label></td>
                   <td>
                       <a href="javascript:AbrirContacto('../../bl/Contacto/agregarContacto.php','Agregar Contacto','1050','100','')">Agregar Cont&aacute;cto</a>
                   </td>
               </tr>
           </table>
       </div>
        <input type="submit" value="test" />
    </form>
</div>
</body>
</html>