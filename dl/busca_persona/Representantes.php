<?php
require_once 'Conexion.php';
class Representantes 
{
    protected $ruc;
    protected $tb_companiacontacto_id;
    protected $tb_personacontacto_id;
    
    public function obtenerRepresentantesPorCompania()
    {
        $query = "SELECT
            pc.nombre nombre
            ,rep.tb_companiacontacto_id companiaId
            ,rep.tb_personacontacto_id personaId
            FROM tb_representante rep
            INNER JOIN tb_companiacontacto cc ON rep.tb_companiacontacto_id = cc.id
            INNER JOIN tb_personacontacto pc ON rep.tb_personacontacto_id = pc.id
            WHERE cc.ruc = $this->ruc";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $representantes = array();
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($representantes, $res['nombre']);
                /*array_push($representantes, $res['companiaId']);
                array_push($representantes, $res['personaId']);*/
            }
            return $representantes;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /** G&S */
    public function getRuc() {
        return $this->ruc;
    }

    public function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    public function getTb_companiacontacto_id() {
        return $this->tb_companiacontacto_id;
    }

    public function setTb_companiacontacto_id($tb_companiacontacto_id) {
        $this->tb_companiacontacto_id = $tb_companiacontacto_id;
    }

    public function getTb_personacontacto_id() {
        return $this->tb_personacontacto_id;
    }

    public function setTb_personacontacto_id($tb_personacontacto_id) {
        $this->tb_personacontacto_id = $tb_personacontacto_id;
    }
}