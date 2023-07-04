$(document).ready(function () {
  // Cargar el numero de muestras de acuerdo con las unidades a producir

  calcularMuestras = (j, unidades) => {
    if (unidades <= 2000) $(`#muestras${j}`).val(20);
    else if (unidades >= 2001 && unidades < 4001) $(`#muestras${j}`).val(40);
    else $(`#muestras${j}`).val(60);
  };

  ajaxMuestrasRecolectadas = async (muestras) => {
    data = { operacion, idBatch, muestras, modulo, ref_multi };
    return (result = await sendDataPOST(
      '../../html/php/muestras.php',
      data,
      1
    ));
  };

  muestrasRecolectadas = async (muestras) => {
    response = await ajaxMuestrasRecolectadas(muestras);
    if (!response) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Error al almacenar las muestras, valide nuevamente');
      return false;
    } else return true;
  };

  /*
    //Cargar el numero de muestras

    muestrasEnvase = () => {
        //$("#m_muestras").modal("show");
        let muestras = $(`#muestras${id_multi}`).val();
        let recoveredData = sessionStorage.getItem(presentacion + ref_multi + modulo);
        let j = 1;

        //Elimina los campos para muestras
        for (let i = 1; i <= 60; i++) {
            $(`#txtMuestra${i}`).remove();
        }

        //Crea los campos para muestras para la referencia
        for (let j = 1; j <= muestras; j++) {
            $(".txtMuestras").append(
                `<input type='number' min='1' class='form-control' id='txtMuestra${j}' placeholder='${j}' style='text-align:center; color:#67757c;'>`
            );
        }

        if (recoveredData !== null) {
            let data = JSON.parse(recoveredData);
            for (let i = 0; i <= data.length; i++) {
                $(`#txtMuestra${j}`).val(data[i]);
                j++;
            }
        } else {
            $.ajax({
                type: "POST",
                url: "../../html/php/muestras.php",
                data: { operacion: 2, idBatch, modulo, ref_multi },

                success: function(response) {
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
                    $(`#promedio${id_multi}`).val(promedio);
                },
            });
            validar_condicionesMedio();
        }
    }

    // Cargar promedio muestras 

    promedio = () => {
        $.ajax({
            type: "POST",
            url: "../../html/php/muestras.php",
            data: { operacion: 5, idBatch, modulo, ref_multi },

            success: function(response) {
                if (!response) return false;
                data = JSON.parse(response);
                $(`#promedio${id_multi}`).val(data[0].promedio);
            },
        });
    };

    guardarMuestras = () => {
        let cantidad_muestras = $(`#muestras${id_multi}`).val();
        let muestras = [];
        let recoveredData = sessionStorage.getItem(presentacion + ref_multi + modulo);
        let promedio = 0;

        if (recoveredData !== "")
            sessionStorage.removeItem(presentacion + ref_multi + modulo);

        // cargar el array con las muestras 

        for (i = 1; i <= cantidad_muestras; i++) {
            muestra = parseInt($(`#txtMuestra${i}`).val());
            if (muestra == "" || isNaN(muestra)) break;
            else {
                muestras.push(muestra);
                promedio = promedio + muestra;
            }
        }

        // almacena las muestras

        sessionStorage.setItem(
            presentacion + ref_multi + modulo,
            JSON.stringify(muestras)
        );
        i = muestras.length;
        sessionStorage.setItem("totalmuestras", JSON.stringify(i));

        $("#m_muestras").modal("hide");

        //calcula el promedio de las muestras almacenadas
        promedio = promedio / muestras.length;
        promedio = formatoCO(promedio.toFixed(2));

        $(`#promedio${id_multi}`).val(promedio);
    } */

  /* Crear selects de muestras en la ventana de muestras acondicionamiento */

  muestras_acondicionamiento = () => {
    muestras = $(`#muestras${id_multi}`).val();
    let recoveredData = sessionStorage.getItem(
      presentacion + ref_multi + modulo
    );
    j = 1;

    /* Elimina los campos para muestras */
    for (let i = 1; i <= 60; i++) $(`#fila${i}`).closest('tr').remove();

    /* crea tabla para registrar muestras */
    for (let j = 1; j <= muestras; j++) {
      $('#table_muestras_acondicionamiento').append(`
      <tbody>    
      <tr id="fila${j}">
      <td>${j}</td>
      <td>
      <div class="form-check">
      <input type="checkbox" class="check${j}" id="${j}" onclick="cumple_muestras(this)">
      </div>
      </td>
      <td>
      <select class="form-control apariencia_etiquetas${j}" name="" id="apariencia_etiquetas${j}">
      <option disabled selected></option>    
      <option value="1">Cumple</option>
      <option value="2">No Cumple</option>
      <option value="3">No Aplica</option>
      </select>
      </td>
      <td><select class="form-control" name="" id="apariencia_termoencogible${j}">
      <option disabled selected></option>
      <option value="1">Cumple</option>
      <option value="2">No Cumple</option>
      <option value="3">No Aplica</option>
                        </select>
                        </td>
                        <td><select class="form-control" name="" id="cumplimiento_empaque${j}">
                        <option disabled selected></option>        
                        <option value="1">Cumple</option>
                        <option value="2">No Cumple</option>
                        <option value="3">No Aplica</option>
                        </select>
                        </td>
                        <td><select class="form-control" name="" id="posicion_producto${j}">
                            <option disabled selected></option>        
                            <option value="1">Cumple</option>
                            <option value="2">No Cumple</option>
                            <option value="3">No Aplica</option>
                            </select>
                            </td>
                    <td><select class="form-control" name="" id="rotulo_caja${j}">
                    <option disabled selected></option>        
                    <option value="1">Cumple</option>
                    <option value="2">No Cumple</option>
                    <option value="3">No Aplica</option>
                        </select>
                    </td>
                </tr>
            </tbody>`);
    }

    /* Recuperar muestras si existen*/
    j = 0;
    if (recoveredData !== null) {
      let data = JSON.parse(recoveredData);
      for (let i = 1; i <= data.length; i++) {
        $(`#apariencia_etiquetas${i}`).val(data[j]);
        j++;
        $(`#apariencia_termoencogible${i}`).val(data[j]);
        j++;
        $(`#cumplimiento_empaque${i}`).val(data[j]);
        j++;
        $(`#posicion_producto${i}`).val(data[j]);
        j++;
        $(`#rotulo_caja${i}`).val(data[j]);
        j++;
      }
    } else {
      $.ajax({
        type: 'POST',
        url: '../../html/php/muestras.php',
        data: { operacion: 4, idBatch, modulo, ref_multi },

        success: function (response) {
          if (response == 3) return false;

          let info = JSON.parse(response);
          i = 1;

          for (let j = 0; j < info.data.length; j++) {
            $(`#apariencia_etiquetas${i}`).val(
              info.data[j].apariencia_etiquetas
            );
            $(`#apariencia_termoencogible${i}`).val(
              info.data[j].apariencia_termoencogible
            );
            $(`#cumplimiento_empaque${i}`).val(
              info.data[j].cumplimiento_empaque
            );
            $(`#posicion_producto${i}`).val(info.data[j].posicion_producto);
            $(`#rotulo_caja${i}`).val(info.data[j].rotulo_caja);
            i++;
          }
        },
      });
    }
  };

  $('#guardar_muestras_acondicionamiento').click(function (e) {
    e.preventDefault();
    muestras_acon = $(`#muestras${id_multi}`).val();

    let cantidad_muestras = $(`#muestras${id_multi}`).val();
    let muestras = [];
    let recoveredData = sessionStorage.getItem(
      presentacion + ref_multi + modulo
    );

    if (recoveredData !== '') {
      sessionStorage.removeItem(presentacion + ref_multi + modulo);
    }

    /* cargar el array con las muestras */

    for (i = 1; i <= muestras_acon; i++) {
      //muestra = parseInt($(`#txtMuestra${i}`).val());
      let ae = $(`#apariencia_etiquetas${i}`).val();
      let at = $(`#apariencia_termoencogible${i}`).val();
      let ce = $(`#cumplimiento_empaque${i}`).val();
      let pp = $(`#posicion_producto${i}`).val();
      let rc = $(`#rotulo_caja${i}`).val();

      if (ae !== null) muestras.push(ae);
      else break;

      if (at !== null) muestras.push(at);
      else break;

      if (ce !== null) muestras.push(ce);
      else break;

      if (pp !== null) muestras.push(pp);
      else break;

      if (rc !== null) muestras.push(rc);
      else break;
    }

    /* almacena las muestras */

    sessionStorage.setItem(
      presentacion + ref_multi + modulo,
      JSON.stringify(muestras)
    );
    i = muestras.length;
    sessionStorage.setItem(`totalmuestras${id_multi}`, JSON.stringify(i));

    $('#m_muestras_acond').modal('hide');
    validar_condicionesMedio();
  });

  /* Genera cumple para todas las opciones en acondicionamiento */

  cumple_muestras = (obj) => {
    id = obj.id;
    $(`#apariencia_etiquetas${id}`).val(1);
    $(`#apariencia_termoencogible${id}`).val(3);
    $(`#cumplimiento_empaque${id}`).val(1);
    $(`#posicion_producto${id}`).val(1);
    $(`#rotulo_caja${id}`).val(1);
  };

  $('#aplicaTermoencogible').click(function (e) {
    e.preventDefault();
    for (let i = 1; i <= muestras; i++)
      $(`#apariencia_termoencogible${i}`).val(1);
  });
});
