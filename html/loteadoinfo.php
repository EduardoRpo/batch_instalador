<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Samara Cosmetics">

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

  <!-- script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->

  <!-- Hoja de estilos Toastr -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

</head>

<body class="fix-header fix-sidebar card-no-border">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
  </div>
  <div id="main-wrapper">
  
    <!-- HEADER -->
    <?php include('partials/header.php'); ?>
   <!-- FIN HEADER -->

    <div class="container-fluid">
      <div class="row page-titles">
        <div class="col-md-5 col-2 align-self-center">
          <h1 class="text-themecolor m-b-0 m-t-0">Loteado</h1>
        </div>
        <div class="col-md-3 col-4 align-self-center">
        </div>
        <div class="col-md-2 col-8 align-self-center">
        </div>


        <div class="col-md-2 col-2 align-self-center">
          <div class="container">
            <select class="selectpicker form-control">
              <option selected hidden>Acciones</option>
              <option>Mustard</option>
              <option>Ketchup</option>
              <option>Relish</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- column -->
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
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 col-2 align-self-right">
                      <label for="recipient-name" class="col-form-label">No. Lote</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="col-md-4 col-2 align-self-center">
                      <label for="recipient-name" class="col-form-label">Fecha</label>
                      <input type="date" class="form-control" id="recipient2-name">
                    </div>
                    <div class="col-md-4 col-2 align-self-center">
                      <label for="recipient-name" class="col-form-label">No OP</label>
                      <input type="text" class="form-control" id="recipient2-name">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                    DESPEJE DE LINEAS DE PROCESO
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  <div class="row" style="margin: 1%">
                    <div class="col-md-12 col-2 align-self-right">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Parámetros de control</h3>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-10 col-2 align-self-right">
                      <a for="recipient-name" class="col-form-label">Se encuentras las areas de materias primas, materiales, insumos y productos que no se </a>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-10 col-2 align-self-right">
                      <a for="recipient-name" class="col-form-label">Se encuentras las areas de materias primas, materiales, insumos y productos que no se </a>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-10 col-2 align-self-right">
                      <a for="recipient-name" class="col-form-label">Se encuentras las areas de materias primas, materiales, insumos y productos que no se </a>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-10 col-2 align-self-right">
                      <a for="recipient-name" class="col-form-label">Se encuentras las areas de materias primas, materiales, insumos y productos que no se </a>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                    <div class="col-md-1 col-0 align-self-center">
                      <label class="checkbox"> <input type="checkbox" />
                      </label>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-12 col-2 align-self-right">
                      <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 col-2 align-self-right">
                      <label for="recipient-name" class="col-form-label">Producto de desinfección</label>
                      <select class="selectpicker form-control">
                        <option selected hidden></option>
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                      </select>
                    </div>
                    <div class="col-md-8 col-2 align-self-center">
                      <label for="recipient-name" class="col-form-label">Observaciones</label>
                      <input type="text" class="form-control" id="recipient2-name">
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-4 col-2 align-self-center">
                      <label for="recipient-name" class="col-form-label">Realizado Por</label>
                      <input type="text" class="form-control" id="recipient2-name">
                    </div>
                    <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;">Firmar</button>
                    </div>

                    <div class="col-md-4 col-2 align-self-center">
                      <label for="recipient-name" class="col-form-label">Verificado Por</label>
                      <input type="text" class="form-control" id="recipient2-name">
                    </div>
                    <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                      <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;">Firmar</button>
                    </div>
                  </div>
                  <div class="row" style="margin: 1%">
                    <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary">Aceptar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                  LOTEADO
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Loteado</h3>
                  </div>

                  <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                  </div>
                  <div class="col-md-3 col-2 align-self-center">
                    <select class="selectpicker form-control">
                      <option selected hidden></option>
                      <option>Mustard</option>
                      <option>Ketchup</option>
                      <option>Relish</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Loteadora Video Jet</label>
                  </div>
                  <div class="col-md-3 col-2 align-self-center">
                    <select class="selectpicker form-control">
                      <option selected hidden></option>
                      <option>Mustard</option>
                      <option>Ketchup</option>
                      <option>Relish</option>
                    </select>
                  </div>

                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                  </div>
                  <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                    <label for="recipient-name" class="col-form-label">Cantidad de muestras:</label>
                  </div>
                  <div class="col-md-3 col-2 align-self-center" style="margin-top: 1%">
                    <input type="text" class="form-control" id="Muestras">
                  </div>
                  <div class="col-md-1 col-2 align-self-center" style="margin-top: 1%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;">Iniciar</button>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 col-2 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado Por:</label>
                    <input type="text" class="form-control" id="recipient2-name">
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;">Firmar</button>
                  </div>

                  <div class="col-md-4 col-2 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado Por:</label>
                    <input type="text" class="form-control" id="recipient2-name">
                  </div>
                  <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 100%; height: 38px;">Firmar</button>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = '../html/acondicionamiento.html';">Aceptar</button>
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
<!-- <script src="../../html/js/validadores.js"></script> -->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- Toastr.js Después -->

<!--Alertify-->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>