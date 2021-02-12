<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pfd Batch Record</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Samara Cosmetics</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style_pdf.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            margin-top: 15px;
            margin-left: 35px;
            margin-right: 35px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .flotante {
            display: scroll;
            position: fixed;
            bottom: 320px;
            right: 0px;
        }

        .position {
            bottom: 280px;
        }

        .light-logo {
            width: 15%;
        }

        .head {
            background: lightgray;
            color: black;
            text-align: center;
            font-weight: bold;
        }

        .centrado {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .der {
            text-align: right;
        }

        .group-info-ref {
            display: grid;
            grid-template-columns: 150px 1fr 190px 1fr;
            gap: 3px 20px;
        }

        .group-info-batch {
            display: grid;
            grid-template-columns: 200px 1fr 280px 1fr;
            gap: 3px 20px;
        }

        .card-header {
            background: green;
            color: white;
            font-size: 18px;
        }

        .subtitle {
            background: lightslategray;
            color: white;
            text-align: center;
            margin-top: 15px;
            margin-left: 15px;
            margin-right: 15px;
            font-size: 17px;
        }

        .subtitleProcess {
            background: coral;
            color: white;
            text-align: center;
            margin-top: 15px;
            margin-left: 1px;
            margin-right: 1px;
            font-size: 22px;
        }

        .equipos {
            display: grid;
            grid-template-columns: 170px 1fr 220px 1fr;
            gap: 15px;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .ajustes .resp {
            display: grid;
            grid-template-columns: repeat(4, 100px);
            gap: 15px;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
            justify-content: center;
            text-align: center;
        }

        .ajustes .obs {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 15px;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .envasadora {
            display: grid;
            grid-template-columns: 200px 500px;
            gap: 15px;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .espec_tecnicas {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .proceso {
            display: grid;
            grid-template-columns: 150px 1fr 150px 1fr;
            gap: 10px 20px;
            justify-items: center;
        }
    </style>
</head>

<body>

    <div class="mb-3">
        <a><span><img src="img/logo-samara.png" style="width: 15%;" class="light-logo" alt="Samara Cosmetics" /></span></a>
    </div>

    <div>
        <a href='#' <i class='fa fa-print fa-2x link-imprimir flotante' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>
        <a href='#' <i class='fa fa-times-circle fa-2x link-cerrar flotante position' data-toggle='tooltip' title='Cerrar ventana' style='color:red;'></i></a>
    </div>


    <div class="card">
        <div class="card-header centrado"><b>INFORMACIÓN DEL PRODUCTO</b></div>
        <div class="card-body">
            <div class="group-info-ref p-3">
                <label for="">Referencia</label>
                <input type="text" class="form-control centrado" id="ref">
                <label for="">Nombre Referencia</label>
                <input type="text" class="form-control centrado" id="nref">
                <label for="">Marca</label>
                <input type="text" class="form-control centrado" id="marca">
                <label for="">Propietario</label>
                <input type="text" class="form-control centrado" id="propietario">
                <label for="">Notificación Sanitaria</label>
                <input type="text" class="form-control centrado" id="notificacion">
                <label for="">Presentación Comercial</label>
                <input type="text" class="form-control centrado" id="presentacion">
            </div>
            <hr style="width: 95%;">
            <div class="group-info-batch p-3">

                <label for="">Orden de Producción</label>
                <input type="text" class="form-control centrado" id="orden">
                <label for="">Lote</label>
                <input type="text" class="form-control centrado" id="lote">
                <label for="">Fecha</label>
                <input type="text" class="form-control centrado fecha" id="fecha">
                <!-- <label for="">Tamaño del producto</label>
                <input type="text" class="form-control centrado" id="tamanop"> -->
                <label for="">Tamaño del Lote por presentación (kg)</label>
                <input type="text" class="form-control centrado" id="tamanol">
                <label for="">Tamaño del lote total (kg)</label>
                <input type="text" class="form-control centrado" id="tamanolt">
                <label for="">Unidades por Lote solicitadas</label>
                <input type="text" class="form-control centrado" id="unidades">
            </div>
            <hr style="width: 95%;">
            <div class="group-info-batch p-3">
                <label for="">Autorizado por</label>
                <input type="text" class="form-control centrado" id="autorizado">

            </div>

        </div>

    </div>
    </div>
    <!-- pesaje -->
    <div class="subtitleProcess"><label for=""> <b>PESAJE</b></label></div>

    <div class="card mt-3">
        <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
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
        <div class="card-header centrado"><b>PESAJE Y DISPENSACIÓN</b></div>
        <div class="card-body">
            <div class="subtitle">
                <label for="">Entrega de Materias Primas</label>
            </div>

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

            <div class="subtitle">
                <label for="">Limpieza y Desinfección</label>
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
                <label for="">Condiciones del Medio</label>
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
        </div>
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
                <input type="text" class="form-control">
                <label for="">Identificación Marmita o Taque</label>
                <input type="text" class="form-control">
            </div>

            <div class="subtitle"><label for="">Liberación de Agua por parte de Calidad</label></div>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped">
                    <thead class="head">
                        <tr>
                            <td>Fecha</td>
                            <td>Parametros</td>
                            <td>Cumple</td>
                            <td>Realizado por</td>
                            <td>Verificado por</td>
                            <td>Observaciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Color</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Olor</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Apariencia</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Conductividad 1</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Conductividad 2</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Cloro Libre</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Nitratos</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
                        <tr>
                            <td class="centrado">05/02/2020</td>
                            <td class="centrado">Dureza</td>
                            <td class="centrado">Si</td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                            <td class="centrado"></td>
                        </tr>
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
                        <td class="centrado bold" id="fecha_medio3"></td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado bold" id="temperatura3"></td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado bold" id="humedad3"></td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control</label></div>
            <div class="equipos">
                <label for="">RPM del proceso</label>
                <input type="text" class="form-control">
                <label for="">Temperatura de preparación</label>
                <input type="text" class="form-control">
            </div>

            <div class="subtitle"><label for="">Control del Proceso</label></div>

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
    </div>
    <!-- fin preparación -->

    <!-- Aprobación -->
    <div class="subtitleProcess"><label for=""> <b>APROBACIÓN</b></label></div>


    <div class="card mt-3">
        <div class="card-header centrado"><b>APROBACIÓN</b></div>
        <div class="card-body">
            <div class="subtitle"><label for="">Limpieza y Desinfección</label></div>

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
                        <td class="centrado">04/02/2020</td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado">17 °C</td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado">35 %</td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control del Proceso</label></div>

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
        <div class="card-header centrado"><b>ENVASADO</b></div>
        <div class="card-body">

            <div class="subtitle">
                <label for="">Limpieza y Desinfección</label>
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
                            <td>50006</td>
                            <td>envase bala x 120 ml</td>
                            <td>1.270</td>
                        </tr>
                        <tr>
                            <td>21/05/2020</td>
                            <td>50039</td>
                            <td>tapa flip-top 18/415 traslucido</td>
                            <td>1.270</td>
                        </tr>
                        <tr>
                            <td>21/05/2020</td>
                            <td>50081</td>
                            <td>etiqueta - 20781-1 - te capilar anticaida - isabely (120 ml) - usa</td>
                            <td>1.270</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Equipos</label></div>
            <div class="envasadora">
                <label for="">Identificacion Envasadora</label>
                <input type="text" class="form-control">
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
                        <td class="centrado">04/02/2020</td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado">17 °C</td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado">35 %</td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
            <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control class=" centrado"">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control class=" centrado"">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control class=" centrado"">
            </div>

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped">
                    <thead class="head">
                        <tr>
                            <th colspan="10" class="centrado">Resultados</th>
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
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
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
        <div class="card-header centrado"><b>LOTEADO</b></div>
        <div class="card-body">

            <div class="subtitle">
                <label for="">Limpieza y Desinfección</label>
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

            <div class="subtitle"><label for="">Equipos</label></div>
            <div class="equipos">
                <label for="">Banda Transportadora</label>
                <input type="text" class="form-control">
                <label for="">Loteadora Video Jet</label>
                <input type="text" class="form-control">
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
                        <td class="centrado">04/02/2020</td>
                        <td class="centrado">18 - 25 °C</td>
                        <td class="centrado">17 °C</td>
                        <td class="centrado">30 - 75 %</td>
                        <td class="centrado">35 %</td>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control de Proceso</label></div>

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
                            <td>50006</td>
                            <td>envase bala x 120 ml</td>
                            <td>1.270</td>
                        </tr>
                        <tr>
                            <td>21/05/2020</td>
                            <td>50039</td>
                            <td>tapa flip-top 18/415 traslucido</td>
                            <td>1.270</td>
                        </tr>
                        <tr>
                            <td>21/05/2020</td>
                            <td>50081</td>
                            <td>etiqueta - 20781-1 - te capilar anticaida - isabely (120 ml) - usa</td>
                            <td>1.270</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Especificaciones Tecnicas</label></div>
            <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control class=" centrado"">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control class=" centrado"">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control class=" centrado"">
            </div>

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped">
                    <thead class="head">
                        <tr>
                            <th colspan="10" class="centrado">Resultados</th>
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
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
                        </tr>
                        <tr>
                            <th class="centrado">1</th>
                            <th class="centrado">2</th>
                            <th class="centrado">3</th>
                            <th class="centrado">4</th>
                            <th class="centrado">5</th>
                            <th class="centrado">6</th>
                            <th class="centrado">7</th>
                            <th class="centrado">8</th>
                            <th class="centrado">9</th>
                            <th class="centrado">10</th>
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

</body>

</html>