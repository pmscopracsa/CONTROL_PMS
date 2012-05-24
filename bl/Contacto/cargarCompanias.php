<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxCompanias.php';

$selects = new ComboBoxCompanias();
$companias = $selects->cargaCompanias();

foreach ($companias as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
