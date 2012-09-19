<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

// OBTENEMOS DATOS DE LA PERSONA
require_once '../../dl/busca_persona/RegistraPersona.php';
$rpersona = new RegistraPersona();
$rpersona->set_numerodocumento($_REQUEST['documento']);
$res = $rpersona->s_buscarPersonaPorDocumento();

// OBTENEMOS TELEFONOS
require_once '../../dl/busca_persona/TelefonoFijo.php';
require_once '../../dl/busca_persona/TelefonoMobile.php';
require_once '../../dl/busca_persona/TelefonoNextel.php';
require_once '../../dl/busca_persona/Especialidad.php';

require_once '../../dl/busca_persona/Correos.php';
$tf = new TelefonoFijo();
$tm = new TelefonoMobile();
$tn = new TelefonoNextel();
$es = new Especialidad();
$email = new Correos();
$tf->set_tb_personacontacto_id($res[0]);
$telefonosf = $tf->obtenerTelefonosPorPersona();
$tm->set_tb_companiapersona_id($res[0]);
$telefonosm = $tm->obtenerTelefonosPorPersona($res[0]);
$tn->set_tb_personacontacto_id($res[0]);
$telefonosn = $tn->obtenerTelefonosPorPersona($res[0]);
$es->set_id_nombrepersona($res[0]);
$especialidades = $es->obtenerEspecialidadesPorPersona();
$email->setIdPersona($res[0]);
$correos = $email->obtenerCorreosPersona();

toHtml($res,$telefonosf,$telefonosm,$telefonosn,$especialidades,$correos);

