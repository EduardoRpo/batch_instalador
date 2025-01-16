<div class="subtitleProcess"><label for=""> <b>PESAJE</b></label></div>

<div class="card mt-3">
    <div class="card-header centrado"><b>2. DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
    <div class="card-body">
        <div class="group-despeje-pesaje p-3">
            <table class="table table-striped">
                <thead class="head">
                    <tr>
                        <th scope="col" class="centrado">#</th>
                        <th scope="col" class="centrado">Parametros de Control</th>
                        <th scope="col" class="centrado">Si</th>
                        <th scope="col" class="centrado">No</th>
                    </tr>
                </thead>
                <tbody id="despeje_linea2">
                </tbody>
            </table>
        </div>
    </div>

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
            <table class="table table-bordered table-striped" id="">
                <thead class="head">
                    <tr>
                        <td>Área/Equipo</td>
                        <td>Desinfectante</td>
                        <td>%</td>
                        <td>Número de Lote Anterior</td>
                    </tr>
                </thead>
                <tbody id="area_desinfeccion2">

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

        <div class="subtitle"><label for="">Observaciones</label></div>
        <div id="obs2" class="ml-5 mt-3 mb-3"></div>
        <div class="subtitle"><label for=""></label></div>

        <!-- <div class="firmas" id="firmas2">
            <label class="mr-3" style="justify-self: end;">Fecha</label>
            <label id="fecha2" style="font-weight:bold; justify-self: baseline"></label>

            <div id="blank_rea2"></div>
            <img id="f_realizo2" src="" alt="firma_usuario" height="130">
            <div id="blank_ver2"></div>
            <img id="f_verifico2" src="" alt="firma_usuario" height="130">

            <label id="user_realizo2"></label>
            <label id="user_verifico2"></label>
        </div> -->
        <div class="subtitle"><label for="">Anexos</label>
            
        </div>
        <div id="obs2" class="ml-5 mt-3 mb-3">
        <ul>
            <li>Anexo 1: Orden de Pesaje</li>
            <li>Anexo 2: Instructivo de Pesaje</li>
            <li>Anexo 3: Relación Lostes Materias Primas Utilizadas</li>
        </ul>
        </div>
        <div class="subtitle"><label for=""></label></div>
        <table class="mt-3" style="width:100%">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                    <td id="fecha2" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_realizo2" src="" alt="firma_usuario" style="height:100px">
                    </td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_verifico2" src="" alt="firma_usuario" style="height:100px">
                    </td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" id="user_realizo2"></td>
                    <td class="text-center" id="user_verifico2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>