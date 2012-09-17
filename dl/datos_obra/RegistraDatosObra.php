<?php
include_once '../Conexion.php';
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
    
    // EMPRESA QUE ALQUILA EL SW
    protected $_idempresa;
    
    // NUMERO ALEATORIO DE SESION
    protected $aleatorio;
    
    //estado del proyecto 1 = Ya ha sido filled, 0 = aun no
    
    public function __construct() {
        
    }
    
    /** ESTE INSERTA ES EN REALIDAD UN UPDATE YA QUE LA OBRA YA EXISTE */ 
    // el campo estado se pone a 1 cuando por primera vez ha sido rellenado
    // el campo estado por defecto se pone en 0
    public function i_RegistraObra()
    {
        $sql = "UPDATE
	tb_obra
        SET
	fechainicio = '$this->_finicio',
	fechafin = '$this->_ffin',
	direccion = '$this->_direccionobra',
	tb_departamento_id = $this->_tbdepartamentoid,
	tb_moneda_id = $this->_tbmonedaid,
	cliente_id = $this->_tbclienteid,
	empresacontratante_id = $this->_empresacontratante,
	gerenteproyecto_id = $this->_empresagerenteproyecto,
	supervisoraproyecto_id = $this->_empresasupervisoraproyecto,
	proveedoresfacturar_id = $this->_provevedorafacturar,
	porcentajecartafianza = $this->_porcentajecartafianza,
	diasdesembolso = $this->_diashabilesdesembolso,
	porcentajefondoretencion = $this->_porcentajefondoretencion,
	diasdevolucionfondoretencion = '$this->_diashabilesdevolucion',
	montocontratadomayora = $this->_montomayor,
	montocontratadomenora = $this->_montomenor,
	cartaadjudicacion = '$this->_modelocartaadjudicacion',
	modelocontrato = '$this->_modelocontrato',
	tb_tipovalorizacion_id = $this->_tbtipovalorizacionid,
	tb_formatopresupuesto_id = $this->_tbformatopresupuesto,
	factorcorreccion = $this->_factorcoreccion,
	retencionfondogarantia = $this->_retencionfondogarantia,
	retencionfielcumplimiento = '$this->_retencionfielcumplimiento',
	gastogeneral_precontra = $this->_gastogeneralpresupuestocontractual,
	utilidad_precontra = $this->_utilidadpresupuestocontractual,
	gastogeneral_ordcamb = $this->_gastogeneralordenescambio,
	utilidad_ordcamb = $this->_utilidadordenescambio,
        estado = 1    
        WHERE id = $this->_id";
        
        try{
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar en obra: ".  mysql_error());
            
            $rs = mysql_query($sql,$cn);
            if(!$rs)                throw new Exception("Error al consultar en obra: ".  mysql_error());
            
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
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
    
    public function s_buscaObraPorCodigo()
    {
        $query = "SELECT 
        o.id oid 
        ,o.codigoobra ocodigoobra
        ,o.descripcion odescripcion
        ,o.fechainicio ofechainicio
        ,o.fechafin ofechafin
        ,o.direccion odireccion
        ,o.porcentajecartafianza oporcentajecartafianza
        ,o.diasdesembolso odiasdesembolso
        ,o.porcentajefondoretencion oporcentajefondoretencion
        ,o.diasdevolucionfondoretencion odiasdevolucionfondoretencion
        ,o.montocontratadomayora omontocontratadomayora
        ,o.montocontratadomenora omontocontratadomenora
        ,o.cartaadjudicacion ocartaadjudicacion
        ,o.modelocontrato omodelocontrato
        ,o.factorcorreccion ofactorcorreccion
        ,o.retencionfondogarantia oretencionfondogarantia
        ,o.retencionfielcumplimiento oretencionfielcumplimiento
        ,o.gastogeneral_precontra ogastogeneral_precontra
        ,o.utilidad_precontra outilidad_precontra
        ,o.gastogeneral_ordcamb ogastogeneral_ordcamb
        ,o.utilidad_ordcamb outilidad_ordcamb
        ,o.nombreLista onombreLista
        ,o.nombreFormulario onombreFormulario
        FROM tb_empresa e
        INNER JOIN tb_obra o ON e.id = o.tb_empresa_id 
        WHERE o.codigoobra = '$this->_codigo' AND e.id = $this->_idempresa";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar:".  mysql_error());
            
            $sql = mysql_query($query,$cn);
            
            if (!$sql)
                throw new Exception("Error en la consulta:".  mysql_error());
            
        } catch (Exception $ex) {
            echo "Error al consultar obra por codigo. Error: ".$ex->getMessage();
        }
    }
    
    public function s_buscaObraPorNombre()
    {
                $query = "SELECT 
        o.id oid 
        ,o.codigoobra ocodigoobra
        ,o.descripcion odescripcion
        ,o.fechainicio ofechainicio
        ,o.fechafin ofechafin
        ,o.direccion odireccion
        ,o.porcentajecartafianza oporcentajecartafianza
        ,o.diasdesembolso odiasdesembolso
        ,o.porcentajefondoretencion oporcentajefondoretencion
        ,o.diasdevolucionfondoretencion odiasdevolucionfondoretencion
        ,o.montocontratadomayora omontocontratadomayora
        ,o.montocontratadomenora omontocontratadomenora
        ,o.cartaadjudicacion ocartaadjudicacion
        ,o.modelocontrato omodelocontrato
        ,o.factorcorreccion ofactorcorreccion
        ,o.retencionfondogarantia oretencionfondogarantia
        ,o.retencionfielcumplimiento oretencionfielcumplimiento
        ,o.gastogeneral_precontra ogastogeneral_precontra
        ,o.utilidad_precontra outilidad_precontra
        ,o.gastogeneral_ordcamb ogastogeneral_ordcamb
        ,o.utilidad_ordcamb outilidad_ordcamb
        ,o.nombreLista onombreLista
        ,o.nombreFormulario onombreFormulario
        FROM tb_empresa e
        INNER JOIN tb_obra o ON e.id = o.tb_empresa_id 
        WHERE o.descripcion = '$this->_nombre' AND e.id = $this->_idempresa";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar:".  mysql_error());
            
            $sql = mysql_query($query,$cn);
            
            if (!$sql)
                throw new Exception("Error en la consulta:".  mysql_error());
            
            /** INGRESAR CONTACTOS DE LA OBRA */
            $tmpcontactos_contacto = "INSERT INTO tb_contacto (tb_personacontacto_id, tb_obra_id) 
            SELECT id_contacto,id_obra FROM temporal WHERE random_code = '$this->aleatorio'";
            
            $rs_contacto = mysql_query($tmpcontactos_contacto);
            if (!$rs_contacto)                throw new Exception("Error al mover a los contactos: ".  mysql_error());
            
            /** INGRESAR CONTACTOS Y SUS REPORTES */
            $tmpcontactosreporte_contactoreporte = "
                INSERT INTO tb_contactoreporte (tb_personacontacto_id,tb_reporte_id,tb_obra_id,posicion_reporte)
                SELECT id_contacto,id_reporte, $this->_codigo, posicion_firma_en_reporte FROM tb_contactoreportetemporal WHERE id_aleatorio = $this->aleatorio";
            
            $rs_reportes = mysql_query($tmpcontactosreporte_contactoreporte);
            if (!$rs_reportes)                throw new Exception("Error al mover los reportes: ".  mysql_error());
            
        } catch (Exception $ex) {
            echo "Error al consultar obra por codigo. Error: ".$ex->getMessage();
        }
    }

    /**
     * GETTERS & SETTERS 
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_codigo() {
        return $this->_codigo;
    }

    public function set_codigo($_codigo) {
        $this->_codigo = $_codigo;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function get_finicio() {
        return $this->_finicio;
    }

    public function set_finicio($_finicio) {
        $this->_finicio = $_finicio;
    }

    public function get_ffin() {
        return $this->_ffin;
    }

    public function set_ffin($_ffin) {
        $this->_ffin = $_ffin;
    }

    public function get_direccionobra() {
        return $this->_direccionobra;
    }

    public function set_direccionobra($_direccionobra) {
        $this->_direccionobra = $_direccionobra;
    }

    public function get_tbdepartamentoid() {
        return $this->_tbdepartamentoid;
    }

    public function set_tbdepartamentoid($_tbdepartamentoid) {
        $this->_tbdepartamentoid = $_tbdepartamentoid;
    }

    public function get_tbmonedaid() {
        return $this->_tbmonedaid;
    }

    public function set_tbmonedaid($_tbmonedaid) {
        $this->_tbmonedaid = $_tbmonedaid;
    }

    public function get_tbclienteid() {
        return $this->_tbclienteid;
    }

    public function set_tbclienteid($_tbclienteid) {
        $this->_tbclienteid = $_tbclienteid;
    }

    public function get_empresacontratante() {
        return $this->_empresacontratante;
    }

    public function set_empresacontratante($_empresacontratante) {
        $this->_empresacontratante = $_empresacontratante;
    }

    public function get_empresagerenteproyecto() {
        return $this->_empresagerenteproyecto;
    }

    public function set_empresagerenteproyecto($_empresagerenteproyecto) {
        $this->_empresagerenteproyecto = $_empresagerenteproyecto;
    }

    public function get_empresasupervisoraproyecto() {
        return $this->_empresasupervisoraproyecto;
    }

    public function set_empresasupervisoraproyecto($_empresasupervisoraproyecto) {
        $this->_empresasupervisoraproyecto = $_empresasupervisoraproyecto;
    }

    public function get_tbtipovalorizacionid() {
        return $this->_tbtipovalorizacionid;
    }

    public function set_tbtipovalorizacionid($_tbtipovalorizacionid) {
        $this->_tbtipovalorizacionid = $_tbtipovalorizacionid;
    }

    public function get_tbformatopresupuesto() {
        return $this->_tbformatopresupuesto;
    }

    public function set_tbformatopresupuesto($_tbformatopresupuesto) {
        $this->_tbformatopresupuesto = $_tbformatopresupuesto;
    }

    public function get_factorcoreccion() {
        return $this->_factorcoreccion;
    }

    public function set_factorcoreccion($_factorcoreccion) {
        $this->_factorcoreccion = $_factorcoreccion;
    }

    public function get_retencionfondogarantia() {
        return $this->_retencionfondogarantia;
    }

    public function set_retencionfondogarantia($_retencionfondogarantia) {
        $this->_retencionfondogarantia = $_retencionfondogarantia;
    }

    public function get_retencionfielcumplimiento() {
        return $this->_retencionfielcumplimiento;
    }

    public function set_retencionfielcumplimiento($_retencionfielcumplimiento) {
        $this->_retencionfielcumplimiento = $_retencionfielcumplimiento;
    }

    public function get_gastogeneralpresupuestocontractual() {
        return $this->_gastogeneralpresupuestocontractual;
    }

    public function set_gastogeneralpresupuestocontractual($_gastogeneralpresupuestocontractual) {
        $this->_gastogeneralpresupuestocontractual = $_gastogeneralpresupuestocontractual;
    }

    public function get_utilidadpresupuestocontractual() {
        return $this->_utilidadpresupuestocontractual;
    }

    public function set_utilidadpresupuestocontractual($_utilidadpresupuestocontractual) {
        $this->_utilidadpresupuestocontractual = $_utilidadpresupuestocontractual;
    }

    public function get_gastogeneralordenescambio() {
        return $this->_gastogeneralordenescambio;
    }

    public function set_gastogeneralordenescambio($_gastogeneralordenescambio) {
        $this->_gastogeneralordenescambio = $_gastogeneralordenescambio;
    }

    public function get_utilidadordenescambio() {
        return $this->_utilidadordenescambio;
    }

    public function set_utilidadordenescambio($_utilidadordenescambio) {
        $this->_utilidadordenescambio = $_utilidadordenescambio;
    }

    public function get_provevedorafacturar() {
        return $this->_provevedorafacturar;
    }

    public function set_provevedorafacturar($_provevedorafacturar) {
        $this->_provevedorafacturar = $_provevedorafacturar;
    }

    public function get_porcentajecartafianza() {
        return $this->_porcentajecartafianza;
    }

    public function set_porcentajecartafianza($_porcentajecartafianza) {
        $this->_porcentajecartafianza = $_porcentajecartafianza;
    }

    public function get_diashabilesdesembolso() {
        return $this->_diashabilesdesembolso;
    }

    public function set_diashabilesdesembolso($_diashabilesdesembolso) {
        $this->_diashabilesdesembolso = $_diashabilesdesembolso;
    }

    public function get_porcentajefondoretencion() {
        return $this->_porcentajefondoretencion;
    }

    public function set_porcentajefondoretencion($_porcentajefondoretencion) {
        $this->_porcentajefondoretencion = $_porcentajefondoretencion;
    }

    public function get_diashabilesdevolucion() {
        return $this->_diashabilesdevolucion;
    }

    public function set_diashabilesdevolucion($_diashabilesdevolucion) {
        $this->_diashabilesdevolucion = $_diashabilesdevolucion;
    }

    public function get_montomayor() {
        return $this->_montomayor;
    }

    public function set_montomayor($_montomayor) {
        $this->_montomayor = $_montomayor;
    }

    public function get_montomenor() {
        return $this->_montomenor;
    }

    public function set_montomenor($_montomenor) {
        $this->_montomenor = $_montomenor;
    }

    public function get_modelocartaadjudicacion() {
        return $this->_modelocartaadjudicacion;
    }

    public function set_modelocartaadjudicacion($_modelocartaadjudicacion) {
        $this->_modelocartaadjudicacion = $_modelocartaadjudicacion;
    }

    public function get_modelocontrato() {
        return $this->_modelocontrato;
    }

    public function set_modelocontrato($_modelocontrato) {
        $this->_modelocontrato = $_modelocontrato;
    }
    
    public function get_idempresa() {
        return $this->_idempresa;
    }

    public function set_idempresa($_idempresa) {
        $this->_idempresa = $_idempresa;
    }
    
    public function getAleatorio() {
        return $this->aleatorio;
    }

    public function setAleatorio($aleatorio) {
        $this->aleatorio = $aleatorio;
    }


}