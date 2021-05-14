<?php
session_start();
include('modal/m_firma.php');
include("modal/modal_observaciones.php");
include("modal/modal_req_ajuste.php");
include("modal/modal_cambiarContrasena.php");
include("modal/modal_condicionesMedio.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Teenus SAS">

  <title>FisicoQuimico | Samara Cosmetics</title>

  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <link href="../../html/css/style.css" rel="stylesheet">
  <link href="../../html/css/colors/blue.css" id="theme" rel="stylesheet">
  <link rel="stylesheet" href="../../html/vendor/jquery-confirm/jquery-confirm.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
    <?php include('partials/header.php'); ?>
    <div class="container-fluid">
      <div class="row page-titles">
        <h1 hidden>3</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>FisicoQuímico</b></h1>
        <a href="../../fisicoquimica" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
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
                    <input type="date" class="form-control" id="in_fecha" width="50px" readonly>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="recipient-name" class="col-form-label">No Orden de Producción</label>
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
                      </tbody>
                    </table>
                  </div>

                  <div class="contenedorInfo__group">
                    <label for="in_tamano_lote" class="col-form-label">Tamaño Lote (kg)</label>
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

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                  LIBERACIÓN FISICOQUÍMICA
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Análisis Fisicoquímico</h3>
                </div>

                <div class="col-md-12 align-self-center">
                  <div class="card">
                    <div class="card-block">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              <td><input class="selectpicker form-control" type="number" id="in_densidad" onkeyup="validar_densidad();"></td>
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

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 align-self-center">
                  <div class="card">
                    <div class="card-block">
                      <div class="row" style="margin: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#m_req_ajuste" style="margin-left: 1%">
                          ¿Se requiere algún ajuste?
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="fisicoquimica_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control " id="fisicoquimica_realizado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger fisicoquimica_realizado" id="fisicoquimica_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="fisicoquimica_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control" id="fisicoquimica_verificado" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger fisicoquimica_verificado" id="fisicoquimica_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
  <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="../../html/js/utils/jquery.slimscroll.js"></script>
  <script src="../../html/js/utils/waves.js"></script>
  <script src="../../html/js/utils/sidebarmenu.js"></script>
  <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="../../html/js/utils/custom.min.js"></script>
  <script src="../../html/js/utils/datatables.js"></script>
  <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
  <script src="../../html/js/preparacion/clock.js"></script>
  <script src="../../assets/plugins/jquery/jquery.number.min.js"></script>
  <script src="../../html/js/global/loadinfo-global.js"></script>
  <script src="../../html/js/global/tanques.js"></script>
  <script src="../../html/js/firmar/firmar1raSeccion.js"></script>
  <script src="../../html/js/firmar/firmar2daSeccion.js"></script>
  <script src="../../html/js/global/propiedadesProducto.js"></script>
  <script src="../../html/js/global/incidencias.js"></script>
  <script src="../../html/js/global/validaciones.js"></script>
</body>

</html>