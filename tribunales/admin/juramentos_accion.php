<?php
include("conecta.php");

// DIV DIRECTORIOS / DIV IMAGENES
if($_POST['accion'] == 0){

    ?>
        <div class="col-sm-3">
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary shadow" style="width: 330px;">

                <a class="d-flex align-items-center flex-shrink-0 p-3 link-body-emphasis text-decoration-none border-bottom cambiaColor" onclick="modalCarpeta()" style="cursor:pointer" >
                    <img title="Crear una Carpeta" width="30" height="30" src="data:image/png;base64,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">
                    <span class="fs-5 fw-semibold" style="color:black; margin-left:7px">Directorios</span>
                </a>

                <div class="list-group list-group-flush border-bottom scrollarea" style="overflow-y:auto; max-height:570px">
                    <div style="margin-left:7px; margin-top:7px; margin-bottom:7px">
                        <?php

                            $directorio = "../cavaldivia/juramentos";
                            $archivos = scandir($directorio);
                            
                            $carpetas = array_filter($archivos, function ($item){
                                return $item && $item != '.' && $item != '..';
                            });
                            
                            $carpetasPorAno = [];
                            foreach ($carpetas as $carpeta) {
                                $ano = substr($carpeta, 0, 4);
                                $carpetasPorAno[$ano][] = $carpeta;
                            }

                            krsort($carpetasPorAno);

                            foreach ($carpetasPorAno as &$carpetas) {
                                rsort($carpetas);
                            }
                            unset($carpetas);
                        

                            foreach ($carpetasPorAno as $ano => $carpetas) : 
                                ?>
                                <div class="ano" onclick="toggleCarpetas('<?php echo $ano; ?>')">
                                    <div class="contenido-ano">
                                        <div class="signo" id="estado-<?php echo $ano; ?>" style="margin-bottom:1px"><text style="margin-bottom:3px">+</text></div>
                                        <span>
                                            <img  style="margin-left:7px; margin-bottom:4px" height="18" width="18" x="" y="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAbklEQVR4nGNgGLFgWpXLf2LxrtkeKJgUvQzYLP56rpUo/P/dYhRMrL5pQ9bir2TiaUPK4lU9QQQTzuqeoGFk8dcRF8dfRy0+NxrUraOJ6/9odpo2WoCAwGiR+RVPgTDyGnv/qW3xtIFo0DOMFAAAbC8+T1TRYHMAAAAASUVORK5CYII=">
                                            <?php echo $ano; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="carpetas" id="carpetas-<?php echo $ano; ?>" >
                                    <?php foreach ($carpetas as $carpeta) : ?>

                                        <div onclick="mostrarImagen('<?php echo $carpeta ?>','<?php echo $ano; ?>')">
                                            <img id ="img1<?php echo $carpeta ?>" style="margin-bottom:4px; margin-left:25px" height="16" width="16" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABTUlEQVR4nO3Vz0vCYBzH8f1xQw2JDlKQIPRr/guBhrhc3ZROzwKbEaxfYiTlKfQSSulq0UEvXvoPyuVuwSccPIGl7sn0gWpfeJ8Ge/Hs4XkmCN7wHBIT4Za6IaanAreL0tCahVXsyzPd3biY4Qq3p4UTBrjXw8ky9hL+N5atGZXwHbiaC0NLBlDORtAxUrDNrbEin2G39O1ZPJXXxwbtYfBPX/g/4dalhIoWRKsU5QtXckFcZQMOznfFpaiD91b+N/b4pZ5E4zSM53qCH2wZMmqHIWcPq3oInYb88aymr+H6YGXysHWXwu3xgoPSbo7mYRmbDkovGRacsMKv9wqM/GIfSqtoc1Dj/TecG05Y4K6pwCxEBqK08x0f1Bg7TtxhBY/FpZEo7SzjA2FcOXGDmxcSE0rLp/1ffiyDcPKrzrHtweYEPjXhmOCNwHHeAWE0QuKIxc9QAAAAAElFTkSuQmCC">
                                            <img id ="img2<?php echo $carpeta ?>" style="display:none; margin-bottom:4px; margin-left:10px" height="16" width="16"src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABU0lEQVR4nO3W3UvCUBgG8P19/QkZta5mg4JC6k6sCy0ygzYlWx8suvEmCNKMkMDtohuRICEiyD7og+gimrZF+YSKrnRtWtvxoj3w3L3w47ycA4ei3JCMyPaBZKmvMKmIhrC86mzhwqzNqy7sA1oJ0BSgkCa4ak3Rb5Oq/Ae4kK7jKulVyzY9p/fDGO43fHjdi5CD3w6WcBMfRZFjcBkdscTVDP93uJyK4CrG1tBGq3g5tdA2+yGt4EzwQZ4ewON28Pfwy04IRV4H2/BkuDmrZaLIL3qRDfTXKgU8uEvMdAsLeEr4DcFWvJScx/NuGEfB4Saq14PrLX9ncCUbx8PmlCWq14tciDZA9Z6vTwKSYA7fro13gdZ7wTHIhYZM8dPlCVSq+E9wt+h3fNAUP+HH7Icbzc+an9wx2Ap3FK7jdG/gIsfgeI7uHCYRsRXuyffWDUUgn62kN1ByqgO4AAAAAElFTkSuQmCC">
                                            <?php echo $carpeta; ?>
                                        </div>
                                        
                                    <?php endforeach; ?>
                                </div>
                                <?php
                            endforeach;
                        ?>     
                    </div>
                </div>

                    
            </div>
        </div>
        

        <div class="col-sm-9 " style="background-color:" >
            <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary" style="width: 100%;">
                <a  class="d-flex align-items-center flex-shrink-0 p-3 link-body-emphasis text-decoration-none border-bottom shadow">
                    <img width="30" height="30" src="https://img.icons8.com/officel/80/picture.png" alt="picture"/>                    
                    <span class="fs-5 fw-semibold" style="color:black; margin-left:10px">Imagenes</span>
                    <span class="fs-5 fw-semibold" style="margin-left:300px" id="result"> </span>
                </a>
            </div>
            <form enctype="multipart/form-data" id="formulario" method="post">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5" id="imgs"> 
                </div>
            </form>
        </div>

    <?php
}

