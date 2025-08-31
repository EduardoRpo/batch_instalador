let flagE = 0;
let verifico;

$(document).ready(function () {
  imprimirEtiquetas = (data) => {
    tablePesaje.on('click', 'tbody tr', function (e) {
      e.preventDefault();
      $(this).toggleClass('tr_hover ');

      arrayData = [];
      JSONData = {};
      let codMateriaPrima = $(this).find('td:first').html();
      let peso = $(this).find('td:nth-child(4)').html();
      JSONData.orden = batch.numero_orden;
      JSONData.referencia = codMateriaPrima;
      JSONData.peso = peso;
      arrayData.push(JSONData);
      sessionStorage.setItem('batch', batch);
      $('#imprimirEtiquetas').modal('show');
    });
  };
});

$('#btnimprimirEtiquetas').click(function (e) {
  e.preventDefault();
  exportarEtiquetas();
  //imprimirEtiquetasVirtuales();
});

const imprimirEtiquetasFull = (marmita) => {
  const ref = batch.referencia;

  $.ajax({
    url: `/html/php/materiasp_fetch.php?idProduct=${ref}&v=${Date.now()}`,
    success: function (materiaPrima) {
      $.ajax({
        url: `/api/user/${modulo}/${idBatch}`,
        success: function (usuario) {
          modulo == 2
            ? imprimirEtiquetasPesaje(materiaPrima, usuario)
            : modulo == 3
            ? imprimirEtiquetasPreparacion(marmita, usuario)
            : modulo == 4
            ? imprimirEtiquetasAprobacion(usuario)
            : imprimirEtiquetasAcondicionamiento(usuario);
        },
      });
    },
  });
};

