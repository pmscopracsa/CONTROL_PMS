<?php
include_once '../../dl/Conexion.php';

class ComboBoxSql 
{
    public function __construct() 
    {
        $conex = new Conexion();
        $cn = $conex->conectar();
    }
    
    public function consulta($query)
    {
        $resultado = mysql_query($query);
        
        if (!$resultado) {
            echo "Error en consulta: ".mysql_error();
            exit;
        }
        return $resultado;
    }
    
    function fetch_array($result)
    {
        return mysql_fetch_array($result);
    }
    
    function num_rows($result)
    {
        return mysql_num_rows($result);
    }
    
    function fetch_row($result)
    {
        return mysql_fetch_row($result);
    }
    
    function fetch_assoc($result)
    {
        return mysql_fetch_assoc($result);
    }
}
?>