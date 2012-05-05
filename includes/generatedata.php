<?php
mysql_connect('localhost','root','malcantara123')or die ("No se puede conectar");
mysql_select_db('control_pms')or die("no se puede seleccionar la base de datos");

/**
 *
*/
$tipocompania = "tipocompania";
$empresa = "empresa";
$pais = "pais";

print("Llenando tb_tipocompania");
for($i = 1; $i < 10; $i++){
  $sql = "INSERT INTO tb_tipocompania VALUES(
          null,
          '$tipocompania".$i."'
          )";
  mysql_query($sql);
}

print("Llenando tb_pais");
sleep(2);

for($i = 1; $i < 10; $i++){
  $sql = "INSERT INTO tb_pais VALUES(
          null,
          '$pais".$i."'
          )";
  mysql_query($sql);
}

print("Llenando tb_empresa");
sleep(2);
for($i = 1; $i < 10; $i++){
  $random_pais = rand(1,10);
  $sql = "INSERT INTO tb_empresa VALUES(
          null,
          '$empresa".$i."',
          '$empresa".$i."',
          '$empresa".$i."',
          $random_pais
          )";
  mysql_query($sql);
}

?>
