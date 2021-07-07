<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- <meta charset="utf-8" /> -->
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Bases Preparación</title>
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


    <div class="main-panel" id="main-panel">
      <?php
      if ($_SESSION['rol'] != 5) include('./admin_componentes/navegacion.php');
      else include('./admin_componentes/navegacion_desarrollo.php');
      if ($_SESSION['rol'] != 5) include('./admin_componentes/sidebar.php');
      else include_once('./admin_componentes/sidebar_desarrollo.php');
      ?>
      <div class="panel-header panel-header-sm">

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Bases Instructivo Preparación</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <div class="selproductos">
                  <select name="cmbReferenciaProductos" id="cmbReferenciaProductos" class="form-control" style="width: auto;"></select>
                  <!-- <input type="text" class="form-control ml-3" id="txtnombreProducto"> -->
                </div>
                <hr>
                <button type="button" class="btn btn-primary" id="adicionarInstructivo">Adicionar</button>
                <form id="frmadInstructivo" style="display: none;">
                  <label for=""><b>Actividad</b></label>
                  <label for="">Tiempo/Min</label>
                  <input type="text" id="txtId" class="form-control" hidden>
                  <input type="text" id="txtActividad" class="form-control">
                  <input type="number" name="txtTiempo" id="txtTiempo" class="form-control" placeholder="Minutos" style="text-align: center;">
                  <button type="button" class="btn btn-primary" id="txtguardarInstructivo" onclick="guardarInstructivo();">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="1">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tabla_bases_instructivo" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Actividad</th>
                        <th>Tiempo (min)</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 11);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include('./admin_componentes/footer.php'); ?>
    </div>
  </div>


  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="js/bases.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/cargarDatos.js"></script>

</body>

</html>