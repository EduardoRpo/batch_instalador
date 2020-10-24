<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Samara Cosmetics">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
  <title>Samara Cosmetics</title>

  <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="html/css/style.css" rel="stylesheet">
  <link href="html/css/colors/blue.css" id="theme" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

</head>

<body class="fix-header fix-sidebar card-no-border">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
  </div>

  <div id="main-wrapper" style="padding-top:15px; padding-left:15px; padding-right:15px">

     <!-- HEADER -->
    <!--  <?php include('partials/header.php'); ?> -->
   <!-- FIN HEADER -->
  
  <div class="row page-titles">
    <div class="col-md-8 col-2 align-self-right">
      <h1 class="text-themecolor m-b-0 m-t-0" style="margin-left: 7%"><b>Liberación Lote</b></h1>
    </div>
    <div class="col-md-3 col-4 align-self-center">
      <input type="text" name="fechahoy" value="" readonly="" class="form-control datepicker" hidden="">
    </div>
    <div class="col-md-2 col-8 align-self-center"></div>
    <div class="col-md-2 col-2 align-self-center">
      <div class="container">
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-12 col-2 align-self-center">
      <div class="card">
        <div class="card-block">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="preparacionTable" style="width: 100%;">

            </table>
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
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="html/vendor/datatables/datatables.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="html/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="html/js/waves.js"></script>
<!--Menu sidebar -->
<script src="html/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="html/js/custom.min.js"></script>
<script src="html/js/datatables.js"></script>
<script src="../assets/plugins/jquery/jquery.number.min.js"></script>
<script src="html/js/utils/preparacion.js"></script>

</body>

</html>
