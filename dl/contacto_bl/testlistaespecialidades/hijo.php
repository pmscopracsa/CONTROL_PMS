<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$examp = $_GET["q"]; //query number 
$page = $_GET['page']; // get the requested page 
$limit = $_GET['rows']; // get how many rows we want to have into the grid 
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
$sord = $_GET['sord']; // get the direction 
$id = $_GET['id']; 

if(!$sidx) $sidx =1;

switch ($examp) { 
    case 1: 
        $result = mysql_query("SELECT COUNT(compania.descripcion) AS count FROM tb_rubro rubro 
        INNER JOIN tb_companiacontacto compania
        ON compania.id = rubro.tb_companiacontacto_id
        WHERE tb_especialidadcompania_id = ".$id); 
        $row = mysql_fetch_array($result,MYSQL_ASSOC); 
        $count = $row['count']; 
        
        if( $count >0 ) { 
            $total_pages = ceil($count/$limit); 
        } else { 
            $total_pages = 0; 
        } 
        
        if ($page > $total_pages) $page=$total_pages; 
        $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
        if ($start<0) $start = 0; 
        $SQL = "SELECT compania.id, compania.descripcion FROM tb_rubro rubro 
        INNER JOIN tb_companiacontacto compania
        ON compania.id = rubro.tb_companiacontacto_id
        WHERE tb_especialidadcompania_id = ".$id." ORDER BY $sidx $sord LIMIT $start , $limit"; 
        $result = mysql_query( $SQL ) or die("Couldnt execute query.".mysql_error()); 
        
        $responce = new stdClass();
        $responce->page = $page; 
        $responce->total = $total_pages; 
        $responce->records = $count; 
        $i=0; 
        
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
            $responce->rows[$i]['id']=$row['id']; 
            $responce->rows[$i]['cell']=array($row['id'],$row['descripcion']); 
            $i++; 
        } 
        
        echo json_encode($responce); 
        break; 
}
?>