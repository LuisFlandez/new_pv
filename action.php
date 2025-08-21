<?php
include ("conecta.php");
function fechaCastellano ($fecha) 
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes;
  }
/*
function digitadores (){
    $mes=date('m');

    if($mes == '01'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56961773682" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '02'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '03'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '04'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '05'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '06'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '07'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '08'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '09'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '10'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '11'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
    if($mes == '12'){
        ?>
        <div class="col-sm-6">
            <a href="https://wa.me/56977244582" class="btn btn-success btn-block">
                <i class="fa fa-whatsapp"></i>
                Primera Sala
            </a>
        </div>
        <div class="col-sm-6">
            <a href="https://wa.me/56977246515" class="btn btn-success btn-block">
            
                <i class="fa fa-whatsapp"></i>
                Segunda Sala
            </a>
        </div>
        <?php
    }
}


if ($_POST['accion'] == '1') {
?>
<div class="row">                    
<?php digitadores();?>
</div>
<?php
}
*/
if ($_POST['accion'] == '2') {
    ?>

    <div class="card">
    <div class="card-header">
        Tipos de atención de publico
    </div>
        <div class="card-body">
            <h5 class="card-title">Central telefónica</h5>
            <p class="card-text">
            1.	Estados de sus causas <br>
            2.	Nombramientos <br>
            3.	Proceso de entrega de cheques.<br>
            4.	Correos para presentar recursos.<br>
            5.	OJV.<br>
            </p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="tel:56963639110" class="btn btn-primary btn-block">
                            <i class="fa fa-phone"></i>
                            Llamar a mesa central +56 632266400
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="tel:56963639110" class="btn btn-primary btn-block">
                            <i class="fa fa-phone"></i>
                            Llamar a mesa central +56 9 63639110
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <h5 class="card-title">Atención por plataforma Zoom </h5>
            <p class="card-text">
            <b>Atención de abogados:</b><br> 
            1.	Funcionamiento de Sala Virtual (forma en que comunican turno de alegato, forma de anunciarse, conocer resultado, etc.)<br>
            2.	Tiempo de tramitación de  causas, tiempo demoran en resolver.<br>
            3.	Coordinación de alegatos al tener causas en Salas distintas. <br>
            <br>
            <b>Atención de usuarios:</b><br>
            1.	Estados de sus causas.<br>
            2.	Nombramientos.<br>
            3.	Proceso de entrega de cheques.<br>
            4.	Correos para presentar recursos.<br>
            5.	OJV.<br>
            </p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="https://zoom.us/j/99596962879" target="_blank" class="btn btn-primary btn-block" >
                            <i class="fa fa-play"></i>
                            Atención de publico virtual (Zoom)
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
       
        
        <hr>
        <div class="card-body">
            <h5 class="card-title">Secretario</h5>
            <p class="card-text">
            Atención de abogados y usuarios institucionales:<br>
            1.	Autorización de patrocinio y poder. (Hasta las 16:00 horas)<br>
            2.	Causas agregadas penales 149 del Código Procesal Penal.<br>
            3.	Amparos.<br>
            </p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="https://wa.me/56977061446" class="btn btn-success btn-block">
                                <i class="fa fa-whatsapp"></i>
                                Atención a través de Whatsapp.
                            </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="tel:56977061446" class="btn btn-primary btn-block">
                                <i class="fa fa-phone"></i>
                               LLamado +569 77061446
                            </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

           
<?php
}
if ($_POST['accion'] == '3') {

    $query=mysql_query("SELECT * FROM validacion_abogados WHERE rut = '".$_POST['rut']."' ", $link); 

    if(mysql_num_rows($query) == 0){
        ?>
        <div class="col-md-4">
            <img src="images/no-validado.png" class="card-img" alt="..." >
        </div>
        <div class="col-md-8">
            <div class="card-body" >
                <h5 class="card-title">No existen datos asociados al rut</h5>
                <p class="card-text">No existe validación de identidad al rut ingresado.</p>
                
            </div>
        </div>
        <?php
    }else{
        $row=mysql_fetch_row($query);
        $actual = date('Y-m-d');
        if ($actual <= $row[6]) {
            ?>
            <div class="col-md-4">
                <img src="images/validado.png" class="card-img" alt="..." >
            </div>
            <div class="col-md-8">
                <div class="card-body" style='background-image: url("images/corte_fondo.png");'>
                    <h5 class="card-title"><?php echo $row[1]?></h5>
                    <p class="card-text">Identidad validada correctamente, desde el <?php echo $row[5]?> hasta el <?php echo $row[6]?></p>
                    <?php 
                    if ($row[2] != "") {
                        ?>
                        <p class="card-text">Correo de contacto: <?php echo $row[2]?></p>
                        <?php
                    }
                    ?>
                    
                    <p class="card-text text-center mt-5"><small class="text-muted">Validado por la unidad de atención de publico.<br>Ilustrisima Corte de Apelaciones de Valdivia</small></p>
                    
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="col-md-4">
                <img src="images/no-validado.png" class="card-img" alt="..." >
            </div>
            <div class="col-md-8">
                <div class="card-body" >
                    
                    <h5 class="card-title">Validación caducada</h5>
                    <p class="card-text mb-5">Sr/Sra <?php echo $row[1];?> su validación de identidad se encuentra caducada, por favor realice el proceso de validación nuevamente.</p>
                    <p class="card-text">Caducada el: <?php echo $row[6];?></p>

                </div>
            </div>
            <?php
        }
        
    }
    
}
if ($_POST['accion'] == '4') {
    ?>
    

    <?php
}
if ($_POST['accion'] == '5') {
?>
<div class="card-body">
    <p class="card-text">En Antecedente de Pleno Rol 185-2020,
         el Tribunal Pleno ordena la publicación en la página web 
         de esta Corte de Apelaciones, los medios tecnológicos 
         de los Juzgados de Policía Local de la Jurisdicción, los 
         que se valdrán para practicar las notificaciones electrónicas
          a que se refiere el artículo 18 de la Ley N° 18.287.</p>
    <div class="text-center"><a href="pleno-185-2020.pdf" target="_black" class="btn btn-danger">Ver acuerdo de pleno</a></div>
</div>

    <table class="table table-hover table-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Tribunal</th>
            <th scope="col">Contacto</th>
            <th scope="col">Juez</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            
            <td>1º Juzgado de Policía Local Valdivia </td>
            <td>jpl1valdivia@munivaldivia.cl</td>
            <td>Sr. Pablo Andrés Castro Jara</td>
        </tr>
        <tr>
            
            <td>2º Juzgado de Policía Local Valdivia  </td>
            <td>jpl2@munivaldivia.cl</td>
            <td>Sr. Alejandro Marcelo Navarrete Arriagada</td>
        </tr>
        <tr>
            
            <td>Juzgado de Policía Local  de Futrono</td>
            <td>jpl.futrono@hotmail.com</td>
            <td>Sr. Helmuth Juan Steuer Stehn</td>
        </tr>
        <tr>
            
            <td>Juzgado de Policía Local de La Unión</td>
            <td>juzgado@munilaunion.cl</td>
            <td>Sr. Abel Hernán Nejaz Mendoza</td>
        </tr>
        <tr>
            
            <td>Juzgado de Policía Local de Lanco</td>
            <td>jpl@munilanco.cl</td>
            <td>Sra. Oriana del Pilar García Parra</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local Los Lagos</td>
            <td><!--jpl@muniloslagos.cl --> jpl.loslagos@gmail.com</td>
            <td>Sr. Juan Sergio Quintana Ojeda</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Paillaco</td>
            <td>notificacionesjpl@munipaillaco.cl</td>
            <td>Sr. Alfredo  Bonvallet  Rivera</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Panguipulli</td>
            <td>jpl@municipalidadpanguipulli.cl<br>notificacionesjpl@municipalidadpanguipulli.cl</td>
            <td>Sr. Patricio Thomas Soto</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Lago Ranco</td>
            <td>notificacionesjpl.lagoranco@gmail.com</td>
            <td>Sr. Jaime Alfredo Cortes Chavez</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Río Bueno</td>
            <td>jplriobueno1@gmail.com</td>
            <td>Sr. Roberto Bernabé Cano Cano</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Mariquina</td>
            <td>juzgado@munimariquina.cl</td>
            <td>Sra. Sandra Basso Vásquez</td>
        </tr>
        <tr>
            <td>1º Juzgado de Policía Local Osorno</td>
            <td>notificaciones.primerjplosorno@imo.cl</td>
            <td>Sr. Max Roberto Sotomayor Necul</td>
        </tr>
        <tr>
            <td>2º Juzgado de Policía Local Osorno</td>
            <td>notificaciones.segundojplosorno@imo.cl</td>
            <td>Sr. Hipolito Francisco Barrientos Ortega</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local Puerto Octay</td>
            <td><!--jploctay@hotmail.cl-->jploctay@gmail.com</td>
            <td>VACANTE</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Purranque</td>
            <td>notificacionesjpl@purranque.cl</td>
            <td>Sr. Pablo Casanova Sáez</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Puyehue</td>
            <td>jpl@puyehuechile.cl</td>
            <td>Sr. Ignacio Claudio Sierpe Scheuch</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de Río Negro</td>
            <td>juzgado@rionegrochile.cl</td>
            <td>Sra. Isabel Mónica Gantz Margulis</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de San Juan de la Costa</td>
            <td>notificacionesjplsanjuan@gmail.com</td>
            <td>Sra. Marianela Alarcon Valenzuela</td>
        </tr>
        <tr>
            <td>Juzgado de Policía Local de San Pablo</td>
            <td>juzgado@sanpablo.cl</td>
            <td>Sr. Juan Carlos Alt Hayal</td>
        </tr>
    </tbody>
    </table>
    <?php
    }
    ?>
    <?php
    if ($_POST['accion'] == '6') {
?>
            

       
<?php

}
?>

