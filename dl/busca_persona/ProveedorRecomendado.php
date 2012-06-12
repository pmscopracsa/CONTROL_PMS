<?php

include_once '../Conexion.php';

/**
 * @Descripcion:
 * Importa el contacto comun a.k.a páginas amarillas
 * a la lista de contacto de  la empresa que la estuvo visualizando
 * 
 * @Tablas:
 * 
 */

class ProveedorRecomendado {
    protected $_id_empresa;
    protected $_id_persona;
    
    public function __construct() {
        $conex = new Conexion();
        $conex->conectar();
    }
    
    public function importarContactoComun()
    {
        $sql = "INSERT INTO";
    }
    
    /**
     * Getters y Setters 
     */
    public function get_id_empresa() {
        return $this->_id_empresa;
    }

    public function set_id_empresa($_id_empresa) {
        $this->_id_empresa = $_id_empresa;
    }

    public function get_id_persona() {
        return $this->_id_persona;
    }

    public function set_id_persona($_id_persona) {
        $this->_id_persona = $_id_persona;
    }


}

?>
