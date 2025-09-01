<?php 
include ("conecta.php");

session_start();
if (!isset($_SESSION['usuario']))
{
  header("login.php");
}else{
  $accion = $_POST['accion'];
  /* GENERALES */
  if ($accion == "menu_lateral"){
    ?>
      <div class="offcanvas offcanvas-start"  tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fa fa-university"></i> ICA VALDIVIA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

          <ul class="list-group list-group-flush pb-3">
            <a class="list-group-item list-group-item-action active" id="inicio" href="index.html">Inicio</a>
            <a class="list-group-item list-group-item-action" id="verifica" href="verificador.html">Verificación de abogados</a>
            <a class="list-group-item list-group-item-action" id="recurso" href="recursos.html">Recepción de recursos</a>
            <a class="list-group-item list-group-item-action" id="archivo" href="archivos.html">Administración de documentos</a>
            <a class="list-group-item list-group-item-action" id="integracion" href="integracion.php">Integración</a>
            <a class="list-group-item list-group-item-action" id="users" href="users.html">Administración de usuarios</a>
            <a class="list-group-item list-group-item-action" id="juramentos" href="juramentos.html">Juramentos</a>
            <!-- 
            <a class="list-group-item list-group-item-action" id="isapre" onclick="desp_menu('isapre')">Costas isapre</a>
            <a class="list-group-item list-group-item-action" id="buzon" onclick="desp_menu('buzon')">Buzón</a>
            -->
          </ul>
          <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-danger btn-block btn-sm" onclick="end_sesion()">Finalizar sesión</button>
            </div>
          
        </div>
      </div>
    <?php
  }
  if ($accion == "fin_sesion") {
    session_start();
    unset($_SESSION['usuario']);
    unset($_SESSION['pass']);
    unset($_SESSION['nombre']);
    unset($_SESSION['correo']);
  };
  /* VERIFICADOR.HTML */
  if ($accion == "busca_verificados") {
    $usu=mysql_query("SELECT * FROM validacion_abogados", $link);
    if (!$usu) {
      die("Error en la consulta: " . mysql_errno($link) . ": " . mysql_error($link));
  }
    ?>
    <table class="hover row-border" id="v_abogados">
        <thead>
          <tr>
            <th>Rut</th>
            <th>Nombre completo</th>
            <th>Correo</th>
            <th>Validación (desde - hasta)</th>
            <th>Contacto</th>
            <th>Re validar</th>
          </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysql_fetch_row($usu))
            {
              ?>
              <tr>
                <td><button data-toggle="modal" data-target="#modal_mod" class="btn btn-outline-dark btn-sm" onclick="modalModificar('<?php echo $row[0]?>')" > <?php echo $row[0]?> </button>  </td>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[5]." / ".$row[6] ?></td>
                <td><?php echo $row[3]?></td>
                <td>
                  <?php
                  if (date('Y-m-d') < $row[5]) {
                    //echo "La fecha actual está antes de la fecha de inicio.";
                  } elseif (date('Y-m-d') >= $row[5] && date('Y-m-d') <= $row[6]) {
                      echo "Validado correctamente";
                  } else {
                      $fecha = date('Y-m-d');
                      $fecha_actual = strtotime(date('Y-m-d')); // Convertir la fecha a un timestamp
                      $nueva_fecha = strtotime('+6 months', $fecha_actual); 
                      ?>
                      <button class="btn btn-danger" onclick="pre_re_validar('<?php echo $row[0]?>','<?php echo $fecha?>','<?php echo date('Y-m-d', $nueva_fecha)?>', '<?php echo $row[2];?>', '<?php echo $row[3];?>')"> Re Validar abogado </button>
                      <?php
                  }
                  ?>
                </td>

              </tr>
              <?php
            }
        ?>
      </tbody>
    </table>
    <script>
      $(document).ready( function () {
        $('#v_abogados').DataTable();
      } );
    </script>
    <?php    
  };
  if ($accion == "re-validar-v"){
      $usu=mysql_query("UPDATE validacion_abogados SET rut_funcionario='".$_SESSION['usuario']."',ingreso='".$_POST['inicio']."',expira='".$_POST['fin']."', correo = '".$_POST['correo']."', telefono = '".$_POST['fono']."' WHERE rut = '".$_POST['rut']."' ", $link);
      
      if ($usu) {
          ?>
          <div class="alert alert-success" role="alert">
            Datos ingresados correctamente
          </div>
        <?php
        }else{
          ?>
          <div class="alert alert-danger" role="alert">
            error en la consulta
          </div>
        <?php
        }
  }
  if ($accion == "guarda-datos-v") {
    if ($_POST['rut'] == "" || $_POST['nombre'] == "" || $_POST['correo'] == "" || $_POST['contacto'] == "" || $_POST['fecha-expira'] == "") 
    {
      ?>
        <div class="alert alert-danger" role="alert">
          Faltan datos, debe completar todo el formulario
        </div>
      <?php
    }else{
      
        $usu=mysql_query("INSERT INTO validacion_abogados VALUES ('".$_POST['rut']."','".$_POST['nombre']."','".$_POST['correo']."','".$_POST['contacto']."','".$_SESSION['usuario']."','".$_POST['fecha-ingreso']."','".$_POST['fecha-expira']."')", $link);
        if ($usu) {
          ?>
          <div class="alert alert-success" role="alert">
            Datos ingresados correctamente
          </div>
        <?php
        }else{
          ?>
          <div class="alert alert-danger" role="alert">
            Ferror en la consulta
          </div>
        <?php
        }
      
    }
  };
  /* RECURSOS.HTML */
  if ($accion == "mostrar_tabla_r") {

    $usu=mysql_query("SELECT id, nombre_s, rut_s, mail_s, fecha FROM interpone_recurso WHERE estado = '".$_POST['estado']."'", $link);
    ?>
    <table class="hover row-border" id="r_<?php echo $_POST['estado']?>">
        <thead>
          <tr>
            <th>ID</th>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>fecha de ingreso</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysql_fetch_row($usu))
            {
              ?>
              <tr>
                <td><?php echo $row[0]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[4]?></td>
                <td>
                    <button class="btn btn-info btn-block" onclick="ver_detalle_r('<?php echo $row[0]?>')">Ver detalle</button>
                </td>
              </tr>
              <?php
            }
        ?>
      </tbody>
    </table>
    <script>
      $(document).ready( function () {
        $('#r_<?php echo $_POST['estado']?>').DataTable();
      } );
    </script>
    <?php
  };
  if ($accion == "ver_detalle_r") {
    
    $usu=mysql_query("SELECT * FROM interpone_recurso WHERE id = '".$_POST['id_r']."' ", $link);
    $row = mysql_fetch_row($usu);
    ?>
    <div class="row">
      <div class="col-sm-4">
            <div class="card shadow">
              <div class="card-body">
                <p>Interpuesto por: <strong><?php echo $row[1]?></strong></p>
                <p>Rut: <strong><?php echo $row[2]?></strong></p>
                <p>Correo: <strong><?php echo $row[6]?></strong></p>
                <p>Fono de contacto: <strong><?php echo $row[5]?></strong></p>
                <p>fecha de ingreso: <strong><?php echo $row[27]?></strong></p>
              </div>
            </div>
      </div>
      <div class="col-sm-8">
        <div class="card shadow">
          <div class="card-header">
            Adjuntos
          </div>
          <div class="card-body">
            <p>Vista del recurso<p>
            <a class="btn btn-danger" href="pdf_recurso.php?id=<?php echo $row[0]?>"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Ver aquí</a>
            <p>Ver adjuntos</p>
            <?php
            if ($row[15] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[15]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 1</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[16]?></p>
                </div>
              </div>
              <?php
            }
            if ($row[17] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[17]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 2</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[18]?></p>
                </div>
              </div>
              <?php
            }
            if ($row[19] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[19]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 3</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[20]?></p>
                </div>
              </div>
              <?php
            }
            if ($row[21] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[21]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 4</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[22]?></p>
                </div>
              </div>
              <?php
            }
            if ($row[23] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[23]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 5</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[24]?></p>
                </div>
              </div>
              <?php
            }
            if ($row[25] != "") {
              ?>
              <div class="row">
                <div class="col-sm-4 d-grid gap-2">
                  <a class="btn btn-danger mb-3 btn-block btn-sm" href="../cavaldivia/<?php echo $row[25]?>" download> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar archivo 6</a>
                </div>
                <div class="col-sm-8 ">
                  <p>Ref: <?php echo $row[26]?></p>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-sm-12">
        <div class="card shadow" >
          <div class="card-header">
            Asignación Corte de Apelaciones de Valdivia
          </div>
          <div class="card-body" id="card-ingresa-rol">
          <?php
          if ($row[30] != "" && $row[33] == "1") {
            ?>
            <p style="text-align: justify">
              Este recurso se encuentra en estado de tramitación, con el rol corte 
              <strong>
                <?php 
                  echo $row[30];
                  if ($row[29] == 0) {
                    echo " Protección";
                  }
                  if ($row[29] == 1) {
                    echo " Amparo";
                  }
                ?>
              </strong>
              , Si desea generear nuevamente la plantilla de correo para la comunicación de esta información pinche 
              <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">aquí</button>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <p style="text-align: justify">
                  Esto es una plantilla de correo no terminada:
                  <br><br>
                  Se comunica a ud. que su recurso de ingresado correctamente y se genero el rol-corte <strong><?php echo $row[30]?></strong>.
                  </p>
                </div>
              </div>            
            </p>
             
            <?php
          }elseif($row[30] == "" && $row[33] == "0"){
          ?>
            <p>Agregue aquí el rol-corte</p>
            <div class="row">
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" class="form-control" id="input-rol">
                  <span class="input-group-text" id="basic-addon3">
                  <?php
                    if ($row[29] == 0) {
                      echo "Protección.";
                    }
                    if ($row[29] == 1) {
                      echo "Amparo.";
                    }
                  ?>
                  </span>
                </div>
              </div>

              <div class="col-sm-4">
                <button class="btn btn-success" onclick="adjuntar_rol('<?php echo $row[0]?>')">Adjuntar</button>
                
              </div>
              
            </div>
          <?php
          }
          ?>
          </div>
        </div>
      </div>
    </div>
    <?php  
  
  };
  if ($accion == "ingresa_rol_r") {
    $fecha_actual = date("Y-m-d");
    $usu=mysql_query("UPDATE interpone_recurso SET rol_corte='".$_POST['rol-corte']."',rut_funcionario='".$_SESSION['usuario']."',fecha_ing_rol='$fecha_actual', estado = '1' WHERE id = '".$_POST['id']."' ", $link);
    if ($usu) {
      ?>
      <p style="text-align: justify">
      Esto es una plantilla de correo no terminada:
      <br><br>
      Se comunica a ud. que su recurso de ingresado correctamente y se genero el rol-corte <strong><?php echo $_POST['rol-corte']?></strong>.
      </p>
      <?php
    }else{
      echo "error";
    }
  }

  if ($accion == "modificarV"){
    $rut = $_POST['rut'];
    $sql = mysql_query("SELECT * from validacion_abogados WHERE rut = '$rut' ", $link);
    $row = mysql_fetch_row($sql);
    ?>
        <form>
            <label class="form-label">R.U.T.</label>
            <input type="text" class="form-control mb-3" id="rut" value="<?php echo $row[0]?>" disabled> 
            <label class="form-label">Nombre Completo</label>
            <input type="text" class="form-control mb-3" id="nombre" value="<?php echo $row[1]?>" >
            <label class="form-label">Correo Electrónico</label>
            <input type="text" class="form-control mb-3" id="correo" value="<?php echo $row[2]?>">
            <label class="form-label">Contacto</label>
            <input type="text" class="form-control mb-3" id="contacto" value="<?php echo $row[3]?>">
        </form>
        <div id="resultado">
        </div>
    <?php
  }

  if ($accion == "sqlMod"){
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contacto = $_POST['contacto'];
    $query = mysql_query("UPDATE validacion_abogados SET nombre='$nombre', correo='$correo', telefono='$contacto' WHERE rut='$rut' ",$link);
  }

  if($accion == "eliminarV"){
    $rut = $_POST['rut'];
    ?>
      <div class="container-fluid">
          <div class="row">
              <div class="col-7" style="text-align: right" >
              </div>
              <div class="col-5" style="text-align: right" >
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" onclick="eliminarV('<?php echo $rut ?>')">Eliminar</button>
              </div>
          </div>
      </div>
    <?php
  }

  if ($accion == "sqlDel"){
    $rut = $_POST['rut'];
    $sql = mysql_query("DELETE FROM validacion_abogados WHERE rut = '$rut' ",$link);
  }
}
