<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function  __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

//$contacto = new ContactoPersona();
//$contactos = $contacto->mostrarContactos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRO LISTA DE DISTRIBUCION</title>
        <!-- zona css -->
        <?php
        /*foreach ($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />';
        }*/
        ?>
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
        <link href="../../css/fieldset_edit.css" rel="stylesheet" type="text/css" />
        <link href="../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../css/login1.css" rel="stylesheet" type="text/css" />
        <link href="../../css/mensajes.css" rel="stylesheet" type="text/css" />
        <link href="../../css/info.css" rel="stylesheet" type="text/css" />
        <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
        
        <link href="../../css/reveal/styles.css" rel="stylesheet" type="text/css" />
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/jquery.autocomplete.js" type="text/javascript"></script> 
        <script src="../../dl/contacto_bl/Obras/Obras.js"></script>
        <script src="../../js/jquery.form.js" type="text/javascript"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="../../js/jquery.reveal.js" type="text/javascript"></script>
        <script>
        function recargarRepresentantes()
        {
            $("#modal-contactos").load("modal_registracompania/representantes_div.php?filtro=1");
        }
        
        function recargarRepresentantesPorFiltro(filtro)
        {
            $("#modal-contactos").load("modal_registracompania/representantes_div.php?filtro="+filtro);
        }
            
        $(function(){
            /**
             * FUNCION QUE DETECTA ABANDONO O REFRESCO DE LA PAGINA
             */
            /*$(window).bind('beforeunload', function() {
            });*/   
           /**
            * PRIMERA CARGA DE REPRESENTANTES 
            */ 
           $("#modal-contactos").load("modal_registracompania/representantes_div.php?filtro=3");
            
           var contador_contactos = 0;
            
            $("#modal-contactos").dialog({
                autoOpen:false,
                height:300,
                width:350,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_nombreRepresentante").val("");
                        buscarRepresentante();
                    },*/
                    "Limpiar":function() {
                        recargarRepresentantes();
                    },
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            });
            
            /**
             * MODAL PARA BUSCAR CONTACTOS
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
                    "Ok":function() {
                        if ($("#txt_nombreRepresentante").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarRepresentantesPorFiltro($("#txt_nombreRepresentante").val());
                    },
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            })
            
            $("#anadir-contacto").click(function(){
                $("#modal-contactos").dialog("open");
            });
            
            /*
             *Evento para mostrar registro desde la base de datos
             *en una ventana modal.
             *Seleccionarlo con un click en el chec y pasarlos al padre
             */          
            $('input:checkbox[name=contacto[]]').click(function(){
                var id = $(this).val();
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
            
            /**
             * 
             */
            $("#representantes_boxes").live("click",function() {
                $.ajax({
                    data:{id:$(this).val()},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getRepresentante.php",
                    success:function(data) {
                        resultados(data);
                    }
                });
            });
            
            /*
             * Agregar los contactos al scroll - area
             */
            function resultados(datos)
            {
                contador_contactos++;
                $.each(datos,function(index,value){
                    $("#contactos-agregados tbody").append(
                    "<tr>"+
                    "<td>"+datos[index].nombre+"</td>"+
                    "<td>"+datos[index].descripcion+"</td>"+
                    "<td>"+"<a href='#' id='del-contacto' class='button delete'>Eliminar</a>"+"</td>"+
                    '<input type="hidden" name="contacto'+contador_contactos+'" value="'+datos[index].id+'" />'+
                    "</tr>"    
                    );
                });
            }
            
            /**
             * ELIMINAR DEL SCROLLBAR AL ELEMENTO SELECCIONADO
             */
            $("#del-contacto").live("click",function(e){
                contador_contactos--;
                e.preventDefault();
                $(this).parent().parent().remove();
            })
            
            /*
             * auto completar obras
             */
            $(".obra").autocomplete("../../dl/contacto_bl/Obras.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            
            /**
             * CREAR INPUT QUE TENDRA LA CANTIDAD DE CONTACTOS
             */
            $("#submit").click(function(){
                var canti_contactos = $('<input type="hidden" name="contador_contactos" value="'+contador_contactos+'"/>');
                canti_contactos.appendTo("#canti_contactos");                
            });
            
            /**
             * AUTOCOMPLETAR POR NOMBRE DE LISTA
             */
            $(".nombre_lista").autocomplete("../../bl/Contacto/mantenimiento/autocompletadoListaDistribucionPorNombre.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            
            $(".nombre_lista").focusout(function() {
                $.ajax({
                   type:"GET",
                   url:"../../bl/Contacto/mantenimiento/verificarExistenciaLista.php",
                   data:{nombre_lista:$(".nombre_lista").val()},
                   success:function(data) {
                       if (data == "tiene") {
                           $.ajax({
                               type:"GET",
                               dataType:'json',
                               url:"../../bl/Contacto/mantenimiento/devuelveListaId.php",
                               data:{
                                   nombrelista:$(".nombre_lista").val()
                               },
                               success:function(data) {
                                   res(data);
                               }
                           });
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
            
      function res(data){
        $.each(data, function(index,value) {
            $("#idLista").val(data[index].id);
        })
      }      
            
      $("#btnContinuar").click(function(e) {
          e.preventDefault();
          window.location = "registrolistadistribucion.php";
          
      })
      $("#btnModificar").click(function(e) {
          e.preventDefault();
          window.location = "edit/editalistadistribucionpornombre.php?parameter="+$("#idLista").val();
      })
            /**
             * BUSCAR DATOS PARA EDITAR 
             * BTNPORNOMBRE
             */
            $("#btnBuscaPorNombre").click(function() {
                var id = '<?= isset($_SESSION['datos_empresa'][0]) ? $_SESSION['datos_empresa'][0] : "No definido aun" ?>';
                var observacion = '<?= isset($_SESSION['datos_empresa'][2]) ? $_SESSION['datos_empresa'][2] : "No definido aun" ?>';
                alert(id);
                $("textarea#observacion").val(observacion);
            });
            
            /**
             * BUSCAR DATOS PARA EDITAR POR NOMBRE DE OBRA
             */
            $("#btnBuscarPorObra").click(function() {
                
            })
            
            /***
             * BUSQUEDA IN LINE
             */
            $("#btnSearchRepresentante").live("click",function() {
                recargarRepresentantesPorFiltro($("#txt_divRepresentanteBuscar").val());
            });
        });    
        </script>
        <script type="text/javascript">
            $("#frm-registralistadist").bind("keypress",function(e){
                if(e.keyCode == 13) return false;
            })
            
            $(document).ready(function(){
                var options = {
                    success:muestraRespuesta
                };
                $("#frm-registralistadist").ajaxForm(options);
            });

            function muestraRespuesta(responseText, statusText, xhr, $form) {
                alert("Los datos han sido ingresados correctamente");
                window.setTimeout('location.reload()',1000);
            }
        </script>
    </head>
    <body >
         <!-- INICIO MODAL -->
    <div id="modal">
	<div id="heading">
                La lista de distribucion que desea ingresar ya existe
	</div>

	<div id="content">
		<p>Dele click a <b>"Continuar"</b> si desea seguir usando este formulario. De lo contrario <b>"Modificar"</b></p>

                <a href="#" id="btnContinuar" class="button green close"><img src="../../css/reveal/images/tick.png">Continuar</a>

		<a href="#" id="btnModificar" class="button red close"><img src="../../css/reveal/images/cross.png">Modificar</a>
	</div>
    </div>
    <!-- FIN MODAL -->
        <div >
        </div>
        <!-- ventana modal para seleccionar los contactos -->
        <!--                                              -->
        <div id="modal-contactos" title="Seleccionar contactos"></div>
        <div id="modal_buscarRepresentantePorNombre" title="Buscar contacto" style="display: none">
            <label>Nombre del contacto</label>
            <input type="text" id="txt_nombreRepresentante" />
        </div>
        <!-- modal de cargando... -->
        <div id="modal_cargando" class="clearfix" style="display: none">
            <img src="../../img/indicator.gif" />
        </div>    
        
        
        <div id="main">
            <form id="frm-registralistadist" action="../../bl/busca_persona/registraListaDistribucion_BL.php" method="POST">
<!--                <form id="frm-registralistadist" action="registratest.php" method="POST">-->
                <div class="info">
                Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
                </div>
                <table>
                    <tr>
                        <td><label>Nombre de la lista:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <input type="hidden" id="idLista" />
                        <td><input class="nombre_lista" id="inputext" type="text" name="nombre" required="required"/></td>
                    </tr>
                    <tr>
                        <td><label>Nombre de obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td><p><?=$_REQUEST['obra']?></p>
                    <input type="hidden" name="idtxtobra" value="<?=@$_REQUEST['codigo']?>"/>
                    <input type="hidden" name="idEmpresa" value="<?=@$_SESSION['id']?>" />
                    </tr>
                    <tr>
                        <td><label>A&ncaron;adir Contacto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td>
                            <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all" id="anadir-contacto" value="Buscar Contacto" />
                        </td>
                    </tr>
                    <tr>
                        <td>Lista de Contactos:</td>
                        <td>
                           
                            <div class="areaScrollModal" id="lista-contactos">
                                <table id="contactos-agregados" class="ui-widget ui-widget-content">
                                    <thead>
                                        <tr class="ui-widget-header">
                                            <th>Contacto</th>
                                            <th>Empresa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <!-- input con cantidad de contactos -->
                    <div id="canti_contactos"></div>
                    <tr>
                        <td>Observaci&oacute;n:</td>
                        <td>
                            <textarea id="observacion" name="observacion" rows="5" cols="113"></textarea>
                        </td>
                    </tr>
                </table>
                <div id="footer"><hr />
                </div>
                <input type="submit" id="submit" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all" />
            </form>
        </div>
        <div id="id_session"></div>
    </body>
</html>