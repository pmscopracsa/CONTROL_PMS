<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

/**
 *AGREGAR MAIL COMO CAMPO EN LA TABLA USUARIO 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ENVIO DE MAILS</title>
        <?php
        foreach($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }
        ?>
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        
            
        $(document).ready(function(){
            function recargarRepresentantes() {
                $("#divSeleccionaRepresentante").load("../contacto/modal_registracompania/representantes_div.php?filtro=1");
            }    
        
            $("#divSeleccionaRepresentante").load("../contacto/modal_registracompania/representantes_div.php?filtro=1");
            
            $("#btnAgregarRepresentante").click(function() {
                $("#divSeleccionaRepresentante").dialog("open");
            });
            
            $("#divSeleccionaRepresentante").dialog({
                autoOpen:false,
                height:350,
                width:450,
                modal:true,
                buttons:{
                    "Buscar":function() {
                        $("#txt_nombreRepresentante").val("");
                    },
                    "Limpiar":function() {
                        recargarRepresentantes();
                    },
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
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
                });
            });
            
            function mostrarRepresentantesScroll(data) {
                $.each(data,function(index,value) {
                    datos = "<tr>"+
                    "<td>"+data[index].nombre+"</td>"+
                    "<td>"+data[index].email+"</td>"+
                    "<td>"+data[index].cargo+"</td>"+
                    "<td><a href='#' id='del-representante' class='button delete'>Eliminar</a></td>"+
                    "</tr>";
                    $("#tbl-listarepresentantes tbody").append(datos);
                });
            }
            
            $("#del-representante").live("click",function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
        });   
        
        
        
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">ENVIO DE CORREO</h1>
            </div>
        </div>
        <div id="main">
            <div id="page-wrap">
                <div id="contact-area">
                    <form method="POST" action="">
                        <label for="Nombre">Remitente:</label>
                        <input type="text" name="txtnombre" id="idtxtnombre" value="<?=@$_SESSION['nombre_real']?>"READONLY/>
                        <label for="Destinatarios">Destinatario(s):</label>
                        <input type="button" id="btnAgregarRepresentante" value="Buscar contactos" class="ui-button ui-state-default ui-corner-all" />
                        <div id="divSeleccionaRepresentante" title="Agregar destinatarios"></div>
                        <div class="areaScrollModal" id="lista-representantes">
                            <table id="tbl-listarepresentantes" class="ui-widget" border="0">
                                <thead>
                                    <tr class="ui-widget-header">
                                        <th>Nombres</th>
                                        <th>Email</th>
                                        <th>Cargo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>

                        <label for="mensaje">Mensaje:</label>
                        <textarea name="mensaje" rows="20" cols="20" id="txtmensaje"></textarea>
                        <input type="submit" name="submit" value="Enviar" class="submit-button" />
                    </form>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </body>
</html>
