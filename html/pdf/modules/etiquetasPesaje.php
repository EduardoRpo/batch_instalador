<div class="card-header centrado"><b>ETIQUETAS PROCESO PESAJE</b></div>
    <div class="card-body">

        <div id="contenedorEtiquetasR" class="contenedorEtiquetasR">
            <div class="card">
                <div class="card-body">
                    <div class="etiquetasR">

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="card mt-5 mb-5">
    <div class="card-header centrado"><b>Anexo I - ORDEN DE PESAJE</b></div>
    <table style="width:100%">
            <tbody>
                <tr>
                    <td class="text-center product" colspan="11">CREMA CONTROL ESTRIAS - VIBRANTY (GRANEL ) </td>
                </tr>
                <tr style="white-space: nowrap;">
    <td style="width: 1%;"></td>
    <td style="width: 3%;"><b>FECHA:</b></td>
    <td style="width: 10%;" class="fecha_pesaje">2023-06-22</td>
    <td style="width: 7%;"><b>INVIMA:</b></td>
    <td style="width: 13%;" class="invima_id">NSOC22530-23CO</td>
    <td style="width: 7%;"><b>LINEA:</b></td>
    <td style="width: 8%;" class="linea">SEMISÓLIDO</td>
    <td style="width: 5%;"><b>LOTE:</b></td>
    <td style="width: 10%;" class="lote_id">SM2310623</td>
    <td style="width: 10%;"><b>TAMAÑO LOTE:</b></td>
    <td class="tamanioLotePesaje" style="width: 10%;">110.16</td>
    <td style="width: 10%; "><b>(%) FORMULA:</b></td>
    <td style="width: 10%;"><input type="text" class="form-control" id="totalPorcentaje" readonly value="" style="border: none; background-color: transparent; box-shadow: none;"></td>
