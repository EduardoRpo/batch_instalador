<?php require_once('php/sesion/sesion.php'); ?>

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
                <button class="btn btn-primary mb-5" id="tapa" onclick="parametros(id, 1);">Tapas</button>
                <button class="btn btn-light mb-5" id="envase" onclick="parametros(id, 2)">Envases</button>
                <button class="btn btn-primary mb-5" id="etiqueta" onclick="parametros(id, 3)">Etiquetas</button>
                <button class="btn btn-light mb-5" id="empaque" onclick="parametros(id, 4)">Cajas</button>
                <button class="btn btn-primary mb-5" id="otros" onclick="parametros(id, 5)">Otros</button>
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
                <button type="button" class="btn btn-primary" onclick="adicionar(1);">Adicionar</button>
                <form id="frmAdicionar1" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <label for=""><b>Descripción de Tapa</b></label>

                  <input type="text" name="txt-Id1" id="txt-Id1" class="form-control" hidden>
                  <input type="text" name="codigo1" id="codigo1" class="form-control" placeholder="Codigo" style="text-align: center;">
                  <input type="text" name="input1" id="input1" class="form-control" placeholder="Descripcion Tapa">

                  <button type="button" class="btn btn-primary btnguardar" id="tapa" onclick="guardarDatosGenerales(id, 1);">Guardar</button>
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
              <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'tapa',1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card" id="2">
              <div class="card-header">
                <h4 class="card-title">Envases</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(2);">Adicionar</button>
                <form id="frmAdicionar2" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <label for=""><b>Descripción de Envase</b></label>

                  <input type="number" name="txt-Id2" id="txt-Id2" class="form-control" hidden>
                  <input type="number" name="codigo2" id="codigo2" class="form-control" placeholder="Codigo" style="text-align: center;">
                  <input type="text" name="input2" id="input2" class="form-control" placeholder="Descripcion Envase">

                  <button type="button" class="btn btn-primary btnguardar" id="envase" onclick="guardarDatosGenerales(id, 2);">Guardar</button>
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
              <form action="" id="formDataExcel2" enctype="multipart/form-data">
                <input type="file" name="datosExcel2" id="datosExcel2" class="form-control datosExcel mb-3 ml-3" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel2" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel2.value, 'envase', 2);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="3">
              <div class="card-header">
                <h4 class="card-title">Etiquetas</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(3);">Adicionar</button>
                <form id="frmAdicionar3" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <label for=""><b>Descripción Etiqueta</b></label>

                  <input type="number" name="txt-Id3" id="txt-Id3" class="form-control" hidden>
                  <input type="number" name="codigo3" id="codigo3" class="form-control" placeholder="Codigo" style="text-align: center;">
                  <input type="text" name="input3" id="input3" class="form-control" placeholder="Descripcion Etiqueta">

                  <button type="button" class="btn btn-primary btnguardar" id="etiqueta" onclick="guardarDatosGenerales(id, 3);">Guardar</button>
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
              <form action="" id="formDataExcel3" enctype="multipart/form-data">
                <input type="file" name="datosExcel3" id="datosExcel3" class="form-control datosExcel mb-3 ml-3" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel3" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel3.value, 'etiqueta', 3);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card" id="4">
              <div class="card-header">
                <h4 class="card-title">Cajas</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(4);">Adicionar</button>
                <form id="frmAdicionar4" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <label for=""><b>Descripción</b></label>

                  <input type="number" name="txt-Id4" id="txt-Id4" class="form-control" hidden>
                  <input type="number" name="codigo4" id="codigo4" class="form-control" placeholder="Codigo" style="text-align: center;">
                  <input type="text" name="input4" id="input4" class="form-control" placeholder="Descripcion Otros">

                  <button type="button" class="btn btn-primary btnguardar" id="empaque" onclick="guardarDatosGenerales(id, 4);">Guardar</button>
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
              <form id="formDataExcel4" enctype="multipart/form-data">
                <input type="file" name="datosExcel4" id="datosExcel4" class="form-control datosExcel mb-3 ml-3" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel4" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel4.value, 'empaque', 4);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="5">
              <div class="card-header">
                <h4 class="card-title">Otros</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(5);">Adicionar</button>
                <form id="frmAdicionar5" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Código</b></label>
                  <label for=""><b>Otros Adicionales</b></label>

                  <input type="number" name="txt-Id5" id="txt-Id5" class="form-control" hidden>
                  <input type="number" name="codigo5" id="codigo5" class="form-control" placeholder="Codigo" style="text-align: center;">
                  <input type="text" name="input5" id="input5" class="form-control" placeholder="Descripcion Otros">

                  <button type="button" class="btn btn-primary btnguardar" id="otros" onclick="guardarDatosGenerales(id, 5);">Guardar</button>
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
              <form action="" id="formDataExcel5" enctype="multipart/form-data">
              <input type="file" name="datosExcel5" id="datosExcel5" class="form-control datosExcel mb-3 ml-3" style="width: 500px; display:inline-flex">
              <button type="button" id="btnCargarExcel5" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel5.value, 'otros', 5);" disabled="disabled">Cargar Datos</button>
            </form>
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
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
  <!-- <script src="../assets/demo/demo.js"></script> -->

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/empaques.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/ImportarProductos.js"></script>

</body>

</html>