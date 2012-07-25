<?php
class Conexion 
{
    protected $db;
    protected $servidor;
    protected $usuario;
    protected $clave;
    protected $conexion_id;
    protected $consulta_id;
    protected $error_no;
    protected $error;
    
    public function __construct() 
    {
        $this->usuario = "pms_admin";
        $this->clave = "pmsadmin123";
        $this->db = "control_pms";
        $this->servidor = "localhost";
    }
    
    public function conectar()
    {
        $this->conexion_id = mysql_connect($this->servidor, $this->usuario, $this->clave) or die ("No se puede conectar: ".  mysql_error());
        
        if(!$this->conexion_id){
            $this->error = "No se puede conectar al servidor";
            return 0;
        }
        
        if(!@mysql_select_db($this->db, $this->conexion_id)) {
            $this->error = "Problemas con la base de datos: ".$this->db;
            return 0;
        }
        return $this->conexion_id;
    }
    
    public function desconectar()
    {
        mysql_close($this->conexion_id);
    }
}