<?php
    if ($_POST['accion'] == '7') {
?>
    <?php 
     $query = "SELECT * FROM documentos WHERE tipo = 1";
     $result = mysql_query($query, $link);
     if ($result) {
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_row($result)){ 
                $numero = $row[0];
                $fecha = $row[1];
                $enlace = "../admin/" . $row[2] ;
                    ?>
                <a href="<?php echo $enlace;?>" target="_blank" class="btn btn-secondary btn-block btn-lg">
                <i class="fa fa-info"></i>
                    - Edicto <?php echo $numero?>
                <h6 class="text-warning">Actualizado el <?php echo $fecha ?></h6>
                </a> 
                <?php     
            }   
        }
    }
    ?>
    
   
<?php

}if ($_POST['accion'] == '8') {

    
}
if ($_POST['accion'] == '9') {

 
    $rut = $_POST['rut'];
    $query=mysql_query("SELECT * FROM costas_isapre WHERE rut = '$rut' ", $link); 

    if(mysql_num_rows($query) == 0)
    {
        ?>
        <h4>No existen datos</h4>
        <?php

    }else{
    ?>
    <h4>Resultado busqueda</h4>
    <table class="table table-sm table-hover table-responsive">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Rut</th>
            <th scope="col">Litigante</th>
            <th scope="col">Rol</th>
            <th scope="col">Caratulado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            while($row=mysql_fetch_row($query))
            {
                ?>
                <tr>
                    <td><?php echo $row[0]?></td>
                    <td><?php echo $row[1]?></td>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[3]?></td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
    <br>
    <div class="card">
        <div class="card-header">
        Consultados los registros de esta corte, usted cuenta con saldo por concepto de costas por cobrar. Puede dirigirse al enlace indicado más abajo para solicitar transferencia de los mismos a su cuenta bancaria.
        </div>
        <div class="card-body">
            <h5 class="card-title">Acceso de Solicitud de giro por Transferencia Electrónica</h5>
            <p class="card-text">Este acceso permite solicitar que se efectúe mediante transferencia electrónica y directamente a la cuenta que se indique, el depósito consignado por concepto de costas isapre.</p>
            
            <p class="card-text">Requisitos: tenga a mano su cédula de identidad.</p>
            <br>
            <a href="https://ojv.pjud.cl/kpitec-ojv-web/views/login_ci.html#login_box" target="_blank" class="btn btn-primary">Entrar aquí a tramite fácil</a>
        </div>
        <div class="card-footer">
            En caso de dificultad, acceder a manual <a target="_blank" href="adjuntos/manual_tramite_facil.pdf">aquí</a>.
        </div>
    </div>
        <?php
     }
}

//Reajuste cuantias
if ($_POST['accion'] == '10') { 
    //$query = "SELECT * FROM documentos WHERE tipo = 2 AND fecha_subida <= CURRENT_DATE() <= fecha2";
   
    $fechaActual = date('Y-m-d');
    $query = "SELECT * FROM documentos WHERE tipo = 2  AND '$fechaActual' BETWEEN fecha1 AND fecha2";
    $result = mysql_query($query, $link);

    if ($result) {
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_row($result)){
                $enlace = "../admin/" . $row[2] ;
                ?>
                <div class="row mt-2">
                    <div class="col-sm-8 text-center align-self-center">
                    <table class="table" style="border-collapse: collapse">
                            <tbody>
                                <tr>
                                    <td><h6><?php echo $row[5];?></h6></td>
                                    <td><p>Visible hasta: <?php echo fechaCastellano($row[7]); ?></p></td>
                                </tr>
                            </tbody>
                        </table>         
                    </div>
                    <div class="col-sm-4 text-center"> 
                    <table class="table" style="border-collapse: collapse">
                            <tbody>
                                <tr>
                                    <td><a href="<?php echo $enlace;?>" class="btn btn-danger btn-sm shadow"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ver Acta</a></td>
                                </tr>
                            </tbody>
                        </table>      
                            
                    </div>
                 </div>   
                <?php
            }   
        } else {
            echo "No se encontró ningún enlace del tipo 2.";
        }
    } else {
        echo "Error en la consulta: " . mysql_error();
    }
}

