<div class="card mt-5 mb-5">
    <div class="card-header centrado"><b>Anexo I - ORDEN DE PESAJE F</b></div>
    <div class="card-body">

        <!-- <div id="contenedorCertificadoPesaje" class="contenedorCertificadoPesaje">
            <div class="card">
                <div class="card-body">
                    <div class="certificadoPesaje">
                        <div class="grid-container gl mb-3">
                            <div class="logo"><img src="../../assets/images/logo/logo-samara.png" alt="logo_samara" id="logo"></div>
                            <div class="title2">ORDEN DE PESAJE</div>
                            <div>
                                <span id="codigo">Codigo</span>
                                <span id="version">Versión</span>
                                <span id="fecha">Fecha</span>
                            </div>
                        </div>

                        <div class="grid-container-product gl mb-3">
                            <div class="product"></div>
                            <div><b>FECHA:</b></div>
                            <div class="fecha_pesaje"></div>
                            <div><b>INVIMA:</b></div>
                            <div class="invima_id"></div>
                            <div><b>LINEA:</b></div>
                            <div class="linea"></div>
                            <div><b>LOTE:</b></div>
                            <div class="lote_id"></div>
                            <div><b>TAMAÑO LOTE:</b></div>
                            <div class="tamanioLotePesaje"></div>
                        </div>

                        <div class="grid-container-X3 mpcerti gl mb-3"></div>
                        <div style="display: grid;grid-template-columns: 1fr 1fr">
                            <div class="ml-5 realizo" style="justify-self:center;">
                                <label><b>Realizó</b></label>
                                <img id="realizo2" src="" alt="firma_usuario" height="130">
                            </div>
                            <div class="calidad" style="justify-self:center;">
                                <label><b>Verificó</b></label>
                                <img id="verifico2" src="" alt="firma_usuario" height="130">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <table style="width:100%" id="contenedorCertificadoPesaje">
            <tbody>
                <tr>
                    <td style="width: 40px;"></td>
                    <td class="text-center" style="width: 25%;height: 100px">
                        <img src="../../assets/images/logo/logo-samara.png" alt="logo_samara" id="logo">
                    </td>
                    <!---<td class="text-center title2" style="width: 100%;">
                        Anexo I - ORDEN DE PESAJE
                    </td>
                    <td class="text-center" style="width: 25%;">
                        <span id="codigo">Codigo</span>
                        <span id="version">Versión</span>
                        <span id="fecha">Fecha</span>-->
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table style="width:100%">
            <tbody>
                <tr>
                    <td class="text-center product" colspan="11">CREMA CONTROL ESTRIAS - VIBRANTY (GRANEL ) </td>
                </tr>
                <tr>
                    <td style="width: 3%;"></td>
                    <td style="width: 7%;"><b>FECHA:</b></td>
                    <td style="width: 10%;" class="fecha_pesaje">2023-06-22</td>
                    <td style="width: 7%;"><b>INVIMA:</b></td>
                    <td style="width: 13%;" class="invima_id">NSOC22530-23CO</td>
                    <td style="width: 7%;"><b>LINEA:</b></td>
                    <td style="width: 10%;" class="linea">SEMISÓLIDO</td>
                    <td style="width: 7%;"><b>LOTE:</b></td>
                    <td style="width: 10%;" class="lote_id">SM2310623</td>
                    <td style="width: 10%;"><b>TAMAÑO LOTE:</b></td>
                    <td class="tamanioLotePesaje" style="width: 10%;">110.16</td>
                </tr>
            </tbody>
        </table>

        <hr>

        <table class="mb-3" style="width: 100%;">
            <tbody class="mpcerti">

            </tbody>
        </table>

        <hr>

        <table style="width:100%">
            <tbody>
                <tr>
                    <td style="width:40px"></td>
                    <td class="text-center" style="width:50% ;height: 130px">
                        <b>Realizó</b>
                        <img id="realizo2" src="" alt="firma_usuario" style="height:100px">
                    </td>
                    <td class="text-center" style="width:50% ;height: 130px">
                        <b>Verificó</b>
                        <img id="verifico2" src="" alt="firma_usuario" style="height:100px">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!---->
    <div class="card-header centrado"><b>Anexo II  - INSTRUCTIVO DE PREPARACION</b></div>
    <div class="card-body">
    <div style="max-height: 400px; ">
        <table id="contenedorCertificadoPesaje2"
               style="width: 100%; border-collapse: collapse; " 
               border="1">
            <thead style="background-color: #FF7F50; color: white;">
                <tr>
                    <th style="padding: 10px;">Pasos</th>
                    <th style="padding: 10px;">Procedimiento</th>
                    <th style="padding: 10px;">Tiempo (min)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las filas se llenarán dinámicamente desde el backend -->
            </tbody>
        </table>
    </div>
</div>


<script>
   document.addEventListener('DOMContentLoaded', function() {
       // Función para obtener los valores dinámicos de la URL
       function getDynamicValuesFromUrl() {
           const url = window.location.href;
           const parts = url.split('/'); 
           const num_batch = parts[parts.length - 2];  // Obtener el penúltimo valor de la URL
           const id_producto = parts[parts.length - 1]; // Obtener el último valor de la URL

           return { num_batch, id_producto };
       }

       // Función para obtener los datos del backend
       async function getPDFData() {
           const { num_batch, id_producto } = getDynamicValuesFromUrl();
           console.log(`Fetching data from: http://10.1.200.30:6800/pdf/${num_batch}/${id_producto}`);

           const url = `http://10.1.200.30:6800/pdf/${num_batch}/${id_producto}`; // URL del backend

           try {
               const response = await fetch(url);
               if (!response.ok) {
                   throw new Error('Error al obtener los datos');
               }

               const data = await response.json(); // Parsear los datos JSON recibidos
               console.log('Datos recibidos:', data);

               // Procesar los datos y llenar la tabla
               const tbody = document.querySelector("#contenedorCertificadoPesaje2 tbody");
               tbody.innerHTML = ''; // Limpiar la tabla

               data.forEach((row, index) => {
                   const tr = document.createElement("tr");
                   tr.innerHTML = `
                       <td>${index + 1}</td>
                       <td>${row.pasos}</td>
                       <td>${row.tiempo}</td>
                   `;
                   tbody.appendChild(tr);
               });

           } catch (error) {
               console.error('Error en la solicitud:', error);
               alert('No se pudieron cargar los datos del servidor');
           }
       }

       // Llamar a la función cuando la página cargue
       getPDFData();
   });
</script>

