<?php
  require_once('./sesion/sesion.php');
?>

<?php
    require('savebatch.php');
    $idbatch = "";
    $edit = false;
    $sql5 = mysqli_query($conn, "SELECT * From producto");
    $sql6 = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id");
   
    if (isset($_GET['edit'])) {
      $idbatch = $_GET['edit'];
      $update = true;
      $record = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia WHERE id_batch=$idbatch");


      $edit = true;
      $n = mysqli_fetch_array($record);
      $noreferencia = $n['referencia'];
      $nombrereferencia = $n['nombre_referencia'];
      $nombreproducto = $n['id_nombre_producto'];
      $notificacionsanitaria = $n['id_notificacion_sanitaria'];
      $linea = $n['id_linea'];
      $marca = $n['id_marca'];
      $propietario = $n['id_propietario'];
      $presentacion = $n['id_presentacion_comercial'];
      $fechahoy = $n['fecha_creacion'];
      $fechaprogramacion = $n['fecha_programacion'];
      $numerodelote = $n['numero_lote'];
      $tamanototallote = $n['tamano_lote'];
      $tamanolotepresentacion = $n['lote_presentacion'];
      $unidadesxlote = $n['unidad_lote'];
      $estado = $n["estado"];
    }
  ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sistema de Ordenes de Producción">
  <meta name="author" content="Teenus SAS">

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
  <title>Samara Cosmetics</title>


  <?php include('./partials/scripts.php'); ?>
  
  <style type="text/css">
    .tcrearBatch {
      color: #fff;
    }
  </style>
  
  <script type="text/javascript">
      $(function () {
          $('#tamanototallote, #tamanolotepresentacion').keyup(function () {
              var value1 = parseFloat($('#tamanototallote').val()) || 0;
              var value2 = parseFloat($('#tamanolotepresentacion').val()) || 0;
              $('#unidadesxlote').val(value1 / value2);
          });
      });

      function cargarreferencia() {
          $('#name-submit').click();
      }
  </script>
</head>

<body class="fix-header fix-sidebar card-no-border">

<div id="contenedor">
  <?php
    include("modal/modal_clonar.php");
    include("modal/modal_filtradoFechas.php");
    include("modal/modal_crearbatch.php");
    include("modal/modal_multipresentacion.php");
    include("modal/modal_cambiarContrasena.php");
  ?>

<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
</div>

<div id="main-wrapper" style="padding-top:15px; padding-left:15px; padding-right:15px">
  
