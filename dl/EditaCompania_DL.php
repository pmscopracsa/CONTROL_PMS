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
    
    /** Para la direcccion */
    protected $idpais;
    protected $iddepartamento;
    protected $iddistrito;
    protected $idtipodireccion;
    
    /** parace en el contrato */
    protected $contrato;
    
    
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
                    if (!$rs)                        throw new Exception("Error en la consulta via envio: ".  mysql_error());
                    break;
                case 'especialidad_actualiza':
                    $query = "UPDATE tb_rubro SET tb_especialidadcompania_id = $this->value WHERE tb_companiacontacto_id = $this->idCompania AND tb_especialidadcompania_id = $this->fk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'especialidad_elimina':
                    $query = "DELETE FROM tb_rubro WHERE tb_companiacontacto_id = $this->idCompania AND tb_especialidadcompania_id = $this->value";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_elimina: ".  mysql_error());
                    break;
                case 'representante_actualiza':
                    $query = "UPDATE tb_representante SET tb_personacontacto_id = $this->value WHERE tb_companiacontacto_id = $this->idCompania AND tb_personacontacto_id = $this->fk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'giro_nuevo' :
                    $query = "INSERT INTO tb_giro(id,descripcion,tb_compania_id)VALUES(NULL,'$this->value',$this->idCompania)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'tf_nuevo' :
                    $query = "INSERT INTO tb_telefonofijocompania(id,numero,tb_companiacontacto_id)VALUES(NULL,'$this->value',$this->idCompania)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'tm_nuevo' :    
                    $query = "INSERT INTO tb_telefonomovilcompania(id,numero,tb_companiacontacto_id)VALUES(NULL,'$this->value',$this->idCompania)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'tn_nuevo' :
                    $query = "INSERT INTO tb_telefononextelcompania(id,numero,tb_companiacontacto_id)VALUES(NULL,'$this->value',$this->idCompania)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'especialidad_nuevo' :
                    $query = "INSERT INTO tb_rubro(tb_companiacontacto_id,tb_especialidadcompania_id)VALUES($this->idCompania,$this->value)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;
                case 'representante_nuevo' :
                    $query = "INSERT INTO tb_representante(tb_companiacontacto_id,tb_personacontacto_id)VALUES($this->idCompania,$this->value)";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;    
                case 'editar_observacion' :    
                    $query = "UPDATE tb_companiacontacto SET observacion = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;    
                case 'editar_email'  :    
                    $query = "UPDATE tb_companiacontacto SET email = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;      
                case 'editar_web'    :    
                    $query = "UPDATE tb_companiacontacto SET web = '$this->value' WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;      
                case 'representante_elimina'    :    
                    $query = "DELETE FROM tb_representante WHERE tb_companiacontacto_id = $this->idCompania AND tb_personacontacto_id = $this->value";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break; 
                case 'nuevadireccion'    :    
                    $query = "INSERT INTO tb_direccioncompaniacontacto (
                        id,direccion,tb_pais_id,tb_departamento_id,tb_companiacontacto_id,tb_tipodireccion_id,tb_distrito_id) VALUES
                        (NULL
                        ,'$this->value'
                        ,$this->idpais
                        ,$this->iddepartamento
                        ,$this->idCompania
                        ,$this->idtipodireccion
                        ,$this->iddistrito    
                        )";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break; 
                case 'actualizadireccion'    :    
                    $query = "UPDATE tb_direccioncompaniacontacto 
                        SET direccion = '$this->value'
                        ,tb_pais_id = $this->idpais
                        ,tb_departamento_id = $this->iddepartamento
                        ,tb_tipodireccion_id = $this->idtipodireccion
                        ,tb_distrito_id = $this->iddistrito
                        ,inthecontract = '$this->contrato'    
                        WHERE tb_companiacontacto_id = $this->idCompania AND id = $this->id";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;   
                case 'eliminadireccion'    :    
                    $query = "DELETE FROM tb_direccioncompaniacontacto WHERE id = $this->value AND tb_companiacontacto_id = $this->idCompania";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;     
                case 'inthecontract'    :   
                    $query = "UPDATE tb_representante SET inthecontract = 'checked' WHERE tb_companiacontacto_id = $this->idCompania  AND tb_personacontacto_id = $this->fk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;    
                case 'notinthecontract'    :   
                    $query = "UPDATE tb_representante SET inthecontract = '' WHERE tb_companiacontacto_id = $this->idCompania  AND tb_personacontacto_id = $this->fk";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en la consulta especialidad_actualiza: ".  mysql_error());
                    break;    
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

     public function getIdtipodireccion() {
         return $this->idtipodireccion;
     }

     public function setIdtipodireccion($idtipodireccion) {
         $this->idtipodireccion = $idtipodireccion;
     }
     
     public function getContrato() {
         return $this->contrato;
     }

     public function setContrato($contrato) {
         $this->contrato = $contrato;
     }
}