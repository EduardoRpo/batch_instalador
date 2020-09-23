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
      <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script>

     
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 <?php 
    require('savebatch.php'); 

  
    $sql = mysqli_query($conn, "SELECT id, nombre From marca order by id");
    $sql2 = mysqli_query($conn, "SELECT * From propietario order by id");
    $sql3 = mysqli_query($conn, "SELECT id, presentacion From presentacion_comercial order by id");
    $sql4 = mysqli_query($conn, "SELECT * From linea order by id");
    $sql5 = mysqli_query($conn, "SELECT * From nombre_producto");
    $sql6 = mysqli_query($conn, "SELECT * FROM batch INNER JOIN producto ON batch.id_producto = producto.id INNER JOIN linea ON batch.id_linea = linea.id INNER JOIN propietario ON batch.id_propietario = propietario.id INNER JOIN presentacion_comercial ON batch.id_presentacion = presentacion_comercial.id");
  if (isset($_GET['edit'])) {
    $idbatch = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "SELECT * FROM batch WHERE id_batch=$idbatch");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $noreferencia = $n['numero_orden'];
      $nombrereferencia = $n['nombre_referencia'];
      $nombreproducto = $n['id_producto'];
      $notificacionsanitaria =$n['notificacion_sanitaria'];
      $linea = $n['id_linea'];
      $marca = $n['id_marca'];
      $propietario = $n['id_propietario'];
      $presentacion = $n['id_presentacion'];
      $fechahoy = $n['fecha_hoy'];
      $fechaprogramacion =$n['fecha_programacion'];
      $numerodelote = $n['numero_lote'];
      $tamañototallote = $n['tamano_lote'];
      $tamañolotepresentacion = $n['tamano_lote_presentacion'];
      $unidadesxlote = $n['unidades_x_lote'];

      }
    }


 ?>
 <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
 <script type="text/javascript">
  $(function(){
            $('#tamañototallote, #tamañolotepresentacion').keyup(function(){
               var value1 = parseFloat($('#tamañototallote').val()) || 0;
               var value2 = parseFloat($('#tamañolotepresentacion').val()) || 0;
               $('#unidadesxlote').val(value1 / value2);
            });
         });
 </script>
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

                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-2 align-self-right">
                        <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>Batch Record</b></h1> 
                    </div>
                    <div class="col-md-3 col-4 align-self-center">
                        <!-- Search form -->
                     
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                        <select class="selectpicker form-control">
                        <option selected hidden>Acciones</option>
                        <option>Crear</option>
                        <option value="" id="Name2">Editar</option>
                        <option>Eliminar</option>
                      </select>
                    </div>


    <div class="col-md-2 col-2 align-self-center">
    <div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" data-toggle="modal" data-target="#myModal">Crear Batch Record</button>


  <!-- Modal -->
     <div class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <div class="modal-header" style="  background-color: #FF8D6D !important;">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Batch Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form action="savebatch.php" method="post" autocomplete="off">
                                <input type="hidden" name="idbatch" value="<?php echo $idbatch; ?>">
                                <div class="row page">
                              <div class="col-md-12 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">No. Referencia:</label>
                                <input type="text" class="form-control" name="noreferencia"  value="<?php echo $noreferencia; ?>">
                              </div>
                              </div>
                                <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Nombre Referencia:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nombrereferencia" required value="<?php echo $nombrereferencia; ?>">
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Marca:</label>
                                 <select class="form-control " name="marca" id="marca" required value="<?php echo $marca; ?>">
                                        <option  value="<?php echo $marca; ?>">Seleccione...</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql)){
                                        echo "<option  value='".$row['id']."'>".$row['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                              </div>
                              </div>  
                
                  <input type="text" name="fechahoy" value="<?php echo date('Y-m-d');?>" readonly class="form-control datepicker" hidden>
                                                        
                                <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Notificación sanitaria:</label>
                                <input type="text" class="form-control" id="recipient-name" name="notificacionsanitaria"  value="<?php echo $notificacionsanitaria; ?>" >
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Propietario:</label>
                                 <select class="form-control " name="propietario" id="propietario" required   value="<?php echo $marca; ?>" >
                                        <option  value="<?php echo $marca; ?>">Seleccione...</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql2)){
                                        echo "<option  value='".$row['id']."'>".$row['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                              </div>
                              </div>
                                <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Nombre producto:</label>
                                <select class="form-control " name="nombreproducto" id="nombreproducto" required value="<?php echo $nombreproducto; ?>">
                                        <option value="<?php echo $nombreproducto; ?>">Seleccione...</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql5)){
                                        echo "<option  value='".$row['id']."'>".$row['nombre_producto'] . "</option>";
                                        }
                                        ?>
                                    </select>
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Presentación comercial:</label>
                                    <select class="form-control " name="presentacion" id="presentacion" required  value="<?php echo $presentacion; ?>">
                                        <option value="<?php echo $presentacion; ?>">Seleccione...</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql3)){
                                        echo "<option  value='".$row['id']."'>".$row['presentacion'] . "</option>";
                                        }
                                        ?>
                                    </select>
                              </div>
                              </div>
                              <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Numero de lote:</label>
                                <input type="text" class="form-control" id="recipient-name" name="numerodelote" value="<?php echo $numerodelote; ?>">
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Linea:</label>
                                 <select class="form-control " name="linea" id="linea" required  value="<?php echo $linea; ?>" >
                                        <option value="<?php echo $linea; ?>">Seleccione...</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql4)){
                                        echo "<option  value='".$row['id']."'>".$row['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                              </div>
                              </div>
                                <div class="row page">
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Tamaño del lote Total:</label>
                                <input type="number" name="tamañototallote" id="tamañototallote" class="form-control" min="1"  value="<?php echo $tamañototallote; ?>" />
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Tamaño del lote por presentación:</label>
                                 <input type="number" name="tamañolotepresentacion" id="tamañolotepresentacion" class="form-control" min="1"  value="<?php echo $tamañolotepresentacion; ?>"/>
                              </div>
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Unidades por lote solicitadas:</label>
                                    <input type="number" name="unidadesxlote" id="unidadesxlote" class="form-control" readonly min="1"  value="<?php echo $unidadesxlote; ?>"/>
                              </div>
                              </div>

                               <div class="row page">
                              <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Fecha de programación:</label>
                                <input type="date" class="form-control" id="recipient-name" name="fechaprogramacion" value="<?php echo $fechaprogramacion; ?>">
                              </div>
                              <div class="col-md-6 col-2 align-self-center">
                                <button type="button" class="btn waves-effect waves-light btn-danger pull-center" data-toggle="modal" data-target="#myModal4"data-dismiss="modal" aria-label="Close" style="width: 80%; margin-top: 12%">Clonar Batch</button>
                              </div>
                              </div>
                               <div class="row page">
                              <div class="col-md-12 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Autoriza:</label>
                                <input type="text" class="form-control" id="recipient-name" name="autoriza">
                              </div>
                              </div>
                              <div class="modal-footer">
                                
                                <?php if ($update == false): ?>
                                  <button type="submit" class="btn btn-primary" name="save">Crear</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <?php else: ?>
                                  <button type="submit" class="btn btn-primary" name="update">Modificar</button>
                                  <script type="text/javascript">
                                  $(window).on('load',function(){
                                      $('#myModal').modal('show');
                                  });
                                  </script>
                                <?php endif ?>
                                 <!-- <button type="submit" class="btn btn-primary" name="save">Crear</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>-->
                  
                          </div>
                                </form>
                          </div>
                          
                        </div>
                        </div>
                      </div>
                    </div>
                    </div>
                 </div>
                 <!-- Modal -->
     <div class="modal fade" id="myModal2" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Presentación envasado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form>
                                <div class="row page">
                              <div class="col-md-5 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Total Kilos:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="col-md-5 col-2 align-self-center">
                               <table class="table">
                                   <thead>
                                            <tr>
                                                <th>Referencia</th>
                                                <th>Presentación</th>
                                                <th>Cantidad KG</th>
                                                <th>Unidades</th>                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Mustard</option>
                                                <option>Ketchup</option>
                                                <option>Relish</option>
                                                </select>
                                                </td>
                                                <td><select class="selectpicker form-control">
                                                <option selected hidden> </option>
                                                <option>Mustard</option>
                                                <option>Ketchup</option>
                                                <option>Relish</option>
                                                </select>
                                                </td>
                                                <td><input type="text" class="form-control" id="cantidad"></td>
                                                <td><input type="text" class="form-control" id="unidades"></td>
                                            </tr>
                               </table> 
                              </div>
                              </div>
                              <div class="row page">
                              <div class="col-md-5 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Numero de presentaciones:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                             
                              </div>
                                </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Aceptar</button>
                          </div>
                        </div>
                        </div>
                      </div>
                        <!-- Modal -->
     <div class="modal fade" id="myModal3" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Orden de suministro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form>
                                <div class="row page">
                              <div class="col-md-12 col-2 align-self-center">
                               <table class="table">
                                   <thead>
                                            <tr>
                                                <th>Referencia</th>
                                                <th>Materia prima</th>
                                                <th>Peso GRS</th>                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               <td><input type="text" class="form-control" id="pesogrs" value="01" readonly></td>
                                                <td><input type="text" class="form-control" id="pesogrs" value="Materia01" readonly></td>
                                                <td><input type="text" class="form-control" id="pesogrs"></td>
                                            </tr>
                               </table> 
                              </div>
                              </div>
                                </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Aceptar</button>
                          </div>
                        </div>
                        </div>
                      </div>
     <div class="modal fade" id="myModal4" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cantidad de Batch Record Para Crear</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <form>
                                <div class="row page">
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Tamaño lote total:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="col-md-8 col-2 align-self-center">
                               <table class="table">
                                   <thead>
                                            <tr>
                                                <th>Tamaño Kilos</th>
                                                <th>Cantidad</th>
                                                <th>Tamaño total Kilos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control" id="tamaño"></td>
                                                <td><input type="text" class="form-control" id="cantidadbatch"></td>
                                                <td><input type="text" class="form-control" id="tamañototal"></td>
                                            </tr>
                               </table> 
                              </div>
                              </div>
                              <div class="row page">
                              <div class="col-md-4 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Total Batch Record:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                             
                              </div>
                                </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Aceptar</button>
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
                        
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            
                <div class="row">
                   <div class="col-2 align-self-center">          
                  <table class="table" style="margin-left: 15%; margin-bottom: 180%">
                                           
                                        <tbody>
                                          <tr><td>
                                                <button type="button" class="btn waves-effect waves-light btn-danger pull-center" style="width: 80%">Todos<br/>los batch record</button></td>
                                            </tr>
                                            
                                              
                                            <tr><td>
                                        <select class="selectpicker form-control" id="filtrar1" style="width: 80%">
                                        <option selected hidden>Filtrar</option>
                                        <option>Activo</option>
                                        <option>Detenido</option>
                                        <option>En proceso</option>
                                        </select>
                                           </td> </tr>
                                                <tr><td>
                                                  <button type="button" class="btn waves-effect waves-light btn-danger pull-center" data-toggle="modal" data-target="#myModal2" style="width: 80%">Multipresentación</button>
                                               </td> </tr>
                               

                                            </tbody>
                                    </table>
                              </div>
                    <!-- column -->
                    <div class="col-md-10 col-2 align-self-right">
                        <div class="card">
                            <div class="card-block">
                                 <!--<h4 class="card-title">Basic Table</h4>
                                <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered" id="example"   >
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th># de Orden</th>
                                                <th>Referencia</th>
                                                <th>Nombre Referencia</th>
                                                <th>Propietario</th>
                                                <th>Presentacion comercial</th>
                                                <th>Linea</th>
                                                <th>Fecha de Creación</th>
                                                <th>Fecha de Programación</th>
                                                <th></th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                      
                                            <?php 
                                                while ($rows=mysqli_fetch_assoc($sql6))  
                                                {                                                                                           
                                             ?>
                                             <tr>
                                                
                                            <td><input type="checkbox" value="<?php echo $rows['id_batch']; ?>" id="Name1" name="Name1" onchange="copyTextValue(this);"></td>
                                            
                                                <td><?php echo $rows['id_batch']; ?></td>
                                                <td><?php echo $rows['nombre_referencia']; ?></td>
                                                 <td><?php echo $rows['nombre_producto']; ?></td>
                                                <td><?php echo $rows['nombre_propietario']; ?></td>
                                                <td><?php echo $rows['presentacion']; ?></td>
                                                <td><?php echo $rows['nombre_linea']; ?></td>
                                                 <td><?php echo $rows['fecha_hoy']; ?></td>
                                                <td><?php echo $rows['fecha_programacion']; ?></td>
                                                <td><a href="crear-batch.php?edit=<?php echo $rows ['id_batch']; ?>" class="btn btn-primary" ><i class="fas fa-edit"></i></a></td>
                                                <td><a href="crear-batch.php?del=<?php echo $rows ['id_batch']; ?>" class="btn btn-primary" ><i class="fas fa-trash"></i></a></td>
                                                
                                                

                                            </tr>
                                             <?php                                                
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== 
            <footer class="footer">
                ©  <b>2020</b> Desarrollado por Teenus S.A.S <a href="https://www.teenus.com.co/" target="_blank"><img src="../assets/images/logo-teenus.png" alt="Teenus"/></a></div>
            </footer>
            -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
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

  <script type="text/javascript"> 
    function copyTextValue(bf) {
  var text1 = bf.checked ? document.getElementById("Name1").value : '';
  document.getElementById("Name2").value = text1;
  document.getElementById("Name3").value = text1;
}
</script>
    <!--stickey kit -->
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/datatables.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){

        function load_data(is_category)
        {
            var dataTable  = $('#product_data').DataTable({
                   "processing":true,
                   "serverSide":true,
                   "order":[],
                   "ajax":{
                    url:"fetch.php",
                    type:"POST",
                    data:{is_category:is_category}
                   },

            });
        }
    });


</script>
</body>

</html>
