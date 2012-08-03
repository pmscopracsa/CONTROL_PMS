<?php
//modulo del administrador del sistema de parte de la empresa
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ADMINISTARDOR DE<?=$_SESSION['usr']?></title>
    </head>
    <body>
        <div id="admin">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Par&aacute;metros de Empresa</a></li>
                    <li><a href="#tabs-2">Tablero de Control</a></li>
                </ul>
                <div id="tabs-1">
                    <label>Subir logo:</label><input type="button" id="btnLogo" /><br />
                    <label>Crear usuarios:</label><br />
                    <label>Mensaje a PMS CONTROL:</label><input type="text" id="txtmensaje" />
                </div>
            </div>
        </div>    
    </body>
</html>
