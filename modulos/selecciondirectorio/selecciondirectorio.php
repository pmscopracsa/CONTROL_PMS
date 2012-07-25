<?php 
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

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
        $("#divSeleccionaObra").load("modales_seteo/div_seleccionaDirectorio.php?filtro="+filtro);
    }
    
    /**
     * CARGA DE LAS OBRAS SIN FILTRO (PARA RECARGAR SIN FILTRO)  Y POR FILTRO (CUANDO SE DESEA BUSCAR DE UNA LARGA LISTA)
     */
    function recargarObra() {
        $("#divSeleccionaObra").load("modales_seteo/div_seleccionaObra.php?filtro=1");
    }
    function recargarObraBusqueda(filtro) {
        $("#divSeleccionaObra").load("modales_seteo/div_seleccionaObra.php?filtro="+filtro);
    }
        
        
    $(function() {
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
       * CARGAR DIRECTORIOS PRO PRIMERA VEZ - SIN FILTRO
       */      
      $("#divSeleccionaDirectorio").load("modales_seteo/div_seleccionaDirectorio.php?filtro=1");
            
      /**
       * BOTON PARA ABRIR MODAL DE DIRECTORIOS
       */      
      $("#idbtnBuscarDirectorio").click(function() {
          $("#divSeleccionaDirectorio").dialog("open");
      })
      
      /**
       * BOTON PARA ABRIR MODAL DE OBRAS
       */
      $("#idbtnBuscarObra").click(function() {
          $("#divSeleccionaObra").dialog("open");
      })
       
       /**
        * CARGA POR DEFECTO DE LOS DIRECTORIOS
        */
       $("#divSeleccionaDirectorio").load("modales_seteo/div_seleccionaDirectorio.php?filtro=1");
       /**
        * CARGA PÓR DEFECTO DE LAS OBRAS
        */
       $("#divSeleccionaObra").load("modales_seteo/div_seleccionaObra.php?filtro=1");
       
       /**
        * MODAL PARA LA SELECCIONA DEL DIRECTORIO
        */
        $("#divSeleccionaDirectorio").dialog({
            autoOpen:false,
            height:350,
            width:450,
            resizable:false,
            closeOnEscape:false,
            modal:true,
            buttons:{
                "Buscar": function() {

                },
                "Limpiar": function() {

                },
                "Cerrar": function() {
                    $(this).dialog("close");
                } 
            }
        });
       
       /**
        * MODAL PARA LA SELECCION DE LA OBRA 
        */
        $("#divSeleccionaObra").dialog({
            autoOpen:false,
            height:350,
            width:450,
            resizable:false,
            closeOnEscape:false,
            modal:true,
            buttons:{
                "Buscar":function() {

                },
                "Limpiar": function() {

                },
                "Cerrar": function() {
                    $(this).dialog("close");
                }
            }
        });
    });
    </script>
    </head>
    <body>
        <?php
        if (!$_SESSION['id']) {
            echo "No estas permitido de ingresar a esta zona";
            header("Location: http://localhost/control_pms/");
        }
        ?>
        <!-- MODALES PARA SETEAR DATOS DE OBRA  -->
        <!-- ---------------------------------  -->
        <div id="divSeleccionaDirectorio" title="Seleccionar Directorio">
        </div>
        
        <div id="divSeleccionaObra" title="Seleccionar Obra">
        </div> 
        <!-- ---------------------------------  -->

        <div id="main">
            <form id="seleccionprevia" method="post" action="">
                <fieldset>
                    <legend>Directorios Principales</legend>
                    <label for="DirectorioPrincipal">Directorio Principal</label>
                    <input type="text" id="idtxtdirectorio" name="txtdirectorio" class="validate[required]" READONLY/>
                    <input type="button" id="idbtnBuscarDirectorio" name="btnBuscarDirectorio" value="..." />
                </fieldset>    
                <fieldset>
                    <legend>Seleccion de Obra</legend>
                    <label for="Obra">Seleccion de Obra</label>
                    <input type="text" id="idtxtobra" name="txtobra" class="validate[required]" READONLY/>
                    <input type="button" id="idbtnBuscarObra" name="btnBuscarObra" value="..." />
                </fieldset>
                <fieldset>
                    <legend>Cambio del día segun SUNAT</legend>
                    <label for="ventaSunat">T.C. Venta SUNAT</label>
                    <input type="text" id="idtxtvsunat" name="txtvsunat"  value="" size="5" maxlength="5"/>
                    <label for="compraSunat">T.C. Compra SUNAT</label>
                    <input type="text" id="idtxtcsunat" name="txtcsunat" value="" size="5" maxlength="5"/>
                    <label for="ventaBanco">T.C Venta Banco</label>
                    <input type="text" id="idtxtvbanco" name="txtvbanco" value="" size="5" maxlength="5"/>
                </fieldset>    
                <p>
                    <input type="button" value="Confirmar datos iniciales" id="setuped" /> 
                </p>    
            </form>
            <img src="<?='../../img/cliente/'.$_SESSION['logo'].'.png';?>" alt="logo_empresa"/>
        
            <div class="container tutorial-info">
                <a href="../../index_usuario.php">Menu de Usuario</a>
            </div>
        </div>
    </body>
</html>
