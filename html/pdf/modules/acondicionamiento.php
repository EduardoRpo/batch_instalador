<div class="subtitleProcess"><label><b>ACONDICIONAMIENTO</b></label></div>

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
                <tbody id="despeje_linea6">

                </tbody>
            </table>
        </div>
    </div>

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
            <table class="table table-bordered table-striped" id="">
                <thead class="head centrado">
                    <tr>
                        <td class="centrado">Área/Equipo</td>
                        <td class="centrado">Desinfectante</td>
                        <td class="centrado">%</td>
                        <td class="centrado">Número de Lote Anterior</td>
                    </tr>
                </thead>
                <tbody id="area_desinfeccion6">

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
        <!-- <div class="p-3 proceso">
            <label for="">Producto</label><label for="" class="ref" style="font-weight: bold;"></label>
            <label for="">Lote</label><label for="" class="lote"></label>
            <label for="">Fecha</label><label for="" class="fecha"></label>
            <label for="">Orden</label><label for="" class="orden"></label>
        </div>

        <div class="enlinea mt-3">
            <label class="mr-3" style="justify-self: end;">Fecha</label>
            <label id="fecha6" style="font-weight:bold; justify-self: baseline"></label>
        </div>

        <div class="firmas" id="firmas5">
            <img id="f_realizo6" src="" alt="firma_usuario" height="130">
            <img id="f_verifico6" src="" alt="firma_usuario" height="130">
            <label id="user_realizo6"></label>
            <label id="user_verifico6"></label>
        </div> -->
        <table class="mb-4">
            <tbody>
                <tr>
                    <td style="width:60px"></td>
                    <td style="width:227px">Producto:</td>
                    <td style="width:400px" class="ref" style="font-weight: bold;"></td>
                    <td style="width:320px">Lote:</td>
                    <td class="lote"></td>
                </tr>
                <tr>
                    <td style="width:60px"></td>
                    <td style="width:227px">Fecha:</td>
                    <td style="width:400px" class="fecha"></td>
                    <td style="width:320px">Orden:</td>
                    <td class="orden"></td>
                </tr>
            </tbody>
        </table>
        <table class="mt-3" id="firmas5">
            <tbody>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-right" style="width: 600px; padding-right:10px">Fecha</td>
                    <td id="fecha6" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" style="height: 100px">
                        <img id="f_realizo6" src="" alt="firma_usuario">
                    </td>
                    <td class="text-center" style="height: 100px">
                        <img id="f_verifico6" src="" alt="firma_usuario">
                    </td>
                </tr>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" id="user_realizo6"></td>
                    <td class="text-center" id="user_verifico6"></td>
                </tr>
            </tbody>
        </table>


        <div id="multi-acondicionamiento1">
            <div class="subtitleProcess" id="subtitle_acond1"><label for="" id="titulo_acondicionamiento1"> <b>ACONDICIONAMIENTO</b></label></div>
            <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

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
                            <td id="empaque1" class="centrado empaque1"></td>
                            <td id="descripcion_empaque1" class="descripcion_empaque1"></td>
                            <td id="unidades1e" class="centrado unidadesEmpaque1"></td>
                        </tr>
                        <tr>
                            <td id="otros1" class="centrado otros1"></td>
                            <td id="descripcion_otros1" class="descripcion_otros1"></td>
                            <td id="unidades4" class="centrado unidadesOtros1"></td>
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
                            <td id="unidadesEmpaque1" class="centrado unidadesEmpaque1"></td>
                            <td id="utilizada_empaque1" class="centrado envasada1" style="width: 110px;"></td>
                            <td id="averias_empaque1" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_empaque1" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                        </tr>
                        <tr>
                            <td id="refempaque2" class="otros1"></td>
                            <td id="descripcion_otros1" class="descripcion_otros1"></td>
                            <td id="unidadesOtros1" class="centrado unidadesOtros1"></td>
                            <td id="utilizada_otros1" class="centrado envasada1e" style="width: 110px;"></td>
                            <td id="averias_otros1" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_otros1" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label>Conciliación de rendimiento</label></div>
            <!-- <div class="conciliacion">
                <label style="justify-self: end;">Conciliacion rendimiento</label>
                <input type="text" class="form-control centrado" id="conciliacionRendimiento1" style="width: 30%;justify-self: baseline" readonly>
            </div>

            <div class="enlinea mt-3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha6Conciliacion1" style="font-weight:bold; justify-self: baseline"></label>
            </div>

            <div class="col1" id="firmas6">
                <img id="f_realizoConciliacion1" src="" alt="firma_usuario" height="130">
                <label id="user_realizoConciliacion1"></label>
            </div> -->

            <table class="mt-3" id="firmas6">
                <tbody>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Conciliacion rendimiento</td>
                        <td style="width: 50%;">
                            <input type="text" class="form-control" id="conciliacionRendimiento1" style="width: 30%;justify-self: baseline" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Fecha</td>
                        <td id="fecha6Conciliacion1" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="height: 100px" colspan="3">
                            <img id="f_realizoConciliacion1" src="" alt="firma_usuario">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" id="user_realizoConciliacion1" colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-acondicionamiento2">
            <div class="subtitleProcess"><label for="" id="titulo_acondicionamiento2"> <b>ACONDICIONAMIENTO</b></label></div>
            <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

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
                            <td id="empaque2" class="centrado empaque2"></td>
                            <td id="descripcion_empaque2" class="descripcion_empaque2"></td>
                            <td id="unidadesEmpaque2" class="centrado unidadesEmpaque2"></td>
                        </tr>
                        <tr>
                            <td id="otros2" class="centrado otros2"></td>
                            <td id="descripcion_otros2" class="descripcion_otros2"></td>
                            <td id="unidadesOtros2" class="centrado unidadesOtros2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control de Proceso</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped" id="muestrasAcondicionamiento2">
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
                            <td id="refempaque2" class="empaque2"></td>
                            <td id="descripcion_empaque2" class="descripcion_empaque2"></td>
                            <td id="unidadesEmpaque2" class="centrado unidadesEmpaque2"></td>
                            <td id="utilizada_empaque2" class="centrado envasada2" style="width: 110px;"></td>
                            <td id="averias_empaque2" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_empaque2" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                        </tr>
                        <tr>
                            <td id="refempaque2" class="otros1"></td>
                            <td id="descripcion_otros2" class="descripcion_otros2"></td>
                            <td id="unidadesOtros2" class="centrado unidadesOtros2"></td>
                            <td id="utilizada_otros2" class="centrado envasada2" style="width: 110px;"></td>
                            <td id="averias_otros2" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_otros2" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label>Conciliación de rendimiento</label></div>
            <!-- <div class="conciliacion">
                <label style="justify-self: end;">Conciliacion rendimiento</label>
                <input type="text" class="form-control centrado" id="conciliacionRendimiento2" style="width: 30%;justify-self: baseline" readonly>
            </div>

            <div class="enlinea mt-3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha6Conciliacion2" style="font-weight:bold; justify-self: baseline"></label>
            </div>

            <div class="col1" id="firmas6">
                <img id="f_realizoConciliacion2" src="" alt="firma_usuario" height="130">
                <label id="user_realizoConciliacion2"></label>
            </div> -->
            <table class="mt-3" id="firmas6">
                <tbody>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Conciliacion rendimiento</td>
                        <td style="width: 50%;">
                            <input type="text" class="form-control" id="conciliacionRendimiento2" style="width: 30%;justify-self: baseline" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Fecha</td>
                        <td id="fecha6Conciliacion2" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="height: 100px" colspan="3">
                            <img id="f_realizoConciliacion2" src="" alt="firma_usuario">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" id="user_realizoConciliacion2" colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-acondicionamiento3">
            <div class="subtitleProcess"><label for="" id="titulo_acondicionamiento3"> <b>ACONDICIONAMIENTO</b></label></div>
            <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

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

                            <td id="empaque3" class="centrado empaque3"></td>
                            <td id="descripcion_empaque3" class="descripcion_empaque3"></td>
                            <td id="unidades3e" class="centrado unidadesEmpaque3"></td>
                        </tr>
                        <tr>

                            <td id="otros3" class="centrado otros3"></td>
                            <td id="descripcion_otros3" class="descripcion_otros3"></td>
                            <td id="unidades3" class="centrado unidadesOtros3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control de Proceso</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped" id="muestrasAcondicionamiento3">
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
                            <td id="refempaque3" class="empaque3"></td>
                            <td id="descripcion_empaque3" class="descripcion_empaque3"></td>
                            <td id="unidadesEmpaque3" class="centrado unidadesEmpaque3"></td>
                            <td id="utilizada_empaque3" class="centrado envasada3" style="width: 110px;"></td>
                            <td id="averias_empaque3" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_empaque3" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                        </tr>
                        <tr>
                            <td id="refempaque3" class="otros3"></td>
                            <td id="descripcion_otros3" class="descripcion_otros3"></td>
                            <td id="unidadesOtros3" class="centrado unidadesOtros3"></td>
                            <td id="utilizada_otros3" class="centrado envasada3" style="width: 110px;"></td>
                            <td id="averias_otros3" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_otros3" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label>Conciliación de rendimiento</label></div>
            <!-- <div class="conciliacion">
                <label style="justify-self: end;">Conciliacion rendimiento</label>
                <input type="text" class="form-control centrado" id="conciliacionRendimiento3" style="width: 30%;justify-self: baseline" readonly>
            </div>

            <div class="enlinea mt-3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha6Conciliacion3" style="font-weight:bold; justify-self: baseline"></label>
            </div>

            <div class="col1" id="firmas6">
                <img id="f_realizoConciliacion3" src="" alt="firma_usuario" height="130">
                <label id="user_realizoConciliacion3"></label>
            </div> -->
            <table class="mt-3" id="firmas6">
                <tbody>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Conciliacion rendimiento</td>
                        <td style="width: 50%;">
                            <input type="text" class="form-control" id="conciliacionRendimiento3" style="width: 30%;justify-self: baseline" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Fecha</td>
                        <td id="fecha6Conciliacion3" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="height: 100px" colspan="3">
                            <img id="f_realizoConciliacion3" src="" alt="firma_usuario">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" id="user_realizoConciliacion3" colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="multi-acondicionamiento4">
            <div class="subtitleProcess"><label for="" id="titulo_acondicionamiento4"> <b>ACONDICIONAMIENTO</b></label></div>
            <div class="subtitle"><label for="">Entrega Insumos Acondicionamiento</label></div>

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
                            <td id="empaque4" class="centrado empaque4"></td>
                            <td id="descripcion_empaque4" class="descripcion_empaque4"></td>
                            <td id="unidades4" class="centrado unidadesEmpaque4"></td>
                        </tr>
                        <tr>
                            <td id="otros4" class="centrado otros4"></td>
                            <td id="descripcion_otros4" class="descripcion_otros4"></td>
                            <td id="unidades4" class="centrado unidadesOtros4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="subtitle"><label for="">Control de Proceso</label></div>

            <div class="p-3">
                <table class="table table-bordered table-striped" id="muestrasAcondicionamiento4">
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
                            <td id="refempaque4" class="empaque4"></td>
                            <td id="descripcion_empaque4" class="descripcion_empaque4"></td>
                            <td id="unidadesEmpaque4" class="centrado unidadesEmpaque4"></td>
                            <td id="utilizada_empaque4" class="centrado envasada4e" style="width: 110px;"></td>
                            <td id="averias_empaque4" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_empaque4" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_empaque1" class="centrado"></td> -->
                        </tr>
                        <tr>
                            <td id="refempaque4" class="otros4"></td>
                            <td id="descripcion_otros4" class="descripcion_otros4"></td>
                            <td id="unidadesOtros4" class="centrado unidadesOtros4"></td>
                            <td id="utilizada_otros4" class="centrado envasada4e" style="width: 110px;"></td>
                            <td id="averias_otros4" class="centrado" style="width: 110px;"></td>
                            <td id="sobrante_otros4" class="centrado" style="width: 110px;"></td>
                            <!-- <td id="totalDevolucion_otros1" class="centrado"></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="subtitle"><label>Conciliación de rendimiento</label></div>
            <!-- <div class="conciliacion">
                <label style="justify-self: end;">Conciliacion rendimiento</label>
                <input type="text" class="form-control centrado" id="conciliacionRendimiento4" style="width: 30%;justify-self: baseline" readonly>
            </div>

            <div class="enlinea mt-3">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha6Conciliacion4" style="font-weight:bold; justify-self: baseline"></label>
            </div>

            <div class="col1" id="firmas6">
                <img id="f_realizoConciliacion4" src="" alt="firma_usuario" height="130">
                <label id="user_realizoConciliacion4"></label>
            </div> -->
            <table class="mt-3" id="firmas6">
                <tbody>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Conciliacion rendimiento</td>
                        <td style="width: 50%;">
                            <input type="text" class="form-control" id="conciliacionRendimiento4" style="width: 30%;justify-self: baseline" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-right" style="width: 600px; padding-right:10px">Fecha</td>
                        <td id="fecha6Conciliacion4" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td class="text-center" style="height: 100px" colspan="3">
                            <img id="f_realizoConciliacion4" src="" alt="firma_usuario">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" id="user_realizoConciliacion4" colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>