</tr>

            </tbody>
        </table>
    <div class="card-body mb-5">
        <div style="max-height: 400px;">
            <table id="contenedorOrdenPesaje" style="width: 100%; border-collapse: collapse;" border="1">
                <thead style="background-color: #FF7F50; color: white;">
                    <tr>
                        <th style="padding: 10px;">Tamaño Lote</th>
                        <th style="padding: 10px;">ID Producto</th>
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">Referencia</th>
                        <th style="padding: 10px;">Alias</th>
                        <th style="padding: 10px;">Porcentaje (%)</th>
                        <th style="padding: 10px;">Peso (Kg)</th>
                        <th style="padding: 10px;">Batch Lote Materiales</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <!-- Las filas se llenarán dinámicamente desde el backend -->
                </tbody>
            </table>
        </div>
       
        <!-- Fila con los totales al final de la tabla -->
        <div style="margin-top: 5rem; text-align: right;" ></div>
        <!--
            <label for="totalPorcentaje"><b>Total Porcentaje (%)</b></label>
            <input type="text" class="form-control" id="totalPorcentaje" readonly value="" style="width: 200px; display: inline-block; margin-right: 10px;">

            <label for="pesoTotalPeso"><b>Total Peso (Kg)</b></label>
            <input type="text" class="form-control" id="pesoTotalPeso" readonly value="" style="width: 200px; display: inline-block;">
        </div>-->
    </div>

    

    <div class="card-header centrado mt-5"><b>ETIQUETAS PROCESO PESAJE F</b></div>
    <div class="card-body">

        <div id="contenedorEtiquetasV" class="contenedorEtiquetasV">
            <div class="card">
                <div class="card-body">
                    <div class="etiquetasV">

                    </div>
                </div>
            </div>
        </div>
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
        async function getOrdenPesajeData() {
            const { num_batch, id_producto } = getDynamicValuesFromUrl();
            console.log(`Fetching data from: http://10.1.200.30:7800/pdf/${num_batch}/${id_producto}`);

            const url = `http://10.1.200.30:7800/pdf/${num_batch}/${id_producto}`; // URL del backend

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }

                const data = await response.json(); // Parsear los datos JSON recibidos
                console.log('Datos recibidos prueba jesus:', data);

                // Procesar los datos y llenar la tabla
                const tbody = document.querySelector("#contenedorOrdenPesaje tbody");
                tbody.innerHTML = ''; // Limpiar la tabla
                let totalPorcentaje = 0;
                let totalPeso = 0;

                // Si se reciben datos válidos
                if (data.length > 0) {
                    data.forEach((row, index) => {
                        const tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${(row.tamano_lote).toFixed(3) || 'No disponible'}</td>
                            <td>${row.id_producto || 'No disponible'}</td>
                            <td>${row.id || 'No disponible'}</td>
                            <td>${row.referencia || 'No disponible'}</td>
                            <td>${row.alias || 'No disponible'}</td>
                            <td>${(row.porcentaje) || 'No disponible'}</td>
                            <td>${(row.peso).toFixed(3) || 'No disponible'}</td>
                            <td>${row.batch_lote_materiales || 'No disponible'}</td>
                        `;
                        tbody.appendChild(tr);
                        totalPorcentaje += parseFloat(row.porcentaje) || 0;
                        totalPeso += parseFloat(row.peso) || 0;
                    });
                    document.getElementById("totalPorcentaje").value = totalPorcentaje.toFixed(2);
                    document.getElementById("pesoTotalPeso").value = totalPeso.toFixed(3);
                } else {
                    alert('No se encontraron datos para esta orden de pesaje.');
                }

            } catch (error) {
                console.error('Error en la solicitud:', error);
                alert('No se pudieron cargar los datos del servidor');
            }
        }
        

        async function getEtiquetasData() {
            const { num_batch, id_producto } = getDynamicValuesFromUrl();
            console.log(`Fetching data from: http://10.1.200.30:6745/pdf/${num_batch}/${id_producto}`);

            const url = `http://10.1.200.30:6745/pdf/${num_batch}/${id_producto}`; // URL del backend (actualizada)

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }

                const data = await response.json(); // Parsear los datos JSON recibidos
                console.log('Datos recibidos:', data);

                // Asegurarnos de que el contenedor de etiquetas existe en el DOM
                const contenedorEtiquetas = document.querySelector(".etiquetasR");
                if (!contenedorEtiquetas) {
                    console.error('El contenedor .etiquetasR no se encuentra en el DOM');
                    return;
                }

                // Limpiar el contenedor antes de agregar nuevas etiquetas
                contenedorEtiquetas.innerHTML = '';

                // Establecer un contenedor flex para asegurar una correcta disposición
                contenedorEtiquetas.style.display = 'flex';
                contenedorEtiquetas.style.flexWrap = 'wrap'; // Asegura que las etiquetas se ajusten

                // Crear etiquetas con los datos recibidos
                data.forEach((etiqueta) => {
                    const divEtiqueta = document.createElement("div");
                    divEtiqueta.style.width = "31%";
                    divEtiqueta.style.margin = "5px";

                    // Convertir porcentaje a número y asegurarnos de que sea un número válido
                    const porcentaje = parseFloat(etiqueta.porcentaje) || 0;

                    divEtiqueta.innerHTML = `
                        <table class="etiquetaUnica rounded-3" style="width:100%;">
                            <tr>
                                <td style="width: 50%;">
                                    <b>REFERENCIA: </b>${etiqueta.referencia}
                                </td>
                                <td style="width: 50%; font-size: 25px;">
                                    <b>PESO: </b>${porcentaje.toFixed(2)}Kg
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>ALIAS:</b> ${etiqueta.alias}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>ORDEN: </b>${etiqueta.numero_orden}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>LOTE: </b>${etiqueta.numero_lote}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>FECHA: </b>${etiqueta.fecha_programacion}
                                </td>
                            </tr>
                        </table>
                    `;
                    contenedorEtiquetas.appendChild(divEtiqueta);
                });

            } catch (error) {
                console.error('Error en la solicitud:', error);
                alert('No se pudieron cargar las etiquetas del servidor');
            }
        }


        // Llamar a la función cuando la página cargue
        getOrdenPesajeData();
        getEtiquetasData();
    });
</script>
