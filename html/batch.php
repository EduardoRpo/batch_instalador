<?php
  require_once('./sesion/sesion.php');
  require_once('../conexion.php');
  include("modal/modal_clonar.php");
  //include("modal/modal_filtradoFechas.php");
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
  <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
  <title>Samara Cosmetics</title>

  <?php include('./partials/scripts.php'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>

<body class="fix-header fix-sidebar card-no-border">

  <div id="contenedor">
    <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
      </svg>
    </div>

    <div id="main-wrapper">
  
    <?php include('./partials/header.php'); ?>

  <div class="contenedorPrincipal">
    <div class="row">
    <h1 class="text-themecolor izquierda"><b>Batch Record</b></h1>
    
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-md" style="background-color:#fff;color:#FF8D6D; border-color:#FF8D6D;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="multipresentacion()">Multipresentación</a>
            <a class="dropdown-item" href="#" onclick="clonar()">Clonar</a>
          </div>
      </div>
      
      <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" style="background-color:#fff;color:#FF8D6D" onclick="filtrarfechas()">Filtrar</button>
      <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" onclick="mostrarModal();"><strong>Crear Batch Record</strong></button>
    
    <!-- <div class="col-md-8 col-2 align-self-center">
      <div class="container">
        <div class="row" style="position:relative; left:320px">
          <div class="col-lg-2" style="padding-right:0px">
            
            </div>
          </div>-->
          
        </div>
      </div> 
    </div>
    
    <!-- <div class="card">
      <div class="card-body"> -->

     <!--  <p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
</p> -->

      <div class="panel panel-primary">  
        <div class="container" id="filtrafechas" style="left:800px"> 
          <form id="formFechas">
          <div class="row" >
            <div class="col-md-6 col-2 align-self-center" style="padding-bottom: 10px;left:50px">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="typeFilter">
              <label class="form-check-label" for="exampleCheck1" style="padding-right: 10px;">Creación</label>
              
              <input type="checkbox" class="form-check-input" id="exampleCheck2" name="typeFilter">
              <label class="form-check-label" for="exampleCheck2">Programación</label>    
            </div>
          </div>
          
          <div class="row fechasfiltrado" >
            <div class="col-md-3 col-2 align-self-center">
            <input type="text" name="daterange" value="" class="form-control" />
              <!-- <input class="form-control" id="fechaInicial" type="text" id="min" name="min" placeholder="Fecha Inicial" autocomplete="off"> -->
            </div>
          
            <!-- <div class="col-md-2 col-2 align-self-center">
              <input class="form-control" id="fechaFinal" type="text" id="max" name="max" placeholder="Fecha Final" autocomplete="off">
            </div> -->
          
            <div class="col-md-1 col-2 align-self-center">
              <button id="btnfiltrar" class="btn btn-danger" type="submit">Filtrar</button>
              
              <!-- <button id="filtrofecha" class="btn btn-warning"  onclick="ocultarfiltrarfechas();">Cerrar</button> -->
            </div>
          </div>
          </form>
        </div>
      </div> 
    <!-- </div> -->

  <!-- Tabla -->
  <!-- <div id="colabatch"></div> -->
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
                <!-- <th>Presentación</th> -->
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

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  



<!-- jquery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="js/utils/jquery.slimscroll.js"></script>
<script src="vendor/jquery/jquery.serializeToJSON.min.js"></script>

<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="js/waves.js"></script> -->

<!-- Datatables -->
<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>

<!-- Calendario -->
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<!-- <script src="jquery.ui.datepicker-es.js"></script> -->


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Menu -->
<script src="js/utils/sidebarmenu.js"></script>
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!-- <script src="../assets/plugins/jquery/jquery.number.min.js"></script> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>


<!--Custom JavaScript -->
<!-- <script src="js/global.js"></script> -->
<script src="js/utils/datatables.js"></script>
<script src="vendor/jquery-confirm/jquery-confirm.min.js"></script>
<script src="js/utils/custom.js"></script>
<script src="js/batch/batch.js"></script>
<script src="js/batch/clonar.js"></script>
<script src="js/batch/crearbatch.js"></script>
<script src="js/batch/filtradofechas.js"></script>
<script src="js/batch/multipresentacion.js"></script>
<script src="js/calendario/calendar.js"></script>


<!--Alertify-->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- <script src="js/filterDate.js"></script> -->
<!-- <script src="js/autoNumeric.min.js"></script> -->
<!-- <script src="html/vendor/bootstrap/js/popper.js"></script> -->
<!-- <script src="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"></script> -->
<script src="//cdn.datatables.net/plug-ins/1.10.21/api/fnGetTds.js"></script>

</body>

</html>