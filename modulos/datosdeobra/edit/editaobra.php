<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editar Obra</title>
        <link href="../../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../../js/obra/liveClick.jquery.js" type="text/javascript"></script>
        <script src="../../../js/obra/modals.js" type="text/javascript"></script>
        <script src="../../../js/obra/loadData.js" type="text/javascript"></script>
        <script>
        var tipobusqueda = "";
        
        $(document).ready(function() {
            $.ajax({
                type:"GET",
                url:"../../../bl/Contacto/actualizaObra.php",
                dataType:"html",
                data:{
                    idObra:<?=$_REQUEST['idobra']?>
                },
                success:function(data){
                    toHtml(data);
                    cargarDepartamento($("#iddepartamento").val());
                    cargarMoneda($("#idmoneda").val());
                    cargarTipoValorizacion($("#idtipovalorizacion").val());
                    cargarFormatoPresupuesto($("#idformatopresupuesto").val());
                }
            });
                        
            function toHtml(data){
                $("#tmp").html(data);
            }
            
            $(".txtfinicio").live("focus",function() {
                $(this).datepicker();
            })
            
            $("#btnPPtoVenta").click(function() {
                $("#foobar").dialog("open");
            })
        });    
        </script>
    </head>
    <body class="fondo">
        <!-- MODALS -->
        <!-- cliente -->
        <div id="modal_cliente" title="Seleccione al cliente"></div>
        <!-- contratante -->
        <div id="modal_contratante" title="Seleccione la Empresa Contratante"></div>
        <!-- gerente -->
        <div id="modal_gerente" title="Seleccione al Gerente del Proyecto"></div>
        <!-- supervisor -->
        <div id="modal_supervisor" title="Seleccione al Supervisor"></div>
        <!-- proveedor -->
        <div id="modal_proveedor" title="Seleccione al Proveedor"></div>
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE OBRA</h1>
            </div>
        </div>
        <div id="main">
            <h1>EDICION DE OBRA</h1>
            <HR />
            <div id="tmp"></div>
        </div>
    </body>
</html>
