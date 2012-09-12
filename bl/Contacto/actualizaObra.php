<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require_once '../../dl/ObraCliente.php';
$obra = new ObraCliente();
$obra->set_id($_REQUEST['idObra']);
$res = $obra->s_buscarObraPorId();

/** Obtener contactos */


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
                <input type="text" class="txtfiniciodata" id="inputext" style="display:none"/>
         <tr>
            <td><label>Fecha fin de obra:</label><td><input type="text" class="txtffin" id="inputext" value="'.$res[4].'" READONLY /><input id="btnModificaFechaFin" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
        <tr>
            <td><label>Direccion de la obra:</label><td><input type="text" id="inputext" class="direccion" value="'.$res[5].'" READONLY /><input id="btnModificaDireccion" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <input type="hidden" value="'.$res[31].'" id="iddepartamento" />
            <td><label>Departamento:</label>
            <td>
                <table border="0" class="atable" id="div_iddepartamento">
                    <tbody>
                    </tbody>
                </table>
        <tr>
            <input type="hidden" value="'.$res[32].'" id="idmoneda" />
            <td><label>Moneda:</label>
            <td>
                <table border="0" class="atable" id="div_idmoneda">
                    <tbody>
                    </tbody>
                </table>
        <tr>
            <input type="hidden" value="'.$res[6].'" id="idcliente" />
            <td><label>Cliente:</label><td><input type="text" id="inputext" class="txtcliente" value="'.$res[7].'" size="45" READONLY /><input id="btnModificaCliente" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[8].'" id="idcontratante" />
            <td><label>Empresa Contratante:</label><td><input type="text" class="txtcontratante" id="inputext" value="'.$res[9].'" size="45" READONLY /><input id="btnModificaContratante" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[10].'" id="idgerente" />
            <td><label>Empresa Gerente de Proyecto:</label><td><input type="text" class="txtgerente" id="inputext" value="'.$res[11].'" size="45" READONLY /><input id="btnModificaGerente" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr><input type="hidden" value="'.$res[12].'" id="idsupervidor"/>
            <td><label>Empresa supervisora de Proyecto:</label><td><input type="text" class="txtsupervisor" id="inputext" value="'.$res[13].'" size="45" READONLY /><input id="btnModificaSupervisor" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <td><label>Parametros Ppto. de Ventas:</label><td><input type="button" value="Mostrar" id="btnPPtoVenta" class="ui-button ui-widget ui-state-default ui-corner-all"/>
        <tr>
            <td>
            <td>
                <div id="div_pptoVenta" style="display:none;">
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <input type="hidden" id="idtipovalorizacion" value="'.$res[33].'" />
                                <td><label>Tipo de valorizaci&oacute;n</label>
                                <td>
                                    <table border="0" class="atable" id="div_idtipoval">
                                        <tbody>
                                        </tbody>
                                    </table>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <input type="hidden" id="idformatopresupuesto" value="'.$res[34].'"/>
                                <td><label>Formato presupuesto</label>
                                <td>
                                    <table border="0" class="atable" id="div_idpresupuesto">
                                        <tbody>
                                        </tbody>
                                    </table>
                            <tr>
                                <td><label>Factor de correcci&oacute;n</label>
                                <td><input type="text" size="10" id="inputext" class="txtfactor" value="'.$res[24].'" READONLY/>
                                <input type="button" value="Modificar" id="btnFactorCorreccion" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr>
                                <td><label>Retenci&oacute;n Fondo de Garant&iacute;a</label>
                                <td><input type="text" size="10" id="inputext" class="txtfondogarantia" value="'.$res[25].'" READONLY/>&#37;
                                <input type="button" value="Modificar" id="btnFondoGarantia" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr>
                                <td><label>Retenci&oacute;n Fiel Cumplimiento</label>
                                <td><input type="text" size="10" id="inputext" class="txtfielcumplimiento" value="'.$res[26].'" READONLY />&#37;
                                <input type="button" value="Modificar" id="btnFielCumplimiento" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Presupuesto Contractual</legend>
                        <div id="inner-textfield-modal">
                            <table>    
                            <tr>
                                <td><label>Gasto General</label></td>
                                <td><input size="5" id="inputext" type="text" class="txtggpc" name="txt-gastogeneral_pc" value="'.$res[27].'" READONLY/>&#37;
                                <input type="button" value="Modificar" id="btnGastoGeneralPC" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            </tr>
                            <tr>
                                <td><label>Utilidad</label></td>
                                <td><input size="5" id="inputext" type="text" class="txtupc" name="txt-utilidad_pc" value="'.$res[28].'" READONLY/>&#37;
                                <input type="button" value="Modificar" id="btnUtilidadPC" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            </tr>
                            </table>
                        </div>
                </fieldset>
                <fieldset>
                        <legend>Presupuesto con &oacute;rdenes de cambio</legend>
                        <div id="inner-textfield-modal">
                        <table>
                        <tr>
                            <td><label>Gasto General</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-gastogeneral_oc" class="txtggoc" value="'.$res[29].'" READONLY/>&#37;
                            <input type="button" value="Modificar" id="btnGastoGeneralOC" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        </tr>
                        <tr>
                            <td><label>Utilidad</label></td>
                            <td><input size="5" type="text" id="inputext" name="tx-utilidad_oc" class="txtuoc" value="'.$res[30].'" READONLY/>&#37;
                            <input type="button" value="Modificar" id="btnUtilidadOC" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        </tr>
                        </table>
                    </div>
                </fieldset>
                </div>
        <tr><input type="hidden" value="'.$res[14].'" id="idproveedor"/>
            <td><label>Proveedor a facturar:</label><td><input type="text" class="txtproveedor" id="inputext" value="'.$res[15].'" size="45" READONLY/><input id="btnModificaProveedor" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>   
        <tr>
            <td><label>Lista de contactos:</label>
            <td>
                <div class="areaScrollModal" id="lista-contactos">
                    <table id="contactos-agregados">
                        <thead>
                            <tr class="ui-widget-header">
                                <th>Nombre de Contacto</th>
                                <th>Empresa</th>
                                <th>Cargo</th>
                                <th>Correo Electr&oacute;nico</th>    
                                <th>RUC</th>
                                <th>Fax</th>
                                <th>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            <td><input type="button" value="Buscar contactos" id="btnAddContacts" class="ui-button ui-widget ui-state-default ui-corner-all"/>    
        <tr>
            <td><label>Asignar firmas a reportes:</label><td><input type="button" id="btnAsignaFirmas" value="..." class="ui-button ui-widget ui-state-default ui-corner-all" />    
    </table>
    <fieldset>
        <legend>Par&aacute;metros obras(para proveedores)</legend>
        <div id="inner-textfield">
            <table>
                <tr>
                    <td><input type="button" value="Modificar" id="btnModificaCartaFianza" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                    <td><input type="text" id="inputext" class="txtcartafianza" value="'.$res[16].'" size="5" READONLY/>
                    <td><p>Porcentaje de la carta fianza fiel cumplimiento para Contratistas/Proveedores</p>
                <tr>
                    <td><input type="button" value="Modificar" id="btnModificarDiasHabiles" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                    <td><input type="text" id="inputext" class="txtdiashabiles" value="'.$res[17].'" size="5" READONLY/>
                    <td><p>D&iacute;as h&aacute;biles para el desembolso, despues de presentada la factura</p>
                <tr>
                     <td><input type="button" value="Modificar" id="btnFondoRetencion" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                    <td><input type="text" id="inputext" class="txtfondoretencion" value="'.$res[18].'" size="5" READONLY/>
                    <td><p>Porcentaje de fondo de retenci&oacute;n</p>
                <tr>
                     <td><input type="button" value="Modificar" id="btnDiasDevolucion" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                    <td><input type="text" id="inputext" class="txtdiasdevolucion" value="'.$res[19].'" size="5" READONLY/>
                    <td><p>Dias habiles para la devolucion del fondo de retencion, contados a partir de la retencion de obra sin observaciones(Acta definitiva)</p>
            </table>
            <table>
                <tr>
                    <td><input type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                    <td><p>Monto contratado mayor a:</p>
                    <td><input type="text" value="'.$res[20].'" id="inputext" size="10" READONLY/>
                    <td>
                    <td>
                    <td><p><input type="checkbox" checked disabled />OC/OT</p>
                    <td><p><input type="checkbox" />CA y CG</p> 
                    <td><p><input type="checkbox" />Contrato</p>
                <tr>
                    <td>
                    <td><p>Monto contratado entre:</p>
                    <td><input type="text" id="inputext" size="10" READONLY />
                    <td> y
                    <td><input type="text" id="inputext" size="10" READONLY />
                    <td><p><input type="checkbox" CHECKED DISABLED />OC/OT</p>
                    <td><p><input type="checkbox" />CA y CG</p>
                    <td><p><input type="checkbox" />Contrato</p>
                <tr>
                    <td><input type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
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
                    <td><input type="text" id="inputext" READONLY size="50" /><input id="btn-modelocartaadjudicacion" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                <tr>
                    <td><p>Seleccione modelo de contrato</p>
                    <td><input type="text" id="inputext" READONLY size="50"/><input id="btn-modelocartacontrato" type="button" value="Modificar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
            </table>
        </div>
    </fieldset>
    ';
}