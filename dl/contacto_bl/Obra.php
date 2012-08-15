<?php
/*
 * temporalmente las consultas se haran a la
 * tabla EspecialidadCompania
 */
class Obra 
{
    private $_id;
    private $_codigoobra;
    private $_descripcion;
    private $_fechainicio;
    private $_fechafin;
    private $_direccion;
    private $_tb_departamento_id;
    private $_tb_moneda_id;
    private $_cliente_id;
    private $_empresacontratante_id;
    private $_gerenteproyecto_id;
    private $_supervisoraproyecto_id;
    private $_proveedoresfacturar_id;
    private $_porcentajecartafianza;
    private $_diasdesembolso;
    private $_porcentajefondoretencion;
    private $_diasdevolucionfondoretencion;
    private $_montocontratadomayora;
    private $_monotocontratadomenora;
    private $_cartaadjudicacion;
    private $_modelocontrato;
    private $_tipovalorizacion_id;
    private $_tb_formatopresupuesto_id;
    private $_factorcorreccion;
    private $_retencionfondogarantia;
    private $_retencionfielcumplimiento;
    private $_gastogeneral_precontra;
    private $_utilidad_precontra;
    private $_gastogeneral_ordcamb;
    private $_utilidad_ordcam;
    private $_nombreLista;
    private $_nombreFormulario;
    private $_tb_directorio_id;

    public function getObras()
    {
        
    }
    
