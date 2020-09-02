<?php
//include('./modal/m_crearUsuarios.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Propiedades Generales</title>
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
                <h5 class="title">Propiedades Generales</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-5" id="nombre_producto" onclick="parametros(id, 1);">Nombres Productos</button>
                <button class="btn btn-light mb-5" id="notificacion_sanitaria" onclick="parametros(id, 2)">Notificacion Sanitaria</button>
                <button class="btn btn-primary mb-5" id="linea" onclick="parametros(id, 3)">Linea</button>
                <button class="btn btn-light mb-5" id="marca" onclick="parametros(id, 4)">Marca</button>
                <button class="btn btn-primary mb-5" id="propietario" onclick="parametros(id, 5)">Propietario</button>
                <button class="btn btn-light mb-5" id="presentacion_comercial" onclick="parametros(id, 6)">Presentaciones</button>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card" id="1">
              <div class="card-header">
                <h4 class="card-title">Nombres Productos</h4>
                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(1);">Adicionar</button>
                <form id="frmAdicionar1" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Nombre Producto</b></label>
                  <input type="text" name="input1" id="input1" class="form-control" placeholder="Nombre Producto" style="width: 350px;">
                  <input type="text" name="txt1" id="txt1" class="form-control" placeholder="Nombre Producto" style="width: 350px;" hidden>
                  <button type="button" class="btn btn-primary tabla1" id="nombre_producto" onclick="guardarDatosGenerales(id, 1);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl1" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Nombre Producto</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card" id="2">
              <div class="card-header">
                <h4 class="card-title">Notificaciones Sanitarias</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(2);">Adicionar</button>
                <form id="frmAdicionar2" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Notificacion Sanitaria</b></label>
                  <input type="text" name="input2" id="input2" class="form-control" placeholder="Notificacion Sanitaria">
                  <button type="button" class="btn btn-primary tabla2" id="notificacion_sanitaria" onclick="guardarDatosGenerales(id, 2);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl2" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Notificación Sanitaria</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card" id="3">
              <div class="card-header">
                <h4 class="card-title">Lineas</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(3);">Adicionar</button>
                <form id="frmAdicionar3" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Linea</b></label>
                  <input type="text" name="input3" id="input3" class="form-control" placeholder="Linea">
                  <button type="button" class="btn btn-primary tabla3" id="linea" onclick="guardarDatosGenerales(id, 3);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl3" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Linea</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-10">
            <div class="card" id="4">
              <div class="card-header">
                <h4 class="card-title">Marcas</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(4);">Adicionar</button>
                <form id="frmAdicionar4" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Marca</b></label>
                  <input type="text" name="input4" id="input4" class="form-control" placeholder="Marca" style="width: 350px;">
                  <button type="button" class="btn btn-primary tabla4" id="marca" onclick="guardarDatosGenerales(id, 4);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl4" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Marca</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card" id="5">
              <div class="card-header">
                <h4 class="card-title">Propietarios</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(5);">Adicionar</button>
                <form id="frmAdicionar5" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Propietario</b></label>
                  <input type="text" name="input5" id="input5" class="form-control" placeholder="Propietario" style="width: 400px;">
                  <button type="button" class="btn btn-primary tabla5" id="propietario" onclick="guardarDatosGenerales(id, 5);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl5" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Propieario</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card" id="6">
              <div class="card-header">
                <h4 class="card-title">Presentaciones</h4>

                <hr>
                <button type="button" class="btn btn-primary" onclick="adicionar(6);">Adicionar</button>
                <form id="frmAdicionar6" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Presentación</b></label>
                  <input type="number" name="input6" id="input6" class="form-control" placeholder="Presentacion">
                  <button type="button" class="btn btn-primary tabla6" id="presentacion_comercial" onclick="guardarDatosGenerales(id, 6);">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl6" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Presentación</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel" enctype="multipart/form-data">
                <input type="file" name="datosExcel" id="datosExcel" class="form-control mb-3 ml-3" style="width: auto; display:inline-flex">
                <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel.value, 1);" disabled="disabled">Cargar Datos</button>
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
  <script src="js/propiedades-generales.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>