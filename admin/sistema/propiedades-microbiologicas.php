<?php require_once('php/sesion/sesion.php');?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Propiedades Microbiologicas</title>
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
                <h5 class="title">Propiedades Microbiologicas</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-5 controller" id="recuento_mesofilos" >Recuento Mesofilos</button>
                <button class="btn btn-light mb-5 controller" id="pseudomona">Pseudomona</button>
                <button class="btn btn-primary mb-5 controller" id="escherichia" >Escherichia</button>
                <button class="btn btn-light mb-5 controller" id="staphylococcus" >Staphylococcus</button>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="card cardMicro" id="card_recuento_mesofilos">
              <div class="card-header">
                <h4 class="card-title">Recuento Mesofilos</h4>
                <hr>
                <button type="button" class="btn btn-primary" id="AdicionarRecuento">Adicionar</button>
                <form id="frmAdicionar1" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Recuento Mesofilos</b></label>
                  <input type="text" name="txt-Id1" id="txt-Id1" class="form-control" hidden>
                  <input type="text" name="input1" id="input1" class="form-control" placeholder="Recuento Mesofilos" style="width: 350px;">
                  <button type="button" class="btn btn-primary tabla1" id="GuardarRecuento">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblRecuento" class="table-striped row-borde" style="width:100%">
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'recuento_mesofilos', 1);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card cardMicro" id="card_pseudomona">
              <div class="card-header">
                <h4 class="card-title">Pseudomona</h4>

                <hr>
                <button type="button" class="btn btn-primary" id="AdicionarPseudomona">Adicionar</button>
                <form id="frmAdicionar2" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Pseudomona</b></label>
                  <input type="text" name="txt-Id2" id="txt-Id2" class="form-control" hidden>
                  <input type="text" name="input2" id="input2" class="form-control" placeholder="Pseudomona">
                  <button type="button" class="btn btn-primary tabla2" id="GuardarPseudomona">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblPseudomona" class="table-striped row-borde" style="width:100%">
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel2" enctype="multipart/form-data">
                <input type="file" name="datosExcel2" id="datosExcel2" class="form-control mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel2" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel2.value, 'pseudomona', 2);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card cardMicro" id="card_escherichia">
              <div class="card-header">
                <h4 class="card-title">Escherichia</h4>

                <hr>
                <button type="button" class="btn btn-primary" id="AdicionarEscherichia">Adicionar</button>
                <form id="frmAdicionar3" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Escherichia</b></label>
                  <input type="text" name="txt-Id3" id="txt-Id3" class="form-control" hidden>
                  <input type="text" name="input3" id="input3" class="form-control" placeholder="Escherichia">
                  <button type="button" class="btn btn-primary tabla3" id="GuardarEscherichia">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblEscherichia" class="table-striped row-borde" style="width:100%">
                    <thead>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel3" enctype="multipart/form-data">
                <input type="file" name="datosExcel3" id="datosExcel3" class="form-control mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel3" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel3.value, 'escherichia', 3);" disabled="disabled">Cargar Datos</button>
              </form>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card cardMicro" id="card_staphylococcus">
              <div class="card-header">
                <h4 class="card-title">Staphylococcus</h4>

                <hr>
                <button type="button" class="btn btn-primary" id="AdicionarStaphylococcus">Adicionar</button>
                <form id="frmAdicionar7" class="frmAdicionar" style="display: none;">
                  <label for=""><b>Staphylococcus</b></label>
                  <input type="text" name="txt-Id7" id="txt-Id7" class="form-control" hidden>
                  <input type="text" name="input7" id="input7" class="form-control" placeholder="Staphylococcus" style="width: 350px;">
                  <button type="button" class="btn btn-primary tabla4" id="GuardarStaphylococcus">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblStaphylococcus" class="table-striped row-borde" style="width:100%">
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <form id="formDataExcel7" enctype="multipart/form-data">
                <input type="file" name="datosExcel7" id="datosExcel7" class="form-control mb-3 ml-3 datosExcel" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel7" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel7.value, 'staphylococcus', 7);" disabled="disabled">Cargar Datos</button>
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
  <script src="js//global//notifications.js"></script>
  <script src="js//productos//microbiologicalProperties//controller.js"></script>
  <!-- <script src="js//productos//generals//propiedades-generales.js"></script> -->
  <script src="js//productos//microbiologicalProperties//recount//tblrecount.js"></script>
  <script src="js//productos//microbiologicalProperties//recount//recount.js"></script>
  <script src="js//productos//microbiologicalProperties//Pseudomona//tblpseudomona.js"></script>
  <script src="js//productos//microbiologicalProperties//Pseudomona//pseudomona.js"></script>
  <script src="js//productos//microbiologicalProperties//Escherichia//tblEscherichia.js"></script>
  <script src="js//productos//microbiologicalProperties//Escherichia//Escherichia.js"></script>
  <script src="js//productos//microbiologicalProperties//Staphylococcus//tblstaphylococcus.js"></script>
  <script src="js//productos//microbiologicalProperties//Staphylococcus//staphylococcus.js"></script>
  <script src="js/selectlinkPM.js"></script>
  <script src="js/importarProductos.js"></script>

</body>

</html>