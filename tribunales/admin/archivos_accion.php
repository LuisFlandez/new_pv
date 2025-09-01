<?php
include("conecta.php");

session_start();

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion == 4) {
        $user = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
        $fecha = date('Y-m-d');
        $tipo = isset($_POST['tipo_update']) ? $_POST['tipo_update'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $fecha1 = isset($_POST['fecha1']) ? $_POST['fecha1'] : '';
        $fecha2 = isset($_POST['fecha2']) ? $_POST['fecha2'] : '';

        // Validación de fechas
        if (!empty($fecha1) && !empty($fecha2) && strtotime($fecha1) > strtotime($fecha2)) {
            echo "<div class='alert alert-warning text-center' role='alert'> La fecha inicial no puede ser mayor que la fecha final </div>";
            return; // Detiene la ejecución del script
        }

        if (!empty($user) && !empty($tipo) && !empty($nombre) && !empty($_FILES['archivo_update']['name'])) {
            $ofi = mysql_query("SELECT MAX(id) FROM documentos", $link);
            $row = mysql_fetch_array($ofi);
            $id = $row[0] + 1;
            $ext = pathinfo($_FILES['archivo_update']['name'], PATHINFO_EXTENSION);
            $filename = $id . '.' . $ext;
            $destination = 'adjuntos/' . $filename;
            $location = $_FILES["archivo_update"]["tmp_name"];

            if (move_uploaded_file($location, $destination)) {
                $contenido = 'adjuntos/' . $filename;
                $result = mysql_query("INSERT INTO documentos (id, fecha_subida, contenido, tipo, usuario, nombre, fecha1, fecha2) 
                 VALUES ('$id', '$fecha', '$contenido', '$tipo', '$user', '$nombre', '$fecha1', '$fecha2')", $link);

                if ($result) {
                    echo "<div class='alert alert-success text-center' role='alert'> ¡Documento actualizado con éxito! </div>";
                } else {
                    echo "<div class='alert alert-danger text-center' role='alert'> Error en la consulta SQL </div>";
                    echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
                }
            } else {
                echo "<div class='alert alert-danger text-center' role='alert'> Error al subir el archivo </div>";
            }
        } else {
            echo "<div class='alert alert-warning text-center' role='alert'> Debe completar el formulario </div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center' role='alert'> Acción no definida </div>";
        error_log('Accion no definida' . print_r($_POST, true));
    }
}
?>