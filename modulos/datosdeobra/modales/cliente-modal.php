<?php
/**
 * modulo:datos de obra
 * formulario: datos de obra
 * descripcion: muestra datos de los clientes en ventana modal
 * tabla: tb_companiacontacto
 */
?>
<div id="modal-cliente" title="Seleccionar cliente">
    <div class="" >
        <table id="contactos" style="width:550px;height:250px" 
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
                        echo '<td class="cliente">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.$valor[1].'</td>';
                        echo '</tr>';
                        echo '</table>';
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>