function toHtml($res,$telefonosf,$telefonosm,$telefonosn,$especialidades,$correos)
{
    echo'
        <table>
            <tr>
                <input type="hidden" value="'.$res[0].'" id="idpersonacontacto" />
                <input type="hidden" value="'.$res[9].'" id="idviaenvio" />
                <input type="hidden" value="'.$res[11].'" id="idespecialidad" />    
                <td>Numero de documento:<td><input class="inputext" id="txtnumerodocumento" type="text" value="'.$res[1].'" size="45" READONLY/>
                <td><input type="button" value="Editar" id="btnEditarNumeroDocumento" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Nombres y apellidos:<td><input type="text" class="inputext" id="txtnombres" value="'.$res[2].'" size="45" READONLY/>
                <td><input type="button" value="Editar" id="btnEditarNombres" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </tr>
            <tr>
                <td>Compania:<td><input type="text" class="inputext" id="txtcompania" value="'.$res[10].'" size="45" READONLY/>
                    <input type="hidden" id="txtidempresa" />
                <td><input type="button" value="Editar" id="btnEditarCompania" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Cargo:<td><input type="text" class="inputext" id="txtcargo" value="'.$res[3].'" size="45" READONLY/>
                <td><input type="button" value="Editar" id="btnEditarCargo" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Telefono Fijo:
                <td>
                <table border="0" class="atable">
                <fieldset>
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      if (count($telefonosf) === 0) {
          echo '<tr id="tr_tfijo"><td><input type="button" class="addRow" id="btnAgregarTF" /></td></tr>';
      } else { 
          for ($i=0;$i<count($telefonosf);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_tfijo">
                    <td>
                    <input type="text" class="inputext" id="txtTelefonoFijo" name="giro" value="'.
                    $telefonosf[$i]
                    .'" READONLY/></td>
                    <input id="idTFijo" type="hidden" value="'.$telefonosf[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTelefonoFijo" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarTF"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarTF"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '
            </table>
            </fieldset>
            </tr>
            <tr>
                <td>Telefono Movil:
                <td>
                <table border="0" class="atable">
                <fieldset>
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      if (count($telefonosm) === 0) {
          echo '<tr id="tr_tm"><td><input type="button" class="addRow" id="btnAgregarTM" /></td></tr>';
      } else { 
          for ($i=0;$i<count($telefonosm);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_tm">
                    <td>
                    <input type="text" class="inputext" id="txtTM" name="giro" value="'.
                    $telefonosm[$i]
                    .'" READONLY/></td>
                    <input id="idtm" type="hidden" value="'.$telefonosm[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTM" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarTM"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarTM"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '
            </table>
            </fieldset>
            </tr>
            <tr>
                <td>Telefono Nextel:
                <td>
                <table border="0" class="atable">
                <fieldset>
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** */
      if (count($telefonosn) === 0) {
          echo '<tr id="tr_tn"><td><input type="button" class="addRow" id="btnAgregarTN" /></td></tr>';
      } else { 
          for ($i=0;$i<count($telefonosn);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_tn">
                    <td>
                    <input type="text" class="inputext" id="txtTN" name="giro" value="'.
                    $telefonosn[$i]
                    .'" READONLY/></td>
                    <input id="idTN" type="hidden" value="'.$telefonosn[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTN" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarTN"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarTN"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '
            </table>
            </fieldset>
            </tr>
            <tr>
                <td>Direccion Personal:
                <td>
                    <table border="0" class="atable" id="direccion_full">
                    <fieldset>
                        <!--<tr>
                            <th>Direccion
                            <th>Pais
                            <th>Departamento
                            <th>Distrito-->
                         <tbody>
                            <tr></tr>
                         </tbody>
                    </fieldset>     
                    </table>
            </tr>
            <tr>
                <td>Direccion Laboral:
                <td>
                    <table border="0" class="atable" id="direccionlaboral_full">
                        <thead>
                            <tr class="ui-widget-header">
                                <th>Direccion
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                <td><input type="button" value="Buscar Direccion" id="btnAddDireTrabajo" class="ui-button ui-widget ui-state-default ui-corner-all" />    
            <tr>
                <td>Especialidades:
                <td>
                <table border="0" class="atable">
                <fieldset>
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** */
      if (count($especialidades) === 0) {
          echo '<tr id="tr_es"><td><input type="button" class="addRow" id="btnAgregarES" /></td></tr>';
      } else { 
          for ($i=0;$i<count($especialidades);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_es">
                    <td>
                    <input type="text" class="inputext" id="txtES" name="giro" value="'.
                    $especialidades[$i]
                    .'" READONLY/></td>
                    <input id="idES" type="hidden" value="'.$especialidades[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarES" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarES"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarES"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '     
            
            </table>
            </fieldset>
            </tr>
            <tr>
                <td>Observacion:<td>
                <!--<input type="text" value="'.$res[5].'" class="inputext" id="txtobservacion" size="45" READONLY/>-->
                <textarea class="inputext" id="txtobservacion" cols="75" rows="5" READONLY >'.$res[5].'</textarea>    
                <td><input type="button" id="btnEditaObservacion" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </tr>
            <tr>
                <td>Email principal:<td><input type="text" value="'.$res[6].'" class="inputext" id="txtemailprincipal" size="45" READONLY/>
                <td><input type="button" id="btnEditaEmail" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </tr>
            <tr>
                <td>Email Secundario:
                <td>
                <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      
      if (count($correos) === 0) {
          echo '<tr id="tr_mail"><td><input type="button" class="addRow" id="btnAgregarMAIL" /></td></tr>';
      } else { 
          for ($i=0;$i<count($correos);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_mail">
                    <td>
                    <input type="text" class="inputext" id="txtMAIL" name="mail" value="'.
                    $correos[$i]
                    .'" READONLY/></td>
                    <input id="idMAIL" type="hidden" value="'.$correos[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarMAIL" class="ui-button ui-widget ui-state-default ui-corner-all"/></td>    
                    <td><input type="button" class="delRow" id="btnEliminarMAIL"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarMAIL"/></td>
                    </tr>';
                  continue;
              }
          }
      }
      echo
      '
            </table>
            </tr>
            <tr>
                <td>Web:<td><input type="text" value="'.$res[7].'" class="inputext" id="txtweb" size="45" READONLY/>
                <td><input type="button" id="btnEditarWeb" value="Editar" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Fax:<td><input type="text" value="'.$res[4].'" class="inputext" id="txtfax" size="45" READONLY/>
                <td><input type="button" value="Editar" id="btnEditarFax" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
            </tr>
            <tr>
                <td>Via de Envio
                <td><div id="idviaenvio"></div>
                <td><table border="0" class="atable" id="idviaenvio">
                         <tbody>
                            
                         </tbody>
                    </table>
            </tr>
        </table>
        ';
}