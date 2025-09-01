<?php
$host = "localhost";
$user = "pjud_ica2";
$pass = "Pjud2022@";
$db   = "pjud_ica";

// Crear conexión
$link = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$link) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer codificación UTF-8
mysqli_set_charset($link, "utf8");


?>