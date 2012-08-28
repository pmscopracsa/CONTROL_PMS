<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/** OBTENER LOS DATOS EXISTENTES DE UNA COMPANIA EXISTENTE PARA ACTUALIZARLOS */

// DATOS DE LA TABLA tb_compnia
require_once '../../dl/busca_persona/RegistraCompania.php';
$rcompania = new RegistraCompania();

$res = array();
$giros = array();

/** OBTENEMOS GIRO */
require_once '../../dl/busca_persona/Giro.php';
$giro = new Giro();
$giro->set_tb_empresa_id($_SESSION['id']);

/** OBTENEMOS TMOBILE */
$telefonosm = array();
require_once '../../dl/busca_persona/TelefonoMobile.php';
$telefonosmobile = new TelefonoMobile();

/** OBTENEMOS TFIJO */
$telefonosf = array();
require_once '../../dl/busca_persona/TelefonoFijo.php';
$telefonosfijos = new TelefonoFijo();


/** OBTENEMOS TNEXTEL */
$telefnosn = array();
require_once '../../dl/busca_persona/TelefonoNextel.php';
$telefonosnextel = new TelefonoNextel();

/** OBTENEMOS ESPECIALIDADES */
$especialidades_array = array();
require_once '../../dl/busca_persona/Especialidad.php';
$especialidades = new Especialidad();

/** OBTENER DIRECCIONES */
$direcciones_array = array();
require_once '../../dl/busca_persona/Direccion.php';
$direcciones = new Direccion();

/** OBTENER REPRESENTANTES */
require_once '../../dl/busca_persona/Representantes.php';
$representantes_array = array();
$representantes = new Representantes();

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
    
    $especialidades->set_tb_companiacontacto_ruc($_REQUEST['ruc']);
    $especialidades_array = $especialidades->obtenerEspecialidadesPorCompania();
    
    $direcciones->set_ruc($_REQUEST['ruc']);
    $direcciones_array = $direcciones->obtenerDireccionesPorCompania();
    
    $representantes->setRuc($_REQUEST['ruc']);
    $representantes_array = $representantes->obtenerRepresentantesPorCompania();
    
    toHtml($res,$giros,$telefonosf, $telefonosm, $telefnosn,$especialidades_array,$direcciones_array,$representantes_array);
}
elseif ($_REQUEST['opcion'] == "nombre") {
    $rcompania->set_idempresa($_SESSION['id']);
    $rcompania->set_descripcion($_REQUEST['nombre']);
    $res = $rcompania->s_buscarCompaniaPorNombre();
    
    $giro->set_tb_compania_id($res[0]);
    $giros = $giro->r_obtenerGirosPorCompania();
    
    $telefonosfijos->set_ruc($res[1]);
    $telefonosf = $telefonosfijos->obtenerTelefonosPorCompania();
    
    $telefonosmobile->set_ruc($res[1]);
    $telefonosm = $telefonosmobile->obtenerTelefonosPorCompania();
    
    $telefonosnextel->set_ruc($res[1]);
    $telefnosn = $telefonosnextel->obtenerTelefonosPorCompania();
    
    $especialidades->set_tb_companiacontacto_ruc($res[1]);
    $especialidades_array = $especialidades->obtenerEspecialidadesPorCompania();
    
    $direcciones->set_ruc($res[1]);
    $direcciones_array = $direcciones->obtenerDireccionesPorCompania();
    
    $representantes->setRuc($res[1]);
    $representantes_array = $representantes->obtenerRepresentantesPorCompania();
    
    toHtml($res,$giros, $telefonosf, $telefonosm, $telefnosn, $especialidades_array, $direcciones_array,$representantes_array);
}

