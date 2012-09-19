<div id="div-modal-modelocartaadjudicacion" title="Seleccionar carta de adjudicacion">
        <div class="" >
            <table id="contactos" style="width:550px;height:250px" 
                    url=""
                    toolbar="toolbar"
                    rownumber="true"
                    border="0">
                <thead>
                </thead>
                <tr>
                    <td>
                        <?php
                        foreach ($cartas as &$valor) {
                            echo '<table>';
                            echo '<tr style="cursor:pointer;">';
                            echo '<td class="carta">'.'<p style="display:none">'.$valor[0].'</p>'.'<p style="display:none">-</p>'.utf8_encode($valor[1]).'</td>';
                            
                            echo '</tr>';
                            echo '</table>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
</div>