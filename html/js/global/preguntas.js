$(document).ready(function () {
  /* Crear Preguntas */

  preguntas = async (modulo) => {
    let result;
    try {
      console.log('🔍 preguntas - Buscando preguntas para módulo:', modulo);
      console.log('🔍 preguntas - URL que se va a llamar:', `/html/php/questions_fetch.php?modulo=${modulo}`);
      
      result = await $.ajax({ url: `/html/php/questions_fetch.php?modulo=${modulo}` });
      console.log('✅ preguntas - Respuesta exitosa:', result);
      return result;
    } catch (error) {
      console.error('❌ preguntas - Error en la petición:', error);
      console.error('❌ preguntas - Status:', error.status);
      console.error('❌ preguntas - Response:', error.responseText);
    }
  };

  carguepreguntas = async () => {
    console.log('🔍 carguepreguntas - Iniciando carga de preguntas');
    const data = await preguntas(modulo);
    console.log('🔍 carguepreguntas - Datos recibidos:', data);
    
    if (!data || !Array.isArray(data)) {
      console.error('❌ carguepreguntas - No se recibieron datos válidos:', data);
      return;
    }
    
    cantidadpreguntas = data.length;
    console.log('🔍 carguepreguntas - Cantidad de preguntas:', cantidadpreguntas);

    $('#preguntas-div').html('');

    data.forEach((question, indx) => {
      console.log(`🔍 carguepreguntas - Procesando pregunta ${indx + 1}:`, question);
      $('#preguntas-div').append(`
                <a for="recipient-name" class="col-form-label" id="${question.id_pregunta}">${question.pregunta}</a>
                <label class="checkbox"> 
                <input type="radio" class="questions" name="question-${question.id_pregunta}" id="${question.id_pregunta}" value="1" /></label>
                <label class="checkbox"> 
                <input type="radio" name="question-${question.id_pregunta}" id="${question.id_pregunta}" value="0"/></label>`);
    });
    console.log('✅ carguepreguntas - Preguntas cargadas exitosamente');
    //cargarPreguntasAlmacenadas(data)
  };

  /* Consulta */

  /* preguntasAlmacenadas = async() => {
        data = { operacion: 1, modulo, idBatch }
        return result = await sendDataPOST("../../html/php/despeje.php", data, 1)
    } */

  /* cargarPreguntasAlmacenadas = async(info) => {
        //info = await preguntasAlmacenadas()
        if (info !== "") {
            for (let i = 0; i < info.length; i++) {
                let question = "question-" + `${info[i].id_pregunta}`;
                let valor = info[i].solucion;
                $("input:radio[name=" + question + "][value=" + valor + "]").prop("checked", true);
            }
            return true
        } else return false;
    } */

  /* Almacenar datos de preguntas */

  guardar_preguntas = (idfirma) => {
    let list = { datos: [] };

    $('input:radio:checked').each(function () {
      list.datos.push({
        pregunta: $(this).attr('id'),
        solucion: $(this).val(),
        modulo: modulo,
        batch: idBatch,
      });
    });

    json = JSON.stringify(list);
    let obj = JSON.parse(json);

    desinfectante = $('#sel_producto_desinfeccion').val();
    obs_desinfectante = $('#in_observaciones').val() || ''; // Asegurar que sea string vacío si está vacío

    $.ajax({
      type: 'POST',
      url: '../../html/php/despeje.php',
      data: {
        operacion: 4,
        respuestas: obj,
        modulo,
        idBatch,
        desinfectante,
        obs_desinfectante,
        realizo: idfirma,
      },
      success: function (response) {
        // if (response > 0) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Firmado satisfactoriamente");
        $('.despeje_realizado')
          .css({ background: 'lightgray', border: 'gray' })
          .prop('disabled', true);
        $('.despeje_verificado').prop('disabled', false);
        
        // Habilitar inmediatamente el botón de pesaje sin importar las observaciones
        $('.pesaje_realizado').prop('disabled', false);
        
        // También habilitar otros botones si es necesario
        habilitarbotones();
        // }
      },
    });
  };
});
