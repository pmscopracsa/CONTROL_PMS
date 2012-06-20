<?php
include_once 'Conexion.php';
include_once 'Comun.php';

/**
 * @Tablas: 
 */

class RegistraPersona 
{
    protected $_id;
    protected $_idempresa;
    protected $_tipodocumento;
    protected $_numerodocumento;
    protected $_hasruc;
    protected $_ruc;
    protected $_nombrecompleto;
    protected $_tbcompaniaid;
    protected $_cargo;
    protected $_telefonofijo = array();
    protected $_telefonomobile = array();
    protected $_telefononextel = array();
    protected $_direccion;
    protected $_pais;
    protected $_departamento;
    protected $_distrito;
    protected $_tbespecialidadid = array();
    protected $_observacion;
    protected $_emailprincipal;
    protected $_emailsecundarios = array();
    protected $_web;
    protected $_fax;
    protected $_tbviaenvioid;
    
    public function __construct() {
        $this->_idempresa = 1;
    }
    
    public function prueba() {
        echo "Dentro de funcion prueba()";
        for ($i = 0; $i < sizeof($this->_tbespecialidadid); $i++) {
            echo "Tamano: ".sizeof($this->_tbespecialidadid)."<br>";
            $especialidad = $this->_tbespecialidadid[$i];
            echo "..".$especialidad."<br>";
        }
    }
    
