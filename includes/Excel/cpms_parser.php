<?php
require_once 'reader.php';
require_once '../../dl/Conexion.php';

class cpms_parser 
{
    private $_xls_file;
    private $_path_xls_files = "../../archivos_excel/";
    private $_empresa_id;
    private $_directorio_id;
    private $_obra_id;
    private $_seccion_id;
    private $_fase_id;

    public function dump_xls_to_db()
    {
        $obra_id = 2;
        /**
         * AMBAS VARIABLES GUARDAN EL ULTIMO ID INGRESADO 
         */
        $last_seccion = 0;
        $last_fase = 0;
        
        $excel = new Spreadsheet_Excel_Reader();
        $excel->setOutputEncoding('CP1251');
        
        /**
         * LA CLASE EXCEL LEE EL ARCHIVO 
         */
        $excel->read($this->_path_xls_files.$this->_xls_file);
        
        try {
            $cnn = new Conexion();
            $cn = $cnn->conectar();
            
            if (!$cn)
                throw new Exception("Error conexion: ".  mysql_error());
            
            for ($index = 1; $index < $excel->sheets[0]['numRows'];$index++) 
            {
                for ($index1 = 1; $index1 < $excel->sheets[0]['numCols']; $index1++) {
                    // SECCIONES
                    if ($index1 == 1 && ($excel->sheets[0]['cells'][$index][$index1] == "1"))   {
                        $query_seccion = "INSERT INTO tb_seccionventa(id,codificacion,descripcion,tb_obra_id,total)VALUES (
                            NULL
                            ,'".$excel->sheets[0]['cells'][$index][2]."'
                            ,'".$excel->sheets[0]['cells'][$index][3]."'
                            ,".$obra_id.
                            ",".$excel->sheets[0]['cells'][$index][8].")";
                        $rs = mysql_query($query_seccion,$cn);
                        if (!$rs)                            throw new Exception("Error (SECCIONES): ".  mysql_error());
                        $last_seccion = mysql_insert_id($cn);
                    }
                    // FASES
                    if ($index1 == 1 && ($excel->sheets[0]['cells'][$index][$index1] == "2")) {
                        $query_fase = "INSERT INTO tb_faseventa(id,codificacion,descripcion,tb_seccionventa_id,total) VALUES(
                            NULL
                            ,'".$excel->sheets[0]['cells'][$index][2]."'
                            ,'".$excel->sheets[0]['cells'][$index][3]."'
                            ,".$last_seccion.
                            ",".$excel->sheets[0]['cells'][$index][8].")"; 
                        $rs = mysql_query($query_fase, $cn);
                        if (!$rs)                            throw new Exception("Error (FASES): ".  mysql_error());
                        $last_fase = mysql_insert_id($cn);
                    }
                    // PARTIDA
                    if ($index1 == 1 && ($excel->sheets[0]['cells'][$index][$index1] == "3")) {
                        $query_partida = "INSERT INTO tb_partidaventa(id,codificacion,descripcion,unidadmedida,metrado,precio,parcial,tb_faseventa_id) VALUES(
                            NULL
                            ,'".$excel->sheets[0]['cells'][$index][2]."'
                            ,'".$excel->sheets[0]['cells'][$index][3]."'
                            ,'".$excel->sheets[0]['cells'][$index][4]."'
                            ,".$excel->sheets[0]['cells'][$index][5]."
                            ,".$excel->sheets[0]['cells'][$index][6]."
                            ,".$excel->sheets[0]['cells'][$index][5]*$excel->sheets[0]['cells'][$index][6]."
                            ,".$last_fase.")";
                        $rs = mysql_query($query_partida,$cn);
                        if (!$rs)                            throw new Exception("Error (PARTIDA): ".  mysql_error());
                    }
                }
            }
            unlink($this->_path_xls_files.$this->_xls_file);
        } catch (Exception $ex) {
            throw new Exception("Error: ".$ex->getMessage());
        }
    }
    
    public function obtenerXLS()
    {
        $sql = "";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($sql,$cn);
            if (!$rs)                throw new Exception("Error en consulta: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    public function obtenerSeccion()
    {
        $sql = "SELECT 
                sv.codificacion codificacion
                ,sv.descripcion descripcion
                ,sv.tb_obra_id tb_obra_id
                FROM tb_empresa e
                INNER JOIN tb_directorio d ON e.id = d.tb_empresa_id
                INNER JOIN tb_obra o ON d.id = tb_directorio_id
                INNER JOIN tb_seccionventa sv ON o.id = sv.tb_obra_id
                WHERE e.id = $this->_empresa_id AND d.id = $this->_directorio_id AND o.id = $this->_obra_id";
       
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($sql,$cn);
            if (!$rs)                throw new Exception("Error en consulta: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    public function obtenerFase()
    {
        $sql = "SELECT 
                fv.id
                ,fv.codificacion
                ,fv.descripcion
                ,tb_seccion_venta_id
                FROM tb_seccionventa sv
                INNER JOIN tb_faseventa fv ON sv.id = fv.tb_seccionventa_id
                WHERE sv.id = $this->_seccion_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($sql,$cn);
            if (!$rs)                throw new Exception("Error en consulta: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    public function obtenerPartida()
    {
        $sql = "SELECT 
                pv.id
                ,pv.codificacion
                ,pv.descripcion
                ,pv.unidadmedida
                ,pv.metrado
                ,pv.precio
                ,pv.parcial
                ,pv.tb_faseventa_id
                FROM tb_faseventa fv
                INNER JOIN tb_partidaventa pv ON fv.id = pv.tb_faseventa_id
                WHERE fv.id = $this->_fase_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)                throw new Exception("Error al conectar: ".  mysql_error());
            $rs = mysql_query($sql,$cn);
            if (!$rs)                throw new Exception("Error en consulta: ".  mysql_error());
            
            
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    /**
     * G&S 
     */
    public function get_xls_file() {
        return $this->_xls_file;
    }

    public function set_xls_file($_xls_file) {
        $this->_xls_file = $_xls_file;
    }

    public function get_path_xls_files() {
        return $this->_path_xls_files;
    }
    
    public function get_empresa_id() {
        return $this->_empresa_id;
    }

    public function set_empresa_id($_empresa_id) {
        $this->_empresa_id = $_empresa_id;
    }

    public function get_directorio_id() {
        return $this->_directorio_id;
    }

    public function set_directorio_id($_directorio_id) {
        $this->_directorio_id = $_directorio_id;
    }

    public function get_obra_id() {
        return $this->_obra_id;
    }

    public function set_obra_id($_obra_id) {
        $this->_obra_id = $_obra_id;
    }
    
    public function get_seccion_id() {
        return $this->_seccion_id;
    }

    public function set_seccion_id($_seccion_id) {
        $this->_seccion_id = $_seccion_id;
    }
    
    public function get_fase_id() {
        return $this->_fase_id;
    }

    public function set_fase_id($_fase_id) {
        $this->_fase_id = $_fase_id;
    }
}