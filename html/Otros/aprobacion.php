<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="ISO-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
  <title>Samara Cosmetics</title>
  <!-- Bootstrap Core CSS -->
  <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <!-- You can change the theme colors from here -->
  <link href="css/colors/blue.css" id="theme" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <!-- <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php
    require('savebatch.php');
    $hoy = date('Y-m-d');
    $sql5 = mysqli_query($conn, "SELECT * From producto");
    $sql6 = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = '$hoy'");
    if (isset($_GET['edit'])) {
      $idbatch = $_GET['edit'];
      $update = true;
      $record = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia WHERE id_batch=$idbatch");

      if (count($record) == 1) {
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
        $tamañototallote = $n['tamano_lote'];
        $tamañolotepresentacion = $n['lote_presentacion'];
        $unidadesxlote = $n['unidad_lote'];

      }
    }
  ?>
  <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

</head>

<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
  <!-- ============================================================== -->
  <!-- Topbar header - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
      <!-- ============================================================== -->
      <!-- Logo -->
      <!-- ============================================================== -->
      <div class="navbar-header">
        <a class="navbar-brand">
          <!-- Logo text --><span>
                         
                         <!-- Light Logo text -->    
                         <img src="../assets/images/logo-light-text2.png" class="light-logo" alt="homepage"/></span>
        </a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <div class="navbar-collapse">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav mr-auto mt-md-0">
          <!-- This is  -->
          <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                                  href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
          <!-- ============================================================== -->
          <!-- Search -->
          <!-- ============================================================== -->

        </ul>
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
        <ul class="navbar-nav my-lg-0">
          <!-- ============================================================== -->
          <!-- Profile -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Jonathan Hernandez <i
                class="fas fa-chevron-circle-down"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuenlace">
              <a href="#" class="dropdown-item">Cambiar contraseña</a>
              <a href="../index.html" class="dropdown-item">Cerrar sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- ============================================================== -->
  <!-- End Topbar header -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Left Sidebar - style you can find in sidebar.scss  -->
  <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- End Left Sidebar - style you can find in sidebar.scss  -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Page wrapper  -->
  <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="row page-titles">
    <div class="col-md-5 col-2 align-self-right">
      <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>Aprobación</b></h1>
    </div>
    <div class="col-md-3 col-4 align-self-center">
      <!-- Search form -->
      <input type="text" name="fechahoy" value="<?php echo date('Y-m-d'); ?>" readonly class="form-control datepicker"
             hidden>
    </div>
    <div class="col-md-2 col-8 align-self-center">

    </div>
    <!--<button type="button" onclick="displayRadioValue()">
           Submit
       </button> -->

    <div class="col-md-2 col-2 align-self-center">
      <div class="container">
        <!-- Trigger the modal with a button -->

      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- End Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->

  <div class="row">
    <div class="col-2 align-self-center">
      <table class="table" style="margin-left: 15%; margin-bottom: 180%">

        <tbody>
        <tr>
          <td>
            <button type="button" class="btn waves-effect waves-light btn-danger pull-center" style="width: 80%">
              Todos<br/>los batch record
            </button>
          </td>
        </tr>


        <tr>
          <td>
            <select class="selectpicker form-control" id="filtrar1" style="width: 80%">
              <option selected hidden>Filtrar</option>
              <option>Activo</option>
              <option>Detenido</option>
              <option>En proceso</option>
            </select>
          </td>
        </tr>


        </tbody>
      </table>
    </div>
    <!-- column -->
    <div class="col-md-10 col-2 align-self-right">
      <div class="card">
        <div class="card-block">
          <!--<h4 class="card-title">Basic Table</h4>
         <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="example">
              <thead>
              <tr>

                <th># de Orden</th>
                <th>Referencia</th>
                <th>Nombre Referencia</th>
                <th>Presentacion comercial</th>
                <th>Linea</th>
                <th>Propietario</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Programación</th>
                <th>Estado</th>
                <th></th>

              </tr>
              </thead>
              <tbody>

              <?php
                while ($rows = mysqli_fetch_assoc($sql6)) {
                  ?>
                  <tr>


                    <td><?php echo $rows['numero_orden']; ?></td>
                    <td><?php echo $rows['referencia']; ?></td>
                    <td><?php echo $rows['nombre_referencia']; ?></td>
                    <td><?php echo $rows['presentacion']; ?></td>
                    <td><?php echo $rows['nombre']; ?></td>
                    <td><?php echo $rows['nombre_linea']; ?></td>
                    <td><?php echo $rows['fecha_creacion']; ?></td>
                    <td><?php echo $rows['fecha_programacion']; ?></td>
                    <td><?php echo $rows['estado']; ?></td>

                    <td>
                      <form method="post" action="aprobacioninfo.php">
                        <input type="submit" name="action" value="Ingresar" class="btn btn-primary"/>
                        <input type="hidden" name="idbatch" value="<?php echo $rows['id_batch']; ?>"/>
                        <input type="hidden" name="referencia" value="<?php echo $rows['referencia']; ?>"/>
                      </form>
                    </td
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
  </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ==============================================================
<footer class="footer">
    ©  <b>2020</b> Desarrollado por Teenus S.A.S <a href="https://www.teenus.com.co/" target="_blank"><img src="../assets/images/logo-teenus.png" alt="Teenus"/></a></div>
</footer>
-->
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->


<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>

<script type="text/javascript">
    $.fn.dataTable.ext.search.push(
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

    $(document).ready(function () {
        var table = $('#example').DataTable();
        table.destroy();

        // Event listener to the two range filtering inputs to redraw on input
        $('#est').keyup(function () {

            table.draw();
        });
    });

</script>


<!--Menu sidebar -->
<script src = "js/sidebarmenu.js" ></script>
<!--stickey kit -->
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
//<!--Custom JavaScript -->
<script src="js/global.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/datatables.js"></script>

</body>

</html>
