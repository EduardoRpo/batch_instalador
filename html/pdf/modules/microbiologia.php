<div class="subtitleProcess"><label for=""> <b>MICROBIOLOGIA</b></label></div>
<div class="card mt-3">
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
        <table class="table table-bordered table-striped" id="">
            <thead class="head">
                <tr>
                    <td>Área/Equipo</td>
                    <td>Desinfectante</td>
                    <td>%</td>
                    <td>Número de Lote Anterior</td>
                </tr>
            </thead>
            <tbody id="area_desinfeccion8">

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

    <!-- <div class="enlinea">
        <label class="mr-3" style="justify-self: end;">Fecha</label>
        <label id="fecha8" style="font-weight:bold; justify-self: baseline"></label>
    </div> -->

    <table class="mt-3" style="width:100%">
        <tbody>
            <tr>
                <td style="width:5%"></td>
                <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                <td id="fecha8" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
            </tr>
        </tbody>
    </table>
    <div class="subtitle"><label for="">Observaciones</label></div>
    <div id="obs8" class="ml-5 mt-3 mb-3"></div>
    <div class="subtitle"><label for=""></label></div>

    <table class="mt-3" style="width:100%">
        <tbody>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" style="height: 130px">
                    <img id="f_realizoMicro" src="" alt="firma_usuario">
                </td>
                <td class="text-center" style="height: 130px">
                    <img id="f_verificoMicro1" src="" alt="firma_usuario">
                </td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" id="user_realizoMicro"></td>
                <td class="text-center" id="user_verificoMicro1"></td>
            </tr>
        </tbody>
    </table>
    <!-- <div class="firmas" id="firmas5">
        <div id="blank_rea8"></div>
        <img id="f_realizoMicro" src="" alt="firma_usuario" height="130">
        <div id="blank_ver8"></div>
        <img id="f_verificoMicro1" src="" alt="firma_usuario" height="130">

        <label id="user_realizoMicro"></label>
        <label id="user_verificoMicro1"></label>
    </div> -->
</div>