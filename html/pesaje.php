<?php 
  include('modal/modal_cambiarContrasena.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Samara Cosmetics">
  
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
  <title>Samara Cosmetics</title>
  
  <!-- Bootstrap Core CSS -->
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link href="html/css/style.css" rel="stylesheet">
  
  <!-- You can change the theme colors from here -->
  <link href="html/css/colors/blue.css" id="theme" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Datatables -->
  <link rel="stylesheet" type="text/css" href="html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <!-- <script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->
 

</head>

<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
  </svg>
</div>
<div id="main-wrapper" style="padding-top:15px; padding-left:15px; padding-right:15px">
  <header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
      <div class="navbar-header">
        <a class="navbar-brand">
          <span>
          <img src="assets/images/logo-light-text2.png" class="light-logo" alt="Samara Cosmetics"/></span>
        </a>
      </div>
      <div class="navbar-collapse">
        <ul class="navbar-nav mr-auto mt-md-0">
          <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
              href="javascript:void(0)"><i class="mdi mdi-menu"></i></a></li>
        </ul>
        
        <ul class="navbar-nav my-lg-0">
                  <li class="nav-item dropdown">
            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="true" id="dropdownMenuenlace">Berney Montoya 
               <i class="large material-icons">account_circle</i></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuenlace">
              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalCambiarContrasena">Cambiar Contraseña</a>
              <a href="./" class="dropdown-item">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <div class="row page-titles">
    <div class="col-md-5 col-2 align-self-right">
      <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>Pesaje</b></h1>
    </div>
    <div class="col-md-3 col-4 align-self-center">
      <input type="text" name="fechahoy" value="" readonly class="form-control datepicker" hidden>
    </div>
    <div class="col-md-2 col-8 align-self-center"></div>
    <div class="col-md-2 col-2 align-self-center">
      <div class="container"></div>
    </div>
  </div>

  
  <div class="row">
    <div class="col-md-12 col-2 align-self-right">
      <div class="card">
        <div class="card-block">
          <!--<h4 class="card-title">Basic Table</h4>
         <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tablaPesajes">

            </table>
            <div id="result"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- </div>
</div>
</div>
</div> -->

<script src="./assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap tether Core JavaScript -->
<script src="./assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./html/vendor/datatables/datatables.min.js"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="./html/js/jquery.slimscroll.js"></script>

<!--Wave Effects -->
<script src="./html/js/waves.js"></script>

<!-- <script type="text/javascript">
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var est = parseInt($('#est').val(), 10);
            var max = parseInt($('#est').val(), 10);
            var age = parseFloat(data[10]) || 0; // use data for the age column

            if ((isNaN(est) && isNaN(max)) ||
                (isNaN(est) && age <= max) ||
                (est <= age && isNaN(max)) ||
                (est <= age && age <= max)) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function () {
        /*var table = $('#tablePesajes').DataTable({
            ajax: {
                url: '/api/pesajes',
                dataSrc: ''
            },
            columns: [
                {
                    title: 'Fecha de Creación',
                    data: 'fecha_creacion'
                },
                /!*{
                    title: 'Fecha de Programación',
                    data: 'fecha_programacion'
                },*!/
                {
                    title: '# de Orden',
                    data: 'numero_orden'
                },
                {
                    title: 'Referencia',
                    data: 'referencia'
                },
                {
                 title: 'Número Lote',
                data: 'nombre_referencia'
                },
                // {
                //     title: 'Presentacion comercial',
                //     data: 'presentacion'
                // },
                /!*{
                    title: 'Linea',
                    data: 'nombre'
                },
                {
                    title: 'Propietario',
                    data: 'nombre_linea'
                },*!/


                {
                    title: 'Estado',
                    data: 'estado',
                    render: (data, type, row) => {
                        return data == 1 ? "Activo" : "Inactivo";
                    }
                },
                {
                    title: '',
                    data: '',
                    render: (data, type, row) => {
                        return `<a href="pesajeinfo/${row.id_batch}/${row.referencia}" class="btn btn-primary">Ingresar </a>`;
                    }
                }
            ]
        });*/
        table.destroy();

        // Event listener to the two range filtering inputs to redraw on input
        $('#est').keyup(function () {
            table.draw();
        });
    });
</script> -->
<!--stickey kit -->
<!--Menu sidebar -->
<script src="html/js/sidebarmenu.js"></script>

<!--stickey kit -->
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

<!--Custom JavaScript -->
<!-- <script src="html/vendor/jquery/jquery-3.2.1.min.js"></script> -->
<script src="html/js/global.js"></script>
<script src="html/js/custom.min.js"></script>
<script src="html/js/datatables.js"></script>
<script src="html/js/utils/pesaje.js"></script>
<!-- <script src="html/vendor/bootstrap/js/popper.js"></script> -->

</body>

</html>