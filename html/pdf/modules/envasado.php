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

        <div class="subtitle"><label for="">Control de Tara - Envase en Proceso</label></div>
            <div id="obsEnvasMulti1" class="ml-5 mt-3 mb-3">
            <!-- <ul>
                    <li>Anexo 6: Peso Tara Envase</li>
                    
                </ul>
                -JERP-->
            <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <tbody id="tblMuestrasTarasFinales">

                            </tbody>
                        </table>
            </div> 

            <div id="contenedorTablas"></div>
            <div>
                <!--
            <label>Promedio</label>
                    <input type=" text" class="form-control centrado" id="" style="width: 10%; display:inline">
                    <label class="ml-3">Cantidad de Muestras</label>
                    <input type="text" class="form-control centrado" id="" style="width: 10%; display:inline">
                </div>-->
                
            <input type="button" value="Cargar Tara" onclick="cargarTara()" style="margin-top: 20px; padding: 10px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; display:none;"> <!--Boton para cargar automaticamente informacion de tara registradas-->
            </div>
            <div class="subtitle"><label for=""></label></div>
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
            <!--
            <div class="subtitle"><label for="">Control de Peso en Proceso</label></div>-->
            <div class="table-responsive" id="table_envasado1"></div>
            <div class="subtitle" style=""><label for="">Datos Peso Envase (gr)</label></div> 
            

            


            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Peso Mínimo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo_peso" id='peso_minimo_tara'>
                        </td>
                        <!--<td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1">
                        </td>-->
                        <td style="width: 10%">Peso Máximo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo_peso" id='peso_maximo_tara'>
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <div class="subtitle"><label for="">Peso Producto a Envasar (gr)</label></div>

            <!--Inicio-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='producto_minimo'> <!---->
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='producto_medio'> <!---->
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='producto_maximo'> <!---->
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!--fin-->

            <div class="subtitle"><label for="">Peso Producto a Envasar + Peso Envase (gr)</label></div>

            <!--Inicio2-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='envase_min_tara'>
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='envase_med_tara'>
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='envase_max_tara'>
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!--fin2-->
            <!-- <div class="espec_tecnicas">
                <label for="" class="centrado">Mínimo</label>
                <input type="text" class="form-control centrado minimo1">
                <label for="" class="centrado">Medio</label>
                <input type="text" class="form-control centrado medio1">
                <label for="" class="centrado">Máximo</label>
                <input type="text" class="form-control centrado maximo1">
            </div> -->

            <div class="subtitle"><label for="">Control de peso en el Proceso</label></div>
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras (Peso Producto + Peso Envase (gr))</label></div>
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
            <!--
            <div class="subtitle"><label for="">Control de Peso en Proceso</label></div>-->
            <div class="table-responsive" id="table_envasado1"></div>
            <div class="subtitle" style=""><label for="">Datos Peso Envase (gr)</label></div> 
            

            


            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Peso Mínimo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo_peso" id='peso_minimo_tara2'>
                        </td>
                        <!--<td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1">
                        </td>-->
                        <td style="width: 10%">Peso Máximo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo_peso" id='peso_maximo_tara2'>
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <div class="subtitle"><label for="">Peso Producto a Envasar (gr)</label></div>

            <!--Inicio-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='producto_minimo2'> <!---->
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='producto_medio2'><!-- -->
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='producto_maximo2'><!---->
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!--fin-->

            <div class="subtitle"><label for="">Peso Producto a Envasar + Peso Envase (gr)</label></div>

            <!--Inicio2-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='envase_min_tara2'>
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='envase_med_tara2'>
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='envase_max_tara2'>
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
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras (Peso Producto + Peso Envase (gr))</label></div>
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
                        <td class="centrado bold humedad5" id="humedad5"></td>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
            <div class="alertas" id="alert_pesaje"></div>
            <!--
            <div class="subtitle"><label for="">Control de Peso en Proceso</label></div>-->
            <div class="table-responsive" id="table_envasado1"></div>
            <div class="subtitle" style=""><label for="">Datos Peso Envase (gr)</label></div> 
            

            


            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Peso Mínimo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo_peso" id='peso_minimo_tara3'>
                        </td>
                        <!--<td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1">
                        </td>-->
                        <td style="width: 10%">Peso Máximo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo_peso" id='peso_maximo_tara3'>
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <div class="subtitle"><label for="">Peso Producto a Envasar (gr)</label></div>

            <!--Inicio-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='producto_minimo3'> <!---->
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='producto_medio3'><!---->
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='producto_maximo3'><!---->
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!--fin-->

            <div class="subtitle"><label for="">Peso Producto a Envasar + Peso Envase (gr)</label></div>

            <!--Inicio2-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='envase_min_tara3'>
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='envase_med_tara3'>
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='envase_max_tara3'>
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
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras (Peso Producto + Peso Envase (gr))</label></div>
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
            <div id="obsEnvasMulti3" class="ml-5 mt-3 mb-3"></div>

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
                        <td class="centrado bold humedad5" id="humedad5"></td>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label for="">Procedimiento de Envasado</label></div>
            <div class="alertas" id="alert_pesaje"></div>
            <!--
            <div class="subtitle"><label for="">Control de Peso en Proceso</label></div>-->
            <div class="table-responsive" id="table_envasado1"></div>
            <div class="subtitle" style=""><label for="">Datos Peso Envase (gr)</label></div> 
            

            


            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Peso Mínimo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo_peso" id='peso_minimo_tara4'>
                        </td>
                        <!--<td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1">
                        </td>-->
                        <td style="width: 10%">Peso Máximo Envase</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo_peso" id='peso_maximo_tara4'>
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <div class="subtitle"><label for="">Peso Producto a Envasar (gr)</label></div>

            <!--Inicio-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='producto_minimo4'> <!---->
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='producto_medio4'><!---->
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='producto_maximo4'><!---->
                        </td>
                        <td style="width: 1.5%;"></td>
                    </tr>
                </tbody>
            </table>
            <!--fin-->

            <div class="subtitle"><label for="">Peso Producto a Envasar + Peso Envase (gr)</label></div>

            <!--Inicio2-->
            <table class="text-center" style="width: 100%;">
                <tbody>
                    <tr style="height: 80px">
                        <td style="width: 4.5%;"></td>
                        <td style="width: 10%">Mínimo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado minimo1" id='envase_min_tara4'>
                        </td>
                        <td style="width: 10%">Medio</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado medio1" id='envase_med_tara4'>
                        </td>
                        <td style="width: 10%">Máximo</td>
                        <td style="width: 21.33%;">
                            <input type="text" class="form-control centrado maximo1" id='envase_max_tara4'>
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
            <div class="subtitle" style="background:lightgrey;"><label for="">Muestras (Peso Producto + Peso Envase (gr))</label></div>
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
            <div id="obsEnvasMulti4" class="ml-5 mt-3 mb-3"></div>
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
            <table class="mt-3" id="firmas4" style="width:100%">
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
        <div class="subtitle"><label>Conciliación de Rendimiento Granel</label></div>
                <table class="mt-3 mb-3" id="" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Conciliacion rendimiento (%)</td>
                        <td style="width: 50%;">
                            <input type="text" class="form-control" id="conciliacionRendimiento60" style="width: 30%;justify-self: baseline" readonly>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
    </div>
