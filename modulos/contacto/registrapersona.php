<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

//unset($_REQUEST['nombre_empresa']);unset($_REQUEST['id_compania']);

//$css = scandir($CSS_PATH);

/*function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRO DE PERSONAS</title>
        <!-- zona css -->
        <link href="../../css/!style.css" rel="stylesheet" type="text/css" />
        <link href="../../css/areascroll.css" rel="stylesheet" type="text/css" />
        <link href="../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../css/buscar_flotante.css" rel="stylesheet" type="text/css" />        
        <link href="../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../css/datosobra.css" rel="stylesheet" type="text/css" />
        <link href="../../css/dos-columnas.css" rel="stylesheet" type="text/css" />
        <link href="../../css/email.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
        <link href="../../css/reveal/styles.css" rel="stylesheet" type="text/css" />
        <link href="../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../css/info.css" rel="stylesheet" type="text/css" />
        <link href="../../css/reveal/styles.css" rel="stylesheet" type="text/css" />
        <!--    ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/tfijo.js" type="text/javascript"></script>
        <script src="../../js/cargarDatos.js" type="text/javascript"></script>
        <script src="../../js/jquery.form.js" type="text/javascript"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="../../js/jquery.reveal.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        
        function recargarEspecialidades()
        {
            $("#seleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?filtro=1");
        }
    
        function recargarEspecialidadesPorFiltro(filtro)
        {
            $("#seleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?filtro="+filtro);
        }
        
        function recargarEmpresa(filtro) 
        {
            $("#divBuscarCompania").load("../datosdeobra/modales/empcontratante_div.php?filtro="+filtro);
        }
            
        $(document).ready(function(){
            <?php
            if(@$_REQUEST['nombre_empresa'] != "") {
            ?>
               $("#nombre_empresa").val("<?=@$_REQUEST['nombre_empresa']?>");     
               $("#txtidempresa").val("<?=@$_REQUEST['id_compania']?>");
               $("#btnBuscarCompania").css("display","none");
            <?php
            } 
            ?>
            /**
             * PRIMERA CARGA DE LA LISTA DE ESPECIALIDADES
             */
            $("#seleccionaEspecialidad").load("modal_registracompania/especialidades_div.php?filtro=1");
            
            /**
             * PRIMERA CARGA DE LA LISTA DE EMPRESAS
             */
            $("#divBuscarCompania").load("../datosdeobra/modales/empcontratante_div.php?filtro=1");
            
            var contador_especialidades = 0;
            var con_especia = 0;
            var contador_direccionlaboral = 0;
            /*
             * MODAL PÁRA SELECCIONAR ESPECIALIDAD(ES)
             */
            $("#seleccionaEspecialidad").dialog({
                autoOpen:false,
                height:300,
                width:450,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("txt_nombreEspecialidad").val("");
                        buscarEspecialidad();
                    },*/
                    "Limpiar":function() {
                      recargarEspecialidades();  
                    },
                    "Crear nueva especialidad":function(){
                        $("#divNuevaEspecialidad").dialog("open");
                    },
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            });
            
            /**
             * FUNCION PARA BUSCAR UNA ESPECIALIDAD
             */
             function buscarEspecialidad()
             {
                 $("#modal_buscarEspecialidadPorNombre").dialog("open");
             }
             
             /**
              * MODAL PARA ESCRIBIR LA ESPECIALIDAD A BUSCAR
              */
             $("#modal_buscarEspecialidadPorNombre").dialog({
                 autoOpen:false,
                 height:100,
                 width:450,
                 modal:true,
                 buttons:{
                     "Ok":function(){
                         if($("#txt_nombreEspecialidad").val() == "")
                             alert("Ingrese dato a buscar");
                         recargarEspecialidadesPorFiltro($("#txt_nombreEspecialidad").val());
                     },
                     "Cerrar":function(){
                         $(this).dialog("close");
                     }
                 }
             })
            
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
                    "Cerrar":function() {
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
            //cargar_departamentos();
            //cargar_distritos();
                    
            $("#paisid").change(function(){cargar_departamentos();})
            $("#departamentoid").change(function(){cargar_distritos();})
            $("#departamentoid").attr("disabled",true);
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
             * ESCOGER ESPECIALIDAD O ESPECIALIDADES
             */            
             $("#especialidades_boxes").live("click",function() {
                $.ajax({
                    data:{id:$(this).val()},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getEspecialidadCompania.php",
                    success:function(data) {
                        mostrarEspecialidadesScroll(data);
                    }
                })
             })
                        
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
                
                var valor_oculto_direccionestrabajo = $('<input type="hidden" name="cont_direccionestrabajo" value="'+contador_direccionlaboral+'"/>');
                valor_oculto_direccionestrabajo.appendTo("#cant_direccioneslaboral");
                
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
            /*$(".nombre_persona").autocomplete("../../bl/Contacto/mantenimiento/autocompletadoEmpresasPorContacto.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });*/
            $(".input-tipo-documento").focusout(function() {
                $.ajax({
                    type:"GET",
                    url:"../../bl/Contacto/mantenimiento/verificarExistenciaPersona.php",
                    data:{
                        documento:$(".input-tipo-documento").val()
                    },
                    success:function(data) {
                            if (data == "tiene") {
                                $("#numerodocumento").val($(".input-tipo-documento").val());
                                $('#modal').reveal({ 
                                    animation: 'fade',            
                                    animationspeed: 600,          
                                    closeonbackgroundclick: false,
                                    dismissmodalclass: 'close'    
                            });
                        }
                    }
                });
            });
             $("#btnContinuar").click(function(e) {
                   e.preventDefault();
                   window.location = "registrapersona.php"

              });
              $("#btnModificar").click(function(e) {
                  e.preventDefault(e);
                  var documento = String($("#numerodocumento").val());
                  window.location = "edit/editapersonaname.php?documentodni='"+documento+"'";
              });
      
      /**
       *  BUSQUEDA IN LINE
       */
      $("#btnSearchEspecialidad").live("click",function() {
          recargarEspecialidadesPorFiltro($("#txt_divEspecialidadBuscar").val());
      });
      
      /**
       * BUSCAR EMPRESA
       */ 
      // BOTON PARA ABRIR MODAL DE EMPRESA
      $("#btnBuscarCompania").click(function() {
          $("#divBuscarCompania").dialog("open");
      });
      // MODAL PARA LA BUSQUEDA DE EMPRESA
      $("#divBuscarCompania").dialog({
          autoOpen:false,
          height:300,
          width:350,
          modal:true,
          buttons:{
              "Cerrar":function() {
                  $(this).dialog("close");
              }
          }
      });
      // BUSCADOR DE EMPRESA
      $("#btnSearchEmpContratante").live("click",function() {
          recargarEmpresa($("#txt_divEmpContratanteBuscar").val());  
      });
      
      // ASIGNAR EMPRESA A CAMPO
      $('.contratante').live("click",function(){
           var contratante_array = $(this).text().split("-");
           var cli = contratante_array[1];
           var contratante_id = contratante_array[0];
           $(".nombre_empresa").val(cli);
           $("#txtidempresa").val(contratante_id);
      });
      
      //  CARGAR DIRECCIONES DE TRABAJO DE LA EMPRESA
      $("#btnDireccionTrabajo").click(function() {
          $("#modal-direcciontrabajo").empty();
          
          if ($("#nombre_empresa").val() == "") {
              alert("Debe elegir la empresa primero.");
              $("#divBuscarCompania").dialog("open");
          } else {
              $.ajax({
                  dataType:"html",
                  type:"GET",
                  data:{
                      idcompania:$("#txtidempresa").val()
                  },
                  url:"modal_registracompania/moda-direccionescompania.php",
                  success:function(data){
                      $("#modal-direcciontrabajo").append(data);
                      $("#modal-direcciontrabajo").dialog("open");
                  }
              })
          }
      })
      
      // MODAL PARA DIRECCIONES DE LA EMPRESA
      $("#modal-direcciontrabajo").dialog({
        modal:true,
        autoOpen:false,
        height:300,
        width:350,
        buttons:{
            "Cerrar":function() {
                $(this).dialog("close");
            }
        }
      })
      
      // SELECCION DE LA DIRECCION DE LA COMPANIA
      $("#direccioncompaniabox").live("click",function(){
            contador_direccionlaboral++;
          direccion = $(this).parent().parent().children("#txtDireccion").text();
          iddireccion = $(this).parent().parent().children().children("#direccioncompaniabox").val();
          // VISUALMENTE LO PONEMOS EN LA TABLA
          $("#tbl-listadirecciones tbody").append(
                '<tr>'+
                    '<td>'+direccion+
                    '<input type="hidden" id="iddireccion" value="'+iddireccion+'" name="direlaboral'+contador_direccionlaboral+'"/>'+
                    '<td><a href="#" id="btnEliminarDireccionCompania" class="button delete">Eliminar</a>'
          )   
      });
      // ELIMINAR la direccion de la empresa
      $("#btnEliminarDireccionCompania").live("click",function(e) {
          contador_direccionlaboral--;
          e.preventDefault();
          $(this).parent().parent().remove();
      })
             
        });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                
                $("#frm-regpersona").bind("keypress",function(e){
                    if(e.keyCode == 13) return false;
                })
                
                var options = {
                    success:muestraRespuesta
                    //clearForm:true
                };
                $("#frm-regpersona").ajaxForm(options);
            });
            
            function muestraRespuesta(responseText, statusText, xhr, $form) {
                <?php unset($_REQUEST['nombre_empresa']);unset($_REQUEST['id_compania'])?>
                alert("Los datos han sido ingresados correctamente");
                window.setTimeout('location.reload()',1000);
            }
        </script>
    </head>
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
        
        <!-- modal escoge empresa -->
        <div id="divBuscarCompania" title="Escoge una empresa"></div>
        
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REGISTRO DE PERSONAS</h1>
            </div>
        </div>
        
        <div id="main">
            <form action="../../bl/busca_persona/registraPersona_BL.php" method="POST" id="frm-regpersona">
