<?php
require_once 'Conexion.php';

class Especialidad 
{
    protected $_tb_companiacontacto_ruc;
    public function obtenerEspecialidadesPorCompania() 
    {
        $query = "SELECT 
        cc.descripcion
        ,ec.descripcion edescripcion
        ,r.tb_companiacontacto_id ccid
        ,r.tb_especialidadcompania_id ecid
        FROM tb_rubro r
        INNER JOIN tb_companiacontacto cc ON cc.id = r.tb_companiacontacto_id 
        INNER JOIN tb_especialidadcompania ec ON ec.id = r.tb_especialidadcompania_id
        WHERE cc.ruc = '$this->_tb_companiacontacto_ruc'";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($query);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $especialidades = array();
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($especialidades, $res['edescripcion']);
                /*array_push($especialidades, $res['ccid']);
                array_push($especialidades, $res['ecid']);*/
            }
            return $especialidades;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
     /** G & S */
    public function get_tb_companiacontacto_ruc() {
        return $this->_tb_companiacontacto_ruc;
    }

    public function set_tb_companiacontacto_ruc($_tb_companiacontacto_ruc) {
        $this->_tb_companiacontacto_ruc = $_tb_companiacontacto_ruc;
    }
}