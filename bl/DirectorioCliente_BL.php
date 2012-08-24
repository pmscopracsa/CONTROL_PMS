<?php
require_once '../dl/Conexion.php';
require_once '../dl/DirectorioCliente.php';

// REQUIRE FOR COMBOS
require_once 'ComboBoxSql.php';
require_once 'ComboBoxTipos.php';
$selects = new ComboBoxTipos();


$conexion = new Conexion();
$cn = $conexion->conectar();
$directorio = new DirectorioCliente();

if ($_REQUEST['parameter'] == 'crearDirectorio') {
    $directorio->set_nombre($_REQUEST['nombre']);
    $directorio->set_descripcion($_REQUEST['descripcion']);
    $directorio->set_tb_empresa_id($_REQUEST['id_empresa']);
    $directorio->crearDirectorio($cn);
} elseif ($_REQUEST['parameter'] == 'actualizarDirectorio') {
    $directorio->set_nombre($_REQUEST['nombre_editar']);
    $directorio->set_descripcion($_REQUEST['descripcion_editar']);
    $directorio->set_tb_empresa_id($_REQUEST['id_empresa']);
    $directorio->set_id($_REQUEST['id_directorio']);
    $directorio->actualizarDirectorios($cn);
} elseif ($_REQUEST['parameter'] == 'existenombreDirectorio') {
    $directorio->set_nombre($_REQUEST['nombre']);
    $rs = $directorio->existeNombreDirectorio($cn);
    echo $rs;
} elseif ($_REQUEST['parameter'] == 'cargarDirectorioEditarlo') {
    $directorios = $selects->cargarDirectoriosEditar($_REQUEST['idEmpresa']);
    foreach ($directorios as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
}