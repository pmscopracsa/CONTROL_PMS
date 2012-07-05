<?php
include_once 'Conexion.php';
include_once 'Comun.php';

    /**
     * @Tablas:
     * tb_listadistribucioncontacto
     * 
     * tb_contactolista 
     */

class RegistraListaDistribucion 
{
    protected $_id;
    protected $_empresaid;
    protected $_nombrelista;
    protected $_codigoobra;
    protected $_tbcontactoid = array();
    protected $_observacion;
    
    public function __construct() {
        $this->_empresaid = 1;
    }
    
    public function prueba() {    
        echo "tamano: ".sizeof($this->_tbcontactoid)."<br>";
        for ($i = 0; $i < sizeof($this->_tbcontactoid); $i++) {
            echo "->".$this->_tbcontactoid[$i]."<br>";
        }
    }
    
    public function i_RegistraListaDistribucion()
    {
        $conexion = new Conexion();
        $cn = $conexion->conectar();
        
        /**
         * INSERCION A TABLA: tb_listadistribucioncontacto 
         */
        try {
            mysql_query("BEGIN",$cn);
            
            $query = "INSERT INTO tb_listadistribucioncontacto VALUES (
                NULL
                ,$this->_empresaid
                ,'$this->_nombrelista'
                ,'$this->_codigoobra'
                ,'$this->_observacion')";
            $tb_query = mysql_query($query,$cn);
            
            if (!$query)
                throw new Exception('Error en insercion a tabla: tb_listadistribucioncontacto. Error '.mysql_error ());
            
            mysql_query("COMMIT",$cn);
            
            /**
             * insertando a tablas dependientes 
             */
            
            $nombreTablaPersonaContacto = "tb_listadistribucioncontacto";
            $comun = new Comun();
            $comun->set_nombreTabla($nombreTablaPersonaContacto);
            $ultimo_id = $comun->obtenerUltimoId();
            
            try {
                mysql_query("BEGIN",$cn);
                
                for ($i = 0; $i < sizeof($this->_tbcontactoid); $i++) {
                    //echo $ultimo_id."<br>";
                    $contacto = $this->_tbcontactoid[$i];
                    //$query = "INSERT INTO tb_contactodelista VALUES($ultimo_id,$contacto)";
                    $query = "INSERT INTO tb_listadistribucionpersonacontacto VALUES($ultimo_id,$contacto)";
                    $res = mysql_query($query,$cn);
                    if (!$res) 
                        throw new Exception("tb_contactodelista. Error: ". mysql_error());
                }
                mysql_query("COMMIT",$cn);
            } catch(Exception $ex1) {
                mysql_query("ROLLBACK",$cn);
                $query = "DELETE FROM tb_listadistribucioncontacto WHERE id = $ultimo_id";
                mysql_query($query,$cn);
                echo $ex1->getMessage()."<br>";
            }
        } catch(Exception $ex) {
            mysql_query("ROLLBACK",$cn);
            echo $ex->getMessage()."<br>";
        }
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_empresaid() {
        return $this->_empresaid;
    }

    public function set_empresaid($_empresaid) {
        $this->_empresaid = $_empresaid;
    }

    public function get_nombrelista() {
        return $this->_nombrelista;
    }

    public function set_nombrelista($_nombrelista) {
        $this->_nombrelista = $_nombrelista;
    }

    public function get_codigoobra() {
        return $this->_codigoobra;
    }

    public function set_codigoobra($_codigoobra) {
        $this->_codigoobra = $_codigoobra;
    }

    public function get_tbcontactoid() {
        return $this->_tbcontactoid;
    }

    public function set_tbcontactoid($_tbcontactoid) {
        $this->_tbcontactoid = $_tbcontactoid;
    }

    public function get_observacion() {
        return $this->_observacion;
    }

    public function set_observacion($_observacion) {
        $this->_observacion = $_observacion;
    }
}