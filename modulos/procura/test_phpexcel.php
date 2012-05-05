<?php
require_once '../../includes/Excel/reader.php';
$presupuesto = new Spreadsheet_Excel_Reader();
$presupuesto->setOutputEncoding('CP1251');
$presupuesto->read('test_1.xls');

/*
 * recoger data en un array multidimensional
 */
$secciones = array();
$fases = array();
$partidas = array();

$pivot_secciones = 0;
$pivot_fases = 0;
$pivot_partidas = 0;

$ppto = array();

$subtotal_seccion = array();
$subtotales = array();
$dev = 0;
$gran_total = 0;

/*
 * 2 for anidados para obtener los totales de las fases
 */
for ($index = 1; $index < $presupuesto->sheets[0]['numRows']; $index++) {
    for ($index1 = 1; $index1 < $presupuesto->sheets[0]['numCols']; $index1++) {
        if($index1 == 8 && ($presupuesto->sheets[0]['cells'][$index][$index1] != "")){
            $subtotales[$dev] =$presupuesto->sheets[0]['cells'][$index][$index1];
            $gran_total += $presupuesto->sheets[0]['cells'][$index][$index1];
            $dev++;
            continue;
        }
        if ($index1 == 1)                    continue;
        
    }
}

for ($index = 1; $index < $presupuesto->sheets[0]['numRows']; $index++) {
    //$pivot_fases = 0;
    for ($index1 = 1; $index1 < $presupuesto->sheets[0]['numCols']; $index1++) {
        
        //SECCIONES
        if ($index1 == 1 && ($presupuesto->sheets[0]['cells'][$index][$index1] == "1"))   {
            //echo 'Secciones: '.$presupuesto->sheets[0]['cells'][$index][3]."<br />";
            $secciones[$pivot_secciones] = $presupuesto->sheets[0]['cells'][$index][3];
            $pivot_secciones++;
            $pivot_fases = 0;
        }
        //FASE
        if ($index1 == 1 && ($presupuesto->sheets[0]['cells'][$index][$index1] == "2")) {
            //echo 'Fase: '.$presupuesto->sheets[0]['cells'][$index][3]."<br />";
            $fases[$pivot_secciones - 1][$pivot_fases] = $presupuesto->sheets[0]['cells'][$index][3];
            $pivot_fases++;
            $pivot_partidas = 0;
        }
        //PARTIDA
        if ($index1 == 1 && ($presupuesto->sheets[0]['cells'][$index][$index1] == "3")) {
            //echo 'Partida: '.$presupuesto->sheets[0]['cells'][$index][3]."<br />";
            $partidas[$pivot_secciones - 1][$pivot_fases - 1][$pivot_partidas] = $presupuesto->sheets[0]['cells'][$index][3];
            $pivot_partidas++;
        }
        
        //DETALLES DE LA PARTIDA
        if ($index1 == 1 && ($presupuesto->sheets[0]['cells'][$index][$index1] == "3")) {  
            for ($i = 0, $j = 4; $i < 4; $i++) {
                $ppto
                    [$secciones[$pivot_secciones - 1]]
                    [$fases[$pivot_secciones - 1][$pivot_fases - 1]]
                    [$partidas[$pivot_secciones - 1][$pivot_fases - 1][$pivot_partidas - 1]]
                    [$i] 
                    = 
                    $presupuesto->sheets[0]['cells'][$index][$j];
                $j++;
            }
        }
        
        if ($index1 == 1 && ($presupuesto->sheets[0]['cells'][$index][$index1] == "1")) {  
            $contador = 0;
            $subtotal_seccion[$contador] = $presupuesto->sheets[0]['cells'][$index][8];
            $contador++;
        }
    }
}

print_r($subtotal_seccion);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PPTO</title>
        <script type="text/javascript" src="../../js/jq16.js"></script>
        
        <link type="text/css" rel="stylesheet" href="../../css/jstree_pre1.0_fix_1/_docs/syntax/!style.css" />
        <link type="text/css" rel="stylesheet" href="../../css/jstree_pre1.0_fix_1/_docs/!style.css" />
        <script>
        $(document).ready(function(){
            $(function() {
                $('tr.seccion')
                    .css("cursor","pointer")
                    .attr("title","Click para expander/contraer sección")
                    .click(function(){
                        $(this).siblings('.child-'+this.id).toggle("slow"); //hermanos de class name
                    });
                //$('tr.seccion').trigger("click");    
            });
            
            $(function(){
                 $('tr#rowrow')
                    .css("cursor","pointer")
                    .attr("title","Click para expander/contraer fase")
                    .click(function(){
                        $(this).siblings('#child-'+$(this).attr("class")).toggle("slow");
                });
            });
        });
        </script>
    </head>
    <body id="demo_body">
        <div id="container">
        <table id="customers" border="0">
            <thead>
                <tr>
                    <th>Secci&oacute;n
                    <th>Fase
                    <th>Partida
                    <th>Unidad de medida    
                    <th>Metrado
                    <th>P.U
                    <th>Parcial
            </thead>
            <tbody>
                <tr><td bgcolor="#C0C0C0" colspan="6">Gran Total<td><?=$gran_total?>
            <?php
            $subtotal = 0;
            $tr_iterator = 1;
            foreach ($ppto as $key => $value) { //->secciones
                echo '<tr id="row'.$tr_iterator.'" class="seccion" style="cursor:pointer;"><td bgcolor="#FFECBF">'.$key;//->>
                foreach ($value as $key => $value) { //->fases
                    echo '<tr class="child-row'.$tr_iterator.'" id="rowrow" style="display:none; cursor:pointer;"><td><td bgcolor="#9AEED8">'.$key;//->>
                    echo '<td><td><td><td><td bgcolor="#cccccc">'.$subtotales[$subtotal];           $subtotal++;
                    foreach ($value as $key => $value) { //->partidas
                        echo '<tr class="child-row'.$tr_iterator.'" style="display:none;"><td><td><td bgcolor="#ffffff">'.$key;//->>
                        foreach ($value as $key => $values) { //->detalle partidas
                            echo '<td>'.$values;   
                        }
                    }
                }
                $tr_iterator++;
            }     
            ?>
            </tbody>
        </table>
        </div>
    </body>
</html>