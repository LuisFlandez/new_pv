<?php
$link=mysql_connect("localhost","pjud_ica2","Pjud2022@") or die('No se pudo conectar: ' . mysql_error());
//$link=mysql_connect("localhost","root","") or die('No se pudo conectar: ' . mysql_error());
mysql_select_db("pjud_ica",$link) OR DIE ("Error: No es posible establecer la conexión con la base de datos pjud");
mysql_query("SET NAMES 'UTF8'");


if ($_POST['accion'] == "validar_credenciales") {
  if (isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['correo']))
  {  
          $var1=$_POST['nombre'];
          $var2=$_POST['clave'];
          $var3=$_POST['correo'];
          $usu=mysql_query("SELECT rut, contraseña, nombre, correo FROM user WHERE rut = '$var1' AND contraseña = '$var2' AND correo = '$var3' ", $link);
          $usu2 = mysql_fetch_row($usu);
      if (($_POST['nombre']==$usu2[0])&&($_POST['clave']==$usu2[1])&&($_POST['clave']!="")&&($_POST['correo']==$usu2[3]) )
      {
          session_start();
          $_SESSION['usuario']=$usu2[0];
          $_SESSION['pass']=$usu2[1];
          $_SESSION['nombre']=$usu2[2];
          $_SESSION['correo']=$usu2[3];
          echo "datos_correctos";
      }else{ 
        echo "faltan_datos";
      }
  } else {
    echo "faltan_datos";
  }; 
  
};

?>