<?php
include_once '../../../dl/contacto_bl/EspecialidadCompaniaDL.php';
$especialidad = new EspecialidadCompaniaDL();
$especialidad->setDescripcion($_REQUEST['descripcion']);
$especialidad->insertarEspecialidad();

/**
 * GERERAR CONSULTA PARA DEVOLVER EL HTML QUE REEMPLAZARA  AL DIV 
 * MODAL -  
 */

?>
