<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Calidad</title>
    <title>Samara Cosmetics</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icon/favicon.png">
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../html/pdf/css/style_cert.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="grid-container gl mb-3">
        <div class="logo"><img src="../../assets/images/logo/logo-samara.png" alt="logo_samara" id="logo"></div>
        <div class="title2">CERTIFICADO DE ANÁLISIS</div>
        <div class="title3">CÓDIGO</div>
        <div class="title4">VERSIÓN</div>
        <div class="title5">FECHA</div>
        <div class="title6">F-CC-13</div>
        <div class="title7">7</div>
        <div class="title8">27/07/2021</div>
    </div>

    <div class="grid-container-product gl mb-3">
        <div class="product">BIOELIXIR CAPILAR (ISABELY) 60ml</div>
        <div class="titular"><b>TITULAR:</b></div>
        <div class="titular_id">SAMARA COSMETICS</div>
        <div class="invima"><b>INVIMA:</b></div>
        <div class="invima_id">NSOC82727-17CO</div>
        <div class="muestra"><b>MUESTRA:</b></div>
        <div>500 ml</div>
        <div class="lote"><b>LOTE:</b></div>
        <div class="lote_id">LQ0020421</div>
    </div>

    <div class="grid-container-sbtitle gl mb-3">
        <div class="glsbt">ANALISIS MICROBIOLOGICO</div>
        <div class="glsbt fecha_micro" style="font-size: smaller;font-weight: 600;">FECHA</div>
    </div>

    <div class="grid-container-micro gl mb-3">
        <div class="cltitle">CONTROL</div>
        <div class="cltitle">ESPECIFICACIONES</div>
        <div class="cltitle">METODO</div>
        <div class="cltitle">RESULTADOS</div>

        <div class="fr">Recuento de Mesófilos aerobios totales</div>
        <div class="fr" id="mesofilos"></div>
        <div class="fr">Siembra recuento total</div>
        <div class="fr" id="result_mesofilos"></div>
        <div class="fr">Pseudomona aeruginosa</div>
        <div class="fr" id="pseudomona"></div>
        <div class="fr">Siembra recuento total</div>
        <div class="fr" id="result_pseudomona"></div>
        <div class="fr">Escherichia coli </div>
        <div class="fr" id="escherichia"></div>
        <div class="fr">Siembra recuento total</div>
        <div class="fr" id="result_escherichia"></div>
        <div class="fr">Staphylococcus aureus</div>
        <div class="fr" id="staphylococcus"></div>
        <div class="fr">Siembra recuento total</div>
        <div class="fr" id="result_staphylococcus"></div>
    </div>

    <div class="grid-container-sbtitle gl mb-3">
        <div class="glsbt">ANALISIS ORGANOLÉPTICO</div>
        <div class="glsbt fecha_organ" style="font-size: smaller;font-weight: 600;">FECHA</div>
    </div>

    <div class="grid-container-organo gl mb-3">
        <div class="cltitle">CONTROL</div>
        <div class="cltitle">ESPECIFICACIONES</div>
        <div class="cltitle">METODO</div>
        <div class="cltitle">RESULTADOS</div>
        <div class="fr">Color</div>
        <div class="fr" id="espec_color"></div>
        <div class="fr">Escala Cromática</div>
        <div class="fr" id="result_color"></div>
        <div class="fr">Olor</div>
        <div class="fr" id="espec_olor"></div>
        <div class="fr">Sensorial</div>
        <div class="fr" id="result_olor"></div>
        <div class="fr">Apariencia</div>
        <div class="fr" id="espec_apariencia"></div>
        <div class="fr">Sensorial</div>
        <div class="fr" id="result_apariencia"></div>
    </div>

    <div class="grid-container-sbtitle gl mb-3">
        <div class="glsbt">ANALISIS FISICOQUÍMICO</div>
        <!-- <div class="glsbt fecha_organ" style="font-size: smaller;font-weight: 600;">FECHA</div> -->
    </div>

    <div class="grid-container-fisico gl mb-3">
        <div class="cltitle">CONTROL</div>
        <div class="cltitle">ESPECIFICACIONES</div>
        <div class="cltitle">METODO</div>
        <div class="cltitle">RESULTADOS</div>
        <div class="fr">pH</div>
        <div class="fr" id="espec_ph"></div>
        <div class="fr">pHmetro</div>
        <div class="fr" id="result_ph"></div>
        <div class="fr">Densidad</div>
        <div class="fr" id="espec_densidad"></div>
        <div class="fr">Picnómetro</div>
        <div class="fr" id="result_densidad"></div>
        <div class="fr">Viscosidad (cps)</div>
        <div class="fr" id="espec_viscidad"></div>
        <div class="fr">Viscosímetro</div>
        <div class="fr" id="result_viscosidad"></div>
        <div class="fr">Untuosidad</div>
        <div class="fr" id="espec_untosidad"></div>
        <div class="fr">Sensorial</div>
        <div class="fr" id="result_untuosidad"></div>
        <div class="fr">Poder Espumoso</div>
        <div class="fr" id="espec_poder_espumoso"></div>
        <div class="fr">Sensorial</div>
        <div class="fr" id="result_poder"></div>
        <div class="fr">Grado Alcohol</div>
        <div class="fr" id="espec_grado_alcohol"></div>
        <div class="fr">Alcoholímetro</div>
        <div class="fr" id="result_alcohol"></div>
    </div>

    <div class="grid-container-sbtitle gl mb-3">
        <div class="glsbt">PARAMETROS FISICOS</div>
    </div>

    <div class="grid-container-paramfisico gl mb-3">
        <div class="cltitle">CONTROL</div>
        <div class="cltitle">ESPECIFICACIONES</div>
        <div class="cltitle">METODO</div>
        <div class="cltitle">RESULTADOS</div>

        <div class="fr">ENVASE</div>
        <div class="fr">Buen estado, cierre hermético con acople a la tapa</div>
        <div class="fr">Visual</div>
        <div class="fr">Cumple</div>
        <div class="fr">ETIQUETA</div>
        <div class="fr">Buen estado y completa</div>
        <div class="fr">Visual</div>
        <div class="fr">Cumple</div>

    </div>

    <div class="grid-container-nota gl mb-3">
        <div>Los parámetros Microbiológicos se evalúan de acuerdo a la resolución 1482 del 02 de julio del 2012. En la cual ya no se evalúan mohos y levaduras, además se especifica el recuento de mesófilos aerobios totales en Máx. 5x103 UFC/ g ó mL </div>
    </div>

    <div class="gl mb-3">
        <div class="mb-3">OBSERVACIONES</div>
        <div class="mb-3 obs"></div>
    </div>
    <div class="gl mb-3">
        <div class="check_cert">
            <div>
                <label for="">Aprobado</label>
                <input type="checkbox" name="" id="chk_aprobado" class="mr-3" style="width: 20px; height: 20px;">
            </div>
            <div>
                <label for="">Rechazado</label>
                <input type="checkbox" name="" id="chk_rechazado" style="width: 20px;height: 20px;">
            </div>
        </div>
    </div>
    <div class="gl mb-3">
        <div class="mt-3"><img src="../../admin/assets/img/firmas/ANA KARINA HERNANDEZ.jpg" alt="" style="width:20%"></div>
        <div><b>Ana Karina Hernandez Botero</b></div>
        <div> <b>Directora Calidad</b></div>
    </div>

    <div class="grid-container-nota gl mb-3">
        <div id="op">OP</div>
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
    <script src="../../html/pdf/js/batch_cert.js"></script>
    <script src="../../html/js/global/propiedadesProducto.js"></script>


</body>

</html>