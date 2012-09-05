<?php

class EditaListaDistribucion_DL 
{
    protected $pk;
    protected $value;
    protected $aActualizar;
    
    public function actualizarLista($cn) {
        try {
            switch ($this->aActualizar) {
                case 'getidlista':
                    $sql = "SELECT id FROM control_pms.tb_listadistribucioncontacto WHERE descripcion = '$this->value'";
                    $rs = mysql_query($sql, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    $lista = array();$i=0;
                    while($row = mysql_fetch_assoc($rs)){
                        $lista[$i]['id']=$row['id'];$i++;
                    }
                    echo json_encode($lista);
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

