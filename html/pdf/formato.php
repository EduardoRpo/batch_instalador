<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf | Batch Record</title>

    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icon/favicon.png">
    <title>Samara Cosmetics</title>

    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../html/pdf/css/style_pdf.css" rel="stylesheet">
    <link href="/html/pdf/css/style_certPesaje.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

</head>

<body id="pdf">

    <div class="mb-3" style="display: flex;justify-content:space-between">
        <a><span><img src="../../assets/images/logo/logo-samara.png" style="width: 80%;" class="light-logo" alt="Samara Cosmetics" /></span></a>
        <div>
            <span id="codigo"></span>
            <span id="version"></span>
            <span id="fecha"></span>
        </div>
    </div>

    <div class="noImprimir">
        <a href='#'> <i class='fa fa-print fa-2x link-imprimir flotante' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>
        <a href='#'> <i class='fa fa-times-circle fa-2x link-cerrar flotante position' data-toggle='tooltip' title='Cerrar ventana' style='color:red;'></i></a>
    </div>

    <div id="invoice">
        <!-- Head -->
        <?php include_once __DIR__ . '/modules/head.php'; ?>

        <!-- pesaje -->
        <h1 class="SaltoDePagina"></h1>
        <?php include_once __DIR__ . '/modules/pesaje.php'; ?>

        <!-- Preparacion -->
        <h1 class="SaltoDePagina"></h1>
        <?php include_once __DIR__ . '/modules/preparacion.php'; ?>

        <!-- Aprobación -->
        <h1 class="SaltoDePagina"></h1>
        <?php include_once __DIR__ . '/modules/aprobacion.php'; ?>

        <!-- Envasado -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/envasado.php'; ?>

        <!-- Acondicionamiento -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/acondicionamiento.php'; ?>

        <!-- inicio despachos -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/despachos.php'; ?>

        <!-- Inicio Microbiologia -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/microbiologia.php'; ?>

        <!-- Inicio Fisicoquimico -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/fisicoquimico.php'; ?>

        <!-- inicio liberacion Lote -->
        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/liberacionLote.php'; ?>

        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/etiquetasPesaje.php'; ?>

        <h1 class="SaltoDePagina"> </h1>
        <?php include_once __DIR__ . '/modules/certificadoPesaje.php'; ?>
    </div>

    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../html/vendor/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../../html/js/utils/jquery.slimscroll.js"></script>
    <script src="../../html/js/utils/waves.js"></script>
    <script src="../../html/js/utils/sidebarmenu.js"></script>
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="https://use.fontawesome.com/15242848ba.js"></script>
    <script src="../../html/pdf/js/batch_pdf.js"></script>
    <script src="../../html/js/global/etiquetas.js"></script>
    <script src="/html/pdf/js/download_pdf.js"></script>
    <!-- <script src="../../html/pdf/js/printThis.js"></script> -->

</body>

</html>