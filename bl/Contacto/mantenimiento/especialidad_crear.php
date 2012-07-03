<?php
session_start();
include_once '../../../dl/contacto_bl/EspecialidadPersonaDL.php';
$especialidad = new EspecialidadPersonaDL();
$especialidad->setDescripcion($_REQUEST['descripcion']);
$res = $especialidad->insertarEspecialidad();

if ($res) {
    $especialidades = array();
    $especialidades = $especialidad->mostrarEspecialidades();
    echo $especialidades;
}