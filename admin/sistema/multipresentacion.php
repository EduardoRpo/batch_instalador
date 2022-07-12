<?php require_once('php/sesion/sesion.php'); include_once('modal/m_multipresentacion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Multipresentacion</title>
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

  <!-- Multiselect -->
  <link rel="stylesheet" href="../../assets/multiselect/css/multi-select.css">

</head>

<body class="">
  <div class="wrapper ">

    <?php include('./admin_componentes/sidebar.php'); ?>

    <div class="main-panel" id="main-panel">
      <?php include('./admin_componentes/navegacion.php'); ?>
      <div class="panel-header panel-header-sm"></div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Multipresentación</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="adicionarMulti">Crear</button>
                <!-- <select multiple="multiple" class="form-control" name="cmbMultipresentacion[]" id="cmbMultipresentacion"></select> -->


                <!-- <button type="button" class="btn btn-primary" id="adEquipos">Configurar</button> -->
                <!-- <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Equipo</b></label>
                  <label for=""><b>Línea</b></label>
                  <input type="text" id="txtid_Equipo" readonly hidden>
                  <input type="text" name="txtEquipo" id="txtEquipo" class="form-control" placeholder="Linea" style="width: 500px;" required>
                  
                  <select name="linea" id="cmbLinea" class="form-control"></select>
                  <button type="button" class="btn btn-primary" id="btnguardarEquipos">Guardar</button>
                </form> -->

                <!-- <hr>
              </div>
              <div class="card-body"> -->
                <div class="table-responsive">
                  <table id="tblMulti" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <form action="" id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 10);" disabled="disabled">Cargar Datos</button>
              </form>
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

  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- Multiselect -->
  <script src="../../assets/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/multiP/tblmulti.js"></script>
  <script src="js/multiP/multi.js"></script>
  <script src="js/global/notifications.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/cargarDatos.js"></script>
  <!-- <script src="js/cargarDatos.js"></script> -->




</body>

</html>