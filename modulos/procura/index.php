<?php 
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

/**
 * CONF PARA LA MONEDA 
 */
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
         * CAMBIAR POR LA SESION
         */
        $seccion_venta->set_empresa_id(1);//$_SESSION['id'];
        $seccion_venta->set_directorio_id(1);//$_SESSION[''];
        $seccion_venta->set_tb_obra_id(2);//$_SESSION[''];
        $secciones_json = $seccion_venta->obtenerSecciones();
        $secciones_obje = json_decode($secciones_json);
        $tr_iterator = 1;
        
        /**
         * RECUPERAR LOS SUBTOTALES 
         */
        
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PROCURA</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish-vertical.css" media="screen">
        <link rel="stylesheet" type="text/css" href="../../css/barrasuperior.css" />
        <link rel="stylesheet" type="text/css" href="../../css/cuerpo.css" />
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
             /**
              * CONTROL PANEL HIDE OR SHOW DEPENDES ON REQUEST 
              */
             // PRESUPUESTO COSTO META
             // PRESUPUESTO COSTO META - INGRESO DE PARTIDAS DESDE EXCEL
             $("#href_ingresopartidasexcel").click(function(e) {
                 e.preventDefault();
                 $("#div_formPresupuestoCostoMeta").css("display","block");
                 $("#div_prsupuestocostometafromexcel").css("display","block");
             });
        });    
        </script>
        <style>
            
        </style>
</head>
<body class="fondo">
    <?php 
    /*if (!@$_SESSION['id']) {
        print 'No estas logeado.';
    }*/
    ?>
    <div id="barra-superior">
        <div id="barra-superior-dentro">
            <h1 id="titulo_barra">PROCURA</h1>
        </div>
    </div>    
    <div id="main">
<!-- -->
    <ul class="sf-menu">
             <!-- -->
             <li>
                <a href="#" id="href_directorios_proyectos">Directorios/Proyectos</a>
                <ul>
                    <li>
                        <a href="#" id="href_directorios">Directorios</a>
                    </li>
                    <li>
                        <a href="#" id="href_proyectos">Proyectos</a>
                    </li>
                </ul>
            </li>
            <!---->
            <li class="current">
                <a href="" id="02" id="href_presupuestocostometa">Presupuesto Costo Meta</a>
                <ul>
                    <li>
                        <a id="href_ingresopartidasexcel" href="#">Ingreso de partidas desde Excel </a>
                    </li>
                    <li class="current">
                        <a href="#ab" id="href_inlinenewupdatepartidas">Ingreso/Modificaci&oacute;n directa de Partidas</a>
                        <ul>
                            <li class="current"><a href="#" id="">Ingreso/Modificaci&oacute;n directa de Partidas</a></li>
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
                            <li><a href="#">De Compra</a></li>
                            <li><a href="#">De trabajo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Cambio</a>
                        <ul>
                            <li><a href="#">De Compra</a></li>
                            <li><a href="#">De Trabajo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Valorizaciones</a>
                        <ul>
                            <li><a href="#">De Compra</a></li>
                            <li><a href="#">De Trabajo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Actas de Recepci&oacute;n</a>
                        <ul>
                            <li><a href="#">Provisional</a></li>
                            <li><a href="#">Definitiva</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- -->
             <li>
                <a href="#">Reportes</a>
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

<!-- FORMULARIO DE SUBIDA DEL PRESUPUESTO COSTO/META FORMATO EXCEL -->    
<div id="div_formPresupuestoCostoMeta" style="display: none">   
<form action="index.php" method="post" enctype="multipart/form-data">
    <table width="413" border="0" cellspacing="0" cellpadding="0">
        <tr></tr>
        <tr>
            <td class="text">Por favor seleccione el archivo a subir:</td>
        </tr>
        <tr></tr>
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
<!-- FIN: FORMULARIO DE SUBIDA DEL PRESUPUESTO COSTO/META FORMATO EXCEL -->
        <div id="container">
            <table width="1200" id="customers" border="0" cellspacing="0" cellpadding="1">
                <thead>
                    <tr>
                        <th width="15" bgcolor="#A9F5F2"></th>
                        <th width="60" bgcolor="#A9F5F2">Secci&oacute;n</th>
                        <th width="60" bgcolor="#A9F5F2">Fase</th>
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
                        <td bgcolor="#C0C0C0" colspan="6">Gran Total:</td>
                        <td bgcolor="#C0C0C0"><?="S/.".number_format($partida_venta->totalSumatoriaPartidas(2),2,",",".")?></td>
                    </tr>        
                <?php
                foreach ($secciones_obje as $key=>$value) { //->SECCIONES
                echo '<tr id="row'.$tr_iterator.'" class="seccion" style="cursor:pointer;">';
                echo '<td bgcolor="#A9F5F2">+</td>';
                    echo '<td bgcolor="#FFECBF" id="td_seccion"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->sv_codificacion." - ".$value->sv_descripcion.'</font></p></td>';
                    echo '<td bgcolor="#FFECBF" colspan="5" id="td_seccion"></td>';
                    echo '<td bgcolor="#FFECBF">S/.'.number_format($value->sv_total,2,",",".").'</td>';
                    echo '</tr>';
                    $fase_venta->set_tb_seccionventa_id($value->sv_id);
                    $fases_json = $fase_venta->obtenerFases();
                    $fases_obj = json_decode($fases_json);
                    foreach ($fases_obj as $key=>$value) { //->FASES
                        echo '<tr class="child-row'.$tr_iterator.'" id="rowrow" style="display:none;cursor:pointer;">';
                        echo '<td width="50" bgcolor="#9AEED8" colspan="2"></td>';
                        echo '<td bgcolor="#9AEED8"><p><font face="Verdana,Arial,Helvetica" size="1">'.$value->fv_codificacion." - ".$value->fv_descripcion.'</font></p></td>';
                        echo '<td width="50" bgcolor="#9AEED8" colspan="4"></td>';
                        echo '<td bgcolor="#9AEED8">S/.'.number_format($value->fv_total,2,",",".").'</td>';
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
    </div>
</div>
</body>
</html>