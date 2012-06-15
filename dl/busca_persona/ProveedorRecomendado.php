<?php
require_once 'Conexion.php';
require_once 'Comun.php';

/**
 * @Descripcion:
 * Importa el contacto comun a.k.a páginas amarillas
 * a la lista de contacto de  la empresa que la estuvo visualizando
 * 
 * @Tablas:
 * 
 * Origen:
 * tb_especialidadComun
 * tb_contactocomun
 * tb_personacontactocomun
 * 
 * Destino:
 * tb_especialidadcompania
 * tb_companiacontacto
 * tb_personacontacto
 * 
 * tb_rubro
 */

class ProveedorRecomendado {
    protected $_id_empresa;
    protected $_id_persona;
    protected $_id_especialidad;
    
    public function __construct() {
    }
    
    /**
     * FUNCION QUE VERIFICA SI YA TENEMOS DENTRO DE NUESTROS CONTACTOS 
     * EL CONTACTO QUE DESEAMOS IMPORTAR 
     */
    public function verificaExistencia() {}
    
    public function importarContactoComun()
    {
        /**
         * CONECTAR A LA DDBB 
         */
        $conex = new Conexion();
        $cn = $conex->conectar();
        
        $respuesta = TRUE;
        
        mysql_query("BEGIN",$cn);
        try {
            /**
             * INSERTAMOS A LA TABLA TB_ESPECIALIDAD QUE REFERENCIA
             * LA ESPECIALIDAD 
             */
            $sql_especialidad = "INSERT INTO tb_especialidadcompania (
                descripcion) 
                SELECT 
                descripcion
                FROM tb_especialidadComun WHERE id=".$this->_id_especialidad;
            $tb_especialidad = mysql_query($sql_especialidad);
            if (!$tb_especialidad)
                throw new Exception("Error en insercion a tabla: tb_especialidad. Error: ".  mysql_error());

             /**
             * INSERTAMOS A LA TABLA TB_COMPANIACONTACTO QUE REFERENCIA
             * DE LA EMPRESA QUE ES NUESTRO CONTACTO. 
             */
            $a_cc = new Comun();
            $array_cc = array();
            $tabla_cc = "tb_contactocomun";
            $a_cc->set_nombreTabla($tabla_cc);
            $a_cc->set_id($this->_id_empresa);
            $array_cc = $a_cc->retornaTabla();
            $arraytmp_cc = array();
            
            while ($reg = mysql_fetch_array($array_cc,MYSQL_ASSOC)) {
                array_push($arraytmp_cc, $reg['descripcion']);
                array_push($arraytmp_cc, $reg['ruc']);
                array_push($arraytmp_cc, $reg['email']);
                array_push($arraytmp_cc, $reg['web']);
                array_push($arraytmp_cc, $reg['observacion']);
                array_push($arraytmp_cc, $reg['nombreComercial']);
                array_push($arraytmp_cc, $reg['fax']);
                array_push($arraytmp_cc, $reg['partidaregistral']);
                array_push($arraytmp_cc, $reg['giro']);
                array_push($arraytmp_cc, $reg['actividadprincipal']);
            }
            
            $sql_empresa = "INSERT INTO tb_companiacontacto (
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
                ,tb_empresa_id) 
                VALUES (
                NULL
                ,'$arraytmp_cc[0]'
                ,'$arraytmp_cc[1]'
                ,'$arraytmp_cc[5]'
                ,'$arraytmp_cc[7]'
                ,'$arraytmp_cc[8]'
                ,'$arraytmp_cc[9]'
                ,1
                ,'$arraytmp_cc[6]'
                ,'$arraytmp_cc[4]'
                ,'$arraytmp_cc[2]'    
                ,'$arraytmp_cc[3]'   
                ,3
                ,1    
                )";
            
            $tb_empresa = mysql_query($sql_empresa);
            if (!$tb_empresa)
                throw new Exception("Error en insercion a tabla: tb_companiacontacto. Error: ".  mysql_error());
            
            
            
            
            mysql_query("COMMIT");
            
            /**
             * LUEGO DEL COMMIT POQUE LOS VALORES AUN NO EXISTEN EN LA DDBB
             * ------------------------------------------------------------ 
             */
            
