<?php
include_once 'Conexion.php';
include_once 'Comun.php';

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
 * -=-=-=-=-=
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
     * dato en duro
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
        //$this->_idempresa = 1;
    }
    
    public function prueba() {
         for ($i = 0; $i < sizeof($this->_representate); $i++) {
                        $representante = $this->_representate[$i];
                        $query = "INSERT INTO tb_representante VALUES($ultimo_id,$representante)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_representante. Error: ".mysql_error());
                    }
    }
    
    public function i_RegistraCompania()
    {
        $conexion = new Conexion();
        $cn = $conexion->conectar();
        /**
         * INSERCION A TABLA: tb_companiacontacto 
         */
        mysql_query("BEGIN",$cn);
        try {
            $sql_tb_companiacontacto = "INSERT INTO tb_companiacontacto VALUES (
                NULL
                ,'$this->_descripcion'
                ,'$this->_ruc'
                ,'$this->_nombrecomercial'
                ,'$this->_partidaregistral'
                ,'$this->_actividadprincipal'
                ,$this->_tipocompania
                ,'$this->_fax'
                ,'$this->_observacion'
                ,'$this->_email'
                ,'$this->_web'
                ,$this->_viaenvio
                ,$this->_idempresa    
                )";
            $tb_companiacontacto = mysql_query($sql_tb_companiacontacto,$cn);
            
            if (!$tb_companiacontacto)
                throw new Exception('Error en insercion a tabla tb_companiacontacto. Error: '.  mysql_error());
           
            mysql_query("COMMIT",$cn);
            
            /**
             * OBTENIENDO EL ULTIMO ID INSERTADO 
             */
             $nombreTablaCompaniaContacto = "tb_companiacontacto";
             $comun = new Comun();
             $comun->set_nombreTabla($nombreTablaCompaniaContacto);
             $ultimo_id = $comun->obtenerUltimoId();
             
             try {
                     /**
                    * INSERCION A TABLA: tb_giro 
                    */
                    for ($i = 0; $i < sizeof($this->_giro); $i++) {
                        $giro = $this->_giro[$i];
                        $query = "INSERT INTO tb_giro VALUES(NULL,'$giro',$ultimo_id)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_giro. Error: ".mysql_error());
                    }

                    /**
                    * INSERCION A TABLA: tb_telefonofijocompania
                    */
                    for ($i = 0; $i <sizeof($this->_telefonoFijo); $i++) {
                        $telefono = $this->_telefonoFijo[$i];
                        $query = "INSERT INTO tb_telefonofijocompania VALUES(NULL,'$telefono',$ultimo_id)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_telefonofijocompania. Error: ".mysql_error());
                    }
                    
                    /**
                    * INSERCION A TABLA: tb_telefonomovilcompania
                    */
                    for ($i = 0; $i <sizeof($this->_telefonoMobile); $i++) {
                        $telefono = $this->_telefonoMobile[$i];
                        $query = "INSERT INTO tb_telefonomovilcompania VALUES(NULL,'$telefono',$ultimo_id)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_telefonomovilcompania. Error: ".mysql_error());
                    }

                    /**
                    * INSERCION A TABLA: tb_telefononextelcompania 
                    */
                    for ($i = 0; $i < sizeof($this->_telefonoNextel); $i++) {
                        $telefono = $this->_telefonoNextel[$i];
                        $query = "INSERT INTO tb_telefononextelcompania VALUES(NULL,'$telefono',$ultimo_id)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_telefononextelcompania. Error: ".mysql_error());
                    }

                    /**
                    * INSERCION A TABLA: tb_rubro
                    */
                    for ($i = 0; $i < sizeof($this->_especialidad); $i++) {
                        $especialidad = $this->_especialidad[$i];
                        $query = "INSERT INTO tb_rubro VALUES($ultimo_id,$especialidad)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_rubro. Error:".mysql_error());
                    }
                    
                     /**
                    *  INSERCION A TABLA: tb_representante
                    */
                    for ($i = 0; $i < sizeof($this->_representate); $i++) {
                        $representante = $this->_representate[$i];
                        $query = "INSERT INTO tb_representante VALUES($ultimo_id,$representante)";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_representante. Error:".mysql_error());
                    }

                    /**
                    * INSERCION A TABLA: tb_direccioncompaniacontacto
                    */
                    for ($i = 0; $i < $this->_cantdireccion; $i++) {
                        $direccion = $this->_direccion[$i];
                        $pais_id = $this->_pais[$i];
                        $departamento_id = $this->_departamento[$i];
                        $tipodireccion_id = $this->_tipodireccion[$i];
                        $distrito_id = $this->_distrito[$i];
                        $query = "INSERT INTO tb_direccioncompaniacontacto VALUES (
                            NULL
                            ,'$direccion'
                            ,$pais_id
                            ,$departamento_id
                            ,$ultimo_id
                            ,$tipodireccion_id
                            ,$distrito_id
                            )";
                        $res = mysql_query($query,$cn);
                        if (!$res)
                            throw new Exception("tb_direccioncompaniacontacto. Error: ".mysql_error());
                    }
                    mysql_query("COMMIT",$cn);
             } catch (Exception $ex1) {
                 mysql_query("ROLLBACK",$cn);
                 echo "Error en tabla ".$ex1->getMessage()."<br>";
                 $query = "DELETE FROM tb_companiacontacto WHERE id = $ultimo_id";
                 /*
                  * missing DEL implementation
                  */
             }
        } catch (Exception $exc) {
            mysql_query("ROLLBACK",$cn);
            echo $exc->getMessage()."<br>";
        }
    }
    
    public function u_RegistraCompania()
    {
        
    }
    
    public function d_RegistraCompania()
    {
        
    }
    
    public function s_buscaCompaniaPorRuc()
    {
        $query = "SELECT DISTINCT
        cc.id id
        ,cc.ruc ruc
        ,cc.descripcion descripcion
        ,cc.nombrecomercial nombrecomercial
        ,cc.partidaregistral partidaregistral
        ,cc.actividadprincipal actividadprincipal
        ,cc.fax fax
        ,cc.observacion observacion
        ,cc.email email
        ,cc.web web
        ,e.nombre nombre
        FROM tb_empresa e
        INNER JOIN tb_companiacontacto cc ON e.id = cc.tb_empresa_id
        INNER JOIN tb_usuario u ON u.tb_empresa_id = e.id
        WHERE cc.ruc = $this->_ruc AND cc.tb_empresa_id = $this->_idempresa";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $sql = mysql_query($query, $cn);
            
            if (!$sql)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            $companiadatos = array();

            while ($res = mysql_fetch_array($sql,MYSQL_ASSOC)) {
                array_push($companiadatos,$res['id']);
                array_push($companiadatos,$res['ruc'] == NULL ? "" : $res['ruc']);
                array_push($companiadatos,$res['descripcion'] == NULL ? "" : $res['descripcion']);
                array_push($companiadatos,$res['nombrecomercial'] == NULL ? "" : $res['nombrecomercial']);
                array_push($companiadatos,$res['partidaregistral'] == NULL ? "" : $res['partidaregistral']);
                array_push($companiadatos,$res['actividadprincipal'] == NULL ? "" : $res['actividadprincipal']);
                array_push($companiadatos,$res['fax'] == NULL ? "" : $res['fax']);
                array_push($companiadatos,$res['observacion'] == NULL ? "" : $res['observacion']);
                array_push($companiadatos,$res['email'] == NULL ? "" : $res['email']);
                array_push($companiadatos,$res['web'] == NULL ? "" : $res['web']);
            }
            return $companiadatos;
            
        } catch (Exception $e) {
            echo "Error al consultar compania por ruc. Error: ".$e->getMessage();
        }
    }
    
    public function s_buscarCompaniaPorNombre()
    {
        $query = "SELECT DISTINCT
        cc.id
        ,cc.ruc
        ,cc.descripcion
        ,cc.nombrecomercial
        ,cc.partidaregistral
        ,cc.actividadprincipal
        ,cc.fax
        ,cc.observacion
        ,cc.email
        ,cc.web
        ,e.nombre
        FROM tb_empresa e
        INNER JOIN tb_companiacontacto cc ON e.id = cc.tb_empresa_id
        INNER JOIN tb_usuario u ON u.tb_empresa_id = e.id
        WHERE cc.descripcion = '$this->_descripcion' AND cc.tb_empresa_id = $this->_idempresa";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn) 
                throw new Exception("Error al conectar: ".mysql_error ());
            
            $sql = mysql_query($query,$cn);
            
            if (!$sql)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            $companiadatos = array();

            while ($res = mysql_fetch_array($sql,MYSQL_ASSOC)) {
                array_push($companiadatos,$res['id']);
                array_push($companiadatos,$res['ruc'] == NULL ? "" : $res['ruc']);
                array_push($companiadatos,$res['descripcion'] == NULL ? "" : $res['descripcion']);
                array_push($companiadatos,$res['nombrecomercial'] == NULL ? "" : $res['nombrecomercial']);
                array_push($companiadatos,$res['partidaregistral'] == NULL ? "" : $res['partidaregistral']);
                array_push($companiadatos,$res['actividadprincipal'] == NULL ? "" : $res['actividadprincipal']);
                array_push($companiadatos,$res['fax'] == NULL ? "" : $res['fax']);
                array_push($companiadatos,$res['observacion'] == NULL ? "" : $res['observacion']);
                array_push($companiadatos,$res['email'] == NULL ? "" : $res['email']);
                array_push($companiadatos,$res['web'] == NULL ? "" : $res['web']);
            }
            
            return $companiadatos;
            
        } catch (Exception $e) {
            echo "Error al consultar compania por nombre. Error: ".$e->getMessage();
        }
    }        
    
    public function s_buscaCompanias()
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