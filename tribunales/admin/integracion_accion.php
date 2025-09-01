<?php

include("conecta.php");

// TABLA INTEGRACIÓN
if($_POST['accion'] == 0){

    $martes = $_POST['dia2'];
    $miercoles = $_POST['dia3'];
    $jueves = $_POST['dia4'];
    $viernes = $_POST['dia5'];
    $rango1 = $_POST['rango1'];
    $rango2 = $_POST['rango2'];

    $d1 = date('d', strtotime($rango1));
    $d2 = date('d', strtotime($martes));
    $d3 = date('d', strtotime($miercoles)); 
    $d4 = date('d', strtotime($jueves));
    $d5 = date('d', strtotime($viernes));
    $d6 = date('d', strtotime($rango2));

    $array_dias = array($rango1, $martes, $miercoles, $jueves, $viernes, $rango2);

    $array_conf[0] = ""; 
    $sql1 = mysql_query("SELECT fecha FROM tabla_confirma WHERE fecha BETWEEN '$rango1' AND '$rango2' ", $link);

    while (($row = mysql_fetch_row($sql1))){
        $array_conf[$row[0]] = $row[0]; 
    }
    //echo "<pre>";
    //print_r($array_conf);
    //echo "</pre>";

    $sql = mysql_query("SELECT posicion, fecha, rut, sala FROM salas WHERE fecha BETWEEN '$rango1' AND '$rango2' ", $link);

    $sql3 = mysql_query("SELECT * FROM user", $link);

    $sala1 = array();
    $sala2 = array();
    $sala3 = array();
    $sala4 = array();
    $personas = array();

    while (($row = mysql_fetch_row($sql))){
        if ($row[3] == '1') {
            $sala1[] = array($row[0],$row[1],$row[2]);
        }
        if ($row[3] == '2') {
            $sala2[] = array($row[0],$row[1],$row[2]);
        }
        if ($row[3] == '3') {
            $sala3[] = array($row[0],$row[1],$row[2]);
        }
        if ($row[3] == '4') {
            $sala4[] = array($row[0],$row[1],$row[2]);
        }
    }

    while (($row = mysql_fetch_row($sql3))){
        $personas[$row[0]] = array($row[1],$row[2],$row[4]);
    }

    ?>  
        <div class="col-12">
            <table class="table" style='border: 3px solid #ccc'>
                <thead>   
                    <?php
                        $var = 1;
                        $cont = 0;
                        while($var <= 1){

                            echo "<tr>";
                                ?>
                                    <th class="text-right ">
                                        <p class="my-2">Presidente de la Corte:</p>
                                    </th>
                                <?php

                            foreach($array_dias as $dias){

                                if (isset($array_conf[$dias])) { // COLOR CONFIRMACIÓN 
                                    $color = '#B9FFB9';
                                    $cod = 1;
                                }else{
                                    $color = '#FFD0D0';
                                    $cod = 0;
                                }
                                
                                foreach($sala3 as $sala){

                                    if ($var == $sala[0] && $dias == $sala[1]) {    
                                        if ($personas[$sala[2]][2] == 0){ // TITULAR
                                            if ($cod == 0) {
                                                ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?>">
                                                    <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(3, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?> (T) </button> 
                                                </td>
                                                <?php
                                            }
                                            if ($cod == 1) {
                                                ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?> " >
                                                    <button  class="btn btn-dark btn-sm" ><?php echo $personas[$sala[2]][0]?> (T)</button> 
                                                </td>
                                                <?php
                                            }
                                            $cont = 1;
                                        }
                                        if ($personas[$sala[2]][2] == 2){ // SUBROGANTE
                                            if ($cod == 0) {
                                                ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?>">
                                                    <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(3, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?> (S)</button> 
                                                </td>
                                                <?php
                                            }
                                            if ($cod == 1) { 
                                                ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?> " >
                                                    <button  class="btn btn-dark btn-sm" ><?php echo $personas[$sala[2]][0]?> (S)</button> 
                                                </td>
                                                <?php
                                            }                                       
                                            $cont = 1;
                                        }   
                                    }
                                }

                                if ($cont == 0) {
                                    if ($cod == 0){
                                        ?>
                                            <td class="text-center" style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(3, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >+</button> 
                                            </td>
                                        <?php
                                    }
                                    if ($cod == 1){
                                        ?>
                                            <td class="text-center" style="background-color: <?php echo $color;?>"> 
          
                                            </td>
                                        <?php
                                    }   
                                }
                                $cont = 0;
                            }  
                            $var = $var + 1;
                            echo "</tr>";
                        }
                    ?>
                     <?php
                        $var = 1;
                        $cont = 0;
                        while($var <= 1){
                            echo "<tr style='border: 3px solid #ccc'>";
                                ?>
                                    <th class="text-right ">
                                        <p class="my-2">Secretario:</p>
                                    </th>
                                <?php
                            foreach($array_dias as $dias){
                                if (isset($array_conf[$dias])) {
                                    $color = '#B9FFB9';
                                    $cod = 1;
                                }else{
                                    $color = '#FFD0D0'; 
                                    $cod = 0;
                                }
                                foreach($sala4 as $sala){

                                    if ($var == $sala[0] && $dias == $sala[1]) {
                                        if ($personas[$sala[2]][2] == 6){
                                            if ($cod == 0) {
                                                ?>
                                                    <td class="text-center" style="background-color: <?php echo $color;?>">
                                                        <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(4, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?> (T)</button> 
                                                    </td>
                                                <?php
                                            }
                                            if ($cod == 1) {
                                                ?>
                                                    <td class="text-center" style="background-color: <?php echo $color;?>">
                                                        <button  class="btn btn-dark btn-sm"><?php echo $personas[$sala[2]][0]?> (T) </button> 
                                                    </td>
                                                <?php
                                            }
                                            $cont = 1;
                                        }
                                        if ($personas[$sala[2]][2] == 7){
                                            if ($cod == 0) {
                                                ?>
                                                    <td class="text-center" style="background-color: <?php echo $color;?>">
                                                        <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(4, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?> (S)</button> 
                                                    </td>
                                                <?php
                                            }
                                            if ($cod == 1) {
                                                ?>
                                                    <td class="text-center" style="background-color: <?php echo $color;?>">
                                                        <button  class="btn btn-dark btn-sm"><?php echo $personas[$sala[2]][0]?> (S) </button> 
                                                    </td>
                                                <?php
                                            }
                                            $cont = 1;
                                        }    
                                    }
                                }
                                if ($cont == 0) {
                                    if ($cod == 0){
                                        ?>
                                            <td class="text-center" style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(4, '1', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >+</button> 
                                            </td>
                                        <?php
                                    }
                                    if ($cod == 1){
                                        ?>
                                            <td class="text-center" style="background-color: <?php echo $color;?>"> 

                                            </td>
                                        <?php
                                    }
                                }
                                $cont = 0;
                            }
                            $var = $var + 1;
                            echo "</tr>";
                        }
                    ?> 
                    <tr style='border: 3px solid #ccc;  background-color: #D3D3D3'>
                        <th class="text-center" scope="col" colspan="7" width="200px">PRIMERA SALA</th>
                    </tr>
                    <tr style='border: 3px solid #ccc; background-color: #B6B6B6'>
                        <th class="text-center" scope="col" width="200px"></th>
                        <th class="text-center" scope="col" width="200px"> <button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $rango1 ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Lunes <?php echo $d1 ?> </b></button></th>
                        <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $martes ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Martes <?php echo $d2 ?> </b></button></th>
                        <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $miercoles ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Miercoles <?php echo $d3 ?> </b></button></th>
                        <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $jueves ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Jueves <?php echo $d4 ?> </b></button></th>
                        <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $viernes ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Viernes <?php echo $d5 ?> </b></button></th>
                        <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $rango2 ?>', '1', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Sabado <?php echo $d6 ?> </b></button></th>
                    </tr>
                </thead>
                <tbody>  
                    <?php
                        $var = 1;
                        $cont = 0;
                        while($var <= 5){
                            echo "<tr>";
                            if ($var == 1) {
                                ?>
                                <th class="text-right ">
                                <p class="my-2">Presidente de Sala:</p>
                                </th>
                                <?php
                            }
                            if($var == 2 || $var == 3 || $var == 4 ){
                                ?>
                                <th class="text-right">
                                    <p class="my-2"></p>
                                </th>
                                <?php
                            }
                            if($var == 5){
                                ?>
                                <th class="text-right">
                                    <p class="my-2">Relator(a):</p>
                                </th>
                                <?php
                            }
                            
                            foreach($array_dias as $dias){

                                if (isset($array_conf[$dias])) {
                                $color = '#B9FFB9';
                                $cod = 1;
                                }else{
                                    $color = '#FFD0D0';
                                    $cod = 0;
                                }

                                foreach($sala1 as $sala){

                                    if ($var == $sala[0] && $dias == $sala[1]) {
                                        if($cod == 0){
                                            ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?>" >
                                                    <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(1, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?></button> 
                                                </td>
                                            <?php
                                        }
                                        if($cod == 1){
                                            ?>
                                                <td class="text-center" style="background-color: <?php echo $color;?>" >
                                                    <button class="btn btn-dark btn-sm" ><?php echo $personas[$sala[2]][0]?></button> 
                                                </td>
                                            <?php
                                        }
                                        $cont = 1;
                                    }

                                }

                                if ($cont == 0) {
                                    if ($cod == 0){
                                        if ($var == 4){
                                            ?>
                                            <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(1, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >(Opcional)</button> 
                                            </td>
                                            <?php
                                        }else{
                                            ?>
                                            <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(1, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >+</button> 
                                            </td>
                                            <?php
                                        }
                                    }
                                    if ($cod == 1){
                                        ?>
                                            <td class="text-center" style="background-color: <?php echo $color;?>"> </td>
                                        <?php
                                    }  
                                }
                                $cont = 0;
                            }
                            $var = $var + 1;
                            echo "</tr>";
                        }
                    ?>
                    <tr style='border: 3px solid #ccc; background-color: #D3D3D3 '>
                        <th class="text-center" scope="col" colspan="7" width="200px">SEGUNDA SALA</th>
                    </tr>
                    <tr style="border: 3px solid #ccc; background-color: #B6B6B6" >
                    <th class="text-center" scope="col" width="200px"></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $rango1 ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Lunes <?php echo $d1 ?> </b></button></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $martes ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Martes <?php echo $d2 ?> </b></button></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $miercoles ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Miercoles <?php echo $d3 ?> </b></button></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $jueves ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Jueves <?php echo $d4 ?> </b></button></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $viernes ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Viernes <?php echo $d5 ?> </b></button></th>
                    <th class="text-center" scope="col" width="200px"><button data-toggle="modal" data-target="#modal_detalle" class="btn btn-outline-dark" onclick="enviarPosicionD('<?php echo $rango2 ?>', '2', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>', '1')" ><b>Sabado <?php echo $d6 ?> </b></button></th>
                    </tr>             

                    <?php
                        $var = 1;
                        $cont = 0;
                        while($var <= 5){
                            echo "<tr >";
                            if ($var == 1) {
                                ?>
                                <th class="text-right ">
                                <p class="my-2">Presidente de Sala:</p>
                                </th>
                                <?php
                            }
                            if($var == 2 || $var == 3 || $var == 4 ){
                                ?>
                                <th class="text-right">
                                    <p class="my-2"></p>
                                </th>
                                <?php
                            }
                            if($var == 5){
                                ?>
                                <th class="text-right">
                                    <p class="my-2">Relator(a):</p>
                                </th>
                                <?php
                            }
                            
                            foreach($array_dias as $dias){
                                if (isset($array_conf[$dias])) {
                                    $color = '#B9FFB9';
                                    $cod = 1;
                                }else{
                                    $color = '#FFD0D0';
                                    $cod = 0;
                                }
                                foreach($sala2 as $sala){
                                    if ($var == $sala[0] && $dias == $sala[1]) {
                                        if ($cod == 0){
                                            ?>
                                                <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                    <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-dark btn-sm" onclick="enviarPosicion(2, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" ><?php echo $personas[$sala[2]][0]?></button> 
                                                </td>
                                            <?php  
                                        }
                                        if ($cod == 1){
                                            ?>
                                                <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                    <button class="btn btn-dark btn-sm"  ><?php echo $personas[$sala[2]][0]?></button> 
                                                </td>
                                            <?php
                                        }
                                        
                                        $cont = 1;
                                    }
                                }
                                if ($cont == 0) {
                                    if ($cod == 0){
                                        if ($var == 4){
                                            ?>
                                            <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(2, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >(Opcional)</button> 
                                            </td>
                                            <?php
                                        }else{
                                            ?>
                                            <td class="text-center " style="background-color: <?php echo $color;?>"> 
                                                <button data-toggle="modal" data-target="#modal_agregar" class="btn btn-danger btn-sm" onclick="enviarPosicion(2, '<?php echo $var; ?>', '<?php echo $dias ?>', '<?php echo $rango1 ?>', '<?php echo $rango2 ?>')" >+</button> 
                                            </td>
                                            <?php
                                        }

                                        $conf = 1;
                                    }
                                    if ($cod == 1){
                                        ?>
                                            <td class="text-center " style="background-color: <?php echo $color;?>"> </td>
                                        <?php
                                    }
                                }
                                $cont = 0;
                            }
                            $var = $var + 1;
                            echo "</tr>";
                        }
                    ?>
                    <?php
                        echo "<tr style='background-color: #ADADAD' >";
                            ?>
                            <th class="text-right ">
                            <p class="my-2"></p>
                            </th>
                            <?php
                            foreach($array_dias as $dias){
                                if (isset($array_conf[$dias])) {
                                        ?>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm" onclick="desconfirmar('<?php echo $dias ?>')" > Desconfirmar </button> 
                                        </td>
                                        <?php
                                }else{
                                ?>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" onclick="confirmar('<?php echo $dias ?>')" > Confirmar </button>   
                                    </td>
                                <?php                                           
                                }
                            }    
                        echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>
    <?php

}

// MODAL INTEGRACIÓN
if($_POST['accion'] == 1){

    $sala = $_POST['sala'];
    $posicion = $_POST['posicion'];
    $fecha = $_POST['fecha'];
    $r1 = $_POST['r1'];
    $r2 = $_POST['r2'];
    $pos = $_POST['pos'];
    
    if (($sala == '1' || $sala == '2') &&  ($posicion == '1' ||  $posicion == '2' || $posicion == '3' || $posicion == '4' )){
        $u = 'm';
    }
    if (($sala == '1' || $sala == '2') &&  $posicion == '5') {
        $u = 'r';
    }
    if ($sala == '3'){ 
        $u ='p';
    }
    if ($sala == '4'){
        $u = 's';
    }

    if ($sala == '1'){
        $c = 1;
    }
    if ($sala == '2'){
        $c = 2;
    }
    if ($sala == '3' || $sala == '4'){
        $c = 3;
    }
    
    $sql = mysql_query("SELECT * FROM user", $link);
    $sql_e = mysql_query("SELECT * FROM salas WHERE fecha ='$fecha' AND sala = '$sala' AND posicion = '$posicion' ", $link); //Quitar Usuario (Consulta para saber si usuario se encuentra en la posición seleccionada)
    $sql_c = mysql_query("SELECT * FROM comentario WHERE fecha = '$fecha' ", $link);

    $usuarioM = array();
    $usuarioP = array();
    $usuarioA = array();
    $usuarioF = array();
    $usuarioR = array();
    $usuarioS = array();
    $usuarioO = array();

    $comentario = array();

    while ($row = mysql_fetch_row($sql)){
        if ($row[4] == 0){ //PRESIDENTE
            $usuarioP[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 2){ //MINISTRO
            $usuarioM[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 3){ //ABOGADOS
            $usuarioA[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 4){ //RELATOR
            $usuarioR[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 5){ //FISCALES
            $usuarioF[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 6){ //SECRETARIO
            $usuarioS[] = array($row[0],$row[1]); 
        }
        if ($row[4] == 7){ //OFICIAL PRIMERO
            $usuarioO[] = array($row[0],$row[1]); 
        }
    }

    while ($row = mysql_fetch_row($sql_c)){
        if ($row[2] == 1 && $c == 1){
            $comentario[] = array($row[0],$row[1],$row[3],$row[4]);
        }
        if ($row[2] == 2 && $c == 2){
            $comentario[] = array($row[0],$row[1],$row[3],$row[4]); 
        }
        if ($c == 3){
            $comentario[] = array($row[0],$row[1],$row[3],$row[4]); 
        }
    }    

    
    
    ?>
        <div class="container-fluid mt-3 ">
            <div class="row">
                <div class="col-sm-5">
                    
                    <?php 
                          
                        if ($u == 'm'){ //MINISTROS
                            $sql_descartar = mysql_query("SELECT * FROM salas WHERE fecha = '$fecha' AND (sala = '1' OR sala = '2')", $link);
                            $rowValues = array();
                            while ($row = mysql_fetch_row($sql_descartar)) {
                                $rowValues[] = $row[0];
                            }
                            
                            ?>
                                <p><b>Ministros:</b></p>
                            <?php

                            foreach($usuarioP as $user){
                                
                                if (!in_array($user[0], $rowValues)) {
                                ?>
                                    <div class="d-grid gap-2">
                                        <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> </button>    
                                    </div>
                                <?php
                                }
                            } 

                            foreach($usuarioM as $user){
                                if (!in_array($user[0], $rowValues)) {
                                ?>
                                    <div class="d-grid gap-2">
                                        <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> </button>   
                                    </div>
                                <?php
                                }
                            }
                            
                            ?>
                                <br>
                                <p><b>Abogados Integrantes:</b></p>
                            <?php

                            foreach($usuarioA as $user){
                                if (!in_array($user[0], $rowValues)) {
                                ?>
                                    <div class="d-grid gap-2">
                                        <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> </button>    
                                    </div>
                                
                                <?php
                                }
                            }

                            ?>
                                <br>
                                <p><b>Fiscales:</b></p>
                            <?php

                            foreach($usuarioF as $user){
                                if (!in_array($user[0], $rowValues)) {
                                ?>
                                    <div class="d-grid gap-2">
                                        <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> </button>    
                                    </div>
                                <?php
                                }
                            }
                        }

                        if ($u == 'r'){ //RELATORES
                            $sql_descartar = mysql_query("SELECT * FROM salas WHERE fecha = '$fecha' AND (sala = '1' OR sala = '2') ", $link);
                            $rowValues = array();
                            while ($row = mysql_fetch_row($sql_descartar)) {
                                $rowValues[] = $row[0];
                            }
                            ?>
                                <p><b>Asignar:</b></p>
                            <?php
                            
                            if ($pos != 6){
                                $nombre = "";
                                if (($pos == 1 && $sala == 1) || ($pos == 3 && $sala == 2)){
                                    $nombre = "FELIPE HERNAN CANCINO CONCHA";
                                }
                                if (($pos == 2 && $sala == 1) || ($pos == 4 && $sala == 2)){
                                    $nombre = "ALEJANDRO CLUNES MUÑOZ";
                                }
                                if (($pos == 3 && $sala == 1) || ($pos == 5 && $sala == 2)){
                                    $nombre = "PAMELA HERNANDEZ MACHUCA";
                                }
                                if (($pos == 4 && $sala == 1) || ($pos == 2 && $sala == 2)){
                                    $nombre = "MARCELA ROBLES SANGUINETTI";
                                }
                                if (($pos == 5 && $sala == 1) || ($pos == 1 && $sala == 2)){
                                    $nombre = "RAFAEL ESTEBAN CACERES SANTIBAÑEZ";
                                }
                                $query = mysql_query("SELECT * FROM user WHERE nombre = '$nombre' ",$link);
                                $row = mysql_fetch_row($query);
                                ?>
                                    <div class="d-grid gap-2">
                                        <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $row[0] ?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"><b><?php echo $row[1] ?></b></button>    
                                    </div>
                                    <br>
                                <?php
                            }

                            foreach($usuarioR as $user){
                                if (!in_array($user[0], $rowValues)) {
                                    if (($pos == 1 || $pos == 2 || $pos == 3 || $pos == 4 || $pos == 5) && $user[1] == $nombre){
                                        continue;
                                    }
                                    ?>
                                        <div class="d-grid gap-2">
                                            <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"><?php echo $user[1]?></button>    
                                        </div>
                                    <?php
                                }
                            }
                        }  

                        if ($u == 's'){ // SECRETARIOS
                            $sql_descartar = mysql_query("SELECT * FROM salas WHERE fecha = '$fecha' AND sala = '4'", $link);
                            $rowValues = array();
                            while ($row = mysql_fetch_row($sql_descartar)) {
                                $rowValues[] = $row[0];
                            }
                            ?>
                                <p><b>Secretario:</b></p>
                            <?php

                            foreach($usuarioS as $user){
                                if (!in_array($user[0], $rowValues)) {
                                    ?>
                                        <div class="d-grid gap-2">
                                            <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> (T)</button>    
                                        </div>
                                    <?php
                                }
                            }

                            ?>
                                <br>
                                <p><b>Oficial 1°:</b></p>
                            <?php

                            foreach($usuarioO as $user){
                                if (!in_array($user[0], $rowValues)) {
                                    ?>
                                        <div class="d-grid gap-2">
                                            <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> (S)</button>    
                                        </div>
                                    
                                    <?php
                                }
                            }
                        }   

                        if ($u == 'p'){ // PRESIDENTE DE LA CORTE
                            $sql_descartar = mysql_query("SELECT * FROM salas WHERE fecha = '$fecha' AND sala = '3'", $link);
                            $rowValues = array();
                            while ($row = mysql_fetch_row($sql_descartar)) {
                                $rowValues[] = $row[0];
                            }
                            ?>
                                <p><b>Asignar:</b></p>
                            <?php

                            foreach($usuarioP as $user){
                                if (!in_array($user[0], $rowValues)) {
                                    ?>
                                        <div class="d-grid gap-2">
                                            <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> (T) </button>    
                                        </div>
                                    <?php
                                }
                            }
                            
                            foreach($usuarioM as $user){
                                if (!in_array($user[0], $rowValues)) {
                                    ?>
                                        <div class="d-grid gap-2">
                                            <button id ="btnInsertar" class=" btn btn-outline-dark" data-bs-dismiss="modal" onclick="insertarFuncionario('<?php echo $user[0]?>', '<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>' )"> <?php echo $user[1]?> (S) </button>    
                                        </div>
                                    
                                    <?php
                                }
                            }      
                        }

                        ?> 
                            <br>
                            <?php
                                if ($row = mysql_fetch_row($sql_e)){
                                    ?>
                                        <button class="btn btn-danger btn-sm" style="width:55px;" data-bs-dismiss="modal" onclick="eliminarFuncionario('<?php echo $sala ?>' , '<?php echo $posicion ?>', '<?php echo $fecha ?>')" >Quitar </button>
                                    <?php   
                                }
                            ?>
                        <?php
                    
                    ?>
                </div>
                <div class="col-sm-1">
                </div>
                <div class="col-sm-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #E3E3E3" >
                                <th class="text-center" style="border: 2px solid #ccc">Comentario</th>
                                <th class="text-center" style="border: 2px solid #ccc">Fecha de publicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($comentario as $com){
                                    if ($com[3] == 'privado'){
                                        $color = '#FDFFC0';
                                    }
                                    if ($com[3] == 'publico'){
                                        $color = '#D3FFFE ';
                                    }
                                    ?>
                                        <tr style="background-color: <?php echo $color ?>">
                                            <td class="text-left" style="border: 2px solid #ccc">  <?php echo $com[1] ?> </td>
                                            <td class="text-center" style="border: 2px solid #ccc"> <?php echo $com[0]?> </td>
                                        </tr>
                                    <?php
                                } 
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

    <?php

}

// INGRESO ASIGNACIÓN
if($_POST['accion'] == 2){
    $rut = $_POST['rut'];
    $sala = $_POST['sala'];
    $posicion = $_POST['posicion'];
    $fecha = $_POST['fecha'];

    $query = mysql_query("SELECT * FROM salas WHERE sala = '$sala' AND fecha = '$fecha' AND posicion = '$posicion' ", $link);

    if ($query){
        $sql = mysql_query("DELETE FROM salas WHERE sala = '$sala' AND fecha = '$fecha' AND posicion = '$posicion' ", $link); 
        if ($sql){
            $sql2 = mysql_query("INSERT INTO salas VALUES('$rut', '$fecha', '$sala', '$posicion')", $link);
        }
    } else{
        $sql = mysql_query("INSERT INTO salas VALUES('$rut', '$fecha', '$sala', '$posicion')", $link);
    }
}

// CONFIRMAR SALA
if($_POST['accion'] == 3){
    
    $fecha = $_POST['fecha'];
    $sql2 = mysql_query("SELECT * FROM salas WHERE fecha = '$fecha' ", $link);
    $salas = array();
    
    while ($row = mysql_fetch_row($sql2)){
        $salas[$row[2]."-".$row[3]] = array($row[0],$row[1],$row[2],$row[3]);
    }
    
    //echo "<pre>";
    //print_r($salas);
    //echo "</pre>";

    // Primera sala: sala 1 pos 1-2-3-5
    // Segunda sala: sala 2 pos 1-2-3-5
    // Presidente  : sala 3 pos 1
    // Secretario  : sala 4 pos 1

        $cont = 0;
        if (!isset($salas['1-1'])) { //SALA 1
            $cont++;
        }
        if (!isset($salas['1-2'])) {
            $cont++;
        }
        if (!isset($salas['1-3'])) {
            $cont++;
        }
        if (!isset($salas['1-5'])) {
            $cont++;
        }
        if (!isset($salas['2-1'])) { //SALA 2
            $cont++;
        }
        if (!isset($salas['2-2'])) {
            $cont++;
        }
        if (!isset($salas['2-3'])) {
            $cont++;
        }
        if (!isset($salas['2-5'])) {
            $cont++;
        }
        if (!isset($salas['3-1'])) { //Presidente
            $cont++;
        }
        if (!isset($salas['4-1'])) { //Secretario
            $cont++;
        }

        echo $cont; 

    if ($cont == 0){
        $sql = mysql_query("SELECT MAX(id) as id FROM tabla_confirma", $link);
        $row = mysql_fetch_array($sql);
        $next_id = $row[0] + 1 ;
        $query = mysql_query("INSERT INTO tabla_confirma VALUES ('$next_id', '$fecha')", $link);
    }
}

// DESCONFIRMAR SALA
if($_POST['accion'] == 4){
    $fecha = $_POST['fecha'];

    $query = mysql_query("DELETE FROM tabla_confirma WHERE fecha = '$fecha' ", $link);
}

// QUITAR ASIGNACIÓN
if($_POST['accion'] == 5){
    $sala = $_POST['sala'];
    $posicion = $_POST['posicion'];
    $fecha = $_POST['fecha'];

    $sql = mysql_query("DELETE FROM salas WHERE sala = '$sala' AND fecha = '$fecha' AND posicion = '$posicion' ", $link); 
}

// MODAL COMENTARIO
if($_POST['accion'] == 6){
    $fecha = $_POST['fecha'];
    $sala = $_POST['sala'];
    $r1 = $_POST['r1'];
    $r2 = $_POST['r2'];
    $posicion = $_POST['posicion'];

    if ($sala == '1'){
        $query = mysql_query("SELECT * FROM comentario WHERE sala = '1' AND fecha ='$fecha' ", $link);
    }
    if ($sala == '2'){
        $query = mysql_query("SELECT * FROM comentario WHERE sala = '2' AND fecha ='$fecha'", $link);
    }
    if ($sala == '3' || $sala == '4'){
        $query = mysql_query("SELECT * FROM comentario WHERE fecha ='$fecha'" , $link);
    }
    

    ?>
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="input-group">
                        <textarea class="form-control" aria-label="With textarea" style="height:130px" name="comentario" id="comentario"></textarea>
                    </div>
                    <br>
                    <div class="form-check" >

                        <input class="form-check-input" type="radio"  name="exampleRadios" id="exampleRadios1" value="privado" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            <button class="btn btn-sm disabled" style="background-color: #FDFFC0"> <b>Privado</b> </button>
                        </label>

                    </div>
                    <div class="form-check">

                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="publico">
                        <label class="form-check-label" for="exampleRadios2">
                            <button class="btn btn-sm disabled" style="background-color: #D3FFFE"> <b>Público</b> </button>
                        </label>

                    </div>
                    
                    <br>

                    <button type="button" class="btn btn-success btn-sm" style="width: 100px" onclick="agregarComentario('<?php echo $fecha?>', '<?php echo $sala?>', '<?php echo $r1 ?>', '<?php echo $r2 ?>', '<?php echo $posicion ?>')" >Agregar</button>

                    
                </div>

                <div class="col-1">
        
                </div>

                <div class="col-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #E3E3E3">
                                <th class="text-center" style="border: 2px solid #ccc">Comentario</th>
                                <th class="text-center" style="border: 2px solid #ccc">Fecha de publicación</th>
                                <th class="text-center" style="border: 2px solid #ccc">Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    while ($row = mysql_fetch_row($query)){
                                        if ($row[4] == 'privado'){
                                            $color = '#FDFFC0 ';
                                        }
                                        if ($row[4] == 'publico'){
                                            $color = '#D3FFFE ';
                                        }
                                        ?>
                                            <tr style="background-color: <?php echo $color ?>" >
                                                <td class="text-left" style="border: 2px solid #ccc">  <?php echo $row[1]?> </td>
                                                <td class="text-center" style="border: 2px solid #ccc"> <?php echo $row[0]?> </td>
                                                <td class="text-center" style="border: 2px solid #ccc"> <button class="btn btn-danger btn-sm"  onclick="eliminarComentario('<?php echo $row[3]?>', '<?php echo $sala ?>', '<?php echo $posicion?>', '<?php echo $fecha ?>', '<?php echo $r1 ?>', '<?php echo $r2 ?>' )" >Eliminar</button> </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
}

// INSERTAR COMENTARIO
if($_POST['accion'] == 7){
    $fecha = $_POST['fecha'];
    $comentario = $_POST['comentario'];
    $fechaActual = $_POST['fechaActual'];
    $sala = $_POST['sala'];
    $tipo = $_POST['tipo'];
    $query = mysql_query("INSERT INTO comentario VALUES ('$fecha', '$comentario','$sala', '$fechaActual', '$tipo' )", $link);
}

// ELIMINAR COMENTARIO
if($_POST['accion'] == 8){
    $fecha = $_POST['fecha'];
    $query = mysql_query("DELETE FROM comentario WHERE fechaA = '$fecha' ", $link);
}

?>