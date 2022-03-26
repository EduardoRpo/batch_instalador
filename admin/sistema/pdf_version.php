<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Version PDF | Samara Cosmetics</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  
  <link href="../sistema/css/estilos.css" rel="stylesheet" />
  <link href="../sistema/css/styles.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

  <!-- Seleccion Multiple -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

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
                <h4 class="card-title"> <strong>Versiones Batch Record PDF</strong></h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addVersion">Nueva Version PDF</button>
                <form id="frmNewVersion">
                  <div class="gridx4standar">
                    <label>Código</label>
                    <label>Versión</label>
                    <label>Fecha</label>
                    <label></label>
                    <input type="text" class="form-control text-center heightinput" id="codigo"  name="codigo"/>
                    <input type="text" class="form-control text-center heightinput" id="version" name="version" />
                    <input type="date" class="form-control text-center heightinput" id="fecha" name="fecha" />
                    <button type="button" class="btn btn-primary heightbtn" id="btnCreateVersion">Crear Versión</button>
                  </div>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblVersionPDF" class="table-striped row-borde">

                  </table>
                </div>
              </div>
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

  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/menu.js"></script>
  <script src="js/global/empty_variable.js"></script>
  <script src="js/pdf/version.js"></script>
  <script src="js/pdf/tblVersionPDF.js"></script>

  <!-- Multiple Seleccion -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>


</body>

</html>