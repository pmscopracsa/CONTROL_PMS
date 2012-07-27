<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/**
 * QUE DATOS BUSCAR PARA EDICION SI:
 * COMPAÑIA: RUC O NOMBRE
 * PERSONA: NOMBRES O APELLIDOS
 * LISTA DE DISTRIBUCION: NOMBRE DE LISTA 
 */
$frm = "";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (!$_SESSION['id']) {
        ?>
        <div id="error">
            No autorizado
        </div>
        <?php
        }
        else {
        ?>
        <div id="tituloFrm">
            Editar formulario: <?=$_REQUEST['frm']?>
        </div>
        <div id="cajaBuscar">
            <?php
                    switch ($_REQUEST['frm']) {
                        case 'compania':
                            break;

                        default:
                            break;
                    }
            ?>
        </div>
        <?php
        }
        ?>
    </body>
</html>
