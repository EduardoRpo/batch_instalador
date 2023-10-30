$(document).ready(function () {
  /* Cargar el numero de muestras de acuerdo con las unidades a producir*/

  /* calcularMuestras = (j, unidades) => {
        if (unidades <= 2000) $(`#muestras${j}`).val(20);
        else if (unidades >= 2001 && unidades < 4001) $(`#muestras${j}`).val(40);
        else $(`#muestras${j}`).val(60);
    } */

  /* Cargar el numero de muestras */

  muestrasEnvase = async () => {
    //$("#m_muestras").modal("show");
    let muestras = $(`#muestras${id_multi}`).val();
    let recoveredData = sessionStorage.getItem(
      presentacion + ref_multi + modulo
    );
    let j = 1;

    /* Elimina los campos para muestras */
    for (let i = 1; i <= 60; i++) $(`#txtMuestra${i}`).remove();

    /* Crea los campos para muestras para la referencia */
    for (let j = 1; j <= muestras; j++)
      $('.txtMuestras').append(
        `<input type='number' min='1' class='form-control' id='txtMuestra${j}' placeholder='${j}' style='text-align:center; color:#67757c;'>`
      );

    if (recoveredData !== null) {
      let data = JSON.parse(recoveredData);
      for (let i = 0; i <= data.length; i++) {
        $(`#txtMuestra${j}`).val(data[i]);
        j++;
      }
    } else {
      // result = await consultarMuestras();
      let data = new FormData();
      data.append('idBatch', idBatch);
      data.append('modulo', modulo);
      data.append('ref_multi', ref_multi);

      let result = await sendDataPOST('/api/muestras', data, 2);
      if (result != false) await cargarMuestras(result);
    }
  };

  // consultarMuestras = async () => {
  //   data = { operacion: 2, idBatch, modulo, ref_multi };
  //   return (result = await sendDataPOST(
  //     '../../html/php/muestras.php',
  //     data,
  //     1
  //   ));
  // };

  cargarMuestras = () => {
    if (response == 3) return false;

    let promedio = 0;
    let info = JSON.parse(response);
    j = 1;

    for (let i = 0; i < info.length; i++) {
      $(`#txtMuestra${j}`).val(info[i].muestra);
      promedio = promedio + info[i].muestra;
      j++;
    }
    promedio = promedio / $(`#muestras${id_multi}`).val();
    $(`#promedio${id_multi}`).val(`${promedio}`);
  };

  /* Cargar promedio muestras */

  promedio = async () => {
    let data = new FormData();
    data.append('idBatch', idBatch);
    data.append('modulo', modulo);
    data.append('ref_multi', ref_multi);

    let resp = await sendDataPOST('/api/promedio-muestras', data, 2);

    if (resp != false) { 
      $(`#promedio${id_multi}`).val(`${resp.promedio}`);
    } 
  }

  guardarMuestras = () => {
    let cantidad_muestras = $(`#muestras${id_multi}`).val();
    let muestras = [];
    let recoveredData = sessionStorage.getItem(
      presentacion + ref_multi + modulo
    );
    let promedio = 0;

    if (recoveredData !== '')
      sessionStorage.removeItem(presentacion + ref_multi + modulo);

    /* cargar el array con las muestras */

    for (i = 1; i <= cantidad_muestras; i++) {
      let muestra = parseInt($(`#txtMuestra${i}`).val());
      if (muestra == '' || isNaN(muestra)) break;
      else {
        muestras.push(muestra);
        promedio = promedio + muestra;
      }
    }

    /* almacena las muestras */

    sessionStorage.setItem(
      presentacion + ref_multi + modulo,
      JSON.stringify(muestras)
    );
    i = muestras.length;
    sessionStorage.setItem(`totalmuestras${id_multi}`, JSON.stringify(i));

    $('#m_muestras').modal('hide');

    //calcula el promedio de las muestras almacenadas
    promedio = promedio / muestras.length;
    promedio = formatoCO(promedio.toFixed(2));

    $(`#promedio${id_multi}`).val(promedio);
    validar_condicionesMedio();
  };
});