// MODAL CREAR DIRECTORIO ( + )
if($_POST['accion'] == 1){
    ?>
        <label class="form-label" >Selecciona una fecha:</label>
        <input type="date" id="fechaCarpeta" class="form-control mb-3">
    <?php
}

// AGREGAR IMAGENES
if($_POST['accion'] == 2){
    $fecha = $_POST['fecha'];
    $var = 0;
    $sql = mysql_query("SELECT * FROM juramentos WHERE fecha = '$fecha' ",$link);
    $row = mysql_fetch_row($sql);

    $ruta = "https://www.pjudvaldivia.cl/tribunales/cavaldivia/juramentos/";
    $nombreCarpeta = $fecha;
    $rutaCompleta = $ruta . $nombreCarpeta;

    if ($row[1] !== $fecha) {

        ?>
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary container-fluid" style="width: 100%;">
            <div class="row" style="background-color:#EAEAEA">
                <div class="col-6">
                    <a>
                        <span class="fs-5 fw-semibold" style="color:black">Carpeta: <?php echo $fecha ?></span>
                    </a>
                </div>
                <div class="col-6" style="text-align:right">
                    <button type="button" class="btn btn-success btn-sm " onclick="modalConfirmar('<?php echo $fecha ?>')">Crear Carpeta</button>
                </div>
            </div>
            
        </div>  
        <?php

        ?>
        <form enctype="multipart/form-data" id="formulario" method="post" class="">
        <?php
        while($var <= 20){
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <div id="">
                            <svg id="" class="bd-placeholder-img card-img-top" >
                                <rect id="text-<?php echo $var ?>" width="100%" height="100%" fill="#55595c"></rect>
                                <text  x="37%" y="50%" fill="#eceeef" dy=".3em">Imagen (<?php echo $var ?>)</text> 
                                <image id="preview-<?php echo $var ?>" x="0" y="0" width="100%"  xlink:href="" />
                            </svg>
                        </div>
                        <div class="card-body">
                            <p>
                                <div style="text-align: center">
                                    <?php
                                        if ($var == 0){
                                            ?>
                                                <input type="text" id="<?php echo $var ?>" name="nombre-<?php echo $var ?>" class="form-control mb-3" style="display:none">
                                            <?php
                                        }else{
                                            ?>
                                                <label class="form-label" >Nombre:</label>
                                                <input type="text" id="<?php echo $var ?>" name="nombre-<?php echo $var ?>" class="form-control form-control-sm  mb-3" style="background-color: #D8D8D8">
                                            <?php
                                        }
                                    ?>
                                    <label class="form-label">Selecciona una imagen:</label>
                                    <input type="file" id="file-<?php echo $var ?>" name="file-<?php echo $var ?>" accept="image/*" class="form-control form-control-sm mb-3" style="background-color: #D8D8D8" onchange="previewImage('<?php echo $var ?>')">
                                </div>  
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            $var++;
        }
        ?>
        </form>
        <?php
    } else {
        echo "<h5 style='color:red'> La carpeta seleccionada ya existe. </h5>";
    } 
}

