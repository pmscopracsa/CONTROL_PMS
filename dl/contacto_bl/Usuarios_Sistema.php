<?php
/**
 * modulos: datos de obra
 * formulario: datos de obra
 * tabla: tb_usuario 
 */
require_once 'Conexion.php';
class Usuarios_Sistema {
    protected $_id;
    protected $_tb_empresa_id;
    protected $_nombre;
    protected $_nombre_usuario;
    protected $_password;
    
    public function mostrarUsuarios()
    {
        $query = "SELECT * FROM tb_usuario ORDER BY nombre ASC";
        //$query = "SELECT tb_usuario.*,tb_opcionestop.* FROM tb_usuario,tb_opcionestop ORDER BY nombre ASC";
        
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
    
    public function mostrarUsuariosPorNombre()
    {
        $query = "SELECT * FROM tb_usuario WHERE nombre LIKE '$this->_nombre%'";
        
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
    
    /**
     * MOSTRAR LISTA DE USUARIOS PRE SELLECCIONADOS PARA EMPATARLOS CON
     * OPCIONES
     */
    public function showPreSelectedUsers() {
        
    }
    /**
     * GETTRES Y SETTERS 
     */ 
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function get_nombre_usuario() {
        return $this->_nombre_usuario;
    }

    public function set_nombre_usuario($_nombre_usuario) {
        $this->_nombre_usuario = $_nombre_usuario;
    }

    public function get_password() {
        return $this->_password;
    }

    public function set_password($_password) {
        $this->_password = $_password;
    }


}