<?php include('./partials/header.php'); ?>

  <div class="row page-titles">
    <div class="col-md-3 col-2 align-self-right">
      <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>Batch Record</b></h1>
    </div>
    <div class="col-md-1 col-4 align-self-center"></div>
    <div class="col-md-8 col-2 align-self-center">
      <div class="container">
        <div class="row" style="position:relative; left:320px">
          <div class="col-lg-2" style="padding-right:0px">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle"
                      style="background-color:#fff;color:#FF8D6D; ;padding-top: 12px;padding-bottom: 12px;padding-left: 25px;padding-right: 25px; border-color:#FF8D6D;"
                      type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">Acciones
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modal_Multipresentacion">Multipresentación</a>
                <a class="dropdown-item" href="#" onclick="clonar()">Clonar</a>
              </div>
            </div>
          </div>
          <div class="col-lg-2" style="padding-right:15px;padding-left:0px">
            <button type="button" style="background-color:#fff;color:#FF8D6D"
                    class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" data-toggle="modal"
                    data-target="#filtrado">Filtrar
            </button>
          </div>
          <div class="col-lg-3">
            <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md"
                    onclick="$('#myModal').modal('show');"><strong>Crear Batch Record</strong></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla -->
  <!-- <div id="colabatch"></div> -->
  <div class="col-md-12 col-2 align-self-right">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="example" name="tablaBatch">
            <thead>
            <tr>
              <th></th>
              <th>Orden</th>
              <th>Referencia</th>
              <th>Nombre</th>
              <th>Presentación</th>
              <th>Lote</th>
              <th>Tamaño(kg)</th>
              <th>Propietario</th>
              <th>Creación</th>
              <th>Programación</th>
              <th>Estado</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
              while ($rows = mysqli_fetch_assoc($sql6)) {
                ?>
                <tr>
                  <td><input type="radio" id='express' name="optradio" value="<?= $rows['id_batch']; ?>"></td>
                  <td><?= $rows['numero_orden']; ?></td>
                  <td><?= $rows['referencia']; ?></td>
                  <td><?= $rows['nombre_referencia']; ?></td>
                  <td><?= $rows['presentacion']; ?></td>
                  <td><?= $rows['numero_lote'] ?></td>
                  <td><?= $rows['tamano_lote']; ?></td>
                  <td><?= $rows['nombre']; ?></td>
                  <td><?= $rows['fecha_creacion']; ?></td>
                  <td><?= $rows['fecha_programacion']; ?></td>
                  <td><?= $rows['estado'] == 1 ? "Activo" : "Inactivo" ?></td>

                  <td><a href="crear-batch.php?edit=<?= $rows['id_batch']; ?>" class="edit"><i
                        class="large material-icons" data-toggle="tooltip" title="Editar"
                        style="color:rgb(255, 193, 7)">&#xE254;</i></a></td>
                  <td><a href="#" onclick="deleteBatch(event)" attr-id="<?= $rows['id_batch']; ?>" class="delete"><i
                        class="large material-icons" data-toggle="tooltip" title="Eliminar"
                        style="color:rgb(234, 67, 54)">delete_forever</i></a></td>
                </tr>
                <?php
              }
            ?>
            </tbody>
          </table>
          <div id="result"></div>
        </div>
      </div>
    </div>
  </div>
<section id="tabla-resultado"></section>


<!-- jquery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="vendor/jquery/jquery.serializeToJSON.min.js"></script>

<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="js/waves.js"></script>

<!-- Datatables -->
<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#colabatch').load('componentes/colabatch.php')
    });
</script>

<script type="text/javascript">
    $(function () {
        var $src = $('#tamanototallote'),
            $dst = $('#tamanolotepresentacion');
        $src.on('input', function () {
            $dst.val($src.val());
        });
    });
</script>

<script type="text/javascript">
/*     $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var est = parseInt($('#est').val(), 10);
            var max = parseInt($('#est').val(), 10);
            var age = parseFloat(data[10]) || 0; // use data for the age column
            if ((isNaN(est) && isNaN(max)) ||
                (isNaN(est) && age <= max) ||
                (est <= age && isNaN(max)) ||
                (est <= age && age <= max)) {
                return true;
            }
            return false;
        }
    );
    var table
    $(document).ready(function () {
        table = $('#example').DataTable({
            columnDefs: [{
                targets: [4],
                render: (data, type, row) => {
                    return $.number(data, 0, ',', '.')
                }
            }]
        });
        table.destroy();
        $('#est').keyup(function () {
            table.draw();
        });
    }); */
</script>

<script>
    function displayRadioValue() {
        var ele = document.getElementsByName('optradio');

        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked)
                document.getElementById("result").innerHTML = "you Gender: " + ele[i].value;
        }
    }
</script>

<script src="js/sidebarmenu.js"></script>
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/plugins/jquery/jquery.number.min.js"></script>
  <!--Custom JavaScript -->
  <script src="js/global.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/utils/crearbatch.js"></script>
  <script src="js/datatables.js"></script>
  <script src="vendor/jquery-confirm/jquery-confirm.min.js"></script>

  <!--Alertify-->
  <script type="text/javascript" src="js/alertify.js"></script>
  <script src="js/filterDate.js"></script>
  <script src="js/autoNumeric.min.js"></script>
  <script src="html/vendor/bootstrap/js/popper.js"></script>

<?php if ($update) { ?>
  <script>
      cargarData()
  </script>
<?php } ?>



</body>

</html>