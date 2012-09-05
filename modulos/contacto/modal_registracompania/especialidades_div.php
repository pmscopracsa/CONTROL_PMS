<?php
require_once('../../../dl/contacto_bl/EspecialidadCompaniaDL.php');
$especialidadcompania = new EspecialidadCompaniaDL();


//$q = $_REQUEST['filtro'];
//$a = 1;
if (@$_REQUEST['filtro'] == "1") {
    $especialidades = $especialidadcompania->mostrarEspecialidades();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
    echo '</div>';
} elseif (@$_REQUEST['filtro']== "2") {
    $query = "SELECT * FROM tb_especialidadcompania ORDER BY descripcion ASC";
    $result = mysql_query($query);
    $especialidades = array();
    $i = 0;
    
    while ($res = mysql_fetch_assoc($result)) {
        $especialidades[$i]['id'] = $res['id'];
        $especialidades[$i]['descripcion'] = $res['descripcion'];
        $i++;
    }
    echo json_encode($especialidades);
} elseif (@$_REQUEST['filtro']== "3") {
    $especialidades = $especialidadcompania->mostrarEspecialidades();
    echo '<div>';
    echo '<div style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"></div>';
    foreach ($especialidades as $valor) {
        echo '<table><tr style="cursor:pointer;"><td class="especialidades"><p style="display:none">'.
                    $valor[0].
                    '</p>'.
                    '<p style="display:none">-</p>'.
                    $valor[1].
                    '</td></tr></table>';
    }
} else {
    $especialidadcompania->setDescripcion(@$_REQUEST['filtro']);
    $especialidades = $especialidadcompania->mostrarEspecialidadesPorNombre();
    
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
    echo '</div>';
}