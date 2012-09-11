<?php
class EditaObra_DL 
{
    protected $aActualizar;
    protected $pk;
    protected $value;
    protected $fk;
    protected $column;
    
    public function actualizaObra($cn)
    {
        try {
            switch ($this->aActualizar) {
                case 'editadireccion':
                    $query = "UPDATE tb_obra SET direccion = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'editacliente':
                    $query = "UPDATE tb_obra SET cliente_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'editacontratante':
                    $query = "UPDATE tb_obra SET empresacontratante_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editagerente':
                    $query = "UPDATE tb_obra SET gerenteproyecto_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'editasupervisora':
                    $query = "UPDATE tb_obra SET supervisoraproyecto_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editaproveedor':
                    $query = "UPDATE tb_obra SET proveedoresfacturar_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'editacartafianza':
                    $query = "UPDATE tb_obra SET porcentajecartafianza = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;   
                case 'editadiashabiles':
                    $query = "UPDATE tb_obra SET diasdesembolso = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;  
                case 'editafondoretencion':
                    $query = "UPDATE tb_obra SET porcentajefondoretencion = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;     
                case 'editadiasdevolucion':
                    $query = "UPDATE tb_obra SET diasdevolucionfondoretencion = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editadepartamento':
                    $query = "UPDATE tb_obra SET tb_departamento_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editamoneda':
                    $query = "UPDATE tb_obra SET tb_moneda_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'editatipoval':
                    $query = "UPDATE tb_obra SET tb_tipovalorizacion_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editaformato':
                    $query = "UPDATE tb_obra SET tb_formatopresupuesto_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'editaFactor':
                    $query = "UPDATE tb_obra SET $this->column = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                default:    
                default:
                    break;
            }
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
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

    public function getFk() {
        return $this->fk;
    }

    public function setFk($fk) {
        $this->fk = $fk;
    }
    
    public function getAActualizar() {
        return $this->aActualizar;
    }

    public function setAActualizar($aActualizar) {
        $this->aActualizar = $aActualizar;
    }
    
    public function getColumn() {
        return $this->column;
    }

    public function setColumn($column) {
        $this->column = $column;
    }
}