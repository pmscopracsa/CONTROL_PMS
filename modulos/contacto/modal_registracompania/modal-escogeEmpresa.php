<div id="modal-escogeEmpresa" title="Companias">
    <table id="tbl-escogeEmpresa" border="0">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tr>
            <td>
                <?php
                foreach ($lista_empresas as &$valor) {
                    echo '<table>';
                    echo '<tr style="cursor:pointer;">';
                    echo '<td class="cliente">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.$valor[1].'</td>';
                    echo '</tr>';
                    echo '</table>';
                }
                ?>
            </td>
        </tr>
    </table>
</div>