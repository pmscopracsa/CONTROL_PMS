<?php 
$status = "";
if (@$_POST["action"] == "upload") {
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "../../archivos_excel/".$prefijo."_".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHP upload - unijimpe</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="413" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="413" height="40" class="titulo">PHP upload - unijimpe </td>
  </tr>
  <tr>
    <td class="text">Por favor seleccione el archivo a subir:</td>
  </tr>
  <tr>
  <form action="index.php" method="post" enctype="multipart/form-data">
    <td class="text">
      <input name="archivo" type="file" class="casilla" id="archivo" size="35" />
      <input name="enviar" type="submit" class="boton" id="enviar" value="Upload File" />
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
</body>
</html>

<!---->
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
if ($_POST['cargar'] == 'Subir') {
    header("Location: http://www.google.com");
} else {
    echo $_FILES["archivo"]['name']; 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PROCURA</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <script type="text/javascript" src="../../js/jquery1.4.2.js.js"></script>
        <script type="text/javascript" src="../../js/left_menu/hoverIntent.js"></script>
        <script type="text/javascript" src="../../js/left_menu/superfish.js"></script>
        <script type="text/javascript">

        // initialise plugins
        $(document).ready(function(){
            $('ul.sf-menu').superfish();
            
            //SUBIR PARTIDA EN XLS
            $("#subirpartida").click(function(e) {
                e.preventDefault();
                $("#divSubirPresupuesto").css("display","block");
                
            });
            $("#btnSubirPresupuesto").click(function() {
                $("#divSubirPresupuesto").css("display","none");
            })
        });
        </script>
    </head>
    <body>
        <ul class="sf-menu">
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
                <a href="#a">Presupuesto Costo Meta</a>
                <ul>
                    <li>
                        <a id="subirpartida" href="#">Ingreso de partidas desde Excel </a>
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
        <div id="centro" style="display: none">
            
        </div>   
        <div id="divSubirPresupuesto" style="display: none">
            <form action="index.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr><td><label>Presupuesto:</label></td><td><input type="file" id="presupuesto" name="presupuesto"/></td></tr>
                <tr><td></td><td><input type="submit" name="cargar" value="Cargar" /></td></tr>
            </table>
            </form>    
        </div>
    </body>
</html>

