<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Certificado | Samara Cosmetics</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="../sistema/css/estilos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
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
                <h4 class="card-title"> <strong>Certificado</strong></h4>
                <hr>

              </div>
              <div class="card-body">
                <div>
                  <label for="">Buscar</label>
                  <input type="text" class="form-control" id="search" style="width: 30%;" data-toggle="popover" data-content="Puede buscar por referencia o Lote">
                  <button class="btn btn-primary" id="buscar_cert">Buscar</button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> <strong>Busqueda</strong></h4>
                <hr>
              </div>
              <div class="card-body">
                <div>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col" class="centrado">Batch</th>
                        <th scope="col" class="centrado">Referencia</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Lote</th>
                        <th scope="col" class="centrado">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="id_batch" class="centrado"></td>
                        <td id="referencia" class="centrado"></td>
                        <td id="producto"></td>
                        <td id="lote"></td>
                        <td id="acciones" class="centrado"></td>
                      </tr>
                    </tbody>
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
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script> -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="js/certificado.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/cargarDatos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>


</body>

</html>