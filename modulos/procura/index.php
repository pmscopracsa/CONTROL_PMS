<?php 
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
//require_once '../../bl/DatosObra/seccion.php';
require_once '../../dl/datos_obra/SeccionVenta.php';
require_once '../../dl/datos_obra/FaseVenta.php';
require_once '../../dl/datos_obra/PartidaVenta.php';
$seccion_venta = new SeccionVenta();
$fase_venta = new FaseVenta();
$partida_venta = new PartidaVenta();
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

    } else {
        $status = "Error al subir archivo";
    }
}
        /**
        * RECUPERA LAS SECCIONES
        */
        $seccion_venta->set_empresa_id(1);//$_SESSION['id'];
        $seccion_venta->set_directorio_id(1);//$_SESSION[''];
        $seccion_venta->set_tb_obra_id(2);//$_SESSION[''];
        $secciones_json = $seccion_venta->obtenerSecciones();
        $secciones_obje = json_decode($secciones_json);
        $tr_iterator = 1;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PROCURA</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish-vertical.css" media="screen">
<!--        <link rel="stylesheet" href="../../css/960/reset.css" />
        <link rel="stylesheet" href="../../css/960/text.css" />
        <link rel="stylesheet" href="../../css/960/960.css" />-->
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
            $('tr.seccion')
                .css("cursor","pointer")
                .attr("title","Click para expander/contraer seccion")
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
    <?php
    if (!@$_SESSION['id']) {
        print 'No estas logeado.';
    }
    ?>
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
                        <a href="#">Actas de Recepci&oacute;n</a>
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
   
<form action="index.php" method="post" enctype="multipart/form-data">
    <table width="413" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="text">Por favor seleccione el archivo a subir:</td>
        </tr>
        <tr>
            <td class="text">
                <input name="archivo" type="file" class="casilla" id="archivo" size="35" />
                <input name="enviar" type="submit" class="boton" id="enviar" value="Subir archivo" />
                <input name="action" type="hidden" value="upload" />	  
            </td>
        </tr>
        <tr>
            <td class="text" style="color:#990000"></td>
        </tr>
    </table>
</form>
  
    <!---->
    <div id="container">
        <table width="795" id="customers" border="0" cellspacing="0" cellpadding="1">
            <thead>
                <tr>
                    <th width="50" bgcolor="#A9F5F2"><input type="button" value="1" /><input type="button" value="2" /></th>
                    <th width="70" bgcolor="#A9F5F2">Secci&oacute;n</th>
                    <th width="70" bgcolor="#A9F5F2">Fase</th>
                    <th width="140" bgcolor="#A9F5F2">Partida</th>
                    <th width="40" bgcolor="#A9F5F2">Unidad</th>
                    <th width="40" bgcolor="#A9F5F2">Metrado</th>
                    <th width="40" bgcolor="#A9F5F2">P.U</th>
                    <th width="40" bgcolor="#A9F5F2">Parcial</th>
                </tr>    
            </thead>
            <tbody>
                <tr>
                    <td bgcolor="#A9F5F2"></td>
                    <td bgcolor="#C0C0C0" colspan="7">Gran Total</td>
                </tr>        
                
            <?php

            foreach ($secciones_obje as $key=>$value) { //->SECCIONES
                echo '<tr id="row'.$tr_iterator.'" class="seccion" style="cursor:pointer;">';
                echo '<td bgcolor="#A9F5F2">+</td>';
                echo '<td bgcolor="#FFECBF" id="td_seccion"><p><font face="Verdana,Arial,Helvetica" size="1.5">'.$value->sv_codificacion." - ".$value->sv_descripcion.'</font></p></td>';
                echo '<td bgcolor="#FFECBF" colspan="6" id="td_seccion"></td>';
                echo '</tr>';
                $fase_venta->set_tb_seccionventa_id($value->sv_id);
                $fases_json = $fase_venta->obtenerFases();
                $fases_obj = json_decode($fases_json);
                foreach ($fases_obj as $key=>$value) { //->FASES
                    echo '<tr class="child-row'.$tr_iterator.'" id="rowrow" style="display:none;cursor:pointer;">';
                    echo '<td width="50" bgcolor="#9AEED8" colspan="2"></td>';
                    echo '<td bgcolor="#9AEED8"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->fv_codificacion." - ".$value->fv_descripcion.'</font></p></td>';
                    echo '<td width="50" bgcolor="#9AEED8" colspan="5"></td>';
                    echo '</tr>';
                    $partida_venta->set_tb_faseventa_id($value->fv_id);
                    $partidas_json = $partida_venta->obtenerPartidas();
                    $partidas_obj = json_decode($partidas_json);
                    foreach ($partidas_obj as $key=>$value) { //->PARTIDAS
                        echo '<tr class="child-row'.$tr_iterator.'" style="display:none;">';
                        echo '<td bgcolor="#ffffff" colspan="3"></td>';
                        echo '<td bgcolor="#ffffff"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->pv_codificacion." - ".$value->pv_descripcion.'</font></p></td>';
                        echo '<td bgcolor="#ffffff"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->pv_unidadmedida.'</font></p></td>';
                        echo '<td bgcolor="#ffffff"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->pv_metrado.'</font></p></td>';
                        echo '<td bgcolor="#ffffff"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->pv_precio.'</font></p></td>';
                        echo '<td bgcolor="#ffffff"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->pv_parcial.'</font></p></td>';
                        echo '</tr>';
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