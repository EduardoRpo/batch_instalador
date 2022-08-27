<?php
session_start();
$_SESSION["timeout"] = time();
include('modal/modal_firma.php');
include('modal/modal_cambiarContrasena.php');
include('modal/modal_observaciones.php');
include('modal/m_firma.php');
include('modal/m_muestras.php');
include('modal/modal_condicionesMedio.php');
include('modal/image.php')
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
  <title>Envasado | Samara Cosmetics</title>

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
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Envasado</b></h1>
        <a href="../../envasado" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
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
                    <label for="recipient-name" class="col-form-label">Fecha Actual</label>
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
                        <tr id="fila4">
                          <td id="tanque4" class="centrado"></td>
                          <td id="cantidad4" class="centrado"></td>
                          <td id="total4" class="centrado"></td>
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

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                  <b>DESPEJE DE LINEAS Y PROCESOS</b>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Parámetros de control</h3>
                  <h3 for="recipient-name" class="col-form-label">Si</h3>
                  <h3 for="recipient-name" class="col-form-label">No</h3>
                </div>

                <div class="row parametrosControlPreguntas" id="preguntas-div"></div>

                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-right">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-right">
                    <label for="sel_producto_desinfeccion" class="col-form-label">Producto de desinfección</label>
                    <select class="selectpicker form-control in_desinfeccion" id="sel_producto_desinfeccion">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                  <div class="col-md-8 align-self-center">
                    <label for="in_observaciones" class="col-form-label">Observaciones</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control in_desinfeccion despeje_realizado" id="despeje_realizado" readonly>
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger despeje_realizado" id="despeje_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control in_desinfeccion despeje_verificado" id="despeje_verificado" readonly>
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion despeje_verificado" id="despeje_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
                <div class="row justify-content-end mt-5" style="margin: 1%; text-align: right">
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado1">
            <div class="card-header multiLinea1" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi1" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti1" class="img_ref">ENVASADO</b>
                  <input type="text" class="ref1" id="ref1" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 mb-3 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th class="centrado">Referencia</th>
                                <th class="centrado">Descripción</th>
                                <th class="centrado">Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="envaseReferencia1" class="centrado envaseReferencia1"></td>
                                <td id="envaseDescripcion1" class="envaseDescripcion1"></td>
                                <td id="envaseUnidades1" class="centrado envaseUnidades1"></td>
                              </tr>
                              <tr>
                                <td id="tapaReferencia1" class="centrado tapaReferencia1"></td>
                                <td id="tapaDescripcion1" class="tapaDescripcion1"></td>
                                <td id="tapaUnidades1" class="centrado tapaUnidades1"></td>
                              </tr>
                              <tr>
                                <td id="etiquetaReferencia1" class="centrado etiquetaReferencia1"></td>
                                <td id="etiquetaDescripcion1" class="etiquetaDescripcion1"></td>
                                <td id="etiquetaUnidades1" class="centrado etiquetaUnidades1"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 ml-3 mr-3">
                      <label>Digite el lote (requerido)</label>
                      <input type="text" class="form-control validarLote" id="validarLote1" autocomplete="off" onblur="revisarLote();">
                    </div>

                    <div class="id_envasadora_loteadora mb-3 ml-3 mr-3">
                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                        <select class="selectpicker form-control sel_envasadora sel_equipos" id="sel_envasadora1"></select>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <select class="selectpicker form-control sel_loteadora sel_equipos" id="sel_loteadora1"></select>
                      </div>
                    </div>

                    <div class="col-md-12 align-self-center" style="padding-left: 0px;padding-right: 0px;">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>

                    <div class="especificaciones_tecnicas">
                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Mínimo:</label>
                        <input type="text" class="form-control centrado minimo" id="minimo1" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Medio:</label>
                        <input type="text" class="form-control centrado medio" id="medio1" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Máximo:</label>
                        <input type="text" class="form-control centrado maximo" id="maximo1" readonly>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mb-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="muestras1" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button> <!--   -->
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="promedio1" style="text-align:center;" disabled>
                      </div>
                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado1" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado1" id="controlpeso_realizado1" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado1" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado1" id="controlpeso_verificado1" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entregas Parciales</h3>
                      </div>
                      <div class="col-md-2 mt-3">
                        <label for="">Unidades Envasadas</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadas1" id="unidadesEnvasadas1">
                      </div>
                      <div class="col-md-3 mt-3">
                        <label for="">Unidades Envasadas a la fecha</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadasTotales1" id="unidadesEnvasadasTotales1" readonly>
                      </div>
                      <div class="col-md-2 mt-3">
                        <div style="margin-top:33px"></div>
                        <button class="btn btn-danger btnEntregasParciales1" id="btnEntregasParciales1">Guardar Entregas Parciales</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3 mb-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 align-self-center">
                        <div class="card">
                          <div class="card-block">

                            <div class="table-responsive">
                              <table id="envases" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <!-- <th>Fecha</th> -->
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Recibida</th>
                                    <th>Envasada</th>
                                    <th>Averias</th>
                                    <th>Sobrante</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td id="envaseReferencia1" class="envaseReferencia1 centrado"></td>
                                    <td id="envaseDescripcion1" class="envaseDescripcion1" style="vertical-align: middle;"></td>
                                    <td id="envaseUnidades1" class="centrado centrado envaseUnidades1"></td>
                                    <td><input type="number" id="envaseEnvasada1" min="1" class="form-control centrado envaseEnvasada1" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="envaseAverias1" min="1" class="form-control centrado envaseAverias1 averias1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="envaseSobrante1" min="1" class="form-control centrado envaseSobrante1 sobrante1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="envaseDevolucion1" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="tapaReferencia1" class="tapaReferencia1 centrado"></td>
                                    <td id="tapaDescripcion1" class="tapaDescripcion1" style="vertical-align: middle;"></td>
                                    <td id="tapaUnidades1" class="centrado centrado tapaUnidades1"></td>
                                    <td id="tapaEnvasada1" class="centrado tapaEnvasada1"></td>
                                    <td><input type="number" id="tapaAverias1" min="1" class="form-control centrado tapaAverias1 averias1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="tapaSobrante1" min="1" class="form-control centrado tapaSobrante1 sobrante1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="tapaDevolucion1" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="etiquetaReferencia1" class="etiquetaReferencia1 centrado"></td>
                                    <td id="etiquetaDescripcion1" class="etiquetaDescripcion1" style="vertical-align: middle;"></td>
                                    <td id="etiquetaUnidades1" class="centrado etiquetaUnidades1"></td>
                                    <td id="etiquetaEnvasada1" class="centrado etiquetaEnvasada1"></td>
                                    <td><input type="number" id="etiquetaAverias1" min="1" class="form-control centrado etiquetaAverias1 averias1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="etiquetaSobrante1" min="1" class="form-control centrado etiquetaSobrante1 sobrante1" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="etiquetaDevolucion1" class="centrado"></td>
                                  </tr>

                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="firmas_envasado"> -->
                    <div class="row" style="margin: 1%">
                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                        <input type="text" class="form-control" id="devolucion_realizado1" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado1" style="width: 100%; height: 38px;" id="devolucion_realizado1" onclick="cargar(this, 'firma5')">Firmar</button>
                      </div>

                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                        <input type="text" class="form-control" id="devolucion_verificado1" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado1" style="width: 100%; height: 38px;" id="devolucion_verificado1" onclick="cargar(this, 'firma6')">Firmar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado2">
            <div class="card-header multiLinea2" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed img_ref ref_multi2" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti2" class="img_ref">ENVASADO</b>
                  <input type="text" class="ref2" id="ref2" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 mb-3 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th class="centrado">Referencia</th>
                                <th class="centrado">Descripción</th>
                                <th class="centrado">Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="envaseReferencia2" class="centrado envaseReferencia2"></td>
                                <td id="envaseDescripcion2" class="envaseDescripcion2"></td>
                                <td id="envaseUnidades2" class="centrado envaseUnidades2"></td>
                              </tr>
                              <tr>
                                <td id="tapaReferencia2" class="centrado tapaReferencia2"></td>
                                <td id="tapaDescripcion2" class="tapaDescripcion2"></td>
                                <td id="tapaUnidades2" class="centrado tapaUnidades2"></td>
                              </tr>
                              <tr>
                                <td id="etiquetaReferencia2" class="centrado etiquetaReferencia2"></td>
                                <td id="etiquetaDescripcion2" class="etiquetaDescripcion2"></td>
                                <td id="etiquetaUnidades2" class="centrado etiquetaUnidades2"></td>
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 ml-3 mr-3">
                      <label>Digite el lote (requerido)</label>
                      <input type="text" class="form-control validarLote" id="validarLote2" autocomplete="off" onblur="revisarLote();">
                    </div>

                    <div class="id_envasadora_loteadora mb-3 ml-3 mr-3">
                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                        <select class="selectpicker form-control sel_envasadora sel_equipos" id="sel_envasadora2"></select>
                        <!--  <input type="text" class="form-control envasadora1" readonly> -->
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <select class="selectpicker form-control sel_loteadora sel_equipos" id="sel_loteadora2"></select>
                        <!-- <input type="text" class="form-control loteadora1" readonly> -->
                      </div>
                    </div>
                    <hr>

                    <div class="col-md-12 align-self-center" style="padding-left: 0px;padding-right: 0px;">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Mínimo:</label>
                        <input type="text" class="form-control centrado minimo" id="minimo2" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Medio:</label>
                        <input type="text" class="form-control centrado medio" id="medio2" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Máximo:</label>
                        <input type="text" class="form-control centrado maximo" id="maximo2" readonly>
                      </div>

                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mb-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="muestras2" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button> <!--   -->
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="promedio2" style="text-align:center;" disabled>
                      </div>
                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado2" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado2" id="controlpeso_realizado2" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado2" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado2" id="controlpeso_verificado2" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entregas Parciales</h3>
                      </div>
                      <div class="col-md-2 mt-3">
                        <label for="">Unidades Envasadas</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadas2" id="unidadesEnvasadas2">
                      </div>
                      <div class="col-md-3 mt-3">
                        <label for="">Unidades Envasadas a la fecha</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadasTotales2" id="unidadesEnvasadasTotales2" readonly>
                      </div>

                      <div class="col-md-2 mt-3">
                        <div style="margin-top:33px"></div>
                        <button class="btn btn-danger btnEntregasParciales2" id="btnEntregasParciales2">Guardar Entregas Parciales</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3 mb-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 align-self-center">
                        <div class="card">
                          <div class="card-block">

                            <div class="table-responsive">
                              <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <!-- <th>Fecha</th> -->
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Recibida</th>
                                    <th>Envasada</th>
                                    <th>Averias</th>
                                    <th>Sobrante</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td id="envaseReferencia2" class="envaseReferencia2 centrado"></td>
                                    <td id="envaseDescripcion2" class="envaseDescripcion2" style="vertical-align: middle;"></td>
                                    <td id="envaseUnidades2" class="centrado envaseUnidades2"></td>
                                    <td><input type="number" id="envaseEnvasada2" min="1" class="form-control centrado envaseEnvasada2" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="envaseAverias2" min="1" class="form-control centrado envaseAverias2 averias2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="envaseSobrante2" min="1" class="form-control centrado envaseSobrante2 sobrante2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="envaseDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="tapaReferencia2" class="tapaReferencia2 centrado"></td>
                                    <td id="tapaDescripcion2" class="tapaDescripcion2" style="vertical-align: middle;"></td>
                                    <td id="tapaUnidades2" class="centrado tapaUnidades2"></td>
                                    <td id="tapaEnvasada2" class="centrado tapaEnvasada2"></td>
                                    <td><input type="number" id="tapaAverias2" min="1" class="form-control centrado tapaAverias2 averias2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="tapaSobrante2" min="1" class="form-control centrado tapaSobrante2 sobrante2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="tapaDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="etiquetaReferencia2" class="etiquetaReferencia2 centrado"></td>
                                    <td id="etiquetaDescripcion2" class="etiquetaDescripcion2" style="vertical-align: middle;"></td>
                                    <td id="etiquetaUnidades2" class="centrado etiquetaUnidades2"></td>
                                    <td id="etiquetaEnvasada2" class="centrado etiquetaEnvasada2"></td>
                                    <td><input type="number" id="etiquetaAverias2" min="1" class="form-control centrado etiquetaAverias2 averias2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="etiquetaSobrante2" min="1" class="form-control centrado etiquetaSobrante2 sobrante2" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="etiquetaDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>

                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="firmas_envasado"> -->
                    <div class="row" style="margin: 1%">
                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                        <input type="text" class="form-control" id="devolucion_realizado2" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado2" style="width: 100%; height: 38px;" id="devolucion_realizado2" onclick="cargar(this, 'firma5')">Firmar</button>
                      </div>

                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                        <input type="text" class="form-control" id="devolucion_verificado2" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado2" style="width: 100%; height: 38px;" id="devolucion_verificado2" onclick="cargar(this, 'firma6')">Firmar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado3">
            <div class="card-header multiLinea3" id="headingFive">
              <h5 class="mb-0">
                <button id="ref_multi1" class="btn btn-link collapsed img_ref ref_multi3" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti3" class="img_ref">ENVASADO</b>
                  <input type="text" class="ref3" id="ref3" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 mb-3 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th class="centrado">Referencia</th>
                                <th class="centrado">Descripción</th>
                                <th class="centrado">Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="envaseReferencia3" class="centrado envaseReferencia3"></td>
                                <td id="envaseDescripcion3" class="envaseDescripcion3"></td>
                                <td id="envaseUnidades3" class="centrado envaseUnidades3"></td>
                              </tr>
                              <tr>
                                <td id="tapaReferencia3" class="centrado tapaReferencia3"></td>
                                <td id="tapaDescripcion3" class="tapaDescripcion3"></td>
                                <td id="tapaUnidades3" class="centrado unidades3 unidadesTapa3"></td>
                              </tr>
                              <tr>
                                <td id="etiquetaReferencia3" class="centrado etiquetaReferencia3"></td>
                                <td id="etiquetaDescripcion3" class="etiquetaDescripcion3"></td>
                                <td id="etiquetaUnidades3" class="centrado etiquetaUnidades3"></td>
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 ml-3 mr-3">
                      <label>Digite el lote (requerido)</label>
                      <input type="text" class="form-control validarLote" id="validarLote3" autocomplete="off" onblur="revisarLote();">
                    </div>

                    <div class="id_envasadora_loteadora mb-3 ml-3 mr-3">
                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                        <select class="selectpicker form-control sel_envasadora sel_equipos" id="sel_envasadora3"></select>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <select class="selectpicker form-control sel_loteadora sel_equipos" id="sel_loteadora3"></select>
                      </div>
                    </div>
                    <hr>

                    <div class="col-md-12 align-self-center" style="padding-left: 0px;padding-right:0px">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Mínimo:</label>
                        <input type="text" class="form-control centrado minimo" id="minimo3" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Medio:</label>
                        <input type="text" class="form-control centrado medio" id="medio3" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Máximo:</label>
                        <input type="text" class="form-control centrado maximo" id="maximo3" readonly>
                      </div>

                    </div>

                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mb-3" style="padding-left: 0px;padding-right:0px">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="muestras3" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button> <!--   -->
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="promedio3" style="text-align:center;" disabled>
                      </div>
                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado3" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado3" id="controlpeso_realizado3" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado3" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado3" id="controlpeso_verificado3" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entregas Parciales</h3>
                      </div>
                      <div class="col-md-2 mt-3">
                        <label for="">Unidades Envasadas</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadas3" id="unidadesEnvasadas3">
                      </div>
                      <div class="col-md-3 mt-3">
                        <label for="">Unidades Envasadas a la fecha</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadasTotales3" id="unidadesEnvasadasTotales3" readonly>
                      </div>
                      <div class="col-md-2 mt-3">
                        <div style="margin-top:33px"></div>
                        <button class="btn btn-danger btnEntregasParciales3" id="btnEntregasParciales3">Guardar Entregas Parciales</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mt-3 mb-3" style="padding-left: 0px;padding-right:0px">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 align-self-center">
                        <div class="card">
                          <div class="card-block">

                            <div class="table-responsive">
                              <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <!-- <th>Fecha</th> -->
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Recibida</th>
                                    <th>Envasada</th>
                                    <th>Averias</th>
                                    <th>Sobrante</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td id="envaseReferencia3" class="envaseReferencia3 centrado"></td>
                                    <td id="envaseDescripcion3" class="envaseDescripcion3" style="vertical-align: middle;"></td>
                                    <td id="envaseUnidades3" class="centrado envaseUnidades3"></td>
                                    <td><input type="number" id="envaseEnvasada3" min="1" class="form-control centrado envaseEnvasada3" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="envaseAverias3" min="1" class="form-control centrado envaseAverias3 averias3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="envaseSobrante3" min="1" class="form-control centrado envaseSobrante3 sobrante3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="envaseDevolucion3" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="tapaReferencia3" class="tapaReferencia3 centrado"></td>
                                    <td id="tapaDescripcion3" class="tapaDescripcion3" style="vertical-align: middle;"></td>
                                    <td id="tapaUnidades3" class="centrado tapaUnidades3"></td>
                                    <td id="tapaEnvasada3" class="centrado envasada3"></td>
                                    <td><input type="number" id="tapaAverias3" min="1" class="form-control centrado tapaAverias3 averias3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="tapaSobrante3" min="1" class="form-control centrado tapaSobrante3 sobrante3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="tapaDevolucion3" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="etiquetaReferencia3" class="etiquetaReferencia3 centrado"></td>
                                    <td id="etiquetaDescripcion3" class="etiquetaDescripcion3" style="vertical-align: middle;"></td>
                                    <td id="etiquetaUnidades3" class="centrado etiquetaUnidades3"></td>
                                    <td id="etiquetaEnvasada3" class="centrado etiquetaEnvasada3"></td>
                                    <td><input type="number" id="etiquetaAverias3" min="1" class="form-control centrado etiquetaAverias3 averias3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="etiquetaSobrante3" min="1" class="form-control centrado etiquetaSobrante3 sobrante3" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="etiquetaDevolucion3" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="firmas_envasado"> -->
                    <div class="row" style="margin: 1%">
                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                        <input type="text" class="form-control" id="devolucion_realizado3" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado3" id="devolucion_realizado3" style="width: 100%; height: 38px;" onclick="cargar(this, 'firma5')">Firmar</button>
                      </div>

                      <!-- <div class="firmas_envasado__group"> -->
                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                        <input type="text" class="form-control" id="devolucion_verificado3" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado3" i="devolucion_verificado3" style="width: 100%; height: 38px;" onclick="cargar(this, 'firma6')">Firmar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado4">
            <div class="card-header multiLinea1" id="headingSix">
              <h5 class="mb-0">
                <button id="ref_multi4" class="btn btn-link collapsed img_ref ref_multi4" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti4" class="img_ref">ENVASADO</b>
                  <input type="text" class="ref4" id="ref4" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 0%">
                  <div class="col-md-12 mb-3 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th class="centrado">Referencia</th>
                                <th class="centrado">Descripción</th>
                                <th class="centrado">Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="envaseReferencia4" class="centrado envaseReferencia4"></td>
                                <td id="envaseDescripcion4" class="envaseDescripcion4"></td>
                                <td id="envaseUnidades4" class="centrado envaseUnidades4"></td>
                              </tr>
                              <tr>
                                <td id="tapaReferencia4" class="centrado tapaReferencia4"></td>
                                <td id="tapaDescripcion4" class="tapaDescripcion4"></td>
                                <td id="tapaUnidades4" class="centrado tapaUnidades4"></td>
                              </tr>
                              <tr>
                                <td id="etiquetaReferencia4" class="centrado etiquetaReferencia4"></td>
                                <td id="etiquetaDescripcion4" class="etiquetaDescripcion4"></td>
                                <td id="etiquetaUnidades4" class="centrado etiquetaUnidades4"></td>
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3 ml-3 mr-3">
                      <label>Digite el lote (requerido)</label>
                      <input type="text" class="form-control validarLote" id="validarLote4" autocomplete="off" onblur="revisarLote();">
                    </div>

                    <div class="id_envasadora_loteadora mb-3 ml-3 mr-3">
                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                        <select class="selectpicker form-control sel_envasadora sel_equipos" id="sel_envasadora4"></select>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <select class="selectpicker form-control sel_loteadora sel_equipos" id="sel_loteadora4"></select>
                      </div>
                    </div>
                    <hr>

                    <div class="col-md-12 align-self-center" style="padding-left: 0px;padding-right:0px">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Mínimo:</label>
                        <input type="text" class="form-control centrado minimo" id="minimo4" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Medio:</label>
                        <input type="text" class="form-control centrado medio" id="medio4" readonly>
                      </div>

                      <div class="especificaciones__group">
                        <label for="recipient-name" class="col-form-label">Máximo:</label>
                        <input type="text" class="form-control centrado maximo" id="maximo4" readonly>
                      </div>

                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mb-3" style="padding-left: 0px;padding-right:0px">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="muestras4" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="promedio4" style="text-align:center;" disabled>
                      </div>
                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado4" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado4" id="controlpeso_realizado4" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado4" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado4" id="controlpeso_verificado4" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3" style="padding-left: 0px;padding-right: 0px;">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entregas Parciales</h3>
                      </div>
                      <div class="col-md-2 mt-3">
                        <label for="">Unidades Envasadas</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadas4" id="unidadesEnvasadas4">
                      </div>
                      <div class="col-md-3 mt-3">
                        <label for="">Unidades Envasadas a la fecha</label>
                        <input class="form-control text-center" type="number" name="unidadesEnvasadasTotales4" id="unidadesEnvasadasTotales4" readonly>
                      </div>
                      <div class="col-md-2 mt-3">
                        <div style="margin-top:33px"></div>
                        <button class="btn btn-danger btnEntregasParciales4" id="btnEntregasParciales4">Guardar Entregas Parciales</button>
                      </div>
                    </div>

                    <div class="row" style="margin: 0%">
                      <div class="col-md-12 align-self-center mt-3" style="padding-left: 0px;padding-right:0px">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 align-self-center">
                        <div class="card">
                          <div class="card-block">

                            <div class="table-responsive">
                              <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Recibida</th>
                                    <th>Envasada</th>
                                    <th>Averias</th>
                                    <th>Sobrante</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td id="envaseReferencia4" class="envaseReferencia4 centrado"></td>
                                    <td id="envaseDescripcion4" class="envaseDescripcion4" style="vertical-align: middle;"></td>
                                    <td id="envaseUnidades4" class="centrado envaseUnidades4"></td>
                                    <td><input type="number" id="envaseEnvasada4" min="1" class="form-control centrado envaseEnvasada4" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="envaseAverias4" min="1" class="form-control centrado envaseAverias4 averias4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="envaseSobrante4" min="1" class="form-control centrado envaseSobrante4 sobrante4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="envaseDevolucion4" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="tapaReferencia4" class="tapaReferencia4 centrado"></td>
                                    <td id="tapaDescripcion4" class="tapaDescripcion4" style="vertical-align: middle;"></td>
                                    <td id="tapaUnidades" class="centrado tapaUnidades"></td>
                                    <td id="tapaEnvasada4" class="centrado tapaEnvasada4"></td>
                                    <td><input type="number" id="tapaAverias4" min="1" class="form-control centrado tapaAverias4 averias4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="tapaSobrante4" min="1" class="form-control centrado tapaSobrante4 sobrante4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="tapaDevolucion4" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="etiquetaReferencia4" class="etiquetaReferencia4 centrado"></td>
                                    <td id="etiquetaDescripcion4" class="etiquetaDescripcion4" style="vertical-align: middle;"></td>
                                    <td id="eqtiquetaUnidades4" class="centrado eqtiquetaUnidades4"></td>
                                    <td id="etiquetaEnvasada4" class="centrado etiquetaEnvasada4"></td>
                                    <td><input type="number" id="etiquetaAverias4" min="1" class="form-control centrado etiquetaAverias4 averias4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="etiquetaSobrante4" min="1" class="form-control centrado etiquetaSobrante4 sobrante4" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="etiquetaDevolucion4" class="centrado"></td>
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="margin: 1%">

                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                        <input type="text" class="form-control" id="devolucion_realizado4" readonly>
                      </div>

                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado4" id="devolucion_realizado4" style="width: 100%; height: 38px;" onclick="cargar(this, 'firma5')">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                        <input type="text" class="form-control" id="devolucion_verificado4" readonly>
                      </div>

                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado4" id="devolucion_verificado4" style="width: 100%; height: 38px;" onclick="cargar(this, 'firma6')">Firmar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script src="../../assets/plugins/jquery/jquery.min.js"></script>
          <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
          <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
          <script src="/html/vendor/datatables/datatables.min.js" type="text/javascript"></script>
          <script src="/html/js/utils/jquery.slimscroll.js"></script>
          <script src="/html/js/utils/waves.js"></script>
          <script src="/html/js/utils/sidebarmenu.js"></script>
          <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
          <script src="/html/js/utils/custom.min.js"></script>
          <script src="/html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

          <script src="/html/js/global/loadinfo-global.js"></script>
          <script src="/html/js/global/searchData.js"></script>
          <script src="/html/js/global/preguntas.js"></script>
          <script src="/html/js/global/despeje.js"></script>
          <script src="/html/js/global/tanques.js"></script>
          <script src="/html/js/global/muestras.js"></script>
          <script src="/html/js/global/condiciones_medio.js"></script>
          <script src="/html/js/global/cargarBatchMulti.js"></script>
          <script src="/html/js/global/incidencias.js"></script>
          <script src="/html/js/global/equipos.js"></script>
          <script src="/html/js/global/image.js"></script>
          <script src="/html/js/global/habilitarbtn.js"></script>
          <script src="/html/js/global/presentacionReferenciaMulti.js"></script>

          <script src="/html/js/global/validacionesAuth.js"></script>
          <script src="/html/js/global/auth.js"></script>
          <script src="/html/js/global/controller.js"></script>
          <script src="/html/js/global/controlProceso.js"></script>

          <script src="/html/js/firmar/firmar1raSeccion.js"></script>
          <script src="/html/js/firmar/firmar2daSeccion.js"></script>
          <script src="/html/js/firmar/firmar2daSeccionMulti.js"></script>

          <script src="/html/js/envasado/envasadoinfo.js"></script>
          <script src="/html/js/envasado/validacionesEnvasado.js"></script>
          <script src="/html/js/envasado/multi.js"></script>
          <script src="/html/js/envasado/lote.js"></script>
          <script src="/html/js/envasado/calcPeso.js"></script>
          <script src="/html/js/envasado/muestras.js"></script>
          <script src="/html/js/envasado/materialEnvase.js"></script>
          <script src="/html/js/envasado/entregasParciales.js"></script>
          <script src="/html/js/envasado/btnEnvasado.js"></script>

</body>

</html>