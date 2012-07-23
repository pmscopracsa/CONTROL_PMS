<?php 
session_start();

if (isset($_GET['logoff']))
{
    $_SESSION = array();
    session_destroy();
    
    header("Location: ../../index.php");
    exit;
}    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SETEO DE TRABAJO</title>
        <link rel="stylesheet" href="../../js/wizard/css/formToWizard.css" /> 
        <link rel="stylesheet" href="../../js/wizard/css/validationEngine.jquery.css" />
        <link rel="stylesheet" href="../../index_box/index.css" />
        
        <script src="../../js/jquery-1.7.1.min.js"></script> 
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
    })
    </script>
    </head>
    <body>
        <div id="main">
            <form id="seleccionprevia" method="post" action="">
                <fieldset>
                    <legend>Directorios Principales</legend>
                    <label for="DirectorioPrincipal">Directorio Principal</label>
                    <input type="text" id="idtxtdirectorio" name="txtdirectorio" class="validate[required]" />
                    <input type="button" id="idbtnBuscarDirectorio" name="btnBuscarDirectorio" value="..." />
                </fieldset>    
                <fieldset>
                    <legend>Seleccion de Obra</legend>
                    <label for="Obra">Seleccion de Obra</label>
                    <input type="text" id="idtxtobra" name="txtobra" class="validate[required]" />
                    <input type="button" id="idbtnBuscarObra" name="btnBuscarObra" value="..." />
                </fieldset>
                <fieldset>
                    <legend>Cambio del día segun SUNAT</legend>
                    <label for="ventaSunat">T.C. Venta SUNAT</label>
                    <input type="text" id="idtxtvsunat" name="txtvsunat"  value="" />
                    <label for="compraSunat">T.C. Compra SUNAT</label>
                    <input type="text" id="idtxtcsunat" name="txtcsunat" value="" />
                    <label for="ventaBanco">T.C Venta Banco</label>
                    <input type="text" id="idtxtvbanco" name="txtvbanco" value="" />
                </fieldset>    
                <p>
                    <input type="button" value="Confirmar datos iniciales" id="setuped" /> 
                </p>    
            </form>
            <img src="<?='../../img/cliente/'.$_SESSION['logo'].'.png';?>" alt="logo_empresa"/>
        
            <div class="container tutorial-info">
                <a href="?logoff">Cerrar sesi&oacute;n</a> | <a href="../../index_usuario.php">Usuario</a>
            </div>
        </div>
    </body>
</html>
