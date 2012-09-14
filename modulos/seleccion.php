<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$title = "";
$nuevo = "";
$modificar = "";

switch ($_REQUEST['frmName']) {
    case 'compania':
        $title = "Compañia";
        $nuevo = "contacto/registracompania.php";
        $modificar = "contacto/edit/editacompania.php?from=none";
        break;
    case 'persona':
        $title = "Personas";
        $nuevo = "contacto/registrapersona.php";
        $modificar = "contacto/edit/editapersona.php?frm=persona";
        break;
    case 'listas':
        $title = "Listas de Distribución";
        $nuevo = "contacto/registrolistadistribucion.php?obra=".$_REQUEST['descripcion']."&codigo=".$_REQUEST['obra'];
        $modificar = "contacto/edit/editalistadistribucion.php?frm=listas";
        break;
    case 'obrane':
        $title = "Datos de Obra";
        if($_REQUEST['estadoObra'] == '1') {
            $nuevo = "#";
            $modificar = "datosdeobra/edit/editaobra.php?idobra=".$_REQUEST['proyecto'];
        } else {
            $nuevo = "datosdeobra/registradatosdeobra.php?obra=".$_REQUEST['proyecto']."&codigo=".$_REQUEST['codigObra']."&descripcion=".$_REQUEST['descObra'];
            $modificar = "datosdeobra/edit/editaobra.php?idobra=".$_REQUEST['proyecto'];
        }
        
        
        break;
    default:
        break;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?=$title?></title>
        <link rel="stylesheet" type="text/css" href="../index_box/index.css" media="screen" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
    </head>
    <body>
        <div class="container tutorial-info">
            <h1><?=  strtoupper($title);?></h1>
        </div>
        <div class="container tutorial-info">
            <a href="<?=$nuevo?>">Nuevo</a> | <a href="<?=$modificar?>">Modificar</a>
        </div>
    </body>
</html>