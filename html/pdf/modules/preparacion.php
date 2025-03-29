<div class="subtitleProcess"><label for=""> <b>PREPARACIÓN DEL GRANEL</b></label></div>

<div class="card mt-3">
    <div class="card-header centrado"><b>DESPEJE DE LINEA DE LOS PROCESOS Y VERIFICACIONES INICIALES</b></div>
    <div class="card-body">
        <div class="group-despeje-pesaje p-3">
            <table class="table table-striped">
                <thead class="head">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Parametros de Control</th>
                        <th scope="col">Si</th>
                        <th scope="col">No</th>
                    </tr>
                </thead>
                <tbody id="despeje_linea3">
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-header centrado"><b>PREPARACIÓN</b></div>
    <div class="card-body">

        <div class="subtitle">
            <label for="">Limpieza y Desinfección</label>
        </div>
        <div class="alertas" id="alert_pesaje">
            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                <label id="title6"></label>
                <ul id="vinetas6">

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
                <tbody id="area_desinfeccion3">

                </tbody>
            </table>
        </div>

        <div class="subtitle"><label for="">Equipos</label></div>
        <div class="p-3">
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 1%;"></td>
                        <td style="width: 25%;">Identificación Agitador</td>
                        <td style="width: 69.5%;">
                            <input type="text" class="form-control" id="agitador">
                        </td>
                        <td style="width: 3.5%;"></td>
                    </tr>
                    <tr style="height: 80px">
                        <td style="width: 1%;"></td>
                        <td style="width: 25%;">Identificación Marmita o Tanque</td>
                        <td style="width: 69.5%;">
                            <input type="text" class="form-control" id="marmita">
                        </td>
                        <td style="width: 3.5%;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="equipos">
            <label for="">Identificación Agitador</label>
            <input type="text" class="form-control" id="agitador">
            <label for="">Identificación Marmita o Tanque</label>
            <input type="text" class="form-control" id="marmita">
        </div> -->

        <div class="subtitle"><label for="">4.2 Liberación de Agua Desionizada por parte de Calidad para el dìa  </label></div> <!--colocar fecha de la firma del modulo preparacion--> 
        <div class="table-responsive p-3">
            <table class="table table-bordered table-striped">
                <thead class="head">
                    <tr>
                        <td>Parametros</td>
                        <td>Cumple</td>
                        <td>Observaciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="centrado">Color</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Olor</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Apariencia</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Conductividad 1</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Conductividad 2</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Cloro Libre</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Nitratos</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Dureza</td>
                        <td class="centrado">Si</td>
                        <td class="centrado"></td>
                    </tr>
                </tbody>
            </table>

            <!-- <div class="firmas" id="firmas2">
                <label class="mr-3" style="justify-self: end;">Fecha</label>
                <label id="fecha2" class="fecha2" style="font-weight:bold; justify-self: baseline"></label>
                <label id="user_realizo2">Realizado por:</label>
                <label id="user_verifico2">Verificado por:</label>
                <img id="f_realizo7" src="../../../admin/assets/img/firmas/ARELIS CUBIDES.jpg" alt="firma_usuario" height="130">
                <img id="f_realizo7" src="../../../admin/assets/img/firmas/LUISA VILLA.jpg" alt="firma_usuario" height="130">
            </div> -->
            <table class="mt-3" id="firmas2" style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:5%"></td>
                        <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                        <td id="fecha2" class="fecha2" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" id="user_realizo2">Aprobó Liberación: </td>
                       <!-- <td class="text-center" id="user_verifico2">Verificado por: </td>-->
                    </tr>
                    <tr>
                        <td style="width:40px"></td>
                        <td class="text-center" style="height: 130px">
                            <img id="f_realizo7" src="../../../admin/assets/img/firmas/VERO_JARAMILLO.jpg" alt="firma_usuario" style="height:100px">
                        </td>
                       <!-- <td class="text-center" style="height: 130px">
                          <img id="f_verifico7" src="../../../admin/assets/img/firmas/LUISA VILLA.jpg" alt="firma_usuario" style="height:100px">
                        </td>-->
                    </tr>
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
                    <td class="centrado bold fecha_medio3" id="fecha_medio3"></td>
                    <td class="centrado">18 - 25 °C</td>
                    <td class="centrado bold temperatura3" id="temperatura3"></td>
                    <td class="centrado">30 - 75 %</td>
                    <td class="centrado bold humedad3" id="humedad3"></td>
                </tbody>
            </table>
        </div>

        <div class="subtitle"><label for="">Procedimiento de Preparación</label></div>
        <div class="alertas" id="alert_pesaje">
            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
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
            <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
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
                        <td class="centrado espec_color"></td>
                        <td class="centrado color3"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Olor</td>
                        <td class="centrado espec_olor"></td>
                        <td class="centrado olor3"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Apariencia</td>
                        <td class="centrado espec_apariencia"></td>
                        <td class="centrado apariencia3"></td>

                    </tr>
                    <tr>
                        <td class="centrado">PH</td>
                        <td class="centrado espec_ph"></td>
                        <td class="centrado ph3"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Viscosidad (cps)</td>
                        <td class="centrado espec_viscosidad"></td>
                        <td class="centrado viscosidad3"></td>

                    </tr>
                    <tr>
                        <td class="centrado">Densidad o gravedad específica (g/ml)</td>
                        <td class="centrado espec_densidad"></td>
                        <td class="centrado densidad3"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Untuosidad</td>
                        <td class="centrado espec_untuosidad"></td>
                        <td class="centrado untuosidad3"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Poder Espumoso</td>
                        <td class="centrado espec_poder_espumoso"></td>
                        <td class="centrado espumoso3"></td>
                    </tr>
                    <tr>
                        <td class="centrado">Grado de Alcohol</td>
                        <td class="centrado espec_grado_alcohol"></td>
                        <td class="centrado alcohol3"></td>
                    </tr>
                </tbody>
            </table>
            <div class="alertas" id="alert_pesaje">
                <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
                    <label id="title9"></label>
                    <ul id="vinetas9">
                    </ul>
                </div>
            </div>
        </div>

        <div class="subtitle"><label for="">Ajustes</label></div>
        <table style="width: 100%;">
            <tbody>
                <tr style="height: 80px">
                    <td class="text-right" style="width: 40%; padding-right:10px">Si</td>
                    <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                        <input type="text" class="form-control centrado" id="Si3">
                    </td>
                    <td class="text-right" style="width: 7%; padding-right:10px">No</td>
                    <td style="font-weight:bold; justify-self: baseline; width: 5%;">
                        <input type="text" class="form-control centrado" id="No3">
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
                        <input type="textarea" class="form-control" id="materiaPrimaAjustes3">
                    </td>
                    <td style="width: 1.5%;"></td>
                </tr>
                <tr>
                    <td style="width: 1%;"></td>
                    <td style="width: 25%; padding-left:7px">Procedimiento de Ajuste</td>
                    <td style="width: 71.5%;">
                        <input type="textarea" class="form-control" id="procedimientoAjustes3">
                    </td>
                    <td style="width: 1.5%;"></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="ajustes">
            <div class="resp">
                <label for="">Si</label>
                <input type="text" class="form-control centrado" id="Si3">
                <label for="">No</label>
                <input type="text" class="form-control centrado" id="No3">
            </div>
            <div class="obs mb-5">
                <label for="">Materia(s) primas para adicionar </label>
                <input type="textarea" class="form-control" id="materiaPrimaAjustes3">
                <label for="">Procedimiento de Ajuste</label>
                <input type="textarea" class="form-control" id="procedimientoAjustes3">
            </div>

        </div> -->

    </div>
    <div class="subtitle"><label for="">Almacenamiento Granel Preparado</label></div>
    <div class="alertas" id="alert_pesaje">
        <div class="alert alert-secondary alert-dismissible fade show m-3" role="alert">
            <label id="title10"></label>
            <ul id="vinetas10">
            </ul>
        </div>
    </div>

    <div class="subtitle"><label for="">Observaciones</label></div>
    <div id="obs3" class="ml-5 mt-3 mb-3"></div>
    <!--<div class="subtitle"><label for=""></label></div> -->

    <!-- <div class="firmas" id="firmas3">
        <label class="mr-3" style="justify-self: end;">Fecha</label>
        <label id="fecha3" style="font-weight:bold; justify-self: baseline"></label>

        <div id="blank_rea3"></div>
        <img id="f_realizo3" src="" alt="firma_usuario" height="130">
        <div id="blank_ver3"></div>
        <img id="f_verifico3" src="" alt="firma_usuario" height="130">

        <label id="user_realizo3"></label>
        <label id="user_verifico3"></label>
    </div> -->
    <div class="subtitle"><label for="">Anexos</label></div>
    <div id="obs3" class="ml-5 mt-3 mb-3">
        <ul>
            <li>Anexo 2: Instructivo de Preparación</li>
            
        </ul>
    </div>
    <div class="subtitle"><label for=""></label></div>
    <table class="mt-3" id="firmas3" style="width:100%">
        <tbody>
            <tr>
                <td style="width:5%"></td>
                <td class="text-right" style="width: 45%; padding-right:10px">Fecha</td>
                <td id="fecha3" style="font-weight:bold; justify-self: baseline; width: 50%;"></td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" style="height: 130px">
                    <img id="f_realizo3" src="" alt="firma_usuario" style="height:100px">
                </td>
                <td class="text-center" style="height: 130px">
                    <img id="f_verifico3" src="" alt="firma_usuario" style="height:100px">
                </td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td class="text-center" id="user_realizo3"></td>
                <td class="text-center" id="user_verifico3"></td>
            </tr>
        </tbody>
    </table>
</div>