<?php

/**
 * modulo: busca personas
 * formulario: registro de listas de distribucion
 * tabla: tb_personacontacto 
 */

include_once '../../dl/Conexion.php';
class ContactoPersona {
    protected $id;
    
    public function mostrarContactos()
    {
        $query = "SELECT * FROM tb_personacontacto";
        
        try
        {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $rs = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($rs))
            {
                array_push($registros, $reg);
            }
            mysql_free_result($rs);
            mysql_close($cn);
        }catch(Exception $ex){
            try {
                mysql_free_result($rs);
            }  catch (Exception $e1){}
            try {
                mysql_close($cn);
            } catch (Exception $e1) {}
        }
        return $registros;
    }
}

?>
