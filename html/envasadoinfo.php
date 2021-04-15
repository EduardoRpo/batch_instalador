<?php
session_start();
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
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi1" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti1">ENVASADO</b>
                  <input type="text" class="ref1" id="ref1" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
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
                                <td id="envase1" class="centrado envase1"></td>
                                <td id="descripcion_envase1" class="descripcion_envase1"></td>
                                <td id="unidades2" class="centrado unidades1"></td>
                              </tr>
                              <tr>
                                <td id="tapa1" class="centrado tapa1"></td>
                                <td id="descripcion_tapa1" class="descripcion_tapa1"></td>
                                <td id="unidades1" class="centrado unidades1"></td>
                              </tr>
                              <tr>
                                <td id="etiqueta1" class="centrado etiqueta1"></td>
                                <td id="descripcion_etiqueta1" class="descripcion_etiqueta1"></td>
                                <td id="unidades3" class="centrado unidades1"></td>
                              </tr>
                              <!--<tr>
                                <td id="empaque1" class="centrado empaque1"></td>
                                <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                <td id="unidades1e" class="centrado unidades1e"></td>
                              </tr>
                              <tr>
                                <td id="otros1" class="centrado otros1"></td>
                                <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                <td id="unidades4" class="centrado unidades1"></td>
                              </tr> -->
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
                        <select class="selectpicker form-control" id="sel_envasadora"></select>
                        <!--  <input type="text" class="form-control envasadora1" readonly> -->
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <select class="selectpicker form-control" id="sel_loteadora"></select>
                        <!-- <input type="text" class="form-control loteadora1" readonly> -->
                      </div>


                      <div class="group">
                        <!-- <label for="recipient-name" class="col-form-label">Linea</label>
                        <select class="selectpicker form-control select-linea" id="select-Linea1">
                          <option selected hidden>Seleccionar Linea</option>

                        </select> -->
                      </div>
                    </div>

                    <div class="col-md-12 align-self-center">
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

                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mb-3">
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
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mt-3">
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
                                    <td id="envase1" class="envase1 refEmpaque1"></td>
                                    <td id="descripcion_envase1" class="descripcion_envase1"></td>
                                    <td id="unidades5" class="centrado unidades1"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado txtEnvasada1" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="tapa1" class="tapa1 refEmpaque2"></td>
                                    <td id="descripcion_tapa1" class="descripcion_tapa1"></td>
                                    <td id="unidades6" class="centrado unidades1"></td>
                                    <td id="txtEnvasada2" class="centrado envasada1"></td>
                                    <td><input type="number" id="averias2" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante2" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="etiqueta1" class="etiqueta1 refEmpaque3"></td>
                                    <td id="descripcion_etiqueta1" class="descripcion_etiqueta1"></td>
                                    <td id="unidades7" class="centrado unidades1"></td>
                                    <td id="txtEnvasada3" class="centrado envasada1"></td>
                                    <td><input type="number" id="averias3" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante3" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion3" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <!-- <tr>
                                    <td id="empaque1" class="empaque1"></td>
                                    <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                    <td id="unidades2e" class="centrado unidades1e"></td>
                                    <td id="txtEnvasada4" class="centrado envasada1e"></td>
                                    <td><input type="number" id="averias4" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante4" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 4);"></td>
                                    <td id="totalDevolucion4" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="otros1" class="otros1"></td>
                                    <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                    <td id="unidades8" class="centrado unidades1"></td>
                                    <td id="txtEnvasada5" class="centrado envasada1"></td>
                                    <td><input type="number" id="averias5" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante5" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 5);"></td>
                                    <td id="totalDevolucion5" class="centrado"></td> 
                                  </tr> -->
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
                        <button type="button" class="btn waves-effect waves-light btn-danger devolucion_verificado1" style="width: 100%; height: 38px;" id="devolucion_verificadodo1" onclick="cargar(this, 'firma6')">Firmar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado2">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed ref_multi2" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti2">ENVASADO</b>
                  <input type="text" class="ref2" id="ref2" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
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
                                <td id="envase2" class="centrado envase1"></td>
                                <td id="descripcion_envase2" class="descripcion_envase1"></td>
                                <td id="unidades2" class="centrado unidades2"></td>
                              </tr>
                              <tr>
                                <td id="tapa1" class="centrado tapa1"></td>
                                <td id="descripcion_tapa1" class="descripcion_tapa1"></td>
                                <td id="unidades1" class="centrado unidades2"></td>
                              </tr>
                              <tr>
                                <td id="etiqueta1" class="centrado etiqueta1"></td>
                                <td id="descripcion_etiqueta1" class="descripcion_etiqueta1"></td>
                                <td id="unidades3" class="centrado unidades2"></td>
                              </tr>
                              <!--<tr>
                                <td id="empaque1" class="centrado empaque1"></td>
                                <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                <td id="unidades1e" class="centrado unidades1e"></td>
                              </tr>
                              <tr>
                                <td id="otros1" class="centrado otros1"></td>
                                <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                <td id="unidades4" class="centrado unidades1"></td>
                              </tr> -->
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">

                      <div class="group">
                        <label for="recipient-name" class="col-form-label">Linea</label>
                        <select class="selectpicker form-control select-linea" id="select-Linea2">
                          <option selected hidden>Seleccionar Linea</option>

                        </select>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label">Digite el lote (requerido)</label>
                        <input type="text" class="form-control validarLote" id="validarLote2" autocomplete="off" onblur="revisarLote();">
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora2">Identificación Envasadora</label>
                        <input type="text" class="form-control envasadora2" readonly>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                        <input type="text" class="form-control loteadora2" readonly>
                      </div>

                    </div>
                    <hr>

                    <div class="col-md-12 align-self-center">
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

                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mb-3">
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
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_realizado2" id="'controlpeso_realizado2'" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado2" readonly>
                      </div>
                      <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger controlpeso_verificado2" id="controlpeso_verificado2" onclick="cargar(this, 'firma4')" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mt-3">
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
                                    <td id="envase2" class="envase2 refEmpaque2"></td>
                                    <td id="descripcion_envase2" class="descripcion_envase2"></td>
                                    <td id="unidades5" class="centrado unidades2"></td>
                                    <td><input type="number" id="txtEnvasada2" min="1" class="form-control centrado txtEnvasada2" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias4" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante4" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion4" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="tapa2" class="tapa2 refEmpaque2"></td>
                                    <td id="descripcion_tapa2" class="descripcion_tapa2"></td>
                                    <td id="unidades6" class="centrado unidades2"></td>
                                    <td id="txtEnvasada2" class="centrado envasada2"></td>
                                    <td><input type="number" id="averias5" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante5" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion5" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="etiqueta2" class="etiqueta2 refEmpaque3"></td>
                                    <td id="descripcion_etiqueta2" class="descripcion_etiqueta2"></td>
                                    <td id="unidades7" class="centrado unidades2"></td>
                                    <td id="txtEnvasada3" class="centrado envasada2"></td>
                                    <td><input type="number" id="averias6" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante6" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion6" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <!-- <tr>
                                    <td id="empaque1" class="empaque1"></td>
                                    <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                    <td id="unidades2e" class="centrado unidades1e"></td>
                                    <td id="txtEnvasada4" class="centrado envasada1e"></td>
                                    <td><input type="number" id="averias4" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante4" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 4);"></td>
                                    <td id="totalDevolucion4" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="otros1" class="otros1"></td>
                                    <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                    <td id="unidades8" class="centrado unidades1"></td>
                                    <td id="txtEnvasada5" class="centrado envasada1"></td>
                                    <td><input type="number" id="averias5" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante5" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 5);"></td>
                                    <td id="totalDevolucion5" class="centrado"></td> 
                                  </tr> -->
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
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button id="ref_multi1" class="btn btn-link collapsed ref_multi3" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti3">ENVASADO</b>
                  <input type="text" class="ref3" id="ref3" hidden>
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-center">
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
                                <td id="envase3" class="centrado envase3"></td>
                                <td id="descripcion_envase3" class="descripcion_envase3"></td>
                                <td id="unidades2" class="centrado unidades3"></td>
                              </tr>
                              <tr>
                                <td id="tapa3" class="centrado tapa3"></td>
                                <td id="descripcion_tapa1" class="descripcion_tapa3"></td>
                                <td id="unidades1" class="centrado unidades3"></td>
                              </tr>
                              <tr>
                                <td id="etiqueta3" class="centrado etiqueta3"></td>
                                <td id="descripcion_etiqueta3" class="descripcion_etiqueta3"></td>
                                <td id="unidades3" class="centrado unidades3"></td>
                              </tr>
                              <!--<tr>
                                <td id="empaque1" class="centrado empaque1"></td>
                                <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                <td id="unidades1e" class="centrado unidades1e"></td>
                              </tr>
                              <tr>
                                <td id="otros1" class="centrado otros1"></td>
                                <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                <td id="unidades4" class="centrado unidades1"></td>
                              </tr> -->
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">

                      <div class="group">
                        <label for="recipient-name" class="col-form-label">Linea</label>
                        <select class="selectpicker form-control select-linea" id="select-Linea3">
                          <option selected hidden>Seleccionar Linea</option>
                        </select>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label">Digite el lote (requerido)</label>
                        <input type="text" class="form-control validarLote" id="validarLote3" autocomplete="off" onblur="revisarLote();">
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label envasadora3">Identificación Envasadora</label>
                        <input type="text" class="form-control envasadora3" readonly>
                      </div>

                      <div class="group">
                        <label for="recipient-name" class="col-form-label loteadora3">Identificación Loteadora</label>
                        <input type="text" class="form-control loteadora3" readonly>
                      </div>

                    </div>
                    <hr>

                    <div class="col-md-12 align-self-center">
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
                      <div class="col-md-12 align-self-center mb-3">
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
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 align-self-center mt-3">
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
                                    <td id="envase3" class="envase3 refEmpaque3"></td>
                                    <td id="descripcion_envase3" class="descripcion_envase3"></td>
                                    <td id="unidades5" class="centrado unidades3"></td>
                                    <td><input type="number" id="txtEnvasada3" min="1" class="form-control centrado txtEnvasada3" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias7" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante7" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion7" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="tapa3" class="tapa3 refEmpaque3"></td>
                                    <td id="descripcion_tapa3" class="descripcion_tapa3"></td>
                                    <td id="unidades6" class="centrado unidades3"></td>
                                    <td id="txtEnvasada3" class="centrado envasada3"></td>
                                    <td><input type="number" id="averias8" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante8" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion8" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="etiqueta3" class="etiqueta3 refEmpaque3"></td>
                                    <td id="descripcion_etiqueta3" class="descripcion_etiqueta3"></td>
                                    <td id="unidades7" class="centrado unidades3"></td>
                                    <td id="txtEnvasada3" class="centrado envasada3"></td>
                                    <td><input type="number" id="averias9" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td><input type="number" id="sobrante9" min="1" class="form-control centrado" style="width: 110px;" onkeyup="recalcular_valores();"></td>
                                    <td id="totalDevolucion9" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <!-- <tr>
                                    <td id="empaque1" class="empaque1"></td>
                                    <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                    <td id="unidades2e" class="centrado unidades1e"></td>
                                    <td id="txtEnvasada4" class="centrado envasada1e"></td>
                                    <td><input type="number" id="averias4" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante4" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 4);"></td>
                                    <td id="totalDevolucion4" class="centrado"></td>
                                  </tr>
                                  <tr>
                                    <td id="otros1" class="otros1"></td>
                                    <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                    <td id="unidades8" class="centrado unidades1"></td>
                                    <td id="txtEnvasada5" class="centrado envasada1"></td>
                                    <td><input type="number" id="averias5" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante5" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 5);"></td>
                                    <td id="totalDevolucion5" class="centrado"></td> 
                                  </tr> -->
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

          <!-- jquery -->
          <script src="../../assets/plugins/jquery/jquery.min.js"></script>

          <!-- Bootstrap tether Core JavaScript -->
          <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
          <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

          <!-- Datatables -->
          <script type="text/javascript" src="../../html/vendor/datatables/datatables.min.js"></script>
          <!-- <script src="html/vendor/bootstrap/js/popper.js"></script> -->
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
          <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
          <!-- <script src="../../html/js/datatables.js"></script> -->
          <script src="../../html/js/global/loadinfo-global.js"></script>
          <script src="../../html/js/global/despeje.js"></script>
          <script src="../../html/js/global/tanques.js"></script>
          <script src="../../html/js/global/muestras.js"></script>
          <script src="../../html/js/global/condiciones_medio.js"></script>
          <script src="../../html/js/global/cargarBatchMulti.js"></script>
          <script src="../../html/js/firmar/firmar1raSeccionMulti.js"></script>
          <script src="../../html/js/firmar/firmar2daSeccionMulti.js"></script>
          <script src="../../html/js/envasado/envasadoinfo.js"></script>
          <script src="../../html/js/global/incidencias.js"></script>
          <script src="../../html/js/global/equipos.js"></script>
          <script src="../../html/js/global/image.js"></script>

          <!--Alertify-->
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>