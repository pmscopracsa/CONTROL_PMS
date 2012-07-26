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
        Editar formulario: <?=$_REQUEST['frm']?>
    </body>
</html>
