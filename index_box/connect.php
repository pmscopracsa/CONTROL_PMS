<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

/* Database config */

$db_host		= 'localhost';
$db_user		= 'pms_admin';
$db_pass		= 'pmsadmin123';
$db_database	= 'control_pms'; 

/* End config */

$link = mysql_connect($db_host,$db_user,$db_pass) or die('No se puede establecer conexión a la base de datos');

mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");
