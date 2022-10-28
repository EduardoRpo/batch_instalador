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
include_once("modal/m_observaciones.php");


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
        <div class="botones-group">
          <div class="dropdown btn-acciones">
            <button class="btn btn-secondary dropdown-toggle " style="background-color:#fff;color:#FF8D6D; border-color:#FF8D6D;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <!-- <a class="dropdown-item" href="#" onclick="multipresentacion()"><i class="fa fa-superscript"></i> Multipresentación</a> -->
              <?php if ($_SESSION['rol'] != 6) {  ?>
                <a class="dropdown-item" href="#" onclick="clonar()"><i class="fa fa-clone"></i> Clonar</a>
                <a class="dropdown-item" href="#" onclick="batchEliminados()"><i class="fa fa-eraser"></i> Batch Eliminados</a>
                <a class="dropdown-item pdf" href="#"><i class="fa fa-download"></i> Imprimir PDF</a>
              <?php } ?>
              <?php if ($_SESSION['rol'] == 6 or $_SESSION['rol'] == 1) {  ?>
                <a class="dropdown-item" href="#" id="btnCargarExcelPedidos"><i class="fa fa-download"></i> Pedidos</a>
              <?php } ?>
            </div>
          </div>

          <!-- ambos botones tienen hidden-sm-down -->
          <!-- <button type="button" class="btn waves-effect waves-light btn-danger btn-filtrar" style="background-color:#fff;color:#FF8D6D" onclick="filtrarfechas()">
              Filtrar
            </button> -->
          <?php if ($_SESSION['rol'] != 6) {  ?>
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
              <div class="row">
                <div class="col" style="display: flex; width:70%">
                  <input class="form-control" type="file" id="filePedidos" accept=".xls,.xlsx">
                  <button class="btn btn-warning ml-3" id="btnImportarPedidos">Importar Pedidos</button>
                  <button class="btn btn-danger ml-3" id="btnPedidosNoEncontrados">Pedidos No Encontrados</button>
                </div>
                <div class="col-lg-4 fechaImporte">
                  <?php if (isset($_SESSION['fecha_importe'])) { ?>
                    <p>Fecha y Hora de importación: <?php echo $_SESSION['fecha_importe'] ?>, <?php echo $_SESSION['hora_importe'] ?> </p>
                  <?php } ?>
                </div>
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
                <?php if ($_SESSION['rol'] == 6 or $_SESSION['rol'] == 1) {  ?>
                  <li class="nav-item">
                    <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="false">Pedidos</a>
                  </li>
                <?php  } ?>
                <li class="nav-item">
                  <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Pre-Planeados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">Planeados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="true">Programados</a>
                </li>
                <?php if ($_SESSION['rol'] != 6) {  ?>
                  <li class="nav-item">
                    <a class="nav-link" id="five-tab" data-toggle="tab" href="#five" role="tab" aria-controls="Five" aria-selected="false">Cerrados</a>
                  </li>
                <?php  } ?>
                <div style="display:grid;justify-content:end;font-size:x-large;margin-left:auto" class="mr-3">
                  <div id="numberWeek"></div>
                </div>
              </ul>
            </div>

            <div class="card-body" id="cardPreBatch">
              <div class="tab-content">
                <div class="tab-pane fade mt-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="mt-3 text-center">
                        <button class="toggle-vis btn btn-primary hideTitle" id="1">Propietario</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="2">Pedido</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="3">F_Pedidos</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="4">Granel</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="5">Referencia</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="6">Observaciones</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="7">Producto</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="8">Cant_original</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="9">Saldo Ofima</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="10">Acum_Prog</button>
                        <button class="toggle-vis btn btn-primary hideTitle" id="11">Cant_Programar</button>
                        <button class="toggle-vis btn btn-primary" id="calcLote">Calcular Lote</button>
                      </div>
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered" id="tablaPedidos" name="tablaPedidos">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade mt-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="row ml-1">
                      <div class="col-md-9 align-self-center">
                        <div class="card">
                          <div class="card-block">
                            <div class="payment-of-tax">
                              <div class="table-responsive">
                                <label for="">Capacidad Pre-planeada</label>
                                <table class="table table-bordered table-striped table-hover" id="tblCalcCapacidadEnvasado" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>S</th>
                                      <th>Total Liquidos(Kg)</th>
                                      <th>Total Solidos(Kg)</th>
                                      <th>Total Semi-Solidos(Kg)</th>
                                    </tr>

                                  </thead>
                                  <tbody class="tblCalcCapacidadEnvasadoBody">
                                    <tr>
                                      <td>42</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="row justify-content-end mt-2 cardPlanning">
                        <div class="col-2 text-center">
                          <label>Total:</label>
                          <input type="text" id="totalVentaPre" class="form-control text-center" style="font-weight: bold;" disabled>
                        </div>
                        <div class="col-2">
                          <label for="tipoSimulacion">Simulación</label>
                          <select name="tipoSimulacion" id="tipoSimulacion" class="form-control text-center">
                            <option selected="" disabled="">Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>
                        </div>
                        <div class="col-xs-2 mr-3">
                          <button type="button" id="btnPlanear" class="btn waves-effect waves-light btn-danger" style="width: 120px; margin-top:33px;">
                            <strong>Planear</strong>
                          </button>
                        </div>
                        <div class="col-xs-2">
                          <button type="button" id="btnLimpiar" class="btn waves-effect waves-light btn-warning" style="width: 120px; margin-top:33px; margin-right: 35px">
                            <strong>Limpiar</strong>
                          </button>
                        </div>
                      </div>
                      <div class="cardUpdatePrePlaneado mt-2 ml-4">
                        <form id="formUpdatePrePlaneado" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-2">
                              <label class="form-label">Pedido</label>
                              <input type="text" class="form-control text-center" id="num_pedido" style="font-weight: bold;" disabled>
                            </div>
                            <div class="col">
                              <label class="form-label">Granel</label>
                              <input type="text" class="form-control text-center" id="name_granel" style="font-weight: bold;" disabled>
                            </div>
                            <div class="col-2">
                              <label class="form-label">Referencia</label>
                              <input type="text" class="form-control text-center" id="ref_product" style="font-weight: bold;" disabled>
                            </div>
                            <div class="col-2">
                              <label class="form-label">Unidad Lote</label>
                              <input type="number" class="form-control text-center" id="unity">
                            </div>
                            <div class="col">
                              <button type="button" class="btn waves-effect waves-light btn-danger" id="savePrePlaneado" style="margin-top:33px">
                                <strong>Guardar</strong>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>

                      <div class=" card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaPrePlaneacion" name="tablaPrePlaneacion" style="width: 100%">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade mt-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="row ml-1">
                      <div class="col-md-9 align-self-center">
                        <div class="card">
                          <div class="card-block">
                            <div class="payment-of-tax">
                              <div class="table-responsive">
                                <label for="">Capacidad Planeada </label>
                                <table class="table table-bordered table-striped table-hover" id="tblCalcCapacidadEnvasado" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>S</th>
                                      <th>Total Liquidos(Kg)</th>
                                      <th>Total Solidos(Kg)</th>
                                      <th>Total Semi-Solidos(Kg)</th>
                                    </tr>

                                  </thead>
                                  <tbody class="tblCalcCapacidadEnvasadoBody">
                                    <tr>
                                      <td>42</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="row justify-content-end mt-3">
                        <div class="col-2 text-center">
                          <label>Total:</label>
                          <input type="text" id="totalVentaPlan" class="form-control text-center" style="font-weight: bold;" disabled>
                        </div>
                        <div class="col-2">
                          <button type="button" id="btnProgramar" class="btn waves-effect waves-light btn-danger" style="width: 120px; margin-top: 33px">
                            <strong>Programar</strong>
                          </button>
                        </div>
                      </div>
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatchPlaneados" name="tablaBatchPlaneados" style="width: 100%;">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade show active mt-3" id="four" role="tabpanel" aria-labelledby="four-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="row ml-1">
                      <div class="col-md-9 align-self-center">
                        <div class="card">
                          <div class="card-block">
                            <div class="payment-of-tax">
                              <div class="table-responsive">
                                <label for="">Capacidad Programada </label>
                                <table class="table table-bordered table-striped table-hover" id="tblCalcCapacidadEnvasado" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>S</th>
                                      <th>Total Liquidos(Kg)</th>
                                      <th>Total Solidos(Kg)</th>
                                      <th>Total Semi-Solidos(Kg)</th>
                                    </tr>
                                  </thead>
                                  <tbody class="tblCalcCapacidadEnvasadoBody">
                                    <tr>
                                      <td>42</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                      <td>100%</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatch">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade mt-3" id="five" role="tabpanel" aria-labelledby="five-tab">
                  <div class="col-md-12 align-self-right">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered " id="tablaBatchCerrados" name="tablaBatchCerrados">

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

    <script src="/html/js/global/searchData.js"></script>

    <script src="/html/js/batch/tables/tableBatchProgramados.js"></script>
    <script src="/html/js/batch/tables/tableBatchEliminados.js"></script>
    <script src="/html/js/batch/tables/tableBatchPlaneados.js"></script>
    <script src="/html/js/batch/tables/tableBatchPedidos.js"></script>
    <script src="/html/js/batch/tables/tableBatchPrePlaneacion.js"></script>
    <script src="/html/js/batch/tables/batcheliminados.js"></script>

    <script src="/html/js/batch/calc/calcularLote.js"></script>
    <script src="/html/js/batch/calc/calcWeek.js"></script>

    <script src="/html/js/batch/pedidos/generalPedidos.js"></script>
    <script src="/html/js/batch/pedidos/importPedidos.js"></script>
    <script src="/html/js/batch/pedidos/pedidos.js"></script>
    <script src="/html/js/batch/planeacion/planeacion.js"></script>
    <script src="/html/js/batch/prePlaneacion/prePlaneacion.js"></script>
    <script src="/html/js/global/link-comentario.js"></script>

    <script src="/html/js/batch/multipresentacion/multipresentacion.js"></script>
    <script src="/html/js/batch/multipresentacion/addMulti.js"></script>
    <script src="/html/js/batch/multipresentacion/deleteMulti.js"></script>
    <script src="/html/js/batch/multipresentacion/saveMulti.js"></script>
    <script src="/html/js/batch/multipresentacion/updateMulti.js"></script>
    <script src="/html/js/batch/multipresentacion/multiCalc.js"></script>

    <script src="/html/js/batch/crearBatch/batch.js"></script>
    <script src="/html/js/batch/crearBatch/crearbatch.js"></script>
    <script src="/html/js/batch/crearBatch/selectores.js"></script>

    <script src="/html/js/batch/filtradofechas.js"></script>
    <script src="/html/js/batch/clonar.js"></script>
    <script src="/html/js/batch/cargarbatchpdf.js"></script>

    <script src="js/utils/custom.js"></script>
    <script src="js/calendario/calendar.js"></script>

    <script src="/html/js/global/loadinfo-global.js"></script>
    <script src="/html/js/global/notificaciones.js"></script>

    <script src="/admin/sistema/js/import/import.js"></script>
    <script src="/admin/sistema/js/import/file.js"></script>
    <!-- <script src="/html/js/export/export.js"></script> -->
    <!-- <script src="/html/js/export/file.js"></script>
    <script src="/html/js/export/dataBatch.js"></script> -->


</body>

</html>