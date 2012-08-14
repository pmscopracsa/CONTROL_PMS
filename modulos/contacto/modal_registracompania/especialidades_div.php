<?php
require_once('../../../dl/contacto_bl/EspecialidadCompaniaDL.php');
$especialidadcompania = new EspecialidadCompaniaDL();


$q = $_REQUEST['filtro'];

if ($q == "1") {
    $especialidades = $especialidadcompania->mostrarEspecialidades();

    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
} elseif ($q == "2") {
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
} else {
    $especialidadcompania->setDescripcion($q);
    $especialidades = $especialidadcompania->mostrarEspecialidadesPorNombre();
    

    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
}