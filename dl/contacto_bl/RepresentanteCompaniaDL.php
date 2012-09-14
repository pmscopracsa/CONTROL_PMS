<?php
include_once 'Conexion.php';

class RepresentanteCompaniaDL {
    protected $tb_companiacontacto_id;
    protected $tb_personacontacto_id;
    protected $_descripcionpersona;
    protected $ruc;
    
    public function mostrarRepresentantesAll() {
        $query = "SELECT * FROM tb_personacontacto ORDER BY nombre ASC";
        
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
    
    public function mostrarRepresentantes()
    {
        //$query = "SELECT * FROM tb_personacontacto ORDER BY nombre ASC";
        $query = "select 
            per.id
            ,per.tb_empresa_id
            ,per.dni
            ,per.nombre
            ,per.cargo
            ,per.fax
            ,per.observacion
            ,per.email
            ,per.web
            ,per.tb_viaenvio_id
            ,per.tb_companiacontacto_id
            ,per.direccion
            ,per.tb_pais_id
            ,per.tb_departamento_id
            ,per.tb_distrito_id
            from tb_companiacontacto co inner join tb_personacontacto per
            on per.tb_companiacontacto_id = co.id
            where co.ruc = $this->ruc";
        
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
    
    public function mostrarRepresentatesPorNombre()
    {
        $query = "SELECT * FROM tb_personacontacto  WHERE nombre LIKE '$this->_descripcionpersona%'";
        
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
    
    /**
     * GETTERS AND SETTERS
     * @return type 
     */
    
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

    public function get_descripcionpersona() {
        return $this->_descripcionpersona;
    }

    public function set_descripcionpersona($_descripcionpersona) {
        $this->_descripcionpersona = $_descripcionpersona;
    }

    public function getRuc() {
        return $this->ruc;
    }

    public function setRuc($ruc) {
        $this->ruc = $ruc;
    }
}