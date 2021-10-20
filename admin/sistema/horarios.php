<?php
require_once('php/sesion/sesion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Usuarios</title>
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

    <?php include('./admin_componentes/sidebar.php'); ?>

    <div class="main-panel" id="main-panel">
      <?php include('./admin_componentes/navegacion.php'); ?>
      <div class="panel-header panel-header-sm"></div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Configuración Horarios Batch Record</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" id="btnCrearUsuarios">Crear Usuarios</button> -->

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  Ingrese los <strong>horarios</strong> en los cuales el sistema leera los pedidos para crear los Batch Record
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
              </div>
              <div class="card-body">
                <div class="" style="display: flex;">
                  <label for="timeOne">Seleccione la Hora:</label>
                  <input type="time" id="timeOne" class="form-control ml-3 mr-3" style="width: 20%; height:fit-content;">
                  <button type="button" class="btn btn-primary" id="btnSeleccionarHorariosBatch" style="height:fit-content; margin-top:0px;"><i class="fa fa-angle-right fa-1x" aria-hidden="true"></i></button>
                  <!-- <label for="timeTwo">Segundo Horarios</label>
                  <input type="time" id="timeTwo" class="form-control ml-3" style="width: 20%;"> -->
                  <div id="tiempos" style="margin-left: 300px;">
                    <label for=""><b>Horas Configuradas</b></label>
                    <div class="table-responsive">
                      <table id="tb_hora" class="table-bordered">
                        <thead>
                          <tr>
                            <th class="col-sm-2 centrado">No.</th>
                            <th class="col-sm-3 centrado">Hora Programada</th>
                            <th class="col-sm-3 centrado">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="centrado">1</th>
                            <th class="centrado" id="hora1"></th>
                            <th class="centrado" id="1"><a href="#"><i id="1" class="fa fa-trash-o link-eliminar" aria-hidden="true"></i></a></th>
                          </tr>
                          <tr>
                            <th class="centrado">2</th>
                            <th class="centrado" id="hora2"></th>
                            <th class="centrado" id="2"><a href="#"><i id="2" class="fa fa-trash-o link-eliminar" aria-hidden="true"></i></a></th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div style="display: flex; justify-content:space-around">
                  <button type="button" class="btn btn-primary mt-3" id="btnGuardarHorariosBatch">Guardar</button>
                  <!-- <button type="button" class="btn btn-primary mt-3" id="btnEjecutarHorariosBatch">Ejecutar</button> -->
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

  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->
  <script src="https://kit.fontawesome.com/d35ea76538.js" crossorigin="anonymous"></script>
  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/horarios.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>