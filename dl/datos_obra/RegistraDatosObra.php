<?php
include_once 'Conexion.php';
include_once 'Comun.php';
/**
 * @tabla principal:
 * tb_obra
 * 
 * @tablas secundarias:
 * tb_empresa - la que alquila el sw
 * tb_departamento
 * tb_moneda
 * tb_companiacontacto
 * tb_tipovalorizacion
 * tb_formatopresupuesto 
 */

class RegistraDatosObra 
{
    protected $_id;
    protected $_codigo;
    protected $_nombre;
    protected $_finicio;
    protected $_ffin;
    protected $_direccionobra;
    protected $_tbdepartamentoid;
    protected $_tbmonedaid;
    protected $_tbclienteid;
    protected $_empresacontratante;
    protected $_empresagerenteproyecto;
    protected $_empresasupervisoraproyecto;
    /**
     * parametros ppto. de venta 
     */
    protected $_tbtipovalorizacionid;
    protected $_tbformatopresupuesto;
    protected $_factorcoreccion;
    protected $_retencionfondogarantia;
    protected $_retencionfielcumplimiento;
    protected $_gastogeneralpresupuestocontractual;
    protected $_utilidadpresupuestocontractual;
    protected $_gastogeneralordenescambio;
    protected $_utilidadordenescambio;
    
    protected $_usuariosaprobacion = array();
    
    protected $_provevedorafacturar;
    protected $_contactos = array();
    
    //missing firmas a reportes
    
    protected $_porcentajecartafianza;
    protected $_diashabilesdesembolso;
    protected $_porcentajefondoretencion;
    protected $_diashabilesdevolucion;
    protected $_montomayor;
    protected $_montoentre;
    protected $_montomenor;
    
    protected $_modelocartaadjudicacion;
    protected $_modelocontrato;
    
    public function __construct() {
        
    }
    
    public function i_RegistraObra()
    {
        
    }
    
    /**
     * Funcion que permite insertar los contactos para luego
     * ser usados en la asignacion de las firmas a los reportes 
     */
    public function i_Contactos()
    {
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $sql = "INSERT INTO tb_contacto VALUES(NULL, )";
            $rs = mysql_query($sql,$cn);
            if (!$rs)
                throw new Exception("Error en la insercion de los datos: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function d_Contactos()
    {
        try {
            $comun = new Comun();
            $comun->set_nombreTabla("");
            $ultimo_id = $comun->obtenerUltimoId();
        } catch (Exception $exc) {
            echo $exc->getMessage("Error con la obtencion del ultimo id ingresado: ".  mysql_error());
        }

        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $sql = "DELETE FROM tb_contacto WHERE id = $ultimo_id";
            $rs = mysql_query($sql,$cn);
            if (!$rs)
                throw new Exception("Error en la eliminacion del dato: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function u_Contactos()
    {
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $sql = "UPDATE  ____ SET ____ = ____ WHERE id = _____";
            $rs = mysql_query($sql,$cn);
            if (!$rs)
                throw new Exception("Error en la insercion de los datos: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

        /**
     * GETTERS & SETTERS 
     */
    public function get_contactos() {
        return $this->_contactos;
    }

    public function set_contactos($_contactos) {
        $this->_contactos = $_contactos;
    }


}