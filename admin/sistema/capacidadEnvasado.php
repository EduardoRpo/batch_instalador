<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Samara Cosmetics | Capacidad de Envasado</title>
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
                                <div class="row">
                                    <div class="col">
                                        <h4 class="card-title">Capacidad Envasado x Semana</h4>
                                    </div>
                                    <div class="col-2">
                                        <label for="numSemana">Semana No</label>
                                        <select name="numSemana" id="numSemana" class="form-control text-center">
                                        </select>
                                    </div>
                                </div>
                                <div class="cardSaveEnvasado">
                                    <form id="formSaveEnvasado" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">Envasado</label>
                                                <input type="text" class="form-control text-center" name="linea" id="linea" disabled style="font-weight: bold;">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Turno 1</label>
                                                <input type="number" class="form-control text-center" name="turno1" id="turno1">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Turno 2</label>
                                                <input type="number" class="form-control text-center" name="turno2" id="turno2">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Turno 3</label>
                                                <input type="number" class="form-control text-center" name="turno3" id="turno3">
                                            </div>
                                            <div class="col mt-4">
                                                <input type="submit" class="form-control btn-primary" id="saveEnvasado" value="Guardar">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tblCapacidadEnvasado" class="table-striped row-borde">
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
    <script src="/admin/sistema/js/auditory/capacidadEnvasado/tblCapacidadEnvasado.js"></script>
    <script src="/admin/sistema/js/global/numSemanas.js"></script>
    <script src="/admin/sistema/js/auditory/capacidadEnvasado/capacidadEnvasado.js"></script>

</body>

</html>