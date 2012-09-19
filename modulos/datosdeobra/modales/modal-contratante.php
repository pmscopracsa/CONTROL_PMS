<div id="modal-contratante" title="Seleccionar empresa contratante">
    <form autocomplete="off">
        <div class="" >
            <table id="contactos" style="width:550px;height250px" 
                    url=""
                    toolbar="toolbar"
                    rownumber="true"
                    borde="0">
                <thead>
                    <tr>
                        <th field="nombre">Nombre</th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        <?php
                        foreach ($clientes as &$valor) {
                            echo '<table>';
                            echo '<tr style="cursor:pointer;">';
                            echo '<td class="contratante">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.utf8_encode($valor[1]).'</td>';
                            echo '</tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>