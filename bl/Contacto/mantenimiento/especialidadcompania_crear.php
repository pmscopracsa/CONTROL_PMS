<?php
session_start();
include_once '../../../dl/contacto_bl/EspecialidadCompaniaDL.php';
$especialidad = new EspecialidadCompaniaDL();
$especialidad->setDescripcion($_REQUEST['descripcion']);
$res = $especialidad->insertarEspecialidad();

if ($res) {
    $especialidades = array();
    $especialidades = $especialidad->mostrarEspecialidades();
    echo $especialidades;
}
?>
