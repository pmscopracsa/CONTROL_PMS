<?php


class EditaCompania 
{
    /** Determina que se desea actualizar */
    protected $aActualizar;
    
    /** Tabla en la que haremos la consulta */
    protected $tabla;
    
    /** Clave primaria de la compania que se desea actualizar */
    protected $idCompania;
    
    /** Clave foranea de la empresa del cliente */
    protected $idEmpresa;
    
    /** Dato nuevo */
    protected $value;
    
    /** Llave foranea */
    protected $fk;
    
    /** Llave primaria */
    protected $id;
    
    public function actualizarObjetoCompania($cn)
    {
        try {
            switch ($this->aActualizar) {
                case 'tipocompania':
                    $query = "UPDATE tb_companiacontacto SET tb_tipocompania_id = $this->value WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en consulta edita tipo compania: ".  mysql_error());
                    break;
                case 'viaenvio':
                    $query = "UPDATE tb_companiacontacto SET tb_viaenvio_id = $this->value WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query,$cn);
                    if (!$rs)                        throw new Exception("Error en consulta: ".  mysql_error());
                    break;
                case 'ruc':
                    $query = "UPDATE tb_companiacontacto SET ruc = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query,$cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'nombre':
                    $query = "UPDATE tb_companiacontacto SET descripcion = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'nombrecomercial':
                    $query = "UPDATE tb_companiacontacto SET nombrecomercial = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                       throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'partidaregistral':
                    $query = "UPDATE tb_companiacontacto SET partidaregistral = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'giro_actualiza':
                    $query = "UPDATE tb_giro SET descripcion = '$this->value' WHERE id = $this->id AND tb_compania_id = $this->idCompania";
                    $rs = mysql_query($query,$cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'giro_elimina':
                    $query = "DELETE FROM tb_giro WHERE id = $this->id AND tb_compania_id = $this->idCompania";
                    $rs = mysql_query($query,$cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'actividadprincipal':
                    $query = "UPDATE tb_companiacontacto SET actividadprincipal = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tf_actualiza':
                    $query = "UPDATE tb_telefonofijocompania SET numero = '$this->value' WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tf_elimina':
                    $query = "DELETE FROM tb_telefonofijocompania WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tm_edita':
                    $query = "UPDATE tb_telefonomovilcompania SET numero = '$this->value' WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tm_elimina':
                    $query = "DELETE FROM tb_telefonomovilcompania WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tn_actualiza':
                    $query = "UPDATE tb_telefononextelcompania SET numero = '$this->value' WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'tn_elimina':
                    $query = "DELETE FROM tb_telefononextelcompania WHERE id = $this->id AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'fax_actualiza':
                    $query = "UPDATE tb_companiacontacto SET fax = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'viaenvio':
                    $query = "UPDATE tb_companiacontacto SET tb_viaenvio_id = $this->value WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                default:
                    break;
            }
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
     /** G & S*/
     public function getTabla() {
         return $this->tabla;
     }

     public function setTabla($tabla) {
         $this->tabla = $tabla;
     }
     
     public function getIdCompania() {
         return $this->idCompania;
     }

     public function setIdCompania($idCompania) {
         $this->idCompania = $idCompania;
     }

     public function getIdEmpresa() {
         return $this->idEmpresa;
     }

     public function setIdEmpresa($idEmpresa) {
         $this->idEmpresa = $idEmpresa;
     }

     public function getValue() {
         return $this->value;
     }

     public function setValue($value) {
         $this->value = $value;
     }
     
     public function getAActualizar() {
         return $this->aActualizar;
     }

     public function setAActualizar($aActualizar) {
         $this->aActualizar = $aActualizar;
     }
     
     public function getFk() {
         return $this->fk;
     }

     public function setFk($fk) {
         $this->fk = $fk;
     }

     public function getId() {
         return $this->id;
     }

     public function setId($id) {
         $this->id = $id;
     }
}