<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
/**
 * CONTROL DE SEGURIDAD PARA EL LOGIN COMO USUARIO.
 * SEA ESTE EL ADMINISTRADOR DE LA EMPRESA COMO
 * EL USUARIO {LICENCIA} 
 */

require_once '../dl/Conexion.php';
$cn = new Conexion();
$cn->conectar();

$usuario = htmlspecialchars($_REQUEST['user_name']);
$password = $_REQUEST['password'];

$sql = "SELECT 
        id
        ,nombre
        ,nombreusuario
        ,rol
        ,password 
        FROM tb_usuario 
        WHERE nombreusuario = '$usuario' AND password = '$password'
        AND tb_empresa_id = ". $_SESSION['id'];
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

if (mysql_num_rows($result) > 0) {
    if (strcmp($row['password'], $password) == 0) {
        echo $row['rol']; 
        $_SESSION['rol_usuario'] = $row['rol'];
        $_SESSION['nombre_usuario'] = $row['nombreusuario'];
        $_SESSION['rol_usuario'] = $row['rol'];
        $_SESSION['id_usuario'] = $row['id'];
    }
} else {
    echo "no";
}