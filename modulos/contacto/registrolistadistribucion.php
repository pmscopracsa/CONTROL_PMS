<?php
/*
 * Este dato debe ser cambiado por los contactos
 */
$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function  __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
}

$especialidadcompania = new EspecialidadCompaniaDL();
$especialidades = $especialidadcompania->mostrarEspecialidades();
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
        <script>
        $(function(){
           
            $("#dialog:ui-dialog").dialog("destroy");
            
            /*
             * Eliminar elementos seleccionados de cotactos
             */
            $("#del-contacto").live("click",function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            
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
                $.each(datos,function(index,value){
                    $("#contactos-agregados tbody").append(
                    "<tr>"+
                    "<td>"+datos[index].id+"</td>" +
                    "<td>"+datos[index].descripcion+"</td>"+
                    "<td>"+"<a href='#' id='del-contacto' class='button delete'>Eliminar</a>"+"</td>"
                    +"</tr>"    
                    );
                })
            }          
            /*
             * auto completar obras
             */
            $(".obra").autocomplete("../../dl/contacto_bl/Obras.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
        });    
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REGISTRO LISTA DE DISTRIBUCION</h1>
               
            </div>
        </div>
        
        <!--ventana modal para seleccionar los contactos-->
        <div id="modal-contactos" title="Seleccionar contactos">
            <form autocomplete="off">
                <div class="">
                    <table border="0">
                    <tr>
                        <td>
                            <?php
                            foreach ($especialidades as $valor) {
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
            </form>
        </div>
        <div id="main">
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Nombre de la lista:</td>
                        <td><input id="inputext" type="text" name="nombre" /></td>
                    </tr>
                    <tr>
                        <td>C&oacute;digo de obra:</td>
                        <td><input id="inputext" class="obra" type="text" name="codigo" /></td>
                    </tr>
                    <tr>
                        <td>A&ncaron;adir Contacto:</td>
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
                                            <th>Id</th>
                                            <th>Nombre</th>
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
                        <td>
                            <textarea></textarea>
                        </td>
                    </tr>
                </table>
                <div id="footer"><hr />
                </div>
                <input type="submit" id="submit" value="test" />
            </form>
        </div>
    </body>
</html>