<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$especialidades = array();
$emailsecundarios = array();

// OBTENEMOS DATOS DE LA PERSONA
require_once '../../dl/busca_persona/RegistraPersona.php';
$rpersona = new RegistraPersona();
$rpersona->set_nombrecompleto($_REQUEST['nombre']);
$res = $rpersona->s_buscarPersonaPorNombre();

// OBTENEMOS TELEFONOS
require_once '../../dl/busca_persona/TelefonoFijo.php';
require_once '../../dl/busca_persona/TelefonoMobile.php';
require_once '../../dl/busca_persona/TelefonoNextel.php';
$tf = new TelefonoFijo();
$tm = new TelefonoMobile();
$tn = new TelefonoNextel();
$tf->set_tb_personacontacto_id($res[0]);
$telefonosf = $tf->obtenerTelefonosPorPersona();
$tm->set_tb_companiapersona_id($res[0]);
$telefonosm = $tm->obtenerTelefonosPorPersona($res[0]);
$tn->set_tb_personacontacto_id($res[0]);
$telefonosn = $tn->obtenerTelefonosPorPersona($res[0]);

toHtml($res,$telefonosf,$telefonosm,$telefonosn);

function toHtml($res,$telefonosf,$telefonosm,$telefonosn)
{
    echo'
        <table>
            <tr>
                <td>Numero de documento:<td><input type="text" value="'.$res[1].'" />
            </tr>
            <tr>
                <td>Nombres y apellidos:<td><input type="text" value="'.$res[2].'" />
            </tr>
            <tr>
                <td>Compania:<td><input type="text" value="'.$res[3].'" />
            </tr>
            <tr>
                <td>Cargo:<td><input type="text" value="'.$res[4].'" />
            </tr>
            <tr>
                <td>Telefono Fijo:
                <td>
                <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      if (count($telefonosf) === 0) {
          echo '<tr id="tr_tf"><td><input type="button" class="addRow" id="btnAgregarTF" /></td></tr>';
      } else { 
          for ($i=0;$i<count($telefonosf);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_tf">
                    <td>
                    <input type="text" id="txtGiro" name="giro" value="'.
                    $telefonosf[$i]
                    .'" READONLY/></td>
                    <input id="idGiro" type="hidden" value="'.$telefonosf[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTF"/></td>    
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
            </tr>
            <tr>
                <td>Telefono Movil:
                <td>
                <table border="0" class="atable">
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
                    <input type="text" id="txtTM" name="giro" value="'.
                    $telefonosm[$i]
                    .'" READONLY/></td>
                    <input id="idGiro" type="hidden" value="'.$telefonosm[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTM"/></td>    
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
            </tr>
            <tr>
                <td>Telefono Nextel:
                <td>
                <table border="0" class="atable">
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
                    <input type="text" id="txtTN" name="giro" value="'.
                    $telefonosn[$i]
                    .'" READONLY/></td>
                    <input id="idTN" type="hidden" value="'.$telefonosn[$i-1].'" />    
                    <td><input type="button" value="Editar" id="btnEditarTN"/></td>    
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
            </tr>
            <tr>
                <td>Direccion Personal:
                <td>
                    <table border="0" class="atable" id="direccion_full">
                        <tr>
                            <th>Direccion
                            <th>Pais
                            <th>Departamento
                            <th>Distrito
                         <tbody>
                            <tr></tr>
                         </tbody>
                    </table>
            </tr>
            <tr>
                <td>Direccion de Trabajo:
            </tr>
            <tr>
                <td>Especialidades:
            </tr>
            <tr>
                <td>Observacion:<td><input type="text" value="'.$res[5].'" id="txtobservacion"/>
            </tr>
            <tr>
                <td>Especialidades:
            </tr>
            <tr>
                <td>Email principal:<td><input type="text" value="'.$res[6].'" id="txtemailprincipal"/>
            </tr>
            <tr>
                <td>Email Secundario:
            </tr>
            <tr>
                <td>Web:<td><input type="text" value="'.$res[7].'" id="txtweb" />
            </tr>
            <tr>
                <td>Fax:<td><input type="text" value="'.$res[4].'" id="txtfax" />
            </tr>
            <tr>
                <td>Via de Envio
            </tr>
        </table>
        ';
}