<?php
include_once '../../dl/Conexion.php';

class TipoCompania
{
    public function getTipoCompanias()
    {
        $conex = new Conexion();
        $cn = $conex->conectar();
        $query = "SELECT tp.id, tp.nombre FROM TipoCompania tp";
        return mysql_query($query);
    }
}