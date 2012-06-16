<div id="div-modal-modelocartacontrato" title="Seleccionar modelo de contrato">
        <div class="" >
            <table id="contactos" style="width:550px;height:250px" 
                    url=""
                    toolbar="toolbar"
                    rownumber="true"
                    borde="0">
                <thead>
<!--                    <tr>
                        <th field="descripcion">Descripci&oacute;n</th>
                    </tr>-->
                </thead>
                <tr>
                    <td>
                        <?php
                        foreach ($contratos as &$valor) {
                            echo '<table>';
                            echo '<tr style="cursor:pointer;">';
                            echo '<td class="contrato">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.$valor[1].'</td>';
                           
                            echo '</tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
</div>