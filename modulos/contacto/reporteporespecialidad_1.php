<?php
$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);
require_once '../../bl/busca_persona/ListaPersonasTree_BL.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REPORTE POR ESPECIALIDAD</title>
        <!-- zona css -->
        <?php
        foreach ($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }
        ?>
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        
        <script>
            $(function(){
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url:"../../bl/busca_persona/ListaPersonasTree_BL.php",
                    success:function(data) {
                        $.each(data,function(index,value) {
                            $("#tbl_especialidades tbody").append(
                                '<tr>'+
                                '<td>'+
                                data[index].descripcion+
                                '</tr>'+
                                '</td>'
                            )
                        })
                    }
                })
            });
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REPORTE POR ESPECIALIDAD</h1>
            </div>
        </div>
        <div id="main">
            <div class="container">
                <table id="tbl_especialidades">
                    <thead>
                        <tr>
                            <td>Especialidad</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>