<?php

class EditaPersona_DL 
{
    // DEFINIR CON QUE OBJETO SE VA A TRABAJAR
    protected $aActualizar;
    
    // VALOR A MANIPULAR
    protected $value;
    
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
}