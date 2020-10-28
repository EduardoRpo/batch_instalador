<?php
session_start();
?>

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
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
   <!--  <link href="../css/style.css" rel="stylesheet"> -->
    <link href="../../html/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../html/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="../../html/css/custom.css">

      <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
      <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
     
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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


  
       <!-- HEADER -->
       <?php include('partials/header.php'); ?>
   <!-- FIN HEADER -->

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
 <!--        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light"> -->
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
    <!--             <div class="navbar-header">
                    <a class="navbar-brand"> -->
                        <!-- Logo text --><span>
                         
                         <!-- Light Logo text -->    
             <!--             <img src="../assets/images/logo-light-text2.png" class="light-logo" alt="homepage" /></span> </a>
                </div> -->
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
          <!--       <div class="navbar-collapse"> -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
               <!--      <ul class="navbar-nav mr-auto mt-md-0"> -->
                        <!-- This is  -->
                     <!--    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                <!--     </ul> -->
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                 <!--    <ul class="navbar-nav my-lg-0"> -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                    <!--     <li class="nav-item dropdown"> -->
                            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/campana.png" alt="noty" class="profile-pic m-r-12" /></a>-->
      <!--                       <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" />Jonathan Hernandez</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header> -->

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
                        <h1 class="text-themecolor m-b-4 m-t-0">Acondicionamiento</h1> 
                    </div>
                    <div class="col-md-3 col-4 align-self-center">
                        <!-- Search form -->
                     
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                      
                    </div>


    <div class="col-md-2 col-5 align-self-center">
    <div class="container">
  <!-- Trigger the modal with a button -->


  <select class="selectpicker form-control">
                        <option selected hidden>Acciones</option>
                        <option>Mustard</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                      </select>
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
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
          Información del producto
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="row" style="margin: 1%">
                              <div class="col-md-4 align-self-right" >
                                <label for="recipient-name" class="col-form-label">No. Lote:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Fecha:</label>
                                 <input type="date" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">No OP:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
            </div>
      </div>
    </div>
  </div>
<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"style="width: 100%">
          Despeje de lineas y procesos
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
     <div class="card-body">
                 <div class="row" style="margin: 1%">
                              <div class="col-md-12 align-self-center" >
                                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control calidad microbiologica</h3>
                              </div>
                              <div class="col-md-12 align-self-center">
                               <div class="card">
                            <div class="card-block">
                                 <!--<h4 class="card-title">Basic Table</h4>
                                <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                                <div class="table-responsive">
                              
                               <table class="table table-striped table-bordered">
                                   <thead>
                                            <tr>
                                                <th>Unidad de empaque</th>
                                                <th>Unidades recibidas</th>                                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                                             <tr>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                                             <tr>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                               </table> 
                                </form>
                                         </div>
                                            </div> 
                                               </div>
                                               </div>  
                       
                             </div>
         <div class="row" style="margin: 1%">
                              <div class="col-md-12 align-self-right" >
                                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                              </div>
         </div>
        <div class="row" style="margin: 1%">
                              <div class="col-md-4 align-self-right" >
                                <label for="recipient-name" class="col-form-label">Producto de desinfección</label>
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select>
                              </div>
                              <div class="col-md-8 align-self-center">
                                <label for="recipient-name" class="col-form-label">Observaciones:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
            </div>   
        <div class="row" style="margin: 1%">
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Realizado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>
                              
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Verificado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>
            </div>  
        <div class="row buttons-group-container" style="margin: 1%">
                           <!--  <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%"> -->
                             <div>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                           <button type="button" class="btn btn-primary">Aceptar</button>
                           </div>
                          <!--  </div>        -->              
            </div>
                        <div class="row" style="margin: 1%">
                              <div class="col-md-12 align-self-center" >
                                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliacion de rendimiento</h3>
                              </div>
                       
                               <div class="col-md-4 align-self-center" style="margin-top: 1%">
                                <label for="recipient-name" class="col-form-label">Identificación encubadora:</label>
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>  
                                </select> 
                              </div>
                              
                              <div class="col-md-4 align-self-center" style="margin-top: 1%">
                                <label for="recipient-name" class="col-form-label">Identificación del autoclave:</label> 
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select>
                              </div>
                              <div class="col-md-4 align-self-center" style="margin-top: 1%">
                                <label for="recipient-name" class="col-form-label">Identificación de la cabina de flujo laminar:</label>  
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select> 
                              </div>
               <!--                 <div class="col-md-4 align-self-center">
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select>
                              </div>   
                               
                               <div class="col-md-4 col-2 align-self-center">
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select>
                              </div>  
                              <div class="col-md-4 col-2 align-self-center">
                                <select class="selectpicker form-control">
                                <option selected hidden></option>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                      </select>
                              </div> -->
                             </div> 
                              <div class="col-md-12 align-self-center">
                               <div class="card">
                            <div class="card-block">
                                 <!--<h4 class="card-title">Basic Table</h4>
                                <h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                                <div class="table-responsive">
                              
                               <table class="table table-striped table-bordered">
                                   <thead>
                                            <tr>
                                                <th>Analisis</th>
                                                <th>Especificacion</th>
                                                <th>Metodo</th>
                                                <th>Resultados</th>                                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                                             <tr>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                                             <tr>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td>Auto</td>
                                                <td> <input type="text" class="form-control" id="cantidad-name"></td>
                                            </tr>
                               </table> 
                                </form>
                                         </div>
                                            </div> 
                                               </div>
                                               </div>  
                                <div class="row" style="margin: 1%">                 
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Fecha de siembre:</label>
                                 <input type="date" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Fecha de resultados:</label>
                                 <input type="date" class="form-control" id="recipient2-name">
                              </div>                      
            </div>
               <div class="row" style="margin: 1%">
                               <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Realizado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>
              
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Aprobado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>      
            </div>  
               <div class="row" style="margin: 1%">
                               <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Verificado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>
                              
                              <div class="col-md-4 align-self-center">
                                <label for="recipient-name" class="col-form-label">Rechazado Por:</label>
                                 <input type="text" class="form-control" id="recipient2-name">
                              </div>
                              <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                                <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                              </div>      
            </div>  
                  <div class="row buttons-group-container" style="margin: 1%">
                           <!--  <div class="col-md-12 col-2 align-self-center"  style="margin-left: 85%"> -->
                             <div>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                           <button type="button" class="btn btn-primary" onclick="window.location.href = '../html/controlfisico.html';">Aceptar</button>
                           </div>
                           </div>
                         <!--   </div>    -->                     

                              
            </div>   
             

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
             </div>

            </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
 

    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript"  src="../../html/vendor/datatables/datatables.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../html/js/utils/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../html/js/utils/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../html/js/utils/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../html/js/utils/custom.min.js"></script>
    <script src="../../html/js/utils/datatables.js"></script>
   
</body>

</html>
