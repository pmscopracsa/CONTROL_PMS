<?php
include_once 'Conexion.php';

class RepresentanteCompaniaDL {
    protected $tb_companiacontacto_id;
    protected $tb_personacontacto_id;
    protected $_descripcionpersona;
    
    public function mostrarRepresentantes()
    {
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


}
?>
