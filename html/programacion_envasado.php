<?php
require_once('./html/sesiones/sesion.php');
include('modal/modal_cambiarContrasena.php');
include_once("modal/modal_multipresentacion.php");
sesiones(5);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Batch Record">
    <meta name="author" content="Teenus SAS">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Programación Envasado | Samara Cosmetics</title>


    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="html/css/style.css" rel="stylesheet">
    <link href="html/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="/html/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <style>
        .payment-of-tax table tr th {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #f2f2f2;
            ;

        }

        .payment-of-tax table tr td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #f2f2f2;
            ;

        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">

        <!-- HEADER -->
        <?php include('partials/header.php'); ?>
        <!-- FIN HEADER -->

        <div class="contenedorPrincipal row">
            <div class="tituloProceso col">
                <h1 class="text-themecolor"><b>Capacidad Envasado</b></h1>
            </div>

        </div>

        <div class="row">
            <div class="col-md-9 align-self-center">
                <div class="card">
                    <div class="card-block">
                        <div class="payment-of-tax">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tblCalcCapacidadEnvasado" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">S</th>
                                            <th colspan="3">LQ</th>
                                            <th rowspan="2">Total Kg</th>
                                            <th colspan="3">SL</th>
                                            <th rowspan="2">Total Kg</th>
                                            <th colspan="3">SM</th>
                                            <th rowspan="2">Total Kg</th>
                                        </tr>
                                        <tr>
                                            <th>T1</th>
                                            <th>T2</th>
                                            <th>T3</th>
                                            <th>T1</th>
                                            <th>T2</th>
                                            <th>T3</th>
                                            <th>T1</th>
                                            <th>T2</th>
                                            <th>T3</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tblCalcCapacidadEnvasadoBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedorPrincipal row">
            <div class="tituloProceso col">
                <h1 class="text-themecolor"><b>Programación Envasado y Acondicionamiento</b></h1>
            </div>
            <div class="col-2">
                <label for="numSemana">Semana No</label>
                <select name="numSemana" id="numSemana" class="form-control text-center">
                </select>
            </div>
            <div class="col-xs-2 ml-4 mr-4">
                <label style="margin-top:36px" id="fechaSemana"></label>
            </div>
            <div class="col-2">
                <button type="button" id="btnProgramar" class="btn waves-effect waves-light btn-danger" style="width: 120px; margin-top:33px">
                    <strong>Programar</strong>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 align-self-center">
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tablaEnvasado" style="width: 100%;">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="html/vendor/datatables/datatables.min.js"></script>
    <script src="html/js/utils/jquery.slimscroll.js"></script>
    <script src="html/js/utils/waves.js"></script>
    <script src="html/js/utils/sidebarmenu.js"></script>
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="html/js/utils/custom.min.js"></script>
    <script src="html/js/utils/datatables.js"></script>
    <script src="../assets/plugins/jquery/jquery.number.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="/html/js/global/searchData.js"></script>
    <script src="html/js/programacion_envasado/tblProgramacionEnvasado.js"></script>
    <script src="html/js/programacion_envasado/programacionEnvasado.js"></script>
    <script src="/html/js/global/link-comentario.js"></script>

    <script src="/html/js/batch/multipresentacion/updateMulti.js"></script>
    <!-- <script src="/html/js/batch/multipresentacion/multipresentacion.js"></script> -->
    <script src="/html/js/batch/multipresentacion/addMulti.js"></script>
    <script src="/html/js/batch/multipresentacion/deleteMulti.js"></script>
    <!-- <script src="/html/js/batch/multipresentacion/saveMulti.js"></script> -->
    <!-- <script src="/html/js/batch/multipresentacion/multiCalc.js"></script> -->

</body>

</html>