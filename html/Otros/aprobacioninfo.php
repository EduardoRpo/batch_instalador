<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Samara Cosmetics</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css">
      <link rel="stylesheet" type="text/css" href="vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
     
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 <?php 
    require('../conexion.php'); 
    $idbatch = $_POST['idbatch'];
    $referencia = $_POST['referencia'];
    $sql6 = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id WHERE batch.id_batch = $idbatch");
    $sql5 = mysqli_query($conn, "SELECT * FROM preguntas ORDER BY RAND()");   
    $sql4 = mysqli_query($conn, "SELECT * FROM desinfectante");   
    $sql3 = mysqli_query($conn, "SELECT cargo FROM cargo WHERE id = 1"); 
    $sql2 = mysqli_query($conn, "SELECT * FROM formula INNER JOIN materia_prima ON formula.id_materiaprima = materia_prima.referencia WHERE formula.id_producto = $referencia");  
    $sql1 = mysqli_query($conn, "SELECT * FROM agitador");    
    $sql1 = mysqli_query($conn, "SELECT * FROM marmita");    
 ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand">
                        <!-- Logo text --><span>
                         
                         <!-- Light Logo text -->    
                         <img src="../assets/images/logo-light-text2.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Jonathan Hernandez    <i class="fas fa-chevron-circle-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuenlace">
                            <a href="#" class="dropdown-item">Cambiar contraseña</a>
                            <a href="../index.html" class="dropdown-item">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
      
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
       <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-2 align-self-center">
                        <h1 class="text-themecolor m-b-0 m-t-0">Aprobación</h1> 
                    </div>
                    <div class="col-md-3 col-4 align-self-center">
                        <!-- Search form -->
                     
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                      
                    </div>


    <div class="col-md-2 col-2 align-self-center">
    <div class="container">
  <!-- Trigger the modal with a button -->


                    </div>
                    </div>
                 </div>
                     <!-- Modal -->
     <div class="modal fade" id="myModal2" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <form method="post" onsubmit="return enviar();">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Firmar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">                              
                                <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Usuario:</label>
                                <input type="text" class="form-control" id="usuario">
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                              <label for="recipient-name" class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control" id="contrasena">
                              </div>
                              </div>                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Firmar">   
                            </form>
                          </div>
                        </div>
                        </div>
                      </div>
                             <!-- Modal -->
                             <!-- Modal -->
     <div class="modal fade" id="myModal3" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Firmar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form>
                                <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Usuario:</label>
                                <input type="text" class="form-control" id="usuario1">
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                              <label for="recipient-name" class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control" id="user4">
                              </div>
                              </div>                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="button" class="btn btn-primary" id="user-submit1" value="Firmar" data-dismiss="modal">                            
                          </div>
                        </div>
                        </div>
                      </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
 <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div id="accordion">
                          <?php 
  while ($rows=mysqli_fetch_assoc($sql6))  
                        {  
                           ?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
           <b>INFORMACIÓN DEL PRODUCTO</b>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="row" style="margin: 1%">
                              <div class="col-md-4 col-2 align-self-right" >
                                <label for="recipient-name" class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fechaprogramacion" value="<?php echo $fechaprogramacion; ?>" min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" required>
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">No Orden:</label>
                                 <input type="text" class="form-control" id="recipient2-name" value="<?php echo $rows['id_batch']; ?>" readonly>
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">No Lote:</label>
                                 <input type="text" class="form-control" id="recipient2-name" value="<?php echo $rows['numero_lote']; ?>" readonly>
                              </div>
            </div>
             <div class="row" style="margin: 1%">
                              <div class="col-md-4 col-2 align-self-right" >
                                <label for="recipient-name" class="col-form-label">Referencia:</label>
                                <input type="text" class="form-control" id="recipient-name" value="<?php echo $rows['referencia']; ?>" readonly>
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Nombre Referencia:</label>
                                 <input type="text" class="form-control" id="recipient2-name" value="<?php echo $rows['nombre_referencia']; ?>" readonly>
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Linea:</label>
                                 <input type="text" class="form-control" id="recipient2-name" value="<?php echo $rows['nombre_linea']; ?>" readonly>
                              </div>
            </div>
      </div>
    </div>
  </div>
  <?php 
          }

   ?>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"style="width: 100%">
          <b>LIBERACION CONTROL CALIDAD FISIOQUIMICO PARA ENVASADO</b>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
         <div class="row" style="margin: 1%">
                              <div class="col-md-12 col-2 align-self-right" >
                                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                              </div>
         </div>
                <div class="row" style="margin: 1%">
    
                              <div class="col-md-4 col-2 align-self-right" >
                                <label for="recipient-name" class="col-form-label">Producto de desinfección</label>
                               <select class="form-control " name="desinfectante" required >
                                        <option selected="true" disabled="disabled">Seleccione...</option>
                                        <?php
                                        while ($rows=mysqli_fetch_assoc($sql4))   {  
                                        echo "<option >".$rows['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select> 
                              </div>
                 
                              <div class="col-md-8 col-2 align-self-center">
                                <label for="recipient-name"  class="col-form-label">Observaciones:</label>
                                 <input type="text" class="form-control" name="observaciones" id="recipient2-name">
                              </div>
            </div>   
        <div class="row" style="margin: 1%">
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Realizado Por:</label>
                                 <div id="firma1" class="displayallinfo" name="nombrereferencia"></div>
                              </div>
                              <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                                 <input type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2" style="width: 100%; height: 38px;" value="Firmar">
                              </div>
                              
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Verificado Por:</label>
                                 <div id="firma-data1" class="displayallinfo" name="nombrereferencia"></div>
                              </div>
                              <div class="col-md-2 col-2 align-self-center" style="margin-top: 2.8%">
                                <input type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal3" style="width: 100%; height: 38px;" value="Firmar">
                              </div>
            </div>  
        <div class="row" style="margin: 1%">
                            <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                           <button type="submit" class="btn btn-primary">Aceptar</button>
                           </div>     
                           </form>                
            </div> 
         </div>
                  <div class="row" style="margin: 1%">
                              <div class="col-md-12 col-2 align-self-center" >
                                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                              </div>
                               <div class="col-md-12 col-2 align-self-center">
                               <div class="card">
                            <div class="card-block">
                                 <!--<h4 class="card-title">Basic Table</h4>
                                <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                                <div class="table-responsive">
                              
                               <table class="table table-striped table-bordered">
                                   <thead>
                                            <tr>
                                                <th>Parametros</th>
                                                <th>Especificaciones</th>
                                                <th>Resultados</th>                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Color</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Olor</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Apariencia</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PH</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Viscocidad CPS</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Densidad o gravedad especifica G/ML</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Untuosidad</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Poder Espumoso</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Grado Alcohol</td>
                                                <td>Especificacion del area</td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Cumple</option>
                                                <option>No cumple</option>
                                                <option>No aploca</option>
                                                </select>
                                                </td>
                                            </tr>
                               </table> 
                              </div>         
            </div>
                          <div class="row" style="margin: 1%">
                             <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#myModal1" style="margin-left: 1%">Requiere Ajuste</button>                           
            </div>    
            <div class="row" style="margin: 1%">
                            <div class="col-md-12 col-2 align-self-center"  style="margin-left: 85%">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                           <button type="button" class="btn btn-primary" onclick="window.location.href = '../html/envasado.html';">Aceptar</button>
                           </div>                           
            </div>
      </div>
    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
 

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript"  src="vendor/datatables/datatables.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/datatables.js"></script>
   
</body>

</html>