// CREAR CARPETA / AGREGAR IMAGENES A CARPETA
if($_POST['accion'] == 3){
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

    $nombres = array();
    $imgs = array();
    $imgTemps = array();

    $var = 0;
    while($var <= 20){
        $nombres[] = isset($_POST['nombre-' . $var]) ? $_POST['nombre-' . $var] : '';
        $imgs[] = $_FILES['file-' . $var]['name'];
        $imgTemps[] = $_FILES['file-' . $var]['tmp_name'] ;
        $var++;
    }

    $ruta = "../cavaldivia/juramentos/" . $fecha;
    //$ruta = "https://www.pjudvaldivia.cl/tribunales/cavaldivia/juramentos/" . $fecha;

    echo $ruta;

    if (mkdir($ruta, 0777, true)) {
        echo "Carpeta creada!";
        $carpeta_destino = "../cavaldivia/juramentos/" . $fecha . "/";
        //$carpeta_destino = "https://www.pjudvaldivia.cl/tribunales/cavaldivia/juramentos/" . $fecha . "/";

        $i = 0;
        while($i <= 20){
            $new_name = $i . '.jpg';
            $ruta_d = $carpeta_destino . $new_name;
            $ruta_bd = $fecha . "/" . $new_name; 

            if (!empty($imgs[$i])){
                if (move_uploaded_file($imgTemps[$i], $ruta_d)) {
                    $sql = mysql_query("SELECT MAX(id) as id FROM juramentos",$link);
                    $row = mysql_fetch_array($sql);
                    $n_id = $row[0] + 1 ;  
                    $query = mysql_query("INSERT INTO juramentos VALUES('$n_id', '$fecha', '$nombres[$i]', '$ruta_bd' )",$link);
                    echo "<h5> Imagenes Agregadas!. </h5>";            
                } else {
                    echo "Error al subir la imagen!";
                }; 
            }else{

            }
            $i++;
        }
         
    } else {
        echo "Error al crear la carpeta";
    }
}

// MOSTRAR IMAGENES
if($_POST['accion'] == 4){
    $var = 0;
    $fecha = $_POST['carpeta'];

    $directorio = "https://www.pjudvaldivia.cl/tribunales/cavaldivia/juramentos/";
    $directorio2 = "http://localhost:8080/ica/tribunales/cavaldivia/juramentos/";

    ?>
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary container-fluid" style="width: 100%;">
            <div class="row" style="background-color:#EAEAEA">
                <div class="col-6">
                    <a>
                        <span class="fs-5 fw-semibold" style="color:black">Carpeta: <?php echo $fecha ?></span>
                    </a>
                </div>
            </div>
            
        </div>  
    <?php


    $sql = mysql_query("SELECT nombre, ruta FROM juramentos WHERE fecha = '$fecha' " ,$link);

    $juramentos = array();

    while($row = mysql_fetch_row($sql)){
        $juramentos[] = array($row[0],$row[1]);
    }

    foreach ($juramentos as $juramento){
        $ruta = $directorio . $juramento[1];
        //$ruta = $directorio2 . $juramento[1]; 
        ?>
            <div class="col">
                <div class="card shadow-sm">

                    <div onclick="modalImg('<?php echo $ruta ?>', '<?php echo $juramento[0] ?>')">

                        <svg class="bd-placeholder-img card-img-top" style="cursor: pointer;" >
                            <image style="object-fit:cover" x="-28" y="0" width="120%" href="<?php echo $ruta ?>"/>
                        </svg>
                        
                    </div>
                    <?php
                        if($juramento[0] != "" || $juramento[0] != null ){
                            ?>
                                <div class="card-body">
                                    <p style="text-align:center; font-size:17px; margin: 0" ><?php echo $juramento[0] ?></p>
                                </div>
                            <?php
                        } else{

                        }
                    ?>
                </div>
            </div>    
        <?php
    }
    
}

// MODAL IMAGEN
if($_POST['accion'] == 5){
    $img = $_POST['img'];
    $nombre = $_POST['nombre'];
    ?>
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <image src="<?php echo $img ?>" height="100%"  width="100%" class="img-fluid" alt="Imagen">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h4><?php echo $nombre; ?></h4>
                </div>
            </div>
        </div>
        
    <?php
}

// MODAL CONFIRMACIÓN
if($_POST['accion'] == 6){
    $fecha = $_POST['fecha'];
    ?>
      <div class="container-fluid">
          <div class="row">
              <div class="col-7" style="text-align: right" >
              </div>
              <div class="col-5" style="text-align: right" >
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal" onclick="agregarDatos('<?php echo $fecha ?>')">Confirmar</button>
              </div>
          </div>
      </div>
    <?php
}

?>