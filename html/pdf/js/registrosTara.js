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
        alert('No se ha extraído un valor válido para batch');
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

                    document.getElementById('envase_min_tara').value = sumMinimo_1;
                    document.getElementById('envase_med_tara').value = sumMedio_1;
                    document.getElementById('envase_max_tara').value = sumMax_1;
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

                    document.getElementById('envase_min_tara2').value = sumMinimo_2;
                    document.getElementById('envase_med_tara2').value = sumMedio_2;
                    document.getElementById('envase_max_tara2').value = sumMax_2;
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

                    document.getElementById('envase_min_tara3').value = sumMinimo_3;
                    document.getElementById('envase_med_tara3').value = sumMedio_3;
                    document.getElementById('envase_max_tara3').value = sumMax_3;
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

                    document.getElementById('envase_min_tara4').value = sumMinimo_4;
                    document.getElementById('envase_med_tara4').value = sumMedio_4;
                    document.getElementById('envase_max_tara4').value = sumMax_4;
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
            alert('Hubo un error en la respuesta del servidor.');
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
                        const peso_minimo = presentacionFinal * densidad_final;
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
                alert('No se encontraron datos para este batch.');
            }
        } else {
            console.log('No se encontraron datos para el batch especificado.');
            alert('No se encontraron datos para el batch especificado.');
        }
    })
    .catch(error => {
        console.error('Hubo un problema con la solicitud:', error);
        alert('Error al obtener los datos.');
    });
}

function esperar(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}



window.onload = async function() {
    await  cargarTara();
    await  cargarTaraPresentacion();
    await esperar(5000);
    await cargarTaraPeso();
};