    public function i_RegistraPersona()
    {
        $conexion = new Conexion();
        $cn = $conexion->conectar();
        
        try {
            mysql_query("BEGIN",$cn);
            
            $query = "INSERT INTO tb_personacontacto VALUES(
                NULL
                ,$this->_idempresa
                ,'$this->_numerodocumento'
                ,'$this->_nombrecompleto'
                ,'$this->_cargo'
                ,'$this->_fax'
                ,'$this->_observacion'
                ,'$this->_emailprincipal'
                ,'$this->_web'
                ,$this->_tbviaenvioid
                ,$this->_tbcompaniaid)";
            $tb_query = mysql_query($query,$cn);
        
            if (!$tb_query)
                throw new Exception('Error en insercion a tabla tb_personacontacto. Error: '.  mysql_error());
            
            mysql_query("COMMIT",$cn);
            
            /**
             * OBTENIENDO EL ULTIMO ID INGRESADO 
             */
            $nombreTablaPersonaContacto = "tb_personacontacto";
            $comun = new Comun();
            $comun->set_nombreTabla($nombreTablaPersonaContacto);
            $ultimo_id = $comun->obtenerUltimoId();
            
            try {
                mysql_query("BEGIN",$cn);
                /**
                 * insercion a tabla: tb_profesion 
                 */
                for ($i = 0; $i < sizeof($this->_tbespecialidadid); $i++) {
                    $especialidad = $this->_tbespecialidadid[$i];
                    $query = "INSERT INTO tb_profesion VALUES($ultimo_id,$especialidad)";
                    $res = mysql_query($query,$cn);
                    if (!$res)
                        throw new Exception("tb_profesion".  mysql_error());
                }
                
                for ($i = 0; $i < sizeof($this->_telefonofijo); $i++ ) {
                    $telefono = $this->_telefonofijo[$i];
                    $query = "INSERT INTO tb_telefonofijopersona VALUES(NULL,'$telefono',$ultimo_id)";
                    $res = mysql_query($query,$cn);
                    if (!$res)
                        throw new Exception("tb_telefonofijopersona".  mysql_error());
                }
                
                for ($i = 0; $i < sizeof($this->_telefonomobile); $i++ ) {
                    $telefono = $this->_telefonomobile[$i];
                    $query = "INSERT INTO tb_telefonomovilpersona VALUES(NULL,'$telefono',$ultimo_id)";
                    $res = mysql_query($query,$cn);
                    if (!$res)
                        throw new Exception("tb_telefonomovilpersona".  mysql_error());
                }
                
                for ($i = 0; $i < sizeof($this->_telefononextel); $i++ ) {
                    $telefono = $this->_telefononextel[$i];
                    $query = "INSERT INTO tb_telefononextelpersona VALUES(NULL,'$telefono',$ultimo_id)";
                    $res = mysql_query($query,$cn);
                    if (!$res)
                        throw new Exception("tb_telefononextelpersona".  mysql_error());
                }
                
                for ($i = 0; $i < sizeof($this->_emailsecundarios); $i++) {
                    $email = $this->_emailsecundarios[$i];
                    $query = "INSERT INTO tb_correosecundarios VALUES (NULL,'$email',$ultimo_id)"; 
                    $res = mysql_query($query);
                    if (!$res)
                        throw new Exception("tb_correosecundarios. Error: ".  mysql_error());
                }
                
                mysql_query("COMMIT",$cn);
            } catch(Exception $ex1) {
                mysql_query("ROLLBACK",$cn);
                $query = "DELETE FROM tb_personacontacto WHERE id = $ultimo_id";
                mysql_query($query,$cn);
                echo $ex1->getMessage()."<br>";
            }
            
        } catch (Exception $ex) {
            mysql_query("ROLLBACK",$cn);
            echo $ex->getMessage()."<br>";
        }
    }
    
    /**
     * GETTERS Y SETTERS 
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_idempresa() {
        return $this->_idempresa;
    }

    public function set_idempresa($_idempresa) {
        $this->_idempresa = $_idempresa;
    }
    
    public function get_tipodocumento() {
        return $this->_tipodocumento;
    }

    public function set_tipodocumento($_tipodocumento) {
        $this->_tipodocumento = $_tipodocumento;
    }

    public function get_hasruc() {
        return $this->_hasruc;
    }

    public function set_hasruc($_hasruc) {
        $this->_hasruc = $_hasruc;
    }

    public function get_ruc() {
        return $this->_ruc;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }

    public function get_nombrecompleto() {
        return $this->_nombrecompleto;
    }

    public function set_nombrecompleto($_nombrecompleto) {
        $this->_nombrecompleto = $_nombrecompleto;
    }

    public function get_tbcompaniaid() {
        return $this->_tbcompaniaid;
    }

    public function set_tbcompaniaid($_tbcompaniaid) {
        $this->_tbcompaniaid = $_tbcompaniaid;
    }

    public function get_cargo() {
        return $this->_cargo;
    }

    public function set_cargo($_cargo) {
        $this->_cargo = $_cargo;
    }

    public function get_telefonofijo() {
        return $this->_telefonofijo;
    }

    public function set_telefonofijo($_telefonofijo) {
        $this->_telefonofijo = $_telefonofijo;
    }

    public function get_telefonomobile() {
        return $this->_telefonomobile;
    }

    public function set_telefonomobile($_telefonomobile) {
        $this->_telefonomobile = $_telefonomobile;
    }

    public function get_telefononextel() {
        return $this->_telefononextel;
    }

    public function set_telefononextel($_telefononextel) {
        $this->_telefononextel = $_telefononextel;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }
    
    public function get_pais() {
        return $this->_pais;
    }

    public function set_pais($_pais) {
        $this->_pais = $_pais;
    }

    public function get_departamento() {
        return $this->_departamento;
    }

    public function set_departamento($_departamento) {
        $this->_departamento = $_departamento;
    }

    public function get_distrito() {
        return $this->_distrito;
    }

    public function set_distrito($_distrito) {
        $this->_distrito = $_distrito;
    }

    public function get_tbespecialidadid() {
        return $this->_tbespecialidadid;
    }

    public function set_tbespecialidadid($_tbespecialidadid) {
        $this->_tbespecialidadid = $_tbespecialidadid;
    }

    public function get_observacion() {
        return $this->_observacion;
    }

    public function set_observacion($_observacion) {
        $this->_observacion = $_observacion;
    }

    public function get_emailprincipal() {
        return $this->_emailprincipal;
    }

    public function set_emailprincipal($_emailprincipal) {
        $this->_emailprincipal = $_emailprincipal;
    }

    public function get_emailsecundarios() {
        return $this->_emailsecundarios;
    }

    public function set_emailsecundarios($_emailsecundarios) {
        $this->_emailsecundarios = $_emailsecundarios;
    }

    public function get_web() {
        return $this->_web;
    }

    public function set_web($_web) {
        $this->_web = $_web;
    }

    public function get_fax() {
        return $this->_fax;
    }

    public function set_fax($_fax) {
        $this->_fax = $_fax;
    }

    public function get_tbviaenvioid() {
        return $this->_tbviaenvioid;
    }

    public function set_tbviaenvioid($_tbviaenvioid) {
        $this->_tbviaenvioid = $_tbviaenvioid;
    }
    
    public function get_numerodocumento() {
        return $this->_numerodocumento;
    }

    public function set_numerodocumento($_numerodocumento) {
        $this->_numerodocumento = $_numerodocumento;
    }
}