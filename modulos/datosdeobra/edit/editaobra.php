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
                    cargarContactos(<?=$_REQUEST['idobra']?>);
                    cargarContactoPuesto(<?=$_REQUEST['idobra']?>);
                }
            });
                        
            function toHtml(data){
                $("#tmp").html(data);
            }
            
            function reload() {
                alert("clock");
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
                        cargarContactos(<?=$_REQUEST['idobra']?>);
                    }
                });
            }
            
            $(".txtfinicio").live("focus",function() {
                $(this).datepicker();
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
        <!-- contactos -->
        <div id="modal_contactos" title="Selecciona contactos"></div>
        <!-- asignar firmas a reportes #1 -->
        <div id="div-firmas-1" title="Firmas">
            <table id="tbl-firmas1">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Puesto
                        <th>Contacto
                        <th>Compa&ncaron;&iacute;a    
                    </tr>
                </thead>
                <tbody><tr></tr></tbody>
            </table>
        </div>
        <!-- seleccionar contactos -->
        <div id="div-addcontactos" title="Contactos">
            <table border="0" class="atable">
                <tr>
                    <td class="tr-padding">
                        <label>Contacto</label>
                        <input type="text" size="30" class="txt-contacto" id="inputext" name="contacto" READONLY />
                        <input type="button" id="btn-addContacto" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        <input type="hidden" class="txt-idcontacto" name="txt_idcontacto" />
                        
               <tr>
                    <td class="tr-padding">
                        <label>Posici&oacute;n</label>
                        <input type="text" size="30" class="txt-puesto" id="inputext" name="posicion" />         
                        
               <tr>
                    <td class="tr-padding">
                        <label>Compa&nacute;&iacute;a</label>
                        <input type="text" size="30" class="txt-compania" id="inputext" name="compania" READONLY />
                        
               <tr>
                   <td class="tr-padding">
                       <input type="button" id="btn-agregarContacto" class="ui-button ui-widget ui-state-default ui-corner-all" value="Agregar" />
            </table>
        </div>
        <!--  -->
        <?php
        require_once '../modales/modal-addContacto.php';
        require_once '../modales/modal-mostrarlistareportes.php';
        require_once '../modales/modal_r_listaContactoPosicion.php';
        ?>
        
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
