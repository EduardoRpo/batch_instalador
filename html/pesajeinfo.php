<?php
include_once('modal/modal_cambiarContrasena.php');
include_once('modal/modal_observaciones.php');
include_once('modal/modal_imprimirEtiquetas.php');
include_once('modal/m_firma.php');
include_once('modal/modal_condicionesMedio.php');
//include('modal/m_plantillaEtiquetas.php')
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Samara Cosmetics">

  <title>Samara Cosmetics</title>

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">

  <!-- Bootstrap Core CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../html/css/style.css" rel="stylesheet">

  <!-- You can change the theme colors from here -->
  <link rel="stylesheet" href="../../html/css/colors/blue.css" id="theme">
  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" href="../../html/vendor/jquery-confirm/jquery-confirm.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

  <!-- Exportar Archivos -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/b-flash-1.6.2/datatables.min.css"/> -->

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
            <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
          </ul>
          <ul class="navbar-nav my-lg-0">
            <li class="nav-item dropdown">
              <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Berney Montoya
                <i class="large material-icons">account_circle</i>
                <!-- <i
              class="fas fa-chevron-circle-down"> --></i></a>
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
        <h1 hidden>2</h1>
        <h1 class="text-themecolor m-b-0 m-t-0" data-toggle="modal" data-target="#m_CondicionesMedio" data-backdrop="static" data-keyboard="false"><b>Pesaje</b></h1>
        <a href="../../pesaje" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down btn-md" role="button">Cola de Trabajo</a>
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
                  <label>Fecha Programación</label>
                  <label>No Orden</label>
                  <label>Referencia</label>

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

                  <input type="text" class="form-control" id="in_fecha" readonly>
                  <input type="text" class="form-control" id="in_numero_orden" readonly>
                  <input type="text" class="form-control" id="in_referencia" readonly>

                  <label></label>
                  <label>Tamaño Lote (Kg)</label>
                  <label>No. Lote</label>
                  <label>Línea</label>

                  <input type="text" class="form-control" id="in_tamano_lote" readonly>
                  <input type="text" class="form-control" id="in_numero_lote" readonly>
                  <input type="text" class="form-control" id="in_linea" readonly>
                </div>
                <!-- <div class="contenedorInfoObs">
                </div> -->
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
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center">Parámetros de Control</h3>
                  <h3 for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;Si</h3>
                  <h3 for="recipient-name" class="col-form-label">&nbsp;&nbsp;&nbsp;No</h3>
                </div>
                <div class="row" id="preguntas-div" style="margin: 1%">
                </div>

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
                    <label for="in_observaciones" class="col-form-label">Observaciones:</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 col-2 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por:</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_realizado" readonly>
                  </div>

                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="col-md-4 col-2 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por:</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_verificado" readonly>
                  </div>

                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
                  </div>
                </div>
                <div class="row justify-content-end mt-5" style="margin: 1%; text-align: right">
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                <b>PESAJE Y DISPENSACIÓN</b>
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <div class="row" style="margin: 1%">
                <div class="col-md-12 col-2 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">
                    Formula Maestra</h3>
                </div>
                <div class="formulaMaestra">
                  <label for="cargo-1" class="col-form-label"><b>Entrega de formula Maestra para solicitud de materia prima</b></label>
                  <label for="cargo-2" class="col-form-label"><b>Lleva Materia prima a la escusa</b></label>
                  <label for="cargo-3" class="col-form-label"><b>Verificación del estado de Identificación y Aprobación Materias primas</b></label>
                  <label for="cargo-4" class="col-form-label"><b>Toma de materia prima de la esclusa</b></label>

                  <input type="text" class="form-control text-center" id="cargo-1" readonly>
                  <input type="text" class="form-control text-center" id="cargo-2" readonly>
                  <input type="text" class="form-control text-center" id="cargo-3" readonly>
                  <input type="text" class="form-control text-center" id="cargo-4" readonly>
                </div>
              </div>

              <hr>
              <div class="card-body">
                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Pesaje</h3>
                <div class="chk-control m-3">
                  <label for="" class="lblchk-control">Control Pesaje Tanques</label>
                </div>
                <hr>
                <form>
                  <div class="table-responsive"></div>
                  <table class="table" id="tablePesaje" style="width: 100%;">
                  </table>
                </form>
              </div>
            </div>
            <hr>

            <div class="row" style="margin: 1%">
              <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#modalObservaciones" style="margin-left: 1%">
                Observaciones y/o Incidencias en el proceso
              </button>
            </div>
            <hr>

            <div class="row" style="margin: 1%">
              <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" id="imprimirEtiquetasVirtuales">Imprimir Etiquetas Virtuales
              </button>
              <iframe id="printf" name="printf" src="../../html/modal/m_plantillaEtiquetas.php" width="0" height="0" style="display:none;"></iframe>
            </div>
            <hr>
            <div class="row" style="margin: 1%">
              <div class="col-md-3 col-2 align-self-center">
                <label for="pesaje_realizado" class="col-form-label">Realizado Por:</label>
                <input type="text" class="form-control" id="pesaje_realizado" readonly>
              </div>

              <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                <input type="button" class="btn btn-danger" id="pesaje_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
              </div>

              <div class="col-md-3 col-2 align-self-center">
                <label for="pesaje_verificado" class="col-form-label">Verificado Por:</label>
                <input type="text" class="form-control" id="pesaje_verificado" readonly>
              </div>
              <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                <input type="button" class="btn btn-danger" id="pesaje_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar">
              </div>
            </div>

            <div class="row justify-content-end mt-5" style="margin: 1%;text-align: right">
              <div class="col-md-12 col-2 align-self-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_CondicionesMedio">Aceptar
                </button>
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

  <!--Alertify-->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- Imprimir PDF -->
  <script src="../../html/js/global/descargarPDF.js"></script>

  <!-- <script src="../../html/vendor/pdf/jspdf.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  <script src="../../html/js/global/descargarPDF.js"></script>

  <!-- Buttons -->

  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

  <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/b-flash-1.6.2/datatables.min.js"></script> -->


</body>

</html>