//Edictos
if ($_POST['accion'] == '11') { 
    $fechaActual = date('Y-m-d');
    $query = "SELECT * FROM documentos WHERE tipo = 1  AND '$fechaActual' BETWEEN fecha1 AND fecha2";
    $result = mysql_query($query, $link);

    if ($result) {
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_row($result)){

                $enlace = "../admin/" . $row[2] ;
                ?> <div class="row mt-3">
                        <div class="col-sm-6 text-center align-self-center">
                            <h6><?php echo $row[5];?></h6>
                        </div>
                        <div class="col-sm-4 text-center align-self-center">   
                            <p>Visible hasta: <?php echo fechaCastellano($row[7]); ?></p>
                        </div>
                        <div class="col-sm-2 text-center">  
                            <a href="<?php echo $enlace;?>" class="btn btn-danger btn-sm shadow w-100"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ver edicto</a>
                        </div>
                    </div>  
                    <hr class="m-1">  
                <?php
            } 
        } else {
            echo "No se encontró ningún enlace del tipo 1.";
        }
    } else {
        echo "Error en la consulta: " . mysql_error();
    }
}

//Acuerdos de Pleno
if ($_POST['accion'] == '12') { 

    $fechaActual = date('Y-m-d');
    $query = "SELECT * FROM documentos WHERE tipo = 3  AND '$fechaActual' BETWEEN fecha1 AND fecha2";
    $result = mysql_query($query, $link);

    if ($result) {
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_row($result)){
                $nombre = $row[5];
                $enlace = "../admin/" . $row[2] ;
                ?>
                <div class="row mt-3">
                        <div class="col-sm-6 text-center align-self-center">
                            <h6><?php echo $nombre ?></h6>
                        </div>
                        <div class="col-sm-4 text-center align-self-center">   
                            <p>Visible hasta: <?php echo fechaCastellano($row[7]); ?></p>
                        </div>
                        <div class="col-sm-2 text-center">  
                            <a href="<?php echo $enlace;?>" class="btn btn-danger btn-sm shadow w-100"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ver edicto</a>
                        </div>
                    </div>  
                    <hr class="m-1">  

                <?php
            } 
        } else {
            echo "No se encontró ningún enlace del tipo 3.";
        }
    } else {
        echo "Error en la consulta: " . mysql_error();
    }
}








?>


