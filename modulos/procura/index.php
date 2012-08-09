<?php 
/*
 * nombre del archivo en base a la empresa, fecha y usuario
 */
require_once '../../includes/Excel/reader.php';
$presupuesto = new Spreadsheet_Excel_Reader();
$presupuesto->setOutputEncoding('CP1251');

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


$status = "";
if (@$_POST["action"] == "upload") {
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		//$destino =  "../../archivos_excel/".$prefijo."_".$archivo;
                $destino =  "../../archivos_excel/".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                        $presupuesto->read("../../archivos_excel/".$archivo);
                        
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
                        
			$status = "Archivo subido: <b>".$archivo."</b>";
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHP upload - unijimpe</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish-vertical.css" media="screen">
        <link rel="stylesheet" href="../../css/960/reset.css" />
        <link rel="stylesheet" href="../../css/960/css/text.css" />
        <link rel="stylesheet" href="../../css/960/css/960.css" />
        <link type="text/css" rel="stylesheet" href="../../css/jstree_pre1.0_fix_1/_docs/syntax/!style.css" />
        <link type="text/css" rel="stylesheet" href="../../css/jstree_pre1.0_fix_1/_docs/!style.css" />
        <script type="text/javascript" src="../../js/jquery1.4.2.js.js"></script>
        <script type="text/javascript" src="../../js/left_menu/hoverIntent.js"></script>
        <script type="text/javascript" src="../../js/left_menu/superfish.js"></script>
        <script type="text/javascript" src="../../js/procura_general.js"></script>
        <script>
        $(document).ready(function() {
            $("ul.sf-menu").superfish({
                animation:{height:'show'},
                delay:1200
            });
            
            $("#mnu_2_1").click(function(e){
                e.preventDefault();
                subirxls();
                //$("#div_02_01").css("display","block");
            }); 
            //
            $('tr.seccion')
                .css("cursor","pointer")
                .attr("title","Click para expander/contraer sección")
                .click(function(){
                    $(this).siblings('.child-'+this.id).toggle("slow"); //hermanos de class name
                });
                    
             $('tr#rowrow')
                .css("cursor","pointer")
                .attr("title","Click para expander/contraer fase")
                .click(function(){
                    $(this).siblings('#child-'+$(this).attr("class")).toggle("slow");
                });
        });    
        </script>
        <style>
            .container_12 {
                background-image: url('../../css/12_col.gif');
            }
        </style>
</head>
<body>
    <div class="container_12">
        <div class="clear"></div>
        <div class="grid_3">
        QAZ
        </div>
        <div class="grid_9">
        WSX    
        </div>
    </div>    
<!-- -->
<ul class="sf-menu sf-vertical">
             <!-- -->
             <li>
                <a href="#">Directorios/Proyectos</a>
                <ul>
                    <li>
                        <a href="#">Directorios</a>
                    </li>
                    <li>
                        <a href="#">Proyectos</a>
                    </li>
                </ul>
            </li>
            <!---->
            <li class="current">
                <a href="" id="02">Presupuesto Costo Meta</a>
                <ul>
                    <li>
                        <a id="mnu_2_1" href="">Ingreso de partidas desde Excel </a>
                    </li>
                    <li class="current">
                        <a href="#ab">Ingreso/Modificaci&oacute;n directa de Partidas</a>
                        <ul>
                            <li class="current"><a href="#">Ingreso/Modificaci&oacute;n directa de Partidas</a></li>
                            <li><a href="#">Subir Partida</a></li>
                            <li><a href="#abb">menu item</a></li>
                            <li><a href="#abc">menu item</a></li>
                            <li><a href="#abd">menu item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Contratistas-Proveedores</a>
                <ul>
                    <li>
                        <a href="#">Ordenes</a>
                        <ul>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Cambio</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Valorizaciones</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Actas de Recepcion</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- -->
             <li>
                <a href="#">Contratistas-Proveedores</a>
                <ul>
                    <li>
                        <a href="#">Costo de Obra General Por Partida</a>
                    </li>
                    <li>
                        <a href="#">Reporte General de Ordenes</a>
                    </li>
                    <li>
                        <a href="#">Control de Pagos</a>
                    </li>
                </ul>
            </li>
            <!-- -->
             <li>
                <a href="#">Ayuda</a>
                <ul>
                    <li>
                        <a href="#">Formato Presupuesto</a>
                    </li>
                    <li>
                        <a href="#">Formato Orden OT/OC</a>
                    </li>
                    <li>
                        <a href="#">Auditoria</a>
                    </li>
                </ul>
            </li>
	
    </ul>
<!-- -->    
<div id="div_02_01" >
    <table width="413" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="text">Por favor seleccione el archivo a subir:</td>
  </tr>
  <tr>
  <form action="index.php" method="post" enctype="multipart/form-data">
    <td class="text">
      <input name="archivo" type="file" class="casilla" id="archivo" size="35" />
      <input name="enviar" type="submit" class="boton" id="enviar" value="Subir archivo" />
	  <input name="action" type="hidden" value="upload" />	  </td>
	</form>
  </tr>
  <tr>
    <td class="text" style="color:#990000"><?php echo $status; ?></td>
  </tr>
  <tr>
    <td height="30" class="subtitulo">Listado de Archivos Subidos </td>
  </tr>
  <tr>
    <td class="infsub">
	<?php 
	if ($gestor = opendir('../../archivos_excel/')) {
		echo "<ul>";
	    while (false !== ($arch = readdir($gestor))) {
		   if ($arch != "." && $arch != "..") {
			   echo "<li><a href=\"../../archivos_excel/".$arch."\" class=\"linkli\">".$arch."</a></li>\n";
		   }
	    }
	    closedir($gestor);
		echo "</ul>";
	}
	?>	</td>
  </tr>
</table>
    <!---->
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
    <!---->
    </div>
</body>
</html>