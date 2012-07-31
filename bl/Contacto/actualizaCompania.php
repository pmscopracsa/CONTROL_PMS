<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/**
 * OBTENER LOS DATOS EXISTENTES DE UNA COMPANIA EXISTENTE PARA ACTUALIZARLOS 
 */

// DATOS DE LA TABLA tb_compnia
require_once '../../dl/busca_persona/RegistraCompania.php';
$rcompania = new RegistraCompania();
$rcompania->set_idempresa($_SESSION['id']);
$res = array();
$giros = array();

require_once '../../dl/busca_persona/Giro.php';
$giro = new Giro();
$giro->set_tb_empresa_id($_SESSION['id']);


if ($_REQUEST['opcion'] == "ruc") 
{
    $rcompania->set_ruc($_REQUEST['ruc']);
    $res = $rcompania->s_buscaCompaniaPorRuc();
    toHtml($res);
}
elseif ($_REQUEST['opcion'] == "nombre") {
    $rcompania->set_descripcion($_REQUEST['nombre']);
    $res = $rcompania->s_buscarCompaniaPorNombre();
    
    $giro->set_tb_compania_id($res[0]);
    $giros = $giro->r_obtenerGirosPorCompania();
    toHtml($res,$giros);
}

function toHtml($res,$giros) {
    
    echo 
    '
    <form action="editatest.php" method="POST">    
    <table>
            <tr>
            <td>Tipo de Compañia:</td><td><select id="" name=""><option></option></select></td>
            </tr>
            <tr>
                <td>RUC:</td><td><input type="text" id="txtruc" name="txtruc" size="50" value="'.$res[1].'" /></td>
            </tr>
            <tr>
                <td>Nombre de Compañía:</td><td><input type="text" id="txtcompania" name="txtcompania" size="50" value="'.$res[2].'"/></td>
            </tr>
            <tr>
                <td>Nombre Comercial:</td><td><input type="text" id="txtcomercia" placeholder="Nombre COmercial" size="50" name="txtcomercial" value="'.$res[3].'"/></td>
            </tr>    
            <tr>
                <td>Partida Registral:</td><td><input type="text" id="txtregistral" placeholder="Partida Registral" size="50" name="txtregistral" value="'.$res[4].'"/></td>
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
                <td><input type="button" class="addRow" value="+"/></td>    
                <td><input type="button" class="delRow" value="-"/></td>
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
                <td>T. Fijo</td>
            </tr>
            <tr>
                <td>T. Mobile</td>
            </tr>
            <tr>
                <td>T. Nextel</td>
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
            </tr>
            <tr>
                <input type="hidden" id="txthdn_id" value="'.$res[0].'" />
                <td><input type="submit" id="actualizar" value="Actualizar registro" /></td>
            </tr>
    </table>
    </form>
    ';
}