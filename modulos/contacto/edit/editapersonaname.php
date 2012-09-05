<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EDICION DE PERSONA</title>
        <!-- CSS ZONE -->
        <link href="../../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="../../../js/cargarDatos.js" type="text/javascript"></script>
        <script>
        var foo = "";    
        $(document).ready(function(){
            
            $.ajax({
                type:"GET",
                url:"../../../bl/Contacto/actualizaPersonaPorDocumento.php",
                dataType:"html",
                data:{
                    documento:<?=$_REQUEST['documentodni']?>
                },
                success:function(data){
                    toHtml(data);
                }
            });
             // HTML
             function toHtml(data)
             {
                $("#tmp").html(data);  
             }
        });
        </script>
    </head>
    <body class="fondo">
        <!-- editar compania -->
        <div id="divBuscarCompania" title="Escoge una empresa"></div>
        <div id="divEditarEspecialidad" title="Escoge una especialidad"></div>
        <div id="divEditarEspecialidadNuevo" title="Escoge una especialidad nueva"></div>
        
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE PERSONA</h1>
            </div>
        </div>
        <div id="main">
            <h1>EDICION DE PERSONA | <?=$_SESSION['usr']?></h1>
            <label for="nombre">Escriba el nombre de la persona:</label>
            <hr/>
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
