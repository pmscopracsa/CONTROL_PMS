<?php
require_once '../../../dl/contacto_bl/CompaniaContactoDL.php';
$direcciones = new CompaniaContactoDL();

$direcciones->setId($_REQUEST['idcompania']);
$direccione = $direcciones->mostrarDireccionesCompania();

echo '<div>';
foreach($direccione as &$valor) {
    echo '<input id="direccioncompaniabox" type="checkbox" name="txtdireccionescompania" value="'.
        $valor[0].
        '"/>'.
        $valor[1].
        '<br />';
}
echo '</div>';