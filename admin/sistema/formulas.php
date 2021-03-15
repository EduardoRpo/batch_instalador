<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | formulas</title>
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
                <h5 class="title">Formulas</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <div class="selproductos">
                  <select name="cmbReferenciaProductos" id="cmbReferenciaProductos" class="form-control" style="width: 200px;"></select>
                  <input type="text" class="form-control ml-3" id="txtnombreProducto">
                </div>
                <hr>
                <button type="button" class="btn btn-primary" id="adicionarFormula">Adicionar</button>
                <form id="frmadFormulas" style="display: none;">
                  <label for=""><b>Referencia</b></label>
                  <label for="">Materia Prima</label>
                  <label for="">Alias</label>
                  <label for="">%</label>
                  <input type="text" id="textReferencia" class="form-control">
                  <select name="" id="cmbreferencia" class="form-control"></select>
                  <input type="text" name="txtMateria-Prima" id="txtMateria-Prima" class="form-control" placeholder="Materia Prima">
                  <input type="text" name="alias" id="alias" class="form-control" placeholder="alias">
                  <input type="number" name="porcentaje" id="porcentaje" class="form-control" placeholder="%" style="text-align: center;">

                  <div class="formula">
                    <label for="" class="mr-3"> <b>Insertar en: </b> </label>
                    <input type="radio" id="formula" name="formula" value="6">
                    <label for="formula" class="mr-3">Formula</label>
                    <input type="radio" id="fantasma" name="formula" value="7">
                    <label for="fantasma" class="mr-3">Formula Fantasma</label>
                    <input type="radio" id="ambos" name="formula" value="8">
                    <label for="ambos">Ambos</label>
                  </div>
                  <button type="button" class="btn btn-primary" id="guardarFormula" onclick="guardarFormulaMateriaPrima();">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="1">
              <!-- <div class="card-header">
                <h4 class="card-title">Formulas</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addFormula">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Producto</b></label>
                  <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" placeholder="Nombre Producto">
                  <button type="button" class="btn btn-primary" id="guardarFormula">Guardar</button>
                </form>
                <hr>
              </div> -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblFormulas" class="table-striped row-borde" style="width:100%">
                    <label for="">Formulas</label>
                    <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      La Formula<strong> no cumple </strong>con el 100%. Valide nuevamente.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> -->
                    <thead>
                      <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                        <th>Alias</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'formula',1);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card" id="1">
              <!-- <div class="card-header">
                <h4 class="card-title">Formulas</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="addFormula">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Producto</b></label>
                  <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" placeholder="Nombre Producto">
                  <button type="button" class="btn btn-primary" id="guardarFormula">Guardar</button>
                </form>
                <hr>
              </div> -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_formulas_f" class="table-striped row-borde" style="width:100%">
                    <label for="">Tabla Fantasma</label>
                    <thead>
                      <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                        <th>Alias</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel2" enctype="multipart/form-data">
                <input type="file" name="datosExcel2" id="datosExcel2" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel2" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel2.value, 'formula_f',2);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
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
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->

  <!-- Alertify -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- javascript inicializacion datatables -->
  <script src="js/formulas.js"></script>
  <script src="js/importarProductos.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>