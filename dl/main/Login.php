<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author root
 * 
 */
include_once '../Conexion.php';

class Login 
{
    protected $usuario;
    protected $password;
    
    public function __construct() {
        ;
    }
    
    public function conectaDB() {
        $conex = new Conexion();
        return $cn = $conex->conectar();
    }
    
    public function login(){
        $respuesta = TRUE;
        
        $cn = $this->conectaDB();
        
        $query_array = $query = "SELECT id,nombre,password,logo,tb_pais_id,tb_tipodireccion_id";
        if(!mysql_query($query))$respuesta = FALSE;
        
        $datos = mysql_fetch_array($query_array);
        $this->liberaRespuesta($query_array);
        $this->desconectar($cn);
        
        if ($this->usuario != $datos['nombhre']) $respuesta = FALSE;
        if ($this->password != $datos['password']) $respuesta = FALSE;
        
        return $respuesta;
    }
    
    public function liberaRespuesta($res){
        mysql_free_result($res);
    }
    
    public function desconectar($cn){
        mysql_close($cn);
    }    
    
    /**
     * G&S 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }


}

?>
