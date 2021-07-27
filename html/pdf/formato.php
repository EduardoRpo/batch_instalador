<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf | Batch Record</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icon/favicon.png">
    <title>Samara Cosmetics</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style_pdf.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

</head>

<body id="pdf">

    <div class="mb-3" style="display: flex;justify-content:space-between">
        <a><span><img src="img/logo-samara.png" style="width: 80%;" class="light-logo" alt="Samara Cosmetics" /></span></a>
        <span><b>Codigo:</b> F-Pr-13 <b>Versión:</b>10 <b>Fecha:</b>26/04/2021</span>
    </div>

    <div class="noImprimir">
        <a href='#'> <i class='fa fa-print fa-2x link-imprimir flotante' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>
        <a href='#'> <i class='fa fa-times-circle fa-2x link-cerrar flotante position' data-toggle='tooltip' title='Cerrar ventana' style='color:red;'></i></a>
    </div>


    <div class="card">
        <div class="card-header centrado"><b>1. INFORMACIÓN DEL PRODUCTO</b></div>
        <div class="card-body">
            <div class="group-info-ref p-3">
                <label>Referencia:</label><label class="bold ref"></label>
                <label>Nombre Referencia:</label><label id="nref"></label>
                <label>Marca:</label><label id="marca"></label>
                <label>Propietario:</label><label id="propietario"></label>
                <label>Notificación Sanitaria:</label><label id="notificacion"></label>
                <label>Presentación Comercial:</label><label id="presentacion"></label>
            </div>
            <hr style="width: 95%;">
            <div class="group-info-batch p-3">

                <label>Orden de Producción:</label><label class="orden" id="orden"></label>
                <label>Lote:</label><label class="lote" id="lote"></label>
                <label>Fecha:</label><label class="fecha"></label>
                <label>Tamaño del Lote por presentación (kg):</label><label id="tamanol"></label>
                <label>Tamaño del lote total (kg):</label><label id="tamanolt"></label>
                <label>Unidades por Lote solicitadas:</label><label id="unidadesLote"></label>
            </div>
            <hr style="width: 95%;">
            <div class="group-info-batch p-3">
                <label for="">Autorizado por:</label>
                <label id="autorizado"> <b>Camilo Restrepo</b> </label>
            </div>
        </div>

    </div>
    </div>
    <!-- pesaje -->
    <h1 class="SaltoDePagina"> </h1>

    <div class="subtitleProcess"><label for=""> <b>PESAJE</b></label></div>

    <div class="card mt-3">
        <div class="card-header centrado"><b>2. DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
        <div class="card-body">
            <div class="group-despeje-pesaje p-3">
                <table class="table table-striped" id="despeje_linea2">
                    <thead class="head">
                        <tr>
                            <th scope="col" class="centrado">#</th>
                            <th scope="col" class="centrado">Parametros de Control</th>
                            <th scope="col" class="centrado">Si</th>
                            <th scope="col" class="centrado">No</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header centrado"><b>3. PESAJE Y DISPENSACIÓN</b></div>
        <div class="card-body">

            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label id="title1"></label>
                    <ul id="vinetas1">
                    </ul>
                </div>
            </div>

            <div class="subtitle"><label for="">3.1 Entrega de Materias Primas</label></div>

            <div class="table-responsive p-3">
                <table id="entregaMateriales" class="table table-striped table-condensed table-bordered">
                    <thead class="head">
                        <tr>
                            <td class="centrado">FECHA</td>
                            <td class="centrado">ENTREGA FORMULA MAESTRA PARA SOLICITUD DE MP</td>
                            <td class="centrado">LLEVA MATERIAS PRIMAS A LA ESCLUSA</td>
                            <td class="centrado">VERIFICACIÓN DEL ESTADO DE IDENTIFICACIÓN Y APROBACIÓN DE LAS MP</td>
                            <td class="centrado">TOMA DE MATERIAS PRIMAS DE LA ESCLUSA</td>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="centrado fecha"></td>
                        <td class="centrado">Director de Producción</td>
                        <td class="centrado">Operario de Pesaje</td>
                        <td class="centrado">Auxiliar de Calidad</td>
                        <td class="centrado">Operario Producción</td>
                    </tbody>
                </table>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label id="title2"></label>
                    <ul id="vinetas2">

                    </ul>
                </div>
            </div>

            <div class="subtitle">
                <label for="">3.2 Limpieza y Desinfección</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label id="title3"></label>
                    <ul id="vinetas3">

                    </ul>
                </div>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped" id="area_desinfeccion2">
                    <thead class="head">
                        <tr>
                            <td>Área/Equipo</td>
                            <td>Desinfectante</td>
                            <td>%</td>
                            <td>Número de Lote Anterior</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="subtitle">
                <label for="">3.3 Condiciones del Medio</label>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-striped table-bordered">
                    <thead class="head">
                        <tr>
                            <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                            <th colspan="2" class="centrado">Temperatura</th>
                            <th colspan="2" class="centrado">Humedad</th>
                        </tr>
                        <tr>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="centrado bold fecha_medio2" id="fecha_medio2"></td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado bold temperatura2" id="temperatura2"></td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado bold humedad2" id="humedad2"></td>
                    </tbody>
                </table>
            </div>
            <div class="subtitle">
                <label for="">3.4 Procedimiento de Pesaje</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">

                    <label id="title4"></label>
                    <ul id="vinetas4">

                    </ul>
                </div>

            </div>
            <div class="subtitle">
                <label for="">3.5 Devolucion de Materias primas por producto terminado</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label id="title5"></label>
                    <ul id="vinetas5">
                    </ul>
                </div>
            </div>

            <div class="firmas" id="firmas2">
                <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                <label id="fecha2" style="font-weight:bold; justify-self: baseline"></label>

                <div id="blank_rea2"></div>
                <img id="f_realizo2" src="" alt="firma_usuario" height="130">
                <div id="blank_ver2"></div>
                <img id="f_verifico2" src="" alt="firma_usuario" height="130">

                <label id="user_realizo2"></label>
                <label id="user_verifico2"></label>
            </div>

            <!-- fin pesaje -->

            <!-- Preparacion -->
            <h1 class="SaltoDePagina"> </h1>
            <div class="subtitleProcess"><label for=""> <b>PREPARACIÓN</b></label></div>

            <div class="card mt-3">
                <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
                <div class="card-body">
                    <div class="group-despeje-pesaje p-3">
                        <table class="table table-striped" id="despeje_linea3">
                            <thead class="head">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Parametros de Control</th>
                                    <th scope="col">Si</th>
                                    <th scope="col">No</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header centrado"><b>PREPARACIÓN</b></div>
                <div class="card-body">

                    <div class="subtitle">
                        <label for="">Limpieza y Desinfección</label>
                    </div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title6"></label>
                            <ul id="vinetas6">

                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped" id="area_desinfeccion3">
                            <thead class="head">
                                <tr>
                                    <td>Área/Equipo</td>
                                    <td>Desinfectante</td>
                                    <td>%</td>
                                    <td>Número de Lote Anterior</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Equipos</label></div>
                    <div class="equipos">
                        <label for="">Identificación Agitador</label>
                        <input type="text" class="form-control" id="agitador">
                        <label for="">Identificación Marmita o Tanque</label>
                        <input type="text" class="form-control" id="marmita">
                    </div>

                    <div class="subtitle"><label for="">4.2 Liberación de Agua Desionizada por parte de Calidad</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped">
                            <thead class="head">
                                <tr>
                                    <td>Parametros</td>
                                    <td>Cumple</td>
                                    <td>Observaciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="centrado">Color</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Conductividad 1</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Conductividad 2</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Cloro Libre</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Nitratos</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Dureza</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="firmas" id="firmas2">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha2" class="fecha2" style="font-weight:bold; justify-self: baseline"></label>
                            <label id="user_realizo2">Realizado por:</label>
                            <label id="user_verifico2">Verificado por:</label>
                            <img id="f_realizo7" src="../../../admin/assets/img/firmas/JUAN PABLO LLANO.jpg" alt="firma_usuario" height="130">
                            <img id="f_realizo7" src="../../../admin/assets/img/firmas/LUISA VILLA.jpg" alt="firma_usuario" height="130">
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-striped table-bordered">
                            <thead class="head">
                                <tr>
                                    <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                    <th colspan="2" class="centrado">Temperatura</th>
                                    <th colspan="2" class="centrado">Humedad</th>
                                </tr>
                                <tr>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="centrado bold fecha_medio3" id="fecha_medio3"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold temperatura3" id="temperatura3"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold humedad3" id="humedad3"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Procedimiento de Preparación</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title7"></label>
                            <ul id="vinetas7">
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="equipos">
                        <label for="">RPM del proceso</label>
                        <input type="text" class="form-control">
                        <label for="">Temperatura de preparación</label>
                        <input type="text" class="form-control">
                    </div> -->

                    <div class="subtitle"><label for="">Control del Proceso</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title8"></label>
                            <ul id="vinetas8">

                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped">
                            <thead class="head">
                                <tr>
                                    <td class="centrado">Parametros</td>
                                    <td class="centrado">Especificacion</td>
                                    <td class="centrado">Resultado</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="centrado">Color</td>
                                    <td class="centrado espec_color"></td>
                                    <td class="centrado color3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado espec_olor"></td>
                                    <td class="centrado olor3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado espec_apariencia"></td>
                                    <td class="centrado apariencia3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">PH</td>
                                    <td class="centrado espec_ph"></td>
                                    <td class="centrado ph3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Viscosidad (cps)</td>
                                    <td class="centrado espec_viscosidad"></td>
                                    <td class="centrado viscosidad3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                                    <td class="centrado espec_densidad"></td>
                                    <td class="centrado densidad3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Untuosidad</td>
                                    <td class="centrado espec_untuosidad"></td>
                                    <td class="centrado untuosidad3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Poder Espumoso</td>
                                    <td class="centrado espec_poder_espumoso"></td>
                                    <td class="centrado espumoso3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Grado de Alcohol</td>
                                    <td class="centrado espec_grado_alcohol"></td>
                                    <td class="centrado alcohol3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alertas" id="alert_pesaje">
                            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                                <label id="title9"></label>
                                <ul id="vinetas9">
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Ajustes</label></div>
                    <div class="ajustes">
                        <div class="resp">
                            <label for="">Si</label>
                            <input type="text" class="form-control centrado" id="Si3">
                            <label for="">No</label>
                            <input type="text" class="form-control centrado" id="No3">
                        </div>
                        <div class="obs mb-5">
                            <label for="">Materia(s) primas para adicionar </label>
                            <input type="textarea" class="form-control" id="materiaPrimaAjustes3">
                            <label for="">Procedimiento de Ajuste</label>
                            <input type="textarea" class="form-control" id="procedimientoAjustes3">
                        </div>

                    </div>

                </div>
                <div class="subtitle"><label for="">Almacenamiento Granel</label></div>
                <div class="alertas" id="alert_pesaje">
                    <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                        <label id="title10"></label>
                        <ul id="vinetas10">
                        </ul>
                    </div>
                </div>
                <div class="firmas" id="firmas3">
                    <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                    <label id="fecha3" style="font-weight:bold; justify-self: baseline"></label>

                    <div id="blank_rea3"></div>
                    <img id="f_realizo3" src="" alt="firma_usuario" height="130">
                    <div id="blank_ver3"></div>
                    <img id="f_verifico3" src="" alt="firma_usuario" height="130">

                    <label id="user_realizo3"></label>
                    <label id="user_verifico3"></label>
                </div>
            </div>
            <!-- fin preparación -->

            <!-- Aprobación -->
            <h1 class="SaltoDePagina"> </h1>
            <div class="subtitleProcess"><label for=""> <b>APROBACIÓN</b></label></div>

            <div class="card mt-3">
                <div class="card-header centrado"><b>5. APROBACIÓN CONTROL CALIDAD FISICOQUÍMICO PARA ENVASADO</b></div>
                <div class="alertas" id="alert_pesaje"></div>
                <div class="card-body">
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title11"></label>
                            <ul id="vinetas11">
                            </ul>
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Limpieza y Desinfección</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title12"></label>
                            <ul id="vinetas12">
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped" id="area_desinfeccion4">
                            <thead class="head">
                                <tr>
                                    <td>Área/Equipo</td>
                                    <td>Desinfectante</td>
                                    <td>%</td>
                                    <td>Número de Lote Anterior</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-striped table-bordered">
                            <thead class="head">
                                <tr>
                                    <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                    <th colspan="2" class="centrado">Temperatura</th>
                                    <th colspan="2" class="centrado">Humedad</th>
                                </tr>
                                <tr>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="centrado bold fecha_medio4" id="fecha_medio4"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold temperatura4" id="temperatura4"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold humedad4" id="humedad4"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Control del Proceso</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title13"></label>
                            <ul id="vinetas13">
                            </ul>
                        </div>
                    </div>
                    <div class="p-3">
                        <table class="table table-bordered table-striped">
                            <thead class="head">
                                <tr>
                                    <td class="centrado">Parametros</td>
                                    <td class="centrado">Especificacion</td>
                                    <td class="centrado">Resultado</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="centrado">Color</td>
                                    <td class="centrado espec_color"></td>
                                    <td class="centrado color4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado espec_olor"></td>
                                    <td class="centrado olor4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado espec_apariencia"></td>
                                    <td class="centrado apariencia4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">PH</td>
                                    <td class="centrado espec_ph"></td>
                                    <td class="centrado ph4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Viscosidad (cps)</td>
                                    <td class="centrado espec_viscosidad"></td>
                                    <td class="centrado viscosidad4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                                    <td class="centrado espec_densidad"></td>
                                    <td class="centrado densidad4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Untuosidad</td>
                                    <td class="centrado espec_untuosidad"></td>
                                    <td class="centrado untuosidad4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Poder Espumoso</td>
                                    <td class="centrado espec_poder_espumoso"></td>
                                    <td class="centrado espumoso4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Grado de Alcohol</td>
                                    <td class="centrado espec_grado_alcohol"></td>
                                    <td class="centrado alcohol4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label id="title14"></label>
                            <ul id="observacionesAprobacion"></ul>
                            <ul id="vinetas14">
                            </ul>

                        </div>
                    </div>


                    <div class="subtitle"><label for="">Ajustes</label></div>
                    <div class="ajustes">
                        <div class="resp">
                            <label for="">Si</label>
                            <input type="text" class="form-control centrado" id="Si4">
                            <label for="">No</label>
                            <input type="text" class="form-control centrado" id="No4">
                        </div>
                        <div class="obs mb-5">
                            <label for="">Materia(s) primas para adicionar </label>
                            <input type="textarea" class="form-control" id="materiaPrimaAjustes4">
                            <label for="">Procedimiento de Ajuste</label>
                            <input type="textarea" class="form-control" id="procedimientoAjustes4">
                        </div>

                    </div>
                    <div class="subtitle"><label for="">Cierre</label></div>
                    <div class="firmas" id="firmas4">
                        <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                        <label id="fecha4" style="font-weight:bold; justify-self: baseline"></label>

                        <div id="blank_rea4"></div>
                        <img id="f_realizo4" src="" alt="firma_usuario" height="130">
                        <div id="blank_ver4"></div>
                        <img id="f_verifico4" src="" alt="firma_usuario" height="130">

                        <label id="user_realizo4"></label>
                        <label id="user_verifico4"></label>
                    </div>
                </div>
            </div>
            <!-- fin aprobación -->

            <!-- Envasado -->
            <h1 class="SaltoDePagina"> </h1>

            <!-- <div id="multipresentacion1"> -->
            <div class="subtitleProcess"><label for="" id="titulo_envasado"> <b>ENVASADO</b></label></div>

            <div class="card mt-3">
                <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
                <div class="card-body">
                    <div class="group-despeje-pesaje p-3">
                        <table class="table table-striped" id="despeje_linea5">
                            <thead class="head">
                                <tr>
                                    <th scope="col" class="centrado">#</th>
                                    <th scope="col" class="centrado">Parametros de Control</th>
                                    <th scope="col" class="centrado">Si</th>
                                    <th scope="col" class="centrado">No</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header centrado"><b>6. ENVASADO</b></div>
                <div class="card-body">
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label class="" id="title15"></label>
                            <ul class="" id="vinetas15">
                            </ul>
                        </div>
                    </div>
                    <div class="subtitle">
                        <label for="">6.1 Limpieza y Desinfección</label>
                    </div>
                    <div class="p-3">
                        <table class="table table-bordered table-striped" id="area_desinfeccion5">
                            <thead class="head centrado">
                                <tr>
                                    <td class="centrado">Área/Equipo</td>
                                    <td class="centrado">Desinfectante</td>
                                    <td class="centrado">%</td>
                                    <td class="centrado">Número de Lote Anterior</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="multi-envasado1">
                        <div class="subtitleProcess" id="subtitle_envasado1"><label for="" id="titulo_envasado1"> <b></b></label></div>
                        <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
                        <div class="alertas" id="alert_pesaje">
                            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                                <label class="" id="title16"></label>
                                <ul class="" id="vinetas16">
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="envase1 centrado"></td>
                                        <td class="descripcion_envase1 centrado"></td>
                                        <td class="unidades1 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="tapa1 centrado"></td>
                                        <td class="descripcion_tapa1 centrado"></td>
                                        <td class="unidades1 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="etiqueta1 centrado"></td>
                                        <td class="descripcion_etiqueta1 centrado"></td>
                                        <td class="unidades1 centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Equipos</label></div>
                        <div class="envasadora">
                            <label for="">Identificacion Envasadora</label>
                            <input type="text" class="form-control envasadora" id="envasadora1">
                            <label for="">Identificacion Loteadora</label>
                            <input type="text" class="form-control loteadora" id="loteadora1">
                        </div>

                        <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-striped table-bordered">
                                <thead class="head">
                                    <tr>
                                        <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                        <th colspan="2" class="centrado">Temperatura</th>
                                        <th colspan="2" class="centrado">Humedad</th>
                                    </tr>
                                    <tr>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="centrado bold fecha_medio5" id="fecha_medio5"></td>
                                    <td class="centrado">18 - 25 °C</td>
                                    <td class="centrado bold temperatura5" id="temperatura5"></td>
                                    <td class="centrado">30 - 75 %</td>
                                    <td class="centrado bold humedad5" id="humedad5"></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
                        <div class="espec_tecnicas">
                            <label for="" class="centrado">Mínimo</label>
                            <input type="text" class="form-control centrado minimo1">
                            <label for="" class="centrado">Medio</label>
                            <input type="text" class="form-control centrado medio1">
                            <label for="" class="centrado">Máximo</label>
                            <input type="text" class="form-control centrado maximo1">
                        </div>

                        <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
                        <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
                        <div class="p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="muestrasEnvasado1"></table>
                            </div>

                            <div>
                                <label>Promedio</label>
                                <input type="text" class="form-control centrado" id="promedioMuestras1" style="width: 10%; display:inline">
                                <label class="ml-3">Cantidad de Muestras</label>
                                <input type="text" class="form-control centrado" id="cantidadMuestras1" style="width: 10%; display:inline">
                            </div>
                        </div>

                        <div class="subtitle"><label for="">Devolución Material de Empaque Sobrante</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped" id="devolucionMaterialSobrante1">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                        <td class="centrado">Envasada</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="envase1" class="envase1 refEmpaque1"></td>
                                        <td id="descripcion_envase1" class="descripcion_envase1"></td>
                                        <td id="unidades1" class="centrado unidades1"></td>
                                        <td id="usadaEnvase1" class="centrado txtEnvasada1"></td>
                                        <td id="averiasEnvase1" class="centrado"></td>
                                        <td id="sobranteEnvase1" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="tapa1" class="tapa1 refEmpaque1"></td>
                                        <td id="descripcion_tapa1" class="descripcion_tapa1"></td>
                                        <td id="unidades1" class="centrado unidades1"></td>
                                        <td id="usadaTapa1" class="centrado envasada1"></td>
                                        <td id="averiasTapa1" class="centrado"></td>
                                        <td id="sobranteTapa1" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="etiqueta1" class="etiqueta1 refEmpaque1"></td>
                                        <td id="descripcion_etiqueta1" class="descripcion_etiqueta1"></td>
                                        <td id="unidades1" class="centrado unidades1"></td>
                                        <td id="usadaEtiqueta1" class="centrado envasada1"></td>
                                        <td id="averiasEtiqueta1" class="centrado"></td>
                                        <td id="sobranteEtiqueta1" class="centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Cierre</label></div>
                        <div class="firmas" id="firmas5">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha5" style="font-weight:bold; justify-self: baseline"></label>

                            <div id="blank_rea5"></div>
                            <img id="f_realizo5" src="" alt="firma_usuario" height="130">
                            <div id="blank_ver5"></div>
                            <img id="f_verifico5" src="" alt="firma_usuario" height="130">

                            <label id="user_realizo5"></label>
                            <label id="user_verifico5"></label>
                        </div>
                    </div>
                    <div id="multi-envasado2">
                        <div class="subtitleProcess"><label for="" id="titulo_envasado2"> <b>ENVASADO</b></label></div>
                        <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
                        <div class="alertas" id="alert_pesaje">
                            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                                <label class="" id="title16"></label>
                                <ul class="" id="vinetas16">
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="envase2 centrado"></td>
                                        <td class="descripcion_envase2 centrado"></td>
                                        <td class="unidades2 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="tapa2 centrado"></td>
                                        <td class="descripcion_tapa2 centrado"></td>
                                        <td class="unidades2 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="etiqueta2 centrado"></td>
                                        <td class="descripcion_etiqueta2 centrado"></td>
                                        <td class="unidades2 centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Equipos</label></div>
                        <div class="envasadora">
                            <label for="">Identificacion Envasadora</label>
                            <input type="text" class="form-control envasadora" id="envasadora2">
                            <label for="">Identificacion Loteadora</label>
                            <input type="text" class="form-control loteadora" id="loteadora2">
                        </div>

                        <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-striped table-bordered">
                                <thead class="head">
                                    <tr>
                                        <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                        <th colspan="2" class="centrado">Temperatura</th>
                                        <th colspan="2" class="centrado">Humedad</th>
                                    </tr>
                                    <tr>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="centrado bold fecha_medio5" id="fecha_medio5"></td>
                                    <td class="centrado">18 - 25 °C</td>
                                    <td class="centrado bold temperatura5" id="temperatura5"></td>
                                    <td class="centrado">30 - 75 %</td>
                                    <td class="centrado bold humedad5" id="humedad5"></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
                        <div class="espec_tecnicas">
                            <label for="" class="centrado">Mínimo</label>
                            <input type="text" class="form-control centrado minimo2">
                            <label for="" class="centrado">Medio</label>
                            <input type="text" class="form-control centrado medio2">
                            <label for="" class="centrado">Máximo</label>
                            <input type="text" class="form-control centrado maximo2">
                        </div>

                        <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
                        <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
                        <div class="p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="muestrasEnvasado2"></table>
                            </div>

                            <div>
                                <label>Promedio</label>
                                <input type="text" class="form-control centrado" id="promedioMuestras2" style="width: 10%; display:inline">
                                <label class="ml-3">Cantidad de Muestras</label>
                                <input type="text" class="form-control centrado" id="cantidadMuestras2" style="width: 10%; display:inline">
                            </div>
                        </div>

                        <div class="subtitle"><label for="">Devolución Material de Empaque Sobrante</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped" id="devolucionMaterialSobrante2">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                        <td class="centrado">Envasada</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="envase2" class="envase1 refEmpaque2"></td>
                                        <td id="descripcion_envase2" class="descripcion_envase2"></td>
                                        <td id="unidades2" class="centrado unidades2"></td>
                                        <td id="usadaEnvase2" class="centrado txtEnvasada1"></td>
                                        <td id="averiasEnvase2" class="centrado"></td>
                                        <td id="sobranteEnvase2" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="tapa2" class="tapa2 refEmpaque2"></td>
                                        <td id="descripcion_tapa2" class="descripcion_tapa2"></td>
                                        <td id="unidades2" class="centrado unidades2"></td>
                                        <td id="usadaTapa2" class="centrado envasada2"></td>
                                        <td id="averiasTapa2" class="centrado"></td>
                                        <td id="sobranteTapa2" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="etiqueta2" class="etiqueta1 refEmpaque2"></td>
                                        <td id="descripcion_etiqueta2" class="descripcion_etiqueta2"></td>
                                        <td id="unidades2" class="centrado unidades2"></td>
                                        <td id="usadaEtiqueta2" class="centrado envasada2"></td>
                                        <td id="averiasEtiqueta2" class="centrado"></td>
                                        <td id="sobranteEtiqueta2" class="centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Cierre</label></div>
                        <div class="firmas" id="firmas2">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="multi_fecha2" style="font-weight:bold; justify-self: baseline"></label>

                            <div id="multi_blank_realizo2"></div>
                            <img id="multi_f_realizo2" src="" alt="firma_usuario" height="130">
                            <div id="multi_blank_verifico2"></div>
                            <img id="multi_f_verifico2" src="" alt="firma_usuario" height="130">

                            <label id="multi_user_realizo2"></label>
                            <label id="multi_user_verifico2"></label>
                        </div>
                    </div>
                    <div id="multi-envasado3">
                        <div class="subtitleProcess"><label for="" id="titulo_envasado3"> <b>ENVASADO</b></label></div>
                        <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
                        <div class="alertas" id="alert_pesaje">
                            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                                <label class="" id="title16"></label>
                                <ul class="" id="vinetas16">
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="envase3 centrado"></td>
                                        <td class="descripcion_envase3 centrado"></td>
                                        <td class="unidades3 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="tapa3 centrado"></td>
                                        <td class="descripcion_tapa3 centrado"></td>
                                        <td class="unidades3 centrado"></td>
                                    </tr>
                                    <tr>
                                        <td class="etiqueta3 centrado"></td>
                                        <td class="descripcion_etiqueta3 centrado"></td>
                                        <td class="unidades3 centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Equipos</label></div>
                        <div class="envasadora">
                            <label for="">Identificacion Envasadora</label>
                            <input type="text" class="form-control envasadora" id="envasadora3">
                            <label for="">Identificacion Loteadora</label>
                            <input type="text" class="form-control loteadora" id="loteadora3">
                        </div>

                        <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-striped table-bordered">
                                <thead class="head">
                                    <tr>
                                        <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                        <th colspan="2" class="centrado">Temperatura</th>
                                        <th colspan="2" class="centrado">Humedad</th>
                                    </tr>
                                    <tr>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                        <th class="centrado">Especificaciones</th>
                                        <th class="centrado">lectura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="centrado bold fecha_medio5" id="fecha_medio5"></td>
                                    <td class="centrado">18 - 25 °C</td>
                                    <td class="centrado bold temperatura5" id="temperatura5"></td>
                                    <td class="centrado">30 - 75 %</td>
                                    <td class="centrado bold fecha_medio5" id="humedad5"></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
                        <div class="espec_tecnicas">
                            <label for="" class="centrado">Mínimo</label>
                            <input type="text" class="form-control centrado minimo3">
                            <label for="" class="centrado">Medio</label>
                            <input type="text" class="form-control centrado medio3">
                            <label for="" class="centrado">Máximo</label>
                            <input type="text" class="form-control centrado maximo3">
                        </div>

                        <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
                        <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
                        <div class="p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="muestrasEnvasado3"></table>
                            </div>

                            <div>
                                <label>Promedio</label>
                                <input type="text" class="form-control centrado" id="promedioMuestras3" style="width: 10%; display:inline">
                                <label class="ml-3">Cantidad de Muestras</label>
                                <input type="text" class="form-control centrado" id="cantidadMuestras3" style="width: 10%; display:inline">
                            </div>
                        </div>

                        <div class="subtitle"><label for="">Devolución Material de Empaque Sobrante</label></div>
                        <div class="alertas" id="alert_pesaje"></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped" id="devolucionMaterialSobrante3">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                        <td class="centrado">Envasada</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="envase3" class="envase3 refEmpaque3"></td>
                                        <td id="descripcion_envase3" class="descripcion_envase3"></td>
                                        <td id="unidades3" class="centrado unidades3"></td>
                                        <td id="usadaEnvase3" class="centrado txtEnvasada3"></td>
                                        <td id="averiasEnvase3" class="centrado"></td>
                                        <td id="sobranteEnvase3" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="tapa3" class="tapa1 refEmpaque3"></td>
                                        <td id="descripcion_tapa3" class="descripcion_tapa3"></td>
                                        <td id="unidades3" class="centrado unidades3"></td>
                                        <td id="usadaTapa3" class="centrado envasada3"></td>
                                        <td id="averiasTapa3" class="centrado"></td>
                                        <td id="sobranteTapa3" class="centrado"></td>
                                    </tr>
                                    <tr>
                                        <td id="etiqueta3" class="etiqueta1 refEmpaque3"></td>
                                        <td id="descripcion_etiqueta3" class="descripcion_etiqueta3"></td>
                                        <td id="unidades3" class="centrado unidades3"></td>
                                        <td id="usadaEtiqueta3" class="centrado envasada3"></td>
                                        <td id="averiasEtiqueta3" class="centrado"></td>
                                        <td id="sobranteEtiqueta3" class="centrado"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label for="">Cierre</label></div>
                        <div class="firmas" id="firmas3">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="multi_fecha3" style="font-weight:bold; justify-self: baseline"></label>

                            <div id="multi_blank_realizo3"></div>
                            <img id="multi_f_realizo3" src="" alt="firma_usuario" height="130">
                            <div id="multi_blank_verifico3"></div>
                            <img id="multi_f_verifico3" src="" alt="firma_usuario" height="130">

                            <label id="multi_user_realizo3">Sin Firmar</label>
                            <label id="multi_user_verifico3">Sin Firmar</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin envasado -->

            <!-- Acondicionamiento -->
            <h1 class="SaltoDePagina"> </h1>
            <div class="subtitleProcess"><label><b>ACONDICIONAMIENTO</b></label></div>
            <div class="card mt-3">
                <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
                <div class="card-body">
                    <div class="group-despeje-pesaje p-3">
                        <table class="table table-striped" id="despeje_linea6">
                            <thead class="head">
                                <tr>
                                    <th scope="col" class="centrado">#</th>
                                    <th scope="col" class="centrado">Parametros de Control</th>
                                    <th scope="col" class="centrado">Si</th>
                                    <th scope="col" class="centrado">No</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header centrado"><b>LOTEADO Y ACONDICIONAMIENTO</b></div>
                <div class="card-body">
                    <div class="subtitle">
                        <label for="">Limpieza y Desinfección</label>
                    </div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label class="" id="title17"></label>
                            <ul class="" id="vinetas17">
                            </ul>
                        </div>
                    </div>
                    <div class="p-3">
                        <table class="table table-bordered table-striped" id="area_desinfeccion6">
                            <thead class="head centrado">
                                <tr>
                                    <td class="centrado">Área/Equipo</td>
                                    <td class="centrado">Desinfectante</td>
                                    <td class="centrado">%</td>
                                    <td class="centrado">Número de Lote Anterior</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="subtitle">
                        <label for="">Recepción de Material de Acondicionamiento</label>
                    </div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label class="" id="title18"></label>
                            <ul class="" id="vinetas18">
                            </ul>
                        </div>
                    </div>
                    <div class="subtitle"><label for="">Equipos</label></div>
                    <div class="equipos">
                        <label for="">Banda Transportadora</label>
                        <input type="text" class="form-control" id="banda">
                        <label for="">Etiqueadora</label>
                        <input type="text" class="form-control" id="etiquetadora">
                        <label for="">Tunel</label>
                        <input type="text" class="form-control" id="tunel">
                    </div>

                    <div class="subtitle"><label for="">Condiciones del Medio</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-striped table-bordered">
                            <thead class="head">
                                <tr>
                                    <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                                    <th colspan="2" class="centrado">Temperatura</th>
                                    <th colspan="2" class="centrado">Humedad</th>
                                </tr>
                                <tr>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                    <th class="centrado">Especificaciones</th>
                                    <th class="centrado">lectura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="centrado bold fecha_medio6" id="fecha_medio6"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold temperatura6" id="temperatura6"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold humedad6" id="humedad6"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Control de Proceso</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label class="" id="title19"></label>
                            <ul class="" id="vinetas19">
                            </ul>
                        </div>
                    </div>
                    <div class="p-3 proceso">
                        <label for="">Producto</label><label for="" class="ref" style="font-weight: bold;"></label>
                        <label for="">Lote</label><label for="" class="lote"></label>
                        <label for="">Fecha</label><label for="" class="fecha"></label>
                        <label for="">Orden</label><label for="" class="orden"></label>
                    </div>

                    <div class="enlinea mt-3">
                        <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                        <label id="fecha6" style="font-weight:bold; justify-self: baseline">22/05/2020</label>
                    </div>

                    <div class="firmas" id="firmas5">
                        <img id="f_realizo6" src="" alt="firma_usuario" height="130">
                        <img id="f_verifico6" src="" alt="firma_usuario" height="130">
                        <label id="user_realizo6"></label>
                        <label id="user_verifico6"></label>
                    </div>


                    <div id="multi-acondicionamiento1">
                        <div class="subtitleProcess" id="subtitle_acond1"><label for="" id="titulo_acondicionamiento1"> <b>ACONDICIONAMIENTO</b></label></div>
                        <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Fecha</td>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="empaque1" class="centrado empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="unidades1e" class="centrado unidades1"></td>
                                    </tr>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="otros1" class="centrado otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades4" class="centrado unidades1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Control de Proceso</label></div>

                        <div class="p-3">
                            <table class="table table-bordered table-striped" id="muestrasAcondicionamiento1">
                                <thead class="head">
                                    <tr>
                                        <th colspan="1" class="centrado">Muestra</th>
                                        <th colspan="1" class="centrado">APARIENCIA ETIQUETA (Arrugas, quiebres, sucios, alineada,dherencia)</th>
                                        <th colspan="1" class="centrado">APARIENCIA TERMOENCOGIBLE</th>
                                        <th colspan="1" class="centrado">APARIENCIA LOTE</th>
                                        <th colspan="1" class="centrado">CUMPLIMIENTO UNIDAD DE EMPAQUE Y POSICIÓN DENTRO DE LA CAJA</th>
                                        <th colspan="1" class="centrado">RÓTULO DE LA CAJA</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Devolución Insumos de Acondicionamiento</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Recibida</td>
                                        <td class="centrado">Utilizadas</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                        <!-- <td class="centrado">Total</td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="refempaque1" class="empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="empaque_unidades1" class="centrado unidades1"></td>
                                        <td id="utilizada_empaque1" class="centrado envasada1" style="width: 110px;"></td>
                                        <td id="averias_empaque1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_empaque1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                                    </tr>
                                    <tr>
                                        <td id="refempaque2" class="otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades8" class="centrado unidades1"></td>
                                        <td id="utilizada_otros1" class="centrado envasada1e" style="width: 110px;"></td>
                                        <td id="averias_otros1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_otros1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label>Conciliación de rendimiento</label></div>
                        <div class="conciliacion">
                            <label style="justify-self: end;">Conciliacion rendimiento</label>
                            <input type="text" class="form-control centrado" id="conciliacionRendimiento1" style="width: 30%;justify-self: baseline" readonly>
                        </div>

                        <div class="enlinea mt-3">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha6" style="font-weight:bold; justify-self: baseline"></label>
                        </div>

                        <div class="col1" id="firmas6">
                            <img id="f_realizoConciliacion" src="" alt="firma_usuario" height="130">
                            <label id="user_realizoConciliacion"></label>
                        </div>
                    </div>
                    <div id="multi-acondicionamiento2">
                        <div class="subtitleProcess"><label for="" id="titulo_acondicionamiento2"> <b>ACONDICIONAMIENTO</b></label></div>
                        <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Fecha</td>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="empaque1" class="centrado empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="unidades1e" class="centrado unidades1e"></td>
                                    </tr>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="otros1" class="centrado otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades4" class="centrado unidades1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Control de Proceso</label></div>

                        <div class="p-3">
                            <table class="table table-bordered table-striped" id="muestrasAcondicionamiento1">
                                <thead class="head">
                                    <tr>
                                        <th colspan="1" class="centrado">Muestra</th>
                                        <th colspan="1" class="centrado">APARIENCIA ETIQUETA (Arrugas, quiebres, sucios, alineada,dherencia)</th>
                                        <th colspan="1" class="centrado">APARIENCIA TERMOENCOGIBLE</th>
                                        <th colspan="1" class="centrado">APARIENCIA LOTE</th>
                                        <th colspan="1" class="centrado">CUMPLIMIENTO UNIDAD DE EMPAQUE Y POSICIÓN DENTRO DE LA CAJA</th>
                                        <th colspan="1" class="centrado">RÓTULO DE LA CAJA</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Devolución Insumos de Acondicionamiento</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Recibida</td>
                                        <td class="centrado">Utilizadas</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                        <!-- <td class="centrado">Total</td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="refempaque1" class="empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="unidades2e" class="centrado unidades1e"></td>
                                        <td id="utilizada_empaque1" class="centrado envasada1e" style="width: 110px;"></td>
                                        <td id="averias_empaque1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_empaque1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                                    </tr>
                                    <tr>
                                        <td id="refempaque2" class="otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades8" class="centrado unidades1"></td>
                                        <td id="utilizada_otros1" class="centrado envasada1e" style="width: 110px;"></td>
                                        <td id="averias_otros1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_otros1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label>Conciliación de rendimiento</label></div>
                        <div class="conciliacion">
                            <label style="justify-self: end;">Conciliacion rendimiento</label>
                            <input type="text" class="form-control centrado" id="conciliacionRendimiento1" style="width: 30%;justify-self: baseline" readonly>
                        </div>

                        <div class="enlinea mt-3">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha6" style="font-weight:bold; justify-self: baseline"></label>
                        </div>

                        <div class="col1" id="firmas6">
                            <img id="f_realizoConciliacion" src="" alt="firma_usuario" height="130">
                            <label id="user_realizoConciliacion"></label>
                        </div>
                    </div>
                    <div id="multi-acondicionamiento3">
                        <div class="subtitleProcess"><label for="" id="titulo_acondicionamiento3"> <b>ACONDICIONAMIENTO</b></label></div>
                        <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Fecha</td>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Cantidad</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="empaque1" class="centrado empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="unidades1e" class="centrado unidades1e"></td>
                                    </tr>
                                    <tr>
                                        <td id="fecha1" class="centrado empaque1"></td>
                                        <td id="otros1" class="centrado otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades4" class="centrado unidades1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Control de Proceso</label></div>

                        <div class="p-3">
                            <table class="table table-bordered table-striped" id="muestrasAcondicionamiento1">
                                <thead class="head">
                                    <tr>
                                        <th colspan="1" class="centrado">Muestra</th>
                                        <th colspan="1" class="centrado">APARIENCIA ETIQUETA (Arrugas, quiebres, sucios, alineada,dherencia)</th>
                                        <th colspan="1" class="centrado">APARIENCIA TERMOENCOGIBLE</th>
                                        <th colspan="1" class="centrado">APARIENCIA LOTE</th>
                                        <th colspan="1" class="centrado">CUMPLIMIENTO UNIDAD DE EMPAQUE Y POSICIÓN DENTRO DE LA CAJA</th>
                                        <th colspan="1" class="centrado">RÓTULO DE LA CAJA</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="subtitle"><label for="">Devolución Insumos de Acondicionamiento</label></div>
                        <div class="table-responsive p-3">
                            <table class="table table-bordered table-striped">
                                <thead class="head centrado">
                                    <tr>
                                        <td class="centrado">Referencia</td>
                                        <td class="centrado">Descripción</td>
                                        <td class="centrado">Recibida</td>
                                        <td class="centrado">Utilizadas</td>
                                        <td class="centrado">Averias</td>
                                        <td class="centrado">Sobrante</td>
                                        <!-- <td class="centrado">Total</td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="refempaque1" class="empaque1"></td>
                                        <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                                        <td id="unidades2e" class="centrado unidades1e"></td>
                                        <td id="utilizada_empaque1" class="centrado envasada1e" style="width: 110px;"></td>
                                        <td id="averias_empaque1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_empaque1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                                    </tr>
                                    <tr>
                                        <td id="refempaque2" class="otros1"></td>
                                        <td id="descripcion_otros1" class="descripcion_otros1"></td>
                                        <td id="unidades8" class="centrado unidades1"></td>
                                        <td id="utilizada_otros1" class="centrado envasada1e" style="width: 110px;"></td>
                                        <td id="averias_otros1" class="centrado" style="width: 110px;"></td>
                                        <td id="sobrante_otros1" class="centrado" style="width: 110px;"></td>
                                        <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtitle"><label>Conciliación de rendimiento</label></div>
                        <div class="conciliacion">
                            <label style="justify-self: end;">Conciliacion rendimiento</label>
                            <input type="text" class="form-control centrado" id="conciliacionRendimiento2" style="width: 30%;justify-self: baseline" readonly>
                        </div>

                        <div class="enlinea mt-3">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha6" style="font-weight:bold; justify-self: baseline"></label>
                        </div>

                        <div class="col1" id="firmas6">
                            <img id="f_realizoConciliacion" src="" alt="firma_usuario" height="130">
                            <label id="user_realizoConciliacion"></label>
                        </div>
                    </div>
                    <!-- fin acondicionamiento -->

                    <!-- inicio despachos -->
                    <h1 class="SaltoDePagina"> </h1>
                    <div class="subtitleProcess"><label for=""> <b>DESPACHOS</b></label></div>
                    <div class="subtitle"><label>Almacen Despachos</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                            <label class="" id="title20"></label>
                            <ul class="" id="vinetas20">
                            </ul>
                        </div>
                    </div>
                    <div class="despachos">
                        <label for="">Entregó:</label><label for=""><b>JEFE DE PRODUCCIÓN</b></label>
                        <label for="">Recibió:</label><label for=""><b>AUX ALMACEN PRODUCTO TERMINADO</b></label>
                    </div>

                    <div class="enlinea">
                        <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                        <label id="fecha7" style="font-weight:bold; justify-self: baseline"></label>
                    </div>

                    <div class="col1 mt-5" id="firmas7">
                        <img id="f_entrego" src="" alt="firma_usuario" height="130">
                        <label id="user_entrego"></label>
                    </div>
                </div>
            </div>
            <!-- </div> -->

            <!-- fin despachos -->
            <!-- Inicio Microbiologia -->
            <h1 class="SaltoDePagina"> </h1>

            <div class="subtitleProcess"><label for=""> <b>MICROBIOLOGIA</b></label></div>
            <div class="subtitle"><label for="">Toma de muestras para análisis</label></div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label class="" id="title21"></label>
                    <ul class="" id="vinetas21">
                    </ul>
                </div>
            </div>
            <div class="subtitle"><label>Limpieza y Desinfección</label></div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label class="" id="title22"></label>
                    <ul class="" id="vinetas22">
                    </ul>
                </div>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped" id="area_desinfeccion8">
                    <thead class="head">
                        <tr>
                            <td>Área/Equipo</td>
                            <td>Desinfectante</td>
                            <td>%</td>
                            <td>Número de Lote Anterior</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label>Equipos</label></div>
            <div class="col2">
                <label for="">Identificación Incubadora</label>
                <input type="text" class="form-control" id="incubadora">
                <label for="">Identificación del Autoclave</label>
                <input type="text" class="form-control" id="autoclave">
                <label for="">Identificación de la cabina de Flujo de Laminar</label>
                <input type="text" class="form-control" id="cabina">
            </div>
            <div class="subtitle">
                <label for="">3.3 Condiciones del Medio</label>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-striped table-bordered">
                    <thead class="head">
                        <tr>
                            <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                            <th colspan="2" class="centrado">Temperatura</th>
                            <th colspan="2" class="centrado">Humedad</th>
                        </tr>
                        <tr>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="centrado bold fecha_medio8" id="fecha_medio8"></td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado bold temperatura8" id="temperatura8"></td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado bold humedad8" id="humedad8"></td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Análisis Microbiologico</label></div>

            <div class="table-responsive p-3">
                <table class="table table-striped table-bordered">
                    <thead class="head">
                        <tr>
                            <th class="centrado" style="vertical-align: middle;">Análisis</th>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">Método</th>
                            <th class="centrado">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="centrado">Recuento de Mesófilos Aerobios Totales</td>
                            <td class="centrado bold" id="espec1"></td>
                            <td class="centrado">Siembra Total</td>
                            <td class="centrado bold" id="mesofilos"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Pseudomona Aeruginosa</td>
                            <td class="centrado bold" id="espec2"></td>
                            <td class="centrado">Siembra Total</td>
                            <td class="centrado bold" id="pseudomona"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Escherichia Coli y Coliformes Totales</td>
                            <td class="centrado bold" id="espec3"></td>
                            <td class="centrado">Siembra Total</td>
                            <td class="centrado bold" id="escherichia"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Staphylococcus Aureus</td>
                            <td class="centrado bold" id="espec4"></td>
                            <td class="centrado">Siembra Total</td>
                            <td class="centrado bold" id="staphylococcus"></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="col4">
                <label for="">Fecha Siembra</label>
                <input type="text" class="form-control" id="fsiembra">
                <label for="">Fecha Resultados</label>
                <input type="text" class="form-control" id="fresultados">
            </div>

            <div class="marco m-5">
                <div class="col2sm m-3">
                    <label for="">Aprobado</label>
                    <label for="">Rechazado</label>
                    <input class="chkAprobado" type="checkbox" name="chkAprobado" id="chkAprobado">
                    <input class="chkRechazado" type="checkbox" name="chkRechazado" id="chkRechazado">
                </div>
            </div>

            <div class="enlinea">
                <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                <label id="fecha8" style="font-weight:bold; justify-self: baseline">22/05/2020</label>
            </div>

            <div class="firmas" id="firmas5">
                <div id="blank_rea8"></div>
                <img id="f_realizoMicro" src="" alt="firma_usuario" height="130">
                <div id="blank_ver8"></div>
                <img id="f_verificoMicro1" src="" alt="firma_usuario" height="130">

                <label id="user_realizoMicro"></label>
                <label id="user_verificoMicro1"></label>
            </div>

            <!-- Fin Microbiologia -->

            <!-- Inicio Fisicoquimico -->
            <h1 class="SaltoDePagina"> </h1>

            <div class="subtitleProcess"><label for=""> <b>FISICOQUIMICO</b></label></div>
            <div class="subtitle"><label for="">Toma de Muestra</label></div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label class="" id="title23"></label>
                    <ul class="" id="vinetas23"></ul>
                </div>
            </div>
            <div class="subtitle"><label for="">Limpieza y Desinfección</label></div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label class="" id="title24"></label>
                    <ul class="" id="vinetas24"></ul>
                </div>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped" id="area_desinfeccion9">
                    <thead class="head">
                        <tr>
                            <td>Área/Equipo</td>
                            <td>Desinfectante</td>
                            <td>%</td>
                            <td>Número de Lote Anterior</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="subtitle">
                <label for="">3.3 Condiciones del Medio</label>
            </div>
            <div class="table-responsive p-3">
                <table class="table table-striped table-bordered">
                    <thead class="head">
                        <tr>
                            <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha y Hora</th>
                            <th colspan="2" class="centrado">Temperatura</th>
                            <th colspan="2" class="centrado">Humedad</th>
                        </tr>
                        <tr>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                            <th class="centrado">Especificaciones</th>
                            <th class="centrado">lectura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="centrado bold fecha_medio9" id="fecha_medio9"></td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado bold temperatura9" id="temperatura9"></td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado bold humedad9" id="humedad9"></td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Análisis Fisicoquimico</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped">
                    <thead class="head">
                        <tr>
                            <td class="centrado">Parametros</td>
                            <td class="centrado">Especificacion</td>
                            <td class="centrado">Resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="centrado">Color</td>
                            <td class="centrado espec_color"></td>
                            <td class="centrado color9"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Olor</td>
                            <td class="centrado espec_olor"></td>
                            <td class="centrado olor9"></td>

                        </tr>
                        <tr>
                            <td class="centrado">Apariencia</td>
                            <td class="centrado espec_apariencia"></td>
                            <td class="centrado apariencia9"></td>

                        </tr>
                        <tr>
                            <td class="centrado">PH</td>
                            <td class="centrado espec_ph"></td>
                            <td class="centrado ph9"></td>

                        </tr>
                        <tr>
                            <td class="centrado">Viscosidad (cps)</td>
                            <td class="centrado espec_viscosidad"></td>
                            <td class="centrado viscosidad9"></td>

                        </tr>
                        <tr>
                            <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                            <td class="centrado espec_densidad"></td>
                            <td class="centrado densidad9"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Untuosidad</td>
                            <td class="centrado espec_untuosidad"></td>
                            <td class="centrado untuosidad9"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Poder Espumoso</td>
                            <td class="centrado espec_poder_espumoso"></td>
                            <td class="centrado espumoso9"></td>
                        </tr>
                        <tr>
                            <td class="centrado">Grado de Alcohol</td>
                            <td class="centrado espec_grado_alcohol"></td>
                            <td class="centrado alcohol9"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Ajustes</label></div>
            <div class="ajustes">
                <div class="resp">
                    <label for="">Si</label>
                    <input type="text" class="form-control centrado" id="Si9">
                    <label for="">No</label>
                    <input type="text" class="form-control centrado" id="No9">
                </div>
                <div class="obs mb-5">
                    <label for="">Materia(s) primas para adicionar </label>
                    <input type="textarea" class="form-control" id="materiaPrimaAjustes9">
                    <label for="">Procedimiento de Ajuste</label>
                    <input type="textarea" class="form-control" id="procedimientoAjustes9">
                </div>
            </div>

            <div class="subtitle">Resultado</div>

            <div class="marco m-5">
                <div class="col2sm m-3">
                    <label for="">Aprobado</label>
                    <label for="">Rechazado</label>
                    <input class="chkAprobado" type="checkbox" name="chkAprobado" id="chkAprobado">
                    <input class="chkRechazado" type="checkbox" name="chkRechazado" id="chkRechazado">
                </div>
            </div>

            <div class="enlinea">
                <label class="mr-3 fechaHora" style="justify-self: end;">Fecha y hora</label>
                <label id="fecha9" style="font-weight:bold; justify-self: baseline"></label>
            </div>

            <div class="firmas" id="firmas5">
                <div id="blank_rea9"></div>
                <img id="f_realizo9" src="" alt="firma_usuario" height="130">
                <div id="blank_ver9"></div>
                <img id="f_verifico9" src="" alt="firma_usuario" height="130">
                <label id="user_realizo9"></label>
                <label id="user_verifico9"></label>
            </div>

            <!-- Fin Fisicoquimico -->

            <!-- inicio liberacion Lote -->
            <h1 class="SaltoDePagina"> </h1>

            <div class="subtitleProcess"><label for=""> <b>LIBERACIÓN LOTE</b></label></div>
            <div class="m-3 ml-3 mb-5">
                <div class="col3">
                    <label for="" class="item1">* Revisión general de la información registrada en el Batch Record corroborando que el producto se encuentra en optimas condiciones para ser liberado y autorizada su comercialización.
                        ¿El producto está apto para liberar?</label>
                    <label for="">SI</label>
                    <label for="">NO</label>
                    <label for="" id="LiberacionSi"></label>
                    <label for="" id="LiberacionNo"></label>
                </div>
                <div>
                    <label for="">Observaciones</label>
                    <label for=""></label>
                </div>

                <div class="enlinea">
                    <label class="mr-3 fechaHoraLiberacion" style="justify-self: end;">Fecha y hora</label>
                    <label id="fecha10" style="font-weight:bold; justify-self: baseline"></label>
                </div>

                <div class="coln3 mt-5" id="firmas5">
                    <div id="blank_prod"></div>
                    <img id="f_realizoPRO" src="" alt="firma_usuario" height="130">
                    <div id="blank_cal"></div>
                    <img id="f_realizoCA" src="" alt="firma_usuario" height="130">
                    <div id="blank_tec"></div>
                    <img id="f_realizoTEC" src="" alt="firma_usuario" height="130">
                    <label id="dirNameProd" class="col-form-label"></label>
                    <label id="dirNameCa" class="col-form-label"></label>
                    <label id="dirNameTec" class="col-form-label"></label>

                    <label for="">Director de Producción</label>
                    <label for="">Director de Calidad</label>
                    <label for="">Director Técnico</label>
                </div>
            </div>
            <!-- fin liberacion lote  -->
        </div>
    </div>


    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../html/vendor/datatables/datatables.min.js" type="text/javascript"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../html/js/utils/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../html/js/utils/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../html/js/utils/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="https://use.fontawesome.com/15242848ba.js"></script>
    <script src="js/batch_pdf.js"></script>
    <script src="js/printThis.js"></script>

</body>

</html>