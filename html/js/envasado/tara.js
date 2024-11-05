function abrirModal() {
    console.log('Ingresando a modal de tara');
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    const referencia = document.getElementById('in_referencia').value;
    const lote = document.getElementById('in_numero_lote').value; 
    const muestras1 = parseInt(document.getElementById('muestras1').value); 
    const cantidadCampos = Math.floor(muestras1 / 2);

    console.log(`Valor de muestras1: ${muestras1}`);
    console.log(`Cantidad de campos (muestras1 / 2): ${cantidadCampos}`);

    const horaInicio = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    document.querySelector('#pesosTable tbody').innerHTML = '';

    document.getElementById('horaInicio').textContent = `Hora de inicio: ${horaInicio}`;

    for (let i = 0; i < cantidadCampos; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="number" class="form-control tara" placeholder="Tara ${i + 1}" required></td>
            <td style="display:none;"><input type="text" class="form-control lote" value="${lote}" readonly required></td>
            <td style="display:none;"><input type="text" class="form-control referencia" value="${referencia}" readonly required></td>
            <td style="display:none;"><input type="text" class="form-control batch" value="${batch}" readonly required></td>
        `;
        document.querySelector('#pesosTable tbody').appendChild(row);
    }

    console.log(`Total de campos creados en el modal: ${cantidadCampos}`); 

   
    if (!$('#m_muestrasTara').hasClass('show')) {
        $('#m_muestrasTara').modal('show');
    }
}

document.addEventListener('DOMContentLoaded', function() {
   
    document.getElementById('idAddFilaTara').addEventListener('click', function() {
        console.log('Función agregarFila ejecutada');
        agregarFila();
    });

    document.getElementById('idSaveTara').addEventListener('click', function() {
        console.log('Función guardarMuestrasTara ejecutada');
        guardarMuestrasTara();
    });
});


function agregarFila() {
    console.log('Función agregarFila ejecutada');
    const url = window.location.href;
    const batch = url.split('/')[4]; 
    const referencia = document.getElementById('in_referencia').value;
    const lote = document.getElementById('in_numero_lote').value;

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
    const rows = document.querySelectorAll('#pesosTable tbody tr');
    for (let row of rows) {
        const taraValue = row.querySelector('.tara').value;
        if (!taraValue) {
            alert('Todos los campos de Tara son obligatorios. Por favor, complete cada uno.');
            return false; 
        }
    }
    return true; 
}


function guardarMuestrasTara() {
    
    if (!validarCamposTara()) {
        return; 
    }

    console.log('Función guardarMuestrasTara ejecutada');
    const rows = document.querySelectorAll('#pesosTable tbody tr');
    const data = [];
    let maxTara = Number.NEGATIVE_INFINITY; 

    rows.forEach(row => {
        const tara = parseFloat(row.querySelector('.tara').value); 
        const lote = row.querySelector('.lote').value;
        const referencia = row.querySelector('.referencia').value;
        const batch = row.querySelector('.batch').value;

        if (!isNaN(tara)) { 
            
            maxTara = Math.max(maxTara, tara);

            const horaInicio = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const horaFinal = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            const rowData = {
                tara: tara,
                lote: lote,
                referencia: referencia,
                batch: batch,
                horaInicio: horaInicio, 
                horaFinal: horaFinal     
            };
            
            console.log('Datos de la fila:', rowData); 
            data.push(rowData);
        }
    });

    console.log('Datos a enviar al servidor:', data); 

    if (maxTara !== Number.NEGATIVE_INFINITY) { 
        document.getElementById('taraWeiMax').value = maxTara; 
    } else {
        document.getElementById('taraWeiMax').value = ''; 
    }

    const minimo1Text = document.getElementById('minimo1').value;
    const regexMinimo1 = /^([\d.]+)\s*(.*\s*-\s*\(.*\))$/; 
    const matchMinimo1 = minimo1Text.match(regexMinimo1); 

    let nuevoMinimo = '';
    if (matchMinimo1) {
        const valorMinimo = parseFloat(matchMinimo1[1]); 
        const restoMinimo = matchMinimo1[2]; 

        const sumaTaras = maxTara + valorMinimo;

        nuevoMinimo = `${sumaTaras.toFixed(2)} ${restoMinimo}`;
    }

    document.getElementById('taramin').value = nuevoMinimo;

    const maximo1Text = document.getElementById('maximo1').value; 
    const regexMaximo1 = /^([\d.]+)\s*(.*\s*-\s*\(.*\))$/; 
    const matchMaximo1 = maximo1Text.match(regexMaximo1);

    let nuevoMaximo = '';
    if (matchMaximo1) {
        const valorMaximo = parseFloat(matchMaximo1[1]); 
        const restoMaximo = matchMaximo1[2]; 

        const sumaMaxTaras = maxTara + valorMaximo;

        nuevoMaximo = `${sumaMaxTaras.toFixed(2)} ${restoMaximo}`;
    }

    
    document.getElementById('taramax').value = nuevoMaximo;

    
    console.log('Iniciando solicitud fetch a guardar_muestras_tara.php');
    fetch('http://10.1.200.30:4433/html/guardar_muestras_tara.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Estado de la respuesta:', response.status); 
        return response.json();
    })
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
