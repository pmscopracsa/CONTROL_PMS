<?php
include_once '../Conexion.php';
include_once '../consultas_comunes/Comun.php';

/**
 * @Descripcion:
 * @Tablas:
 * tb_companiacontacto // representante
 * tb_telefonofijocompania
 * tb_telefonomovilcompania
 * tb_telefononextelcompania
 * tb_giro
 * 
 * tb_viaenvio
 * tb_tipocompania
 */
class RegistraCompania 
{
    protected $_id;
    protected $_descripcion;
    protected $_ruc;
    protected $_nombrecomercial; 
    protected $_partidaregistral;
    protected $_actividadprincipal;
    protected $_tipocompania;
    protected $_fax;
    protected $_observacion;
    protected $_email;
    protected $_web;
    protected $_viaenvio;
    /**
     * Empresa a la que pertenece esta empresa, por defecto por ahora Copracsa
     */
    protected $_idempresa;
    
    /**
     * N:M 
     */
    protected $_cantgiros;
    protected $_giro = array();
    
    protected $_cantfijos;
    protected $_telefonoFijo = array();
    
    protected $_cantmoviles;
    protected $_telefonoMobile = array();
    
    protected $_cantnextel;
    protected $_telefonoNextel = array();
    
    protected $_cantespecialidad;
    protected $_especialidad = array();
    
    protected $_cantrepresentante;
    protected $_representate = array();
    
    protected $_cantdireccion;
    
    protected $_tipodireccion = array();
    protected $_direccion = array();
    protected $_pais = array();
    protected $_departamento = array();
    protected $_distrito = array();
    
    
    public function __construct() {
        /**
         * ACTIVAMOS LA CLASE CONEXION 
         */
        $conex = new Conexion();
        $conex->conectar();
    }
    
    public function i_RegistraCompania()
    {
        /**
         * OBTENIENDO EL ULTIMO ID INSERTADO 
         */
        $comun = new Comun();
        $comun->set_nombreTabla($nombreTablaCompaniaContacto);
        $ultimo_id = $comun->obtenerUltimoId();
        
        /**
         * INSERCION A TABLA: tb_companiacontacto 
         */
        $nombreTablaCompaniaContacto = "tb_companiacontacto";
        $tablaTFijo = "tb_telefonofijocompania";
        
        mysql_query("BEGIN");
        try {
            $sql_tb_companiacontacto = "INSERT INTO tb_companiacontacto (
                id
                ,descripcion
                ,ruc
                ,nombrecomercial
                ,partidaregistral
                ,giro
                ,actividadprincipal
                ,tb_tipocompania_id
                ,fax
                ,observacion
                ,email
                ,web
                ,tb_viaenvio_id
                ,tb_empresa_id) VALUES (
                NULL
                ,$this->_descripcion
                ,$this->_ruc
                ,$this->_nombrecomercial
                ,$this->_partidaregistral
                ,$this->_actividadprincipal
                ,$this->_tipocompania
                ,$this->_fax
                ,$this->_observacion
                ,$this->_email
                ,$this->_web
                ,$this->_viaenvio
                ,$this->_idempresa    
                )";
            $tb_companiacontacto = mysql_query($sql_tb_companiacontacto);
            
            if (!$tb_companiacontacto) {
                throw new Exception("Error en insercion a tabla: ".$nombreTablaCompaniaContacto.". Error:".  mysql_error());
            }
            
            /**
             * INSERCION A TABLA: tb_giro 
             */
            if ($this->_cantgiros >= 1) 
            {
                for ($i = 0; $i < $this->_cantgiros; $i++) {
                    $sql_tbgiro = "INSERT INTO tb_giro (
                        id
                        ,descripcion
                        ,tb_compania_id) VALUES (
                        NULL
                        ,'$this->_giro[$i]'
                        ,$this->_idempresa)" ;

                    $tb_giro = mysql_query($sql_tbgiro);
                    if (!$tb_giro) {
                        throw new Exception("Error en insercion a tabla tb_giro. Error: ".  mysql_error());
                    }
                }
            }
            