function toHtml($res,$giros,$telefonosf,$telefonosm,$telefnosn, $especialidades_array, $direcciones_array,$representantes_array) {
    
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
                <input type="hidden" value="'.$res[0].'" id="idCompania"/>
                <td>Tipo de Compañia:</td><td><input type="text" id="txttipocompania" name="txttipocompania" value="'.$res[11].'" READONLY /></td>
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
                <td>RUC:</td><td><input type="text" id="txtruc" name="txtruc" size="50" value="'.$res[1].'" READONLY/></td>
                <td><input type="button" id="btnUpdateRuc" value="Editar" />    
            </tr>
            <tr>
                <td>Nombre:</td><td><input type="text" id="txtcompania" name="txtcompania" size="50" value="'.$res[2].'" READONLY/></td>
                <td><input type="button" id="btnUpdateNombre" value="Editar"/>    
            </tr>
            <tr>
                <td>Nombre Comercial:</td><td><input type="text" id="txtcomercia" size="50" name="txtcomercial" value="'.$res[3].'" READONLY/></td>
                <td><input type="button" id="btnUpdateNombrecomercial" value="Editar""/>    
            </tr>    
            <tr>
                <td>Partida Registral:</td><td><input type="text" id="txtregistral" size="50" name="txtregistral" value="'.$res[4].'" READONLY/></td>
                <td><input type="button" id="btnUpdatePartidaRegistral" value="Editar" />    
            </tr>    
            <tr>
                <td><label for="giro">Giro:</label></td>
                <td>
            <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      for ($i=0;$i<count($giros);$i++) {
          if($i%2 != 0) {
              echo'<tr id="tr_giro">
                <td>
                <input type="text" id="txtGiro" name="giro" value="'.
                $giros[$i]
                .'" READONLY/></td>
                <input id="idGiro" type="hidden" value="'.$giros[$i-1].'" />    
                <td><input type="button" class="delRow" id="btnEliminarGiro"/></td>
                <td><input type="button" value="Editar" id="btnEditarGiro"/></td>
                </tr>';
              continue;
          }
      }
      echo
      '
            </table>
            </td>
            </tr>    
            <tr>
                <td>Actividad Principal:</td><td><input type="text" id="txtactividad" size="50" name="txtactividad" value="'.$res[5].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarActividadPrincipal" />   
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
          if ($i % 2 != 0) {
            echo'<tr id="tr_tfijo'.$i.'"><td>
                <input type="text" size="30" name="tfijo" value="'.
                    $telefonosf[$i]
                    .'" READONLY/>
                    <input type="hidden" value="'.$telefonosf[$i-1].'" />
                    <td><input type="button" class="delRow" value=" "/></td>
                    <td><input type="button" value="Editar" id="btnEditarTelefonoFijo"/>
                    </td></tr>';    
                    continue;
          }
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
          if ($i % 2 != 0) {
            echo'<tr id="tr_tfijo'.$i.'"><td>
                <input type="text" size="30" name="tfijo" value="'.
                    $telefonosm[$i]
                    .'" READONLY/>
                    <input type="hidden" value="'.$telefonosm[$i-1].'" />    
                    <td><input type="button" class="delRow" value=" "/></td>
                    <td><input type="button" value="Editar" id="btnEditarTelefonoMobile"/>
                    </td></tr>';    
                    continue;
          }
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
          if ($i % 2 != 0) {
            echo'<tr id="tr_tfijo'.$i.'"><td>
                <input type="text" size="30" name="tfijo" value="'.
                    $telefnosn[$i]
                    .'" READONLY/>
                    <input type="hidden" value="'.$telefnosn[$i-1].'" />    
                    <td><input type="button" class="delRow" value=" "/></td>
                    <td><input type="button" value="Editar" id="btnEditarTelefonoNextel"/>
                    </td></tr>';
                    continue;
          }
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>Fax:</td><td><input type="text" name="txtfax" size="50" value="'.$res[6].'"/></td>
                <td><input type="button" value="Editar" id="btnEditarFax"/>    
            </tr>
            <tr>
                <td>Direccion</td>
                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($direcciones_array);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $direcciones_array[$i]
                  .'" />
                 <td><input type="button" class="delRow" value=" "/></td>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>Especialidad:</td>
                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($especialidades_array);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $especialidades_array[$i]
                  .'" READONLY/>
                 <td><input type="button" class="delRow" value=" "/></td>
                 <td><input type="button" value="Editar" id="btnEditarEspecialidades"/>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>Representantes:</td>
                <td>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      for ($i = 0; $i < count($representantes_array);$i++) {
          echo'<tr id="tr_tfijo'.$i.'"><td>
              <input type="text" size="30" name="tfijo" value="'.
                  $representantes_array[$i]
                  .'" READONLY/>
                 <td><input type="button" class="delRow" value=" "/></td>
                 <td><input type="button" value="Editar" id="btnEditarRepresentante"/>
                 </td></tr>';    
      }
      echo
                    '</table>
                </td>
            </tr>
            <tr>
                <td>Observacion:</td><td><textarea>'.$res[7].'</textarea></td>
                <td><input type="button" value="Editar" id="btnEditarObservacion"/>    
            </tr>
            <tr>
                <td>Email:</td><td><input type="text" name="txtemail" size="50" value="'.$res[8].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarEmail"/>    
            </tr>
            <tr>
                <td>Web:</td><td><input type="text" name="txtweb" size="50" value="'.$res[9].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarWeb" />
            </tr>
            <tr>
                <td>Vía de Envío:</td><td><input type="text" id="txtviaenvio" name="txtviaenvio" value="'.$res[12].'" READONLY /></td>
                <td><input type="button" id="btnEditarViaEnvio" value="Editar" />    
            </tr>
            <tr>
                <td>
                    <select name="viaEnvioseleccionada" id="viaenvioid" >
                        <option value="0">Seleccione via de Envio</option>
                    </select>
                </td>
            </tr>
    </table>
    </form>
    ';
}