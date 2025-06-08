function cargarTara() {
    console.log('archivo tara cargado');
    let referenciasGuardadas = JSON.parse(localStorage.getItem('referenciasGuardadas'));

    // Verificamos si existen datos almacenados
    if (referenciasGuardadas) {
        console.log('Datos recuperados desde localStorage:', referenciasGuardadas);
    } else {
        console.log('No se encontraron datos en localStorage.');
    }
    //console.log('Accediendo a referenciasGuardadas desde otro archivo:', referenciasGuardadas);


    // Obtener los parámetros de la URL
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
            //alert('Hubo un error en la respuesta del servidor.');
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

            // Recorremos las referencias y colocamos los valores dentro de cada tabla
            for (const referencia in groupedData) {
                const taras = groupedData[referencia];
                const referenceIndex = parseInt(referencia.split('-')[1]); 

                // Buscar el div correspondiente usando el índice de la referencia
                const divId = `titulo_envasado${referenceIndex}`;
                const divElement = document.getElementById(divId);

                // Imprimir comparación de referencia y ID
                console.log(`Referencia encontrada: ${referencia}`);
                console.log(`Comparando con el ID: ${divId}`);

                // Si encontramos el div correspondiente
                if (divElement) {
                    console.log(`Referencia encontrada: ${referencia}`);
                    console.log(`Insertando datos en el div: ${divId}`);

                    // Crear la tabla para la referencia
                    const table = document.createElement('table');
                    table.classList.add('table', 'table-bordered', 'table-striped');
                    const thead = document.createElement('thead');
                    const tbody = document.createElement('tbody');
                    thead.innerHTML = `
                        <tr>
                            <th>Referencia</th>
                            <th>Tara</th>
                        </tr>
                    `;
                    table.appendChild(thead);
                    table.appendChild(tbody);
                    divElement.appendChild(table);

                    // Crear las filas de la tabla
                    taras.forEach(tara => {
                        const tr = document.createElement('tr');
                        const tdReferencia = document.createElement('td');
                        tdReferencia.textContent = referencia;
                        tr.appendChild(tdReferencia);
                        
                        const tdTara = document.createElement('td');
                        tdTara.textContent = tara;
                        tr.appendChild(tdTara);
                        
                        tbody.appendChild(tr);
                    });
                } else {
                    console.warn(`No se encontró el div con ID: ${divId}`);
                }
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
