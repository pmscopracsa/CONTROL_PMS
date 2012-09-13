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
                case 'pptoventa':
                    $query = "UPDATE tb_obra SET $this->column = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
                case 'nuevocontacto':
                    $query = "INSERT INTO tb_contacto (tb_personacontacto_id,tb_obra_id) VALUES($this->value,$this->pk)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;
                case 'existecontacto_tb_firma':
                    $query = "SELECT COUNT(*) FROM tb_firma WHERE idcontacto = $this->value AND idobra = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    $rows_ = mysql_result($rs,0,0);
                    echo $rows_;
                    break;
                case 'eliminacontacto':
                    $query = "DELETE FROM tb_contacto WHERE tb_personacontacto_id = $this->value AND tb_obra_id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;  
                case 'existecontactopuesto_tb_contactoreporte':
                    $query = "SELECT COUNT(*) FROM tb_contactoreporte WHERE tb_personacontacto_id = $this->value AND tb_obra_id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    $rows_ = mysql_result($rs,0,0);
                    echo $rows_;
                    break;    
                case 'eliminacontactopuesto':
                    $query = "DELETE FROM tb_firma WHERE idcontacto = $this->value AND idobra = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break; 
                case 'agregarcontactopuesto':
                    $query = "INSERT INTO tb_firma (idcontacto,idobra,posicion) VALUES($this->fk,$this->pk,'$this->value')";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;  
                case 'empatacontactoreporte':
                    $query = "INSERT INTO tb_contactoreporte (tb_personacontacto_id,tb_reporte_id,tb_obra_id) VALUES($this->fk,$this->value,$this->pk)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error al consultar: ".  mysql_error());
                    break;    
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