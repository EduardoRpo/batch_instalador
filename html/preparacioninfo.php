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

  <title>Samara Cosmetics</title>

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">

  <!-- Bootstrap Core CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

  <!-- Custom CSS -->
  <link href="../../html/css/style.css" rel="stylesheet">

  <!-- You can change the theme colors from here -->
  <link href="../../html/css/colors/blue.css" id="theme" rel="stylesheet">
  <link rel="stylesheet" href="../../html/vendor/jquery-confirm/jquery-confirm.min.css">

  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">


  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->

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
        <h1 hidden>3</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Preparación</b></h1>
        <a href="../../preparacion" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" role="button">Cola de Trabajo</a>
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

                <!--      <div class="contenedorInfo2">
                  <label for="recipient-name" class="col-form-label">Fecha Programación</label>
                  <label for="recipient-name" class="col-form-label">No Orden de Producción</label>
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
                  <label for="in_tamano_lote" class="col-form-label">Tamaño Lote (kg)</label>
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
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                  DESPEJE DE LINEAS Y PROCESOS
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Parámetros de Control</h3>
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
                    <label for="sel_producto_desinfeccion" class="col-form-label">Producto Desinfección</label>
                    <select class="selectpicker form-control in_desinfeccion" id="sel_producto_desinfeccion">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                  <div class="col-md-8 align-self-center">
                    <label for="in_observaciones" class="col-form-label ">Observaciones</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control " id="despeje_realizado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger despeje_realizado" id="despeje_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control" id="despeje_verificado" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger despeje_verificado" id="despeje_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  Preparación
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <!-- <div class="row" style="margin: 1%">
              <div class="col-md-12 col-2 align-self-center">
                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Máquinas</h3>
              </div> -->
                <h3 class="subtitulo" style="text-align: center; background-color: #C0C0C0; margin:25px; height:40px">Máquinas</h3>
                <div class="maquinasPreparacion">

                  <div class="maquinasPreparacion__group">
                    <label for="">Linea</label>
                    <select class="selectpicker form-control" id="select-Linea"></select>
                  </div>

                  <div class="maquinasPreparacion__group">
                    <label for="sel_agitador">Identificación Agitador</label>
                    <input type="text" id="sel_agitador" class="form-control" readonly>
                  </div>

                  <div class="maquinasPreparacion__group">
                    <label for="sel_marmita">Identificación Marmita o Tanque</label>
                    <input type="text" id="sel_marmita" class="form-control" readonly>
                  </div>

                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">
                      Instructivo de Preparación</h3>
                  </div>
                  <div class="chk-control m-3">
                    <label for="" class="lblchk-control">Control Preparación Tanques</label>

                  </div>
                  <hr>
                  <div class="col-md-8 align-self-center">

                    <div id="pasos_instructivo" class="col-form-label"></div>

                  </div>
                  <div class="col-md-4 align-self-center">
                    <section class="clock">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-10 input-wrapper">
                            <div class="input">
                              <input type="number" id="tiempo_instructivo" class="form-control" min="0" readonly>
                              <select id="measure" class="form-control" disabled>
                                <option value="s">Segundos</option>
                              </select>
                            </div>
                            <div class="buttons-wrapper">
                              <button class="btn" id="start-countdown">Iniciar</button>
                            </div>
                          </div>
                          <div id="timer" class="col-12">
                            <div class="clock-wrapper">
                              <span class="hours">00</span>
                              <span class="dots">:</span>
                              <span class="minutes">00</span>
                              <span class="dots">:</span>
                              <span class="seconds">00</span>
                            </div>
                          </div>
                          <div class="buttons-wrapper">
                            <button class="btn" id="resume-timer">Continuar</button>
                            <button class="btn" id="stop-timer">Pausa</button>
                            <button class="btn" id="reset-timer">Reiniciar</button>
                          </div>
                        </div>
                      </div>
                    </section>

                  </div>
                </div>


                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #c0c0c0">Control de proceso</h3>
                  </div>
                  <div class="col-md-12 align-self-center">
                    <div class="card">
                      <div class="card-block">
                        <!--<h4 class="card-title">Basic Table</h4>
                   <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                        <div class="table-responsive">
                          <table id="tblControlProcesoPreparacion" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th style="text-align: center;">PARAMETROS</th>
                                <th style="text-align: center;">ESPECIFICACIONES</th>
                                <th style="text-align: center;">RESULTADOS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Color</td>
                                <td id="espec_color"></td>
                                <td><select class="selectpicker form-control">
                                    <option selected hidden>Seleccionar</option>
                                    <option value="1">Cumple </option>
                                    <option value="2">No Cumple</option>
                                    <option value="3">No Aplica</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Olor</td>
                                <td id="espec_olor"></td>
                                <td><select class="selectpicker form-control">
                                    <option selected hidden></option>
                                    <option value="1">Cumple </option>
                                    <option value="2">No Cumple</option>
                                    <option value="3">No Aplica</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Apariencia</td>
                                <td id="espec_apariencia"></td>
                                <td><select class="selectpicker form-control">
                                    <option selected hidden></option>
                                    <option value="1">Cumple </option>
                                    <option value="2">No Cumple</option>
                                    <option value="3">No Aplica</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>PH</td>
                                <td id="espec_ph"></td>
                                <td><input type="number" id="in_ph" class="selectpicker form-control">
                                </td>
                              </tr>
                              <tr>
                                <td>Viscocidad CPS</td>
                                <td id="espec_viscidad"></td>
                                <td><input type="number" class="selectpicker form-control" id="in_viscocidad">
                                </td>
                              </tr>
                              <tr>
                                <td>Densidad</td>
                                <td id="espec_densidad"></td>
                                <td><input class="selectpicker form-control" type="number" id="in_densidad">
                                </td>
                              </tr>
                              <tr>
                                <td>Untuosidad</td>
                                <td id="espec_untosidad"></td>
                                <td><select class="selectpicker form-control">
                                    <option selected hidden></option>
                                    <option value="1">Cumple </option>
                                    <option value="2">No Cumple</option>
                                    <option value="3">No Aplica</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Poder Espumoso</td>
                                <td id="espec_poder_espumoso"></td>
                                <td><select class="selectpicker form-control">
                                    <option selected hidden></option>
                                    <option value="1">Cumple </option>
                                    <option value="2">No Cumple</option>
                                    <option value="3">No Aplica</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Grado Alcohol</td>
                                <td id="espec_grado_alcohol"></td>
                                <td><input class="selectpicker form-control" type="number" id="in_grado_alcohol">
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
                  <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#modalAjuste" style="margin-left: 1%">
                    ¿Se requiere algún ajuste?
                  </button>
                </div>
                <!-- <hr> -->

                <hr>
                <div class="row" style="margin: 1%">
                  <!-- <div class="col-md-2 col-2 align-self-right">
                <label for="in_realizado_2" class="col-form-label">Fecha</label>
                <input type="text" class="form-control" id="in_realizado_2" readonly>
              </div> -->
                  <div class="col-md-4 align-self-center">
                    <label for="preparacion_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control" id="preparacion_realizado" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger preparacion_realizado" id="preparacion_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 align-self-center">
                    <!-- APARECER SOLO AL CHEQUEAR EL ULTIMO CHECKBOX -->
                    <label for="preparacion_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control" id="preparacion_verificado" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger preparacion_verificado" id="preparacion_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
                <!-- <hr> -->

                <!-- <div class="row buttons-group-container" style="margin: 1%">
              <div class="buttons-group">
                <div class="col-md-12 align-self-center" style="margin-left: 85%; background-color:red">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="window.location.href = '../html/aprobacion.html';">Aceptar
                  <button type="button" class="btn btn-primary" onclick="guardarBatchPreparacion();">Guardar</button>
                </div>
                </div>
              </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- <script src="../../assets/plugins/jquery/jquery.min.js"></script> -->
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
  <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="../../html/vendor/datatables/datatables.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>



  <!--Alertify-->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="../../html/js/utils/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="../../html/js/utils/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../../html/js/utils/sidebarmenu.js"></script>
  <!--stickey kit -->
  <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <!--Custom JavaScript -->
  <script src="../../html/js/utils/custom.min.js"></script>
  <script src="../../html/js/utils/datatables.js"></script>
  <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
  <script src="../../html/js/preparacion/clock.js"></script>
  <script src="../../assets/plugins/jquery/jquery.number.min.js"></script>

  <script src="../../html/js/global/loadinfo-global.js"></script>
  <script src="../../html/js/global/despeje.js"></script>
  <script src="../../html/js/global/tanques.js"></script>
  <script src="../../html/js/global/condicionesdelMedio.js"></script>
  <script src="../../html/js/global/cargarBatch.js"></script>
  <script src="../../html/js/pesaje/pesajeinfo.js"></script>
  <script src="../../html/js/preparacion/preparacioninfo.js"></script>
  <script src="../../html/js/firmar/firmar.js"></script>
  <script src="../../html/js/global/equipos.js"></script>
  <script src="../../html/js/global/incidencias.js"></script>

</body>

</html>