            /**
            * PARA OBTENER EL ULTIMO ID PARA TB_RUBRO
            */
            $tabla_empresa = "tb_companiacontacto";
            $tabla_especialidad = "tb_especialidadcompania";
            
            $id_empresa = 0;
            $id_especialidad = 0;
            
            $ultimoid = new Comun();
            
            $ultimoid->set_nombreTabla($tabla_empresa);
            $id_empresa = $ultimoid->obtenerUltimoId();
            
            $ultimoid->set_nombreTabla($tabla_especialidad);
            $id_especialidad = $ultimoid->obtenerUltimoId();
            
            /**
             * INSERTAMOS A LA TABLA TB_RUBRO QUE UNE A LAS
             * 2 TABLAS: tb_companiacontacto & tb_especialidadcompania 
             */
            $sql_rubro = "INSERT INTO tb_rubro (
                tb_companiacontacto_id
                ,tb_especialidadcompania_id) VALUES (
                $id_empresa
                ,$id_especialidad
                )";
            $tb_rubro = mysql_query($sql_rubro);
            $mysqli = new mysqli();
            $tb_rubro = $mysqli->query($sql_rubro);
            
            if (!$tb_rubro)
                throw new Exception("Error en la insercion a tabla: tb_rubro. Error: ". mysql_error());
            
            /**
             * PARA OBTENER EL UTLIMO ID PARA TB_PERSONACONTACTO
             * ------------------------------------------------- 
             */
            $tabla_personacontacto = "tb_companiacontacto";
            $ultimoid->set_nombreTabla($tabla_personacontacto);
            $id_personacontacto = $ultimoid->obtenerUltimoId();
            
            /**
             * INSERTAMOS A LA TABLA  TB_PERSONACONTACTO QUE SE REFERENCIA A LA
             * EMPRESA PREVIAMENTE INGRESA. 
             */
            $b_pc = new Comun();
            $tabla_pc = "tb_personacontactocomun";
            $b_pc->set_id($this->_id_persona);
            $b_pc->set_nombreTabla($tabla_pc);
            $array_pc = $b_pc->retornaTabla();
            $arraytmp_pc = array();
            
            while ($reg = mysql_fetch_array($array_pc,MYSQL_ASSOC)) {
                array_push($arraytmp_pc, $reg['nombres']);
                array_push($arraytmp_pc, $reg['correo']);
                array_push($arraytmp_pc, $reg['tb_contactocomun_id']);
                array_push($arraytmp_pc, $reg['dni']);
                array_push($arraytmp_pc, $reg['cargo']);
                array_push($arraytmp_pc, $reg['fax']);
                array_push($arraytmp_pc, $reg['observacion']);
                array_push($arraytmp_pc, $reg['web']);
            }
            
            $sql_persona = "INSERT INTO tb_personacontacto (
                id
                ,tb_empresa_id
                ,dni
                ,nombre
                ,cargo
                ,fax
                ,observacion
                ,email
                ,web
                ,tb_viaenvio_id
                ,tb_companiacontacto_id) 
                VALUES(
                NULL
                ,1
                ,'$arraytmp_pc[3]'
                ,'$arraytmp_pc[0]'
                ,'$arraytmp_pc[4]'
                ,'$arraytmp_pc[5]'
                ,'$arraytmp_pc[6]'
                ,'$arraytmp_pc[1]'
                ,'$arraytmp_pc[7]'
                ,3
                ,$id_personacontacto
                )";
            $tb_persona = mysql_query($sql_persona);
            if (!$tb_persona)
                throw new Exception("Error en insercion a tabla: tb_personacontacto. Error: ". mysql_errno());
            
        } catch (Exception $exc) {
            mysql_query("ROLLBACK");
            $respuesta = FALSE;
        }
        return $respuesta;
    }
    
    /**
     * Getters y Setters 
     */
    public function get_id_empresa() {
        return $this->_id_empresa;
    }

    public function set_id_empresa($_id_empresa) {
        $this->_id_empresa = $_id_empresa;
    }

    public function get_id_persona() {
        return $this->_id_persona;
    }

    public function set_id_persona($_id_persona) {
        $this->_id_persona = $_id_persona;
    }

    public function get_id_especialidad() {
        return $this->_id_especialidad;
    }

    public function set_id_especialidad($_id_especialidad) {
        $this->_id_especialidad = $_id_especialidad;
    }
}