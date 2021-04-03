<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pfd | Batch Record</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icon/favicon.png">
    <title>Samara Cosmetics</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style_pdf.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">

</head>

<body id="pdf">

    <div class="mb-3">
        <a><span><img src="img/logo-samara.png" style="width: 15%;" class="light-logo" alt="Samara Cosmetics" /></span></a>
    </div>

    <div>
        <a href='#' <i class='fa fa-print fa-2x link-imprimir flotante' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>
        <a href='#' <i class='fa fa-times-circle fa-2x link-cerrar flotante position' data-toggle='tooltip' title='Cerrar ventana' style='color:red;'></i></a>
    </div>


    <div class="card">
        <div class="card-header centrado"><b>1. INFORMACIÓN DEL PRODUCTO</b></div>
        <div class="card-body">
            <div class="group-info-ref p-3">
                <label>Referencia:</label>
                <label class="bold" id="ref"></label>
                <label>Nombre Referencia:</label>
                <label id="nref"></label>
                <label>Marca:</label>
                <label id="marca"></label>
                <label>Propietario:</label>
                <label id="propietario"></label>
                <label>Notificación Sanitaria:</label>
                <label id="notificacion"></label>
                <label>Presentación Comercial:</label>
                <label id="presentacion"></label>
            </div>
            <hr style="width: 95%;">
            <div class="group-info-batch p-3">

                <label>Orden de Producción:</label>
                <label id="orden"></label>
                <label>Lote:</label>
                <label id="lote"></label>
                <label>Fecha:</label>
                <label class="fecha"></label>
                <!-- <label for="">Tamaño del producto</label>
                <input type="text" class="form-control centrado" id="tamanop"> -->
                <label>Tamaño del Lote por presentación (kg):</label>
                <label id="tamanol"></label>
                <label>Tamaño del lote total (kg):</label>
                <label id="tamanolt"></label>
                <label>Unidades por Lote solicitadas:</label>
                <label id="unidades"></label>
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
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <label id="title1"></label>
                    <ul id="vinetas1">

                    </ul>
                </div>
            </div>

            <div class="subtitle"><label for="">3.1 Entrega de Materias Primas</label></div>

            <div class="table-responsive p-3">
                <table class="table table-striped table-condensed table-bordered">
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
                        <td class="centrado">Director de Produccion</td>
                        <td class="centrado">Operario de Pesaje</td>
                        <td class="centrado">Calidad</td>
                        <td class="centrado">Operario Produccion</td>
                    </tbody>
                </table>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <label id="title2"></label>
                    <ul id="vinetas2">

                    </ul>
                </div>
            </div>

            <div class="subtitle">
                <label for="">3.2 Limpieza y Desinfección</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                            <td>Número de Lote</td>
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
                        <td class="centrado bold" id="fecha_medio2"></td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado bold" id="temperatura2"></td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado bold" id="humedad2"></td>
                    </tbody>
                </table>
            </div>
            <div class="subtitle">
                <label for="">3.4 Procedimiento de Pesaje</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <label id="title4"></label>
                    <ul id="vinetas4">

                    </ul>
                </div>

            </div>
            <div class="subtitle">
                <label for="">3.5 Devolucion de Materias primas por producto terminado</label>
            </div>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td>Número de Lote</td>
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
                        <label for="">Identificación Marmita o Taque</label>
                        <input type="text" class="form-control" id="marmita">
                    </div>

                    <div class="subtitle"><label for="">4.2 Liberación de Agua Desionizada por parte de Calidad</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped">
                            <thead class="head">
                                <tr>
                                    <td>Fecha</td>
                                    <td>Parametros</td>
                                    <td>Cumple</td>
                                    <td>Observaciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Color</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Conductividad 1</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Conductividad 2</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Cloro Libre</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Nitratos</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">05/02/2020</td>
                                    <td class="centrado">Dureza</td>
                                    <td class="centrado">Si</td>
                                    <td class="centrado"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="firmas" id="firmas2">
                            <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                            <label id="fecha2" style="font-weight:bold; justify-self: baseline"></label>

                            <!-- <div id="blank_rea2"></div> -->
                            <!-- <img id="f_realizo2" src="" alt="firma_usuario" height="130"> -->
                            <!-- <div id="blank_ver2"></div> -->
                            <!-- <img id="f_verifico2" src="" alt="firma_usuario" height="130"> -->

                            <label id="user_realizo2">Realizado por:</label>
                            <label id="user_verifico2">Verificado por:</label>
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
                                <td class="centrado bold" id="fecha_medio3"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold" id="temperatura3"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold" id="humedad3"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Procedimiento de Preparación</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td class="centrado" id="espec_color"></td>
                                    <td class="centrado color3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado" id="espec_olor"></td>
                                    <td class="centrado olor3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado" id="espec_apariencia"></td>
                                    <td class="centrado apariencia3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">PH</td>
                                    <td class="centrado" id="espec_ph"></td>
                                    <td class="centrado ph3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Viscosidad (cps)</td>
                                    <td class="centrado" id="espec_viscidad"></td>
                                    <td class="centrado viscosidad3"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                                    <td class="centrado" id="espec_densidad"></td>
                                    <td class="centrado densidad3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Untuosidad</td>
                                    <td class="centrado" id="espec_untosidad"></td>
                                    <td class="centrado untuosidad3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Poder Espumoso</td>
                                    <td class="centrado" id="espec_poder_espumoso"></td>
                                    <td class="centrado espumoso3"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Grado de Alcohol</td>
                                    <td class="centrado" id="espec_grado_alcohol"></td>
                                    <td class="centrado alcohol3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alertas" id="alert_pesaje">
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                            <input type="text" class="form-control">
                            <label for="">No</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="obs mb-5">
                            <label for="">Materia(s) primas para adicionar </label>
                            <input type="textarea" class="form-control">
                            <label for="">Procedimiento de Ajuste</label>
                            <input type="textarea" class="form-control">
                        </div>

                    </div>

                </div>
                <div class="subtitle"><label for="">Almacenamiento Granel</label></div>
                <div class="alertas" id="alert_pesaje">
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
            <div class="subtitleProcess"><label for=""> <b>APROBACIÓN</b></label></div>

            <div class="card mt-3">
                <div class="card-header centrado"><b>5. APROBACIÓN CONTROL CALIDAD FISICOQUÍMICO PARA ENVASADO</b></div>
                <div class="alertas" id="alert_pesaje"></div>
                <div class="card-body">
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <label id="title11"></label>
                            <ul id="vinetas11">
                            </ul>
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Limpieza y Desinfección</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td>Número de Lote</td>
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
                                <td class="centrado bold" id="fecha_medio4"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold" id="temperatura4"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold" id="humedad4"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Control del Proceso</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td class="centrado">Conforme al estándar</td>
                                    <td class="centrado color4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Olor</td>
                                    <td class="centrado">Conforme al estándar, con adición de fragancia</td>
                                    <td class="centrado olor4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Apariencia</td>
                                    <td class="centrado">Líquido viscoso homogéneo, libre de partículas extrañas.</td>
                                    <td class="centrado apariencia4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">PH</td>
                                    <td class="centrado">5.0 – 6.5</td>
                                    <td class="centrado ph4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Viscosidad (cps)</td>
                                    <td class="centrado">2.500 a 6000 cps</td>
                                    <td class="centrado viscosidad4"></td>

                                </tr>
                                <tr>
                                    <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                                    <td class="centrado">0.950 – 1.050 g/mL</td>
                                    <td class="centrado densidad4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Untuosidad</td>
                                    <td class="centrado">Suave al tacto</td>
                                    <td class="centrado untuosidad"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Poder Espumoso</td>
                                    <td class="centrado">Genere espuma</td>
                                    <td class="centrado espumoso4"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">Grado de Alcohol</td>
                                    <td class="centrado">N.A</td>
                                    <td class="centrado alcohol4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <label id="title14"></label>
                            <ul id="vinetas14">
                            </ul>
                        </div>
                    </div>
                    <div class="subtitle"><label for="">Ajustes</label></div>
                    <div class="ajustes">
                        <div class="resp">
                            <label for="">Si</label>
                            <input type="text" class="form-control">
                            <label for="">No</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="obs mb-5">
                            <label for="">Materia(s) primas para adicionar </label>
                            <input type="textarea" class="form-control">
                            <label for="">Procedimiento de Ajuste</label>
                            <input type="textarea" class="form-control">
                        </div>

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
            </div>
            <!-- fin aprobación -->

            <!-- Envasado -->
            <div class="subtitleProcess"><label for=""> <b>ENVASADO</b></label></div>

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
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td class="centrado">Número de Lote</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">6.2 Entrega Material Envase</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <label class="" id="title16"></label>
                            <ul class="" id="vinetas16">
                            </ul>
                        </div>
                    </div>
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
                                    <td class="centrado">21/05/2020</td>
                                    <td class="envase centrado"></td>
                                    <td class="descripcion_envase centrado"></td>
                                    <td class="unidades centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">21/05/2020</td>
                                    <td class="tapa centrado"></td>
                                    <td class="descripcion_tapa centrado"></td>
                                    <td class="unidades centrado"></td>
                                </tr>
                                <tr>
                                    <td class="centrado">21/05/2020</td>
                                    <td class="etiqueta centrado"></td>
                                    <td class="descripcion_etiqueta centrado"></td>
                                    <td class="unidades centrado"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Equipos</label></div>
                    <div class="envasadora">
                        <label for="">Identificacion Envasadora</label>
                        <input type="text" class="form-control" id="envasadora">
                        <label for="">Identificacion Loteadora</label>
                        <input type="text" class="form-control" id="loteadora">
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
                                <td class="centrado bold" id="fecha_medio5"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold" id="temperatura5"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold" id="humedad5"></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
                    <div class="alertas" id="alert_pesaje"></div>
                    <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
                    <div class="espec_tecnicas">
                        <label for="" class="centrado">Mínimo</label>
                        <input type="text" class="form-control centrado minimo">
                        <label for="" class="centrado">Medio</label>
                        <input type="text" class="form-control centrado medio">
                        <label for="" class="centrado">Máximo</label>
                        <input type="text" class="form-control centrado maximo">
                    </div>

                    <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>

                    <div class="p-3">
                        <table class="table table-bordered table-striped" id="muestrasEnvasado1">
                            <tbody> </tbody>
                        </table>
                        <div>
                            <label for="" class="mr-5">Promedio</label>
                            <input type="text" class="form-control centrado" id="promedioMuestras1" style="width: 10%; display:inline">
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Devolución Material de Envase Sobrante</label></div>
                    <div class="alertas" id="alert_pesaje"></div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped" id="devolucionMaterialSorbrante">
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

                            </tbody>
                        </table>
                    </div>
                    <div class="subtitle"><label for="">Cierre</label></div>
                    <div class="firmas" id="firmas6">
                        <label class="mr-3" style="justify-self: end;">Fecha y hora</label>
                        <label id="fecha6" style="font-weight:bold; justify-self: baseline"></label>

                        <div id="blank_rea6"></div>
                        <img id="f_realizo6" src="" alt="firma_usuario" height="130">
                        <div id="blank_ver6"></div>
                        <img id="f_verifico6" src="" alt="firma_usuario" height="130">

                        <label id="user_realizo6"></label>
                        <label id="user_verifico6"></label>
                    </div>
                </div>
            </div>
            <!-- fin envasado -->

            <!-- Acondicionamiento -->
            <div class="subtitleProcess"><label for=""> <b>ACONDICIONAMIENTO</b></label></div>

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
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                    <td class="centrado">Número de Lote</td>
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
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <label class="" id="title18"></label>
                            <ul class="" id="vinetas18">
                            </ul>
                        </div>
                    </div>
                   <!--  <div class="p-3">
                        <table class="table table-bordered table-striped" id="area_desinfeccion6">
                            <thead class="head centrado">
                                <tr>
                                    <td class="centrado">Referencia</td>
                                    <td class="centrado">Dscripción</td>
                                    <td class="centrado">Cantidad</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> -->
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
                                <td class="centrado bold" id="fecha_medio6"></td>
                                <td class="centrado">18 - 25 °C</td>
                                <td class="centrado bold" id="temperatura6"></td>
                                <td class="centrado">30 - 75 %</td>
                                <td class="centrado bold" id="humedad6"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="subtitle"><label for="">Control de Proceso</label></div>
                    <div class="alertas" id="alert_pesaje">
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <label class="" id="title19"></label>
                            <ul class="" id="vinetas19">
                            </ul>
                        </div>
                    </div>
                    <div class="p-3 proceso">
                        <label for="">Producto</label><input type="text" class="form-control">
                        <label for="">Lote</label><input type="text" class="form-control">
                        <label for="">Fecha</label><input type="text" class="form-control">
                        <label for="">Orden</label><input type="text" class="form-control">
                        <label for="">Responsable</label><input type="text" class="form-control">
                        <label for="">Aprobado por</label><input type="text" class="form-control">
                    </div>

                    <div class="subtitle"><label for="">Entrega Material Envase</label></div>

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
                                    <td>21/05/2020</td>
                                    <td class="envase"></td>
                                    <td class="descripcion_envase"></td>
                                    <td class="unidades"></td>
                                </tr>
                                <tr>
                                    <td>21/05/2020</td>
                                    <td class="tapa"></td>
                                    <td class="descripcion_tapa"></td>
                                    <td class="unidades"></td>
                                </tr>
                                <tr>
                                    <td>21/05/2020</td>
                                    <td class="etiquetas"></td>
                                    <td class="descripcion_etiquetas"></td>
                                    <td class="unidades"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                   <!--  <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
                    <div class="espec_tecnicas">
                        <label for="" class="centrado">Mínimo</label>
                        <input type="text" class="form-control centrado minimo">
                        <label for="" class="centrado">Medio</label>
                        <input type="text" class="form-control centrado medio">
                        <label for="" class="centrado">Máximo</label>
                        <input type="text" class="form-control centrado maximo">
                    </div> -->

                    <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>

                    <div class="p-3">
                        <table class="table table-bordered table-striped">
                            <thead class="head">
                                <tr>
                                    <th colspan="1" class="centrado">Muestra</th>
                                    <th colspan="1" class="centrado">APARIENCIA ETIQUETA (Arrugas, quiebres, sucios, alineada,dherencia)</th>
                                    <th colspan="1" class="centrado">APARIENCIA LOTE/ TERMOENCOGIBLE</th>
                                    <th colspan="1" class="centrado">CUMPLIMIENTO CON LA UNIDAD DE EMPAQUE</th>
                                    <th colspan="1" class="centrado">POSICIÓN DEL PRODUCTO DENTRO DE LA CAJA</th>
                                    <th colspan="1" class="centrado">RÓTULO DE LA CAJA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                    
                                </tr>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                    
                                </tr>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                    
                                </tr>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                   
                                </tr>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                    
                                </tr>
                                <tr>
                                    <th class="centrado">1</th>
                                    <th class="centrado">2</th>
                                    <th class="centrado">3</th>
                                    <th class="centrado">4</th>
                                    <th class="centrado">5</th>
                                    <th class="centrado">6</th>
                                    
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <label for="" class="mr-5">Promedio</label>
                            <input type="text" class="form-control" style="width: 10%; display:inline">
                        </div>
                    </div>

                    <div class="subtitle"><label for="">Devolución Material de Envase</label></div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-striped">
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
                                    <td class="centrado">50006</td>
                                    <td>envase bala x 120 ml</td>
                                    <td class="der">1.270</td>
                                    <td class="der">1.270</td>
                                    <td class="der">0</td>
                                    <td class="der">0</td>
                                </tr>
                                <tr>
                                    <td class="centrado">50039</td>
                                    <td>tapa flip-top 18/415 traslucido</td>
                                    <td class="der">1.270</td>
                                    <td class="der">1.270</td>
                                    <td class="der">0</td>
                                    <td class="der">0</td>
                                </tr>
                                <tr>
                                    <td class="centrado">50081</td>
                                    <td>etiqueta - 20781-1 - te capilar anticaida - isabely (120 ml) - usa</td>
                                    <td class="der">1.270</td>
                                    <td class="der">1.270</td>
                                    <td class="der">0</td>
                                    <td class="der">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- fin acondicionamiento -->



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