</div>
<!--
<script src="../../html/pdf/js/registrosTara.js"></script>-->
<script src="../../html/pdf/js/conciliacionRendimiento.js"></script>

<script>
   async function cargarTara() {
    console.log('archivo tara cargado 280325');

    const urlParams = window.location.pathname.split('/');
    const batch = urlParams[2];  
    const extra = urlParams.slice(3).join('/');

    console.log(`Número de batch extraído de la URL: ${batch}`);
    console.log(`Ruta extraída después de batch: ${extra}`);

    if (!batch) {
        console.error('No se ha extraído un valor válido para batch');
        alert('No se ha extraído un valor válido para batch');
        return;
    }

    const apiUrl = `http://10.1.200.30:1901/obtener_valores_tara2`;
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ batch: batch, extra: extra })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Agrupar los valores por referencia
            const groupedData = {};

            data.data.forEach(row => {
                if (!groupedData[row.referencia]) {
                    groupedData[row.referencia] = [];
                }
                groupedData[row.referencia].push(parseFloat(row.tara));
            });

            // Obtener el contenedor donde se agregarán las tablas
            const contenedorTablas = document.getElementById('contenedorTablas');
            contenedorTablas.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevas tablas

            // Para cada grupo de referencia, creamos su propia tabla
            for (const referencia in groupedData) {
                const taras = groupedData[referencia];
                const cantidadMuestras = taras.length;
                const promedio = cantidadMuestras > 0 ? (taras.reduce((a, b) => a + b, 0) / cantidadMuestras).toFixed(2) : 0;

                console.log(`Referencia: ${referencia} - Promedio: ${promedio}, Cantidad: ${cantidadMuestras}`);

                // Crear título de referencia
                const tituloEnvasado = document.createElement('div');
                tituloEnvasado.className = 'subtitleProcess';
                tituloEnvasado.innerHTML = `<b>Peso Envase <br>REFERENCIA: ${referencia}</b>`;
                contenedorTablas.appendChild(tituloEnvasado); 

                // Crear la tabla
                const tableContainer = document.createElement('div');
                tableContainer.className = 'table-responsive';
                const table = document.createElement('table');
                table.className = 'table table-bordered table-striped';
                table.style.width = '100%';
                table.style.borderCollapse = 'collapse';

                const tbody = document.createElement('tbody');
                table.appendChild(tbody);
                tableContainer.appendChild(table);
                contenedorTablas.appendChild(tableContainer); 

                // Agregar taras en filas de 10 columnas
                let row;
                taras.forEach((tara, index) => {
                    if (index % 10 === 0) {
                        row = document.createElement('tr');
                        tbody.appendChild(row);
                    }
                    const td = document.createElement('td');
                    td.style.padding = '8px 12px';
                    td.style.backgroundColor = '#ffffff';
                    td.style.verticalAlign = 'middle';
                    td.textContent = tara;
                    row.appendChild(td);
                });

                // Completar filas si tienen menos de 10 elementos
                const lastRow = tbody.querySelector('tr:last-child');
                if (lastRow) {
                    while (lastRow.cells.length < 10) {
                        const tdEmpty = document.createElement('td');
                        tdEmpty.style.padding = '8px 12px';
                        tdEmpty.style.backgroundColor = '#ffffff';
                        tdEmpty.style.verticalAlign = 'middle';
                        lastRow.appendChild(tdEmpty);
                    }
                }

                // Crear los campos de promedio y cantidad de muestras para esta referencia
                const infoContainer = document.createElement('div');
                infoContainer.style.marginTop = '10px';
                infoContainer.innerHTML = `
                    <label>Promedio</label>
                    <input type="text" class="form-control centrado" value="${promedio}" style="width: 10%; display:inline" readonly>
                    <label class="ml-3">Cantidad de Muestras</label>
                    <input type="text" class="form-control centrado" value="${cantidadMuestras}" style="width: 10%; display:inline" readonly>
                `;
                contenedorTablas.appendChild(infoContainer);
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            //alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        //alert('Error al obtener los datos.');
    });
}

