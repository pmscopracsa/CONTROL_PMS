<?php

class EditaListaDistribucion_DL 
{
    protected $pk;
    protected $value;
    protected $aActualizar;
    
    public function actualizarLista($cn) {
        try {
            switch ($this->aActualizar) {
                case 'agregacontacto':
                    $sql = "INSERT INTO tb_listadistribucionpersonacontacto(tb_listadistribucioncontacto_id,tb_personacontacto_id) VALUES($this->pk,$this->value)";
                    $rs = mysql_query($sql, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'eliminacontacto':
                    $sql = "DELETE FROM tb_listadistribucionpersonacontacto WHERE tb_listadistribucioncontacto_id = $this->pk AND tb_personacontacto_id = $this->value";
                    $rs = mysql_query($sql, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;    
                case 'editarnombrelista':
                    $sql = "UPDATE tb_listadistribucioncontacto SET descripcion = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($sql, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'editaobs':
                    $sql = "UPDATE tb_listadistribucioncontacto SET observacion = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($sql, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                default:
                    break;
            }
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /** G&S */
    public function getPk() {
        return $this->pk;
    }

    public function setPk($pk) {
        $this->pk = $pk;
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
}

