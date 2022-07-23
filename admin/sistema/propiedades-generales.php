<?php require_once('php/sesion/sesion.php'); ?>

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
                <button class="btn btn-primary mb-5 controller" id="nombre_producto">Nombres Productos</button>
                <button class="btn btn-light tblLoad mb-5 controller" id="notificacion_sanitaria">Notificacion Sanitaria</button>
                <button class="btn btn-primary mb-5 controller" id="linea">Linea</button>
                <button class="btn btn-light mb-5 controller" id="marca">Marca</button>
                <button class="btn btn-primary mb-5 controller" id="propietario">Propietario</button>
                <button class="btn btn-light mb-5 controller" id="presentacion_comercial">Presentaciones</button>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card cardGenerales" id="card_nombre_producto">
              <div class="card-header">
                <h4 class="card-title">Nombres Productos</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="adicionarNombre">Adicionar</button>
                <form id="frmAdicionar1" class="frmAdicionar1" style="display: none;">
                  <label for=""><b>Nombre Producto</b></label>
                  <input type="text" name="txt-Id1" id="txt-Id1" class="form-control" readonly hidden ${id}>
                  <input type="text" name="input1" id="input1" class="form-control" placeholder="Nombre Producto" style="width: 350px;">
                  <button type="button" class="btn btn-primary" id="btnnombreProducto">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblnombreProductos" class="table-striped row-borde" style="width:100%">
                  </table>
                </div>
              </div>
              <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'nombre_producto', 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card cardGenerales" id="card_notificacion_sanitaria">
              <div class="card-header">
                <h4 class="card-title">Notificaciones Sanitarias</h4>
                <hr>
                <button type="button" class="btn btn-primary adicionarNotificacion" id="adicionarNotificacion">Adicionar</button>
                <form id="frmAdicionar2" class="frmAdicionar2" style="display: none;">
                  <label for=""><b>Notificacion Sanitaria</b></label>
                  <input type="text" name="NotificacionInput1" id="NotificacionInput1" class="form-control" hidden>
                  <input type="text" name="NotificacionInput2" id="NotificacionInput2" class="form-control" placeholder="Notificacion Sanitaria">
                  <input type="date" name="NotificacionInput3" id="NotificacionInput3" class="form-control" placeholder="Fecha de Vencimiento">
                  <button type="button" class="btn btn-primary btnnotificacion_sanitaria" id="btnnotificacion_sanitaria">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="notificacionSanitariatbl" class="table-striped row-borde notificacionSanitariatbl" style="width:100%">
                  </table>
                </div>
              </div>
              <form id="formDataExcel2" enctype="multipart/form-data">
                <input type="file" name="datosExcel2" id="datosExcel2" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel2" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel2.value, 'notificacion_sanitaria', 2);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card cardGenerales" id="card_linea">
              <div class="card-header">
                <h4 class="card-title">Lineas</h4>
                <hr>
                <button type="button" class="btn btn-primary btnAdicionarlinea" id="btnAdicionarlinea" >Adicionar</button>
                <form id="frmAdicionarLinea" class="frmAdicionarLinea" style="display: none;">
                  <input type="text" name="lineaInput1" id="lineaInput1" class="form-control" hidden>
                  <input type="text" name="lineaInput2" id="lineaInput2" class="form-control" placeholder="Linea">
                  <input type="number" name="lineaInput3" id="lineaInput3" class="form-control" placeholder="Densidad">
                  <button type="button" class="btn btn-primary Guardarlinea" id="Guardarlinea">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblLinea" class="table-striped row-borde tblLinea" style="width:100%">
                    <thead>
                      <tr>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel3" enctype="multipart/form-data">
                <input type="file" name="datosExcel3" id="datosExcel3" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel3" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel3.value, 'linea',3);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card cardGenerales" id="card_marca">
              <div class="card-header">
                <h4 class="card-title">Marcas</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="btnAdicionarMarca">Adicionar</button>
                <form id="frmAdicionarMarcas" class="frmAdicionarMarcas" style="display: none;">
                  <label for=""><b>Marca</b></label>
                  <input type="text" name="txt-Id4" id="txt-Id4" class="form-control" hidden>
                  <input type="text" name="NombreMarca" id="NombreMarca" class="form-control" placeholder="Marca" style="width: 350px;">
                  <button type="button" class="btn btn-primary Guardarmarca" id="Guardarmarca">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblmarca" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel4" enctype="multipart/form-data">
                <input type="file" name="datosExcel4" id="datosExcel4" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel4" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel4.value, 'marca',4);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card cardGenerales" id="card_propietario">
              <div class="card-header">
                <h4 class="card-title">Propietarios</h4>

                <hr>
                <button type="button" class="btn btn-primary" id="AdicionarPropietario">Adicionar</button>
                <form id="frmAdicionarPropietario" class="frmAdicionarPropietario" style="display: none;">
                  <label for=""><b>Propietario</b></label>
                  <input type="text" name="txt-Id5" id="txt-Id5" class="form-control" hidden>
                  <input type="text" name="input5" id="input5" class="form-control" placeholder="Propietario" style="width: 400px;">
                  <button type="button" class="btn btn-primary GuardarPropietario" id="GuardarPropietario">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblPropietario" class="table-striped row-borde" style="width:100%">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel5" enctype="multipart/form-data">
                <input type="file" name="datosExcel5" id="datosExcel5" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 500px; display:inline-flex">
                <button type="button" id="btnCargarExcel5" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel5.value, 'propietario',5);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card cardGenerales" id="card_presentacion_comercial">
              <div class="card-header">
                <h4 class="card-title">Presentaciones</h4>

                <hr>
                <button type="button" class="btn btn-primary" id="btnAdicionarPresentacion">Adicionar</button>
                <form id="frmAdicionarPresentacion" class="frmAdicionarPresentacion" style="display: none;">
                  <label for=""><b>Presentación</b></label>
                  <input type="text" name="txt-Id6" id="txt-Id6" class="form-control" hidden>
                  <input type="number" name="input6" id="input6" class="form-control" placeholder="Presentacion">
                  <button type="button" class="btn btn-primary tabla6" id="GuardarPresentacion">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblPresentacion" class="table-striped row-borde" style="width:100%">
                    <thead>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel6" enctype="multipart/form-data">
                <input type="file" name="datosExcel6" id="datosExcel6" class="form-control datosExcel mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel6" class="btn btn-primary btnCargarExcel ml-3" onclick="comprobarExtension(this.form, this.form.datosExcel6.value, 'presentacion_comercial', 6);" disabled="disabled">Cargar Datos</button>
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
  <!--   -->
  <!-- <script src="/admin/sistema/js/productos/generals/propiedades-generales.js"></script> -->
  <script src="js//productos//generals///controllers.js"></script>
  <script src="js/productos/generals/nameProducts/tblname.js"></script>
  <script src="js//productos//generals//nameProducts//name.js"></script>
  <script src="js//productos//generals//healthNotification//tblhealthNotification.js"></script>
  <script src="js//productos///generals///healthNotification//healthNotification.js"></script>
  <script src="js//productos//generals//line//tblline.js"></script>
  <script src="js//productos//generals//line//line.js"></script>
  <script src="js//productos//generals//brand//tblbrand.js"></script>
  <script src="js//productos//generals//brand//brand.js"></script>
  <script src="js//productos//generals///owner//tblowner.js"></script>
  <script src="js//productos//generals//owner//owner.js"></script>
  <script src="js//productos//generals//presentation//tblpresentation.js"></script>
  <script src="js//productos//generals//presentation//presentation.js"></script>
  <script src="js//global//notifications.js"></script>

  <script src="js/menu.js"></script>
  <script src="js/importarProductos.js"></script>

</body>

</html>