<?php
/**
 * Description of ProcuraDL
 *
 * @author root
 */
require_once '../Conexion.php';

class ProcuraDL 
{
    protected $_idempresa;
    
    /**
     * Obtener los modelos de cartas de adjudicacion 
     */
    public function mostrarCartas(){
        $query = "(SELECT id,descripcion,path FROM tb_modelocartacomun) 
            UNION (SELECT id,descripcion,path FROM tb_modelocartapropia WHERE tb_empresa_id = $this->_idempresa)";
        
        try
        {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $result = mysql_query($query);
            $registros = array();
            while ($reg = mysql_fetch_array($result))
            {
                array_push($registros,$reg);
            }
            mysql_free_result($result);
            mysql_close($cn);
        } catch (Exception $ex) {
            mysql_free_result($result);
            mysql_close($cn);
        }
        return $registros;
    }
    
    /**
     * Obtener los modelos de cartas contrato 
     */
    public function mostrarContratos(){
        $query = "(SELECT id,descripcion,path FROM tb_modelocontratocomun)
            UNION (SELECT id,descripcion,path FROM tb_modelocontratopropio WHERE tb_empresa_id = $this->_idempresa)";
        
        try
        {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $result = mysql_query($query);
            $registros = array();
            
            while ($reg = mysql_fetch_array($result))
            {
                array_push($registros, $reg);
            }
            mysql_free_result($result);
            mysql_close($cn);
        } catch(Exception $ex) {
            mysql_free_result($result);
            mysql_close($cn);
        }
        return $registros;
    }
    
    /**
     * GETTERS Y SETTERS 
     */
    public function get_idempresa() {
        return $this->_idempresa;
    }

    public function set_idempresa($_idempresa) {
        $this->_idempresa = $_idempresa;
    }
}