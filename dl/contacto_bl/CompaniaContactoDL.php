<?php

//include_once '../../dl/Conexion.php';

class CompaniaContactoDL 
{
    protected $id;
    
    public function mostrarCompaniaContacto()
    {
        $query = "SELECT * FROM tb_companiacontacto ORDER BY descripcion ASC";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $rs = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($rs))
            {
                array_push($registros,$reg);
            }
            mysql_free_result($rs);
            mysql_close($cn);
        } catch (Exception $exc) {
            try {
                mysql_free_result($rs);
            } catch(Exception $e1){}
            try {
                mysql_close($cn);
            }catch(Exception $e1){}
        }
    return $registros;    
    }
    
    /**
     * DEVUELVE LA PERSONA DE CONTACTO Y LA EMPRESA DONDE LABORA 
     */
    public function mostrarEmpresaContacto()
    {
        $query = "SELECT 
        persona.nombre, 
        compania.descripcion
        FROM 
        tb_personacontacto persona
        INNER JOIN tb_companiacontacto compania ON persona.tb_companiacontacto_id = compania.id
        ORDER BY nombre ASC;";
        
        try{
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $result = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($result))
            {
                array_push($registros,$reg);
            }
        }catch(Exception $exc){
            try{
                mysql_free_result($result);
            } catch (Exception $e1){}
            try {
                mysql_close($cn);
            } catch(Exception $e1){}
        }
        return $registros;
    }
    
    public function mostrarContactosTemporal() 
    {
        $query = "SELECT a.nombre, c.descripcion FROM tb_personacontacto a
        INNER JOIN temporal  b
        ON a.id = b.id_contacto
        INNER JOIN tb_companiacontacto c
        ON a.tb_companiacontacto_id = c.id";
        
        try{
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $result = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($result))
            {
                array_push($registros,$reg);
            }
        }catch(Exception $exc){
            try{
                mysql_free_result($result);
            } catch (Exception $e1){}
            try {
                mysql_close($cn);
            } catch(Exception $e1){}
        }
        return $registros;
    }
}
?>