<!--                <form action="registratest.php" method="POST" id="frm-regpersona">-->
                    <input type="hidden" name="idEmpresa" value="<?=@$_SESSION['id']?>" />
                <div class="info">
                Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
                </div>
                <table>
                    <tr>
                        <td>Tipo documento:</td>
                        <td>
                            <select id="cmb_tipodocumento" name="tipo-documento">
                                <option value="0">Seleccionar tipo de documento</option>
                            </select>
                         
                             <input  class="input-tipo-documento" size="8" type="text" name="numero-documento" id="inputext" required/><em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                             <input type="hidden" id="numerodocumento" />
                    </tr>
                    <tr>
                        <td>¿Tiene RUC?
                        <td>
                            <input type="radio" name="tieneruc" value="si">Si<br>
                            <input type="radio" name="tieneruc" value="no">No<br>
                            
                            <div class="td-ruc-checkbox" style="display: none;">
                            <input placeholder="RUC" type="text" id="inputext" name="ruc" class="txtruccarne"/>
                            </div>
                            
                    <tr>
                        <td>Nombres y Apellidos:</td>
                        <td><input class="nombre_persona" id="inputext" type="text" size="70"  name="nombre" required="required"/>
                            <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Compania:</td>
                        <td>
                            <input class="nombre_empresa" id="nombre_empresa" type="text" size="70"  name="companiaseleccionada" READONLY required="required" />
                            <input type="button" id="btnBuscarCompania" value="Buscar Compania" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                    <input type="hidden" name="txtidempresa" id="txtidempresa"/>
                    </tr>
                        <td>Cargo:</td>
                        <td><input id="inputext" type="text" size="25" name="cargo" />
                            <em><img src="../../img/required_star.gif" alt="dato requerido" required="required"/></em>
                        </td>
                    </tr>
                    <tr>
                    <td>Tel&eacute;fono Fijo:</td>
                    <td>
                        <table border="0" class="atable">
