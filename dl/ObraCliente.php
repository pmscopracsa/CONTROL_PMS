<?php
require_once 'Conexion.php';

class ObraCliente {
    private $_id;
    private $_codigoobra;
    private $_descripcion;
    private $_tb_directorio_id;
    private $_tb_empresa_id;
    
    /**
     * CARGAS 
     */
    public function cargarObras() {
        //$query = "SELECT id,descripcion FROM tb_obra WHERE tb_directorio = $this->_tb_directorio_id";
        $query = "SELECT id,descripcion FROM tb_obra";
        
        try {
            $cone = new Conexion();
            $cn = $cone->conectar();
            
            if (!$cn)
                throw new Exception("Error de conexion: ".  mysql_error());
            
            $rs = mysql_query($query);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            if (@mysql_num_rows($rs) > 0) {
                $obras = array();
                
                while ($obra = mysql_fetch_assoc($rs)) {
                    $id = $obra['id'];
                    $descripcion = $obra['descripcion'];
                    $obras[$id] = $descripcion;
                }
                return $obras;
            } else {
                return FALSE;
            }
        
        } catch (Exception $ex) {
            echo 'Error:'.$ex->getMessage();
        }
    }
    
    /**
     * CREAR OBRA SOLO CON: CODIFICACION y DESCRIPCION
     * LUEGO PODRA SER ACTUALIZADA
     * @param type $cn 
     */
    public function crearObraMinimo($cn) {
        $query = "INSERT INTO tb_obra (id, codigoobra, descripcion, tb_directorio_id, tb_empresa_id) VALUES (
            NULL
            ,'$this->_codigoobra'
            ,'$this->_descripcion'
            ,$this->_tb_directorio_id    
            ,$this->_tb_empresa_id)";
        
        try {
            $rs = mysql_query($query,$cn);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());   
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /**
     *funcion para la edicion por el administrador de la empresa 
     */
    public function listarProyectos($cn) {
        //$query = "SELECT id,codigoobra,descripcion FROM tb_obra WHERE tb_empresa_id = $this->_tb_empresa_id";
        $query = "SELECT 
        o.id idproyecto
        ,o.codigoobra codigoproyecto
        ,o.descripcion proyecto
        ,d.descripcion directorio
        FROM 
        tb_directorio d INNER JOIN tb_obra o ON d.id = o.tb_directorio_id
        WHERE o.tb_empresa_id = $this->_tb_empresa_id";
        
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $proyectos = array();
            
            while ($reg = mysql_fetch_array($rs)) {
                array_push($proyectos, $reg);
            }
            return $proyectos;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function actualizarProyecto($cn) {
        $query = "UPDATE tb_obra SET codigoobra = '$this->_codigoobra', descripcion = '$this->_descripcion' WHERE id = $this->_id";
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error()); 
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function mostrarDatosBasicos($cn) {
        $query = "SELECT codigoobra, descripcion FROM tb_obra WHERE id = $this->_id";
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $obra_data = array();
            while ($obra = mysql_fetch_assoc($rs)) {
                $codigo = $obra['codigoobra'];
                $descripcion = $obra['descripcion'];
                $obra_data[$codigo] = $descripcion;
            }
            return $obra_data;
            
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /** MUESTRA DATOS DE LA TABLA tb_obra */
    public function s_buscarObraPorId() 
    {
        $query = "SELECT
            o.id
            ,o.codigoobra
            ,o.descripcion
            ,o.fechainicio
            ,o.fechafin
            ,o.direccion
            ,cc_cliente.id idcliente
            ,cc_cliente.descripcion nombrecliente
            ,cc_empcontratante.id idempcontratante
            ,cc_empcontratante.descripcion nombrecontratante
            ,cc_empgerenteproyecto.id idgerente
            ,cc_empgerenteproyecto.descripcion nombregerente
            ,cc_empsupervproyecto.id idsupervisor
            ,cc_empsupervproyecto.descripcion nombresupervisor
            ,cc_proveedorfacturar.id idafacturar
            ,cc_proveedorfacturar.descripcion nombreafacturar
            ,o.porcentajecartafianza
            ,o.diasdesembolso
            ,o.porcentajefondoretencion
            ,o.diasdevolucionfondoretencion
            ,o.montocontratadomayora
            ,o.montocontratadomenora
            ,o.cartaadjudicacion
            ,o.modelocontrato
            ,o.factorcorreccion
            ,o.retencionfondogarantia
            ,o.retencionfielcumplimiento
            ,o.gastogeneral_precontra
            ,o.utilidad_precontra
            ,o.gastogeneral_ordcamb
            ,o.utilidad_ordcamb
            FROM tb_obra o 
            INNER JOIN tb_companiacontacto cc_cliente ON o.cliente_id = cc_cliente.id 
            INNER JOIN tb_companiacontacto cc_empcontratante ON o.empresacontratante_id = cc_empcontratante.id
            INNER JOIN tb_companiacontacto cc_empgerenteproyecto ON o.empresacontratante_id = cc_empgerenteproyecto.id
            INNER JOIN tb_companiacontacto cc_empsupervproyecto ON o.supervisoraproyecto_id = cc_empsupervproyecto.id
            INNER JOIN tb_companiacontacto cc_proveedorfacturar ON o.proveedoresfacturar_id = cc_proveedorfacturar.id
            WHERE o.id = $this->_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error en la conexion()()(): ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $datos = array();
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($datos, $res['id']);
                array_push($datos, $res['codigoobra']);
                array_push($datos, $res['descripcion']);
                array_push($datos, $res['fechainicio']);
                array_push($datos, $res['fechafin']);
                array_push($datos, $res['direccion']);
                array_push($datos, $res['idcliente']);
                array_push($datos, $res['nombrecliente']);
                array_push($datos, $res['idempcontratante']);
                array_push($datos, $res['nombrecontratante']);
                array_push($datos, $res['idgerente']);
                array_push($datos, $res['nombregerente']);
                array_push($datos, $res['idsupervisor']);
                array_push($datos, $res['nombresupervisor']);
                array_push($datos, $res['idafacturar']);
                array_push($datos, $res['nombreafacturar']);
                array_push($datos, $res['porcentajecartafianza']);
                array_push($datos, $res['diasdesembolso']);
                array_push($datos, $res['porcentajefondoretencion']);
                array_push($datos, $res['diasdevolucionfondoretencion']);
                array_push($datos, $res['montocontratadomayora']);
                array_push($datos, $res['montocontratadomenora']);
                array_push($datos, $res['cartaadjudicacion']);
                array_push($datos, $res['modelocontrato']);
                array_push($datos, $res['factorcorreccion']);
                array_push($datos, $res['retencionfondogarantia']);
                array_push($datos, $res['retencionfielcumplimiento']);
                array_push($datos, $res['gastogeneral_precontra']);
                array_push($datos, $res['utilidad_precontra']);
                array_push($datos, $res['gastogeneral_ordcamb']);
                array_push($datos, $res['utilidad_ordcamb']);
            }
            return $datos;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /**
     * G&S 
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

    public function get_tb_directorio_id() {
        return $this->_tb_directorio_id;
    }

    public function set_tb_directorio_id($_tb_directorio_id) {
        $this->_tb_directorio_id = $_tb_directorio_id;
    }
    
    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }
}