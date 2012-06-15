<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="div-modal-modelocartaadjudicacio" title="Seleccionar carta de adjudicacion">
   
        <div class="" >
            <table id="contactos" style="width:550px;height250px" 
                    url=""
                    toolbar="toolbar"
                    rownumber="true"
                    borde="0">
                <thead>
                    <tr>
                        <th field="descripcion">Descripci&oacute;n</th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        <?php
                        foreach ($cartas as &$valor) {
                            echo '<table>';
                            echo '<tr style="cursor:pointer;">';
                            echo '<td class="carta">'.'<p style="display:none">'.$valor[0].'</p>'."-".$valor[1].'</td>';
                           
                            echo '</tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    
</div>
