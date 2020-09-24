<?php require_once('php/sesion/sesion.php');?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Propiedades Fisico Quimicas</title>
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
                <h5 class="title">Propiedades FisicoQuimicas</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-5" id="apariencia" onclick="parametros(id, 1);">Apariencia</button>
                <button class="btn btn-light mb-5" id="color" onclick="parametros(id, 2)">Color</button>
                <button class="btn btn-primary mb-5" id="olor" onclick="parametros(id, 3)">Olor</button>
                <button class="btn btn-light mb-5" id="densidad_gravedad" onclick="parametros(id, 4)">Densidad</button>
                <button class="btn btn-primary mb-5" id="grado_alcohol" onclick="parametros(id, 5)">Grado de Alcohol</button>
                <button class="btn btn-light mb-5" id="ph" onclick="parametros(id, 6)">PH</button>
                <button class="btn btn-primary mb-5" id="untuosidad" onclick="parametros(id, 7)">Untuosidad</button>
                <button class="btn btn-light mb-5" id="viscosidad" onclick="parametros(id, 8)">Viscosidad</button>
                <button class="btn btn-primary mb-5" id="poder_espumoso" onclick="parametros(id, 9)">Poder Espumoso</button>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card" id="1">
              <div class="card-header">
                <h4 class="card-title">Apariencia</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(1);">Adicionar</button>
                <form id="frmAdicionar1" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Apariencia</b></label>
                  <input type="text" name="txt-Id1" id="txt-Id1" class="form-control" hidden>
                  <input type="text" name="input1" id="input1" class="form-control" placeholder="Apariencia" style="width: 700px;">
                  <button type="button" class="btn btn-primary tabla1" id="apariencia" onclick="guardarDatosGenerales(id, 1);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl1" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Apariencia</th>
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
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'apariencia',1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-10">
            <div class="card" id="2">
              <div class="card-header">
                <h4 class="card-title">Color</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(2);">Adicionar</button>
                <form id="frmAdicionar2" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Color</b></label>
                  <input type="text" name="txt-Id2" id="txt-Id2" class="form-control" hidden>
                  <input type="text" name="input2" id="input2" class="form-control" placeholder="Color" style="width: 550px;">
                  <button type="button" class="btn btn-primary tabla2" id="color" onclick="guardarDatosGenerales(id, 2);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl2" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Color</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel2" enctype="multipart/form-data">
                <input type="file" name="datosExcel2" id="datosExcel2" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel2" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel2.value, 'color', 2);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10">
            <div class="card" id="3">
              <div class="card-header">
                <h4 class="card-title">Olor</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(3);">Adicionar</button>
                <form id="frmAdicionar3" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Olor</b></label>
                  <input type="text" name="txt-Id3" id="txt-Id3" class="form-control" hidden>
                  <input type="text" name="input3" id="input3" class="form-control" placeholder="Olor" style="width:550px;">
                  <button type="button" class="btn btn-primary tabla3" id="olor" onclick="guardarDatosGenerales(id, 3);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl3" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Olor</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel3" enctype="multipart/form-data">
                <input type="file" name="datosExcel3" id="datosExcel3" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel3" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel3.value, 'olor', 3);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-10">
            <div class="card" id="4">
              <div class="card-header">
                <h4 class="card-title">Densidad</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(4);">Adicionar</button>
                <form id="frmAdicionar4" class="frmAdicionarMinMax" style="display: none;">
                  <label for=""><b>Densidad</b></label>
                  <input type="text" name="txt-Id4" id="txt-Id4" class="form-control" hidden>
                  <input type="number" name="min4" id="min4" class="form-control centrado" placeholder="Mínimo">
                  <input type="number" name="max4" id="max4" class="form-control centrado" placeholder="Máximo">
                  <button type="button" class="btn btn-primary tabla4" id="densidad_gravedad" onclick="guardarDatosGeneralesMinMax(id, 4);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl4" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Densidad</th>
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
                <input type="file" name="datosExcel4" id="datosExcel4" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel4" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel4.value, 'densidad_gravedad', 4);" disabled="disabled">Cargar Datos</button>
              </form>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card" id="5">
              <div class="card-header">
                <h4 class="card-title">Grado de Alcohol</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(5);">Adicionar</button>
                <form id="frmAdicionar5" class="frmAdicionarMinMax" style="display: none;">
                  <label for=""><b>Grado de Alcohol</b></label>
                  <input type="text" name="txt-Id5" id="txt-Id5" class="form-control" hidden>
                  <input type="number" name="min5" id="min" class="form-control centrado" placeholder="Mínimo">
                  <input type="number" name="max5" id="max" class="form-control centrado" placeholder="Máximo">
                  <button type="button" class="btn btn-primary tabla5" id="grado_alcohol" onclick="guardarDatosGeneralesMinMax(id, 5);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl5" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Grado de Alcohol</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel5" enctype="multipart/form-data">
                <input type="file" name="datosExcel5" id="datosExcel5" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel5" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel5.value, 'grado_alcohol', 5);" disabled="disabled">Cargar Datos</button>
              </form>

            </div>
          </div>
          <div class="col-md-6">
            <div class="card" id="6">
              <div class="card-header">
                <h4 class="card-title">PH</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(6);">Adicionar</button>
                <form id="frmAdicionar6" class="frmAdicionarMinMax" style="display: none;">
                  <label for=""><b>PH</b></label>
                  <input type="text" name="txt-Id6" id="txt-Id6" class="form-control" hidden>
                  <input type="number" name="min6" id="min6" class="form-control centrado" placeholder="Mínimo">
                  <input type="number" name="max6" id="max6" class="form-control centrado" placeholder="Máximo">
                  <button type="button" class="btn btn-primary tabla6" id="PH" onclick="guardarDatosGeneralesMinMax(id, 6);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl6" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>PH</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel6" enctype="multipart/form-data">
                <input type="file" name="datosExcel6" id="datosExcel6" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel6" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel6.value, 'ph', 6);" disabled="disabled">Cargar Datos</button>
              </form>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card" id="7">
              <div class="card-header">
                <h4 class="card-title">Untuosidad</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(7);">Adicionar</button>
                <form id="frmAdicionar7" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Untuosidad</b></label>
                  <input type="text" name="txt-Id7" id="txt-Id7" class="form-control" hidden>
                  <input type="text" name="input7" id="input7" class="form-control" placeholder="Untuosidad" style="width: 400px;">
                  <button type="button" class="btn btn-primary tabla7" id="untuosidad" onclick="guardarDatosGenerales(id, 7);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl7" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Untuosidad</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel7" enctype="multipart/form-data">
                <input type="file" name="datosExcel7" id="datosExcel7" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel7" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel7.value, 'color', 7);" disabled="disabled">Cargar Datos</button>
              </form>

            </div>
          </div>
          <div class="col-md-6">
            <div class="card" id="8">
              <div class="card-header">
                <h4 class="card-title">Viscosidad</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(8);">Adicionar</button>
                <form id="frmAdicionar8" class="frmAdicionarMinMax" style="display: none;">
                  <label for=""><b>Viscosidad</b></label>
                  <input type="text" name="txt-Id8" id="txt-Id8" class="form-control" hidden>
                  <input type="number" name="min8" id="min8" class="form-control centrado" placeholder="Mínimo">
                  <input type="number" name="max8" id="max8" class="form-control centrado" placeholder="Máximo">
                  <button type="button" class="btn btn-primary tabla8" id="viscosidad" onclick="guardarDatosGeneralesMinMax(id, 8);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl8" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Viscosidad</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel8" enctype="multipart/form-data">
                <input type="file" name="datosExcel8" id="datosExce83" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel8" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel8.value, 'color', 8);" disabled="disabled">Cargar Datos</button>
              </form>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card" id="9">
              <div class="card-header">
                <h4 class="card-title">Poder Espumoso</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(9);">Adicionar</button>
                <form id="frmAdicionar9" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Poder Espumoso</b></label>
                  <input type="text" name="txt-Id9" id="txt-Id9" class="form-control" hidden>
                  <input type="text" name="input9" id="input9" class="form-control" placeholder="Poder Espumoso" style="width: 250px;">
                  <button type="button" class="btn btn-primary tabla9" id="poder_espumoso" onclick="guardarDatosGenerales(id, 9);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl9" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Poder Espumoso</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel9" enctype="multipart/form-data">
                <input type="file" name="datosExcel9" id="datosExcel9" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel9" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel9.value, 'color', 9);" disabled="disabled">Cargar Datos</button>
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
  <script src="js/menu.js"></script>
  <script src="js/propiedades-generales.js"></script>
  <script src="js/selectlink.js"></script>
  <script src="js/importarProductos.js"></script>

</body>

</html>