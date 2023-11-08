<div class="subtitleProcess"><label for=""> <b>FISICOQUIMICO</b></label></div>
<div class="card mt-3">
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
        <table class="table table-bordered table-striped" id="">
            <thead class="head">
                <tr>
                    <td>Área/Equipo</td>
                    <td>Desinfectante</td>
                    <td>%</td>
                    <td>Número de Lote Anterior</td>
                </tr>
            </thead>
            <tbody id="area_desinfeccion9">

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
    <table style="width: 100%;">
        <tbody>
            <tr style="height: 80px">
                <td class="text-right" style="width: 40%; padding-right:10px">Si</td>
                <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                    <input type="text" class="form-control centrado" id="Si9">
                </td>
                <td class="text-right" style="width: 7%; padding-right:10px">No</td>
                <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                    <input type="text" class="form-control centrado" id="No9">
                </td>
                <td style="width:43%"></td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr style="height: 80px">
                <td style="width: 1%;"></td>
                <td style="width: 25%; padding-left:7px">Materia(s) primas para adicionar</td>
                <td style="width: 71.5%;">
                    <input type="textarea" class="form-control" id="materiaPrimaAjustes9">
                </td>
                <td style="width: 1.5%;"></td>
            </tr>
            <tr>
                <td style="width: 1%;"></td>
                <td style="width: 25%; padding-left:7px">Procedimiento de Ajuste</td>
                <td style="width: 71.5%;">
                    <input type="textarea" class="form-control" id="procedimientoAjustes9">
                </td>
                <td style="width: 1.5%;"></td>
            </tr>
        </tbody>
    </table>
    <!-- <div class="ajustes">
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
    </div> -->

    <div class="subtitle">Resultado</div>

    <div class="marco m-5">
        <table class="text-center" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%">Aprobado</td>
                    <td style="width: 50%">Fecha Resultados</td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <input class="chkAprobado" type="checkbox" name="chkAprobado" id="chkAprobado">
                    </td>
                    <td style="width: 50%;">
                        <input class="chkRechazado" type="checkbox" name="chkRechazado" id="chkRechazado">
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="col2sm m-3">
            <label for="">Aprobado</label>
            <label for="">Rechazado</label>
            <input class="chkAprobado" type="checkbox" name="chkAprobado" id="chkAprobado">
            <input class="chkRechazado" type="checkbox" name="chkRechazado" id="chkRechazado">
        </div> -->
    </div>

    <!-- <div class="enlinea">
        <label class="mr-3 fechaHora" style="justify-self: end;">Fecha</label>
        <label id="fecha9" style="font-weight:bold; justify-self: baseline"></label>
    </div> -->
    <table class="mt-3" style="width:100%">
        <tbody>
            <tr>
                <td style="width:5%"></td>
                <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                <td id="fecha9" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
            </tr>
        </tbody>
    </table>

    <div class="subtitle"><label for="">Observaciones</label></div>
    <div id="obs9" class="ml-5 mt-3 mb-3"></div>
    <div class="subtitle"><label for=""></label></div>

    <table class="mt-3" id="firmas5" style="width:100%">
        <tbody>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" style="height: 130px">
                    <img id="f_realizo9" src="" alt="firma_usuario" style="height:100px">
                </td>
                <td class="text-center" style="height: 130px">
                    <img id="f_verifico9" src="" alt="firma_usuario" style="height:100px">
                </td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" id="user_realizo9"></td>
                <td class="text-center" id="user_verifico9"></td>
            </tr>
        </tbody>
    </table>
    <!-- <div class="firmas" id="firmas5">
        <div id="blank_rea9"></div>
        <img id="f_realizo9" src="" alt="firma_usuario" height="130">
        <div id="blank_ver9"></div>
        <img id="f_verifico9" src="" alt="firma_usuario" height="130">
        <label id="user_realizo9"></label>
        <label id="user_verifico9"></label>
    </div> -->
</div>