<?php 
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

setlocale(LC_ALL, "es_ES");

$directorio_id = 0;
$obra_id = 0;

/**
 * RECIEN AL DARLE SUBMIT LOS VALORES:
 * id de la empresa
 * id del directorio
 * id de la obra
 * SERAN ALMACENADOS EN LAS VARIABLES DE
 * SESION, CASO CONTRARIO SE ESTARAN SOBRE ESCRIBIENDO
 * CON ALTAS PROBABILIDADES DE QUEDARSE PEGADO
 * ALGUN VALOR NO DESEADO
 * 
 * PARA HACER EL CAMBIO EN CALIENTE DEL DIRECTORIO Y DE LA OBRA SE PONDRÁ
 * EN LA PARTE SUPERIOR UNA PESTAÑA QUE SE MUESTRA POR DEMANDA. DICHA PESTAÑA
 * NOS MOSTRARA 2 COMBOS ASOCIADOS (DIRECTORIO & OBRA). 
 * AL SELECCIONAR OTRO DIRECTORIO - OBRA EN CALIENTE PREGUNTAR AL USUARIO SI DESEA
 * PROSEGUIR CON E CAMBIO, YA QUE LOS DATOS HASTA ESE MOMENTO ESCRITOS EN EL FORMULARIO
 * SERÁN BORRADOS, TANTO DE TABLAS TEMPORALES COMO DE VARIABLES DE SESION 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SETEO DE TRABAJO</title>
        <link rel="stylesheet" href="../../js/wizard/css/formToWizard.css" /> 
        <link rel="stylesheet" href="../../js/wizard/css/validationEngine.jquery.css" />
        <link rel="stylesheet" href="../../index_box/index.css" />
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.18.custom.css" />
        
        <script src="../../js/jquery-1.7.1.min.js"></script> 
        <script src="../../js/calendar/jquery-ui-1.8.18.custom.min.js"></script>
        <script src="../../js/wizard/jquery.formToWizard.js"></script> 
        <script src="../../js/wizard/jquery.validationEngine.js"></script> 
        <script src="../../js/wizard/jquery.validationEngine-en.js"></script> 
        <style>
        body { font-family:Lucida Sans, Arial, Helvetica, Sans-Serif; font-size:13px; margin:20px;}
        #header { text-align:center; border-bottom:solid 1px #b2b3b5; margin: 0 0 20px 0; }
        fieldset { border:none; width:320px;}
        legend { font-size:18px; margin:0px; padding:10px 0px; color:#b0232a; font-weight:bold;}
        label { display:block; margin:15px 0 5px;}
        input[type=text], input[type=password] { width:300px; padding:5px; border:solid 1px #000;}
        
        button, .prev, .next { background-color:#b0232a; padding:5px 10px; color:#fff; text-decoration:none;}
        button:hover, .prev:hover, .next:hover { background-color:#000; text-decoration:none;}

        button { border: none; }

        #controls { background: #eee; box-shadow: 0 0 16px #999; height: 30px; position: fixed; padding: 10px; top: 0; left: 0; width: 100%; z-index: 1 }
        #controls h1 { color: #666; display: inline-block; margin: 0 0 8px 0 }
        #controls input[type=text] { border-color: #999; margin: 0 25px; width: 120px }
        
        #steps { margin: 80px 0 0 0 }
        </style>
    <script>
    /**
     * CARGA DE LOS DIRECTORIOS SIN FILTRO (PARA RECARGAR SIN FILTRO) Y POR FILTRO (CUANDO SE DESEA BUSCAR DE UNA LARGA LISTA)
     */    
    function recargarDirectorio() {
        $("#divSeleccionaDirectorio").load("modales_seteo/div_seleccionaDirectorio.php?filtro=1");
    }
    function recargarDirectorioBusqueda(filtro) {
        $("#divSeleccionaDirectorio").load("modales_seteo/div_seleccionaDirectorio.php?filtro="+filtro+"&idEmpresa="+<?=$_SESSION['id']?>);
    }
    
    /**
     * CARGA DE LAS OBRAS SIN FILTRO (PARA RECARGAR SIN FILTRO)  Y POR FILTRO (CUANDO SE DESEA BUSCAR DE UNA LARGA LISTA)
     */
    function recargarObraBusqueda(filtro) {
        $("#divSeleccionaObra").load("modales_seteo/div_seleccionaObra.php?filtro="+filtro+"&idEmpresa="+<?=$_SESSION['id']?>);
    }
    
    function cargarObras(idEmpresa,idDirectorio)
    {   
        $.ajax({
            type:"GET",
            url:"modales_seteo/div_seleccionaObra.php",
            data:{idEmpresa:idEmpresa,idDirectorio:idDirectorio,filtro:1},
            success:function(data) {
                $("#divSeleccionaObra").html(data);
            }
        });
    }
        
    $(document).ready(function() {
        $("body").css("display","none");
        $("body").fadeIn(2000);
        
        /**
         * CARGAR EL TIPO DE CAMBIO AL DIA
         */
        $.ajax({
            type:"GET",
            dataType:"html",
            url:"../../bl/ConfiguracionGeneral/configuracionGeneral.php?parametro=cargarcambio",
            data:{idempresa:<?=$_SESSION['id']?>},
            success:function(data) {
                $("#infocambiomoneda").html(data);
            },error:function() {
                alert("Error");
            }
        });

        var $seteo = $("#seleccionprevia");
        $seteo.validationEngine();
        
            $seteo.formToWizard({
                submitButton:'setuped',
                showProgress:true,
                nextBtnName:'Siguiente >>',
                prevBtnName:'<< Atrás',
                showStepNo:false,
                validateBeforeNext:function() {
                    return $seteo.validationEngine('validate');
                }
            });
       
       /**
        * CARGA POR DEFECTO DE LOS DIRECTORIOS
        */
       $("#divSeleccionaDirectorio").load("modales_seteo/div_seleccionaDirectorio.php?filtro=1"+"&idEmpresa="+<?=$_SESSION['id']?>);
        
        /**
         * EVENTO CLICK: SE DETECTA EL EVENTO CLICK A UNA FILA Y ESTA 
         * ES PASADA A LA CAJA DE TEXTO
         */
        $(".directorio").live("click",function() {
            
            $("#idtxtobra").val("");
            $("#idtxtidobra").val("");
            $("#diveditar").css("display","none");
            
            var directorio_array = $(this).text().split("|");
            $("#idtxtiddirectorio").val(directorio_array[0])
            $("#idtxtdirectorio").val(directorio_array[1]+"|"+directorio_array[2]);
            //$("#idtxtdirectorio").val($(this).text());
            cargarObras(<?=$_SESSION['id']?>,directorio_array[0]);
        });
        
        /**
         * EVENTO CLICK SE DETECTA EN OBRA
         */
        $(".obra").live("click",function() {
            var obra_array = $(this).text().split("|");
            
            $("#idtxtidobra").val(obra_array[0]);
            $("#idtxtobra").val(obra_array[1]+"|"+obra_array[2]);
            $("#diveditar").css("display","block");
        });
        
        // EDITAR OBRA
        // IR AL FORMULARIO DE EDITAR OBRA
        $("#aeditar").click(function(e){
            e.preventDefault();
            linkDestino = "../datosdeobra/edit/editaobra.php?idObra="+$("#idtxtidobra").val();
            $("body").fadeOut(5000, redireccionaEditar(linkDestino));
        });
        
        /**
         * CONFIRMAR DATOS INICIALES
         * =========================
         * Si se hace click al boton "Proceder" se asumirá que el usuario
         * va a trabajar todos los modulos con estos datos en memoria:
         * Seleccion de Directorio
         * Seleccion de Obra
         */
        $("#setuped").click(function() {
            $("#txtpmtdirectorio").val($("#idtxtdirectorio").val());
            $("#txtpmtobra").val($("#idtxtobra").val());
            
            $("#parametros").dialog({
                resizable:false,
                height:200,
                width:450,
                modal:true,
                buttons:{
                    "Proceder":function() {
                        linkDestino = "../../index_usuario.php";
                        $("body").fadeOut(2000, redireccionaEditar(linkDestino));
                        
                    },
                    "Cancelar":function() {
                        $(this).dialog("close");
                    }
                }
            });
        });
        
        /**
         * REDIRECCIONAR AL MENU DE OPCIONES DEL SISEMA 
         * PARA EL USUARIO LICENCIA
         */
        function redireccionaEditar(linkDestino) {
            window.location = linkDestino;
        }
    });
    </script>
    </head>
    <body>
        <div id="parametros" title="Guardar datos para mi sesión de trabajo" style="display: none">
            <table>
                <tr><td>Directorio</td><td><input type="text" id="txtpmtdirectorio" READONLY/></td></tr>
                <tr><td>Obra</td><td><input type="text" id="txtpmtobra" READONLY/></td></tr>
            </table>
        </div>
        <?php
        if (!@$_SESSION['id']) {
            echo "No estas permitido de ingresar a esta zona";
            echo '<h2><a href="http://192.168.1.5/control_pms/">Inicie sesión</a></h2>';
            exit;
        }
        else {
        ?>
        <div id="main">
            <form id="seleccionprevia" method="post" action="">
                <fieldset>
                    <legend>Directorios Principales</legend>
                    <div id="divSeleccionaDirectorio" title="Seleccionar Directorio"></div>
                    <input type="text" id="idtxtdirectorio" name="txtdirectorio" class="validate[required]" READONLY/>
                    <!-- CAMPO OCULTO QUE RETIENE EL ID DEL DIRECTORIO SELECCIONADO -->
                    <input type="hidden" id="idtxtiddirectorio" name="txtiddirectorio" value="" READONLY />
                </fieldset>    
                <fieldset>
                    <legend>Selecci&oacute;n de Proyecto</legend>
                    <div id="divSeleccionaObra" title="Seleccionar Obra">QWERTY</div> 
                    <input type="text" id="idtxtobra" name="txtobra" class="validate[required]" READONLY/>
                    <!-- CAMPO OCULTO QUE RETINENE EL ID DE LA OBRA SELECCIONADA -->
                    <input type="hidden" id="idtxtidobra" name="txtidobra" value="" READONLY />
                    <a id="anuevo" href="../datosdeobra/registradatosdeobra.php">Nuevo</a> <a href="#"></a> 
                    <div id="diveditar"  style="display: none"><a> >> </a><a id="aeditar" href="../datosdeobra/edit/editaobra.php?id_directorio=">Editar</a></div>
                </fieldset>
               
                <p>
                    <input type="button" value="Confirmar datos iniciales" id="setuped" /> 
                </p>   
            </form>
            <div class="container tutorial-info" id="infocambiomoneda" ></div>
            <div id="error"></div>
            <div class="container tutorial-info">
                <a href="../../index.php"><?=$_SESSION['usr']?></a>
            </div>
        </div>
        <?php
        }
        ?>
    </body>
</html>