<?php


class EditaCompania 
{
    /** Tabla en la que haremos la consulta */
    protected $tabla;
    
    /** Clave primaria de la compania que se desea actualizar */
    protected $idCompania;
    
    /** Clave foranea de la empresa del cliente */
    protected $idEmpresa;
    
    /** Dato nuevo */
    protected $value;
    
    public function actualizarObjetoCompania($cn)
    {
        try {
            switch ($this->tabla) {
                case 'tb_companiacontacto':
                    $query = "UPDATE tb_companiacontacto SET tb_tipocompania_id = $this->value WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query, $cn);
                    if (!$rs)                        throw new Exception("Error en consulta edita tipo compania: ".  mysql_error());
                    break;
                case 'tb_companiacontacto':
                    $query = "UPDATE tb_companiacontacto SET tb_viaenvio_id = $this->value WHERE id = $this->idCompania AND tb_empresa_id = $this->idEmpresa";
                    $rs = mysql_query($query,$cn);
                    if (!$rs)                        throw new Exception("Error en consulta: ".  mysql_error());
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
}