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
                ,'$this->_observacion')";
            $tb_query = mysql_query($query,$cn);
            
            if (!$tb_query)
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
    
    public function s_buscarListaDistribucionPorNombre()
    {
        $query = "SELECT 
            id
            ,tb_empresa_id
            ,descripcion
            ,observacion
            FROM tb_listadistribucioncontacto
            WHERE descripcion = '$this->_nombrelista'";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if(!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            
            $sql = mysql_query($query);
            if (!$sql)                throw new Exception("Error al consultar: ".  mysql_error());
            
            $listadatos = array();
            
            while ($res = mysql_fetch_array($sql,MYSQL_ASSOC)){
                array_push($listadatos, $res['id']);
                array_push($listadatos, $res['tb_empresa_id']);
                array_push($listadatos, $res['descripcion']);
                array_push($listadatos, $res['observacion']);
            }
            return $listadatos;
        } catch (Exception $exc) {
            echo "Error: ".$exc->getMessage();
        }
    }
    
    public function s_buscarListaDistribucionPorId()
    {
        $query = "SELECT 
            id
            ,tb_empresa_id
            ,descripcion
            ,observacion
            FROM tb_listadistribucioncontacto
            WHERE id = $this->_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if(!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            
            $sql = mysql_query($query);
            if (!$sql)                throw new Exception("Error al consultarOOO: ".  mysql_error());
            
            $listadatos = array();
            
            while ($res = mysql_fetch_array($sql,MYSQL_ASSOC)){
                array_push($listadatos, $res['id']);
                array_push($listadatos, $res['tb_empresa_id']);
                array_push($listadatos, $res['descripcion']);
                array_push($listadatos, $res['observacion']);
            }
            return $listadatos;
        } catch (Exception $exc) {
            echo "Error: ".$exc->getMessage();
        }
    }

    public function obtenerContactosPorLista()
    {
        $query = "SELECT 
            pc.id
            ,pc.nombre
            FROM tb_listadistribucionpersonacontacto lp
            LEFT JOIN tb_listadistribucioncontacto ld ON lp.tb_listadistribucioncontacto_id = ld.id
            LEFT JOIN tb_personacontacto pc ON lp.tb_personacontacto_id = pc.id
            WHERE ld.id = $this->_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultarYYY: ".  mysql_error());
            
            $contactos = array();
            
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($contactos,$res['id']);
                array_push($contactos,$res['nombre']);
            }
            return $contactos;
            
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
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