async  function cargarTaraPeso() {
    console.log('Cargando datos de Tara Peso 280325');

    const urlParams = window.location.pathname.split('/');

    // Obtén el número de batch de la URL, similar al ejemplo que proporcionaste
    const batch = urlParams[2];  
    const extra = urlParams.slice(3).join('/');  

    console.log(`Número de batch extraído de la URL: ${batch}`);
    console.log(`Ruta extraída después de batch: ${extra}`);

    if (!batch) {
        console.error('No se ha extraído un valor válido para batch');
        //alert('No se ha extraído un valor válido para batch');
        return;
    }

    const apiUrl = `http://10.1.200.30:2376/multipresentacion_tara_peso`;  
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response);
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            console.error("Esperado JSON, pero se recibió otro tipo de contenido:", contentType);
            alert(`Esperado JSON, pero se recibió otro tipo de contenido: ${contentType}`);
            return response.text();  
        }
        return response.json();  
    })
    .then(data => {
        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            //alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        console.log('Datos recibidos de la API:', data);
        if (data.success) {
            const result = data.data;

            if (result && result.length > 0) {
                // Extraer el peso mínimo, medio y máximo para cada presentación

                // Multipresentación 1
                try {
                    const firstResult = result[0];
                    const pesoMinimo = firstResult.peso_minimo;
                    const pesoMaximo = firstResult.peso_maximo;
                    const pesoMedio = firstResult.peso_medio || '0';

                    document.getElementById('peso_minimo_tara').value = pesoMinimo;
                    document.getElementById('peso_maximo_tara').value = pesoMaximo;

                    const pesoProdMinimo1 = document.getElementById('producto_minimo').value;
                    const pesoProdMedio1 = document.getElementById('producto_medio').value;
                    const pesoProdMax1 = document.getElementById('producto_maximo').value;

                    const sumMinimo_1 = parseFloat(pesoMinimo) + parseFloat(pesoProdMinimo1);
                    const sumMedio_1 = parseFloat(pesoMinimo) + parseFloat(pesoProdMedio1);
                    const sumMax_1 = parseFloat(pesoMinimo) + parseFloat(pesoProdMax1);

                    document.getElementById('envase_min_tara').value = sumMinimo_1.toFixed(2);
                    document.getElementById('envase_med_tara').value = sumMedio_1.toFixed(2);
                    document.getElementById('envase_max_tara').value = sumMax_1.toFixed(2);
                } catch (error) {
                    console.error('Error al procesar la primera presentación:', error);
                }

                // Multipresentación 2
                try {
                    const secondResult = result[1];
                    const pesoMinimo2 = secondResult.peso_minimo;
                    const pesoMaximo2 = secondResult.peso_maximo;
                    const pesoMedio2 = secondResult.peso_medio || '0';

                    document.getElementById('peso_minimo_tara2').value = pesoMinimo2;
                    document.getElementById('peso_maximo_tara2').value = pesoMaximo2;

                    const pesoProdMinimo2 = document.getElementById('producto_minimo2').value;
                    const pesoProdMedio2 = document.getElementById('producto_medio2').value;
                    const pesoProdMax2 = document.getElementById('producto_maximo2').value;

                    const sumMinimo_2 = parseFloat(pesoMinimo2) + parseFloat(pesoProdMinimo2);
                    const sumMedio_2 = parseFloat(pesoMinimo2) + parseFloat(pesoProdMedio2);
                    const sumMax_2 = parseFloat(pesoMinimo2) + parseFloat(pesoProdMax2);

                    document.getElementById('envase_min_tara2').value = sumMinimo_2.toFixed(2);
                    document.getElementById('envase_med_tara2').value = sumMedio_2.toFixed(2);
                    document.getElementById('envase_max_tara2').value = sumMax_2.toFixed(2);
                } catch (error) {
                    console.error('Error al procesar la segunda presentación:', error);
                }

                // Multipresentación 3
                try {
                    const threeResult = result[2];
                    const pesoMinimo3 = threeResult.peso_minimo;
                    const pesoMaximo3 = threeResult.peso_maximo;
                    const pesoMedio3 = threeResult.peso_medio || '0';

                    document.getElementById('peso_minimo_tara3').value = pesoMinimo3;
                    document.getElementById('peso_maximo_tara3').value = pesoMaximo3;

                    const pesoProdMinimo3 = document.getElementById('producto_minimo3').value;
                    const pesoProdMedio3 = document.getElementById('producto_medio3').value;
                    const pesoProdMax3 = document.getElementById('producto_maximo3').value;

                    const sumMinimo_3 = parseFloat(pesoMinimo3) + parseFloat(pesoProdMinimo3);
                    const sumMedio_3 = parseFloat(pesoMinimo3) + parseFloat(pesoProdMedio3);
                    //const sumMax_3 = parseFloat(pesoMinimo3) + parseFloat(pesoProdMax3);

                    document.getElementById('envase_min_tara3').value = sumMinimo_3.toFixed(2);
                    document.getElementById('envase_med_tara3').value = sumMedio_3.toFixed(2);
                    document.getElementById('envase_max_tara3').value = sumMax_3.toFixed(2);
                } catch (error) {
                    console.error('Error al procesar la tercera presentación:', error);
                }

                // Multipresentación 4
                try {
                    const fourResult = result[3];
                    const pesoMinimo4 = fourResult.peso_minimo;
                    const pesoMaximo4 = fourResult.peso_maximo;
                    const pesoMedio4 = fourResult.peso_medio || '0';

                    document.getElementById('peso_minimo_tara4').value = pesoMinimo4;
                    document.getElementById('peso_maximo_tara4').value = pesoMaximo4;

                    const pesoProdMinimo4 = document.getElementById('producto_minimo4').value;
                    const pesoProdMedio4 = document.getElementById('producto_medio4').value;
                    const pesoProdMax4 = document.getElementById('producto_maximo4').value;

                    const sumMinimo_4 = parseFloat(pesoMinimo4) + parseFloat(pesoProdMinimo4);
                    const sumMedio_4 = parseFloat(pesoMinimo4) + parseFloat(pesoProdMedio4);
                    const sumMax_4 = parseFloat(pesoMinimo4) + parseFloat(pesoProdMax4);

                    document.getElementById('envase_min_tara4').value = sumMinimo_4.toFixed(2);
                    document.getElementById('envase_med_tara4').value = sumMedio_4.toFixed(2);
                    document.getElementById('envase_max_tara4').value = sumMax_4.toFixed(2);
                } catch (error) {
                    console.error('Error al procesar la cuarta presentación:', error);
                }

            } else {
                //alert('No se encontraron datos para este batch.');
                console.log('No se encontraron datos para este batch.');
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            //alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        //alert('Error al obtener los datos.');
    });
}

async  function cargarTaraPresentacion() {
    console.log('Cargando datos de Tara consultar_presentacion 280325');

    const urlParams = window.location.pathname.split('/');
    const batch = urlParams[2];  
    const extra = urlParams.slice(3).join('/');  

    console.log(`Número de batch extraído de la URL: ${batch}`);
    console.log(`Ruta extraída después de batch: ${extra}`);

    if (!batch) {
        console.error('No se ha extraído un valor válido para batch');
        alert('No se ha extraído un valor válido para batch');
        return;
    }

    const apiUrl = `http://10.1.200.30:2376/consultar_presentacion`;  
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response);
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            console.error("Esperado JSON, pero se recibió otro tipo de contenido:", contentType);
            alert(`Esperado JSON, pero se recibió otro tipo de contenido: ${contentType}`);
            return response.text();  
        }
        return response.json();  
    })
    .then(data => {
        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            //alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        console.log('Datos recibidos de la API:', data);
        if (data.success) {
            const result = data.data;

            if (result && result.length > 0) {
                const presentacion = [];

                result.forEach((item, index) => {
                    const presentacionFinal = parseFloat(item.presentacionFinal); 
                    const densidad_final = parseFloat(item.densidad_final); 

                    // Comprobamos que ambos valores sean números válidos
                    if (!isNaN(presentacionFinal) && !isNaN(densidad_final)) {
                        const peso_minimo = (presentacionFinal * densidad_final).toFixed(2);
                        const peso_maximo = (peso_minimo * (1 + 0.03)).toFixed(2);  
                        const promedio = ((parseInt(peso_minimo) + parseFloat(peso_maximo))/2).toFixed(2);  

                        presentacion.push({
                            presentacionFinal: presentacionFinal,
                            peso_minimo: peso_minimo,
                            peso_maximo: peso_maximo,
                            promedio: promedio
                        });

                        console.log(`Presentación ${presentacionFinal}: Peso Mínimo = ${peso_minimo}`);
                        
                        // Asignar los valores a los campos correspondientes según la referencia
                        if (index === 0) {
                            document.getElementById('producto_minimo').value = peso_minimo;
                            document.getElementById('producto_medio').value = promedio;
                            document.getElementById('producto_maximo').value = peso_maximo;
                        } else if (index === 1) {
                            document.getElementById('producto_minimo2').value = peso_minimo;
                            document.getElementById('producto_medio2').value = promedio;
                            document.getElementById('producto_maximo2').value = peso_maximo;
                        } else if (index === 2) {
                            document.getElementById('producto_minimo3').value = peso_minimo;
                            document.getElementById('producto_medio3').value = promedio;
                            document.getElementById('producto_maximo3').value = peso_maximo;
                        } else if (index === 3) {
                            document.getElementById('producto_minimo4').value = peso_minimo;
                            document.getElementById('producto_medio4').value = promedio;
                            document.getElementById('producto_maximo4').value = peso_maximo;
                        }
                    } else {
                        console.log(`Datos inválidos para la presentación ${presentacionFinal}: densidad_final o presentacionFinal no es un número válido.`);
                    }
                });

                // Mostramos los resultados
                console.log('Resultados de Peso Mínimo por Presentación:', presentacion);
            } else {
                //alert('No se encontraron datos para este batch.');
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            //alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        //alert('Error al obtener los datos.');
    });
}

function esperar(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function cargarConciliacionRendi() {
    console.log('Cargando datos de Conciliación de Rendimiento');

    const urlParams = window.location.pathname.split('/');
    const batch = urlParams[2];  
    const extra = urlParams.slice(3).join('/');  

    console.log(`Número de batch extraído de la URL: ${batch}`);
    console.log(`Ruta extraída después de batch: ${extra}`);

    if (!batch) {
        console.error('No se ha extraído un valor válido para batch');
        //alert('No se ha extraído un valor válido para batch');
        return;
    }

    const apiUrl = `http://10.1.200.30:1901/conciliacion_rendimiento`;  
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response);
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            console.error("Esperado JSON, pero se recibió otro tipo de contenido:", contentType);
            alert(`Esperado JSON, pero se recibió otro tipo de contenido: ${contentType}`);
            return response.text();  
        }
        return response.json();  
    })
    .then(data => {
        console.log('Datos procesados de la respuesta:', data); // Ver qué datos estamos recibiendo

        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            //alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        if (data.success) {
            const result = data.data;
            console.log('Datos de resultado:', result); // Ver el resultado de la consulta SQL

            if (result && result.length > 0) {
                const resultado = result[0].resultado;  // Esto toma el resultado de la consulta SQL
                console.log('resultado conciliacion jesus', resultado);

                // Verificamos si se obtiene correctamente el valor
                if (document.getElementById('conciliacionRendimiento60')) {
                    // Asignamos el resultado al campo con id "conciliacionRendimiento60"
                    document.getElementById('conciliacionRendimiento60').value = resultado.toFixed(2); // Formateamos a dos decimales
                    console.log(`Conciliación de rendimiento: ${resultado.toFixed(2)}`);
                } else {
                    console.error('No se encontró el input con el id "conciliacionRendimiento60"');
                }
            } else {
                console.error('No se encontraron datos para el batch especificado.');
                alert('No se encontraron datos para este batch de conciliación de rendimiento.');
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            //alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        //alert('Error al obtener los datos.');
    });
}


