<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpcionesTop
 *
 * @author malcantara
 */
class OpcionesTop {
    private $_id;
    private $_descripcion;
    
    public function listarOpcionesTopTH($cn) {
        $query = "SELECT id,descripcion FROM tb_opcionestop";
        
        try {
            $rs = mysql_query($query,$cn);
            if (!$rs)
                throw new Exception("Error en la consulta");
            $opcionestop = array();
            $i = 0;
            while ($res = mysql_fetch_assoc($rs)) {
                $opcionestop[$i]['id'] = $res['id'];
                $opcionestop[$i]['descripcion'] = $res['descripcion'];
                $i++;
            }
            echo json_encode($opcionestop);
            
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
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

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }
}