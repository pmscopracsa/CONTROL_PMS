<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/** OBTENEMOS DATOS DE LA LISTA DE DISTRIBUCION */
require_once '../../dl/busca_persona/RegistraListaDistribucion.php';
$rlistadist = new RegistraListaDistribucion();
$rlistadist->set_nombrelista($_REQUEST['nombrelista']);
$res = $rlistadist->s_buscarListaDistribucionPorNombre();

// OBTENEMOS LISTA DE CONTACTOS DE LA LISTA DE DISTRIBUCION
$rlistadist->set_id($res[0]);
$contactos = $rlistadist->obtenerContactosPorLista();

toHtml($res,$contactos);

function toHtml($res,$contactos)
{
    echo '
    <table>
        <tr>
            <input type="hidden" id="idlistadistribucion" value="'.$res[0].'" />
            <td>Nombre de la lista:<td><input type="text" class="inputext" id="txtnombrelista" value="'.$res[2].'" READONLY />
            <td><input type="button" value="Editar" id="btnEditarNombreLista" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
        </tr>
        <tr>
            <td>Contactos de la lista:
            <td>
                <table border="0" class="atable">
            <tr>
                <th>
                <th colspan="2">
            </tr>';
      /** MUESTRA CADA GIRO CON SU RESPECTIVO ID PARA ELIMINAR O ACTUALIZAR ;D */
      if (count($contactos) === 0) {
          echo '<tr id="tr_contacto"><td><input type="button" class="addRow" id="btnAgregarContacto" /></td></tr>';
      } else { 
          for ($i=0;$i<count($contactos);$i++) {
              if($i%2 != 0) {
                  echo'<tr id="tr_contacto">
                    <td>
                    <input type="text" class="inputext" id="txtContacto" size="45" name="giro" value="'.
                    $contactos[$i]
                    .'" READONLY/></td>
                    <input id="idTContacto" type="hidden" value="'.$contactos[$i-1].'" />    
                    <td><input type="button" class="delRow" id="btnEliminarContacto"/></td>
                    <td><input type="button" class="addRow" id="btnAgregarContacto"/></td>
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
            <td>Observacion:<td><input type="text" class="inputext" id="txtobservacion" value="'.$res[3].'" READONLY/>
            <td><input type="button" value="Editar" id="btnEditarObservacion" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        </tr>
    </table>
    ';
}