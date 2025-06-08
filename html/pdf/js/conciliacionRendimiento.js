async function cargarConciliacionRendi() {
    console.log('Cargando datos de Conciliación de Rendimiento');

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

    const apiUrl = `http://10.1.200.30:1901/conciliacion_rendimiento`;  
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
        console.log('Datos procesados de la respuesta:', data); // Ver qué datos estamos recibiendo

        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            //alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        if (data.success) {
            const result = data.data;
            console.log('Datos de resultado:', result); // Ver el resultado de la consulta SQL

            if (result && result.length > 0) {
                const resultado = result[0].resultado;  // Esto toma el resultado de la consulta SQL
                console.log('resultado conciliacion jesus', resultado);

                // Verificamos si se obtiene correctamente el valor
                if (document.getElementById('conciliacionRendimiento60')) {
                    // Asignamos el resultado al campo con id "conciliacionRendimiento60"
                    document.getElementById('conciliacionRendimiento60').value = resultado.toFixed(2); // Formateamos a dos decimales
                    console.log(`Conciliación de rendimiento: ${resultado.toFixed(2)}`);
                } else {
                    console.error('No se encontró el input con el id "conciliacionRendimiento60"');
                }
            } else {
                console.error('No se encontraron datos para el batch especificado.');
                alert('No se encontraron datos para este batch de conciliación de rendimiento.');
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


async function cargarConciliacionRendiAcond() {
    console.log('Cargando datos de Conciliación de Rendimiento Acond');

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

    const apiUrl = `http://10.1.200.30:1901/conciliacion_rendimiento_acond`;  
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
        console.log('Datos procesados de la respuesta:', data); // Ver qué datos estamos recibiendo

        if (typeof data === 'string') {
            console.log('Contenido HTML recibido:', data);
            alert('Hubo un error en la respuesta del servidor.');
            return;
        }

        if (data.success) {
            const result = data.data;
            console.log('Datos de resultado:', result); 

            if (result && result.length > 0) {
                const divisionAcondi = result[0].division_acondi;  
                console.log('Resultado de division_acondi:', divisionAcondi);

                // Verificamos si se obtiene correctamente el valor
                const inputField = document.getElementById('conciliacionRendimiento3');
                if (inputField) {
                    // Asignamos el resultado de division_acondi al campo con id "conciliacionRendimiento3"
                    inputField.value = divisionAcondi.toFixed(2); // Formateamos a dos decimales
                    console.log(`Conciliación de rendimiento acond: ${divisionAcondi.toFixed(2)}`);
                } else {
                    console.error('No se encontró el input con el id "conciliacionRendimiento3"');
                }
            } else {
                console.error('No se encontraron datos para el batch especificado.');
                alert('No se encontraron datos para este batch de conciliación de rendimiento.');
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




window.onload = async function() {
    await cargarConciliacionRendi();
    await cargarConciliacionRendiAcond();
};