async function cargarConciliacionRendiAcond() {
    console.log('Cargando datos de Conciliación de Rendimiento Acond');

    const urlParams = window.location.pathname.split('/');
    const batch = urlParams[2];  
    const extra = urlParams.slice(3).join('/');  

    console.log(`Número de batch extraído de la URL: ${batch}`);
    console.log(`Ruta extraída después de batch: ${extra}`);

    if (!batch) {
        console.error('No se ha extraído un valor válido para batch');
        alert('No se ha extraído un valor válido para batch');
        return;
    }

    const apiUrl = `http://10.1.200.30:1901/conciliacion_rendimiento_acond`;  
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response);
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            console.error("Esperado JSON, pero se recibió otro tipo de contenido:", contentType);
            alert(`Esperado JSON, pero se recibió otro tipo de contenido: ${contentType}`);
            return response.text();  
        }
        return response.json();  
    })
    .then(data => {
        console.log('Datos procesados de la respuesta:', data); // Ver qué datos estamos recibiendo

        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            //alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        if (data.success) {
            const result = data.data;
            console.log('Datos de resultado:', result); 

            if (result && result.length > 0) {
                const divisionAcondi = result[0].division_acondi;  
                console.log('Resultado de division_acondi:', divisionAcondi);

                // Verificamos si se obtiene correctamente el valor
                const inputField = document.getElementById('conciliacionRendimiento3');
                if (inputField) {
                    // Asignamos el resultado de division_acondi al campo con id "conciliacionRendimiento3"
                    inputField.value = divisionAcondi.toFixed(2); // Formateamos a dos decimales
                    console.log(`Conciliación de rendimiento acond: ${divisionAcondi.toFixed(2)}`);
                } else {
                    console.error('No se encontró el input con el id "conciliacionRendimiento3"');
                }
            } else {
                console.error('No se encontraron datos para el batch especificado.');
                alert('No se encontraron datos para este batch de conciliación de rendimiento.');
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        //alert('Error al obtener los datos.');
    });
}


