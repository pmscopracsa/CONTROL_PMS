<?php

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
}