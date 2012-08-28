<?php
require_once 'Conexion.php';

class Direccion {
    private $_ruc;
    
    public function obtenerDireccionesPorCompania() {
        $query = "SELECT 
        dcc.direccion direccion
        ,p.nombre pais
        ,d.nombre departamento
        ,dis.nombre distrito
        ,td.descripcion tipodireccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        INNER JOIN tb_pais p ON dcc.tb_pais_id = p.id
        INNER JOIN tb_departamento d ON dcc.tb_departamento_id = d.id
        INNER JOIN tb_distrito dis ON dcc.tb_distrito_id = dis.id
        INNER JOIN tb_tipodireccion td ON dcc.tb_tipodireccion_id = td.id
        WHERE cc.ruc = '$this->_ruc'";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $datos = array();
            
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($datos,$res['direccion']);
                array_push($datos,$res['pais']);
                array_push($datos,$res['departamento']);
                array_push($datos,$res['distrito']);
                array_push($datos,$res['tipodireccion']);
            }
            return $datos;
            
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /** G & S */
    public function get_ruc() {
        return $this->_ruc;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }
}