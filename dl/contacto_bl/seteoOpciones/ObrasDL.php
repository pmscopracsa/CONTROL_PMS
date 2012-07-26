<?php
require_once 'Conexion.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObrasDL
 *
 * @author root
 */
class ObrasDL 
{
    protected $_id;
    protected $_descripcion;
    protected $_idEmpresa;
    protected $_idDirectorio;
    
    // Esta funcion siempre tendrá 2 filtros, el idEmpresa y el idDirectorio
    public function mostrarObras()
    {
        $query = "SELECT DISTINCT ob.id, ob.codigoobra, ob.descripcion
        FROM tb_directorio AS dir
        INNER JOIN tb_obra  AS ob
        WHERE dir.tb_empresa_id = $this->_idEmpresa AND ob.tb_directorio_nombre = '$this->_idDirectorio'";
        
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
    
    // Funcion de búsqueda
    public function mostrarObrasPorNombre()
    {
        
    }
    
    // g & s
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_idEmpresa() {
        return $this->_idEmpresa;
    }

    public function set_idEmpresa($_idEmpresa) {
        $this->_idEmpresa = $_idEmpresa;
    }

    public function get_idDirectorio() {
        return $this->_idDirectorio;
    }

    public function set_idDirectorio($_idDirectorio) {
        $this->_idDirectorio = $_idDirectorio;
    }

}