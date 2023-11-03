modulo = 10;
let radio;

loadBatch = async () => {
  let resp = await cargarInfoBatch();
  if (resp == null) {
    cargarTanques();
  }
};

loadBatch();

$(document).ready(function () {
  cargar = (btn, idbtn) => {
    sessionStorage.setItem('idbtn', idbtn);
    id = btn.id;

    radio = $('input:radio[name=liberacion]:checked').val();
    if (radio == undefined) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione una opción para liberar el producto');
      return false;
    }

    $('#usuario').val('');
    $('#clave').val('');
    $('#m_firmar').modal('show');
  };

  guardarLiberacion = (info) => {
    let obs = $('#observacioneslote').val();
    let data = [];
    data.push({ radio: radio, id: id, info: info, obs: obs, idBatch: idBatch });

    $.ajax({
      type: 'POST',
      url: '/api/liberacion',
      data: { data },
      success: async function (response) {
        if (response == 1) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error('Faltan firmas en Despachos para cerrar el lote');
          return false;
        }

        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Firmado exitosamente');
        if (id == 'calidad_verificado' || id == 'tecnica_realizado')
          await firmar(info);
        id = sessionStorage.getItem('idbtn');
        if (id == 'firma1')
          $('.produccion_realizado')
            .css({ background: 'lightgray', border: 'gray' })
            .prop('disabled', true);
        else if (id == 'firma2')
          $('.calidad_verificado')
            .css({ background: 'lightgray', border: 'gray' })
            .prop('disabled', true);
        else
          $('.tecnica_realizado')
            .css({ background: 'lightgray', border: 'gray' })
            .prop('disabled', true);
        await firmar(info);

        let data = await searchData(`/api/countFirmasLiberacion/${idBatch}`);

        if (data.cantidad_firmas == data.total_firmas) {
          data = await searchData(`/api/batch/${idBatch}`);
          localStorage.setItem('dataBatchPdf', JSON.stringify(data));
          localStorage.setItem('opLiberacion', 1);

          // let urlActual = window.location.href;

          // if (urlActual.includes('https'))
          //   urlActual = `https://batchrecord/pdf/${idBatch}/${data.referencia}`;
          // else urlActual = `http://batchrecord/pdf/${idBatch}/${data.referencia}`;

          // window.open(urlActual, '_blank');
          let urlActual = window.location.href;
 
          let urlPrincipal = urlActual.match(/https?:\/\/[^/]+/);

          if (urlPrincipal) { 
            let urlCompleta = `${urlPrincipal[0]}/pdf/${idBatch}/${data.referencia}`;
  
            window.open(urlCompleta, '_blank');
          } else {
            console.log("No se pudo extraer la parte principal de la URL.");
          }
        }
      },
    });
  };

  cargarBatch = () => {
    $.post(
      '../../html/php/liberacion.php',
      { idBatch, op: 2 },
      function (data, textStatus, jqXHR) {
        info = JSON.parse(data);
        if (info == false) return false;
        $('#observacioneslote').val(info.observaciones);
        if (info.aprobacion == 0) $('#radioLiberacionNo').prop('checked', true);
        else $('#radioLiberacionSi').prop('checked', true);
        if (info.produccion != null) firmado(info.produccion, 1);
        if (info.calidad != null) firmado(info.calidad, 2);
        if (info.tecnica != null) firmado(info.tecnica, 3);
      }
    );
  };

  firmado = (datos, posicion) => {
    let template =
      '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $('#idbtn').val();

    if (posicion == 1) {
      parent = $('#produccion_realizado').parent();
      $('#produccion_realizado').remove();
      $('.produccion_realizado')
        .css({ background: 'lightgray', border: 'gray' })
        .prop('disabled', true);
    }

    if (posicion == 2) {
      parent = $('#calidad_verificado').parent();
      $('#calidad_verificado').remove();
      $('.calidad_verificado')
        .css({ background: 'lightgray', border: 'gray' })
        .prop('disabled', true);
    }

    if (posicion == 3) {
      parent = $('#tecnica_realizado').parent();
      $('#tecnica_realizado').remove();
      $('.tecnica_realizado')
        .css({ background: 'lightgray', border: 'gray' })
        .prop('disabled', true);
    }

    let firma = template.replace(':firma:', datos);
    parent.append(firma).html;
  };
  cargarBatch();
});
