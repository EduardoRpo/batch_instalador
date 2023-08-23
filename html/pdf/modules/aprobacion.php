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
            <table class="table table-bordered table-striped" id="">
                <thead class="head">
                    <tr>
                        <td>Área/Equipo</td>
                        <td>Desinfectante</td>
                        <td>%</td>
                        <td>Número de Lote Anterior</td>
                    </tr>
                </thead>
                <tbody id="area_desinfeccion4">

                </tbody>
            </table>
        </div>

        <div class="subtitle"><label for="">Condiciones del Medio</label></div>
        <div class="table-responsive p-3">
            <table class="table table-striped table-bordered">
                <thead class="head">
                    <tr>
                        <th rowspan="2" class="centrado" style="vertical-align: middle;">Fecha</th>
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

        <div class="subtitle"><label for="">Observaciones</label></div>
        <div id="obs4" class="ml-5 mt-3 mb-3"></div>

        <div class="subtitle"><label for="">Cierre</label></div>
        <!-- <div class="firmas" id="firmas4">
            <label class="mr-3" style="justify-self: end;">Fecha</label>
            <label id="fecha4" style="font-weight:bold; justify-self: baseline"></label>

            <div id="blank_rea4"></div>
            <img id="f_realizo4" src="" alt="firma_usuario" height="130">
            <div id="blank_ver4"></div>
            <img id="f_verifico4" src="" alt="firma_usuario" height="130">

            <label id="user_realizo4"></label>
            <label id="user_verifico4"></label>
        </div> -->
        <table class="mt-3" id="firmas4" style="width:100%">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                    <td id="fecha4" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_realizo4" src="" alt="firma_usuario">
                    </td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_verifico4" src="" alt="firma_usuario">
                    </td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" id="user_realizo4"></td>
                    <td class="text-center" id="user_verifico4"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>