<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$CSS_PATH = '../../css/';
$css = scandir($CSS_PATH);

/**
 * $id_empresa = $_SESSION['id_empresa'];
 * @param type $name 
 */
$id_empresa = 1;

function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}
?>
<!DOCTYPE HTML>
<html class="no-js">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    
    <!-- zona css -->
    <?php
    foreach($css as $value) {
        if ($value === '.' || $value === '..'){continue;}
        echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
    }
    ?>
    <link href="../../css/reveal/styles.css" rel="stylesheet" type="text/css" />
    <!-- ZONA JS -->
    <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
    <script src="../../js/tfijo.js" type="text/javascript"></script>
    <script src="../../js/cargarDatos.js" type="text/javascript"></script>
    <script src="../../js/jquery.form.js" type="text/javascript"></script>
    <script src="../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
    <script src="../../js/jquery.validity/jQuery.validity.js" type="text/javascript"></script>
    <link href="../../js/jquery.validity/jquery.validity.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery.form.js" type="text/javascript"></script>
    <script src="../../js/jquery.reveal.js" type="text/javascript"></script>
  
    <script type="text/javascript">

        
    $(document).ready(function(){
        
     /**
     * FUNCION QUE VUELVE A RECARGAR EL DIV QUE CONTIENE LA LISTA DE ESPECIALIDADES
     */    
    function recargarEspecialidades()
    {
        $("#divSeleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?"+Math.random());
    } 
    
    /**
     * FUNCTION QUE VEULVE A CARGAR EL DIS DE ESPECIALIDADES PERO PASANDOLE UN FILTRO PARA LA BUSQUEDA
     */
    function recargarEspecialidadesPorFiltro(filtro)
    {
        $("#divSeleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?filtro="+filtro);
    }
    
    /**
     * FUNCTION QUE VUELVE A RECARGAR EL DIV QUE CONTIEN LA LISTA DE ESPECIALIDADES
     */
    function recargarRepresentantes()
    {
        $("#divSeleccionaRepresentante").load("modal_registracompania/representantes_div.php?filtro=1");
    }
    
    /**
     * FUNCTION QUEVUELVE A CARGAR EL DIV DE REPRESENTANTES PERO PASANDOLE UN FILTRO DE BUSQUEDA
     */
    function recargarRepresentantesPorFiltro(filtro)
    {
        $("#divSeleccionaRepresentante").load("modal_registracompania/representantes_div.php?filtro="+filtro);
    }
        
        /**
         * PRIMERA CARGA DE LA LISTA DE ESPECIALIDADES
         * PRIMERA CARGA DE LA LISTA DE REPRESENTANTES
         */
        $("#divSeleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?filtro=1");
        $("#divSeleccionaRepresentante").load("modal_registracompania/representantes_div.php?filtro=1");
        
        $("form").validity(function(){
            $(".ruc")
                .require()
                .match("number");
        })

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
            height:350,
            width:450,
            modal:true,
            buttons:{
                "Limpiar":function() {
                    recargarEspecialidades();
                },
                "Crear nueva especialidad":function(){
                    $("#divNuevaEspecialidad").dialog("open");
                },
                "Cerrar":function(){
                    $(this).dialog("close");
                    recargarEspecialidades();
                }
            }
        });
        
        /**
         * MODAL PARA BUSCAR DENTEL DEL MODAL DE ESPECIALIDADES
         */
        function buscarEspecialidad()
        {
            $("#modal_buscarEspecialidadPorNombre").dialog("open");
        }
        
        $("#modal_buscarEspecialidadPorNombre").dialog({
            autoOpen:false,
            height:100,
            width:450,
            modal:true,
            buttons:{
                "Ok":function(){
                    if ($("#txt_nombreEspecialidad").val() == "")
                        alert("Ingrese dato para buscar");
                    recargarEspecialidadesPorFiltro($("#txt_nombreEspecialidad").val());
                },
                "Cerrar":function(){
                    $(this).dialog("close");
                }
            }
        });
        
        /**
         * MODAL PARA SELECCIONAR REPRESENTANTE
         */
        $("#divSeleccionaRepresentante").dialog({
            autoOpen:false,
            height:350,
            width:450,
            modal:true,
            buttons:{
                "Limpiar":function(){
                    recargarRepresentantes();
                },
                "Cerrar":function(){
                    $(this).dialog("close");
                }
            }
        });
        
        /**
         * MODAL PARA BUSCAR REPRESENATE
         */
        function buscarRepresentante() {
            $("#modal_buscarRepresentantePorNombre").dialog("open");
        }
        
        $("#modal_buscarRepresentantePorNombre").dialog({
            autoOpen:false,
            height:100,
            width:450,
            modal:true,
            buttons:{
                "Ok":function(){
                    if ($("#txt_nombreRepresentante").val() == "")
                        alert("Ingrese dato para buscar");
                    recargarRepresentantesPorFiltro($("#txt_nombreRepresentante").val());
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
        $("#seleccionaDireccion").dialog({
            autoOpen:false,
            height:280,
            width:450,
            modal:true,
            buttons:{
                "Agregar":function() {
                    /**
             * VALIDACIONES PARA LAS DIRECCIONES
             */
            if ($('#direccion_text').val() == "") {
                alert("Ingrese la direcci\xf3n por favor.");
                return;
            }
            if (($('#tipodireccionid option:selected').val()) == 0) {
                alert("Escoja un tipo de direcci\xf3n por favor");
                return;
            }
            
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
                },
                "Cerrar":function(){
                    $(this).dialog("close");
                }
            }
        });
        
        /**
         * MODAL PARA CREAR UNA NUEVA ESPECIALIDAD
         */
        $.fx.speeds._default = 1000;
        $("#divNuevaEspecialidad").dialog({
            show:"blind",
            autoOpen:false,
            height:150,
            width:300,
            modal:true,
            buttons:{
                "Crear":function() {
                    $.ajax({
                    type:"POST",
                    url:'../../bl/Contacto/mantenimiento/especialidadcompania_crear.php',
                    data:"descripcion="+$('.input-descripcion').attr('value'),
                    success:function(){
                        //$("#divNuevaEspecialidad").dialog('close');
                        recargarEspecialidades();
                    }
                });
                },
                "Cerrar":function(){
                    $(this).dialog("close");
                }
            }
        });
        
        /**
         * BOTON PARA ABRIR MODAL Y AGREGAR ESPECIALIDADES AL FORMULARIO PRINCIPAL
         */
        $("#btnAgregarEspecialidad").click(function(e){
            e.preventDefault();
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
        // TODO: desmarcar el checkbox
        $("#del-direccion").live("click",function(e) {
            e.preventDefault();
            contador_direcciones--;
            $(this).parent().parent().remove();
        })       
        
        /**
         * MODAL PARA CREAR UNA NUEVA ESPECIALIDAD
         */ 
        $("#btn-nuevaespecialidad").click(function(){
            $.ajax({
                type:"POST",
                url:'../../bl/Contacto/mantenimiento/especialidadcompania_crear.php',
                data:"descripcion="+$('.input-descripcion').attr('value'),
                success:function(){
                    $("#divNuevaEspecialidad").dialog('close');
                    recargarEspecialidades();
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
        
        $("#especialidades_boxes").live("click",function() {
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
         
         $("#representantes_boxes").live("click",function() {
            $.ajax({
                data:{id:$(this).val()},
                type:"GET",
                dataType:"json",
                url:"../../includes/query_repository/getRepresentante.php",
                success:function(data) {
                    mostrarRepresentantesScroll(data);
                }
            })
         })
         
         /**
          * ELIMINAR REPRESENTANTE 
          */
         $("#del-representante").live("click",function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
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
        
        /*
         * saber cuantas direcciones existen
         * variable que se crear antes de enviar el formulario
         */
        $("#submit").click(function(){
            /**
             * VALIDACIONES PRE FORM
             */
            
            if (($("#tipocompaniaid").val()) == 0) {
                alert("Escoja un tipo de Compa\xf1 \xeda por favor");
                return false;
            }
            
            if ($("#viaenvioid").val() == 0) {
                alert("Escoja una V\xeda de env\xedo");
                return false;
            }
            
            var valor_oculto_direcciones = $('<input type="hidden" name="contador_direcciones" value="'+contador_direcciones+'" />');
            valor_oculto_direcciones.appendTo("#cant_direcciones");
            
            var valor_oculto_especialidades = $('<input type="hidden" name="contador_especialidades" value="'+contador_especialidades+'"/>');
            valor_oculto_especialidades.appendTo("#cant_especialidades");
            
            var valor_oculto_representantes = $('<input type="hidden" name="contador_representantes" value="'+contador_representante+'"/>');
            valor_oculto_representantes.appendTo("#cant_representantes");
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
       cargar_departamentos();
       cargar_distritos();

      $(".ruc_empresa").focusout(function() {
          $.ajax({
              type:"GET",
              url:"../../bl/Contacto/mantenimiento/verificarExistenciaEmpresa.php",
              data:{ruc_empresa:$(".ruc_empresa").val()},
              success:function(data) {
                  if (data == "tiene") {
                      $('#modal').reveal({ // The item which will be opened with reveal
                                animation: 'fade',                   // fade, fadeAndPop, none
                                animationspeed: 600,                       // how fast animtions are
                                closeonbackgroundclick: false,              // if you click background will modal close?
                                dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
                        });
                  }
              }
          });
      });  
      
      $("#btnContinuar").click(function(e) {
          e.preventDefault();
            window.location = "registracompania.php";
      })
      $("#btnModificar").click(function(e) {
          e.preventDefault();
          window.location = "edit/editacompaniacur.php?ruc="+$(".ruc_empresa").val();
      })
       
       $("#edita").click(function(e) {
           e.preventDefault();
           $("#modal-escogeEmpresa").dialog("open");
           return false;
       });
       
       $("#modal-escogeEmpresa").dialog({
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
        * BUSQUEDAS IN-LINE
        */
       // ESPECIALIDADES
       $("#btnSearchEspecialidad").live("click",function() {
           recargarEspecialidadesPorFiltro($("#txt_divEspecialidadBuscar").val());
       });
       // REPRESENTANTES
       $("#btnSearchRepresentante").live("click" ,function() {
           recargarRepresentantesPorFiltro($("#txt_divRepresentanteBuscar").val());
       });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var options = {
                success:function(){
                    muestraRespuesta();
                }
                
            };
            $("#frm-registracompania").ajaxForm(options);
        });

        function muestraRespuesta(responseText, statusText, xhr, $form) {
            alert("Los datos han sido ingresados correctamente");
            window.setTimeout('location.reload()',1000);
        }
    </script>
    <title>REGISTRO DE COMPA&Ntilde;IAS</title>
</head>
<body class="fondo">
    <!-- INICIO MODAL -->
    <div id="modal">
	<div id="heading">
                La empresa que usted intenta registrar ya existe
	</div>

	<div id="content">
            <p>Dele click a <b>"Continuar"</b> si desea seguir usando este formulario. De lo contrario <b>"Modificar"</b></p>
            <a href="#" id="btnContinuar" class="button green close"><img src="../../css/reveal/images/tick.png">Continuar</a>
            <a href="#" id="btnModificar" class="button red close"><img src="../../css/reveal/images/cross.png">Modificar</a>
	</div>
    </div>
    <!-- FIN MODAL -->
    <div id="barra-superior">
        <?php            include_once 'modal_registracompania/modal-escogeEmpresa.php';?>
        <div id="barra-superior-dentro">
            
            <h1 id="titulo_barra">REGISTRO DE COMPA&Ntilde;IAS <?=$_SESSION['id']?></h1>
        </div>
    </div>
    
<div id="main">
    <form id="frm-registracompania" action="../../bl/busca_persona/registraCompania_BL.php" method="POST">
<!--<form id="frm-registracompania" action="ttest/registraCompaniaTest.php" method="POST">-->
        <input type="hidden" name="idEmpresa" value="<?=(int)$_SESSION['id']?>" />
       <div class="info">
       Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
       </div>
       <div> 
           <table id="titulo">
               <tr>
                   <div id="tipo_compania"><td><label for="tipocompania">Tipo de Compania:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td></div>
                   <td>
                       <select name="tipocompaniaseleccionada" id="tipocompaniaid">
                           <option value="0">Seleccione un tipo de Compania</option>
                       </select>
                   </td>
               </tr>
               <tr class="alt">
                   <td><label for="ruc">RUC:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input  class="ruc_empresa" id="inputext" type="text" size="70" name="ruc" /></td>
               </tr>
               <tr>
                   <td><label for="nombre">Nombre:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input class="nombre_empresa" id="inputext" type="text" size="70"  name="nombre" /></td>
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
                                <td class="atable"><input type="text" size="30" id="inputext" name="giro" />
                                <td><input type="button" class="addRow" />
                                <td><input type="button" class="delRow" />
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
                                <td><input id="inputext" type="text" size="15" name="telefonomovil" /></td>
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
                   <td><label for="fax">Fax:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                   <td><input id="inputext" type="text" size="30" placeholder="" name="fax" /></td>
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
                                        <input style="background-color: wheat" class="derecha" id="direccion_text" type="text" size="25" name="direccion" />
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="tr-padding">
                                        <label>Pa&iacute;s:</label>
                                        <select class="derecha" name="paisseleccionada" id="paisid">
                                        </selected>
                                    </td>
                                  <tr>  
                                    <td class="tr-padding">
                                        <label>Departamento/Estado:</label>
                                        <select class="derecha" name="departamentoseleccionada" id="departamentoid">
                                        </selected>
                                    </td>
                                   <tr> 
                                    <tr>
                                    <td class="tr-padding">
                                        <label>Distrito/Ciudad:</label>
                                        <select class="derecha" name="distritoseleccionada" id="distritoid">
                                        </select>
                                    </td>
                                    <tr>
                                </tr>
                            </table>
                       </div>
                   </td>
               </tr>
               <!-- INPUT CON LA CANTIDAD DE DIRECCIONES -->
               <div id="cant_direcciones"></div>
               <div id="cant_especialidades"></div>
               <div id="cant_representantes"></div>
               <tr>
                   <td>Lista de Direcciones</td>
                   <td>
                       <div class="areaScroll">
                           <table id="direcciones" border="0">
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
                       <input type="button" id="btnAgregarEspecialidad" value="Buscar Especialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                       
                       <!-- div que se alimenta con load()-->
                       <div id="divSeleccionaEspecialidad" title="Agregar Especialidad" style="display:none"></div>
                   </td>
                        <div id="divNuevaEspecialidad" title="Crear nueva especialidad" style="display: none">
                            <label>Especialidad:</label>
                            <input id="inputext" class="input-descripcion" type="text" />
<!--                            <input id="btn-nuevaespecialidad" type="button" value="Crear" />-->
                        </div>
                        <!-- MODAL PARA BUSCAR ESPECIALIDAD POR NOMBRE -->    
                        <div id="modal_buscarEspecialidadPorNombre" title="Buscar Especialidad" style="display: none">
                            <label>Nombre de especialidad:</label>
                            <input type="text" id="txt_nombreEspecialidad" />
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
                       <input type="button" id="btnAgregarRepresentante" value="Buscar Representante" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                       <div id="divSeleccionaRepresentante" title="Agregar Representante" style="display: none"></div>
                       
                   </td>
                        <div id="modal_buscarRepresentantePorNombre" title="Buscar representante" style="display: none">
                           <label>Nombre del representante:</label>
                           <input type="text" id="txt_nombreRepresentante" />
                       </div>
               </tr>
               <tr>
                   <td><label>Lista de representantes</label></td>
                   <td>
                       <div class="areaScrollModal" id="lista-representantes">
                           <table id="tbl-listarepresentantes" class="ui-widget" border="0">
                               <thead>
                                   <tr class="ui-widget-header">
                                       <th> DNI </th>
                                       <th> Nombres </th>
                                       <th> Cargo </th>
                                       <th> Email </th>
                                       <th> Fax </th>
                                       <th> Tel&eacute;fono Fijo </th>
                                       <th> Tel&eacute;fono M&oacute;vil </th>
                                       <th> Tel&eacute;fono Nextel </th>
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
                       <select name="viaenvioseleccionada" id="viaenvioid" >
                           <option value="0" REQUIRED>Seleccione una V&iacute;a de Env&iacute;o</option> 
                       </select>
                   </td>
               </tr>
           </table>
       </div>
        <div id="footer">
            <hr />
        </div>
        <input type="hidden" value="<?=$id_empresa;?>" name="id_empresa" />
        <input type="submit" id="submit" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
    </form>
</div>
</body>
</html>