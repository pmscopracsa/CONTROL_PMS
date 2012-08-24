<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/**
 * OBTENER LOS DATOS EXISTENTES DE UNA COMPANIA EXISTENTE PARA ACTUALIZARLOS 
 */
//require_once '../../dl/Conexion.php';
//
//try {
//    $cnx = new Conexion();
//    $cn = $cnx->conectar();
//    if (!$cn) 
//        throw new Exception("Error al conectar: ".  mysql_error());
//} catch (Exception $ex) {
//    echo 'Error: '.$ex->getMessage();
//}



// DATOS DE LA TABLA tb_compnia
require_once '../../dl/busca_persona/RegistraCompania.php';
$rcompania = new RegistraCompania();

$res = array();
$giros = array();

/**
 * OBTENEMOS GIRO 
 */
require_once '../../dl/busca_persona/Giro.php';
$giro = new Giro();
$giro->set_tb_empresa_id($_SESSION['id']);

/**
 * OBTENEMOS TMOBILE 
 */
$telefonosm = array();
require_once '../../dl/busca_persona/TelefonoMobile.php';
$telefonosmobile = new TelefonoMobile();

/**
 * OBTENEMOS TFIJO 
 */
$telefonosf = array();
require_once '../../dl/busca_persona/TelefonoFijo.php';
$telefonosfijos = new TelefonoFijo();


/**
 * OBTENEMOS TNEXTEL 
 */
$telefnosn = array();
require_once '../../dl/busca_persona/TelefonoNextel.php';
$telefonosnextel = new TelefonoNextel();

if ($_REQUEST['opcion'] == "ruc") {
    $rcompania->set_idempresa($_SESSION['id']);
    $rcompania->set_ruc($_REQUEST['ruc']);
    $res = $rcompania->s_buscaCompaniaPorRuc();
    
    $giro->set_tb_compania_id($res[0]);
    $giros = $giro->r_obtenerGirosPorCompania();
    
    $telefonosfijos->set_ruc($_REQUEST['ruc']);
    $telefonosf = $telefonosfijos->obtenerTelefonosPorCompania();
    
    $telefonosmobile->set_ruc($_REQUEST['ruc']);
    $telefonosm = $telefonosmobile->obtenerTelefonosPorCompania();
    
    $telefonosnextel->set_ruc($_REQUEST['ruc']);
    $telefnosn = $telefonosnextel->obtenerTelefonosPorCompania();
    
    toHtml($res,$giros,$telefonosf, $telefonosm, $telefnosn);
}
elseif ($_REQUEST['opcion'] == "nombre") {
    $rcompania->set_idempresa($_SESSION['id']);
    $rcompania->set_descripcion($_REQUEST['nombre']);
    $res = $rcompania->s_buscarCompaniaPorNombre();
    
    $giro->set_tb_compania_id($res[0]);
    $giros = $giro->r_obtenerGirosPorCompania();
    toHtml($res,$giros);
}

function toHtml($res,$giros,$telefonosf,$telefonosm,$telefnosn) {
    
    echo 
    '
    <script>
    $(document).ready(function() {
            // AGREGAR TIPOS DE COMPANIA
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarTipoCompania.php",
                success:function(data) {
                    $("#tipocompaniaid").append(data);
                }
            });
            
            // AGREGAR VIA DE ENVIO
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarViaEnvio.php",
                success:function(data) {
                    $("#viaenvioid").append(data);
                }
            })
    });
    </script>
    
    <form action="editatest.php" method="POST">    
    <table>
            <tr>
                <td>Tipo de Compañia:</td><td><input type="text" id="txttipocompania" name="txttipocompania" value="'.$res[10].'" READONLY /></td>
                <td><input type="button" id="btnEditarTipoCompania" value="Editar" />    
            </tr>
            
            <tr>
                <td>
                    <select name="tipocompaniaseleccionada" id="tipocompaniaid" style="display:none">
                        <option value="0">Seleccione un tipo de Compania</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>RUC:</td><td><input type="text" id="txtruc" name="txtruc" size="50" value="'.$res[1].'" /></td>
            </tr>
            <tr>
                <td>Nombre:</td><td><input type="text" id="txtcompania" name="txtcompania" size="50" value="'.$res[2].'"/></td>
            </tr>
            <tr>
                <td>Nombre Comercial:</td><td><input type="text" id="txtcomercia" size="50" name="txtcomercial" value="'.$res[3].'"/></td>
            </tr>    
            <tr>
                <td>Partida Registral:</td><td><input type="text" id="txtregistral" size="50" name="txtregistral" value="'.$res[4].'"/></td>
            </tr>    
            <tr>
                <td><label for="giro">Giro:</label></td>
                <td>
            <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      for ($i=0;$i<count($giros);$i++) {
            echo'<tr id="tr_giro'.$i.'"><td>
                <input type="text" size="30" name="giro" value="'.
                $giros[$i]
                .'" />
                <td><input type="button" class="delRow" value=" "/></td>
                </td></tr>';
      }
      echo
      '
            </table>
            </td>
            </tr>    
            <tr>
                <td>Actividad Principal:</td><td><input type="text" id="txtactividad" size="50" name="txtactividad" value="'.$res[5].'"/></td>
            </tr>
            <tr>
                <td><label>T. Fijo</label></td>
                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($telefonosf);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $telefonosf[$i]
                  .'" />
                 <td><input type="button" class="delRow" value=" "/></td>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td><label>T. Mobile</label></td>
                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($telefonosm);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $telefonosm[$i]
                  .'" />
                 <td><input type="button" class="delRow" value=" "/></td>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>T. Nextel</td>
                                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($telefnosn);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $telefnosn[$i]
                  .'" />
                 <td><input type="button" class="delRow" value=" "/></td>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>Fax:</td><td><input type="text" name="txtfax" size="50" value="'.$res[6].'"/></td>
            </tr>
            <tr>
                <td>Direccion</td>
            </tr>
            <tr>
                <td>Especialidad:</td>
            </tr>
            <tr>
                <td>Representantes:</td>
            </tr>
            <tr>
                <td>Observacion:</td><td><textarea>'.$res[7].'</textarea></td>
            </tr>
            <tr>
                <td>Email:</td><td><input type="text" name="txtemail" size="50" value="'.$res[8].'"/></td>
            </tr>
            <tr>
                <td>Web:</td><td><input type="text" name="txtweb" size="50" value="'.$res[9].'"/></td>
            </tr>
            <tr>
                <td>Vía de Envío:</td>
                <td><input type="text" id="txtViaEnvioEdit" READONLY value="'.$res[11].'" /></td>
            </tr>
            <tr>
                <td>
                    <select name="viaEnvioseleccionada" id="viaenvioid" >
                        <option value="0">Seleccione via de Envio</option>
                    </select>
                </td>
            </tr>
            <tr>
                <input type="hidden" id="txthdn_id" value="'.$res[0].'" />
                <td><input type="submit" id="actualizar" value="Actualizar registro" /></td>
            </tr>
    </table>
    </form>
    ';
}