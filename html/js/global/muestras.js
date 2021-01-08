/* Cargar el numero de muestras de acuerdo con las unidades a producir*/

function calcularMuestras(j, unidades) {

    if (unidades <= 2000) {
        $(`#muestras${j}`).val(20);
    } else if (unidades >= 2001 && unidades < 4001) {
        $(`#muestras${j}`).val(40);
    } else {
        $(`#muestras${j}`).val(60);
    }
}


/* Cargar el numero de muestras */

function muestrasEnvase() {

    let muestras = $(`#muestras${id_multi}`).val();
    let recoveredData = localStorage.getItem(presentacion + ref_multi + modulo)
    let j = 1;

    /* Elimina los campos para muestras */
    for (let i = 1; i <= 60; i++) {
        $(`#txtMuestra${i}`).remove();
    }

    /* Crea los campos para muestras para la referencia */
    for (let j = 1; j <= muestras; j++) {
        $(".txtMuestras").append(`<input type='number' min='1' class='form-control' id='txtMuestra${j}' placeholder='${j}' style='text-align:center; color:#67757c;'>`);// placeholder='${i}' style="border:0; border-bottom:1px solid #67757c"
    }

    if (recoveredData !== null) {
        let data = JSON.parse(recoveredData)
        for (let i = 0; i <= data.length; i++) {
            $(`#txtMuestra${j}`).val(data[i]);
            j++;
        }
    } else {
        $.ajax({
            type: "POST",
            url: '../../html/php/muestras.php',
            data: { operacion: 2, idBatch, modulo, ref_multi },

            success: function (response) {
                if (response == 3)
                    return false;

                let promedio = 0;
                let info = JSON.parse(response)
                j = 1;

                for (let i = 0; i < info.data.length; i++) {
                    $(`#txtMuestra${j}`).val(info.data[i].muestra);
                    promedio = promedio + info.data[i].muestra
                    j++;
                }
                promedio = promedio / $(`#muestras${id_multi}`).val();
                $(`#promedio${id_multi}`).val(promedio);

            }
        });
    }
}

function guardarMuestras() {

    let cantidad_muestras = $(`#muestras${id_multi}`).val();
    let muestras = [];
    let recoveredData = localStorage.getItem(presentacion + ref_multi + modulo)
    let promedio = 0;

    if (recoveredData !== '') {
        localStorage.removeItem(presentacion + ref_multi + modulo);
    }

    /* cargar el array con las muestras */

    for (i = 1; i <= cantidad_muestras; i++) {
        muestra = parseInt($(`#txtMuestra${i}`).val());
        if (muestra == '' || isNaN(muestra)) {
            break;
        }
        else {
            muestras.push(muestra);
            promedio = promedio + muestra;
        }
    }

    /* almacena las muestras */

    localStorage.setItem(presentacion + ref_multi + modulo, JSON.stringify(muestras));
    i = muestras.length;
    localStorage.setItem('totalmuestras', JSON.stringify(i));

    $('#m_muestras').modal('hide');

    //calcula el promedio de las muestras almacenadas
    promedio = promedio / muestras.length
    promedio = formatoCO(promedio.toFixed(2));

    $(`#promedio${id_multi}`).val(promedio);
}