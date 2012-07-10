<?php
session_start(); 
$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function  __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

$contacto = new ContactoPersona();
$contactos = $contacto->mostrarContactos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRO LISTA DE DISTRIBUCION</title>
        <!-- zona css -->
        <?php
        foreach ($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />';
        }
        ?>
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/jquery.autocomplete.js" type="text/javascript"></script> 
        <script src="../../dl/contacto_bl/Obras/Obras.js"></script>
        <script src="../../js/jquery.form.js" type="text/javascript"></script>
        <script src="../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script>
        $(function(){
           var contador_contactos = 0;
            
            $("#modal-contactos").dialog({
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
            
            $("#anadir-contacto").button().click(function(){
                //limpiar las selecciones previas
                $('input:checkbox').removeAttr('checked');
                $("#modal-contactos").dialog("open");
                return false;
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
                    "<td>"+datos[index].empresa+"</td>"+
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
            
            /**
             * BUSCAR DATOS PARA EDITAR 
             * BTNPORNOMBRE
             */
            $("#btnBuscaPorNombre").click(function() {
                //var id = <?=$_SESSION['datos_empresa'][0]?>;
                $.ajax({
                    data:{id:id},
                    type:"GET",
                    dataType:"json",
                    url:"../../bl/Contacto/mantenimiento/registrolistadistribucion_llenarformulario.php",
                    success:function(data) {
                        //$("#contactos-agregados tbody").load(data);
                    } 
                });
            });
        });    
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                var options = {
                    success:muestraRespuesta
                    //clearForm:true
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
        <div >
        </div>
        <!--ventana modal para seleccionar los contactos-->
        <div id="modal-contactos" title="Seleccionar contactos">
                <div class="">
                    <table border="0">
                    <tr>
                        <td>
                            <?php
                            foreach ($contactos as $valor) {
                                echo '<input type="checkbox" name="contacto[]" value="'.
                                        $valor[0].
                                        '"/>'.
                                        strtoupper($valor[nombre]).
                                        '<br />';
                            }
                            ?>
                        </td>
                    </tr>
                    </table>
                </div>
        </div>
        <div id="main">
            <form id="frm-registralistadist" action="../../bl/busca_persona/registraListaDistribucion_BL.php" method="POST">
                <div class="info">
                Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
                </div>
                <table>
                    <tr>
                        <td><label>Nombre de la lista:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td><input class="nombre_lista" id="inputext" type="text" name="nombre" /></td>
                        <td><input id="btnBuscaPorNombre" type="button" value="Buscar..."/></td>
                    </tr>
                    <tr>
                        <td><label>Nombre de obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td><input id="inputext" class="obra" type="text" name="codigo" /></td>
                    </tr>
                    <tr>
                        <td><label>A&ncaron;adir Contacto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                        <td>
                            <button id="anadir-contacto">Agregar Contacto...</button>
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
                            <textarea name="observacion"></textarea>
                        </td>
                    </tr>
                </table>
                <div id="footer"><hr />
                </div>
                <input type="submit" id="submit" value="test" />
            </form>
        </div>
        <div id="id_session"></div>
    </body>
</html>