const imprimirEtiquetasPesaje = (materiaPrima, usuario) => {
  operacion = 1;
  arrayData = [];
  for (let i = 0; i < materiaPrima.length; i++) {
    pesaje = {};
    pesaje.orden = batch.numero_orden;
    pesaje.referencia = materiaPrima[i].referencia;
    pesaje.peso =
      ((materiaPrima[i].porcentaje / 100) * batch.tamano_lote) /
      $('#Notanques').val();
    pesaje.producto = batch.nombre_referencia;
    pesaje.user = usuario.nombres;
    arrayData.push(pesaje);
  }
  exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasPreparacion = (marmita, usuario) => {
  debugger;
  operacion = 2;
  arrayData = [];
  //let preparacion = batch;
  //numero_tanques = parseInt($("#cantidad1").html());

  preparacion = {};
  preparacion.referencia = batch.referencia;
  preparacion.producto = batch.nombre_referencia;
  preparacion.capacidad = batch.tamano_lote;
  preparacion.numero_lote = batch.numero_lote;
  preparacion.numero_orden = batch.numero_orden;
  preparacion.tanque = marmita;
  preparacion.numero_tanques = batch.cantidad;
  preparacion.usuario = usuario.nombres;
  arrayData.push(preparacion);

  exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasAprobacion = (usuario) => {
  operacion = 3;
  arrayData = [];
  numero_tanques = parseInt($('#cantidad1').html());

  for (let i = 1; i <= numero_tanques; i++) {
    aprobacion = {};
    aprobacion.orden = batch.numero_orden;
    aprobacion.referencia = batch.referencia;
    aprobacion.producto = batch.nombre_referencia;
    aprobacion.tamanio_lote = batch.tamano_lote;
    aprobacion.numero_lote = $('#in_numero_lote').val();
    aprobacion.numero_tanques = numero_tanques;
    aprobacion.user = usuario.nombres;
    arrayData.push(aprobacion);
  }
  exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasAcondicionamiento = (usuario) => {
  operacion = 4;
  id_multi = sessionStorage.getItem('id_multi');
  id_multi = id_multi - 1;

  arrayData = [];
  let batch = sessionStorage.batch;
  batch = JSON.parse(batch);

  acondicionamiento = {};
  acondicionamiento.referencia = batchMulti[id_multi].referencia;
  acondicionamiento.nombre_referencia = batchMulti[id_multi].nombre_referencia;
  acondicionamiento.presentacion = batchMulti[id_multi].presentacion;
  acondicionamiento.cantidad = batchMulti[id_multi].cantidad;
  acondicionamiento.unidad_empaque = batchMulti[id_multi].unidad_empaque;
  acondicionamiento.propietario = batch.propietario;
  acondicionamiento.user = usuario.nombres;
  acondicionamiento.numero_lote = $('#in_numero_lote').val();
  acondicionamiento.numero_orden = batch.numero_orden;
  arrayData.push(acondicionamiento);

  exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasRetencion = () => {
  operacion = 5;
  const referencia = batch.referencia;
  $.ajax({
    type: 'POST',
    url: '../../../html/php/etiquetas.php',
    data: { idBatch, referencia },
    success: function (response) {
      $muestras_retencion = JSON.parse(response);
      arrayData = [];
      for (let i = 0; i < $muestras_retencion.length + 1; i++) {
        retencion = {};
        retencion.referencia = batch.referencia;
        retencion.producto = batch.nombre_referencia;
        retencion.presentacion = batch.presentacion;
        retencion.lote = batch.numero_lote;
        retencion.orden = batch.numero_orden;
        if (i < $muestras_retencion.length)
          retencion.consecutivo = $muestras_retencion[i]['muestra'];
        else retencion.consecutivo = 'Microbiología';
        retencion.codigo = `Microbiología/${batch.numero_orden}/${batch.numero_lote}/${batch.referencia}`;
        arrayData.push(retencion);
      }
      exportarEtiquetas(operacion, arrayData);
    },
  });
};

const exportarEtiquetas = (operacion, arrayData) => {
  $.ajax({
    type: 'POST',
    url: '../../html/php/exportar.php',
    data: { operacion, array: arrayData },

    success: function (response) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.success('Datos para etiquetas exportados correctamente');
    },
  });
};

$('#btnImprimirTodaslasEtiquetas').click(function (e) {
  e.preventDefault();
  imprimirEtiquetasFull();
});

const ImprimirEtiquetasInvima = () => {
  $.ajax({
    url: `/api/etiquetasvirtualesinv/${referencia}/${idBatch}`,
    success: function (response) {
      if (!flagE) flagE = 1;
      else return false;

      for (let j = 0; j < response.length; j++) {
        if (response[j]['fecha_registro'])
          fecha = response[j]['fecha_registro'];
        if (response[j]['urlfirma']) verifico = response[j]['urlfirma'];
        if (response[j]['cantidad']) cantidad = response[j]['cantidad'];
      }

      etiquetasInvima(response);
      certificadoPesaje(response);
    },
  });
};

const etiquetasInvima = (response) => {
  for (i = 0; i < response.length - 2; i++) {
    let cond = i + 1 ;

    $('.etiquetasV').append(
      `<div style="width: 31%; float: left; margin: 5px;">
      <table class="etiquetaUnica rounded-3" style="width:100%;">
          <tr>
            <td style="width: 50%;">
              <b>OP: </b>${infoBatch.numero_orden}
            </td>
            <td style="width: 50%; font-size: 25px;">
              <b>PESO: </b>
              ${(
        ((response[i]['porcentaje'] / 100) * tamanioLote) /
        cantidad
      ).toFixed(2)}Kg
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <b>REFERENCIA:</b> ${response[i]['referencia']}
            </td>
          </tr>
          <tr>
            <td style="width:50%">
              <b>NOMBRE MP:</b> ${response[i]['alias']}
            </td>
            <td style="width:50%">
              <b>FECHA: </b> ${fecha}
            </td>
          </tr>
          ${!verifico || verifico == ''
        ? `<tr>
            <td>
              <b>VoBo QC: </b>
              <img src="${verifico}" style="width:60%">
            </td>
          </tr>`
        : ''
      } 
        </table>
        </div>
        ${cond % 3 === 0 ? '<div style="clear: both;"></div>' : ''}`
    );
    // $('.etiquetasV').append(
    //   `<div class="etiquetaUnica rounded-3">
    //             <div class="etiquetasVirtuales">
    //                 <p><b>OP: </b>${infoBatch.numero_orden}</p>
    //                 <p id="peso"><b>PESO: </b>${(
    //                   ((response[i]['porcentaje'] / 100) * tamanioLote) /
    //                   cantidad
    //                 ).toFixed(2)}Kg</p>
    //                 <p><b>REFERENCIA:</b> ${response[i]['referencia']}</p>
    //                 <p><b>NOMBRE MP:</b> ${response[i]['alias']}</p>
    //                 <p><b>FECHA: </b> ${fecha}</p>
    //                 ${
    //                   !verifico || verifico == ''
    //                     ? `<p><b>VoBo QC: </b><img src="${verifico}" style="width:60%"></p>`
    //                     : ''
    //                 } 
    //             </div>
    //         </div>`
    // );
  }
};

const certificadoPesaje = (response) => {
  let percent = 0;
  let tamanio = 0;

  $('.mpcerti').append(
    `<tr>
        <td class="cltitle" style="width:40px"></td>
        <td class="cltitle">
          MATERIA PRIMA
        </td>
        <td class="cltitle">
          %(p/p) FORMULA
        </td>
        <td class="cltitle">
          CANTIDAD PESADA
        </td>
      </tr>`
  );

  for (i = 0; i < response.length - 2; i++) {
    $('.mpcerti').append(
      `<tr>
        <td class="fr" colspan="2" style="padding-left: 40px;">${response[i]['alias']}</td>
        <td class="fr">${response[i]['porcentaje']}%</td>
        <td class="fr">
          ${(
                ((response[i]['porcentaje'] / 100) * tamanioLote) /
                cantidad ).toFixed(2)} Kg
            </td>
      </tr>`
    );

    percent = percent + response[i]['porcentaje'];
    tamanio =
      tamanio + ((response[i]['porcentaje'] / 100) * tamanioLote) / cantidad;
  }

  $('.mpcerti').append(
    `<tr>
      <td class="text-right" colspan="2"><b>TOTAL</b></td>
      <td class="text-center"><b>${percent.toFixed(2)}</b></td>
      <td class="text-center"><b>${tamanio.toFixed(2)}</b></td>
    </tr>`
  );

  // $('.mpcerti').append(
  //   ` <div class="cltitle">MATERIA PRIMA</div>
  //             <div class="cltitle">%(p/p) FORMULA</div>
  //             <div class="cltitle">CANTIDAD PESADA</div>`
  // );

  // for (i = 0; i < response.length - 2; i++) {
  //   $('.mpcerti').append(
  //     `<div class="fr">${response[i]['alias']}</div>
  //           <div class="fr">${response[i]['porcentaje']}%</div>
  //           <div class="fr">${(
  //             ((response[i]['porcentaje'] / 100) * tamanioLote) /
  //             cantidad
  //           ).toFixed(2)} Kg</div>
  //           `
  //   );

  //   percent = percent + response[i]['porcentaje'];
  //   tamanio =
  //     tamanio + ((response[i]['porcentaje'] / 100) * tamanioLote) / cantidad;
  // }

  // $('.mpcerti').append(
  //   ` <div class="center-text"><b>TOTAL</b></div>
  //         <div class="center-text"><b>${percent.toFixed(2)}</b></div>
  //         <div><b>${tamanio.toFixed(2)}</b></div>`
  // );
};