    /**
     * G & S 
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_codigoobra() {
        return $this->_codigoobra;
    }

    public function set_codigoobra($_codigoobra) {
        $this->_codigoobra = $_codigoobra;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_fechainicio() {
        return $this->_fechainicio;
    }

    public function set_fechainicio($_fechainicio) {
        $this->_fechainicio = $_fechainicio;
    }

    public function get_fechafin() {
        return $this->_fechafin;
    }

    public function set_fechafin($_fechafin) {
        $this->_fechafin = $_fechafin;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function get_tb_departamento_id() {
        return $this->_tb_departamento_id;
    }

    public function set_tb_departamento_id($_tb_departamento_id) {
        $this->_tb_departamento_id = $_tb_departamento_id;
    }

    public function get_tb_moneda_id() {
        return $this->_tb_moneda_id;
    }

    public function set_tb_moneda_id($_tb_moneda_id) {
        $this->_tb_moneda_id = $_tb_moneda_id;
    }

    public function get_cliente_id() {
        return $this->_cliente_id;
    }

    public function set_cliente_id($_cliente_id) {
        $this->_cliente_id = $_cliente_id;
    }

    public function get_empresacontratante_id() {
        return $this->_empresacontratante_id;
    }

    public function set_empresacontratante_id($_empresacontratante_id) {
        $this->_empresacontratante_id = $_empresacontratante_id;
    }

    public function get_gerenteproyecto_id() {
        return $this->_gerenteproyecto_id;
    }

    public function set_gerenteproyecto_id($_gerenteproyecto_id) {
        $this->_gerenteproyecto_id = $_gerenteproyecto_id;
    }

    public function get_supervisoraproyecto_id() {
        return $this->_supervisoraproyecto_id;
    }

    public function set_supervisoraproyecto_id($_supervisoraproyecto_id) {
        $this->_supervisoraproyecto_id = $_supervisoraproyecto_id;
    }

    public function get_proveedoresfacturar_id() {
        return $this->_proveedoresfacturar_id;
    }

    public function set_proveedoresfacturar_id($_proveedoresfacturar_id) {
        $this->_proveedoresfacturar_id = $_proveedoresfacturar_id;
    }

    public function get_porcentajecartafianza() {
        return $this->_porcentajecartafianza;
    }

    public function set_porcentajecartafianza($_porcentajecartafianza) {
        $this->_porcentajecartafianza = $_porcentajecartafianza;
    }

    public function get_diasdesembolso() {
        return $this->_diasdesembolso;
    }

    public function set_diasdesembolso($_diasdesembolso) {
        $this->_diasdesembolso = $_diasdesembolso;
    }

    public function get_porcentajefondoretencion() {
        return $this->_porcentajefondoretencion;
    }

    public function set_porcentajefondoretencion($_porcentajefondoretencion) {
        $this->_porcentajefondoretencion = $_porcentajefondoretencion;
    }

    public function get_diasdevolucionfondoretencion() {
        return $this->_diasdevolucionfondoretencion;
    }

    public function set_diasdevolucionfondoretencion($_diasdevolucionfondoretencion) {
        $this->_diasdevolucionfondoretencion = $_diasdevolucionfondoretencion;
    }

    public function get_montocontratadomayora() {
        return $this->_montocontratadomayora;
    }

    public function set_montocontratadomayora($_montocontratadomayora) {
        $this->_montocontratadomayora = $_montocontratadomayora;
    }

    public function get_monotocontratadomenora() {
        return $this->_monotocontratadomenora;
    }

    public function set_monotocontratadomenora($_monotocontratadomenora) {
        $this->_monotocontratadomenora = $_monotocontratadomenora;
    }

    public function get_cartaadjudicacion() {
        return $this->_cartaadjudicacion;
    }

    public function set_cartaadjudicacion($_cartaadjudicacion) {
        $this->_cartaadjudicacion = $_cartaadjudicacion;
    }

    public function get_modelocontrato() {
        return $this->_modelocontrato;
    }

    public function set_modelocontrato($_modelocontrato) {
        $this->_modelocontrato = $_modelocontrato;
    }

    public function get_tipovalorizacion_id() {
        return $this->_tipovalorizacion_id;
    }

    public function set_tipovalorizacion_id($_tipovalorizacion_id) {
        $this->_tipovalorizacion_id = $_tipovalorizacion_id;
    }

    public function get_tb_formatopresupuesto_id() {
        return $this->_tb_formatopresupuesto_id;
    }

    public function set_tb_formatopresupuesto_id($_tb_formatopresupuesto_id) {
        $this->_tb_formatopresupuesto_id = $_tb_formatopresupuesto_id;
    }

    public function get_factorcorreccion() {
        return $this->_factorcorreccion;
    }

    public function set_factorcorreccion($_factorcorreccion) {
        $this->_factorcorreccion = $_factorcorreccion;
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

    public function get_gastogeneral_precontra() {
        return $this->_gastogeneral_precontra;
    }

    public function set_gastogeneral_precontra($_gastogeneral_precontra) {
        $this->_gastogeneral_precontra = $_gastogeneral_precontra;
    }

    public function get_utilidad_precontra() {
        return $this->_utilidad_precontra;
    }

    public function set_utilidad_precontra($_utilidad_precontra) {
        $this->_utilidad_precontra = $_utilidad_precontra;
    }

    public function get_gastogeneral_ordcamb() {
        return $this->_gastogeneral_ordcamb;
    }

    public function set_gastogeneral_ordcamb($_gastogeneral_ordcamb) {
        $this->_gastogeneral_ordcamb = $_gastogeneral_ordcamb;
    }

    public function get_utilidad_ordcam() {
        return $this->_utilidad_ordcam;
    }

    public function set_utilidad_ordcam($_utilidad_ordcam) {
        $this->_utilidad_ordcam = $_utilidad_ordcam;
    }

    public function get_nombreLista() {
        return $this->_nombreLista;
    }

    public function set_nombreLista($_nombreLista) {
        $this->_nombreLista = $_nombreLista;
    }

    public function get_nombreFormulario() {
        return $this->_nombreFormulario;
    }

    public function set_nombreFormulario($_nombreFormulario) {
        $this->_nombreFormulario = $_nombreFormulario;
    }

    public function get_tb_directorio_id() {
        return $this->_tb_directorio_id;
    }

    public function set_tb_directorio_id($_tb_directorio_id) {
        $this->_tb_directorio_id = $_tb_directorio_id;
    }


}
