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
    
    $representantes->setRuc($_REQUEST['ruc']);
    $representantes_array = $representantes->obtenerRepresentantesPorCompania();
    
    //toHtml($res,$giros,$telefonosf, $telefonosm, $telefnosn,$especialidades_array,$direcciones_array,$representantes_array);
    toHtml($res,$giros,$telefonosf, $telefonosm, $telefnosn,$especialidades_array,$representantes_array,$res[1]);
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
    
    $representantes->setRuc($res[1]);
    $representantes_array = $representantes->obtenerRepresentantesPorCompania();
    
    //toHtml($res,$giros, $telefonosf, $telefonosm, $telefnosn, $especialidades_array, $direcciones_array,$representantes_array);
    toHtml($res,$giros, $telefonosf, $telefonosm, $telefnosn, $especialidades_array,$representantes_array,$res[1]);
}

function toHtml($res,$giros,$telefonosf,$telefonosm,$telefnosn, $especialidades_array,$representantes_array,$ruc) {
    
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
            });
            
            // AGREGAR ESPECIALIDAD
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cmb_cargarEspecialidadCompania.php",
                success:function(data){
                    $("#especialidadid").append(data);
                }
            });
            
            // AGREGAR REPRESENTANTE
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cmb_cargarRepresentantes.php",
                success:function(data){
                    $("#representanteid").append(data);
                }
            });
            
            /** OBTENER PAIS */
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarPaisesSelected.php",
                success:function(data){
                    $("#paisid").append(data);
                }
            });

            /** OBTENER DEPARTAMENTO */
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarDepartamentos.php",
                success:function(data){
                    $("#departamentoid").append(data);
                }
            });

            /** OBTENER DISTRITO */
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarDistritos.php",
                success:function(data){
                    $("#distritoid").append(data);
                }
            });
            
            /** OBTENER TIPO DIRECCION */
            $.ajax({
                dataType:"html",
                url:"../../../bl/Contacto/cargarTipoDireccion.php",
                success:function(data){
                    $("#tipodireccionid").append(data);
                }
            });
    });
    </script>
    
    <form action="editatest.php" method="POST">    
    <table>
            <tr>
                <input type="hidden" value="'.$res[0].'" id="idCompania"/>
                <td>Tipo de Compañia:</td><td><input type="text" id="inputext" class="txttipocompania" name="txttipocompania" value="'.$res[11].'" READONLY /></td>
                <td><input type="button" id="btnEditarTipoCompania" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all" />    
            </tr>
            
            <tr>
                <td>
                    <select name="tipocompaniaseleccionada" id="tipocompaniaid" style="display:none">
                        <option value="0">Seleccione un tipo de Compania</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>RUC:</td><td><input class="inputext" type="text" id="txtruc" name="txtruc" size="15" value="'.$res[1].'" READONLY/></td>
                <td><input type="button" id="btnUpdateRuc" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Nombre:</td><td><input type="text" class="inputext" id="txtcompania" name="txtcompania" size="15" value="'.$res[2].'" READONLY/></td>
                <td><input type="button" id="btnUpdateNombre" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Nombre Comercial:</td><td><input type="text" class="inputext" id="txtcomercia" size="15" name="txtcomercial" value="'.$res[3].'" READONLY/></td>
                <td><input type="button" id="btnUpdateNombrecomercial" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>    
            <tr>
                <td>Partida Registral:</td><td><input type="text" class="inputext" id="txtregistral" size="15" name="txtregistral" value="'.$res[4].'" READONLY/></td>
                <td><input type="button" id="btnUpdatePartidaRegistral" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>    
            <tr>
                <td><label for="giro">Giro:</label></td>
                <td>
                <fieldset>
            <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      if (count($giros) === 0) {
          echo '<tr id="tr_giro"><td><input type="button" class="addRow" id="btnAgregarGiro" /></td></tr>';
      } else { 
          for ($i=0;$i<count($giros);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_giro">
                    <td>
                    <input type="text" id="txtGiro" class="inputext" name="giro" value="'.
                    $giros[$i]
                    .'" READONLY/></td>
                    <input id="idGiro" type="hidden" value="'.$giros[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarGiro" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarGiro"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarGiro"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '
            </table>
            </td>
            </fieldset>
            </tr>    
            <tr>
                <td>Actividad Principal:</td><td><input type="text" id="txtactividad" class="inputext" size="15" name="txtactividad" value="'.$res[5].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarActividadPrincipal" class="ui-button ui-widget ui-state-default ui-corner-all"/>   
            </tr>
            <tr>
                <td><label>T. Fijo</label></td>
                <td>
                    <fieldset>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      if (count($telefonosf) === 0) {
          echo '<tr id="tr_tfijo"><td><input type="button" class="addRow" id="btnAgregarTF" /></td></tr>';
      } else {
        for ($i = 0; $i < count($telefonosf);$i++) {
            if ($i % 2 != 0) {
              echo'<tr id="tr_tfijo"><td>
                  <input id="txtTelefonoFijo" class="inputext" type="text" size="20" name="tfijo" value="'.
                      $telefonosf[$i]
                      .'" READONLY/>
                      <input id="idTFijo" type="hidden" value="'.$telefonosf[$i-1].'" />
                      <td><input type="button" class="delRow" id="btnEliminarTF" value=" "/></td>
                      <td><input type="button" value="Editar" id="btnEditarTelefonoFijo" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                      <td><input type="button" class="addRow" id="btnAgregarTF" /></td>
                      </tr>';    
                      continue;
            }
        }
      }  
      echo
                    '</table>
                </td>
                </fieldset>
            </tr>
            <tr>
                <td><label>T. Mobile</label></td>
                <td>
                    <fieldset>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      if (count($telefonosm) === 0) {
          echo '<tr id="tr_tmobile"><td><input type="button" class="addRow" id="btnAgregarTM" /></td></tr>';
      } else {
        for ($i = 0; $i < count($telefonosm);$i++) {
            if ($i % 2 != 0) {
              echo'<tr id="tr_tmobile"><td>
                  <input id="txtTelefonoMobile" type="text" class="inputext" size="20" name="tfijo" value="'.
                      $telefonosm[$i]
                      .'" READONLY/>
                      <input id="idTMobile"  type="hidden" value="'.$telefonosm[$i-1].'" />    
                      <td><input type="button" class="delRow" id="btnEliminarTM"/></td>
                      <td><input type="button" value="Editar" id="btnEditarTelefonoMobile" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                      <td><input type="button" class="addRow" id="btnAgregarTM" /></td>
                      </tr>';    
                      continue;
            }
        }
      }
      echo
                    '</table>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>T. Nextel</td>
                                <td>
                    <fieldset>            
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      if (count($telefnosn) === 0) {
              echo '<tr id="tr_tnextel"><td><input type="button" class="addRow" id="btnAgregarTN" /></td></tr>';
      } else {
        for ($i = 0; $i < count($telefnosn);$i++) {
            if ($i % 2 != 0) {
              echo'<tr id="tr_tnextel"><td>
                  <input id="txtTelefonoNextel" class="inputext" type="text" size="20" name="tfijo" value="'.
                      $telefnosn[$i]
                      .'" READONLY/>
                      <input id="idTNextel" type="hidden" value="'.$telefnosn[$i-1].'" />    
                      <td><input type="button" class="delRow" id="btnEliminarTN"/></td>
                      <td><input type="button" value="Editar" id="btnEditarTelefonoNextel" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                      <td><input type="button" class="addRow" id="btnAgregarTN" /></td>
                      </tr>';
                      continue;
            }
        }
      }
      echo
                    '</table>
                        </fieldset>
                </td>
            </tr>
            <tr>
                <td>Fax:</td><td><input type="text" id="txtfax" class="inputext" name="txtfax" size="15" value="'.$res[6].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarFax" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
            <td>Direccion</td>
                <td>
                    <div class="areaScroll">
                    <fieldset>
                    <table border="0" class="atable" id="direccion_full">
            <!--<tr>
                        <th>Direccion</th>
                        <th>Pais</th>
                        <th>Departamento</th>
                        <th>Distrito</th>
                        <th>Tipo de Direccion</th>
                    </tr>-->';
      echo
                    '<tbody>
                        <tr>
                        </tr>
                     </tbody>   
                     </table>
                     </fieldset>
                     <div>
                </td>
            </tr>
            <tr>
                <td>Especialidad:</td>
                <td>
                    <fieldset>
                    <table border="0" class="atable">
                    <tr>
                        <th>
                        <th colspan="2">
                    </tr>';
      if (count($especialidades_array) === 0) {
              echo '<tr id="tr_especialidad"><td><input type="button" class="addRow" id="btnNuevaEspecialidad" /></td></tr>';
              echo '<tr>
                      <td>
                          <select name="especialidad" id="especialidadid" style="display:none">
                              <option value="0">Seleccione especialidad</option>
                          </select>
                      </td>
                   </tr>';
      } else {
        for ($i = 0; $i < count($especialidades_array);$i++) {
            if ($i % 2 != 0) {
                echo'<tr id="tr_especialidad">
                    <td>
                      <input id="txtEspecialidad" type="text" size="35" class="inputext" name="tfijo" value="'.$especialidades_array[$i].'" READONLY/>
                      <input id="idEspecialidad" type="hidden" value="'.$especialidades_array[$i-1].'" />     
                    <td><input type="button" class="delRow" id="btnEliminarEspecialidad"/></td>
                    <td><input type="button" value="Editar" id="btnEditarEspecialidades" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="button" class="addRow" id="btnNuevaEspecialidad"/></td>
                    </tr>
                    <tr>
                      <td>
                          <select name="especialidad" id="especialidadid" style="display:none">
                              <option value="0">Seleccione especialidad</option>
                          </select>
                      </td>
                   </tr>';    
                   continue;
            }
        }
      }  
      echo
                    '</table>
                    </fieldset>    
                </td>
            </tr>
            <tr>
                <td>Contactos:</td>
                <td>
                    <div class="areaScrollModal" id="lista-contactos">
                    <table border="0" id="contactos-agregados">
                        <thead>
                            <tr class="ui-widget-header">
                                <th>Nombre de contacto
                                <th>En contrato
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                    </div>
                </td>
                <td><input type="button" class="addRow" id="btnNewRepresentante"/></td>
            </tr>
            <tr>
                <td>Observacion:</td><td><textarea cols="75" rows="5" id="txtObservacion" READONLY>'.$res[7].'</textarea></td>
                <td><input type="button" value="Editar" id="btnEditarObservacion" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Email:</td><td><input type="text" name="txtemail" class="inputext" size="35" id="txtEmail" value="'.$res[8].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarEmail" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Web:</td><td><input type="text" name="txtweb" class="inputext" id="txtweb" size="35" value="'.$res[9].'" READONLY/></td>
                <td><input type="button" value="Editar" id="btnEditarWeb" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </tr>
            <tr>
                <td>Vía de Envío:</td><td><input type="text" class="inputext" id="txtviaenvio" name="txtviaenvio" value="'.$res[12].'" READONLY /></td>
                <td><input type="button" id="btnEditarViaEnvio" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>
                    <select name="viaEnvioseleccionada" id="viaenvioid" style="display:none">
                        <option value="0">Seleccione via de Envio</option>
                    </select>
                </td>
            </tr>
    </table>
    </form>
    ';
}