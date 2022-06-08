<?php
require_once('../html/sesiones/sesion.php');
sesiones(1);
require_once('../conexion.php');

include_once("modal/modal_clonar.php");
include_once("modal/m_batchEliminados.php");
include_once("modal/m_crearbatch.php");
//include_once("modal/modal_tamanioLote.php");
include_once("modal/modal_multipresentacion.php");
include_once("modal/modal_cambiarContrasena.php");
include_once("modal/m_batch_pdf.php");
include_once("modal/modalPedidos.php");

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
  <!-- <link rel="icon" type="image/png" sizes="16x16" href="../BatchR/htdocs/assets/images/favicon.png"> -->

  <title>Batch | Samara Cosmetics</title>

  <?php include('./partials/scripts.php'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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

        <div class="tituloProceso">
          <h1 class="text-themecolor"><b>Batch Record</b></h1>
        </div>
        <?php if ($_SESSION['rol'] != 6) {  ?>
          <div class="botones-group">
            <div class="dropdown btn-acciones">
              <button class="btn btn-secondary dropdown-toggle " style="background-color:#fff;color:#FF8D6D; border-color:#FF8D6D;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!-- <a class="dropdown-item" href="#" onclick="multipresentacion()"><i class="fa fa-superscript"></i> Multipresentación</a> -->
                <a class="dropdown-item" href="#" onclick="clonar()"><i class="fa fa-clone"></i> Clonar</a>
                <a class="dropdown-item" href="#" onclick="batchEliminados()"><i class="fa fa-eraser"></i> Batch Eliminados</a>
                <a class="dropdown-item pdf" href="#"><i class="fa fa-download"></i> Imprimir PDF</a>
                <a class="dropdown-item" href="#" id="btnCargarExcelPedidos"><i class="fa fa-download"></i> Pedidos</a>
              </div>
            </div>

            <!-- ambos botones tienen hidden-sm-down -->
            <!-- <button type="button" class="btn waves-effect waves-light btn-danger btn-filtrar" style="background-color:#fff;color:#FF8D6D" onclick="filtrarfechas()">
              Filtrar
            </button> -->

            <button type="button" class="btn waves-effect waves-light btn-danger btn-crearbatch" onclick="mostrarModal();">
              <strong>Crear Batch Record</strong>
            </button>

          </div>

        <?php } ?>
      </div>
    </div>

    <div class="cardImportarPedidos">
      <div class="container-fluid">
        <form id="formImportarPedidos" enctype="multipart/form-data">
          <div class="card">
            <div class="card-body p-3">
              <label for="formFile" class="form-label"> Importar Archivo de Pedidos</label>
              <div style="display: flex; width:50%">
                <input class="form-control" type="file" id="filePedidos" accept=".xls,.xlsx">
                <button class="btn btn-warning ml-3" id="btnImportarPedidos">Importar Pedidos</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="contenedor-fechas" id="filtrafechas">
        <form id="formFechas">
          <div class="row">
            <div class="col-md-6 col-2 align-self-center" style="padding-bottom: 10px;left:50px; display:flex">
              <input type="checkbox" class="form-check-input" id="checkFechaCreacion" name="typeFilter" hidden>
              <label class="form-check-label" for="checkFechaCreacion" style="padding-right: 10px;">Creación</label>
              <input type="checkbox" class="form-check-input" id="checkFechaProgramacion" name="typeFilter" hidden>
              <label class="form-check-label" for="checkFechaProgramacion">Programación</label>
            </div>
          </div>

          <div class="row fechasfiltrado">
            <div class="col-7 align-self-center">
              <input type="text" name="daterange" id="daterange" value="" class="form-control" />
            </div>
            <div class="col-2 align-self-center">
              <button id="btnfiltrar" class="btn btn-info" type="button">Eliminar Filtro</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="container1" style="margin-left: 10px;margin-right:10px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" style="background: #FCF9F8;">
              <ul class="nav nav-tabs card-header-tabs" id="batch-list" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="false">Planeación</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Inactivos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="true">Abiertos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="false">Cerrados</a>
                </li>
              </ul>
            </div>

            <div class="card-body" id="cardPreBatch">
              <div class="tab-content">
                <div class="tab-pane fade mt-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="mt-3 text-center">
                        <button class="toggle-vis btn btn-primary hideTitle" id="0">Propietario</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="1">Pedido</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="2">F_Pedidos</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="3">Granel</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="4">Referencia</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="5">Producto</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="6">Cant_original</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="7">Saldo Ofima</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="8">Acum_Prog</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="9">Cant_Programar</button>
                        <button class="toggle-vis btn btn-primary" id="calcLote" style="margin-left:200px">Calcular Lote</button>

                      </div>
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaPreBatch" name="tablaPreBatch">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade mt-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatchInactivos" name="tablaBatchInactivos">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade show active mt-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatch" name="tablaBatch">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="tab-pane fade mt-3" id="four" role="tabpanel" aria-labelledby="four-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatchCerrados">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab"></div> -->
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <?php require_once __DIR__ . '/partials/scriptsJS.php'; ?>

    <script src="js/batch/dataTableBatch.js"></script>
    <script src="js/utils/custom.js"></script>
    <script src="js/batch/multipresentacion.js"></script>
    <script src="js/batch/batch.js"></script>
    <script src="js/batch/clonar.js"></script>
    <script src="js/batch/crearbatch.js"></script>
    <script src="js/batch/filtradofechas.js"></script>
    <script src="js/calendario/calendar.js"></script>
    <script src="js/global/loadinfo-global.js"></script>
    <script src="js/batch/batcheliminados.js"></script>
    <script src="../html/js/batch/cargarbatchpdf.js"></script>
    <script src="../html/js/batch/pedidos.js"></script>

    <script src="../html/js/import/import.js"></script>
    <script src="../html/js/batch/importPedidos.js"></script>
    <script src="../html/js/import/file.js"></script>
    <script src="../html/js/global/notificaciones.js"></script>
    <script src="../html/js/batch/calcularLote.js"></script>
    <script src="../html/js/batch/generalPreprogramacion.js"></script>

</body>

</html>