console.log('Archivo Obtener tara');

function obtenerValoresTara() {
    const referencia = document.getElementById('ref1').value;;//document.getElementById('in_referencia').value;
    console.log('referencia en taraquery.js',referencia)
    const lote = document.getElementById('in_numero_lote').value;


    console.log('Referencia:', referencia);
    console.log('Lote:', lote);

    fetch('http://10.1.200.30:5656/obtener_valores_tara', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            referencia: referencia,
            lote: lote
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response); 
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos del servidor:', data); 

        if (data.success) {
            // Asignar los valores de tara mínima y máxima a los campos correspondientes
            console.log('Min Tara:', data.minTara);
            console.log('Max Tara:', data.maxTara);
            console.log('Densidad Final:', data.densidad_final);
            
            document.getElementById('taraWeiMin').value = data.minTara + ' gr' || ''; // Valor mínimo 
            document.getElementById('taraWeiMax').value = data.maxTara + ' gr' || ''; // Valor máximo
            document.getElementById('densidadAproF').value = data.densidad_final || '';

            const minimo1 = document.getElementById('minimo1').value; 
            console.log('minimo', minimo1);
          
            const regex = /\((\d+(\.\d+)?)\s*ml\)/;
            console.log('regex', regex);
            const match = minimo1.match(regex);
            console.log('match', match);

            let valorMl = 0; 

            if (match) {
                valorMl = parseFloat(match[1]); 
                console.log('Valor extraído de ml:', valorMl);
            }

            if (data.densidad_final) {
                const PesoGramosJR = valorMl * data.densidad_final;
                console.log('Peso en gramos (PesoGramosJR):', PesoGramosJR);

                //Minimo 
                const sumaenvden = parseFloat(data.minTara);  
                const pesoGramos = parseFloat(PesoGramosJR.toFixed(2));  
                
                const resultadoSuma = sumaenvden + pesoGramos;
                document.getElementById('taramin').value = resultadoSuma.toFixed(2)  + ' gr' + ' - ' + valorMl.toFixed(1)  + ' ml';

                //maximo
                //const datomaxConv = parseFloat(data.maxTara);
                const PesoMaxJR = (PesoGramosJR * 1.01).toFixed(2);
                const PresentMaxJR = (valorMl * 1.01).toFixed(2);

                const PesomaxJrConv= parseFloat(PesoMaxJR)
                const sumaMaxPesos = PesomaxJrConv + sumaenvden;


                console.log('PesoMaxJR', PesoMaxJR);
                document.getElementById('taramax').value = sumaMaxPesos.toFixed(2) + ' gr' + ' - ' + PresentMaxJR + ' ml';

                
            }
        } else {
            console.error('Error al obtener los valores de tara:', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}

//---------------------tara 2-----------
function obtenerValoresTara2() {
    const referencia = document.getElementById('ref2').value;;//document.getElementById('in_referencia').value;
    console.log('referencia en taraquery.js',referencia)
    const lote = document.getElementById('in_numero_lote').value;


    console.log('Referencia:', referencia);
    console.log('Lote:', lote);

    fetch('http://10.1.200.30:5656/obtener_valores_tara', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            referencia: referencia,
            lote: lote
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response); 
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos del servidor:', data); 

        if (data.success) {
            // Asignar los valores de tara mínima y máxima a los campos correspondientes
            console.log('Min Tara:', data.minTara);
            console.log('Max Tara:', data.maxTara);
            console.log('Densidad Final:', data.densidad_final);
            
            document.getElementById('taraWeiMin2').value = data.minTara + ' gr' || ''; // Valor mínimo 
            document.getElementById('taraWeiMax2').value = data.maxTara + ' gr' || ''; // Valor máximo
            document.getElementById('densidadAproF2').value = data.densidad_final || '';

            const minimo1 = document.getElementById('minimo2').value; 
            console.log('minimo', minimo1);
          
            const regex = /\((\d+(\.\d+)?)\s*ml\)/;
            console.log('regex', regex);
            const match = minimo1.match(regex);
            console.log('match', match);

            let valorMl = 0; 

            if (match) {
                valorMl = parseFloat(match[1]); 
                console.log('Valor extraído de ml:', valorMl);
            }

            if (data.densidad_final) {
                const PesoGramosJR = valorMl * data.densidad_final;
                console.log('Peso en gramos (PesoGramosJR):', PesoGramosJR);

                //Minimo 
                const sumaenvden = parseFloat(data.minTara);  
                const pesoGramos = parseFloat(PesoGramosJR.toFixed(2));  
                
                const resultadoSuma = sumaenvden + pesoGramos;
                document.getElementById('taramin2').value = resultadoSuma.toFixed(2)  + ' gr' + ' - ' + valorMl.toFixed(1)  + ' ml';

                //maximo
                //const datomaxConv = parseFloat(data.maxTara);
                const PesoMaxJR = (PesoGramosJR * 1.01).toFixed(2);
                const PresentMaxJR = (valorMl * 1.01).toFixed(2);

                const PesomaxJrConv= parseFloat(PesoMaxJR)
                const sumaMaxPesos = PesomaxJrConv + sumaenvden;


                console.log('PesoMaxJR', PesoMaxJR);
                document.getElementById('taramax2').value = sumaMaxPesos.toFixed(2) + ' gr' + ' - ' + PresentMaxJR + ' ml';

                
            }
        } else {
            console.error('Error al obtener los valores de tara:', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}

//--------------------------tara 3--------
function obtenerValoresTara3() {
    const referencia = document.getElementById('ref3').value;;//document.getElementById('in_referencia').value;
    console.log('referencia en taraquery.js',referencia)
    const lote = document.getElementById('in_numero_lote').value;


    console.log('Referencia:', referencia);
    console.log('Lote:', lote);

    fetch('http://10.1.200.30:5656/obtener_valores_tara', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            referencia: referencia,
            lote: lote
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response); 
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos del servidor:', data); 

        if (data.success) {
            // Asignar los valores de tara mínima y máxima a los campos correspondientes
            console.log('Min Tara:', data.minTara);
            console.log('Max Tara:', data.maxTara);
            console.log('Densidad Final:', data.densidad_final);
            
            document.getElementById('taraWeiMin3').value = data.minTara + ' gr' || ''; // Valor mínimo 
            document.getElementById('taraWeiMax3').value = data.maxTara + ' gr' || ''; // Valor máximo
            document.getElementById('densidadAproF3').value = data.densidad_final || '';

            const minimo1 = document.getElementById('minimo3').value; 
            console.log('minimo', minimo1);
          
            const regex = /\((\d+(\.\d+)?)\s*ml\)/;
            console.log('regex', regex);
            const match = minimo1.match(regex);
            console.log('match', match);

            let valorMl = 0; 

            if (match) {
                valorMl = parseFloat(match[1]); 
                console.log('Valor extraído de ml:', valorMl);
            }

            if (data.densidad_final) {
                const PesoGramosJR = valorMl * data.densidad_final;
                console.log('Peso en gramos (PesoGramosJR):', PesoGramosJR);

                //Minimo 
                const sumaenvden = parseFloat(data.minTara);  
                const pesoGramos = parseFloat(PesoGramosJR.toFixed(2));  
                
                const resultadoSuma = sumaenvden + pesoGramos;
                document.getElementById('taramin3').value = resultadoSuma.toFixed(2)  + ' gr' + ' - ' + valorMl.toFixed(1)  + ' ml';

                //maximo
                //const datomaxConv = parseFloat(data.maxTara);
                const PesoMaxJR = (PesoGramosJR * 1.01).toFixed(2);
                const PresentMaxJR = (valorMl * 1.01).toFixed(2);

                const PesomaxJrConv= parseFloat(PesoMaxJR)
                const sumaMaxPesos = PesomaxJrConv + sumaenvden;


                console.log('PesoMaxJR', PesoMaxJR);
                document.getElementById('taramax3').value = sumaMaxPesos.toFixed(2) + ' gr' + ' - ' + PresentMaxJR + ' ml';

                
            }
        } else {
            console.error('Error al obtener los valores de tara:', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}


//----------------------tara 4------------
function obtenerValoresTara4() {
    const referencia = document.getElementById('ref4').value;;//document.getElementById('in_referencia').value;
    console.log('referencia en taraquery.js',referencia)
    const lote = document.getElementById('in_numero_lote').value;


    console.log('Referencia:', referencia);
    console.log('Lote:', lote);

    fetch('http://10.1.200.30:5656/obtener_valores_tara', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            referencia: referencia,
            lote: lote
        })
    })
    .then(response => {
        console.log('Respuesta recibida del servidor:', response); 
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos del servidor:', data); 

        if (data.success) {
            // Asignar los valores de tara mínima y máxima a los campos correspondientes
            console.log('Min Tara:', data.minTara);
            console.log('Max Tara:', data.maxTara);
            console.log('Densidad Final:', data.densidad_final);
            
            document.getElementById('taraWeiMin4').value = data.minTara + ' gr' || ''; // Valor mínimo 
            document.getElementById('taraWeiMax4').value = data.maxTara + ' gr' || ''; // Valor máximo
            document.getElementById('densidadAproF4').value = data.densidad_final || '';

            const minimo1 = document.getElementById('minimo4').value; 
            console.log('minimo', minimo1);
          
            const regex = /\((\d+(\.\d+)?)\s*ml\)/;
            console.log('regex', regex);
            const match = minimo1.match(regex);
            console.log('match', match);

            let valorMl = 0; 

            if (match) {
                valorMl = parseFloat(match[1]); 
                console.log('Valor extraído de ml:', valorMl);
            }

            if (data.densidad_final) {
                const PesoGramosJR = valorMl * data.densidad_final;
                console.log('Peso en gramos (PesoGramosJR):', PesoGramosJR);

                //Minimo 
                const sumaenvden = parseFloat(data.minTara);  
                const pesoGramos = parseFloat(PesoGramosJR.toFixed(2));  
                
                const resultadoSuma = sumaenvden + pesoGramos;
                document.getElementById('taramin4').value = resultadoSuma.toFixed(2)  + ' gr' + ' - ' + valorMl.toFixed(1)  + ' ml';

                //maximo
                //const datomaxConv = parseFloat(data.maxTara);
                const PesoMaxJR = (PesoGramosJR * 1.01).toFixed(2);
                const PresentMaxJR = (valorMl * 1.01).toFixed(2);

                const PesomaxJrConv= parseFloat(PesoMaxJR)
                const sumaMaxPesos = PesomaxJrConv + sumaenvden;


                console.log('PesoMaxJR', PesoMaxJR);
                document.getElementById('taramax4').value = sumaMaxPesos.toFixed(2) + ' gr' + ' - ' + PresentMaxJR + ' ml';

                
            }
        } else {
            console.error('Error al obtener los valores de tara:', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}
