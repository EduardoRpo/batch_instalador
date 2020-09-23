<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Samara Cosmetics</title>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
    
    <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script>

     
 <?php 
    require('savebatch.php'); 
    $hoy =date('Y-m-d');
    $sql5 = mysqli_query($conn, "SELECT * From producto");
    $sql6 = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = '$hoy'");
   
    if (isset($_GET['edit'])) {
        $idbatch = $_GET['edit'];
        $update = true;
        $record = mysqli_query($conn, "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia WHERE id_batch=$idbatch");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $noreferencia = $n['referencia'];
      $nombrereferencia = $n['nombre_referencia'];
      $nombreproducto = $n['id_nombre_producto'];
      $notificacionsanitaria =$n['id_notificacion_sanitaria'];
      $linea = $n['id_linea'];
      $marca = $n['id_marca'];
      $propietario = $n['id_propietario'];
      $presentacion = $n['id_presentacion_comercial'];
      $fechahoy = $n['fecha_creacion'];
      $fechaprogramacion =$n['fecha_programacion'];
      $numerodelote = $n['numero_lote'];
      $tamañototallote = $n['tamano_lote'];
      $tamañolotepresentacion = $n['lote_presentacion'];
      $unidadesxlote = $n['unidad_lote'];

      }
    }
 ?>
 <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand">
                    <span><img src="../assets/images/logo-light-text2.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Jonathan Hernandez    <i class="fas fa-chevron-circle-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuenlace">
                            <a href="#" class="dropdown-item">Cambiar contraseña0202</a>
                            <a href="../index.html" class="dropdown-item">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="row page-titles">
            <div class="col-md-5 col-2 align-self-right">
                <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>PREPARACIÓN</b></h1> 
            </div>
            <div class="col-md-3 col-4 align-self-center">
                <input type="text" name="fechahoy" value="<?php echo date('Y-m-d');?>" readonly class="form-control datepicker" hidden>
            </div>
            <div class="col-md-2 col-8 align-self-center"></div>
            <div class="col-md-2 col-2 align-self-center">
                <div class="container"></div>
            </div>
        </div>

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
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-10 col-2 align-self-right">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered" id="example"   >
                                        <thead>
                                            <tr>
                                                <th>Orden</th>
                                                <th>Referencia</th>
                                                <th>Nombre</th>
                                                <th>Presentación|</th>
                                                <th>Linea</th>
                                                <th>Propietario</th>                                              
                                                <th>Fecha Creación</th>
                                                <th>Fecha Programación</th>
                                                <th>Estado</th>
                                                <th></th>
                                                                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                      
                                            <?php 
                                                while ($rows=mysqli_fetch_assoc($sql6))  
                                                {                                                                                           
                                             ?>
                                             <tr>
                                                <td><?php echo $rows['numero_orden']; ?></td>
                                                <td><?php echo $rows['referencia']; ?></td>
                                                <td><?php echo $rows['nombre_referencia']; ?></td>
                                                <td><?php echo $rows['presentacion']; ?></td>
                                                <td><?php echo $rows['nombre']; ?></td>
                                                <td><?php echo $rows['nombre_linea']; ?></td>
                                                <td><?php echo $rows['fecha_creacion']; ?></td>
                                                <td><?php echo $rows['fecha_programacion']; ?></td>
                                                <td><?php echo $rows['estado']; ?></td>
                                                <td>
                                                  <form method="post" action="preparacioninfo.php">
                                                     <input type="submit" name="action" value="Ingresar" class="btn btn-primary"/>                                     
                                                     <input type="hidden" name="idbatch" value="<?php echo $rows['id_batch']; ?>" />
                                                     <input type="hidden" name="referencia" value="<?php echo $rows['referencia']; ?>" />
                                                  </form>
                                                </td>                                               
                                            </tr>
                                             <?php                                                
                                                }
                                             ?>
                                        </tbody>
                                    </table>
                                    <div id="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript"  src="vendor/datatables/datatables.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/waves.js"></script>

<script type="text/javascript">
    $.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
    var est = parseInt($('#est').val(), 10);
    var max = parseInt($('#est').val(), 10);
    var age = parseFloat(data[10]) || 0;

    if ((isNaN(est) && isNaN(max)) ||
      (isNaN(est) && age <= max) ||
      (est <= age && isNaN(max)) ||
      (est <= age && age <= max)) {
      return true;
    }
    return false;
  }
);

$(document).ready(function() {
  var table = $('#example').DataTable();
  table.destroy();
  $('#est').keyup(function() {
    table.draw();
  });
});

</script>
    
<script src="js/sidebarmenu.js"></script>
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="js/global.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/datatables.js"></script>
   
</body>

</html>
