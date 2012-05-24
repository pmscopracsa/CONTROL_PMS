<?php
include_once '../../dl/Conexion.php';

class EspecialidadCompaniaDL {
  protected $id;
  protected $descripcion;
  
  public function mostrarEspecialidades()
  {   
      $query = "SELECT * FROM tb_especialidadcompania";
      try
      {
          $conexion = new Conexion();
          $cn = $conexion->conectar();
          $rs = mysql_query($query,$cn);
          $registros = array();
          while($reg = mysql_fetch_array($rs))
          {
              array_push($registros, $reg);
          }
          mysql_free_result($rs);
          mysql_close($cn);
      }catch(Exception $ex){
          try {
              mysql_free_result($rs);
          }  catch (Exception $e1){}
          try {
              mysql_close($cn);
          } catch (Exception $e1) {}
      }
   return $registros;   
  }
  
  public function insertarEspecialidad()
  {
      $rpta;
      
      try
        {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            mysql_query("BEGIN",$cn);
            $query = "INSERT INTO tb_especialidadcompania VALUES(null,'$this->descripcion')";
            
            $rs = mysql_query($query, $cn);
            
            if (!$rs) {
                mysql_query("ROLLBACK",$cn);
                $rpta = FALSE;
            } else {
                mysql_query("COMMIT",$cn);
                $rpta = TRUE;
            }
            mysql_close($cn);
        }catch(Exception $ex){
            try{
                mysql_query("ROLLBACK");
            }  catch (Exception $e1){}
            try{
                mysql_close($cn);
            }catch(Exception $e1){
                
            }
            $rpta = FALSE;
        }
        return $rpta;
  }
  
  public function getId() {
      return $this->id;
  }

  public function setId($id) {
      $this->id = $id;
  }

  public function getDescripcion() {
      return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
      $this->descripcion = $descripcion;
  }
}
?>
