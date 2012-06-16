<?php
/**
 * TODO: Arreglar la cadena de conexion. Porque del problema de llamar a la clase conexion
 * TODO: EL $_idempresa no esta siendo seteado por el formulario.
 */
//include_once ($_SERVER['DOCUMENT_ROOT'].'/control_pms/dl/procura_dl/Conexion.php');

class ProcuraDL 
{
    protected $_idempresa;
    
    /**
     * Obtener los modelos de cartas de adjudicacion 
     */
    public function mostrarCartas(){
        $conex = mysql_connect('localhost','pms_admin','pmsadmin123');
        mysql_select_db('control_pms',$conex);
        
        $query = "(SELECT id,descripcion,path FROM tb_modelocartacomun) 
            UNION (SELECT id,descripcion,path FROM tb_modelocartapropia WHERE tb_empresa_id =1)";
        
        $result = mysql_query($query);
        
        $registros = array();
        while ($reg = mysql_fetch_array($result))
        {
            array_push($registros,$reg);
        }
     
        return $registros;
    }
    
    /**
     * Obtener los modelos de cartas contrato 
     */
    public function mostrarContratos(){
        $conex = mysql_connect('localhost','pms_admin','pmsadmin123');
        mysql_select_db('control_pms',$conex);
        
        $query = "(SELECT id,descripcion,path FROM tb_modelocontratocomun)
            UNION (SELECT id,descripcion,path FROM tb_modelocontratopropio WHERE tb_empresa_id = 1)";
        
        $result = mysql_query($query);
        
        $registros = array();
        while ($reg = mysql_fetch_array($result))
        {
            array_push($registros, $reg);
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