<?php



//for ($index = 1; $index <= $_REQUEST['filas_tfijo']; $index++) {
//    echo $_REQUEST['telefonofijo'.$index].'<br  />';
//}
//echo "telefonos fijos: ".$_REQUEST['filas_tfijo'].'<br />';
//echo "telefonos moviles: ".$_REQUEST['filas_tmovil'].'<br />';
//echo "telefonos nextel: ".$_REQUEST['filas_tnextel'].'<br />';
//echo "jquery: ".$_REQUEST['jquery'].'<br />';
//
//if (isset($_REQUEST['especialidad'])) {
//    $especialidad = $_REQUEST['especialidad'];
//    echo "Especialidades seleccionadas: "."<br />";
//    foreach ($especialidad as $indice => $valor)
//    {
//        echo $valor.'<br />';
//    }
//}
//else {
//    echo 'No se ha seleccionado nada';
//}
//
//echo "<br />";
//
//echo "# Direcciones: ".$_REQUEST['contador'];
echo "Tipo de compania:".$_REQUEST['tipocompaniaseleccionada']."<br />";
echo "RUC:".$_REQUEST['ruc']."<br />";
echo "Nombre:".$_REQUEST['nombre']."<br />";
echo "Nombre Comercial:".$_REQUEST['nombrecomercial']."<br />";
echo "Partida Registral:".$_REQUEST['partidaregistral']."<br />";
echo "Giro:".$_REQUEST['giro']."<br />";
echo "Actividad Principal:".$_REQUEST['actividadprincipal']."<br />";
echo "Cantidad Telefonos fijos:".$_REQUEST['filas_tfijo']."<br />";
echo "Cantidad Telefonos moviles:".$_REQUEST['filas_tmovil']."<br />";
echo "Cantidad Nextel:".$_REQUEST['filas_tnextel']."<br />";
echo "Cantidad Direcciones:".$_REQUEST['contador']."<br />";
echo "Especialidad:".sizeof($_REQUEST['especialidad'])."<br />";
echo "Observacion:".$_REQUEST['observacion']."<br />";
echo "Email:".$_REQUEST['email']."<br />";
echo "Web:".$_REQUEST['web']."<br />";
echo "Via de envio:".$_REQUEST['viaenvioseleccionada']."<br />";
//echo ":".$_REQUEST['']."<br />";

?>