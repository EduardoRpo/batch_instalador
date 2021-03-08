<?php
session_start();
//include('modal/modal_firma.php');
include('modal/modal_cambiarContrasena.php');
//include('modal/modal_observaciones.php');
include('modal/m_firma.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Teenus SAS">

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
  <title>Despachos | Samara Cosmetics</title>

  <!-- Bootstrap Core CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../html/css/style.css" rel="stylesheet">

  <!-- You can change the theme colors from here -->
  <link rel="stylesheet" href="../../html/css/colors/blue.css" id="theme">
  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" href="../../html/vendor/jquery-confirm/jquery-confirm.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

</head>

<body class="fix-header fix-sidebar card-no-border">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>

  <div id="main-wrapper">

    <!-- HEADER -->
    <?php include('partials/header.php'); ?>
    <!-- FIN HEADER -->

    <div class="container-fluid">
      <div class="row page-titles">
        <h1 hidden>5</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Despachos</b></h1>
        <a href="../../despachos" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div id="accordion">
          <div class="card">

            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
                  <b>INFORMACIÓN DEL PRODUCTO</b>
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">

                <div class="contenedorInfo2">

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">Fecha Programación</label>
                    <input type="date" class="form-control" id="in_fecha" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">No Orden</label>
                    <input type="text" class="form-control" id="in_numero_orden" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">Referencia</label>
                    <input type="text" class="form-control" id="in_referencia" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <table id="txtobservacionesTanques" class="itemInfo table table-striped table-bordered" style="width:80%; height: 30px;">
                      <thead>
                        <tr>
                          <th class="centrado">Presentación</th>
                          <th class="centrado">Unidades</th>
                          <th class="centrado">Total (Kg)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="fila1">
                          <td id="tanque1" class="centrado"></td>
                          <td id="cantidad1" class="centrado"></td>
                          <td id="total1" class="centrado"></td>
                        </tr>
                        <tr id="fila2">
                          <td id="tanque2" class="centrado"></td>
                          <td id="cantidad2" class="centrado"></td>
                          <td id="total2" class="centrado"></td>
                        </tr>
                        <tr id="fila3">
                          <td id="tanque3" class="centrado"></td>
                          <td id="cantidad3" class="centrado"></td>
                          <td id="total3" class="centrado"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="in_tamano_lote" class="col-form-label">Tamaño Lote (Kg)</label>
                    <input type="text" class="form-control" id="in_tamano_lote" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">No. Lote</label>
                    <input type="text" class="form-control" id="in_numero_lote" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">Linea</label>
                    <input type="text" class="form-control" id="in_linea" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="despachos1">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi1" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="despachosMulti1">DESPACHOS</b>
                  <input type="text" class="ref1" id="ref1" hidden>
                  <input type="text" class="unidad_empaque1" id="unidad_empaque1" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Despachos</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="despachos">

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas_acond1" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas_acond1" readonly>
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario_acond1" oncopy="return false" readonly>
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">Muestras retención</label>
                            <input type="number" class="form-control centrado" id="mestras_retencion_acond1" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas1">
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas1">
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario1">
                          </div>

                          <div class=" group">
                            <!-- <label for="recipient-name" class="col-form-label">Muestras retención</label>
                            <input type="number" class="form-control centrado" id="mestras_retencion_acond1" readonly> -->
                          </div>

                          <div class="group obs">
                            <label for="recipient-name" class="col-form-label">Observaciones</label>
                            <textarea class="form-control" aria-label="With textarea" id="obs1"></textarea>
                          </div>

                        </div>

                        <div class="row" style="margin: 2%">
                          <div class="col-md-4 align-self-center">
                            <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                            <input type="text" class="form-control" id="despacho1" readonly>
                          </div>
                          <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                            <button type="button" class="btn waves-effect waves-light btn-danger despacho1" id="despacho1" onclick="autenticacion(this);" style="width: 100%; height: 38px;">Firmar</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card" id="despachos2">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi1" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapsefour" style="width: 100%">
                  <b id="despachosMulti2">DESPACHOS</b>
                  <input type="text" class="ref2" id="ref2" hidden>
                  <input type="text" class="unidad_empaque2" id="unidad_empaque2" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Despachos</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="despachos">

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas_acond2" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas3_acond2" readonly>
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario_acond2" oncopy="return false" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas2">
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas2">
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario2">
                          </div>

                          <div class="group obs">
                            <label for="recipient-name" class="col-form-label">Observaciones</label>
                            <textarea class="form-control" aria-label="With textarea" id="obs2"></textarea>
                          </div>

                        </div>
                        <div class="row" style="margin: 2%">
                          <div class="col-md-4 align-self-center">
                            <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                            <input type="text" class="form-control" id="despacho2" readonly>
                          </div>
                          <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                            <button type="button" class="btn waves-effect waves-light btn-danger despacho2" id="despacho2" onclick="autenticacion(this);" style="width: 100%; height: 38px;">Firmar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card" id="despachos3">
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi3" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="width: 100%">
                  <b id="despachosMulti3">DESPACHOS</b>
                  <input type="text" class="ref3" id="ref3" hidden>
                  <input type="text" class="unidad_empaque3" id="unidad_empaque3" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Despachos</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="despachos">

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas_acond3" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas_acond3" readonly>
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario_acond3" oncopy="return false" readonly>
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Unidades Recibidas</label>
                            <input type="number" class="form-control centrado" id="unidades_recibidas3">
                          </div>

                          <div class="group">
                            <label for="recipient-name" class="col-form-label">Cajas</label>
                            <input type="number" class="form-control centrado" id="cajas3">
                          </div>

                          <div class=" group">
                            <label for="recipient-name" class="col-form-label">No Movimiento Inventario</label>
                            <input type="number" class="form-control centrado" id="mov_inventario3">
                          </div>

                          <div class="group obs">
                            <label for="recipient-name" class="col-form-label">Observaciones</label>
                            <textarea class="form-control" aria-label="With textarea" id="obs3"></textarea>
                          </div>

                        </div>
                        <div class="row" style="margin: 2%">
                          <div class="col-md-4 align-self-center">
                            <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                            <input type="text" class="form-control" id="despacho3" readonly>
                          </div>
                          <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                            <button type="button" class="btn waves-effect waves-light btn-danger despacho3" id="despacho3" onclick="autenticacion(this);" style="width: 100%; height: 38px;">Firmar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- jquery -->
          <script src="../../assets/plugins/jquery/jquery.min.js"></script>

          <!-- Bootstrap tether Core JavaScript -->
          <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
          <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

          <!-- Datatables -->
          <script type="text/javascript" src="../../html/vendor/datatables/datatables.min.js"></script>
          <script src="../../html/js/utils/jquery.slimscroll.js"></script>
          <script src="../../html/js/utils/waves.js"></script>
          <script src="../../html/js/utils/sidebarmenu.js"></script>
          <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

          <!--Custom JavaScript -->
          <script src="../../html/js/utils/custom.min.js"></script>
          <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
          <!-- <script src="../../html/js/datatables.js"></script> -->
          <script src="../../html/js/global/loadinfo-global.js"></script>
          <script src="../../html/js/despachos/despachosinfo.js"></script>
          <script src="../../html/js/despachos/cargarBatch_despachos.js"></script>
          <!-- <script src="../../html/js/global/despeje.js"></script> -->
          <script src="../../html/js/global/tanques.js"></script>
          <!--<script src="../../html/js/global/muestras.js"></script>
          <script src="../../html/js/global/condiciones_medio.js"></script>
          <script src="../../html/js/global/cargarBatchMulti.js"></script>
          <script src="../../html/js/firmar/firmar1raSeccionMulti.js"></script>
          <script src="../../html/js/firmar/firmar2daSeccionMulti.js"></script>
          <script src="../../html/js/despachos/despachosinfo.js"></script>
          <script src="../../html/js/global/incidencias.js"></script> -->

          <!--Alertify-->
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>