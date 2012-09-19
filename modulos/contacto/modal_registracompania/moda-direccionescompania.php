<?php
require_once '../../../dl/contacto_bl/CompaniaContactoDL.php';
$direcciones = new CompaniaContactoDL();

$direcciones->setId($_REQUEST['idcompania']);
$direccione = $direcciones->mostrarDireccionesCompania();

echo '<table>';
foreach($direccione as &$valor) {
    echo '<tr><td><input id="direccioncompaniabox" type="checkbox" name="txtdireccionescompania" value="'.
        $valor[0].
        '"/><td id="txtDireccion">'.
        $valor[1];
}
echo '</table>';