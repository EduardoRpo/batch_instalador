<?php
session_start();
$_SESSION["timeout"] = time();
include('modal/m_firma.php');
include("modal/modal_observaciones.php");
/* include("modal/modal_req_ajuste.php"); */
/* include("modal/modal_cambiarContrasena.php"); */
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

  <title>Microbiologia | Samara Cosmetics</title>

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
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Microbiología</b></h1>
        <a href="../../microbiologia" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
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
                  LIBERACIÓN MICROBIOLOGÍA
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
                      <option selected hidden>Seleccione</option>
                    </select>
                  </div>
                  <div class="col-md-8 align-self-center">
                    <label for="recipient-name" class="col-form-label">Observaciones:</label>
                    <input type="text" class="form-control" id="desinfectante_obs">
                  </div>
                </div>
                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Equipos</h3>
                </div>

                <div class="obj3 mb-3 ml-3 mr-3">
                  <label for="recipient-name" class="col-form-label envasadora">Identificación Incubadora</label>
                  <label for="recipient-name" class="col-form-label loteadora">Identificación Autoclave</label>
                  <label for="recipient-name" class="col-form-label loteadora">Identificación Cabina de Flujo Laminar</label>
                  <select class="selectpicker form-control sel_equipos sel_incubadora" id="sel_incubadora" onchange="validar_condicionesMedio();"></select>
                  <select class="selectpicker form-control sel_equipos sel_autoclave" id="sel_autoclave" onchange="validar_condicionesMedio();"></select>
                  <select class="selectpicker form-control sel_equipos sel_cabina" id="sel_cabina" onchange="validar_condicionesMedio();"></select>
                </div>

                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Análisis Microbiologico</h3>
                </div>

                <div class="col-md-12 align-self-center">
                  <div class="card">
                    <div class="card-block">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th class="centrado">Análisis</th>
                              <th class="centrado">Especificación</th>
                              <th class="centrado">Método</th>
                              <th class="centrado m1" id="ref1"></th>
                              <th class="centrado m2" id="ref2"></th>
                              <th class="centrado m3" id="ref3"></th>
                              <th class="centrado m4" id="ref4"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th>Recuento de Mesófilos Aerobios Totales</th>
                              <td id="mesofilos"></td>
                              <td class="metodo"></td>
                              <td class="m1"><input type="text" id="inputMesofilos1" class="form-control inputMesofilos1"></td>
                              <td class="m2"><input type="text" id="inputMesofilos2" class="form-control inputMesofilos2"></td>
                              <td class="m3"><input type="text" id="inputMesofilos3" class="form-control inputMesofilos3"></td>
                              <td class="m4"><input type="text" id="inputMesofilos4" class="form-control inputMesofilos4"></td>
                            </tr>
                            <tr>
                              <th>Pseudomona Aeruginosa</th>
                              <td id="pseudomona"></td>
                              <td class="metodo"></td>
                              <td class="m1"><select class="selectpicker form-control pseudomona1" id="pseudomona1">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m2"><select class="selectpicker form-control pseudomona2" id="pseudomona2">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m3"><select class="selectpicker form-control pseudomona3" id="pseudomona3">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m4"><select class="selectpicker form-control pseudomona4" id="pseudomona4">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                            </tr>
                            <tr>
                              <th>Escherichia Coli y Coliformes Totales</th>
                              <td id="escherichia"></td>
                              <td class="metodo"></td>
                              <td class="m1"><select class="selectpicker form-control escherichia1" id="escherichia1">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m2"><select class="selectpicker form-control escherichia2" id="escherichia2">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m3"><select class="selectpicker form-control escherichia3" id="escherichia3">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m4"><select class="selectpicker form-control escherichia4" id="escherichia4">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                            </tr>
                            <tr>
                              <th>Staphylococcus Aureus</th>
                              <td id="staphylococcus"></td>
                              <td class="metodo"></td>
                              <td class="m1"><select class="selectpicker form-control staphylococcus1" id="staphylococcus1">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m2"><select class="selectpicker form-control staphylococcus2" id="staphylococcus2">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m3"><select class="selectpicker form-control staphylococcus3" id="staphylococcus3">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                              <td class="m4"><select class="selectpicker form-control staphylococcus4" id="staphylococcus4">
                                  <option value="0" selected hidden>Seleccionar</option>
                                  <option value="1">Ausencia</option>
                                  <option value="2">Presencia</option>
                                  <option value="3">No Aplica</option>
                                </select></td>
                            </tr>
                            <tr>
                              <th>Fecha de Siembra</th>
                              <th></th>
                              <th></th>
                              <th class="m1"><input type="date" class="form-control" id="fechaSiembra1"></th>
                              <th class="m2"><input type="date" class="form-control" id="fechaSiembra2"></th>
                              <th class="m3"><input type="date" class="form-control" id="fechaSiembra3"></th>
                              <th class="m4"><input type="date" class="form-control" id="fechaSiembra4"></th>
                            </tr>
                            <tr>
                              <th>Fecha de Resultados</th>
                              <th></th>
                              <th></th>
                              <th class="m1"><input type="date" class="form-control" id="fechaResultados1"></th>
                              <th class="m2"><input type="date" class="form-control" id="fechaResultados2"></th>
                              <th class="m3"><input type="date" class="form-control" id="fechaResultados3"></th>
                              <th class="m4"><input type="date" class="form-control" id="fechaResultados4"></th>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-12 align-self-center">
                  <div class="card">
                    <div class="card-block">
                      <div class="obj2 mb-3 ml-3 mr-3">
                        <label for="recipient-name" class="col-form-label envasadora">Fecha de Siembra</label>
                        <label for="recipient-name" class="col-form-label loteadora">Fecha de Resultados</label>
                        <input type="date" class="form-control" id="fechaSiembra"></input>
                        <input type="date" class="form-control" id="fechaResultados"></input>
                      </div>

                    </div>
                  </div>
                </div> -->

                <div class="col-md-12 align-self-center">
                  <div class="card" style="height: 60px;">
                    <div class="card-block">
                      <form id="fmSolicitudConfirmacion">
                        <div style="text-align: center;">
                          <div class="form-check form-check-inline mr-3">
                            <input class="form-check-input" type="radio" name="rdbtnConfirmacion" id="btnRechazado" value="0" hidden>
                            <label class="form-check-label" for="btnRechazado">Rechazado</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rdbtnConfirmacion" id="btnAceptado" value="1" hidden>
                            <label class="form-check-label" for="btnAceptado">Aprobado</label>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>


                <div class="col-md-12 align-self-center" id="observacionesLote">
                  <div class="card" style="height: 130px;">
                    <div class="card-block">
                      <form id="fmConfirmacion">
                        <div>
                          <label for="observacionesLoteRechazado">Motivo</label>
                          <input type="area" class="form-control" name="observacionesLoteRechazado" id="observacionesLoteRechazado" width="50%">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="microbiologia_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control " id="microbiologia_realizado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger microbiologia_realizado" id="microbiologia_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="microbiologia_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control" id="microbiologia_verificado" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger microbiologia_verificado" id="microbiologia_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
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
  <script src="/html/js/utils/custom.min.js"></script>
  <script src="../../html/js/utils/datatables.js"></script>
  <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
  <script src="../../assets/plugins/jquery/jquery.number.min.js"></script>

  <script defer src="/html/js/firmar/firmar1raSeccion.js"></script>
  <script defer src="/html/js/firmar/firmar2daSeccion.js"></script>

  <script defer src="/html/js/global/despeje.js"></script>
  <script defer src="/html/js/global/propiedadesProducto.js"></script>
  <script defer src="/html/js/global/loadinfo-global.js"></script>
  <script defer src="/html/js/global/tanques.js"></script>
  <script defer src="/html/js/global/equipos.js"></script>
  <script defer src="/html/js/global/incidencias.js"></script>
  <script defer src="/html/js/global/condiciones_medio.js"></script>
  <script defer src="/html/js/global/habilitarbtn.js"></script>

  <script src="/html/js/global/validacionesAuth.js"></script>
  <script src="/html/js/global/auth.js"></script>
  <script src="/html/js/global/controller.js"></script>

  <script defer src="/html/js/microbiologia/cargarBatch.js"></script>
  <script defer src="/html/js/microbiologia/cargarMulti.js"></script>
  <script defer src="/html/js/microbiologia/microbiologiainfo.js"></script>
  <script defer src="/html/js/microbiologia/deshabilitarRef.js"></script>
  <script defer src="/html/js/microbiologia/firmar.js"></script>
  <script src="/html/js/global/searchData.js"></script>

</body>

</html>