<!--                            <tr>
                                <th></th>
                                <th colspan="2"></th>
                            </tr>-->
                            <tr>
                                <td><input type="text" size="15" name="telefonofijo" /></td>
                                <td><input type="button" class="addRow" />
                                    <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                                </td>
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
                    <td>Tel&eacute;fono M&oacute;vil:</td>
                    <td>
                    <table>
<!--                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>-->
                        <tr>
                            <td><input type="text" size="15" name="telefonomovil" /></td>
                            <td><input type="button" class="addRow" />
                                <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                            </td>
                            <td><input type="button" class="delRow" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tmovil" />
                    </table>

                </td>
                </tr>
                <tr>
                    <td>Tel&eacute;fono Nextel:</td>
                    <td>
                        <table>
<!--                        <tr>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>-->
                        <tr>
                            <td><input type="text" size="15" name="telefononextel" /></td>
                            <td><input type="button" class="addRow" />
                                <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                            </td>
                            <td><input type="button" class="delRow" /></td>
                        </tr>
                        <input type="hidden" class="rowCount" name="filas_tnextel" />
                    </table>
                    </td>
                </tr>
                <tr>
                    <td>Direcci&oacute;n Personal:</td>
                    <td>
                        <input type="button" id="agregarDireccion" value="Agregar Direccion" class="ui-button ui-widget ui-state-default ui-corner-all" /><em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                        <div id="seleccionaDireccion" style="display:none">
                            <table border="0" class="atable">
                                 <tr>   
                                     <td class="tr-padding">
                                        <label>Direcci&oacute;n:</label>
                                        <input class="direccion_lbl derecha-inline" id="inputext" type="text" size="25" name="direccion" required="required"/>
                                    </td>
                                 <tr>
                                     <td class="tr-padding">
                                         <label>Pa&iacute;s</label>
                                         <select class="derecha-inline" name="paisseleccionada" id="paisid">
                                             <option value="0">Seleccionar Pa&iacute;s</option>
                                         </select>
                                     </td>
                                 <tr>   
                                    <td class="tr-padding">
                                        <label>Departamento/Estado:</label>
                                        <select class="derecha-inline" name="departamentoseleccionada" id="departamentoid">
                                                <option value="0">Seleccionar departamento</option>
                                            </selected>
                                    </td>
                                 <tr>   
                                  <tr>  
                                    <td class="tr-padding">
                                        <label>Distrito:</label>
                                        <select class="derecha-inline" name="distritoseleccionada" id="distritoid">
                                                <option value="0">Seleccione un distrito</option>
                                            </select>
                                    </td>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Direcci&oacute;n del centro de trabajo:
                    <td><input type="button" value="Agregar Direccion Laboral" id="btnDireccionTrabajo" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
                        <div id="modal-direcciontrabajo" title="Direccion del Trabajo"></div>
                        <input type="hidden" id="txtiddirecciontrabajo" />    
                </tr>
                <tr>
                    <td>Lista de direcciones</td>
                    <td>
                        <div class="areaScrollModal" id="lista-direcciones">
                            <table id="tbl-listadirecciones" class="ui-widget">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody><tr></tr></tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Especialidad:</td>
                    <td>
                        <input type="button" id="agregarEspecialidad" value="Buscar Especialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/><em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                        <div id="seleccionaEspecialidad" title="Agregar Especialidad" style="display: none" ></div>
                    </td>
                    
                    <div id="divNuevaEspecialidad" title="Crear nueva especialidad" style="display: none">
                        <label>Especialidad:</label>
                        <input id="inputext" class="input-descripcion" type="text" />
                        <input id="btn-nuevaespecialidad" type="button" value="Crear" />
                    </div> 
                <!-- MODAL PARA BUSCAR ESPECIALIDAD POR NOMBRE -->
                <div id="modal_buscarEspecialidadPorNombre" title="Buscar Especialidad" style="display: none">
                    <label>Nombre de especialidad:</label>
                    <input type="text" id="txt_nombreEspecialidad" />
                </div> 
                </tr>
                <tr>
                    <td>Lista de especialidades:</td>
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
                    <td>Observaci&oacute;n:</td>
                    <td><textarea cols="114" rows="5" name="observacion"></textarea></td>
                </tr>
                <tr>
                    <td>Email principal:</td>
                    <td><input id="inputext" type="email" size="30" placeholder="" name="email" required="required"/>
                        <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                    </td>
                </tr>
                <tr>
                    <td>Email secundario(s):
                    <td>
                        <table border="0" class="atable">
