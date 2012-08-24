<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Especialidad
 *
 * @author malcantara
 */
class Especialidad {
    public function obtenerEspecialidadesPorCompania() {
        $query = "SELECT cc.descripcion, ec.descripcion
FROM tb_rubro r
INNER JOIN tb_companiacontacto cc ON cc.id = r.tb_companiacontacto_id 
INNER JOIN tb_especialidadcompania ec ON ec.id = r.tb_companiacontacto_id";
    }
}

?>
