<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ADMINISTARDOR DE <?=  strtoupper($_SESSION['usr']);?></title>
    </head>
    <body>
        <div id="admin">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Par&aacute;metros de Empresa</a></li>
                    <li><a href="#tabs-2">Tablero de Control</a></li>
                </ul>
                <div id="tabs-1">
                    <label>Empresa: </label><?=$_SESSION['usr']?><br />
                    <label>Subir logo:</label><input type="button" id="btnLogo" /><br />
                    <label>Crear usuarios:</label><br />
                    <label>Mensaje a PMS CONTROL:</label><input type="text" id="txtmensaje" />
                </div>
            </div>
        </div>    
    </body>
</html>
