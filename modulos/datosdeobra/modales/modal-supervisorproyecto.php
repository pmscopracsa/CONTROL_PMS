<div id="modal-supervisorproyecto" title="Seleccionar cliente">
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
                        foreach ($especialidades as &$valor) {
                            echo '<table>';
                            echo '<tr style="cursor:pointer;"><td class="supervisorproyecto">'.$valor[1].'</td></tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>