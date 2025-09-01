<?php
include("conecta.php");

//TABLA USUARIOS
if($_POST['accion'] == 0){

    $sql =  mysql_query("SELECT * from user", $link);
    $sql1 = mysql_query("SELECT * from cargo", $link);

    $cargos = array();

    while (($row = mysql_fetch_row($sql1))){
        $cargos[] = array($row[0],$row[1]);
    }

    ?>
        <div class="row">

            <div class="col-2">
            </div>

            <div class="col-8">
                <div class="py-3 text-center " >
                    <h2 >Administración de Usuarios</h2>
                </div>
                <table style='border: 1px #ccc solid ; border-radius:5px; background-color:#F2F2F2' id="data_table" class="shadow">
                    <thead>
                        <tr>
                            <th class="text-left" >RUT</th>
                            <th class="text-left" >Nombre</th>
                            <th class="text-left" >Correo Electrónico</th>
                            <th class="text-left" >Cargo</th>
                            <th class="text-left" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysql_fetch_row($sql)){
                                ?>
                                    <tr>
                                        <td class="text-left" > <?php echo $row[0] ?></td>
                                        <td class="text-left" > <?php echo $row[1] ?></td>
                                        <td class="text-left" > <?php echo $row[2] ?></td>

                                        <?php
                                            foreach($cargos as $cargo){
                                                if($row[4] == $cargo[0]){
                                                    ?> 
                                                        <td class="text-left"> <?php echo $cargo[1] ?> </td>
                                                    <?php 
                                                }
                                            }
                                        ?>

                                        <td class="text-center" >
                                            <button class="btn btn-dark btn-sm" onclick="modalModificar('<?php echo $row[0] ?>', '<?php echo $row[4] ?>')">Modificar</button>
                                        </td>

                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-2">
            </div>

        </div>

    <?php

}

//MODAL AGREGAR USUARIOS
if($_POST['accion'] == 1){

    $sql =  mysql_query("SELECT * from cargo", $link);

    ?>
        <form>

            <label class="form-label">R.U.T.</label>
            <input type="text" class="form-control mb-3" id="rut" placeholder="">

            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control mb-3" id="nombre" placeholder="">

            <label class="form-label">Correo Electrónico</label>
            <input type="text" class="form-control mb-3" id="correo" placeholder="">

            <label class="form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="option" name="option">
                <option disabled selected >Seleccione un cargo</option>
                <?php 
                    while ($row = mysql_fetch_row($sql)){
                        echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                    }
                ?>
            </select> 

        </form>
    <?php
}

//INSERTAR USUARIO
if($_POST['accion'] == 2){
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $pass = " ";

    $sql2 = mysql_query("SELECT * FROM user WHERE rut ='$rut' ", $link);
    $row = mysql_fetch_row($sql2);

    if($row[0] == $rut){
        echo "<div class='alert alert-danger text-center' role='alert'>El Usuario ya se encuentra registrado </div>";
    }else{
        $sql = mysql_query("INSERT INTO user VALUES('$rut', '$nombre', '$correo', '$pass', '$cargo')", $link);
        echo "<div class='alert alert-success text-center' role='alert'> Usuario Registrado </div>";
    }
}

//MODAL MODIFICAR USUARIOS
if($_POST['accion'] == 3){

    $rut = $_POST['rut'];
    $valor = $_POST['valorS'];

    $sql =  mysql_query("SELECT * from cargo WHERE id != '$valor' ", $link);

    $sql2 =  mysql_query("SELECT nombre from cargo WHERE id = '$valor'  ", $link);
    $row2 = mysql_fetch_row($sql2);

    $user = mysql_query("SELECT * from user WHERE rut = '$rut' ", $link);
    $row_user = mysql_fetch_row($user);

    ?>
        <form>

            <label class="form-label">R.U.T.</label>
            <input type="text" class="form-control mb-3" id="rut"  value="<?php echo $row_user[0]?>" disabled> 

            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control mb-3" id="nombre"  value="<?php echo $row_user[1]?>" >

            <label class="form-label">Correo Electrónico</label>
            <input type="text" class="form-control mb-3" id="correo" value="<?php echo $row_user[2]?>">

            <label class="form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="option" name="option">

            <option selected value="<?php echo $valor ?>" > <?php echo $row2[0] ?> </option>
                <?php 
                    while ($row = mysql_fetch_row($sql)){
                        echo "<option value='". $row[0] ."'>" . $row[1] . "</option>";
                    }
                ?>
            </select> 

        </form>
    <?php
}

//ACTUALIZAR USUARIO
if($_POST['accion'] == 4){
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];

    $sql = mysql_query("UPDATE user SET nombre='$nombre', correo='$correo', unidad='$cargo' WHERE rut='$rut' ",$link);
    echo "<div class='alert alert-success text-center' role='alert'> Usuario Actualizado </div>";
}

//ELIMINAR USUARIO
if($_POST['accion'] == 5){
    $rut = $_POST['rut'];
    $sql = mysql_query("DELETE FROM user WHERE rut = '$rut' ", $link);
    echo "<div class='alert alert-info text-center' role='alert'> Usuario Eliminado </div>";
}
?>