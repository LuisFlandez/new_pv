<?php

session_start();
if (!isset($_SESSION['usuario']))
{
    echo "error";
}else{
    
    $link=mysql_connect("localhost","pjud_ica2","Pjud2022@") or die('No se pudo conectar: ' . mysql_error());
    //$link=mysql_connect("localhost","root","") or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db("pjud_ica",$link) OR DIE ("Error: No es posible establecer la conexión con la base de datos pjud");
    mysql_query("SET NAMES 'UTF8'");

    $query=mysql_query("SELECT * FROM user WHERE rut = '".$_SESSION['usuario']."' AND contraseña = '".$_SESSION['pass']."' AND correo = '".$_SESSION['correo']."' ", $link); 
    if(mysql_num_rows($query) == 0){
        echo "error";
    }else{
        echo "ok";
    }
}
?>