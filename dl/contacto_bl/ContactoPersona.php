<?php

/**
 * modulo: busca personas
 * formulario: registro de listas de distribucion
 * tabla: tb_personacontacto 
 */

require_once 'Conexion.php';
class ContactoPersona {
    protected $id;
    protected $nombre;
    
    public function mostrarContactos()
    {
        $query = "SELECT * FROM tb_personacontacto ORDER BY nombre ASC";
//        $query = "SELECT  DISTINCT pc.nombre, tf.numero
//                    FROM tb_personacontacto pc
//                    INNER JOIN tb_comuntfijo tf ON pc.id = tf.tb_personacontactocomun_id
//                    INNER JOIN tb_comuntmobile tm ON pc.id = tm.tb_personacontactocomun_id
//                    INNER JOIN tb_comuntnextel tn ON pc.id = tn.tb_personacontactocomun_id
//                    GROUP BY pc.id";
        
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
    
    public function mostrarContactoPorNombre()
    {
        $query = "SELECT * FROM tb_personacontacto WHERE nombre LIKE '$this->nombre%'";
        
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
    
    /***
     * GETTERS & SETTERS
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}