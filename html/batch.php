<?php
require_once('./sesion/sesion.php');
require_once('../conexion.php');
include("modal/modal_clonar.php");
include("modal/m_crearbatch.php");
include("modal/modal_multipresentacion.php");
include("modal/modal_cambiarContrasena.php");
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
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>

<body class="fix-header fix-sidebar card-no-border">

  <div id="contenedor">
    <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
      </svg>
    </div>
    <div id="main-wrapper">
      <?php include('./partials/header.php'); ?>
      <div class="contenedorPrincipal">
        <h1 class="text-themecolor tituloProceso"><b>Batch Record</b></h1>
        <div class="dropdown btn-acciones">
          <button class="btn btn-secondary dropdown-toggle btn-md " style="background-color:#fff;color:#FF8D6D; border-color:#FF8D6D;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="multipresentacion()">Multipresentación</a>
            <a class="dropdown-item" href="#" onclick="clonar()">Clonar</a>
            <a class="dropdown-item" href="#" onclick="eliminado()">Batch Eliminados</a>
          </div>
        </div>
        <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md btn-filtrar" style="background-color:#fff;color:#FF8D6D" onclick="filtrarfechas()">Filtrar</button>
        <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md btn-crearbatch" onclick="mostrarModal();"><strong>Crear Batch Record</strong></button>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="container" id="filtrafechas" style="left:800px">
        <form id="formFechas">
          <div class="row">
            <div class="col-md-6 col-2 align-self-center" style="padding-bottom: 10px;left:50px">
              <input type="checkbox" class="form-check-input" id="checkFechaCreacion" name="typeFilter" hidden>
              <label class="form-check-label" for="checkFechaCreacion" style="padding-right: 10px;">Creación</label>
              <input type="checkbox" class="form-check-input" id="checkFechaProgramacion" name="typeFilter" hidden>
              <label class="form-check-label" for="checkFechaProgramacion">Programación</label>
            </div>
          </div>

          <div class="row fechasfiltrado">
            <div class="col-md-3 col-2 align-self-center">
              <input type="text" name="daterange" id="daterange" value="" class="form-control" />
            </div>
            <div class="col-md-1 col-2 align-self-center">
              <button id="btnfiltrar" class="btn btn-info" type="button">Eliminar Filtro</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-12 col-2 align-self-right">
      <div class="card">
        <div class="card-block">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tablaBatch" name="tablaBatch">
              <thead>
                <tr>
                  <th></th>
                  <th>No</th>
                  <th>Orden</th>
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Lote</th>
                  <th>Tamaño(kg)</th>
                  <th>Propietario</th>
                  <th>Creación</th>
                  <th>Programación</th>
                  <th>Estado</th>
                  <th>Multi</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/utils/jquery.slimscroll.js"></script>
    <script src="vendor/jquery/jquery.serializeToJSON.min.js"></script>

    <!-- Bootstrap -->
    <script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="js/waves.js"></script> -->

    <!-- Datatables -->
    <script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>

    <!-- Calendario -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Menu -->
    <script src="js/utils/sidebarmenu.js"></script>
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


    <!--Custom JavaScript -->
    <script src="js/utils/datatables.js"></script>
    <script src="vendor/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="js/utils/custom.js"></script>
    <script src="js/batch/multipresentacion.js"></script>
    <script src="js/batch/batch.js"></script>
    <script src="js/batch/clonar.js"></script>
    <script src="js/batch/crearbatch.js"></script>
    <script src="js/batch/filtradofechas.js"></script>
    <script src="js/calendario/calendar.js"></script>
    <script src="js/global/loadinfo-global.js"></script>


    <!--Alertify-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.21/api/fnGetTds.js"></script>

</body>

</html>