<!--                            <tr>
                                <th>
                                <th colspan="2">
                            </tr>-->
                            <tr>
                                <td class="atable"><input type="text" size="15" size="50" name="emailsecundario" />
                                <td><input type="button" class="addRow" />
                                <td><input type="button" class="delRow" />
                            </tr>
                            <input type="hidden" class="rowCount" name="filas_emailsecundario" />   
                        </table>
                       
                <tr>
                    <td>Web:</td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="web" required="required"/></td>
                </tr>
                <tr>
                    <td>Fax:</td>
                    <td><input id="inputext" type="text" size="30" placeholder="" name="fax" required="required"/></td>
                </tr>
                <tr>
                    <td>V&iacute;a de Env&iacute;o:</td>
                    <td>
                        <select name="viaenvioseleccionada" id="viaenvioid">
                            <option value="0">Seleccione una V&iacute;a de Env&iacute;o</option> 
                        </select>
                        <em><img src="../../img/required_star.gif" alt="dato requerido" /></em>
                    </td>
                </tr>
                </table>
                <!-- VALORES OCULTOS -->
                <div id="cant_especialidades"></div>
                <div id="cant_direccioneslaboral"></div>
                <div id="footer">
            <hr />
        </div>
        <input type="submit" id="submit" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all" />
            </form>
        </div>
        
    </body>
</html>