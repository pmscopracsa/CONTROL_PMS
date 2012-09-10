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
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
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
                }
            });
            
            function toHtml(data){
                $("#tmp").html(data);
            }
            
            /** Editar fecha de inicio */
            $("#btnModificaFechaInicio").live("click",function() {
                if ($(this).val() === "Modificar") {
                    $(this).attr('value', 'Guardar');
                    $(".txtfinicio").removeAttr('readonly');
                } else {
                    if ($(".txtfinicio").val() === "") {
                        alert("La fecha de inicio esta en blanco, corrija por favor.");
                    } else {
                        $.ajax({
                            type:"POST",
                            url:"",
                            data:{
                                
                            },
                            success:function() {
                                $(".txtfinicio").attr('readonly', 'true');
                            }
                        });
                    }
                }
            });
            /** Editar fecha de fin */
            $("#btnModificaFechaFin").live("click",function() {
                if ($(this).val() === "Modificar") {
                    $(this).attr('value', 'Guardar');
                    $(".txtffin").removeAttr('readonly');
                } else {
                    if ($(".txtffin").val() === "") {
                        alert("La fecha de fin esta en blanco, corrija por favor.");
                    } else {
                        $.ajax({
                            type:"POST",
                            url:"",
                            data:{
                                
                            },
                            success:function() {
                                $(".txtffin").attr('readonly', 'true');
                            }
                        });
                    }
                }
            });
            /** Editar direccion de obra */
            $(".btnModificaDireccion").live("click",function() {
                if ($(this).val() === "Modificar") {
                    $(this).attr('value','Guardar');
                    $(".direccion").removeAttr('readonly');
                } else {
                    if ($(".direccion").val() === "") {
                        alert("Ingrese una direccion or favor.")
                    } else {
                        $.ajax({
                            type:"POST",
                            url:"",
                            data:{
                                
                            },
                            success:function() {
                                $(".direccion").attr('readonly', 'true');
                            }
                        });
                    }
                }
            });
            /** Edita departamento */
            /** Edita moneda */
            /** Edita Cliente */
            
        });    
        </script>
    </head>
    <body class="fondo">
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
