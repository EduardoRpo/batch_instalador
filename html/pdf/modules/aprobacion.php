<div class="subtitleProcess"><label for=""> <b>APROBACIÓN DEL GRANEL</b></label></div>
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
                        <td class="centrado">Fisicoquimico Granel Preparado</td>
                        <td class="centrado">Fisicoquimico Prod Terminado</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="centrado">Color</td>
                        <td class="centrado espec_color"></td>
                        <td class="centrado color4"></td>
                        <td class="centrado color4"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Olor</td>
                        <td class="centrado espec_olor"></td>
                        <td class="centrado olor4"></td>
                        <td class="centrado olor4"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Apariencia</td>
                        <td class="centrado espec_apariencia"></td>
                        <td class="centrado apariencia4"></td>
                        <td class="centrado apariencia4"></td>

                    </tr>
                    <tr>
                        <td class="centrado">PH</td>
                        <td class="centrado espec_ph"></td>
                        <td class="centrado ph4"></td>
                        <td class="centrado ph4"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Viscosidad (cps)</td>
                        <td class="centrado espec_viscosidad"></td>
                        <td class="centrado viscosidad4"></td>
                        <td class="centrado viscosidad4"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                        <td class="centrado espec_densidad"></td>
                        <td class="centrado densidad4"></td>
                        <td class="centrado densidad4"></td><!--colocar densidad final de la tara-->
                    </tr>
                    <tr>
                        <td class="centrado">Untuosidad</td>
                        <td class="centrado espec_untuosidad"></td>
                        <td class="centrado untuosidad4"></td>
                        <td class="centrado untuosidad4"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Poder Espumoso</td>
                        <td class="centrado espec_poder_espumoso"></td>
                        <td class="centrado espumoso4"></td>
                        <td class="centrado espumoso4"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Grado de Alcohol</td>
                        <td class="centrado espec_grado_alcohol"></td>
                        <td class="centrado alcohol4"></td>
                        <td class="centrado alcohol4"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Realizado por Area de Calidad</td>
                        <td >Fecha Aprobaciòn</td>
                        <td id="fecha4" style="font-weight:bold;"></td>
                        <td id="fecha_conciliacion" style="font-weight:bold;"></td>
                    </tr>
                </tbody>
            </table>

            <!--inicio tabla firma-->
            <table class="mt-3" id="firmas4" style="width:100%">
            <tbody>
                <tr>
                    <td style="width:5%"></td>
                    <td class="text-right" style="width: 45%; padding-right:10px"></td>
                    <td id="fecha4" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <!--<td class="text-center" style="height: 130px">
                        <img id="f_realizo4" src="" alt="firma_usuario" style="height:100px">
                    </td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_verifico4" src="" alt="firma_usuario" style="height:100px">
                    </td>-->
                </tr>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <!--<td class="text-center" id="user_realizo4"></td>
                    <td class="text-center" id="user_verifico4"></td>-->
                </tr>
            </tbody>
        </table>
            <!--fin tabla firma-->
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
        <table style="width: 100%;">
            <tbody>
                <tr style="height: 80px">
                    <td class="text-right" style="width: 40%; padding-right:10px">Si</td>
                    <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                        <input type="text" class="form-control centrado" id="Si4">
                    </td>
                    <td class="text-right" style="width: 7%; padding-right:10px">No</td>
                    <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                        <input type="text" class="form-control centrado" id="No4">
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
                        <input type="textarea" class="form-control" id="materiaPrimaAjustes4">
                    </td>
                    <td style="width: 1.5%;"></td>
                </tr>
                <tr>
                    <td style="width: 1%;"></td>
                    <td style="width: 25%; padding-left:7px">Procedimiento de Ajuste</td>
                    <td style="width: 71.5%;">
                        <input type="textarea" class="form-control" id="procedimientoAjustes4">
                    </td>
                    <td style="width: 1.5%;"></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="ajustes">
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

        </div> -->

        <div class="subtitle"><label for="">Observaciones</label></div>
        <div id="obs4" class="ml-5 mt-3 mb-3"></div>

        <div class="subtitle"><label for="">Anexos</label></div>
        <div id="obs4" class="ml-5 mt-3 mb-3">
            <ul>
                <li>Anexo 5: Instructivo Para Toma de Muestra</li>
                
            </ul>
        </div>

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
                    <!-- <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>-->
                    <td id="fecha4" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_realizo4" src="" alt="firma_usuario" style="height:100px">
                    </td>
                    <td class="text-center" style="height: 130px">
                        <img id="f_verifico4" src="" alt="firma_usuario" style="height:100px">
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

<script>

document.addEventListener('DOMContentLoaded', function() {
    function getBatchFromUrl() {
        const url = window.location.href;
        const parts = url.split('/');
        return parts[parts.length - 2];
    }

    // Función para sumar un día a una fecha
    function addOneDay(dateString) {
        const date = new Date(dateString);
        date.setDate(date.getDate() + 1);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    const batch = getBatchFromUrl();
    console.log('Batch:', batch); 

    const endpoint = 'http://10.1.200.30:3322/obtener_fecha_rendimiento';

    
    fetch(endpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch
        })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            console.log('Fecha de registro:', result.fecha_registro); 
            const newDate = addOneDay(result.fecha_registro); 
            document.getElementById('fecha_conciliacion').innerText = newDate;
        } else {
            console.log('Error:', result.message); 
            document.getElementById('resultado').innerText = `Error: ${result.message}`;
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('resultado').innerText = 'Error en la solicitud';
    });
});

  </script>