<?php
session_start();
require_once '../dl/Conexion.php';
$cn = new Conexion();
$cn->conectar();

$usuario = htmlspecialchars($_REQUEST['user_name']);
$password = $_REQUEST['password'];

$sql = "SELECT nombre, nombreusuario, rol, password FROM tb_usuario where nombreusuario = '".$usuario."'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

if (mysql_num_rows($result) > 0) {
    if (strcmp($row['password'], $password) == 0) {
        echo "yes"; 
        $_SESSION['nombre_usuario'] = $row['nombreusuario'];
        $_SESSION['rol'] = $row['rol'];
    }
} else {
    echo "no";
}