<?php
//require_once 'Conexion.php';

class ObraCliente {
    private $_id;
    private $_codigoobra;
    private $_descripcion;
    private $_tb_directorio_id;
    private $_tb_empresa_id;
    
    /**
     * CARGAS 
     */
    public function cargarObras() {
        //$query = "SELECT id,descripcion FROM tb_obra WHERE tb_directorio = $this->_tb_directorio_id";
        $query = "SELECT id,descripcion FROM tb_obra";
        
        try {
            $cone = new Conexion();
            $cn = $cone->conectar();
            
            if (!$cn)
                throw new Exception("Error de conexion: ".  mysql_error());
            
            $rs = mysql_query($query);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            if (@mysql_num_rows($rs) > 0) {
                $obras = array();
                
                while ($obra = mysql_fetch_assoc($rs)) {
                    $id = $obra['id'];
                    $descripcion = $obra['descripcion'];
                    $obras[$id] = $descripcion;
                }
                return $obras;
            } else {
                return FALSE;
            }
        
        } catch (Exception $ex) {
            echo 'Error:'.$ex->getMessage();
        }
    }
    
    /**
     * CREAR OBRA SOLO CON: CODIFICACION y DESCRIPCION
     * LUEGO PODRA SER ACTUALIZADA
     * @param type $cn 
     */
    public function crearObraMinimo($cn) {
        $query = "INSERT INTO tb_obra (id, codigoobra, descripcion, tb_directorio_id, tb_empresa_id) VALUES (
            NULL
            ,'$this->_codigoobra'
            ,'$this->_descripcion'
            ,$this->_tb_directorio_id    
            ,$this->_tb_empresa_id)";
        
        try {
            $rs = mysql_query($query,$cn);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());   
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /**
     *funcion para la edicion por el administrador de la empresa 
     */
    public function listarProyectos($cn) {
        $query = "SELECT id,codigoobra,descripcion FROM tb_obra WHERE tb_empresa_id = $this->_tb_empresa_id";
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $proyectos = array();
            
            while ($reg = mysql_fetch_array($rs)) {
                array_push($proyectos, $reg);
            }
            return $proyectos;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function actualizarProyecto($cn) {
        $query = "UPDATE tb_obra SET codigoobra = '$this->_codigoobra', descripcion = '$this->_descripcion' WHERE id = $this->_id";
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error()); 
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function mostrarDatosBasicos($cn) {
        $query = "SELECT codigoobra, descripcion FROM tb_obra WHERE id = $this->_id";
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $obra_data = array();
            while ($obra = mysql_fetch_assoc($rs)) {
                $codigo = $obra['codigoobra'];
                $descripcion = $obra['descripcion'];
                $obra_data[$codigo] = $descripcion;
            }
            return $obra_data;
            
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /**
     * G&S 
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_codigoobra() {
        return $this->_codigoobra;
    }

    public function set_codigoobra($_codigoobra) {
        $this->_codigoobra = $_codigoobra;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_tb_directorio_id() {
        return $this->_tb_directorio_id;
    }

    public function set_tb_directorio_id($_tb_directorio_id) {
        $this->_tb_directorio_id = $_tb_directorio_id;
    }
    
    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }
}