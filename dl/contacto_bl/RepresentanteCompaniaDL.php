<?php
include_once '../../dl/Conexion.php';

class RepresentanteCompaniaDL {
    protected $tb_companiacontacto_id;
    protected $tb_personacontacto_id;
    
    public function mostrarRepresentantes()
    {
        $query = "
            SELECT * FROM tb_personacontacto ORDER BY nombre ASC
            ";
        
        $conexion = new Conexion();
        $cn = $conexion->conectar();
        $rs = mysql_query($query, $cn);
        $registros = array();
        
        while($reg = mysql_fetch_array($rs)) {
            array_push($registros, $reg);
        }
        mysql_free_result($rs);
        mysql_close($cn);
        
        return $registros;
    }
}
?>
