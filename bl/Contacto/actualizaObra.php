<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require_once '../../dl/ObraCliente.php';
$obra = new ObraCliente();
$obra->set_id($_REQUEST['idObra']);
$res = $obra->s_buscarObraPorId();
toHtml($res);

function toHtml($res) 
{
    echo '
    <table>
        <tr>
            <input type="hidden" value="'.$res[0].'" id="id_obra" />
            <td><label>Codigo:</label><td><input type="text" id="inputext" value="'.$res[1].'" READONLY/>        
        <tr>
            <td><label>Nombre:</label><td><input type="text" id="inputext" value="'.$res[2].'" READONLY />
        <tr>
            <td><label>Fecha inicio obra:</label><td><input type="text" class="txtfinicio" id="inputext" value="'.$res[3].'" READONLY /><input id="btnModificaFechaInicio" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <td><label>Fecha fin de obra:</label><td><input type="text" class="txtffin" id="inputext" value="'.$res[4].'" READONLY /><input id="btnModificaFechaFin" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
        <tr>
            <td><label>Direccion de la obra:</label><td><input type="text" id="inputext" class="direccion" value="'.$res[5].'" READONLY /><input id="btnModificaDireccion" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <td><label>Departamento:</label><td>
        <tr>
            <td><label>Moneda:</label><td>
        <tr>
            <input type="hidden" value="'.$res[6].'" id="idcliente" />
            <td><label>Cliente:</label><td><input type="text" id="inputext" value="'.$res[7].'" size="45" READONLY /><input id="btnModificaCliente" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[8].'" id="idcontratante" />
            <td><label>Empresa Contratante:</label><td><input type="text" id="inputext" value="'.$res[9].'" size="45" READONLY /><input id="btnModificaContratante" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[10].'" id="idgerente" />
            <td><label>Empresa Gerente de Proyecto:</label><td><input type="text" id="inputext" value="'.$res[11].'" size="45" READONLY /><input id="btnModificaGerente" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[12].'" />
            <td><label>Empresa supervisora de Proyecto:</label><td><input type="text" id="inputext" value="'.$res[13].'" size="45" READONLY /><input id="btnModificaSupervisor" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <td><label>Parametros Ppto. de Ventas:</label><td>
        <tr><input type="hidden" value="'.$res[14].'" />
            <td><label>Proveedor a facturar:</label><td><input type="text" id="inputext" value="'.$res[15].'" size="45" READONLY/><input id="btnModificaProveedor" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>   
        <tr>
            <td><label>Lista de contactos:</label>
        <tr>
            <td><label>Asignar firmas a reportes:    
    </table>
    <fieldset>
        <legend>Par&aacute;metros obras(para proveedores)</legend>
        <div id="inner-textfield">
            <table>
                <tr>
                    <td><input type="text" id="inputext" value="'.$res[16].'" size="5" READONLY/>
                    <td><p>Porcentaje de la carta fianza fiel cumplimiento para Contratistas/Proveedores</p>
                <tr>
                    <td><input type="text" id="inputext" value="'.$res[17].'" size="5" READONLY/>
                    <td><p>D&iacute;as h&aacute;biles para el desembolso, despues de presentada la factura</p>
                <tr>    
                    <td><input type="text" id="inputext" value="'.$res[18].'" size="5" READONLY/>
                    <td><p>Porcentaje de fondo de retenci&oacute;n</p>
                <tr>
                    <td><input type="text" id="inputext" value="'.$res[19].'" size="5" READONLY/>
                    <td><p>Dias habiles para la devolucion del fondo de retencion, contados a partir de la retencion de obra sin observaciones(Acta definitiva)</p>
            </table>
            <table>
                <tr>
                    <td><p>Monto contratado mayor a:</p>
                    <td><input type="text" value="'.$res[20].'" id="inputext" size="10" READONLY/>
                    <td>
                    <td>
                    <td><p><input type="checkbox" checked disabled />OC/OT</p>
                    <td><p><input type="checkbox" />CA y CG</p> 
                    <td><p><input type="checkbox" />Contrato</p>
                <tr>
                    <td><p>Monto contratado entre:</p>
                    <td><input type="text" id="inputext" size="10" READONLY />
                    <td> y
                    <td><input type="text" id="inputext" size="10" READONLY />
                    <td><p><input type="checkbox" CHECKED DISABLED />OC/OT</p>
                    <td><p><input type="checkbox" />CA y CG</p>
                    <td><p><input type="checkbox" />Contrato</p>
                <tr>
                    <td><p>Monto contratado menor a:</p>
                    <td><input type="text" id="inputext" value="'.$res[21].'" size="10" READONLY/>
                    <td>
                    <td>
                    <td><p><input type="checkbox" check disabled />OC/OT</p>
                    <td><p><input type="checkbox" />CA y CG</p>
                    <td><p><input type="checkbox" />Contrato</p>
            </table>
        </div>
    </fieldset>
    <br />
    <fieldset>
        <div id="inner-textfield">
            <table>
                <tr>
                    <td><p>Selecione modelo de carta de adjudicacion y condiciones generales</p>
                    <td><input type="text" id="inputext" READONLY /><input id="btn-modelocartaadjudicacion" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                <tr>
                    <td><p>Seleccione modelo de contrato</p>
                    <td><input type="text" id="inputext" READONLY /><input id="btn-modelocartacontrato" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </table>
        </div>
    </fieldset>
    ';
}