            /**
             * INSERCION A TABLA: tb_telefonofijocompania
             */
            if ($this->_cantfijos >= 1)
            {
                for ($i = 0; $i < $this->_cantfijos; $i++) {
                    $sql_tbtelefonofijocompania = "INSERT INTO tb_telefonofijocompania (
                        id
                        ,numero
                        ,tb_companiacontacto_id) VALUES (
                        NULL
                        ,'$this->_telefonoFijo[$i]'
                        ,$ultimo_id    
                        )";
                    $tb_telefonofijo = mysql_query($sql_tbtelefonofijocompania);

                    if (!$tb_telefonofijo) {
                        throw new Exception("Error en insercion a tabla:".$tablaTFijo.". Error: ".mysql_error());
                    }
                }
            }
            
            /**
             * INSERCION A TABLA: tb_telefonomovilcompania
             */
            if ($this->_cantmoviles >= 1)
            {
                for ($i = 0; $i < $this->_cantmoviles; $i++) {
                    $sql_tbtelefonomovilcompania = "INSERT INTO tb_telefonomovilcompania(
                        id
                        ,numero
                        ,tb_companiacontacto_id) VALUES (
                        NULL
                        ,'$this->_telefonoMobile[$i]'
                        ,$ultimo_id)";
                    $tb_telefonomovil = mysql_query($sql_tbtelefonomovilcompania);
                    
                    if (!$tb_telefonomovil) {
                        throw new Exception("Error en la insercion a tabla: tb_telefonomovil. Error: ".mysql_error());
                    }
                }
            }
            
            /**
             * INSERCION A TABLA: tb_telefononextelcompania 
             */
            if ($this->_cantnextel >= 1)
            {
                for ($i = 0; $i <$this->_cantnextel; $i++) {
                    $sql_tbtelefononextelcompania = "INSERT INTO tb_telefononextelcompania (
                        id
                        ,numero
                        ,tb_personacontacto_id) VALUES (
                        NULL
                        ,'$this->_telefonoNextel[$i]'
                        ,$ultimo_id)";
                    $tb_telefononextel = mysql_query($sql_tbtelefononextelcompania);
                    
                    if (!$tb_telefononextel) {
                        throw new Exception("Error en la insercion a tabla: tb_telefononextel. Error: ".mysql_error());
                    }
                }
            }
            
            /**
             * INSERCION A TABLA: tb_especialidadcompania 
             */
            if ($this->_cantespecialidad >= 1)
            {
                for ($i = 0; $i < $this->_cantespecialidad; $i++)
                {
                    $sql_tbespecialidadcompania = "INSERT INTO tb_especialidadcompania (
                        id
                        ,descripcion) VALUES (
                        NULL
                        ,'$this->_especialidad[$i]')";
                    $tb_especialidadcompania = mysql_query($sql_tbespecialidadcompania);
                    
                    if (!$tb_especialidadcompania) {
                        throw new Exception("Error en la insercion a tabla: tb_especialidadcompania. Error: ".mysql_error());
                    }
                }
            }
            
            /**
             *  INSERCION A TABLA: tb_representante
             */
            if ($this->_cantrepresentante >= 1)
            {
                for ($i = 0; $i < $this->_cantrepresentante; $i++)
                {
                    $sql_tbrepresentante = "INSERT INTO tb_representante (
                        tb_companiacontacto_id
                        ,tb_personacontacto_id) VALUES (
                        $ultimo_id
                        ,$this->_representate[$i])";
                    $tb_representante = mysql_query($sql_tbrepresentante);
                    
                    if (!$tb_representante) {
                        throw new Exception("Error en la insercion a tabla: tb_representante. Error: ".mysql_error());
                    }
                }
            }
            
            /**
             * INSERCION A TABLA: tb_direccioncompaniacontacto
             */
            if ($this->_cantdireccion >= 1)
            {
                for ($i = 0; $i < $this->_cantdireccion; $i++)
                {
                    $sql_tbdireccion = "INSERT INTO tb_direccioncompaniacontacto (
                        id
                        ,direccion
                        ,tb_pais_id
                        ,tb_departamento_id
                        ,tb_companiacontacto_id
                        ,tb_tipodireccion_id
                        ,tb_distrito_id
                        ) VALUES (
                        NULL
                        ,'$this->_direccion[$i]'
                        ,$this->_pais[$i]
                        ,$this->_departamento[$i]
                        ,$ultimo_id
                        ,$this->_distrito[$i]
                        ,$this->_tipodireccion[$i])";
                    $tb_direccion = mysql_query($sql_tbdireccion);
                    
                    if (!$tb_direccion) {
                        throw new Exception("Error en la insercion a tabla: tb_direccion. Error: ".mysql_error());
                    }
                }
            }
            
            mysql_query("COMMIT");
        } catch (Exception $exc) {
            mysql_query("ROLLBACK");
        }
        
    }
    
    public function u_RegistraCompania()
    {
        
    }
    
    public function d_RegistraCompania()
    {
        
    }
    
    /**
     * GETTERS Y SETTERS DE LAS VARIABLES DE LA CLASE
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_ruc() {
        return $this->_ruc;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }

    public function get_nombrecomercial() {
        return $this->_nombrecomercial;
    }

    public function set_nombrecomercial($_nombrecomercial) {
        $this->_nombrecomercial = $_nombrecomercial;
    }

    public function get_partidaregistral() {
        return $this->_partidaregistral;
    }

    public function set_partidaregistral($_partidaregistral) {
        $this->_partidaregistral = $_partidaregistral;
    }

    public function get_actividadprincipal() {
        return $this->_actividadprincipal;
    }

    public function set_actividadprincipal($_actividadprincipal) {
        $this->_actividadprincipal = $_actividadprincipal;
    }

    public function get_tipocompania() {
        return $this->_tipocompania;
    }

    public function set_tipocompania($_tipocompania) {
        $this->_tipocompania = $_tipocompania;
    }

    public function get_fax() {
        return $this->_fax;
    }

    public function set_fax($_fax) {
        $this->_fax = $_fax;
    }

    public function get_observacion() {
        return $this->_observacion;
    }

    public function set_observacion($_observacion) {
        $this->_observacion = $_observacion;
    }

    public function get_email() {
        return $this->_email;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function get_web() {
        return $this->_web;
    }

    public function set_web($_web) {
        $this->_web = $_web;
    }

    public function get_viaenvio() {
        return $this->_viaenvio;
    }

    public function set_viaenvio($_viaenvio) {
        $this->_viaenvio = $_viaenvio;
    }

    public function get_idempresa() {
        return $this->_idempresa;
    }

    public function set_idempresa($_idempresa) {
        $this->_idempresa = $_idempresa;
    }
    
    /**
     * GETTERS Y SETTERS PARA PARA SABER LA CANTIDAD DE DATOS
     * @return type 
     */

    public function get_cantgiros() {
        return $this->_cantgiros;
    }

    public function set_cantgiros($_cantgiros) {
        $this->_cantgiros = $_cantgiros;
    }

    public function get_cantfijos() {
        return $this->_cantfijos;
    }

    public function set_cantfijos($_cantfijos) {
        $this->_cantfijos = $_cantfijos;
    }

    public function get_cantmoviles() {
        return $this->_cantmoviles;
    }

    public function set_cantmoviles($_cantmoviles) {
        $this->_cantmoviles = $_cantmoviles;
    }

    public function get_cantnextel() {
        return $this->_cantnextel;
    }

    public function set_cantnextel($_cantnextel) {
        $this->_cantnextel = $_cantnextel;
    }

    public function get_cantespecialidad() {
        return $this->_cantespecialidad;
    }

    public function set_cantespecialidad($_cantespecialidad) {
        $this->_cantespecialidad = $_cantespecialidad;
    }

    public function get_cantrepresentante() {
        return $this->_cantrepresentante;
    }

    public function set_cantrepresentante($_cantrepresentante) {
        $this->_cantrepresentante = $_cantrepresentante;
    }

    public function get_cantdireccion() {
        return $this->_cantdireccion;
    }

    public function set_cantdireccion($_cantdireccion) {
        $this->_cantdireccion = $_cantdireccion;
    }

    /**
     * GETTERS Y SETTERS PARA INGRESAR DATOS A LAS OTRAS TABLAS 
     */
    public function get_giro() {
        return $this->_giro;
    }

    public function set_giro($_giro) {
        $this->_giro = $_giro;
    }

    public function get_telefonoFijo() {
        return $this->_telefonoFijo;
    }

    public function set_telefonoFijo($_telefonoFijo) {
        $this->_telefonoFijo = $_telefonoFijo;
    }

    public function get_telefonoMobile() {
        return $this->_telefonoMobile;
    }

    public function set_telefonoMobile($_telefonoMobile) {
        $this->_telefonoMobile = $_telefonoMobile;
    }

    public function get_telefonoNextel() {
        return $this->_telefonoNextel;
    }

    public function set_telefonoNextel($_telefonoNextel) {
        $this->_telefonoNextel = $_telefonoNextel;
    }

    public function get_especialidad() {
        return $this->_especialidad;
    }

    public function set_especialidad($_especialidad) {
        $this->_especialidad = $_especialidad;
    }

    public function get_representate() {
        return $this->_representate;
    }

    public function set_representate($_representate) {
        $this->_representate = $_representate;
    }

    public function get_direccion() {
        return $this->_direccion;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }

    public function get_tipodireccion() {
        return $this->_tipodireccion;
    }

    public function set_tipodireccion($_tipodireccion) {
        $this->_tipodireccion = $_tipodireccion;
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


}