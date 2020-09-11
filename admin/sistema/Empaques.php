<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Propiedades</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="../sistema/css/estilos.css" rel="stylesheet" />

  <!-- Datatables -->
  <!-- <link rel="stylesheet" href="../assets/datatables/datatables.min.css">
  <link rel="stylesheet" href="./htdocs/assets/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <!-- Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

</head>

<body class="">
  <div class="wrapper ">

    <?php include('./admin_componentes/sidebar.php'); ?>

    <div class="main-panel" id="main-panel">
      <?php include('./admin_componentes/navegacion.php'); ?>
      <div class="panel-header panel-header-sm">

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Empaques</h5>
                <p class="category">Propiedades<a href=""></a></p>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-5" id="tapa" onclick="parametros(id, 1);">Tapa</button>
                <button class="btn btn-light mb-5" id="envase" onclick="parametros(id, 2)">Envase</button>
                <button class="btn btn-primary mb-5" id="etiqueta" onclick="parametros(id, 3)">Etiqueta</button>
                <button class="btn btn-light mb-5" id="otros" onclick="parametros(id, 4)">Otros Caja</button>
                <button class="btn btn-primary mb-5" id="otro_empaque" onclick="parametros(id, 5)">Otros</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="1">
              <div class="card-header">
                <h4 class="card-title">Tapas</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addTapa">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <input type="number" name="codigoTapa" id="codigoTapa" class="form-control" placeholder="Codigo">
                  <label for=""><b>Descripcion de Tapa</b></label>
                  <input type="text" name="nombreTapa" id="nombreTapa" class="form-control" placeholder="Descripcion Tapa">
                  <button type="button" class="btn btn-primary" id="guardarNombreProducto">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl1" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Tapas</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form action="" id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card" id="2">
              <div class="card-header">
                <h4 class="card-title">Envases</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addEnvase">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <input type="text" name="codigoEnvase" id="codigoEnvase" class="form-control" placeholder="Codigo">
                  <label for=""><b>Envase</b></label>
                  <input type="text" name="nombreEnvase" id="nombreEnvase" class="form-control" placeholder="Envase">
                  <button type="button" class="btn btn-primary" id="guardarNombreEnvase">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl2" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Envase</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="3">
              <div class="card-header">
                <h4 class="card-title">Etiquetas</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addEtiquetas">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <input type="text" name="codigoEtiqueta" id="codigoEtiqueta" class="form-control" placeholder="Código">
                  <label for=""><b>Etiqueta</b></label>
                  <input type="text" name="nombreEtiqueta" id="nombreEtiqueta" class="form-control" placeholder="Etiqueta">
                  <button type="button" class="btn btn-primary" id="guardarCodigo">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl3" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Etiqueta</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card" id="4">
              <div class="card-header">
                <h4 class="card-title">Otros Caja</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addCaja">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <input type="number" name="codigoCaja" id="codigoCaja" class="form-control" placeholder="Codigo">
                  <label for=""><b>Descripción</b></label>
                  <input type="text" name="nombreCaja" id="nombreCaja" class="form-control" placeholder="Decripción">
                  <button type="button" class="btn btn-primary" id="guardarCaja">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl4" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="5">
              <div class="card-header">
                <h4 class="card-title">Otros</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addOtros">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <input type="number" name="codOtros" id="codOtros" class="form-control" placeholder="Código">
                  <label for=""><b>Decripción</b></label>
                  <input type="number" name="nombreOtros" id="nombreOtros" class="form-control" placeholder="Descripción">
                  <button type="button" class="btn btn-primary" id="guardarOtros">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl5" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>


      </div>
      <?php include('./admin_componentes/footer.php'); ?>
    </div>
  </div>


  <!--   Core JS Files   -->
  <!-- <script src="../assets/js/core/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/propiedades-generales.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>