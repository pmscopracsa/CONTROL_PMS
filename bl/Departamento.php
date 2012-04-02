<?php
include_once '../../dl/Conexion.php';
class Departamento 
{
    public function getDepartamentos()
    {
        $conex = new Conexion();
        $cn = $conex->conectar();
        $query = "SELECT d.id, d.descripcion FROM Departamento d";
        return mysql_query($query);
    }
}

?>
