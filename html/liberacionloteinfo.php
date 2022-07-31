<?php
session_start();
$_SESSION["timeout"] = time();
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

  <title>Liberación Lote | Samara Cosmetics</title>

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
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Liberación Lote</b></h1>
        <a href="../../liberacionlote" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
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
                          <th class="centrado">Multipresentación</th>
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
                  LIBERACIÓN LOTE
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="m-5">
                  <label for="">Revisión general de la información registrada en el Batch Record corroborando que el producto se encuentra en optimas condiciones para ser liberado y autorizada su comercialización.
                    ¿El producto está apto para liberar?</label>
                </div>
                <div class="m-5 obj2">
                  <label for="liberacion" style="justify-self: end;">No</label>
                  <label for="liberacion">Si</label>
                  <input type="radio" id="radioLiberacionNo" name="liberacion" value="0" style="justify-self: end;">
                  <input type="radio" id="radioLiberacionSi" name="liberacion" value="1" style="justify-self:start;">
                </div>
                <div class=" m-5">
                  <label for="">Observaciones</label>
                  <input type="text" id="observacioneslote" class="form-control" />
                </div>

                <div class="firmasLiberacion" style="display: flex;">
                  <div class="align-self-end">
                    <label for="produccion_realizado" class="col-form-label">Dirección Producción</label>
                    <input type="text" class="form-control" id="produccion_realizado" readonly>
                  </div>

                  <div class="align-self-end">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger produccion_realizado" id="produccion_realizado" onclick="cargar(this, 'firma1')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="align-self-end">
                    <label for="calidad_verificado" class="col-form-label">Dirección Calidad</label>
                    <input type="text" class="form-control" id="calidad_verificado" readonly>
                  </div>
                  <div class="align-self-end">
                    <input type="button" class="btn btn-danger calidad_verificado" id="calidad_verificado" onclick="cargar(this, 'firma2')" style="width: 100%; height: 38px;" value="Firmar">
                  </div>

                  <div class="align-self-end">
                    <label for="tecnica_realizado" class="col-form-label">Dirección Técnica</label>
                    <input type="text" class="form-control" id="tecnica_realizado" readonly>
                  </div>

                  <div class="align-self-end">
                    <input type="text" id="idbtn" hidden>
                    <input type="button" class="btn btn-danger tecnica_realizado" id="tecnica_realizado" onclick="cargar(this, 'firma3')" style="width: 100%; height: 38px;" value="Firmar">
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
  <script src="../../assets/plugins/jquery/jquery.number.min.js"></script>

  <script src="/html/js/global/loadinfo-global.js"></script>
  <script src="/html/js/global/tanques.js"></script>
  <script src="/html/js/global/validacionesAuth.js"></script>
  <script src="/html/js/global/auth.js"></script>
  <script src="/html/js/global/controller.js"></script>
  
  <script src="/html/js/firmar/firmar1raSeccion.js"></script>
  
  <script src="/html/js/liberacionlote/liberacionloteinfo.js"></script>
  



</body>

</html>