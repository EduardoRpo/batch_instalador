<?php
session_start();
include("modal/modal_firma.php");
include("modal/modal_req_ajuste.php");
include("modal/modal_observaciones.php");
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
  <title>Samara Cosmetics</title>

  <!-- Bootstrap Core CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../html/css/style.css" rel="stylesheet">

  <!-- You can change the theme colors from here -->
  <link href="../../html/css/colors/blue.css" id="theme" rel="stylesheet">
  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <!-- <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->
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
        <h1 hidden>4</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Aprobación</b></h1>
        <a href="../../aprobacion" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link text-uppercase" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
                  Información del producto
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
                          <th class="centrado">Tanque</th>
                          <th class="centrado">Cantidad</th>
                          <th class="centrado">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="fila1">
                          <td class="centrado" id="tanque1"></td>
                          <td class="centrado" id="cantidad1"></td>
                          <td class="centrado" id="total1"></td>
                        </tr>
                        <tr id="fila2">
                          <td class="centrado" id="tanque2"></td>
                          <td class="centrado" id="cantidad2"></td>
                          <td class="centrado" id="total2"></td>
                        </tr>
                        <!-- <tr id="fila3">
                        <td id="tanque3" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad3" style="text-align: end;font-size:14px;"></td>
                        <td id="total3" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila4">
                        <td id="tanque4" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad4" style="text-align: end;font-size:14px;"></td>
                        <td id="total4" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila5">
                        <td id="tanque5" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad5" style="text-align: end;font-size:14px;"></td>
                        <td id="total5" style="text-align: end;font-size:14px;"></td>
                      </tr> -->
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

                <!-- <div class="contenedorInfo">
                  <label for="recipient-name" class="col-form-label">Fecha Programación</label>
                  <label for="recipient-name" class="col-form-label">No Orden</label>
                  <label for="recipient-name" class="col-form-label">Referencia</label>

                  <table id="txtobservacionesTanques" class="itemInfo table table-striped table-bordered" style="width:80%; height: 30px;">
                    <thead>
                      <tr>
                        <th>Tanque</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="fila1">
                        <td id="tanque1" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad1" style="text-align: end;font-size:14px;"></td>
                        <td id="total1" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila2">
                        <td id="tanque2" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad2" style="text-align: end;font-size:14px;"></td>
                        <td id="total2" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila3">
                        <td id="tanque3" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad3" style="text-align: end;font-size:14px;"></td>
                        <td id="total3" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila4">
                        <td id="tanque4" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad4" style="text-align: end;font-size:14px;"></td>
                        <td id="total4" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila5">
                        <td id="tanque5" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad5" style="text-align: end;font-size:14px;"></td>
                        <td id="total5" style="text-align: end;font-size:14px;"></td>
                      </tr>
                    </tbody>
                  </table>

                  <input type="date" class="form-control" id="in_fecha" readonly>
                  <input type="text" class="form-control" id="in_numero_orden" readonly>
                  <input type="text" class="form-control" id="in_referencia" readonly>

                  <label></label>
                  <label for="in_tamano_lote" class="col-form-label">Tamaño Lote (Kg)</label>
                  <label for="recipient-name" class="col-form-label">No. Lote</label>
                  <label for="recipient-name" class="col-form-label">Linea</label>

                  <input type="text" class="form-control" id="in_tamano_lote" readonly>
                  <input type="text" class="form-control" id="in_numero_lote" readonly>
                  <input type="text" class="form-control" id="in_linea" readonly>
                </div> -->


              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                  Liberación control calidad fisioquimico para envasado
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-right">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-right">
                    <label for="sel_producto_desinfeccion" class="col-form-label">Producto de desinfección</label>
                    <select class="selectpicker form-control" id="sel_producto_desinfeccion">
                      <option selected hidden>Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-8 align-self-center">
                    <label for="recipient-name" class="col-form-label">Observaciones:</label>
                    <input type="text" class="form-control" id="recipient2-name">
                  </div>
                </div>

              </div>
              <div class="row" style="margin: 1%">
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label mt-3" style="text-align: center; background-color: #c0c0c0"> Control de proceso</h3>
                </div>

                <div class="col-md-12 align-self-center">
                  <div class=" checkbox-aprobacion mt-3">
                    <label class="lblControlTanques">Control de Tanques</label>
                    <!-- Control Tanques -->
                  </div>
                  <div class="alert alert-primary" role="alert">
                    <!-- Notificacion de parametros de control, mostrar mensaje de texto -->
                  </div>

                  <div class="card mt-3">
                    <div class="card-block">
                      <!--<h4 class="card-title">Basic Table</h4>
                 <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                      <div class="table-responsive">

                        <table id="tblControlProcesoPreparacion" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="titulo">PARAMETROS</th>
                              <th class="titulo">ESPECIFICACIONES</th>
                              <th class="titulo">RESULTADOS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Color</td>
                              <td id="espec_color"></td>
                              <td><select class="selectpicker form-control color especificacion">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Cumple</option>
                                  <option value="2">No cumple</option>
                                  <option value="3">No aplica</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>Olor</td>
                              <td id="espec_olor"></td>
                              <td><select class="selectpicker form-control olor especificacion">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Cumple</option>
                                  <option value="2">No cumple</option>
                                  <option value="3">No aplica</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>Apariencia</td>
                              <td id="espec_apariencia"></td>
                              <td><select class="selectpicker form-control apariencia especificacion">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Cumple</option>
                                  <option value="2">No cumple</option>
                                  <option value="3">No aplica</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>PH</td>
                              <td id="espec_ph"></td>
                              <td><input type="number" id="in_ph" class="selectpicker form-control ph especificacionInput">
                              </td>
                            </tr>
                            <tr>
                              <td>Viscocidad CPS </td>
                              <td id="espec_viscidad"></td>
                              <td><input type="number" class="selectpicker form-control especificacionInput" id="in_viscocidad">
                              </td>
                            </tr>
                            <tr>
                              <td>Densidad o gravedad especifica G/ML
                                <!-- <input type="text" class="form-control" style="width: 60px;" readonly> -->
                              </td>
                              <td id="espec_densidad"></td>
                              <td><input class="selectpicker form-control especificacionInput" type="number" id="in_densidad"></td>
                            </tr>
                            <tr>
                              <td>Untuosidad</td>
                              <td id="espec_untosidad"></td>
                              <td><select class="selectpicker form-control untuosidad especificacion">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Cumple</option>
                                  <option value="2">No cumple</option>
                                  <option value="3">No aplica</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>Poder Espumoso</td>
                              <td id="espec_poder_espumoso"></td>
                              <td><select class="selectpicker form-control espumoso especificacion">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Cumple</option>
                                  <option value="2">No cumple</option>
                                  <option value="3">No aplica</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td>Grado Alcohol</td>
                              <td id="espec_grado_alcohol"></td>
                              <td><input class="selectpicker form-control especificacionInput" type="number" id="in_grado_alcohol">
                              </td>
                            </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <hr>
              <div class="row" style="margin: 1%">
                <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#m_req_ajuste" style="margin-left: 1%">¿Se requiere algún ajuste?
                </button>
              </div>
              <hr>

              <div class="row" style="margin: 1%">
                <div class="col-md-4 align-self-center">
                  <label for="desinfeccion_realizado" class="col-form-label">Realizado Por:</label>
                  <input type="text" class="form-control" id="aprobacion_realizado" readonly>
                </div>
                <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                  <input type="button" class="btn btn-danger" id="aprobacion_realizado" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;" value="Firmar">
                </div>

                <div class="col-md-4 align-self-center">
                  <label for="desinfeccion_verificado" class="col-form-label">Verificado Por:</label>
                  <input type="text" class="form-control" id="aprobacion_verificado" readonly>
                </div>
                <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                  <input type="button" class="btn btn-danger aprobacion_verificado" id="aprobacion_verificado" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;" value="Firmar">
                </div>
              </div>

              <hr>

              <div class="row buttons-group-container" style="margin: 1%">
                <div class="buttons-group">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalObservaciones">Aceptar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="../../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
  <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../html/vendor/datatables/datatables.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="../../html/js/utils/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="../../html/js/utils/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../../html/js/utils/sidebarmenu.js"></script>
  <!--stickey kit -->
  <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <!--Alertify-->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!--Custom JavaScript -->
  <script src="../../html/js/utils/custom.min.js"></script>
  <!-- <script src="../../html/js/datatables.js"></script> -->
  <script src="../../html/js/global/loadinfo-global.js"></script>
  <script src="../../html/js/global/despeje.js"></script>
  <script src="../../html/js/aprobacion/aprobacioninfo.js"></script>
  <script src="../../html/js/firmar/firmar1raSeccion.js"></script>
  <script src="../../html/js/firmar/firmar2daSeccion.js"></script>
  <script src="../../html/js/global/incidencias.js"></script>
  <script src="../../html/js/global/requerimiento_ajuste.js"></script>
  <script src="../../html/js/global/condicionesdelMedio.js"></script>
  <script src="../../html/js/global/cargarBatchAprobacion.js"></script>
  <script src="../../html/js/global/validaciones.js"></script>
  <script src="../../html/js/global/tanques.js"></script>

</body>

</html>