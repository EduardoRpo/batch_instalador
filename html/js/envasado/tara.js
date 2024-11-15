function abrirModal() {
    console.log('Ingresando a modal de tara');
    
    // Obtener los valores de los campos
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    
    const referenciaElement = document.getElementById('in_referencia');
    const loteElement = document.getElementById('in_numero_lote');
    const muestras1Element = document.getElementById('muestras1');
    
    if (!referenciaElement || !loteElement || !muestras1Element) {
        console.error("Faltan elementos esenciales para abrir el modal.");
        return;
    }

    const referencia = referenciaElement.value;
    const lote = loteElement.value;
    const muestras1 = parseInt(muestras1Element.value);

    if (isNaN(muestras1)) {
        console.error("El valor de 'muestras1' no es un número válido.");
        return;
    }

    const cantidadCampos = Math.floor(muestras1 / 2); // Calcular cantidad de campos

    // Limpiar las filas anteriores de la tabla de pesos
    document.querySelector('#pesosTable tbody').innerHTML = '';

    // Crear las filas de la tabla de pesos según la cantidad de campos
    for (let i = 0; i < cantidadCampos; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="number" class="form-control tara" placeholder="Tara ${i + 1}" required></td>
            <td><input type="number" class="form-control densidad_final" placeholder="Densidad Final ${i + 1}" readonly></td> <!-- Solo lectura -->
            <td style="display:none;"><input type="text" class="form-control lote" value="${lote}" readonly required></td>
            <td style="display:none;"><input type="text" class="form-control referencia" value="${referencia}" readonly required></td>
            <td style="display:none;"><input type="text" class="form-control batch" value="${batch}" readonly required></td>
        `;
        document.querySelector('#pesosTable tbody').appendChild(row);
    }

    // Agregar un event listener para el campo de Densidad Final global
    const densidadFinalInput = document.getElementById('densidadFinalInput');
    densidadFinalInput.addEventListener('input', function() {
        const densidadFinalValue = densidadFinalInput.value;
        const densidadFinalFields = document.querySelectorAll('.densidad_final');
        
        // Actualizar todos los campos de densidad_final con el valor ingresado
        densidadFinalFields.forEach(function(field) {
            field.value = densidadFinalValue;
        });
    });

    // Abrir el modal
    const modalElement = $('#m_muestrasTara');
    if (modalElement && !modalElement.hasClass('show')) {
        modalElement.modal('show');
    } else {
        console.error("El modal 'm_muestrasTara' no existe o ya está visible.");
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const addFilaButton = document.getElementById('idAddFilaTara');
    if (addFilaButton) {
        addFilaButton.addEventListener('click', function() {
            console.log('Función agregarFila ejecutada');
            agregarFila();
        });
    } else {
        console.error("El botón 'idAddFilaTara' no existe.");
    }

    const saveTaraButton = document.getElementById('idSaveTara');
    if (saveTaraButton) {
        saveTaraButton.addEventListener('click', function() {
            console.log('Función guardarMuestrasTara ejecutada');
            guardarMuestrasTara();
        });
    } else {
        console.error("El botón 'idSaveTara' no existe.");
    }
});


function agregarFila() {
    console.log('Función agregarFila ejecutada');

    const url = window.location.href;
    const batch = url.split('/')[4]; 
    
    // Validar que los elementos necesarios existan
    const referenciaElement = document.getElementById('in_referencia');
    const loteElement = document.getElementById('in_numero_lote');

    if (!referenciaElement || !loteElement) {
        console.error("Faltan los elementos 'in_referencia' o 'in_numero_lote'. No se puede agregar fila.");
        return;
    }

    const referencia = referenciaElement.value;
    const lote = loteElement.value;

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="number" class="form-control tara" placeholder="Nueva Tara" required></td>
        <td style="display:none;"><input type="text" class="form-control lote" value="${lote}" readonly required></td>
        <td style="display:none;"><input type="text" class="form-control referencia" value="${referencia}" readonly required></td>
        <td style="display:none;"><input type="text" class="form-control batch" value="${batch}" readonly required></td>
    `;
    document.querySelector('#pesosTable tbody').appendChild(newRow);
}

function validarCamposTara() {
    console.log("Iniciando validación de campos Tara...");
    const rows = document.querySelectorAll('#pesosTable tbody tr');
    for (let row of rows) {
        const taraValue = row.querySelector('.tara').value;
        if (!taraValue) {
            console.warn('Campo Tara vacío. Se requiere que todos los campos sean completados.');
            alert('Todos los campos de Tara son obligatorios. Por favor, complete cada uno.');
            return false;
        }
    }
    console.log("Todos los campos Tara están completos.");
    return true; 
}

function guardarMuestrasTara() {
    console.log("Iniciando la función 'guardarMuestrasTara'");

    if (!validarCamposTara()) {
        console.log("Validación de campos Tara fallida.");
        return; 
    }

    const rows = document.querySelectorAll('#pesosTable tbody tr');
    const data = [];
    let maxTara = Number.NEGATIVE_INFINITY;

    rows.forEach(row => {
        const tara = parseFloat(row.querySelector('.tara').value);
        const lote = row.querySelector('.lote').value;
        const referencia = row.querySelector('.referencia').value;
        const batch = row.querySelector('.batch').value;
        const densidadFinal = parseFloat(row.querySelector('.densidad_final').value); // Obtener el valor de Densidad Final

        if (!isNaN(tara) && !isNaN(densidadFinal)) { // Validar que tanto Tara como Densidad Final sean números válidos
            maxTara = Math.max(maxTara, tara);

            const horaInicio = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const horaFinal = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            const rowData = {
                tara: tara,
                lote: lote,
                referencia: referencia,
                batch: batch,
                densidadFinal: densidadFinal, // Incluir Densidad Final en los datos
                horaInicio: horaInicio, 
                horaFinal: horaFinal     
            };

            console.log('Datos de la fila:', rowData);
            data.push(rowData);
        } else {
            console.warn(`Tara o Densidad Final no válida en la fila.`);
        }
    });

    console.log('Datos a enviar al servidor:', data);

    if (maxTara !== Number.NEGATIVE_INFINITY) { 
        document.getElementById('taraWeiMax').value = maxTara; 
    } else {
        document.getElementById('taraWeiMax').value = ''; 
    }

    // Enviar los datos al servidor
    console.log('Iniciando solicitud fetch a guardar_muestras_tara.php');
    fetch('http://10.1.200.30:4433/html/guardar_muestras_tara.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log('Respuesta del servidor:', result); 
        if (result.success) {
            alert('Datos guardados correctamente');
        } else {
            alert('Error al guardar los datos: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al enviar los datos al servidor.');
    });
}
