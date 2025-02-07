function cargarTara() {
    console.log('archivo tara cargado');
    
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

    const apiUrl = `http://10.1.200.30:5656/obtener_valores_tara2`;
    console.log(`Haciendo solicitud a la URL: ${apiUrl}`);

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            batch: batch,
            extra: extra
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
            // Agrupar los valores por referencia
            const groupedData = {};

            data.data.forEach(row => {
                if (!groupedData[row.referencia]) {
                    groupedData[row.referencia] = [];
                }
                groupedData[row.referencia].push(row.tara);
            });

            // Obtener el contenedor donde se agregarán las tablas
            const contenedorTablas = document.getElementById('contenedorTablas');

            // Limpiar el contenedor antes de agregar nuevas tablas
            contenedorTablas.innerHTML = '';

            // Para cada grupo de referencia, creamos su propia tabla
            for (const referencia in groupedData) {
                // Crear el contenedor de la referencia
                const tituloEnvasado = document.createElement('div');
                tituloEnvasado.className = 'subtitleProcess';
                tituloEnvasado.innerHTML = `<b>Peso Envase <br>REFERENCIA: ${referencia}</b>`;
                contenedorTablas.appendChild(tituloEnvasado); 

                // Crear la tabla para cada referencia
                const tableContainer = document.createElement('div');
                tableContainer.className = 'table-responsive';
                const table = document.createElement('table');
                table.className = 'table table-bordered table-striped';
                table.style.width = '100%';
                table.style.borderCollapse = 'collapse';
                
                const thead = document.createElement('thead');
                const trHead = document.createElement('tr');
                const thReferencia = document.createElement('th');
                //thReferencia.textContent = 'Referencia';
                //trHead.appendChild(thReferencia);
                table.appendChild(thead);
                thead.appendChild(trHead);

                const tbody = document.createElement('tbody');
                table.appendChild(tbody);
                tableContainer.appendChild(table);
                contenedorTablas.appendChild(tableContainer); 

                // Obtener las taras de esta referencia
                const taras = groupedData[referencia];

                // Contador de columnas
                let row;
                taras.forEach((tara, index) => {
                
                    if (index % 10 === 0) {
                        row = document.createElement('tr');
                        tbody.appendChild(row);
                    }

                    // Crear la celda de tara
                    const td = document.createElement('td');
                    td.style.padding = '8px 12px';
                    td.style.backgroundColor = '#ffffff';
                    td.style.verticalAlign = 'middle';
                    td.textContent = tara;
                    row.appendChild(td);
                });

                // Si alguna fila tiene menos de 10 celdas, se agregarán celdas vacías
                const totalRows = Math.ceil(taras.length / 10);
                const lastRow = tbody.querySelector('tr:last-child');
                const numCells = lastRow ? lastRow.cells.length : 0;
                for (let i = numCells; i < 10; i++) {
                    const tdEmpty = document.createElement('td');
                    tdEmpty.style.padding = '8px 12px';
                    tdEmpty.style.backgroundColor = '#ffffff';
                    tdEmpty.style.verticalAlign = 'middle';
                    lastRow.appendChild(tdEmpty);
                }
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
