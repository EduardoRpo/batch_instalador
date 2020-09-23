<?php 
  include('../../conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | Usuarios</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include('./admin_componentes/sidebar.php'); ?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <?php include('./admin_componentes/navegacion.php'); ?>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registro de Usuarios</h5>
              </div>
              <div class="card-body">
                <form id="frmagregarUsuarios" method="POST">
                <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres Completos">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos Completos">
                      </div>
                    </div>
                  </div> 
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="email">Correo Electrónico</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                      </div> 

                      <?php 
                        $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                        $result_modulo = mysqli_num_rows($query_modulo);
                      ?>

                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                        <label>Cargo</label>
                        <?php 
                          $query_cargo = mysqli_query($conn, "SELECT * FROM cargo");
                          $result_cargo = mysqli_num_rows($query_cargo);
                        ?>
                        <select class="form-control" name="cargo" id="cargo">
                        <?php 
                          if($result_cargo > 0){
                            while($cargo = mysqli_fetch_array($query_cargo)){
                        ?>            
                            <option value="<?php echo $cargo['id'] ?>"> <?php echo $cargo['cargo'] ?> </option>        
                        <?php            
                                }
                            }
                        ?>       
                        </select> 
                        </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                     <div class="form-group">
                        <label>Firma y Huella</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                          </div>
                      
                      </div>
                    
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Módulo de Acceso</label>
                        <?php 
                          $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                          $result_modulo = mysqli_num_rows($query_modulo);
                        ?>
                
                        <select class="form-control" name="modulo" id="modulo">
                        <?php 
                            if($result_modulo > 0){
                                while($modulo = mysqli_fetch_array($query_modulo)){
                        ?>            
                            <option value="<?php echo $modulo['id'] ?>"> <?php echo $modulo['modulo'] ?> </option>        
                        <?php            
                                }
                            }
                        ?>
                        </select>
  
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave de Acceso">
                      </div>
                    </div>
                  </div>

                  <button id="btnguardarUsuarios" type="submit" class="btn btn-primary">Crear Usuario</button>
                <!-- <div> <?php //echo ($alert); ?> </div> -->
                </form>
              </div>
            </div>
          </div>
        
        </div>
      </div>

      <?php include('./admin_componentes/footer.php'); ?>
                            
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="../assets/demo/demo.js"></script> -->
  <script src="js/funciones.js"></script>
</body>

</html>