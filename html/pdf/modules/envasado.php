<div class="subtitleProcess"><label for="" id="titulo_envasado"> <b>ENVASADO</b></label></div>
<div class="card mt-3">
    <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
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
                <tbody id="despeje_linea5">

                </tbody>
            </table>
        </div>
    </div>
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
            <table class="table table-bordered table-striped" id="">
                <thead class="head centrado">
                    <tr>
                        <td class="centrado">Área/Equipo</td>
                        <td class="centrado">Desinfectante</td>
                        <td class="centrado">%</td>
                        <td class="centrado">Número de Lote Anterior</td>
                    </tr>
                </thead>
                <tbody id="area_desinfeccion5">

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
                            <td class="unidadesEnvase1 centrado"></td>
                        </tr>
                        <tr>
                            <td class="tapa1 centrado"></td>
                            <td class="descripcion_tapa1 centrado"></td>
                            <td class="unidadesTapa1 centrado"></td>
                        </tr>
                        <tr>
                            <td class="etiqueta1 centrado"></td>
                            <td class="descripcion_etiqueta1 centrado"></td>
                            <td class="unidadesEtiqueta1 centrado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Equipos</label></div>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Envasadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="envasadora1">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Loteadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="loteadora1">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="envasadora">
                <label for="">Identificacion Envasadora</label>
                <input type="text" class="form-control envasadora" id="envasadora1">
                <label for="">Identificacion Loteadora</label>
                <input type="text" class="form-control loteadora" id="loteadora1">
            </div> -->

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
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1">
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1">
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control centrado minimo1">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control centrado medio1">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control centrado maximo1">
            </div> -->

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
            <div class="p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <tbody id="tblMuestrasEnvasadoBody1">

                        </tbody>
                    </table>
                </div>

                <div>
                    <label>Promedio</label>
                    <input type=" text" class="form-control centrado" id="promedioMuestras1" style="width: 10%; display:inline">
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
                            <td id="envaseSobrante1" class="envase1 refEmpaque1 text-center"></td>
                            <td id="descripcion_envase1" class="descripcion_envase1"></td>
                            <td id="unidadesEnvase1" class="centrado unidadesEnvase1 data"></td>
                            <td id="usadaEnvase1" class="centrado txtEnvasada1 data"></td>
                            <td id="averiasEnvase1" class="centrado data"></td>
                            <td id="sobranteEnvase1" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="tapaSobrante1" class="tapa1 refEmpaque1 text-center"></td>
                            <td id="descripcion_tapa1" class="descripcion_tapa1"></td>
                            <td id="unidadesTapa1" class="centrado unidadesTapa1 data"></td>
                            <td id="usadaTapa1" class="centrado envasada1 data"></td>
                            <td id="averiasTapa1" class="centrado data"></td>
                            <td id="sobranteTapa1" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="etiquetaSobrante1" class="etiqueta1 refEmpaque1 text-center"></td>
                            <td id="descripcion_etiqueta1" class="descripcion_etiqueta1"></td>
                            <td id="unidadesEtiqueta1" class="centrado unidadesEtiqueta1 data"></td>
                            <td id="usadaEtiqueta1" class="centrado envasada1 data"></td>
                            <td id="averiasEtiqueta1" class="centrado data"></td>
                            <td id="sobranteEtiqueta1" class="centrado data"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Observaciones</label></div>
            <div id="obsEnvasMulti1" class="ml-5 mt-3 mb-3"></div>

            <div class="subtitle"><label for="">Cierre</label></div>
            <!-- <div class="firmas" id="firmas5">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha5" style="font-weight:bold; justify-self: baseline"></label>

                <div id="blank_rea5"></div>
                <img id="f_realizo5" src="" alt="firma_usuario" height="130">
                <div id="blank_ver5"></div>
                <img id="f_verifico5" src="" alt="firma_usuario" height="130">

                <label id="user_realizo5"></label>
                <label id="user_verifico5"></label>
            </div> -->
            <table class="mt-3" id="firmas5" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                        <td id="fecha5" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" style="height: 130px">
                            <img id="f_realizo5" src="" alt="firma_usuario" style="height:100px">
                        </td>
                        <td class="text-center" style="height: 130px">
                            <img id="f_verifico5" src="" alt="firma_usuario" style="height:100px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" id="user_realizo5"></td>
                        <td class="text-center" id="user_verifico5"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-envasado2">
            <div class="subtitleProcess"><label for="" id="titulo_envasado2"> <b>ENVASADO</b></label></div>
            <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
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
                            <td class="unidadesEnvase2 centrado"></td>
                        </tr>
                        <tr>
                            <td class="tapa2 centrado"></td>
                            <td class="descripcion_tapa2 centrado"></td>
                            <td class="unidadesTapa2 centrado"></td>
                        </tr>
                        <tr>
                            <td class="etiqueta2 centrado"></td>
                            <td class="descripcion_etiqueta2 centrado"></td>
                            <td class="unidadesEtiqueta2 centrado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Equipos</label></div>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Envasadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="envasadora2">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Loteadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="loteadora2">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="envasadora">
                <label for="">Identificacion Envasadora</label>
                <input type="text" class="form-control envasadora" id="envasadora2">
                <label for="">Identificacion Loteadora</label>
                <input type="text" class="form-control loteadora" id="loteadora2">
            </div> -->

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
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo2">
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio2">
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo2">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control centrado minimo2">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control centrado medio2">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control centrado maximo2">
            </div> -->

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
            <div class="p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <tbody id="tblMuestrasEnvasadoBody2">

                        </tbody>
                    </table>
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
                            <td id="envaseSobrante2" class="envase2 refEmpaque2"></td>
                            <td id="descripcion_envase2" class="descripcion_envase2"></td>
                            <td id="unidadesEnvase2" class="centrado unidadesEnvase2 data"></td>
                            <td id="usadaEnvase2" class="centrado txtEnvasada1 data"></td>
                            <td id="averiasEnvase2" class="centrado data"></td>
                            <td id="sobranteEnvase2" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="tapaSobrante2" class="tapa2 refEmpaque2"></td>
                            <td id="descripcion_tapa2" class="descripcion_tapa2"></td>
                            <td id="unidadesTapa2" class="centrado unidadesTapa2 data"></td>
                            <td id="usadaTapa2" class="centrado envasada2 data"></td>
                            <td id="averiasTapa2" class="centrado data"></td>
                            <td id="sobranteTapa2" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="etiquetaSobrante2" class="etiqueta2 refEmpaque2"></td>
                            <td id="descripcion_etiqueta2" class="descripcion_etiqueta2"></td>
                            <td id="unidadesEtiqueta2" class="centrado unidadesEtiqueta2" data></td>
                            <td id="usadaEtiqueta2" class="centrado envasada2 data"></td>
                            <td id="averiasEtiqueta2" class="centrado data"></td>
                            <td id="sobranteEtiqueta2" class="centrado data"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Observaciones</label></div>
            <div id="obsEnvasMulti2" class="ml-5 mt-3 mb-3"></div>

            <div class="subtitle"><label for="">Cierre</label></div>
            <!-- <div class="firmas" id="firmas2">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="multi_fecha2" style="font-weight:bold; justify-self: baseline"></label>

                <div id="multi_blank_realizo2"></div>
                <img id="multi_f_realizo2" src="" alt="firma_usuario" height="130">
                <div id="multi_blank_verifico2"></div>
                <img id="multi_f_verifico2" src="" alt="firma_usuario" height="130">

                <label id="multi_user_realizo2"></label>
                <label id="multi_user_verifico2"></label>
            </div> -->
            <table class="mt-3" id="firmas2" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                        <td id="multi_fecha2" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_realizo2" src="" alt="firma_usuario" style="height:100px">
                        </td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_verifico2" src="" alt="firma_usuario" style="height:100px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" id="multi_user_realizo2"></td>
                        <td class="text-center" id="multi_user_verifico2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-envasado3">
            <div class="subtitleProcess"><label for="" id="titulo_envasado3"> <b>ENVASADO</b></label></div>
            <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
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
                            <td class="unidadesEnvase3 centrado"></td>
                        </tr>
                        <tr>
                            <td class="tapa3 centrado"></td>
                            <td class="descripcion_tapa3 centrado"></td>
                            <td class="unidadesTapa3 centrado"></td>
                        </tr>
                        <tr>
                            <td class="etiqueta3 centrado"></td>
                            <td class="descripcion_etiqueta3 centrado"></td>
                            <td class="unidadesEtiqueta3 centrado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Equipos</label></div>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Envasadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="envasadora3">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Loteadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="loteadora3">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="envasadora">
                <label for="">Identificacion Envasadora</label>
                <input type="text" class="form-control envasadora" id="envasadora3">
                <label for="">Identificacion Loteadora</label>
                <input type="text" class="form-control loteadora" id="loteadora3">
            </div> -->

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
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo3">
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio3">
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo3">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control centrado minimo3">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control centrado medio3">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control centrado maximo3">
            </div> -->

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
            <div class="p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <tbody id="tblMuestrasEnvasadoBody3">

                        </tbody>
                    </table>
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
                            <td id="envaseSobrante3" class="envase3 refEmpaque3"></td>
                            <td id="descripcion_envase3" class="descripcion_envase3"></td>
                            <td id="unidadesEnvase3" class="centrado unidadesEnvase3 data"></td>
                            <td id="usadaEnvase3" class="centrado txtEnvasada3 data"></td>
                            <td id="averiasEnvase3" class="centrado data"></td>
                            <td id="sobranteEnvase3" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="tapaSobrante3" class="tapa1 refEmpaque3"></td>
                            <td id="descripcion_tapa3" class="descripcion_tapa3"></td>
                            <td id="unidadesTapa3" class="centrado unidadesTapa3 data"></td>
                            <td id="usadaTapa3" class="centrado envasada3 data"></td>
                            <td id="averiasTapa3" class="centrado data"></td>
                            <td id="sobranteTapa3" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="etiquetaSobrante3" class="etiqueta1 refEmpaque3"></td>
                            <td id="descripcion_etiqueta3" class="descripcion_etiqueta3"></td>
                            <td id="unidadesEtiqueta3" class="centrado unidadesEtiqueta3 data"></td>
                            <td id="usadaEtiqueta3" class="centrado envasada3 data"></td>
                            <td id="averiasEtiqueta3" class="centrado data"></td>
                            <td id="sobranteEtiqueta3" class="centrado data"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Observaciones</label></div>
            <div id="obsEnvasMulti1" class="ml-5 mt-3 mb-3"></div>

            <div class="subtitle"><label for="">Cierre</label></div>
            <!-- <div class="firmas" id="firmas3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="multi_fecha3" style="font-weight:bold; justify-self: baseline"></label>

                <div id="multi_blank_realizo3"></div>
                <img id="multi_f_realizo3" src="" alt="firma_usuario" height="130">
                <div id="multi_blank_verifico3"></div>
                <img id="multi_f_verifico3" src="" alt="firma_usuario" height="130">

                <label id="multi_user_realizo3">Sin Firmar</label>
                <label id="multi_user_verifico3">Sin Firmar</label>
            </div> -->
            <table class="mt-3" id="firmas3" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                        <td id="multi_fecha" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_realizo3" src="" alt="firma_usuario" style="height:100px">
                        </td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_verifico3" src="" alt="firma_usuario" style="height:100px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" id="multi_user_realizo3"></td>
                        <td class="text-center" id="multi_user_verifico3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-envasado4">
            <div class="subtitleProcess"><label for="" id="titulo_envasado4"> <b>ENVASADO</b></label></div>
            <div class="subtitle"><label for="">6.2 Entrega Material de Empaque</label></div>
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
                            <td class="envase4 centrado"></td>
                            <td class="descripcion_envase4 centrado"></td>
                            <td class="unidadesEnvase4 centrado"></td>
                        </tr>
                        <tr>
                            <td class="tapa4 centrado"></td>
                            <td class="descripcion_tapa4 centrado"></td>
                            <td class="unidadesTapa4 centrado"></td>
                        </tr>
                        <tr>
                            <td class="etiqueta4 centrado"></td>
                            <td class="descripcion_etiqueta4 centrado"></td>
                            <td class="unidadesEtiqueta4 centrado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Equipos</label></div>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Envasadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="envasadora4">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 1%;"></td>
                        <td style="width: 25%; padding-left:7px">Identificacion Loteadora</td>
                        <td style="width: 71.5%;">
                            <input type="text" class="form-control" id="loteadora4">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="envasadora">
                <label for="">Identificacion Envasadora</label>
                <input type="text" class="form-control envasadora" id="envasadora4">
                <label for="">Identificacion Loteadora</label>
                <input type="text" class="form-control loteadora" id="loteadora4">
            </div> -->

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
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo4">
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio4">
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo4">
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!-- <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control centrado minimo4">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control centrado medio4">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control centrado maximo4">
            </div> -->

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras</label></div>
            <div class="p-3">
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-striped" style="width: 100%;">
                        <tbody id="tblMuestrasEnvasadoBody4"></tbody>
                    </table>
                </div>

                <div>
                    <label>Promedio</label>
                    <input type="text" class="form-control centrado" id="promedioMuestras4" style="width: 10%; display:inline">
                    <label class="ml-3">Cantidad de Muestras</label>
                    <input type="text" class="form-control centrado" id="cantidadMuestras4" style="width: 10%; display:inline">
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
                            <td id="envaseSobrante4" class="envase4 refEmpaque4"></td>
                            <td id="descripcion_envase4" class="descripcion_envase4"></td>
                            <td id="unidadesEnvase4" class="centrado unidadesEnvase4 data"></td>
                            <td id="usadaEnvase4" class="centrado txtEnvasada4 data"></td>
                            <td id="averiasEnvase4" class="centrado data"></td>
                            <td id="sobranteEnvase4" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="tapaSobrante4" class="tapa1 refEmpaque4"></td>
                            <td id="descripcion_tapa3" class="descripcion_tapa4"></td>
                            <td id="unidadesTapa4" class="centrado unidadesTapa4 data"></td>
                            <td id="usadaTapa4" class="centrado envasada4 data"></td>
                            <td id="averiasTapa4" class="centrado data"></td>
                            <td id="sobranteTapa4" class="centrado data"></td>
                        </tr>
                        <tr>
                            <td id="etiquetaSobrante4" class="etiqueta1 refEmpaque4"></td>
                            <td id="descripcion_etiqueta4" class="descripcion_etiqueta4"></td>
                            <td id="unidadesEtiqueta4" class="centrado unidadesEtiqueta4 data"></td>
                            <td id="usadaEtiqueta4" class="centrado envasada4 data"></td>
                            <td id="averiasEtiqueta4" class="centrado data"></td>
                            <td id="sobranteEtiqueta4" class="centrado data"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Observaciones</label></div>
            <div id="obsEnvasMulti1" class="ml-5 mt-3 mb-3"></div>
            <div class="subtitle"><label for=""></label></div>

            <div class="subtitle"><label for="">Cierre</label></div>

            <!-- <div class="firmas" id="firmas3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="multi_fecha4" style="font-weight:bold; justify-self: baseline"></label>

                <div id="multi_blank_realizo4"></div>
                <img id="multi_f_realizo4" src="" alt="firma_usuario" height="130">
                <div id="multi_blank_verifico4"></div>
                <img id="multi_f_verifico4" src="" alt="firma_usuario" height="130">

                <label id="multi_user_realizo4">Sin Firmar</label>
                <label id="multi_user_verifico4">Sin Firmar</label>
            </div> -->
            <table class="mt-3" id="firmas3" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                        <td id="multi_fecha4" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_realizo4" src="" alt="firma_usuario" style="height:100px">
                        </td>
                        <td class="text-center" style="height: 130px">
                            <img id="multi_f_verifico4" src="" alt="firma_usuario" style="height:100px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" id="multi_user_realizo4"></td>
                        <td class="text-center" id="multi_user_verifico4"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>