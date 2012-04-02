<?php
include_once '../../dl/Conexion.php';


class ViaEnvio {
    public function getTipoEnvios()
    {
        $conex = new Conexion();
        $cn = $conex->conectar();
        $query = "SELECT ve.id, ve.nombre FROM ViaEnvio ve ORDER BY ve.nombre ASC";
        return mysql_query($query);
    }
}

?>
