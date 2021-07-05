<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>formulas | Samara Cosmetics</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="../sistema/css/estilos.css" rel="stylesheet" />

  <!-- Datatables -->
  <!-- <link rel="stylesheet" href="../assets/datatables/datatables.min.css">
  <link rel="stylesheet" href="./htdocs/assets/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">


  <!-- Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />



</head>

<body class="">
  <div class="wrapper ">

    <?php include('./admin_componentes/sidebar_desarrollo.php');
    ?>

    <div class="main-panel" id="main-panel">
      <?php include('./admin_componentes/navegacion_desarrollo.php'); ?>
      <div class="panel-header panel-header-sm">

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Crear Formulas</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body mb-3">
                <div class="selproductos">
                  <select name="cmbReferenciaProductos" id="cmbReferenciaProductos" class="form-control" style="width: 200px;"></select>
                  <input type="text" class="form-control ml-3" id="txtnombreProducto">
                </div>
                <!-- <div style="display: flex; justify-content: flex-end">
                  <button class="btn btn-primary" id="verMateriasPrimas">Ver Materias Primas</button>
                </div> -->

                <!-- <hr> -->


              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- <div class="content" id="materiasprimas"> -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h6 class="title">Materia Prima</h6>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblMateriasPrimas" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- </div> -->
          <!-- </div> -->

          <!-- <div class="row"> -->
          <div class="col-md-6">
            <div class="card" id="cardformula_r">
              <div class="card-header">
                <h6 class="title">Formulas</h6>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblFormula" class="table-striped row-borde" style="width:100%">

                    <thead>
                      <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>

                  </table>
                  <div style="display:flexbox;width:25%;margin-left:260px">
                    <div class="input-group mb-3">
                      <!-- <label for="">Total</label> -->
                      <input type="text" id="totalPorcentajeFormulas" class="form-control" aria-label="Amount (to the nearest dollar)" disabled>
                      <span class="input-group-text">%</span>
                    </div>
                  </div>

                </div>
              </div>
              <div style="display: grid;justify-content: space-around;">
                <button class="btn btn-primary" id="guardarFormula">Guardar</button>
              </div>
              <!-- <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'formula',1);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
              </form> -->
            </div>
          </div>
        </div>

      </div>
      <?php include('./admin_componentes/footer.php'); ?>
    </div>
  </div>


  <!--   Core JS Files   -->
  <!-- <script src="../assets/js/core/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/newformulas.js"></script>
  <script src="js/importarProductos.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>