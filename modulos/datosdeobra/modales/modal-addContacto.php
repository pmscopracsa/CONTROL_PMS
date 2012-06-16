<?php
/**
 * Formulario:Registra datos de obra
 * Tipo: Modal
 * Tabla: tb_personacontacto
 */
?>
<div id="modal-addContacto" title="Agregar contactos">
    <div class="">
        <table id="tblAddContacto" style="width: 550px; height: 250px"
               url=""
               toolbar="toolbar"
               rownumber="true"
               border="0">
            <thead>
                <tr>
                    <th field="nombre">Nombre</th>
                </tr>
            </thead>
            <tr>
                <td>
                    <?php
                    foreach ($empresa_contacto as &$contacto_emp) {
                        echo '<table>';
                        echo '<tr style="cursor:pointer;"><td class="contactofirma">'.'<p style="display:none">'.$contacto_emp[1].'</p>'.'<p style="display:none">-</p>'.$contacto_emp[0].'</td></tr>';
                        echo '</table>';
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>