console.log('ingresnado a tara')
function TestJesus(){
    referenciaM = document.getElementById('ref1').value;
    console.log('funciona el boton', referencia);

}
function abrirModal() {
    console.log('Ingresando a modal de tara');
    
    // Obtener los valores de los campos
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    TestJesus();
    console.log('Variable referenciaM anets de guardar', referenciaM);
    const referenciaElement = referenciaM; //document.getElementById('in_referencia');
    console.log('Referencia luego de asignacion',referenciaElement);
    const loteElement = document.getElementById('in_numero_lote');
    const muestras1Element = document.getElementById('muestras1');
    //console.log("Valor compartido desde obtenerValoresTara():", sharedInputValue);
    // Recuperar el valor del atributo data-shared-value
    const modalButton = document.getElementById('btnAbrirModal');
    const sharedValue = modalButton.getAttribute('data-shared-value');
    
    console.log("Valor compartido recibido del botón:", sharedValue)
    
    
    if (!referenciaElement || !loteElement || !muestras1Element) {
        console.error("Faltan elementos esenciales para abrir el modal.");
        return;
    }

    const referencia = referenciaElement;
    console.log('const referencia = referenciaElement.value;' , referencia);
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


//-----------------------------Tara 2-------------
function TestJesus2(){
    referenciaM2 = document.getElementById('ref2').value;

}

function abrirModal2() {
    console.log('Ingresando a modal de tara2');
    
    // Obtener los valores de los campos
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    TestJesus2();
    console.log('Variable referenciaM anets de guardar', referenciaM2);
    const referenciaElement = referenciaM2; //document.getElementById('in_referencia');
    console.log('Referencia luego de asignacion referenciaM2',referenciaElement);
    const loteElement = document.getElementById('in_numero_lote');
    const muestras1Element = document.getElementById('muestras1');
    //console.log("Valor compartido desde obtenerValoresTara():", sharedInputValue);
    // Recuperar el valor del atributo data-shared-value
    
    
    
    if (!referenciaElement || !loteElement || !muestras1Element) {
        console.error("Faltan elementos esenciales para abrir el modal.");
        return;
    }

    const referencia = referenciaElement;
    console.log('const referencia = referenciaElement.value;' , referencia);
    const lote = loteElement.value;
    const muestras1 = parseInt(muestras1Element.value);

    if (isNaN(muestras1)) {
        console.error("El valor de 'muestras1' no es un número válido.");
        return;
    }

    const cantidadCampos = Math.floor(muestras1 / 2); // Calcular cantidad de campos

    // Limpiar las filas anteriores de la tabla de pesos
    document.querySelector('#pesosTable2 tbody').innerHTML = '';

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
        document.querySelector('#pesosTable2 tbody').appendChild(row);
    }

    // Agregar un event listener para el campo de Densidad Final global
    const densidadFinalInput = document.getElementById('densidadFinalInput2');
    densidadFinalInput.addEventListener('input', function() {
        const densidadFinalValue = densidadFinalInput.value;
        const densidadFinalFields = document.querySelectorAll('.densidad_final');
        
        // Actualizar todos los campos de densidad_final con el valor ingresado
        densidadFinalFields.forEach(function(field) {
            field.value = densidadFinalValue;
        });
    });

    // Abrir el modal
    const modalElement = $('#m_muestrasTara2');
    if (modalElement && !modalElement.hasClass('show')) {
        modalElement.modal('show');
    } else {
        console.error("El modal 'm_muestrasTara2' no existe o ya está visible.");
    }
}
function guardarMuestrasTara2() {
    console.log("Iniciando la función 'guardarMuestrasTara2'");

    if (!validarCamposTara2()) {
        console.log("Validación de campos Tara fallida.");
        return; 
    }

    const rows = document.querySelectorAll('#pesosTable2 tbody tr');
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

function validarCamposTara2() {
    console.log("Iniciando validación de campos Tara...");
    const rows = document.querySelectorAll('#pesosTable2 tbody tr');
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

//----------------tara 3--------------
function TestJesus3(){
    referenciaM3 = document.getElementById('ref3').value;

}

function abrirModal3() {
    console.log('Ingresando a modal de tara3');
    
    // Obtener los valores de los campos
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    TestJesus3();
    console.log('Variable referenciaM anets de guardar', referenciaM3);
    const referenciaElement = referenciaM3; //document.getElementById('in_referencia');
    console.log('Referencia luego de asignacion referenciaM3',referenciaElement);
    const loteElement = document.getElementById('in_numero_lote');
    const muestras1Element = document.getElementById('muestras1');
    //console.log("Valor compartido desde obtenerValoresTara():", sharedInputValue);
    // Recuperar el valor del atributo data-shared-value
    
    
    
    if (!referenciaElement || !loteElement || !muestras1Element) {
        console.error("Faltan elementos esenciales para abrir el modal.");
        return;
    }

    const referencia = referenciaElement;
    console.log('const referencia = referenciaElement.value;' , referencia);
    const lote = loteElement.value;
    const muestras1 = parseInt(muestras1Element.value);

    if (isNaN(muestras1)) {
        console.error("El valor de 'muestras1' no es un número válido.");
        return;
    }

    const cantidadCampos = Math.floor(muestras1 / 2); // Calcular cantidad de campos

    // Limpiar las filas anteriores de la tabla de pesos
    document.querySelector('#pesosTable3 tbody').innerHTML = '';

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
        document.querySelector('#pesosTable3 tbody').appendChild(row);
    }

    // Agregar un event listener para el campo de Densidad Final global
    const densidadFinalInput = document.getElementById('densidadFinalInput3');
    densidadFinalInput.addEventListener('input', function() {
        const densidadFinalValue = densidadFinalInput.value;
        const densidadFinalFields = document.querySelectorAll('.densidad_final');
        
        // Actualizar todos los campos de densidad_final con el valor ingresado
        densidadFinalFields.forEach(function(field) {
            field.value = densidadFinalValue;
        });
    });

    // Abrir el modal
    const modalElement = $('#m_muestrasTara3');
    if (modalElement && !modalElement.hasClass('show')) {
        modalElement.modal('show');
    } else {
        console.error("El modal 'm_muestrasTara3' no existe o ya está visible.");
    }
}
function guardarMuestrasTara3() {
    console.log("Iniciando la función 'guardarMuestrasTara3'");

    if (!validarCamposTara3()) {
        console.log("Validación de campos Tara fallida.");
        return; 
    }

    const rows = document.querySelectorAll('#pesosTable3 tbody tr');
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

function validarCamposTara3() {
    console.log("Iniciando validación de campos Tara...");
    const rows = document.querySelectorAll('#pesosTable3 tbody tr');
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

//------------------------------Tara 4---------------
function TestJesus4(){
    referenciaM4 = document.getElementById('ref4').value;

}

function abrirModal4() {
    console.log('Ingresando a modal de tara4');
    
    // Obtener los valores de los campos
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    TestJesus4();
    console.log('Variable referenciaM anets de guardar', referenciaM4);
    const referenciaElement = referenciaM4; //document.getElementById('in_referencia');
    console.log('Referencia luego de asignacion referenciaM3',referenciaElement);
    const loteElement = document.getElementById('in_numero_lote');
    const muestras1Element = document.getElementById('muestras1');
    //console.log("Valor compartido desde obtenerValoresTara():", sharedInputValue);
    // Recuperar el valor del atributo data-shared-value
    
    
    
    if (!referenciaElement || !loteElement || !muestras1Element) {
        console.error("Faltan elementos esenciales para abrir el modal.");
        return;
    }

    const referencia = referenciaElement;
    console.log('const referencia = referenciaElement.value;' , referencia);
    const lote = loteElement.value;
    const muestras1 = parseInt(muestras1Element.value);

    if (isNaN(muestras1)) {
        console.error("El valor de 'muestras1' no es un número válido.");
        return;
    }

    const cantidadCampos = Math.floor(muestras1 / 2); // Calcular cantidad de campos

    // Limpiar las filas anteriores de la tabla de pesos
    document.querySelector('#pesosTable4 tbody').innerHTML = '';

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
        document.querySelector('#pesosTable4 tbody').appendChild(row);
    }

    // Agregar un event listener para el campo de Densidad Final global
    const densidadFinalInput = document.getElementById('densidadFinalInput4');
    densidadFinalInput.addEventListener('input', function() {
        const densidadFinalValue = densidadFinalInput.value;
        const densidadFinalFields = document.querySelectorAll('.densidad_final');
        
        // Actualizar todos los campos de densidad_final con el valor ingresado
        densidadFinalFields.forEach(function(field) {
            field.value = densidadFinalValue;
        });
    });

    // Abrir el modal
    const modalElement = $('#m_muestrasTara4');
    if (modalElement && !modalElement.hasClass('show')) {
        modalElement.modal('show');
    } else {
        console.error("El modal 'm_muestrasTara4' no existe o ya está visible.");
    }
}
function guardarMuestrasTara4() {
    console.log("Iniciando la función 'guardarMuestrasTara4'");

    if (!validarCamposTara4()) {
        console.log("Validación de campos Tara fallida.");
        return; 
    }

    const rows = document.querySelectorAll('#pesosTable4 tbody tr');
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

function validarCamposTara4() {
    console.log("Iniciando validación de campos Tara...");
    const rows = document.querySelectorAll('#pesosTable4 tbody tr');
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