async function consultarBatchDesdeURL() {
    const path = window.location.pathname;
    const match = path.match(/\/pdf\/(\d+)\//);  // Captura el número de batch

    if (match) {
        const batch = match[1];
        console.log("Batch detectado:", batch);

        fetch(`http://10.1.200.30:1001/pdf/${batch}/cualquier-nombre`)
            .then(response => response.json())
            .then(data => {
                const tablas = {
                    1: document.getElementById("tblMuestrasEnvasadoBody1"),
                    2: document.getElementById("tblMuestrasEnvasadoBody2"),
                    3: document.getElementById("tblMuestrasEnvasadoBody3"),
                    4: document.getElementById("tblMuestrasEnvasadoBody4")
                };

                const tablasData = data.tablas;

                for (let i = 1; i <= 4; i++) {
                    const tabla = tablas[i];
                    tabla.innerHTML = ""; // Limpia antes de insertar nuevas filas

                    const tablaKey = `tabla${i}`;
                    const tablaContenido = tablasData[tablaKey];

                    if (tablaContenido && Array.isArray(tablaContenido.muestras)) {
                        const muestras = tablaContenido.muestras;
                        const maxCols = 10;

                        // Cargar muestras en formato de tabla de hasta 10 columnas por fila
                        for (let j = 0; j < muestras.length; j += maxCols) {
                            const tr = document.createElement("tr");
                            const fila = muestras.slice(j, j + maxCols);

                            fila.forEach(valor => {
                                const td = document.createElement("td");
                                td.textContent = valor;
                                tr.appendChild(td);
                            });

                            tabla.appendChild(tr);
                        }

                        // ✅ Mostrar promedio y cantidad en los inputs correspondientes
                        const promedioInput = document.getElementById(`promedioMuestras${i}`);
                        const cantidadInput = document.getElementById(`cantidadMuestras${i}`);

                        if (promedioInput && cantidadInput) {
                            promedioInput.value = tablaContenido.promedio;
                            cantidadInput.value = tablaContenido.cantidad;
                        }
                    }
                }
            })
            .catch(error => {
                console.error("Error al obtener los datos:", error);
            });
    }
}



//window.onload = consultarBatchDesdeURL;



window.onload = async function() {
    await  cargarTara();
    await  cargarTaraPresentacion();
    await esperar(5000);
    await cargarTaraPeso();
    await cargarConciliacionRendi();
    await cargarConciliacionRendiAcond();
    await consultarBatchDesdeURL();
};
</script>
<!--<script src="../js/registrosTara.js"></script> 
<script src="../../html/pdf/js/registrosTara.js"></script>
<script src="../../html/pdf/js/batch_pdf.js"></script>
<script src="../../html/pdf/js/registrosTarav2.js"></script>

E:\www\htdocs\batch_record\html\pdf\js\registrosTara.js
E:\www\htdocs\batch_record\html\pdf\modules\envasado.php-->