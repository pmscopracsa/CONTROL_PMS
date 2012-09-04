<?php

class EditaPersona_DL 
{
    // DEFINIR CON QUE OBJETO SE VA A TRABAJAR
    protected $aActualizar;
    
    // VALOR A MANIPULAR
    protected $value;
    
    // VALOR ID DEL VALUE
    protected $idvalue;
    
    // LLAVE PRINCIPAL
    protected $pk;
    
    public function actualizarPersona($cn)
    {
        try{
            switch ($this->aActualizar) {
                case 'editaNumDoc':
                    $query = "UPDATE tb_personacontacto SET dni = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'editaNombres':
                    $query = "UPDATE tb_personacontacto SET nombre = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;    
                case 'editaCompania':
                    $query = "UPDATE tb_personacontacto SET tb_companiacontacto_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'editaCargo':
                    $query = "UPDATE tb_personacontacto SET cargo = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'tf_actualiza':
                    $query = "UPDATE tb_telefonofijopersona SET numero = '$this->value' WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'tf_elimina':
                    $query = "DELETE FROM tb_telefonofijopersona WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                case 'tf_nuevo':
                    $query = "INSERT INTO  tb_telefonofijopersona (id,numero,tb_personacontacto_id) VALUES(NULL,'$this->value',$this->pk)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'tm_actualiza':
                    $query = "UPDATE tb_telefonomovilpersona SET numero = '$this->value' WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                default:
                    break;
            }
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    // G& S
    public function getAActualizar() {
        return $this->aActualizar;
    }

    public function setAActualizar($aActualizar) {
        $this->aActualizar = $aActualizar;
    }
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }
    
    public function getPk() {
        return $this->pk;
    }

    public function setPk($pk) {
        $this->pk = $pk;
    }
    
    public function getIdvalue() {
        return $this->idvalue;
    }

    public function setIdvalue($idvalue) {
        $this->idvalue = $idvalue;
    }
}