<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/private/conecta.php';

if (isset($_POST['accion']) && (int)$_POST['accion'] === 0) {
    // --- POST ---
    $d1 = $_POST['d1'] ?? '';
    $d2 = $_POST['d2'] ?? '';
    $d3 = $_POST['d3'] ?? '';
    $d4 = $_POST['d4'] ?? '';
    $d5 = $_POST['d5'] ?? '';
    $d6 = $_POST['d6'] ?? '';
    $f1 = $_POST['f1'] ?? '';
    $f2 = $_POST['f2'] ?? '';
    $f3 = $_POST['f3'] ?? '';
    $f4 = $_POST['f4'] ?? '';
    $f5 = $_POST['f5'] ?? '';
    $f6 = $_POST['f6'] ?? '';
    $nombreM = $_POST['nM'] ?? '';

    $array_dias = [$d1,$d2,$d3,$d4,$d5,$d6];

    $presidentes = [];
    $secretarios = [];
    $sala1 = [];
    $sala2 = [];
    $usuarios = [];
    $array_conf = [];

    // --- salas: posicion, fecha, rut, sala (entre d1 y d6)
    $stmt = $link->prepare("SELECT posicion, fecha, rut, sala FROM salas WHERE fecha BETWEEN ? AND ?");
    $stmt->bind_param("ss", $d1, $d6);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_row()) {
        // $row[0]=posicion, [1]=fecha, [2]=rut, [3]=sala
        if ($row[3] == '1') { $sala1[] = [$row[0], $row[1], $row[2]]; }
        if ($row[3] == '2') { $sala2[] = [$row[0], $row[1], $row[2]]; }
        if ($row[3] == '3') { $presidentes[] = [$row[0], $row[1], $row[2]]; }
        if ($row[3] == '4') { $secretarios[] = [$row[0], $row[1], $row[2]]; }
    }
    $stmt->close();

    // --- usuarios: SELECT * FROM user
    $sql_1 = $link->query("SELECT * FROM user");
    while ($row = $sql_1->fetch_row()) {
        // mapeo igual que antes: [$row[1], $row[2], $row[4]]
        $usuarios[$row[0]] = [$row[1], $row[2], $row[4]];
    }
    $sql_1->close();

    // --- comentarios sala 1 (fecha = d3, tipo=publico, sala=1)
    $comentarios1 = [];
    $stmt = $link->prepare("SELECT * FROM comentario WHERE fecha = ? AND tipo = 'publico' AND sala = 1");
    $stmt->bind_param("s", $d3);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_row()) {
        $comentarios1[] = $row; // usas $row[1] más abajo
    }
    $stmt->close();

    // --- comentarios sala 2
    $comentarios2 = [];
    $stmt = $link->prepare("SELECT * FROM comentario WHERE fecha = ? AND tipo = 'publico' AND sala = 2");
    $stmt->bind_param("s", $d3);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_row()) {
        $comentarios2[] = $row;
    }
    $stmt->close();

    // --- tabla_confirma: fechas confirmadas entre d1 y d6
    $stmt = $link->prepare("SELECT fecha FROM tabla_confirma WHERE fecha BETWEEN ? AND ?");
    $stmt->bind_param("ss", $d1, $d6);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_row()) {
        $array_conf[$row[0]] = $row[0];
    }
    $stmt->close();

    // --- conteos para var==4
    $dato = 0;
    foreach ($sala1 as $verifica) { if ($verifica[0] == 4) { $dato++; } }

    $dato2 = 0;
    foreach ($sala2 as $verifica) { if ($verifica[0] == 4) { $dato2++; } }
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mt-1 p-1">
          <table class="table-responsive-xxl" class="mw-100" style="">
            <thead>
              <tr>
                <th style="height:40px"></th>
                <?php
                foreach ($array_dias as $dias) {
                    if (isset($array_conf[$dias])) {
                        $color = '#CEFFCB ';
                        $c = 1;
                    } else {
                        $color = '#FFDEDE';
                        $c = 0;
                    }

                    if ($c == 1) { ?>
                        <td class="text-center" scope="col" style="width:15%; border: 1px solid black; font-size:20px; background-color:<?php echo $color ?>">
                          <button class="btn btn-success btn-sm" disabled>Confirmada</button>
                        </td>
                    <?php } else { ?>
                        <td class="text-center" scope="col" style="width:15%; border: 1px solid black; font-size:20px; background-color:<?php echo $color ?>">
                          <button class="btn btn-danger btn-sm" disabled>Por confirmar</button>
                        </td>
                    <?php }
                } ?>
              </tr>
              <tr id="alturaInfoH">
                <th class="text-center" style="width:10%; border: 1px solid black;background-color:#7ECCFF; font-size:18px"><?php echo $nombreM ?></th>
                <th class="text-center" scope="col" style="width:15%; border: 1px solid black; font-size:20px;background-color:#BEE4FD"><?php echo $f1 ?></th>
                <th class="text-center" scope="col" style="width:15%; border: 1px solid black; font-size:20px;background-color:#BEE4FD"><?php echo $f2 ?></th>
                <th class="text-center" scope="col" style="width:15%; border: 1px solid black; font-size:20px;background-color:#7ECCFF"><?php echo $f3 ?> <span style="font-size:15px">(Día Actual)</span></th>
                <th class="text-center" scope="col" style="width:15%; background-color:#BEE4FD; border: 1px solid black; font-size:20px"><?php echo $f4 ?></th>
                <th class="text-center" scope="col" style="width:15%; background-color:#BEE4FD; border: 1px solid black; font-size:20px"><?php echo $f5 ?></th>
                <th class="text-center" scope="col" style="width:15%; background-color:#BEE4FD; border: 1px solid black; font-size:20px"><?php echo $f6 ?></th>
              </tr>
            </thead>
            <tbody id="alturaComH">
              <?php
              // ====== PRESIDENTE ======
              $var = 1;
              $cont = 0;
              while ($var <= 1) {
                  echo "<tr>"; ?>
                    <th class="text-right" style="border: 1px solid black"><b>Presidente:</b></th>
                  <?php
                  foreach ($array_dias as $dias) {
                      if (isset($array_conf[$dias])) {
                          $color = ($array_conf[$dias] == $d3) ? '#B9FFB9' : '#CEFFCB ';
                          $cod = 1;
                      } else {
                          $color = '#FFDEDE';
                          $cod = 0;
                      }
                      foreach ($presidentes as $presidente) {
                          if ($var == $presidente[0] && $dias == $presidente[1]) {
                              if ($usuarios[$presidente[2]][2] == 0) { ?>
                                  <td class="text-center text-danger" style="border: 1px solid black; background-color: <?php echo $color;?>; font-size:15px"><b><?php echo $usuarios[$presidente[2]][0]?> (T)</b></td>
                              <?php $cont = 1; }
                              if ($usuarios[$presidente[2]][2] == 2) { ?>
                                  <td class="text-center text-danger" style="border: 1px solid black; background-color: <?php echo $color;?>; font-size:15px"><b><?php echo $usuarios[$presidente[2]][0]?> (S)</b></td>
                              <?php $cont = 1; }
                          }
                      }
                      if ($cont == 0) { ?>
                          <td style="border: 1px solid black; background-color: <?php echo $color;?>; font-size:15px"></td>
                      <?php }
                      $cont = 0;
                  }
                  $var = $var + 1;
                  echo "</tr>";
              }

              // ====== SECRETARIO ======
              $var = 1;
              $cont = 0;
              while ($var <= 1) {
                  echo "<tr>"; ?>
                    <th class="text-right" style="border: 1px solid black"><b>Secretario:</b></th>
                  <?php
                  foreach ($array_dias as $dias) {
                      if (isset($array_conf[$dias])) {
                          $color = ($array_conf[$dias] == $d3) ? '#B9FFB9' : '#CEFFCB ';
                          $cod = 1;
                      } else {
                          $color = '#FFDEDE';
                          $cod = 0;
                      }
                      foreach ($secretarios as $secretario) {
                          if ($var == $secretario[0] && $dias == $secretario[1]) {
                              if ($usuarios[$secretario[2]][2] == 6) { ?>
                                  <td class="text-center" style="border: 1px solid black; background-color: <?php echo $color;?>; font-size:15px"><b><?php echo $usuarios[$secretario[2]][0]?> (T)</b></td>
                              <?php $cont = 1; }
                              if ($usuarios[$secretario[2]][2] == 7) { ?>
                                  <td class="text-center text-danger" style="border: 1px solid black; background-color: <?php echo $color;?>; font-size:15px"><b><?php echo $usuarios[$secretario[2]][0]?> (S)</b></td>
                              <?php $cont = 1; }
                          }
                      }
                      if ($cont == 0) { ?>
                          <td style="border: 1px solid black; background-color: <?php echo $color;?>"></td>
                      <?php }
                      $cont = 0;
                  }
                  $var = $var + 1;
                  echo "</tr>";
              } ?>
              <tr>
                <td class="text-center p-1" colspan="7" style="border: 1px solid black; font-weight:bold; background-color:#BEE4FD; font-size:20px">PRIMERA SALA</td>
              </tr>
              <tr>
                <td class="text-center p-1" colspan="7" style="border: 1px solid black;">
                  <div class="contenedor-texto" style="margin-top: 2px; margin-bottom: 2px; height: 25px;">
                    <div class="texto-en-movimiento">
                      <?php foreach ($comentarios1 as $row) { ?>
                        <b style="margin-left:15px; margin-right:5px"><?php echo $d3; ?>:</b>
                        <span><?php echo $row[1]; ?></span>
                      <?php } ?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php
              // ====== SALA 1 ======
              $var = 1;
              $cont = 0;
              while ($var <= 5) {
                  echo "<tr>";
                  if ($var == 1) { ?>
                      <th class="text-right" style="border: 1px solid black"><b>Pdte. de Sala:</b></th>
                  <?php }
                  if ($var == 2 || $var == 3) { ?>
                      <th style="border-left: 1px solid black"></th>
                  <?php }
                  if ($var == 4 && $dato != 0) { ?>
                      <th style="border-left: 1px solid black"></th>
                  <?php }
                  if ($var == 5) { ?>
                      <th class="text-right" style="border: 1px solid black"><b>Relator(a):</b></th>
                  <?php }

                  foreach ($array_dias as $dias) {
                      if (isset($array_conf[$dias])) {
                          if ($array_conf[$dias] == $d3) { $color = ($var == 5) ? '#C1C1C1' : '#B9FFB9'; }
                          else { $color = ($var == 5) ? '#D3D3D3' : '#CEFFCB '; }
                          $cod = 1;
                      } else {
                          $color = ($var == 5) ? '#E0E0E0' : '#FFDEDE';
                          $cod = 0;
                      }
                      if ($var == 4 && $dato == 0) {
                          // vacío
                      }
                      if ($var == 4 && $dato != 0) { ?>
                          <td class="text-center" style="border: 1px solid black;background-color: <?php echo $color;?>; font-size:15px">
                            <?php foreach ($sala1 as $sala) {
                                if ($var == $sala[0] && $dias == $sala[1]) { ?>
                                    <b><?php echo $usuarios[$sala[2]][0]?></b>
                                    <?php $cont = 1;
                                }
                            } ?>
                          </td>
                      <?php }
                      if ($var != 4) { ?>
                          <td class="text-center" style="border: 1px solid black;background-color: <?php echo $color;?>; font-size:15px">
                            <?php foreach ($sala1 as $sala) {
                                if ($var == $sala[0] && $dias == $sala[1]) { ?>
                                    <b><?php echo $usuarios[$sala[2]][0]?></b>
                                    <?php $cont = 1;
                                }
                            } ?>
                          </td>
                      <?php }
                      $cont = 0;
                  }
                  $var = $var + 1;
                  echo "</tr>";
              } ?>
              <tr>
                <td class="text-center p-1" colspan="7" style="border: 1px solid black; font-weight:bold; background-color:#BEE4FD; font-size:20px">SEGUNDA SALA</td>
              </tr>
              <tr>
                <td class="text-center p-1" colspan="7" style="border: 1px solid black;">
                  <div class="contenedor-texto" style="margin-top: 2px; margin-bottom: 2px; height: 25px;">
                    <div class="texto-en-movimiento">
                      <?php foreach ($comentarios2 as $row) { ?>
                        <b style="margin-left:15px; margin-right:5px"><?php echo $d3; ?>:</b>
                        <span><?php echo $row[1]; ?></span>
                      <?php } ?>
                    </div>
                  </div>
                </td>
              </tr>
              <?php
              // ====== SALA 2 ======
              $var = 1;
              $cont = 0;
              while ($var <= 5) {
                  echo "<tr>";
                  if ($var == 1) { ?>
                      <th class="text-right" style="border: 1px solid black"><b>Pdte. de Sala:</b></th>
                  <?php }
                  if ($var == 2 || $var == 3) { ?>
                      <th style="border-left: 1px solid black"></th>
                  <?php }
                  if ($var == 4 && $dato2 != 0) { ?>
                      <th style="border-left: 1px solid black"></th>
                  <?php }
                  if ($var == 5) { ?>
                      <th class="text-right" style="border: 1px solid black"><b>Relator(a):</b></th>
                  <?php }

                  foreach ($array_dias as $dias) {
                      if (isset($array_conf[$dias])) {
                          if ($array_conf[$dias] == $d3) { $color = ($var == 5) ? '#C1C1C1' : '#B9FFB9'; }
                          else { $color = ($var == 5) ? '#D3D3D3' : '#CEFFCB '; }
                          $cod = 1;
                      } else {
                          $color = ($var == 5) ? '#E0E0E0' : '#FFDEDE';
                          $cod = 0;
                      }
                      if ($var == 4 && $dato2 == 0) {
                          // vacío
                      }
                      if ($var == 4 && $dato2 != 0) { ?>
                          <td class="text-center" style="border: 1px solid black;background-color: <?php echo $color;?>; font-size:15px">
                            <?php foreach ($sala2 as $sala) {
                                if ($var == $sala[0] && $dias == $sala[1]) { ?>
                                    <b><?php echo $usuarios[$sala[2]][0]?></b>
                                    <?php $cont = 1;
                                }
                            } ?>
                          </td>
                      <?php }
                      // FIX: era "=" ahora "=="
                      if ($var == 4 && $cod == 0) {
                          // nada
                      }
                      if ($var != 4) { ?>
                          <td class="text-center" style="border: 1px solid black;background-color: <?php echo $color;?>; font-size:15px">
                            <?php foreach ($sala2 as $sala) {
                                if ($var == $sala[0] && $dias == $sala[1]) { ?>
                                    <b><?php echo $usuarios[$sala[2]][0]?></b>
                                    <?php $cont = 1;
                                }
                            } ?>
                          </td>
                      <?php }
                      $cont = 0;
                  }
                  $var = $var + 1;
                  echo "</tr>";
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
}
