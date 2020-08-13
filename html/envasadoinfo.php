<?php
include('modal/modal_firma.php');
include('modal/modal_cambiarContrasena.php');
include('modal/modal_observaciones.php');
include('modal/m_firma.php');
include('modal/m_muestras.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
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
    <header class="topbar">
      <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
        <div class="navbar-header">
          <a class="navbar-brand">
            <span><img src="../../assets/images/logo-light-text2.png" class="light-logo" alt="homepage" /></span>
          </a>
        </div>

        <div class="navbar-collapse">
          <ul class="navbar-nav mr-auto mt-md-0">
            <li class="nav-item">
              <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                <i class="mdi mdi-menu"></i></a> </li>
          </ul>

          <ul class="navbar-nav my-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Berney Montoya
                <i class="large material-icons">account_circle</i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuenlace">
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalCambiarContrasena">Cambiar contraseña</a>
                <!-- <a href="../../index.php" class="dropdown-item">Cerrar sesión</a> -->
                <a href="../html/salir.php" class="dropdown-item">Cerrar sesión</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row page-titles">
        <h1 hidden>5</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Envasado</b></h1>
        <a href="../../envasado" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" role="button">Cola de Trabajo</a>
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
                <div class="contenedorInfo">
                  <label for="recipient-name" class="col-form-label">Fecha Programación</label>
                  <label for="recipient-name" class="col-form-label">No Orden</label>
                  <label for="recipient-name" class="col-form-label">Referencia</label>

                  <table id="txtobservacionesTanques" class="itemInfo table table-striped table-bordered" style="width:80%; height: 30px;">
                    <thead>
                      <tr>
                        <th>Presentación</th>
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
                <div class="row justify-content-center" style="margin: 1%;  background-color: #C0C0C0">
                  <div class="col-md-10 col-2 align-self-right">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Parámetros de control</h3>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style=" background-color: #C0C0C0">&nbsp;&nbsp;&nbsp;Si</h3>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style=" background-color: #C0C0C0">&nbsp;&nbsp;&nbsp;No</h3>
                  </div>
                </div>

                <div class="row" id="preguntas-div" style="margin: 1%"></div>

                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-right">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 col-2 align-self-right">
                    <label for="sel_producto_desinfeccion" class="col-form-label">Producto de desinfección</label>
                    <select class="selectpicker form-control in_desinfeccion" id="sel_producto_desinfeccion">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                  <div class="col-md-8 col-2 align-self-center">
                    <label for="in_observaciones" class="col-form-label">Observaciones</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 col-2 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_realizado" readonly>
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 col-2 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_verificado" readonly>
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
                <div class="row justify-content-end mt-5" style="margin: 1%; text-align: right">
                  <div class="col-md-12 col-2 align-self-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado1">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti1">ENVASADO</b>
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 col-2 align-self-center">
                    <div class="card">
                      <div class="card-block">

                        <div class="table-responsive">

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <!-- <th>Fecha</th> -->
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="tapa"></td>
                                <td id="descripcion_tapa"></td>
                                <td id="unidades1"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="envase"></td>
                                <td id="descripcion_envase"></td>
                                <td id="unidades2"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="otro"></td>
                                <td id="descripcion_otro"></td>
                                <td id="unidades3"></td>
                                <!-- <td></td> -->
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">
                      <label for="recipient-name" class="col-form-label">Linea</label>
                      <select class="selectpicker form-control" id="select-Linea">
                        <option selected hidden>Seleccionar Linea</option>
                        <option>LIQUIDOS</option>
                        <option>SOLIDOS</option>
                        <option>SEMISOLIDOS</option>
                      </select>

                      <label for="recipient-name" class="col-form-label">Digite el lote requerido</label>
                      <input type="text" class="form-control" onclick="validarLote(this.value);">

                      <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                      <input type="text" class="form-control txtEnvasadora" readonly>

                      <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                      <input type="text" class="form-control txtLoteadora" readonly>



                    </div>
                    <hr>

                    <div class="col-md-12 col-2 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">
                      <label for="recipient-name" class="col-form-label">Mínimo:</label>
                      <input type="text" class="form-control centrado" id="Minimo" readonly>

                      <label for="recipient-name" class="col-form-label">Medio:</label>
                      <input type="text" class="form-control centrado" id="Medio" readonly>

                      <label for="recipient-name" class="col-form-label">Máximo:</label>
                      <input type="text" class="form-control centrado" id="Maximo" readonly>
                    </div>
                    <!-- </div> -->
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Muestras" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Promedio">
                      </div>
                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 col-2 align-self-center">
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
                                    <td id="tapa1"></td>
                                    <td id="descripcion_tapa1"></td>
                                    <td id="unidades4"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 1);"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="envase1"></td>
                                    <td id="descripcion_envase1"></td>
                                    <td id="unidades5"></td>
                                    <td id="txtEnvasada2" class="centrado"></td>
                                    <td><input type="number" id="averias2" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante2" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 2);"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="otro1"></td>
                                    <td id="descripcion_otro1"></td>
                                    <td id="unidades6"></td>
                                    <td id="txtEnvasada3" class="centrado"></td>
                                    <td><input type="number" id="averias3" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante3" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 3);"></td>
                                    <td id="totalDevolucion3" class="centrado"></td> <!-- <input type="number" id="totalDevolucion3" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="firmas_envasado">

                      <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                      <input type="text" class="form-control" id="devolucion_realizado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_realizado">Firmar</button>

                      <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                      <input type="text" class="form-control" id="devolucion_verificado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_verificado">Firmar</button>

                      <button type="button" class="btn btn-secondary btn-cancelar" style="width: 100px; justify-self:end;">Cancelar</button>
                      <button type="button" class="btn btn-primary btn-aceptar" style="width: 100px; ">Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado2">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti2">ENVASADO</b>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 col-2 align-self-center">
                    <div class="card">
                      <div class="card-block">

                        <div class="table-responsive">

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <!-- <th>Fecha</th> -->
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="tapa"></td>
                                <td id="descripcion_tapa"></td>
                                <td id="unidades1"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="envase"></td>
                                <td id="descripcion_envase"></td>
                                <td id="unidades2"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="otro"></td>
                                <td id="descripcion_otro"></td>
                                <td id="unidades3"></td>
                                <!-- <td></td> -->
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">
                      <label for="recipient-name" class="col-form-label">Linea</label>
                      <select class="selectpicker form-control" id="select-Linea">
                        <option selected hidden>Seleccionar Linea</option>
                        <option>LIQUIDOS</option>
                        <option>SOLIDOS</option>
                        <option>SEMISOLIDOS</option>
                      </select>

                      <label for="recipient-name" class="col-form-label">Digite el lote requerido</label>
                      <input type="text" class="form-control">

                      <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                      <input type="text" class="form-control txtEnvasadora" readonly>

                      <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                      <input type="text" class="form-control txtLoteadora" readonly>



                    </div>
                    <hr>

                    <div class="col-md-12 col-2 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">
                      <label for="recipient-name" class="col-form-label">Mínimo:</label>
                      <input type="text" class="form-control centrado" id="Minimo" readonly>

                      <label for="recipient-name" class="col-form-label">Medio:</label>
                      <input type="text" class="form-control centrado" id="Medio" readonly>

                      <label for="recipient-name" class="col-form-label">Máximo:</label>
                      <input type="text" class="form-control centrado" id="Maximo" readonly>
                    </div>
                    <!-- </div> -->
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Muestras" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Promedio">
                      </div>
                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 col-2 align-self-center">
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
                                    <td id="tapa1"></td>
                                    <td id="descripcion_tapa1"></td>
                                    <td id="unidades4"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 1);"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="envase1"></td>
                                    <td id="descripcion_envase1"></td>
                                    <td id="unidades5"></td>
                                    <td id="txtEnvasada2" class="centrado"></td>
                                    <td><input type="number" id="averias2" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante2" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 2);"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="otro1"></td>
                                    <td id="descripcion_otro1"></td>
                                    <td id="unidades6"></td>
                                    <td id="txtEnvasada3" class="centrado"></td>
                                    <td><input type="number" id="averias3" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante3" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 3);"></td>
                                    <td id="totalDevolucion3" class="centrado"></td> <!-- <input type="number" id="totalDevolucion3" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="firmas_envasado">

                      <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                      <input type="text" class="form-control" id="devolucion_realizado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_realizado">Firmar</button>

                      <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                      <input type="text" class="form-control" id="devolucion_verificado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_verificado">Firmar</button>

                      <button type="button" class="btn btn-secondary btn-cancelar" style="width: 100px; justify-self:end;">Cancelar</button>
                      <button type="button" class="btn btn-primary btn-aceptar" style="width: 100px; ">Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado3">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti3">ENVASADO</b>
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 col-2 align-self-center">
                    <div class="card">
                      <div class="card-block">

                        <div class="table-responsive">

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <!-- <th>Fecha</th> -->
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="tapa"></td>
                                <td id="descripcion_tapa"></td>
                                <td id="unidades1"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="envase"></td>
                                <td id="descripcion_envase"></td>
                                <td id="unidades2"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="otro"></td>
                                <td id="descripcion_otro"></td>
                                <td id="unidades3"></td>
                                <!-- <td></td> -->
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">
                      <label for="recipient-name" class="col-form-label">Linea</label>
                      <select class="selectpicker form-control" id="select-Linea">
                        <option selected hidden>Seleccionar Linea</option>
                        <option>LIQUIDOS</option>
                        <option>SOLIDOS</option>
                        <option>SEMISOLIDOS</option>
                      </select>

                      <label for="recipient-name" class="col-form-label">Digite el lote requerido</label>
                      <input type="text" class="form-control">

                      <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                      <input type="text" class="form-control txtEnvasadora" readonly>

                      <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                      <input type="text" class="form-control txtLoteadora" readonly>



                    </div>
                    <hr>

                    <div class="col-md-12 col-2 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">
                      <label for="recipient-name" class="col-form-label">Mínimo:</label>
                      <input type="text" class="form-control centrado" id="Minimo" readonly>

                      <label for="recipient-name" class="col-form-label">Medio:</label>
                      <input type="text" class="form-control centrado" id="Medio" readonly>

                      <label for="recipient-name" class="col-form-label">Máximo:</label>
                      <input type="text" class="form-control centrado" id="Maximo" readonly>
                    </div>
                    <!-- </div> -->
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Muestras" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Promedio">
                      </div>
                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 col-2 align-self-center">
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
                                    <td id="tapa1"></td>
                                    <td id="descripcion_tapa1"></td>
                                    <td id="unidades4"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 1);"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="envase1"></td>
                                    <td id="descripcion_envase1"></td>
                                    <td id="unidades5"></td>
                                    <td id="txtEnvasada2" class="centrado"></td>
                                    <td><input type="number" id="averias2" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante2" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 2);"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="otro1"></td>
                                    <td id="descripcion_otro1"></td>
                                    <td id="unidades6"></td>
                                    <td id="txtEnvasada3" class="centrado"></td>
                                    <td><input type="number" id="averias3" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante3" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 3);"></td>
                                    <td id="totalDevolucion3" class="centrado"></td> <!-- <input type="number" id="totalDevolucion3" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="firmas_envasado">

                      <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                      <input type="text" class="form-control" id="devolucion_realizado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_realizado">Firmar</button>

                      <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                      <input type="text" class="form-control" id="devolucion_verificado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_verificado">Firmar</button>

                      <button type="button" class="btn btn-secondary btn-cancelar" style="width: 100px; justify-self:end;">Cancelar</button>
                      <button type="button" class="btn btn-primary btn-aceptar" style="width: 100px; ">Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado4">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti4">ENVASADO</b>
                </button>
              </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 col-2 align-self-center">
                    <div class="card">
                      <div class="card-block">

                        <div class="table-responsive">

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <!-- <th>Fecha</th> -->
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="tapa"></td>
                                <td id="descripcion_tapa"></td>
                                <td id="unidades1"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="envase"></td>
                                <td id="descripcion_envase"></td>
                                <td id="unidades2"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="otro"></td>
                                <td id="descripcion_otro"></td>
                                <td id="unidades3"></td>
                                <!-- <td></td> -->
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">
                      <label for="recipient-name" class="col-form-label">Linea</label>
                      <select class="selectpicker form-control" id="select-Linea">
                        <option selected hidden>Seleccionar Linea</option>
                        <option>LIQUIDOS</option>
                        <option>SOLIDOS</option>
                        <option>SEMISOLIDOS</option>
                      </select>

                      <label for="recipient-name" class="col-form-label">Digite el lote requerido</label>
                      <input type="text" class="form-control">

                      <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                      <input type="text" class="form-control txtEnvasadora" readonly>

                      <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                      <input type="text" class="form-control txtLoteadora" readonly>



                    </div>
                    <hr>

                    <div class="col-md-12 col-2 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">
                      <label for="recipient-name" class="col-form-label">Mínimo:</label>
                      <input type="text" class="form-control centrado" id="Minimo" readonly>

                      <label for="recipient-name" class="col-form-label">Medio:</label>
                      <input type="text" class="form-control centrado" id="Medio" readonly>

                      <label for="recipient-name" class="col-form-label">Máximo:</label>
                      <input type="text" class="form-control centrado" id="Maximo" readonly>
                    </div>
                    <!-- </div> -->
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Muestras" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Promedio">
                      </div>
                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 col-2 align-self-center">
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
                                    <td id="tapa1"></td>
                                    <td id="descripcion_tapa1"></td>
                                    <td id="unidades4"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 1);"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="envase1"></td>
                                    <td id="descripcion_envase1"></td>
                                    <td id="unidades5"></td>
                                    <td id="txtEnvasada2" class="centrado"></td>
                                    <td><input type="number" id="averias2" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante2" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 2);"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="otro1"></td>
                                    <td id="descripcion_otro1"></td>
                                    <td id="unidades6"></td>
                                    <td id="txtEnvasada3" class="centrado"></td>
                                    <td><input type="number" id="averias3" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante3" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 3);"></td>
                                    <td id="totalDevolucion3" class="centrado"></td> <!-- <input type="number" id="totalDevolucion3" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="firmas_envasado">

                      <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                      <input type="text" class="form-control" id="devolucion_realizado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_realizado">Firmar</button>

                      <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                      <input type="text" class="form-control" id="devolucion_verificado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_verificado">Firmar</button>

                      <button type="button" class="btn btn-secondary btn-cancelar" style="width: 100px; justify-self:end;">Cancelar</button>
                      <button type="button" class="btn btn-primary btn-aceptar" style="width: 100px; ">Aceptar</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="envasado5">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  <b id="envasadoMulti5">ENVASADO</b>
                </button>
              </h5>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Entrega Material Envase</h3>
                  </div>

                  <div class="col-md-12 col-2 align-self-center">
                    <div class="card">
                      <div class="card-block">

                        <div class="table-responsive">

                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <!-- <th>Fecha</th> -->
                                <th>Referencia</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td id="tapa"></td>
                                <td id="descripcion_tapa"></td>
                                <td id="unidades1"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="envase"></td>
                                <td id="descripcion_envase"></td>
                                <td id="unidades2"></td>
                                <!-- <td> <input type="text" class="form-control" id="cantidad-name"></td> -->
                              </tr>
                              <tr>
                                <td id="otro"></td>
                                <td id="descripcion_otro"></td>
                                <td id="unidades3"></td>
                                <!-- <td></td> -->
                              </tr>
                          </table>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="id_envasadora_loteadora">
                      <label for="recipient-name" class="col-form-label">Linea</label>
                      <select class="selectpicker form-control" id="select-Linea">
                        <option selected hidden>Seleccionar Linea</option>
                        <option>LIQUIDOS</option>
                        <option>SOLIDOS</option>
                        <option>SEMISOLIDOS</option>
                      </select>

                      <label for="recipient-name" class="col-form-label">Digite el lote requerido</label>
                      <input type="text" class="form-control">

                      <label for="recipient-name" class="col-form-label envasadora">Identificación Envasadora</label>
                      <input type="text" class="form-control txtEnvasadora" readonly>

                      <label for="recipient-name" class="col-form-label loteadora">Identificación Loteadora</label>
                      <input type="text" class="form-control txtLoteadora" readonly>



                    </div>
                    <hr>

                    <div class="col-md-12 col-2 align-self-center">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Especificaciones Técnicas</h3>
                    </div>
                    <div class="especificaciones_tecnicas">
                      <label for="recipient-name" class="col-form-label">Mínimo:</label>
                      <input type="text" class="form-control centrado" id="Minimo" readonly>

                      <label for="recipient-name" class="col-form-label">Medio:</label>
                      <input type="text" class="form-control centrado" id="Medio" readonly>

                      <label for="recipient-name" class="col-form-label">Máximo:</label>
                      <input type="text" class="form-control centrado" id="Maximo" readonly>
                    </div>
                    <!-- </div> -->
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de Peso en Proceso</h3>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">No. Muestras</label>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Muestras" style="text-align: center;" readonly>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;" onclick="muestrasEnvase();" data-toggle="modal" data-target="#m_muestras">Iniciar</button>
                      </div>
                      <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                        <label for="recipient-name" class="col-form-label">Promedio</label>
                      </div>
                      <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                        <input type="text" class="form-control" id="Promedio">
                      </div>
                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_realizado" class="col-form-label">Realizado Por</label>
                        <input type="text" class="form-control" id="controlpeso_realizado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                      <div class="col-md-4 col-2 align-self-center">
                        <label for="controlpeso_verificado" class="col-form-label">Verificado Por</label>
                        <input type="text" class="form-control" id="controlpeso_verificado" readonly>
                      </div>
                      <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                        <button type="button" class="btn waves-effect waves-light btn-danger" id="controlpeso_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;">Firmar</button>
                      </div>

                    </div>
                    <div class="row" style="margin: 1%">
                      <div class="col-md-12 col-2 align-self-center">
                        <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Envase Sobrante</h3>
                      </div>

                      <div class="col-md-12 col-2 align-self-center">
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
                                    <td id="tapa1"></td>
                                    <td id="descripcion_tapa1"></td>
                                    <td id="unidades4"></td>
                                    <td><input type="number" id="txtEnvasada1" min="1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialEnvasada(this.value);"></td>
                                    <td><input type="number" id="averias1" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante1" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 1);"></td>
                                    <td id="totalDevolucion1" class="centrado"></td><!-- <input type="number" id="totalDevolucion1" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="envase1"></td>
                                    <td id="descripcion_envase1"></td>
                                    <td id="unidades5"></td>
                                    <td id="txtEnvasada2" class="centrado"></td>
                                    <td><input type="number" id="averias2" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante2" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 2);"></td>
                                    <td id="totalDevolucion2" class="centrado"></td><!-- <input type="number" id="totalDevolucion2" class="form-control centrado" readonly> -->
                                  </tr>
                                  <tr>
                                    <td id="otro1"></td>
                                    <td id="descripcion_otro1"></td>
                                    <td id="unidades6"></td>
                                    <td id="txtEnvasada3" class="centrado"></td>
                                    <td><input type="number" id="averias3" class="form-control centrado" style="width: 110px;"></td>
                                    <td><input type="number" id="sobrante3" class="form-control centrado" style="width: 110px;" onkeyup="devolucionMaterialTotal(this.value, 3);"></td>
                                    <td id="totalDevolucion3" class="centrado"></td> <!-- <input type="number" id="totalDevolucion3" class="form-control centrado" readonly> -->
                                  </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="firmas_envasado">

                      <label for="devolucion_realizado" class="col-form-label">Realizado Por:</label>
                      <input type="text" class="form-control" id="devolucion_realizado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_realizado">Firmar</button>

                      <label for="devolucion_verificado" class="col-form-label">Verificado Por:</label>
                      <input type="text" class="form-control" id="devolucion_verificado" readonly>

                      <button type="button" class="btn waves-effect waves-light btn-danger" id="devolucion_verificado">Firmar</button>

                      <button type="button" class="btn btn-secondary btn-cancelar" style="width: 100px; justify-self:end;">Cancelar</button>
                      <button type="button" class="btn btn-primary btn-aceptar" style="width: 100px; ">Aceptar</button>

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
          <script src="../../html/js/pesaje/pesajeinfo.js"></script>
          <script src="../../html/js/firmar/firmar.js"></script>
          <script src="../../html/js/envasado/envasadoinfo.js"></script>

          <!--Alertify-->
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>