<div id="modal-supervisorproyecto" title="Seleccionar Supervisor de Proyecto">
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
                            echo '<tr style="cursor:pointer;"><td class="supervisorproyecto">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.utf8_encode($valor[1]).'</td></tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>