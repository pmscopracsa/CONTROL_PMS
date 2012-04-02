<?php
include_once '../../dl/Conexion.php';
class TipoDireccion 
{
    public function getTipoDirecciones()
    {
        $conex = new Conexion();
        $cn = $conex->conectar();
        $query = "SELECT td.id, td.descripcion FROM TipoDireccion td";
        return mysql_query($query);
    }
}

?>
