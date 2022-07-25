<?php
session_start();
$_SESSION["timeout"] = time();
include('modal/modal_firma.php');
include('modal/modal_cambiarContrasena.php');
include('modal/modal_observaciones.php');
include('modal/m_firma.php');
include('modal/m_muestras_acondicionamiento.php');
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
  <title>Acondicionamiento | Samara Cosmetics</title>

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
  <!-- script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->

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
    <?php include('partials/header.php'); ?>

    <div class="container-fluid">
      <div class="row page-titles">
        <h1 hidden>6</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Acondicionamiento</b></h1>
        <a href="../../acondicionamiento" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
                  INFORMACIÓN DEL PRODUCTO
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
                          <th class="centrado">Multipresentación</th>
                          <th class="centrado">Cantidad(Und)</th>
                          <th class="centrado">Total(Kg)</th>
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
                    <label for="in_observaciones" class="col-form-label">Observaciones:</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por:</label>
                    <input type="text" class="form-control" id="despeje_realizado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger despeje_realizado" id="despeje_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por:</label>
                    <input type="text" class="form-control" id="despeje_verificado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger despeje_verificado" id="despeje_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="acondicionamiento1">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi1" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="acondicionamientoMulti1" class="img_ref">ACONDICIONAMIENTO</b>
                  <input type="text" class="ref1" id="ref1" hidden>
                  <input type="text" class="unidad_empaque1" id="unidad_empaque1" hidden>
                  <input type="text" class="presentacion1" id="presentacion1" hidden>
                  <input type="text" class="densidad1" id="densidad1" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Recepción Material</h3>
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
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="empaque1" class="centrado empaque1"></td>
                                <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                <td id="unidades1e" class="centrado unidades1e"></td>
                              </tr>
                              <tr>
                                <td id="otros1" class="centrado otros1"></td>
                                <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                <td id="unidades4" class="centrado unidades1"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Línea de Producción</h3>
                </div>
                <div class="linea-produccion">
                  <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                  <label for="recipient-name" class="col-form-label">Etiquetadora</label>
                  <label for="recipient-name" class="col-form-label">Tunel Termo</label>

                  <select class="selectpicker form-control banda sel_equipos" id="sel_banda1"></select>
                  <select class="selectpicker form-control etiquetadora sel_equipos" id="sel_etiquetadora1"></select>
                  <select class="selectpicker form-control tunel sel_equipos" id="sel_tunel1"></select>

                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                  </div>

                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Cantidad de Muestras</label>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <input type="text" class="form-control muestras1" id="muestras1" style="text-align: center;" readonly>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;" onclick="muestras_acondicionamiento();" data-toggle="modal" data-target="#m_muestras_acond">Iniciar</button> <!--   -->
                  </div>
                  <div class="col-md-1 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light" style="background: seagreen;color:white" onclick=" reimprimirEtiquetas();">Reimprimir Etiquetas</button>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado por:</label>
                    <input type="text" class="form-control" id="controlpeso_realizado1" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado1" id="controlpeso_realizado1" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma3')">Firmar</button>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado por:</label>
                    <input type="text" class="form-control" id="controlpeso_verificado1" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso controlpeso_verificado1" id="controlpeso_verificado1" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma4')">Firmar</button>
                  </div>
                </div>
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Sobrante</h3>
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
                              <th>Utilizadas</th>
                              <th>Averias</th>
                              <th>Sobrante</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td id="refempaque1" class="empaque1"></td>
                              <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                              <td id="unidades2e" class="centrado unidades1e"></td>
                              <td><input type="number" id="utilizada_empaque1" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_empaque1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_empaque1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_empaque1" class="centrado"></td>
                            </tr>
                            <tr>
                              <td id="refempaque2" class="otros1"></td>
                              <td id="descripcion_otros1" class="descripcion_otros1"></td>
                              <td id="unidades8" class="centrado unidades1"></td>
                              <td><input type="number" id="utilizada_otros1" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_otros1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_otros1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_otros1" class="centrado"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Realizado Por</label>
                      <input type="text" class="form-control" id="devolucion_realizado1" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado1" id="devolucion_realizado1" onclick="cargar(this, 'firma5')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>

                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Verificado Por</label>
                      <input type="text" class="form-control" id="devolucion_verificado1" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado1" id="devolucion_verificado1" onclick="cargar(this, 'firma6')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                  <div class="row " style="margin: 1%">
                    <div class="col-md-12 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliación Rendimiento</h3>
                    </div>
                  </div>

                  <div class="alert-input">
                    <div class="alert alert-danger ajuste_alert" role="alert" id="alert_entregas1">
                      Total unidades entregadas a la fecha
                    </div>
                    <input type="text" class="form-control centrado" id="parcialesUnidadesProducidas1" style="width: 100px;height:fit-content" readonly>
                  </div>

                  <div class="conciliacionrendimiento">

                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Unidades Producidas:</label>
                      <input type="number" class="form-control centrado" id="txtUnidadesProducidas1" min="1" onkeyup="conciliacionRendimiento();"> <!-- Este valor se valide con lo envasado por el usuario en envasado txtEnvasado1 Alert(Las unidades producidads son diferentes a las envasadas, notificar al jefe de producción) -->
                    </div>

                    <div class=" conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Muestras de Retención:</label>
                      <input type="number" class="form-control centrado" id="txtMuestrasRetencion1" min="1" onkeyup="conciliacionRendimiento();"><!-- impresion etiquetas para muestras (No produccion, lote, cod barras, cod producto, fecha ) -->
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total Cajas:</label>
                      <input type="text" class="form-control centrado" id="txtTotal-Cajas1" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total a Entregar Bodega/Cliente:</label>
                      <input type="text" class="form-control centrado" id="txtEntrega-Bodega1" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Rendimiento Producto:</label>
                      <input type="text" class="form-control centrado" id="rendimientoProducto1" min="1" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Porcentaje Unidades:</label>
                      <input type="text" class="form-control centrado" id="txtPorcentaje-Unidades1" min="1" readonly>
                      <input type="text" class="form-control centrado" id="unidadesProgramadas1" hidden>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Movimiento Inventario:</label>
                      <input type="text" class="form-control centrado" id="txtNoMovimiento1" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Responsable Movimiento Ofimatica:</label>
                      <input type="text" class="form-control centrado" id="txtReponsable1" value="Director de Producción (CRC)" readonly>
                    </div>


                  </div>

                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    </div>

                    <div class="col-md-4 align-self-center  mb-5">
                      <label for="recipient-name" class="col-form-label">Entregado por:</label>
                      <input type="text" class="form-control conciliacion_realizado1" id="conciliacion_realizado1" readonly>
                    </div>
                    <div class="col-md-2 align-self-center mb-5" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger conciliacion_realizado1" id="conciliacion_realizado1" onclick="cargar(this, 'firma7')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card" id="acondicionamiento2">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link ref_multi2 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="acondicionamientoMulti2" class="img_ref">ACONDICIONAMIENTO</b>
                  <input type="text" class="ref2" id="ref2" hidden>
                  <input type="text" class="unidad_empaque2" id="unidad_empaque2" hidden>
                  <input type="text" class="presentacion1" id="presentacion2" hidden>
                  <input type="text" class="densidad1" id="densidad2" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Recepción Material</h3>
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
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="empaque2" class="centrado empaque2"></td>
                                <td id="descripcion_empaque2" class="descripcion_empaque2"></td>
                                <td id="unidades2e" class="centrado unidades2e"></td>
                              </tr>
                              <tr>
                                <td id="otros2" class="centrado otros2"></td>
                                <td id="descripcion_otros2" class="descripcion_otros2"></td>
                                <td id="unidades2" class="centrado unidades2"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Línea de Producción</h3>
                </div>
                <div class="linea-produccion">

                  <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                  <label for="recipient-name" class="col-form-label">Etiquetadora</label>
                  <label for="recipient-name" class="col-form-label">Tunel Termo</label>

                  <select class="selectpicker form-control banda sel_equipos" id="sel_banda2"></select>
                  <select class="selectpicker form-control etiquetadora sel_equipos" id="sel_etiquetadora2"></select>
                  <select class="selectpicker form-control tunel sel_equipos" id="sel_tunel2"></select>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                  </div>

                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Cantidad de Muestras</label>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <input type="text" class="form-control muestras2" id="muestras2" style="text-align: center;" readonly>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <!-- <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;" onclick="muestrasEnvase();">Iniciar</button> -->
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;" onclick="muestras_acondicionamiento();" data-toggle="modal" data-target="#m_muestras_acond">Iniciar</button> <!--   -->
                  </div>
                  <div class="col-md-1 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light" style="background: seagreen;color:white" onclick=" reimprimirEtiquetas();">Reimprimir Etiquetas</button>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado por:</label>
                    <input type="text" class="form-control" id="controlpeso_realizado2" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado2" id="controlpeso_realizado2" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma3')">Firmar</button>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado por:</label>
                    <input type="text" class="form-control" id="controlpeso_verificado2" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado2" id="controlpeso_verificado2" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma4')">Firmar</button>
                  </div>
                </div>
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Sobrante</h3>
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
                              <th>Utilizadas</th>
                              <th>Averias</th>
                              <th>Sobrante</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td id="refempaque2" class="empaque2"></td>
                              <td id="descripcion_empaque2" class="descripcion_empaque2"></td>
                              <td id="unidades2e" class="centrado unidades2e"></td>
                              <td><input type="number" id="utilizada_empaque2" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_empaque2" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_empaque2" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_empaque2" class="centrado"></td>
                            </tr>
                            <tr>
                              <td id="refempaque2" class="otros2"></td>
                              <td id="descripcion_otros2" class="descripcion_otros2"></td>
                              <td id="unidades2" class="centrado unidades2"></td>
                              <td><input type="number" id="utilizada_otros2" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_otros2" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_otros2" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_otros2" class="centrado"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Realizado Por</label>
                      <input type="text" class="form-control" id="devolucion_realizado2" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado2" id="devolucion_realizado2" onclick="cargar(this, 'firma5')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>

                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Verificado Por</label>
                      <input type="text" class="form-control" id="devolucion_verificado2" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado2" id="devolucion_verificado2" onclick="cargar(this, 'firma6')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                  <div class="row " style="margin: 1%">
                    <div class="col-md-12 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliación Rendimiento</h3>
                    </div>
                  </div>

                  <div class="alert-input">
                    <div class="alert alert-danger ajuste_alert" role="alert" id="alert_entregas2">
                      Total unidades entregadas a la fecha
                    </div>
                    <input type="text" class="form-control centrado" id="parcialesUnidadesProducidas2" style="width: 100px;height:fit-content" readonly>
                  </div>

                  <div class="conciliacionrendimiento">

                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Unidades Producidas:</label>
                      <input type="number" class="form-control centrado" id="txtUnidadesProducidas2" min="1" onkeyup="conciliacionRendimiento();"> <!-- Este valor se valide con lo envasado por el usuario en envasado txtEnvasado1 Alert(Las unidades producidads son diferentes a las envasadas, notificar al jefe de producción) -->
                    </div>

                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Muestras de Retención:</label>
                      <input type="number" class="form-control centrado" id="txtMuestrasRetencion2" min="1" onkeyup="conciliacionRendimiento();"><!-- impresion etiquetas para muestras (No produccion, lote, cod barras, cod producto, fecha ) -->
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total Cajas:</label>
                      <input type="text" class="form-control centrado" id="txtTotal-Cajas2" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total a Entregar Bodega/Cliente:</label>
                      <input type="text" class="form-control centrado" id="txtEntrega-Bodega2" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Rendimiento Producto:</label>
                      <input type="text" class="form-control centrado" id="rendimientoProducto2" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Porcentaje Unidades:</label>
                      <input type="text" class="form-control centrado" id="txtPorcentaje-Unidades2" min="1">
                      <input type="text" class="form-control centrado" id="unidadesProgramadas2" hidden>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Movimiento Inventario:</label>
                      <input type="number" class="form-control centrado" id="txtNoMovimiento2" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Responsable Movimiento Ofimatica:</label>
                      <input type="text" class="form-control centrado" id="txtReponsable2" value="Director de Producción (CRC)" readonly>
                    </div>
                  </div>


                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    </div>

                    <div class="col-md-4 align-self-center  mb-5">
                      <label for="recipient-name" class="col-form-label">Entregado por:</label>
                      <input type="text" class="form-control conciliacion_realizado2" id="conciliacion_realizado2" readonly>
                    </div>
                    <div class="col-md-2 align-self-center mb-5" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger conciliacion_realizado2" id="conciliacion_realizado2" onclick="cargar(this, 'firma7')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="acondicionamiento3">
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi3" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="acondicionamientoMulti3" class="img_ref">ACONDICIONAMIENTO</b>
                  <input type="text" class="ref3" id="ref3" hidden>
                  <input type="text" class="unidad_empaque3" id="unidad_empaque3" hidden>
                  <input type="text" class="presentacion1" id="presentacion3" hidden>
                  <input type="text" class="densidad1" id="densidad3" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Recepción Material</h3>
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
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="empaque3" class="centrado empaque3"></td>
                                <td id="descripcion_empaque3" class="descripcion_empaque3"></td>
                                <td id="unidades3e" class="centrado unidades3e"></td>
                              </tr>
                              <tr>
                                <td id="otros3" class="centrado otros3"></td>
                                <td id="descripcion_otros3" class="descripcion_otros3"></td>
                                <td id="unidades3" class="centrado unidades3"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Línea de Producción</h3>
                </div>
                <div class="linea-produccion">

                  <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                  <label for="recipient-name" class="col-form-label">Etiquetadora</label>
                  <label for="recipient-name" class="col-form-label">Tunel Termo</label>

                  <select class="selectpicker form-control banda sel_equipos" id="sel_banda3"></select>
                  <select class="selectpicker form-control etiquetadora sel_equipos" id="sel_etiquetadora3"></select>
                  <select class="selectpicker form-control tunel sel_equipos" id="sel_tunel3"></select>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                  </div>

                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Cantidad de Muestras</label>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <input type="text" class="form-control muestras2" id="muestras3" style="text-align: center;" readonly>
                  </div>
                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;" onclick="muestras_acondicionamiento();" data-toggle="modal" data-target="#m_muestras_acond">Iniciar</button> <!--   -->
                  </div>
                  <div class="col-md-1 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light" style="background: seagreen;color:white" onclick=" reimprimirEtiquetas();">Reimprimir Etiquetas</button>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado por:</label>
                    <input type="text" class="form-control" id="controlpeso_realizado3" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado3" id="controlpeso_realizado3" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma3')">Firmar</button>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado por:</label>
                    <input type="text" class="form-control" id="controlpeso_verificado3" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado3" id="controlpeso_verificado3" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma4')">Firmar</button>
                  </div>
                </div>
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Sobrante</h3>
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
                              <th>Utilizadas</th>
                              <th>Averias</th>
                              <th>Sobrante</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td id="refempaque3" class="empaque3"></td>
                              <td id="descripcion_empaque3" class="descripcion_empaque3"></td>
                              <td id="unidades3e" class="centrado unidades3e"></td>
                              <td><input type="number" id="utilizada_empaque3" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_empaque3" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_empaque3" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_empaque3" class="centrado"></td>
                            </tr>
                            <tr>
                              <td id="refempaque3" class="otros3"></td>
                              <td id="descripcion_otros3" class="descripcion_otros3"></td>
                              <td id="unidades3" class="centrado unidades3"></td>
                              <td><input type="number" id="utilizada_otros3" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_otros3" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_otros3" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_otros3" class="centrado"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Realizado Por</label>
                      <input type="text" class="form-control" id="devolucion_realizado3" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado3" id="devolucion_realizado3" onclick="cargar(this, 'firma5')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>

                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Verificado Por</label>
                      <input type="text" class="form-control" id="devolucion_verificado3" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado3" id="devolucion_verificado3" onclick="cargar(this, 'firma6')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                  <div class="row " style="margin: 1%">
                    <div class="col-md-12 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliación Rendimiento</h3>
                    </div>
                  </div>

                  <div class="alert-input">
                    <div class="alert alert-danger ajuste_alert" role="alert" id="alert_entregas3">
                      Total unidades entregadas a la fecha
                    </div>
                    <input type="text" class="form-control centrado" id="parcialesUnidadesProducidas3" style="width: 100px;height:fit-content" readonly>
                  </div>

                  <div class="conciliacionrendimiento">
                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Unidades Producidas:</label>
                      <input type="number" class="form-control centrado" id="txtUnidadesProducidas3" min="1" onkeyup="conciliacionRendimiento();"> <!-- Este valor se valide con lo envasado por el usuario en envasado txtEnvasado1 Alert(Las unidades producidads son diferentes a las envasadas, notificar al jefe de producción) -->
                    </div>

                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Muestras de Retención:</label>
                      <input type="number" class="form-control centrado" id="txtMuestrasRetencion3" min="1" onkeyup="conciliacionRendimiento();"><!-- impresion etiquetas para muestras (No produccion, lote, cod barras, cod producto, fecha ) -->
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total Cajas:</label>
                      <input type="text" class="form-control centrado" id="txtTotal-Cajas3" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total a Entregar Bodega/Cliente:</label>
                      <input type="text" class="form-control centrado" id="txtEntrega-Bodega3" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Rendimiento Producto:</label>
                      <input type="text" class="form-control centrado" id="rendimientoProducto3" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Porcentaje Unidades:</label>
                      <input type="text" class="form-control centrado" id="txtPorcentaje-Unidades3" min="1">
                      <input type="text" class="form-control centrado" id="unidadesProgramadas3" hidden>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Movimiento Inventario:</label>
                      <input type="number" class="form-control centrado" id="txtNoMovimiento3" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Responsable Movimiento Ofimatica:</label>
                      <input type="text" class="form-control centrado" id="txtReponsable3" value="Director de Producción (CRC)" readonly>
                    </div>
                  </div>

                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    </div>

                    <div class="col-md-4 align-self-center  mb-5">
                      <label for="recipient-name" class="col-form-label">Entregado por:</label>
                      <input type="text" class="form-control conciliacion_realizado3" id="conciliacion_realizado3" readonly>
                    </div>
                    <div class="col-md-2 align-self-center mb-5" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger conciliacion_realizado3" id="conciliacion_realizado3" onclick="cargar(this, 'firma7')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="card" id="acondicionamiento4">
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi4" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="acondicionamientoMulti4" class="img_ref">ACONDICIONAMIENTO</b>
                  <input type="text" class="ref4" id="ref4" hidden>
                  <input type="text" class="unidad_empaque4" id="unidad_empaque4" hidden>
                  <input type="text" class="presentacion1" id="presentacion4" hidden>
                  <input type="text" class="densidad1" id="densidad4" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Recepción Material</h3>
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
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="empaque4" class="centrado empaque4"></td>
                                <td id="descripcion_empaque4" class="descripcion_empaque4"></td>
                                <td id="unidade4e" class="centrado unidades4e"></td>
                              </tr>
                              <tr>
                                <td id="otros4" class="centrado otros4"></td>
                                <td id="descripcion_otros4" class="descripcion_otros4"></td>
                                <td id="unidades4" class="centrado unidades4"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Línea de Producción</h3>
                </div>
                <div class="linea-produccion">

                  <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                  <label for="recipient-name" class="col-form-label">Etiquetadora</label>
                  <label for="recipient-name" class="col-form-label">Tunel Termo</label>

                  <select class="selectpicker form-control banda sel_equipos" id="sel_banda4"></select>
                  <select class="selectpicker form-control etiquetadora sel_equipos" id="sel_etiquetadora4"></select>
                  <select class="selectpicker form-control tunel sel_equipos" id="sel_tunel4"></select>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                  </div>

                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Cantidad de Muestras</label>
                  </div>

                  <div class="col-md-3 align-self-center" style="margin-top: 1%">
                    <input type="text" class="form-control muestras4" id="muestras4" style="text-align: center;" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;" onclick="muestras_acondicionamiento();" data-toggle="modal" data-target="#m_muestras_acond">Iniciar</button> <!--   -->
                  </div>

                  <div class="col-md-1 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light" style="background: seagreen;color:white" onclick=" reimprimirEtiquetas();">Reimprimir Etiquetas</button>
                  </div>

                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado por:</label>
                    <input type="text" class="form-control" id="controlpeso_realizado4" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado4" id="controlpeso_realizado4" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma3')">Firmar</button>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado por:</label>
                    <input type="text" class="form-control" id="controlpeso_verificado4" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado4" id="controlpeso_verificado4" style="width: 180px; height: 38px;" onclick="cargar(this, 'firma4')">Firmar</button>
                  </div>
                </div>
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Sobrante</h3>
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
                              <th>Utilizadas</th>
                              <th>Averias</th>
                              <th>Sobrante</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td id="refempaque4" class="empaque4"></td>
                              <td id="descripcion_empaque3" class="descripcion_empaque4"></td>
                              <td id="unidades4e" class="centrado unidades4e"></td>
                              <td><input type="number" id="utilizada_empaque4" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_empaque4" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_empaque4" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_empaque4" class="centrado"></td>
                            </tr>
                            <tr>
                              <td id="refempaque4" class="otros4"></td>
                              <td id="descripcion_otros4" class="descripcion_otros4"></td>
                              <td id="unidades4" class="centrado unidades4"></td>
                              <td><input type="number" id="utilizada_otros4" class="form-control centrado envasada1e" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="averias_otros4" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td><input type="number" id="sobrante_otros4" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                              <td id="totalDevolucion_otros4" class="centrado"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Realizado Por</label>
                      <input type="text" class="form-control" id="devolucion_realizado4" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_realizado4" id="devolucion_realizado4" onclick="cargar(this, 'firma5')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>

                    <div class="col-md-4 align-self-center">
                      <label for="recipient-name" class="col-form-label">Verificado Por</label>
                      <input type="text" class="form-control" id="devolucion_verificado4" readonly>
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado4" id="devolucion_verificado4" onclick="cargar(this, 'firma6')" style="width: 180px; height: 38px;">Firmar</button>
                    </div>
                  </div>
                  <div class="row " style="margin: 1%">
                    <div class="col-md-12 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliación Rendimiento</h3>
                    </div>
                  </div>

                  <div class="alert-input">
                    <div class="alert alert-danger ajuste_alert" role="alert" id="alert_entregas4">
                      Total unidades entregadas a la fecha
                    </div>
                    <input type="text" class="form-control centrado" id="parcialesUnidadesProducidas4" style="width: 100px;height:fit-content" readonly>
                  </div>

                  <div class="conciliacionrendimiento">
                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Unidades Producidas:</label>
                      <input type="number" class="form-control centrado" id="txtUnidadesProducidas4" min="1" onkeyup="conciliacionRendimiento();"> <!-- Este valor se valide con lo envasado por el usuario en envasado txtEnvasado1 Alert(Las unidades producidads son diferentes a las envasadas, notificar al jefe de producción) -->
                    </div>

                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Muestras de Retención:</label>
                      <input type="number" class="form-control centrado" id="txtMuestrasRetencion4" min="1" onkeyup="conciliacionRendimiento();"><!-- impresion etiquetas para muestras (No produccion, lote, cod barras, cod producto, fecha ) -->
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total Cajas:</label>
                      <input type="text" class="form-control centrado" id="txtTotal-Cajas4" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Total a Entregar Bodega/Cliente:</label>
                      <input type="text" class="form-control centrado" id="txtEntrega-Bodega4" readonly>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Rendimiento Producto:</label>
                      <input type="text" class="form-control centrado" id="rendimientoProducto4" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Porcentaje Unidades:</label>
                      <input type="text" class="form-control centrado" id="txtPorcentaje-Unidades4" min="1">
                      <input type="text" class="form-control centrado" id="unidadesProgramadas4" hidden>
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">No Movimiento Inventario:</label>
                      <input type="number" class="form-control centrado" id="txtNoMovimiento4" min="1">
                    </div>


                    <div class="conciliacionrendimiento__group">
                      <label for="recipient-name" class="col-form-label">Responsable Movimiento Ofimatica:</label>
                      <input type="text" class="form-control centrado" id="txtReponsable4" value="Director de Producción (CRC)" readonly>
                    </div>
                  </div>

                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 align-self-center">
                    </div>
                    <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    </div>

                    <div class="col-md-4 align-self-center  mb-5">
                      <label for="recipient-name" class="col-form-label">Entregado por:</label>
                      <input type="text" class="form-control conciliacion_realizado4" id="conciliacion_realizado4" readonly>
                    </div>
                    <div class="col-md-2 align-self-center mb-5" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger conciliacion_realizado4" id="conciliacion_realizado4" onclick="cargar(this, 'firma7')" style="width: 180px; height: 38px;">Firmar</button>
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
        <script src="../../html/vendor/datatables/datatables.min.js" type="text/javascript" ></script>
        <script src="../../html/js/utils/jquery.slimscroll.js"></script>
        <script src="../../html/js/utils/waves.js"></script>
        <script src="../../html/js/utils/sidebarmenu.js"></script>
        <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="../../html/js/utils/custom.min.js"></script>
        <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        
        <script src="/html/js/global/loadinfo-global.js"></script>
        <script src="/html/js/global/preguntas.js"></script>
        <script src="/html/js/global/despeje.js"></script>
        <script src="/html/js/firmar/firmar1raSeccion.js"></script>
        <script src="/html/js/firmar/firmar2daSeccionMulti.js"></script>
        <script src="/html/js/global/incidencias.js"></script>
        <script src="/html/js/global/tanques.js"></script>
        <script src="/html/js/global/equipos.js"></script>
        <script src="/html/js/global/etiquetas.js"></script>
        <script src="/html/js/global/muestras.js"></script>
        <script src="/html/js/global/condiciones_medio.js"></script>
        <script src="/html/js/global/cargarBatchMulti.js"></script>
        <script src="/html/js/global/image.js"></script>
        <script src="/html/js/global/presentacionReferenciaMulti.js"></script>
        <script src="/html/js/global/habilitarbtn.js"></script>
        
        <script src="/html/js/acondicionamiento/acondicionamientoinfo.js"></script>
        <script src="/html/js/acondicionamiento/multi.js"></script>
        <script src="/html/js/acondicionamiento/deshabilitarBotones.js"></script>
        <script src="/html/js/acondicionamiento/conciliacion.js"></script>
        <script src="/html/js/acondicionamiento/imprimirEtiquetas.js"></script>
        <script src="/html/js/acondicionamiento/materiales.js"></script>
            
</body>

</html>