<?php 
require_once '../../bl/DatosObra/seccion.php';
/*
 * nombre del archivo en base a la empresa, fecha y usuario
 */
require '../../includes/Excel/cpms_parser.php';
$cpms_parser = new cpms_parser();

$status = "";
if (@$_POST["action"] == "upload") {
    // obtenemos los datos del archivo 
    // $tamano = $_FILES["archivo"]['size']; $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
        
    if ($archivo != "") {
        $destino =  "../../archivos_excel/".$archivo;

        if (copy($_FILES['archivo']['tmp_name'],$destino)) {
            $cpms_parser->set_xls_file($archivo);
            $cpms_parser->dump_xls_to_db();
        }
        /**
         * RECUPERAR LOS DATOS PARA PINTAR 
         */
        
        
    } else {
        $status = "Error al subir archivo";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PROCURA</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish-vertical.css" media="screen">
        <link rel="stylesheet" href="../../css/960/reset.css" />
        <link rel="stylesheet" href="../../css/960/text.css" />
        <link rel="stylesheet" href="../../css/960/960.css" />
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
    <td class="text" style="color:#990000"><?php // echo $status; ?></td>
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
                <tr><td bgcolor="#C0C0C0" colspan="6">Gran Total<td><?//$gran_total?>
            <?php
//            $subtotal = 0;
//            $tr_iterator = 1;
//            foreach ($ppto as $key => $value) { //->secciones
//                echo '<tr id="row'.$tr_iterator.'" class="seccion" style="cursor:pointer;"><td bgcolor="#FFECBF">'.$key;//->>
//                foreach ($value as $key => $value) { //->fases
//                    echo '<tr class="child-row'.$tr_iterator.'" id="rowrow" style="display:none; cursor:pointer;"><td><td bgcolor="#9AEED8">'.$key;//->>
//                    echo '<td><td><td><td><td bgcolor="#cccccc">'.$subtotales[$subtotal];           $subtotal++;
//                    foreach ($value as $key => $value) { //->partidas
//                        echo '<tr class="child-row'.$tr_iterator.'" style="display:none;"><td><td><td bgcolor="#ffffff">'.$key;//->>
//                        foreach ($value as $key => $values) { //->detalle partidas
//                            echo '<td>'.$values;   
//                        }
//                    }
//                }
//                $tr_iterator++;
//            }     
            ?>
            </tbody>
        </table>
        <input style="display: none" type="button" id="confirmarupload" />
        </div>
    <!---->
    </div>
</body>
</html>