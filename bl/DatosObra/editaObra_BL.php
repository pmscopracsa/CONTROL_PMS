<?php
require_once '../../dl/Conexion.php';
require_once '../../dl/datos_obra/EditaObra_DL.php';

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    
    $edita_obra = new EditaObra_DL();
    $edita_obra->setPk($_REQUEST['id_obra']);
    
    if ($_REQUEST['parameter'] == 'editadireccion') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_direccion']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editacliente') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_idcliente']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editacontratante') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_idcontratante']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editagerente') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_gerente']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editasupervisora') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_supervisora']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editaproveedor') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_proveedor']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editacartafianza') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_cartafianza']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editadiashabiles') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_diashabiles']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editafondoretencion') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_fondoretencion']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editadiasdevolucion') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_diasdevolucion']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editadepartamento') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_departamento']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editamoneda') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['new_moneda']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editatipoval') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_tipoval']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'editaformato') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_formato']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'pptoventa') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['value']);
        $edita_obra->setColumn($_REQUEST['columna']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'nuevocontacto') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn);
    }  elseif ($_REQUEST['parameter'] == 'existecontacto_tb_firma') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn); 
    } elseif ($_REQUEST['parameter'] == 'eliminacontacto') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'existecontactopuesto_tb_contactoreporte') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'eliminacontactopuesto') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'agregarcontactopuesto') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setFk($_REQUEST['idContacto']);
        $edita_obra->setValue($_REQUEST['puesto']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'empatacontactoreporte') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setFk($_REQUEST['idcontacto']);
        $edita_obra->setValue($_REQUEST['idreporte']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'setposicionenreporte') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setFk($_REQUEST['idContacto']);
        $edita_obra->setValue($_REQUEST['ubicacion']);
        $edita_obra->setColumn($_REQUEST['id_reporte']);
        $edita_obra->actualizaObra($cn);
    } elseif ($_REQUEST['parameter'] == 'eliminarempatereporte') {
        $edita_obra->setAActualizar($_REQUEST['parameter']);
        $edita_obra->setFk($_REQUEST['id_reporte']);
        $edita_obra->setValue($_REQUEST['id_contacto']);
        $edita_obra->actualizaObra($cn);
    }
    
    
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}