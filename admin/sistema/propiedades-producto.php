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
      <div class="panel-header panel-header-sm"></div>
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Nombres Productos</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="adNombreProducto">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Producto</b></label>
                  <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" placeholder="Nombre Producto">
                  <button type="button" class="btn btn-primary" id="guardarNombreProducto">Guardar</button>
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
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Marcas</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="addMarca">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Marca</b></label>
                  <input type="text" name="nombreMarca" id="nombreMarca" class="form-control" placeholder="Nombre Marca">
                  <button type="button" class="btn btn-primary" id="guardarNombreMarca">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl2" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Marcas</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Colores</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="addColor">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Color</b></label>
                  <input type="text" name="nombreColor" id="nombreColor" class="form-control" placeholder="Color">
                  <button type="button" class="btn btn-primary" id="guardarColor">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl3" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Color</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Olores</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="addOlor">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Nombre Olor</b></label>
                  <input type="text" name="nombreOlor" id="nombreOlor" class="form-control" placeholder="Nombre Olor">
                  <button type="button" class="btn btn-primary" id="guardarNombreOlor">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl4" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Olor</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Densidades</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="adNombreColor">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Valores</b></label>
                  <input type="text" name="minDensidad" id="minDensidad" class="form-control" placeholder="Mínimo">
                  <input type="text" name="maxDensidad" id="maxDensidad" class="form-control" placeholder="Máximo">
                  <button type="button" class="btn btn-primary" id="guardarDensidad">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl5" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Grados de Alcohol</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="adNombreProducto">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Grado de Alcohol</b></label>
                  <input type="text" name="minGrado" id="minGrado" class="form-control" placeholder="Mínimo">
                  <input type="text" name="maxGrado" id="maxGrado" class="form-control" placeholder="Máximo">
                  <button type="button" class="btn btn-primary" id="guardarGradoA">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl6" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">PH</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="addPH">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Valores</b></label>
                  <input type="number" name="minPH" id="minPH" class="form-control" placeholder="Mínimo">
                  <input type="number" name="maxPH" id="maxPH" class="form-control" placeholder="Máximo">
                  <button type="button" class="btn btn-primary" id="guardarPH">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl7" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Viscosidades</h4>
                <!-- <a class="btn btn-primary" href="crearUsuarios1.php" role="button">Crear Usuario</a> -->
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuarios">Crear Usuarios</button> -->
                <!-- <a class="btn btn-primary" role="button" href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a> -->
                <hr>
                <button type="button" class="btn btn-primary" id="addViscosidad">Adicionar</button>
                <form id="frmadParametro" style="display: none;">
                  <label for=""><b>Viscosidad</b></label>
                  <input type="number" name="minViscosidad" id="minViscosidad" class="form-control" placeholder="Mínimo">
                  <input type="number" name="maxViscosidad" id="maxViscosidad" class="form-control" placeholder="Máximo">
                  <button type="button" class="btn btn-primary" id="guardarViscosidad">Guardar</button>
                </form>
                <hr>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl8" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
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
  <script src="js/propiedades-producto.js"></script>
  <script src="js/menu.js"></script>

</body>

</html>