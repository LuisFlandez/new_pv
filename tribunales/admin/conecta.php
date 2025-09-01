<?php
$link=mysql_connect("localhost","pjud_ica2","Pjud2022@") or die('No se pudo conectar: ' . mysql_error());
//$link=mysql_connect("localhost","root","") or die('No se pudo conectar: ' . mysql_error());
mysql_select_db("pjud_ica",$link) OR DIE ("Error: No es posible establecer la conexión con la base de datos pjud");
mysql_query("SET NAMES 'UTF8'");

?>