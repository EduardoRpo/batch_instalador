<div class="card mt-5 mb-5">
<div class="card-header centrado"><b>Anexo I - ORDEN DE PESAJE</b></div>
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
     <div style="margin-top: 20px; text-align: right;" class='mt-5'>
        <label for="totalPorcentaje"><b>Total Porcentaje (%)</b></label>
        <input type="text" class="form-control" id="totalPorcentaje" readonly value="" style="width: 200px; display: inline-block; margin-right: 10px;">

        <label for="pesoTotalPeso"><b>Total Peso (Kg)</b></label>
        <input type="text" class="form-control" id="pesoTotalPeso" readonly value="" style="width: 200px; display: inline-block;">
    </div>
</div>

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
    

    <div class="card-header centrado"><b>ETIQUETAS PROCESO PESAJE</b></div>
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

        // Llamar a la función cuando la página cargue
        getOrdenPesajeData();
    });
</script>
