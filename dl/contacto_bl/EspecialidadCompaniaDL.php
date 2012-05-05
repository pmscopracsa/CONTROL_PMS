<?php
include_once '../../dl/Conexion.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EspecialidadCompaniaDL
 *
 * @author root
 */
class EspecialidadCompaniaDL {
  
  public function mostrarEspecialidades()
  {   
      $query = "SELECT * FROM EspecialidadCompania";
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
}

?>
