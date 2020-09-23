<?php 
    include('../../conexion.php');

    if(!empty($_POST)){
        $alert='';

        if(empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['email']) or empty($_POST['clave']) or      
            empty($_POST['modulo']) or empty($_POST['cargo'])){ 
               echo $alert = 'Todos los campos deben ser diligenciados.';
                //echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("Todos los campos deben ser diligenciados.");</script>';
                
        }else{
            
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $clave = md5($_POST['clave']);
            $modulo = $_POST['modulo'];
            $cargo = $_POST['cargo'];

            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE email ='$email'");    
            $result = mysqli_fetch_array($query);
            
            if($result > 0){
               $alert ='El usuario ya existe';     
            }else{
                $query_insert = mysqli_query($conn,"INSERT INTO usuario (nombre, apellido, email, clave, id_modulo, id_cargo)
                                                    VALUES('$nombre', '$apellido', '$email', '$clave', '$modulo', '$cargo')");

                if($query_insert){
                    $alert ='Usuario creado';
                    }else{
                        $alert ='Usuario no creado';
                    }

                }
        }
    }   

?>

<?php 
  if(empty($_GET['id'])){
    header('Location: usuarios.php');
  }

  $idUser = $_GET['id'];

  $sql = mysqli_query($conn, "SELECT u.id, u.nombre, u.apellido, u.email, (c.id) as id_cargo, c.cargo, (m.id) as id_modulo, m.modulo 
                              FROM usuario u 
                              INNER JOIN cargo c 
                              INNER JOIN modulo m 
                              ON u.id_cargo = c.id AND u.id_modulo = m.id
                              WHERE u.id = $idUser");

  $resultado_sql = mysqli_num_rows($sql);

  if($$resultado_sql = 0){
    header('Location: listaUsuarios.php');
  }else{
    while($data = mysqli_fetch_array($sql)){
      $idUsuario = $data['id'];
      $nombre = $data['nombre'];
      $apellido = $data['apellido'];
      $email = $data['email'];
      $id_cargo = $data['id_cargo'];
      $cargo = $data['cargo'];
      $id_modulo = $data['id_modulo'];
      $modulo = $data['modulo'];

    }
  }

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
                <h5 class="title">Actualizar Usuarios</h5>
              </div>
              <div class="card-body">
                <form method="POST">
                <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres Completos" value="<?php echo $nombre; ?>"> 
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos Completos" value="<?php echo $apellido; ?>">
                      </div>
                    </div>
                  </div>  
                    <div class="row">
                    <!-- <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Empresa</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="Samara Cosmetics">
                      </div>
                    </div> -->
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                      </div>
                    </div>
                  </div>
                  

                  <?php 
                    $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                    $result_modulo = mysqli_num_rows($query_modulo);
                  ?>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Cargo</label>
                        <?php 
                          $query_cargo = mysqli_query($conn, "SELECT * FROM cargo");
                          $result_cargo = mysqli_num_rows($query_cargo);
                        ?>
                        <select class="form-control" name="cargo" id="cargo">
                        <?php 
                          echo $cargo;
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
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Firma y Huella</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
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
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave de Acceso">
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" href="actualizarUsuarios.php" role="button">Actualizar Usuario</a>
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
  <script src="../assets/demo/demo.js"></script>
</body>

</html>