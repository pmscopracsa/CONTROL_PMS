<?php
require_once '../Conexion.php';

class Contacto_DL 
{
    protected $id;
    protected $tb_personacontacto_id;
    protected $tb_obra_id;
    
    /** INSERTA UN NUEVO CONTACTO EN UNA OBRA */
    public function i_Contacto(){
        $sql = "";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            
            
                
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function r_DevuelveFilas() {
        $sql = "SELECT id_contacto";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($sql);
            if (!$rs)                throw new Exception("Error al consultar: ".  mysql_error());
            
            
            
        } catch(Exception $ex){
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /** G&S */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTb_personacontacto_id() {
        return $this->tb_personacontacto_id;
    }

    public function setTb_personacontacto_id($tb_personacontacto_id) {
        $this->tb_personacontacto_id = $tb_personacontacto_id;
    }

    public function getTb_obra_id() {
        return $this->tb_obra_id;
    }

    public function setTb_obra_id($tb_obra_id) {
        $this->tb_obra_id = $tb_obra_id;
    }
}