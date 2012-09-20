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
    
    // DIRECCION
    protected $idpais;
    protected $iddepartamento;
    protected $iddistrito;
    
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
                case 'tm_actualiza':/*MOBILE*/
                    $query = "UPDATE tb_telefonomovilpersona SET numero = '$this->value' WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;  
                case 'tm_elimina':
                    $query = "DELETE FROM tb_telefonomovilpersona WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;    
                case 'tm_nuevo':
                    $query = "INSERT INTO  tb_telefonomovilpersona (id,numero,tb_personacontacto_id) VALUES(NULL,'$this->value',$this->pk)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;   
                case 'tn_actualiza':
                    $query = "UPDATE tb_telefononextelpersona SET numero = '$this->value' WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'tn_elimina':
                    $query = "DELETE FROM tb_telefononextelpersona WHERE id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'tn_nuevo':
                    $query = "INSERT INTO  tb_telefononextelpersona (id,numero,tb_personacontacto_id) VALUES(NULL,'$this->value',$this->pk)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                case 'actualizadireccion'    :  /* DIRECCION */  
                    $query = "UPDATE tb_personacontacto 
                        SET direccion = '$this->value'
                        ,tb_pais_id = $this->idpais
                        ,tb_departamento_id = $this->iddepartamento
                        ,tb_distrito_id = $this->iddistrito    
                        WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;      
                case 'editaEspecialidad': /* ESPECIALIDAD */
                    $query = "UPDATE tb_profesion SET tb_especialidadpersona_id = $this->idvalue WHERE tb_personacontacto_id = $this->pk AND tb_especialidadpersona_id = $this->value";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                case 'eliminarEspecialidad':
                    $query = "DELETE FROM tb_profesion WHERE tb_personacontacto_id = $this->pk AND tb_especialidadpersona_id = $this->idvalue";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;   
                case 'nuevaEspecialidad':
                    $query = "INSERT INTO tb_profesion(tb_personacontacto_id,tb_especialidadpersona_id) VALUES($this->pk,$this->idvalue)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                case 'editaObservacion':
                    $query = "UPDATE tb_personacontacto SET observacion = '$this->value' WHERE id $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;  
                case 'editEmail':
                    $query = "UPDATE tb_personacontacto SET email = '$this->value' WHERE id $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break; 
                case 'eliminaEmailSecundario':
                    $query = "DELETE FROM tb_correosecundarios WHERE id = $this->value AND tb_personacontacto_id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;      
                case 'guardarEmailSecundario':
                    $query = "INSERT INTO tb_correosecundarios (id,descripcion,tb_personacontacto_id) VALUES(NULL,'$this->value',$this->pk) ";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;  
                case 'editarWeb':
                    $query = "UPDATE tb_personacontacto SET web = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;    
                case 'editarFax':
                    $query = "UPDATE tb_personacontacto SET fax = '$this->value' WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;  
                case 'editarViaEnvio':
                    $query = "UPDATE tb_personacontacto SET tb_viaenvio_id = $this->value WHERE id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;     
                case 'deldirecciontrabajo':
                    $query = "DELETE FROM tb_direccionpersonalaboral WHERE tb_direccioncompaniacontacto_id = $this->value AND tb_personacontacto_id = $this->pk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;
                case 'addWorkAddress':
                    $query = "INSERT INTO tb_direccionpersonalaboral (tb_personacontacto_id,tb_direccioncompaniacontacto_id) VALUES($this->pk,$this->value)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta: ".  mysql_error());
                    break;   
                case 'delworkdirec':
                    $query = "DELETE FROM tb_direccionpersonalaboral WHERE tb_personacontacto_id = $this->value AND tb_direccioncompaniacontacto_id = $this->pk";
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
    
    public function getIdpais() {
        return $this->idpais;
    }

    public function setIdpais($idpais) {
        $this->idpais = $idpais;
    }

    public function getIddepartamento() {
        return $this->iddepartamento;
    }

    public function setIddepartamento($iddepartamento) {
        $this->iddepartamento = $iddepartamento;
    }

    public function getIddistrito() {
        return $this->iddistrito;
    }

    public function setIddistrito($iddistrito) {
        $this->iddistrito = $iddistrito;
    }
}