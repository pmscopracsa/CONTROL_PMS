<?php
require_once 'Conexion.php';
class Correos 
{
    protected $idPersona;
    
    public function obtenerCorreosPersona() {
        $query = "SELECT 
            cs.id idcorreo
            ,cs.descripcion
            FROM tb_personacontacto pc
            INNER JOIN tb_correosecundarios cs ON pc.id = cs.tb_personacontacto_id
            WHERE pc.id = $this->idPersona";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query);
            if(!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $correos = array();
            while($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($correos,$res['idcorreo']);
                array_push($correos,$res['descripcion']);
            }
            return $correos;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function getIdPersona() {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }
}