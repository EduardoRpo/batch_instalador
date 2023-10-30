let idBatch;
let referencia;
let cantidad;
let presentacion;
let densidad;
let tamanioLote;
let infoBatch;
let multi;
let utilizada = 0;

/* obtener batch y referencia seleccionada */
$(document).ready(function () {
  var pathname = window.location.pathname;
  idList = pathname.split('/');
  idBatch = idList[2];
  referencia = idList[3];
});

/* bloquear inputs */
$('input').prop('readonly', true);

/* Imprimir pdf */

$(document).on('click', '.link-imprimir', function (e) {
  e.preventDefault();
  window.print();
  return false;
});

/* cerrar ventana */
$(document).on('click', '.link-cerrar', function (e) {
  e.preventDefault();
  window.close();
});

/* Mostrar multipresentacion */
$(`#infoMulti`).hide();
$('#watermark').hide();
$('#multi-envasado2').hide();
$('#multi-envasado3').hide();
$('#multi-envasado4').hide();

$('#multi-acondicionamiento2').hide();
$('#multi-acondicionamiento3').hide();
$('#multi-acondicionamiento4').hide();

$('#multi-despachos2').hide();
$('#multi-despachos3').hide();
$('#multi-despachos4').hide();

/* Cargar version */

cargar_version_PDF = (date) => {
  let dataVersion = JSON.parse(date);
  $.get(
    `/api/getversions/${dataVersion.fecha_creacion}/1`,
    function (data, textStatus, jqXHR) {
      $('#codigo').html(`Código: <b>${data.codigo}</b>`);
      $('#version').html(`Versión: <b>${data.version}</b>`);
      $('#fecha').html(`Fecha: <b>${data.fecha}</b>`);
    }
  );
};

/* Cargar data */

cargar_Alertas = () => {
  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    (data = { operacion: 7 }),
    function (data, textStatus, jqXHR) {
      info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        data = Object.values(JSON.parse(info[i].descripcion));

        $(`#title${info[i].ubicacion}`).html('<b>' + data[0] + '</b>');
        if (`${info[i].ubicacion}` == 3) $('.desin_titulo').html(data[0]);

        for (let j = 0; j < data[1].length; j++) {
          $(`#vinetas${info[i].ubicacion}`).append(`<li>${data[1][j]}</li>`);
          if (`${info[i].ubicacion}` == 3) {
            $('.desinfectante').append(`<li>${data[1][j]}</li>`);
          }
        }
      }
    }
  );
};

/* Cargar observaciones */

const cargarObservaciones = () => {
  $.post(
    '../../html/php/servicios/observaciones/batch_obs_pdf.php',
    { batch: idBatch },
    function (data, textStatus, jqXHR) {
      data = JSON.parse(data);
      for (let i = 0; i < data.length; i++) {
        let ref = data[i].ref_multi;
        if (ref === undefined || ref == 0)
          $(`#obs${data[i].modulo}`).append(`${data[i].observaciones}`);
        else
          $(`#obs${data[i].modulo}`).append(
            `Referencia: ${data[i].ref_multi} Observación: ${data[i].observaciones}`
          );
      }
    }
  );
};

/* Multipresentacion */

async function multipresentacion() {
  let result;
  result = await $.ajax({
    url: '../../html/php/servicios/c_batch_pdf.php',
    type: 'POST',
    data: { idBatch, operacion: 18 },
  });
  sessionStorage.setItem('multi', result);
  return result;
}

/* Informacion del producto Header */

async function informacion_producto() {
  let result;
  result = await $.ajax({
    url: '../../html/php/servicios/c_batch_pdf.php',
    type: 'POST',
    data: { idBatch, operacion: 2 },
  });
  return result;
}

const cargarMultipresentacion = (data) => {
  if (data == 0) {
    $(`#subtitle_envasado1`).hide();
    $(`#subtitle_acond1`).hide();
  } else {
    for (let i = 0; i < data.length; i++) {
      $(`#multi-envasado${i + 1}`).show();
      $(`#multi-acondicionamiento${i + 1}`).show();
      $(`#infoMulti`).show();
      $(`#InfoMultipresentacion`).append(`
        <tr>
          <td style="width:3%"></td>
          <td style="width:9.5%">Referencia:</td>
          <td style="width:12.5%"><b>${data[i].referencia}</b></td>
          <td style="width:12.5%">Presentación:</td>
          <td style="width:12.5%"><b>${data[i].presentacion_comercial}</b></td>
          <td style="width:12.5%">Lote total(kg):</td>
          <td style="width:12.5%"><b>${data[i].total}</b></td>
          <td style="width:12.5%">Cantidad:</td>
          <td><b>${data[i].cantidad}</b></td>
        </tr>`);
    }

    j = 1;
    for (let i = 0; i < multi.length; i++) {
      $(`#titulo_envasado${j}`).html(
        `<b>ENVASADO <br>REFERENCIA: ${multi[i].referencia}</b>`
      );
      j++;
    }
    j = 1;
    for (let i = 0; i < multi.length; i++) {
      $(`#titulo_acondicionamiento${j}`).html(
        `<b>ACONDICIONAMIENTO <br>REFERENCIA: ${multi[i].referencia}</b>`
      );
      j++;
    }
  }
};

function info_General(data) {
  if (data == 'false') return false;
  let info = JSON.parse(data);

  infoBatch = info;
  cantidad_lote = info.unidad_lote;
  presentacion = info.presentacion;
  densidad = info.densidad;
  tamanioLote = info.tamano_lote;

  if (info.estado == 0) $('#watermark').show();

  $('.ref').html(info.referencia);
  $('#nref').html(`<b>${info.nombre_referencia}</b>`);
  $('#marca').html(`<b>${info.marca}</b>`);
  $('#propietario').html(`<b>${info.propietario}</b>`);
  $('#notificacion').html(`<b>${info.notificacion}</b>`);
  $('#presentacion').html(`<b>${info.presentacion}</b>`);
  $('.orden').html(`<b>${info.numero_orden}</b>`);
  $('.lote').html(`<b>${info.numero_lote}</b>`);
  $('.fecha').html(`<b>${info.fecha_creacion}</b>`);
  $('#tamanolt').html(`<b>${info.tamano_lote}</b>`);
  $('#tamanol').html(`<b>${info.tamano_lote}</b>`);
  $('#unidadesLote').html(`<b>${info.unidad_lote}</b>`);
  $('.fecha').html(`<b>${info.fecha_creacion}</b>`);
  $('.linea').html(`${info.linea}`);

  // certificado Pesaje
  $('.product').html(`${info.nombre_referencia}`);
  $('.invima_id').html(`${info.notificacion}`);
  $('.linea').html(`${info.linea}`);
  $('.lote_id').html(`${info.numero_lote}`);
  $('.tamanioLotePesaje').html(`${info.tamano_lote}`);
}

parametros_Control = () => {
  let data = { operacion: 3, idBatch };

  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    data,
    function (data, textStatus, jqXHR) {
      if (data == 'false') return false;
      let info = JSON.parse(data);
      let j = 1;
      let modulo = 1;

      for (let i = 0; i < info.length; i++) {
        if (modulo == info[i].id_modulo) j++;
        else {
          j = 1;
          modulo = info[i].id_modulo;
        }

        $(`#despeje_linea${info[i].id_modulo}`).append(`
                    <tr>
                        <td scope="row" class="centrado">${j}</td>
                        <td>${info[i].pregunta}</td>
                        <td class="centrado">${
                          info[i].solucion == 1 ? 'X' : ''
                        }</td>
                        <td class="centrado">${
                          info[i].solucion == 0 ? 'X' : ''
                        }</td>
                    </tr>`);
      }
    }
  );
};

lote_anterior = () => {
  let lote = infoBatch.numero_lote;
  let linea = lote.slice(0, 2);
  let serie = lote.slice(2, 5);
  let fecha = lote.slice(5, 9);
  serie = parseInt(serie);
  serie = serie - 1;

  lote = linea.concat('0', serie, fecha);
  area_desinfeccion(lote);
};

area_desinfeccion = (lote) => {
  let data = { operacion: 4 };

  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    data,
    function (data, textStatus, jqXHR) {
      if (data == 'false') return false;
      let info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        $(`#area_desinfeccion${info[i].modulo}`).empty();
      }

      for (let i = 0; i < info.length; i++) {
        $(`#area_desinfeccion${info[i].modulo}`).append(`
          <tr>
            <td>${info[i].descripcion}</td>
            <td class="centrado desinfectante${info[i].modulo}"></td>
            <td class="centrado concentracion${info[i].modulo}"></td>
            <td class="centrado">${lote}</td>
          </tr>`);
      }
      desinfectante();
    }
  );
};

desinfectante = () => {
  let data = { operacion: 5, idBatch };

  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    data,
    function (data, textStatus, jqXHR) {
      if (data == 'false') return false;

      let info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        $(`#blank_rea${info[i].modulo}`).hide();
        $(`#blank_ver${info[i].modulo}`).hide();

        /* fecha nuevo registro cambia a fecha registro a partir del 3200 */
        if (idBatch >= 3200) fechaRegistro = info[i].fecha_registro;
        else fechaRegistro = info[i].fecha_nuevo_registro;

        $(`.desinfectante${info[i].modulo}`).html(info[i].desinfectante);
        $(`.concentracion${info[i].modulo}`).html(
          info[i].concentracion * 100 + '%'
        );
        $(`#fecha${info[i].modulo}`).html(fechaRegistro);

        if (info[i].modulo == 6) {
          $('#fsiembra').css('text-align', 'center');
          document.getElementById(`fsiembra`).setAttribute('value', info[i].fechaRegistro);
        }
        if (info[i].modulo == 8) {
          document.getElementById(`fresultados`).setAttribute('value', info[i].fechaRegistro);
          
          $('#fresultados')
            .css('text-align', 'center');
        }

        $(`.fecha_medio${info[i].modulo}`).html(info[i].fechaRegistro);
      }

      let fecha = $('#fecha2').html();
      fecha = fecha.substr(0, 10);
      $('.fecha2').html(fecha);
      $('.fecha_pesaje').html(fecha);
    }
  );
};

const firmas = () => {
  let data = { operacion: 17, idBatch };

  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    data,
    function (data, textStatus, jqXHR) {
      if (data == 'false') return false;

      let info = JSON.parse(data);
      for (let i = 0; i < info.length; i++) {
        if (info[i].realizo != 0) {
          $(`#f_realizo${info[i].modulo}`).prop('src', info[i].realizo);
          $(`#user_realizo${info[i].modulo}`).html(
            `Realizó: <b>${info[i].nombre_realizo}</b>`
          );

          //firmas certificado pesaje
          if (info[i].modulo == 2) {
            $(`#realizo${info[i].modulo}`).prop('src', info[i].realizo);
            $(`#verifico${info[i].modulo}`).prop('src', info[i].verifico);
          }
        } else if (info[i].realizo == 0) {
          $(`#f_realizo${info[i].modulo}`).prop('hide', true);
          $(`#blank_rea${info[i].modulo}`).show();
          $(`#user_realizo${info[i].modulo}`).html(
            `Realizó:<b> Sin firmar</b>`
          );
        }

        if (info[i].verifico != 0) {
          $(`#f_verifico${info[i].modulo}`).prop('src', info[i].verifico);
          $(`#user_verifico${info[i].modulo}`).html(
            `Verificó: <b>${info[i].nombre_verifico}</b>`
          );
        } else {
          $(`#f_verifico${info[i].modulo}`).hide();
          $(`#blank_ver${info[i].modulo}`).show(); 
          $(`#user_verifico${info[i].modulo}`).html(
            `Verificó: <b>Sin firmar</b>`
          );
        }
      }
      firmas_multi(info);
    }
  );
};

const firmas_multi = (info) => {
  if (multi) {
    for (let i = 0; i < multi.length; i++)
      for (let j = 0; j < info.length; j++)
        if (multi[i]['referencia'] == info[j]['ref_multi']) {
          /* batch 2599 incluido en adelante tomar fecha registro  */
          if (idBatch >= 2599) fechaRegistro = info[j].fecha_registro;
          else fechaRegistro = info[j].fecha_nuevo_registro;

          $(`#multi_fecha${i + 1}`).html(fechaRegistro);
          $(`#multi_f_realizo${i + 1}`).prop('src', info[j].realizo);
          $(`#multi_user_realizo${i + 1}`).html(
            `Realizó: <b>${info[j].nombre_realizo}</b>`
          );
          $(`#multi_blank_realizo${i + 1}`).hide();

          /*  $(`#multi_f_realizo${i + 1}`).prop("hide", true);
                              $(`#multi_blank_realizo${i + 1}`).show();
                              $(`#multi_user_realizo${i + 1}`).html(`Realizó:<b> Sin firmar</b>`); */

          $(`#multi_f_verifico${info[i].modulo}`).prop('src', info[i].verifico);
          $(`#multi_user_verifico${info[i].modulo}`).html(
            `Verificó: <b>${info[i].nombre_verifico}</b>`
          );
          $(`#multi_blank_verifico${i + 1}`).hide();

          /* $(`#multi_f_verifico${info[i].modulo}`).hide();
                              $(`#multi_blank_ver${info[i].modulo}`).show();
                              $(`#multi_user_verifico${info[i].modulo}`).html(
                                `Verificó: <b>Sin firmar</b>`
                              ); */
        }
  }
};

function condiciones_medio() {
  let data = { operacion: 6, idBatch };
  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    data,
    function (data, textStatus, jqXHR) {
      if (data == 'false') return false;
      let info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        $(`.fecha_medio${info[i].modulo}`).html(info[i].fecha);
        $(`.temperatura${info[i].modulo}`).html(info[i].temperatura + ' °C');
        $(`.humedad${info[i].modulo}`).html(info[i].humedad + ' %');
      }
    }
  );
}

function equipos() {
  $.get(`/api/equipos/${idBatch}`, function (data, textStatus, jqXHR) {
    if (data.length == 0) return false;
    for (i = 0; i < data.length; i++) {
      if (data[i].tipo === 'agitador') {
        document.getElementById(`agitador`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'marmita') {
        document.getElementById(`marmita`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'envasadora') {
        document.getElementById(`envasadora1`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'loteadora') {
        document.getElementById(`loteadora1`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'banda') {
        document.getElementById(`banda`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'etiquetadora') {
        document.getElementById(`etiquetadora`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'tunel') {
        document.getElementById(`tunel`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'incubadora') {
        document.getElementById(`incubadora`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'autoclave') {
        document.getElementById(`autoclave`).setAttribute('value', data[i].descripcion);
        continue;
      }
      if (data[i].tipo === 'cabina') {
        document.getElementById(`cabina`).setAttribute('value', data[i].descripcion);
        continue;
      }
    }
  });
}

function especificaciones_producto() {
  $.ajax({
    url: `/api/productsDetails/${referencia}`,
    type: 'GET',
  }).done((data, status, xhr) => {
    $('.espec_color').html(data.color);
    $('.espec_olor').html(data.olor);
    $('.espec_apariencia').html(data.apariencia);
    $('.espec_ph').html(
      `${data.limite_inferior_ph} a ${data.limite_superior_ph}`
    );
    $('.espec_viscosidad').html(
      `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`
    );
    $('.espec_densidad').html(
      `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`
    );
    $('.espec_untuosidad').html(data.untuosidad);
    $('.espec_poder_espumoso').html(data.poder_espumoso);
    $('.espec_grado_alcohol').html(
      `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`
    );

    $('#in_ph').attr('min', data.limite_inferior_ph);
    $('#in_ph').attr('max', data.limite_superior_ph);
    $('#in_densidad').attr('min', data.limite_inferior_densidad_gravedad);
    $('#in_densidad').attr('max', data.limite_superior_densidad_gravedad);
    $('#in_grado_alcohol').attr('min', data.limite_inferior_grado_alcohol);
    $('#in_grado_alcohol').attr('max', data.limite_superior_grado_alcohol);
    $('#in_viscocidad').attr('min', data.limite_inferior_viscosidad);
    $('#in_viscocidad').attr('max', data.limite_superior_viscosidad);

    $('#espec1').html(data.mesofilos);
    $('#espec2').html(data.pseudomona);
    $('#espec3').html(data.escherichia);
    $('#espec4').html(data.staphylococcus);
  });
}

function control_proceso() {
  $.get(`/api/controlproceso/${idBatch}`, function (info, textStatus, jqXHR) {
    if (info == 'false') return false;
    //info = data;
    for (let i = 0; i < info.length; i++) {
      $(`.color${info[i].modulo}`).html(
        info[i].color == 1
          ? 'Cumple'
          : info[i].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
      $(`.olor${info[i].modulo}`).html(
        info[i].olor == 1
          ? 'Cumple'
          : info[i].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
      $(`.apariencia${info[i].modulo}`).html(
        info[i].apariencia == 1
          ? 'Cumple'
          : info[i].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
      $(`.ph${info[i].modulo}`).html(info[i].ph);
      $(`.viscosidad${info[i].modulo}`).html(info[i].viscosidad);
      $(`.densidad${info[i].modulo}`).html(info[i].densidad);
      $(`.untuosidad${info[i].modulo}`).html(
        info[i].untuosidad == 1
          ? 'Cumple'
          : info[0].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
      $(`.espumoso${info[i].modulo}`).html(
        info[i].espumoso == 1
          ? 'Cumple'
          : info[i].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
      $(`.alcohol${info[i].modulo}`).html(
        info[i].alcohol == 1
          ? 'Cumple'
          : info[i].color == 2
          ? 'No Cumple'
          : 'No aplica'
      );
    }
  });
}

ajustes = () => {
  $.ajax({
    url: '../../html/php/ajustes.php',
    type: 'POST',
    data: { batch: idBatch },
  }).done((data, status, xhr) => {
    info = JSON.parse(data);
    document.getElementById(`No3`).setAttribute('value', 'X');
    document.getElementById(`No4`).setAttribute('value', 'X');
    document.getElementById(`No9`).setAttribute('value', 'X');


    for (i = 0; i < info.length; i++) {
      document.getElementById(`Si${info[i].modulo}`).setAttribute('value', 'X');
      document.getElementById(`No${info[i].modulo}`).setAttribute('value', '');
      document.getElementById(`materiaPrimaAjustes${info[i].modulo}`).setAttribute('value', info[i].materia_prima);
      document.getElementById(`procedimientoAjustes${info[i].modulo}`).setAttribute('value', info[i].procedimiento);
    }
  });
};

/* Calcular peso minimo, maximo y promedio */

identificarDensidad = () => {
  let densidadAprobada = 0;
  $.ajax({
    type: 'POST',
    url: '../../html/php/controlProceso.php',
    data: { modulo: 4, idBatch },

    success: function (response) {
      if (response == 0) return false;
      else {
        let espec = JSON.parse(response);
        for (let i = 0; i < espec.length; i++) {
          densidadAprobada = densidadAprobada + espec[i].densidad;
        }
        densidadAprobada = densidadAprobada / espec.length;
        calcularPeso(densidadAprobada);
      }
    },
  });
};

function calcularPeso(densidadAprobada) {
  if (multi.length != '0') {
    for (let i = 0; i < multi.length; i++) {
      //presentacion = $("#presentacion").html();
      //presentacion = getNumbersInString(presentacion);
      presentacion = multi[i]['presentacion_comercial'];
      let peso_min = presentacion * densidadAprobada;
      let peso_max = peso_min * (1 + 0.03);
      let prom = (parseInt(peso_min) + peso_max) / 2;
 
      document.getElementsByClassName(`minimo${i + 1}`)[0].setAttribute('value', peso_min.toFixed(2));
      document.getElementsByClassName(`maximo${i + 1}`)[0].setAttribute('value', peso_max.toFixed(2));
      document.getElementsByClassName(`medio${i + 1}`)[0].setAttribute('value', prom.toFixed(2));
    }
  } else {
    presentacion = parseInt($('#presentacion').text());

    let peso_min = presentacion * densidadAprobada;
    let peso_max = peso_min * (1 + 0.03);
    let prom = (parseInt(peso_min) + peso_max) / 2;

    document.getElementsByClassName('minimo1')[0].setAttribute('value', peso_min.toFixed(2));
    document.getElementsByClassName('maximo1')[0].setAttribute('value', peso_max.toFixed(2));
    document.getElementsByClassName('medio1')[0].setAttribute('value', prom.toFixed(2));
  }
}

/* Obtener muestras envasado */

const muestras_envasado = async () => {
  // $.ajax({
  //   type: 'POST',
  //   url: '../../html/php/muestras.php',
  //   data: { operacion: 6, idBatch },

  //   success: function (response) {
  //     if (response == 3) return false;
  //     let promedio = 0;
  //     let cont = 0;
  //     let sum = 0;
  //     let info = JSON.parse(response);

  //     if (multi.length != 0) {
  //       for (let i = 0; i < multi.length; i++) {
  //         sum = 0;
  //         promedio = 0;
  //         cont = 0;
  //         for (let j = 0; j < info.length; j++) {
  //           if (multi[i]['referencia'] == info[j]['referencia']) {
  //             cont = cont + 1;
  //             $(`#muestrasEnvasado${i + 1}`).append(
  //               `<td class="centrado">${info[j]['muestra']}</td>`
  //             );
  //             sum = sum + info[j]['muestra'];
  //             promedio = (sum / cont).toFixed(2);
  //             $(`#promedioMuestras${i + 1}`).val(promedio);
  //             $(`#cantidadMuestras${i + 1}`).val(cont);
  //           }
  //         }
  //       }
  //     } else {
  //       for (let j = 0; j < info.length; j++) {
  //         cont = cont + 1;
  //         $(`#muestrasEnvasado1`).append(
  //           `<td class="centrado">${info[j]['muestra']}</td>`
  //         );
  //         sum = sum + info[j]['muestra'];
  //         promedio = (sum / cont).toFixed(2);
  //       }
  //       $(`#promedioMuestras1`).val(promedio);
  //       $(`#cantidadMuestras1`).val(cont);
  //     }
  //   },
  // });

  let resp = await searchData(`/api/muestras/${idBatch}`);

  if (resp == false) return false;
  let promedio = 0;
  let cont = 0;
  let sum = 0;

  if (multi.length != 0) { 
    for (let i = 0; i < multi.length; i++) {
      sum = 0;
      promedio = 0;
      cont = 0;
      for (let j = 0; j < resp.length; j++) {
        if (multi[i]['referencia'] == resp[j]['referencia']) {
          if (cont % 10 === 0) {
            $(`#tblMuestrasEnvasadoBody${i + 1}`).append('<tr></tr>');
          }

          $(`#tblMuestrasEnvasadoBody${i + 1} tr:last-child`).append(`<td>${resp[j]['muestra']}</td>`);

          cont = cont + 1;
          sum = sum + resp[j]['muestra'];
          promedio = (sum / cont).toFixed(2); 
          document.getElementById(`promedioMuestras${i + 1}`).setAttribute('value', promedio);
          document.getElementById(`cantidadMuestras${i + 1}`).setAttribute('value', cont);
        }
      }
    }
  } else {
    for (let j = 0; j < resp.length; j++) {
      if (cont % 10 === 0) {
        $(`#tblMuestrasEnvasadoBody1`).append('<tr></tr>');
      }
      $(`#tblMuestrasEnvasadoBody1 tr:last-child`).append(`<td>${resp[j]['muestra']}</td>`);

      cont = cont + 1;
      sum = sum + resp[j]['muestra'];
      promedio = (sum / cont).toFixed(2);
    } 
    document.getElementById('promedioMuestras1').setAttribute('value', promedio);
    document.getElementById('cantidadMuestras1').setAttribute('value', cont);
  }
};

function entrega_material_envase(multi) {
  if (multi != undefined) {
    for (let i = 0; i < multi.length; i++) {
      ref = multi[i].referencia;
      $.ajax({
        url: '../../html/php/envase.php',
        type: 'POST',
        data: { referencia: ref },
      }).done((data, status, xhr) => {
        if (data != '') {
          info = JSON.parse(data);
          $(`.envase${i + 1}`).html(info[0].id_envase);
          $(`.descripcion_envase${i + 1}`).html(info[0].envase);
          $(`.tapa${i + 1}`).html(info[0].id_tapa);
          $(`.descripcion_tapa${i + 1}`).html(info[0].tapa);
          $(`.etiqueta${i + 1}`).html(info[0].id_etiqueta);
          $(`.descripcion_etiqueta${i + 1}`).html(info[0].etiqueta);

          if ($(`.envase${i + 1}`).html() == 50000)
            $(`.unidades${i + 1}`).html('0');
          else $(`.unidades${i + 1}`).html(multi[i].cantidad);

          if ($(`.tapa${i + 1}`).html() == 50000)
            $(`.unidades${i + 1}`).html('0');
          else $(`.unidades${i + 1}`).html(multi[i].cantidad);

          if ($(`.etiqueta${i + 1}`).html() == 50000)
            $(`.unidades${i + 1}`).html('0');
          else $(`.unidades${i + 1}`).html(multi[i].cantidad);

          if ($(`#envaseSobrante${i + 1}`).html() == 50000)
            $(`.unidadesEnvase${i + 1}`).html(0);
          else $(`.unidadesEnvase${i + 1}`).html(multi[i].cantidad);

          if ($(`#tapaSobrante${i + 1}`).html() == 50000)
            $(`.unidadesTapa${i + 1}`).html('0');
          else $(`.unidadesTapa${i + 1}`).html(multi[i].cantidad);

          if ($(`#etiquetaSobrante${i + 1}`).html() == 50000)
            $(`.unidadesEtiqueta${i + 1}`).html('0');
          else $(`.unidadesEtiqueta${i + 1}`).html(multi[i].cantidad);

          if ($(`#etiquetaSobrante${i + 1}`).html() == 50000)
            $(`.unidadesEmpaque${i + 1}`).html('0');
          else $(`.unidadesEmpaque${i + 1}`).html(multi[i].cantidad);

          if ($(`#etiquetaSobrante${i + 1}`).html() == 50000)
            $(`.unidadesOtros${i + 1}`).html('0');
          else $(`.unidadesOtros${i + 1}`).html(multi[i].cantidad);

          conciliacionLote =
            ((utilizada * presentacion * densidad) / tamanioLote / 1000) * 100;
          $(`.conciliacionLote`).html(`<b>${conciliacionLote.toFixed(2)}%</b>`);
          material_envase_sobrante();
        }
      });
    }
  } else {
    $.ajax({
      url: '../../html/php/envase.php',
      type: 'POST',
      data: { referencia: referencia },
    }).done((data, status, xhr) => {
      if (data != '') {
        info = JSON.parse(data);
        $(`.envase1`).html(info[0].id_envase);
        $(`.descripcion_envase1`).html(info[0].envase);
        $(`.tapa1`).html(info[0].id_tapa);
        $(`.descripcion_tapa1`).html(info[0].tapa);
        $(`.etiqueta1`).html(info[0].id_etiqueta);
        $(`.descripcion_etiqueta1`).html(info[0].etiqueta);
        $(`.unidadesEnvase1`).html(cantidad_lote);
        $(`.unidadesTapa1`).html(cantidad_lote);
        $(`.unidadesEtiqueta1`).html(cantidad_lote);
        /*  conciliacionLote = (((utilizada * presentacion * densidad) / tamanioLote) / 1000) * 100
                 $(`.conciliacionLote`).html(`<b>${conciliacionLote.toFixed(2)}%</b>`) */
        material_envase_sobrante();
      }
    });
  }
}

material_envase_sobrante = async () => {
  let info = await searchData(`/api/loadRealizoMaterialSobrante/${idBatch}`);

  if (info.length === 0) return false;

  if (multi.length != '0') {
    for (let i = 0; i < multi.length; i++) {
      envase = $(`#envaseSobrante${i + 1}`).html();
      tapa = $(`#tapaSobrante${i + 1}`).html();
      etiqueta = $(`#etiquetaSobrante${i + 1}`).html();
      empaque = $(`.empaque${i + 1}`).html();
      otros = $(`.otros${i + 1}`).html();

      for (let j = 0; j < info.length; j++) {
        if (multi[i].referencia == info[j]['ref_producto']) {
          if (info[j]['modulo'] == 5) {
            if (envase == info[j]['ref_material']) {
              if (info[j]['ref_material'] == 50000) {
                $(`#usadaEnvase${i + 1}`).html('0');
                $(`#averiasEnvase${i + 1}`).html('0');
                $(`#sobranteEnvase${i + 1}`).html('0');
              } else {
                $(`#usadaEnvase${i + 1}`).html(info[j].envasada);
                $(`#averiasEnvase${i + 1}`).html(info[j].averias);
                $(`#sobranteEnvase${i + 1}`).html(info[j].sobrante);
              }
            }
            if (tapa == info[j]['ref_material']) {
              if (info[j]['ref_material'] == 50000) {
                $(`#usadaTapa${i + 1}`).html('0');
                $(`#averiasTapa${i + 1}`).html('0');
                $(`#sobranteTapa${i + 1}`).html('0');
              } else {
                $(`#usadaTapa${i + 1}`).html(info[j + 1].envasada);
                $(`#averiasTapa${i + 1}`).html(info[j + 1].averias);
                $(`#sobranteTapa${i + 1}`).html(info[j + 1].sobrante);
              }
            }
            if (etiqueta == info[j]['ref_material']) {
              if (info[j]['ref_material'] == 50000) {
                $(`#usadaEtiqueta${i + 1}`).html('0');
                $(`#averiasEtiqueta${i + 1}`).html('0');
                $(`#sobranteEtiqueta${i + 1}`).html('0');
              } else {
                $(`#usadaEtiqueta${i + 1}`).html(info[j + 2].envasada);
                $(`#averiasEtiqueta${i + 1}`).html(info[j + 2].averias);
                $(`#sobranteEtiqueta${i + 1}`).html(info[j + 2].sobrante);
              }
            }
          } else if (info[j]['modulo'] == 6) {
            /* if (empaque == info[j]["ref_material"]) { */
            if (empaque == 50000) {
              $(`#utilizada_empaque${i + 1}`).html('0');
              $(`#averias_empaque${i + 1}`).html('0');
              $(`#sobrante_empaque${i + 1}`).html('0');
            } else {
              $(`#utilizada_empaque${i + 1}`).html(info[j].envasada);
              $(`#averias_empaque${i + 1}`).html(info[j].averias);
              $(`#sobrante_empaque${i + 1}`).html(info[j].sobrante);
              $(`#utilizada_otros${i + 1}`).html(info[j].envasada);
            }

            /* } */
            /* if (otros == info[j]["ref_material"]) { */
            if (otros == 50000) {
              $(`#utilizada_otros${i + 1}`).html('0');
              $(`#averias_otros${i + 1}`).html('0');
              $(`#sobrante_otros${i + 1}`).html('0');
            } else {
              $(`#utilizada_otros${i + 1}`).html(info[j].envasada);
              $(`#averias_otros${i + 1}`).html(info[j].averias);
              $(`#sobrante_otros${i + 1}`).html(info[j].sobrante);
            }
            /* } */
          }

          if (info[j].modulo == 5) utilizada = utilizada + info[j].envasada;
        }
      }
    }

    for (i = 0; i < multi.length; i++) {
      utilizada = $(`#utilizada_empaque${i + 1}`).html();
      programada = multi[i].cantidad;
      rendimiento = (utilizada / programada) * 100;  
      document.getElementById(`conciliacionRendimiento${i + 1}`).setAttribute('value', `${rendimiento.toFixed(2)}%`);
    }
  } else {
    for (let i = 0; i < info.length; i++) {
      if (info[i].modulo == 5) {
        $(`#usadaEnvase1`).html(info[i].envasada);
        $(`#averiasEnvase1`).html(info[i].averias);
        $(`#sobranteEnvase1`).html(info[i].sobrante);

        $(`#usadaTapa1`).html(info[i].envasada);
        $(`#averiasTapa1`).html(info[i].averias);
        $(`#sobranteTapa1`).html(info[i].sobrante);

        $(`#usadaEtiqueta1`).html(info[i].envasada);
        $(`#averiasEtiqueta1`).html(info[i].averias);
        $(`#sobranteEtiqueta1`).html(info[i].sobrante);
      }
      if (info[i].modulo == 6) {
        $(`#utilizada_empaque1`).html(info[i].envasada);
        $(`#averias_empaque1`).html(info[i].averias);
        $(`#sobrante_empaque1`).html(info[i].sobrante);

        $(`#utilizada_otros1`).html(info[i].envasada);
        $(`#averias_otros1`).html(info[i].averias);
        $(`#sobrante_otros1`).html(info[i].sobrante);
      }
      //utilizada = info[0].envasada;
      unidadesEmpaque = $('#unidadesEmpaque1').html();
      utilizadaEmpaque = $('#utilizada_empaque1').html();
      rendimiento = (unidadesEmpaque / utilizadaEmpaque) * 100;
      // $('#conciliacionRendimiento1').val(`${rendimiento.toFixed(2)}%`);
      document.getElementById('conciliacionRendimiento1').setAttribute('value', `${rendimiento.toFixed(2)}%`);
    }
  }
  // $.ajax({
  //   type: 'POST',
  //   url: '../../html/php/envasado.php',
  //   data: { operacion: 7, idBatch },

  //   success: function (response) {
  //     let info = JSON.parse(response);
  //     if (info.length === 0) return false;

  //     if (multi.length != '0') {
  //       for (let i = 0; i < multi.length; i++) {
  //         envase = $(`#envaseSobrante${i + 1}`).html();
  //         tapa = $(`#tapaSobrante${i + 1}`).html();
  //         etiqueta = $(`#etiquetaSobrante${i + 1}`).html();
  //         empaque = $(`.empaque${i + 1}`).html();
  //         otros = $(`.otros${i + 1}`).html();

  //         for (let j = 0; j < info.length; j++) {
  //           if (multi[i].referencia == info[j]['ref_producto']) {
  //             if (info[j]['modulo'] == 5) {
  //               if (envase == info[j]['ref_material']) {
  //                 if (info[j]['ref_material'] == 50000) {
  //                   $(`#usadaEnvase${i + 1}`).html('0');
  //                   $(`#averiasEnvase${i + 1}`).html('0');
  //                   $(`#sobranteEnvase${i + 1}`).html('0');
  //                 } else {
  //                   $(`#usadaEnvase${i + 1}`).html(info[j].envasada);
  //                   $(`#averiasEnvase${i + 1}`).html(info[j].averias);
  //                   $(`#sobranteEnvase${i + 1}`).html(info[j].sobrante);
  //                 }
  //               }
  //               if (tapa == info[j]['ref_material']) {
  //                 if (info[j]['ref_material'] == 50000) {
  //                   $(`#usadaTapa${i + 1}`).html('0');
  //                   $(`#averiasTapa${i + 1}`).html('0');
  //                   $(`#sobranteTapa${i + 1}`).html('0');
  //                 } else {
  //                   $(`#usadaTapa${i + 1}`).html(info[j + 1].envasada);
  //                   $(`#averiasTapa${i + 1}`).html(info[j + 1].averias);
  //                   $(`#sobranteTapa${i + 1}`).html(info[j + 1].sobrante);
  //                 }
  //               }
  //               if (etiqueta == info[j]['ref_material']) {
  //                 if (info[j]['ref_material'] == 50000) {
  //                   $(`#usadaEtiqueta${i + 1}`).html('0');
  //                   $(`#averiasEtiqueta${i + 1}`).html('0');
  //                   $(`#sobranteEtiqueta${i + 1}`).html('0');
  //                 } else {
  //                   $(`#usadaEtiqueta${i + 1}`).html(info[j + 2].envasada);
  //                   $(`#averiasEtiqueta${i + 1}`).html(info[j + 2].averias);
  //                   $(`#sobranteEtiqueta${i + 1}`).html(info[j + 2].sobrante);
  //                 }
  //               }
  //             } else if (info[j]['modulo'] == 6) {
  //               /* if (empaque == info[j]["ref_material"]) { */
  //               if (empaque == 50000) {
  //                 $(`#utilizada_empaque${i + 1}`).html('0');
  //                 $(`#averias_empaque${i + 1}`).html('0');
  //                 $(`#sobrante_empaque${i + 1}`).html('0');
  //               } else {
  //                 $(`#utilizada_empaque${i + 1}`).html(info[j].envasada);
  //                 $(`#averias_empaque${i + 1}`).html(info[j].averias);
  //                 $(`#sobrante_empaque${i + 1}`).html(info[j].sobrante);
  //                 $(`#utilizada_otros${i + 1}`).html(info[j].envasada);
  //               }

  //               /* } */
  //               /* if (otros == info[j]["ref_material"]) { */
  //               if (otros == 50000) {
  //                 $(`#utilizada_otros${i + 1}`).html('0');
  //                 $(`#averias_otros${i + 1}`).html('0');
  //                 $(`#sobrante_otros${i + 1}`).html('0');
  //               } else {
  //                 $(`#utilizada_otros${i + 1}`).html(info[j].envasada);
  //                 $(`#averias_otros${i + 1}`).html(info[j].averias);
  //                 $(`#sobrante_otros${i + 1}`).html(info[j].sobrante);
  //               }
  //               /* } */
  //             }

  //             if (info[j].modulo == 5) utilizada = utilizada + info[j].envasada;
  //           }
  //         }
  //       }

  //       for (i = 0; i < multi.length; i++) {
  //         utilizada = $(`#utilizada_empaque${i + 1}`).html();
  //         programada = multi[i].cantidad;
  //         rendimiento = (utilizada / programada) * 100;
  //         $(`#conciliacionRendimiento${i + 1}`).val(
  //           `${rendimiento.toFixed(2)}%`
  //         );
  //       }
  //     } else {
  //       for (let i = 0; i < info.length; i++) {
  //         if (info[i].modulo == 5) {
  //           $(`#usadaEnvase1`).html(info[i].envasada);
  //           $(`#averiasEnvase1`).html(info[i].averias);
  //           $(`#sobranteEnvase1`).html(info[i].sobrante);

  //           $(`#usadaTapa1`).html(info[i].envasada);
  //           $(`#averiasTapa1`).html(info[i].averias);
  //           $(`#sobranteTapa1`).html(info[i].sobrante);

  //           $(`#usadaEtiqueta1`).html(info[i].envasada);
  //           $(`#averiasEtiqueta1`).html(info[i].averias);
  //           $(`#sobranteEtiqueta1`).html(info[i].sobrante);
  //         }
  //         if (info[i].modulo == 6) {
  //           $(`#utilizada_empaque1`).html(info[i].envasada);
  //           $(`#averias_empaque1`).html(info[i].averias);
  //           $(`#sobrante_empaque1`).html(info[i].sobrante);

  //           $(`#utilizada_otros1`).html(info[i].envasada);
  //           $(`#averias_otros1`).html(info[i].averias);
  //           $(`#sobrante_otros1`).html(info[i].sobrante);
  //         }
  //         //utilizada = info[0].envasada;
  //         unidadesEmpaque = $('#unidadesEmpaque1').html();
  //         utilizadaEmpaque = $('#utilizada_empaque1').html();
  //         rendimiento = (unidadesEmpaque / utilizadaEmpaque) * 100;
  //         $('#conciliacionRendimiento1').val(`${rendimiento.toFixed(2)}%`);
  //       }
  //     }
  //   },
  // });
};

/* Funcion para traer datos de multi en conciliacion rendimiento */

muestras_acondicionamiento = async (multi) => {
  // $.ajax({
  //   type: 'POST',
  //   url: '../../html/php/muestras.php',
  //   data: { operacion: 7, idBatch },
  //   success: function (response) {
  //     data = JSON.parse(response);

  //     /* referencia simple */
  //     if (multi == undefined) {
  //       multi = [];
  //       obj = {};
  //       obj.referencia = data[0].referencia;
  //       multi.push(obj);
  //     }

  //     for (let j = 0; j < multi.length; j++) {
  //       let c = 1;
  //       for (let i = 0; i < data.length; i++) {
  //         if (multi[j].referencia == data[i].referencia) {
  //           data.map(function (dato) {
  //             if (dato.apariencia_etiquetas == 1)
  //               dato.apariencia_etiquetas = 'Cumple';
  //             if (dato.apariencia_etiquetas == 2)
  //               dato.apariencia_etiquetas = 'No Cumple';
  //             if (dato.apariencia_etiquetas == 3)
  //               dato.apariencia_etiquetas = 'No aplica';

  //             if (dato.apariencia_termoencogible == 1)
  //               dato.apariencia_termoencogible = 'Cumple';
  //             if (dato.apariencia_termoencogible == 2)
  //               dato.apariencia_termoencogible = 'No Cumple';
  //             if (dato.apariencia_termoencogible == 3)
  //               dato.apariencia_termoencogible = 'No Aplica';

  //             if (dato.cumplimiento_empaque == 1)
  //               dato.cumplimiento_empaque = 'Cumple';
  //             if (dato.cumplimiento_empaque == 2)
  //               dato.cumplimiento_empaque = 'No Cumple';
  //             if (dato.cumplimiento_empaque == 3)
  //               dato.cumplimiento_empaque = 'No Aplica';

  //             if (dato.posicion_producto == 1)
  //               dato.posicion_producto = 'Cumple';
  //             if (dato.posicion_producto == 2)
  //               dato.posicion_producto = 'No Cumple';
  //             if (dato.posicion_producto == 3)
  //               dato.posicion_producto = 'No Aplica';

  //             if (dato.rotulo_caja == 1) dato.rotulo_caja = 'Cumple';
  //             if (dato.rotulo_caja == 2) dato.rotulo_caja = 'No Cumple';
  //             if (dato.rotulo_caja == 3) dato.rotulo_caja = 'No Aplica';
  //             return dato;
  //           });

  //           $(`#muestrasAcondicionamiento${j + 1}`).append(
  //             `<tr>
  //                       <td class="centrado">${c}</td>
  //                       <td class="centrado">${data[i].apariencia_etiquetas}</td>
  //                       <td class="centrado">${data[i].apariencia_termoencogible}</td>
  //                       <td class="centrado">${data[i].cumplimiento_empaque}</td>
  //                       <td class="centrado">${data[i].posicion_producto}</td>
  //                       <td class="centrado">${data[i].rotulo_caja}</td>
  //                     </tr>`
  //           );
  //           c = c + 1;
  //         }
  //       }
  //     }
  //   },
  // });
  
  let resp = await searchData(`/api/muestras-acondicionamiento/${idBatch}`);

  /* referencia simple */
  if (multi == undefined) {
    multi = [];
    obj = {};
    obj.referencia = resp[0].referencia;
    multi.push(obj);
  }

  for (let j = 0; j < multi.length; j++) {
    let c = 1;
    for (let i = 0; i < resp.length; i++) {
      if (multi[j].referencia == resp[i].referencia) {
        resp.map(function (dato) {
          if (dato.apariencia_etiquetas == 1)
            dato.apariencia_etiquetas = 'Cumple';
          if (dato.apariencia_etiquetas == 2)
            dato.apariencia_etiquetas = 'No Cumple';
          if (dato.apariencia_etiquetas == 3)
            dato.apariencia_etiquetas = 'No aplica';

          if (dato.apariencia_termoencogible == 1)
            dato.apariencia_termoencogible = 'Cumple';
          if (dato.apariencia_termoencogible == 2)
            dato.apariencia_termoencogible = 'No Cumple';
          if (dato.apariencia_termoencogible == 3)
            dato.apariencia_termoencogible = 'No Aplica';

          if (dato.cumplimiento_empaque == 1)
            dato.cumplimiento_empaque = 'Cumple';
          if (dato.cumplimiento_empaque == 2)
            dato.cumplimiento_empaque = 'No Cumple';
          if (dato.cumplimiento_empaque == 3)
            dato.cumplimiento_empaque = 'No Aplica';

          if (dato.posicion_producto == 1)
            dato.posicion_producto = 'Cumple';
          if (dato.posicion_producto == 2)
            dato.posicion_producto = 'No Cumple';
          if (dato.posicion_producto == 3)
            dato.posicion_producto = 'No Aplica';

          if (dato.rotulo_caja == 1) dato.rotulo_caja = 'Cumple';
          if (dato.rotulo_caja == 2) dato.rotulo_caja = 'No Cumple';
          if (dato.rotulo_caja == 3) dato.rotulo_caja = 'No Aplica';
          return dato;
        });

        $(`#muestrasAcondicionamiento${j + 1}`).append(
          `<tr>
                        <td class="centrado">${c}</td>
                        <td class="centrado">${resp[i].apariencia_etiquetas}</td>
                        <td class="centrado">${resp[i].apariencia_termoencogible}</td>
                        <td class="centrado">${resp[i].cumplimiento_empaque}</td>
                        <td class="centrado">${resp[i].posicion_producto}</td>
                        <td class="centrado">${resp[i].rotulo_caja}</td>
                      </tr>`
        );
        c = c + 1;
      }
    }
  }
};

entrega_material_acondicionamiento = (multi) => {
  if (multi != undefined) {
    for (let i = 0; i < multi.length; i++) {
      ref = multi[i].referencia;
      $.ajax({
        type: 'POST',
        url: '../../html/php/envase.php',
        data: { referencia: ref },
      }).done((data, status, xhr) => {
        if (data == '') return false;
        var info = JSON.parse(data);
        empaqueEnvasado = Math.round(cantidad_lote / info[0].unidad_empaque);
        unidades = cantidad_lote;
        for (let i = 0; i < multi.length; i++) {
          $(`.empaque${i + 1}`).html(info[0].id_empaque);
          $(`.descripcion_empaque${i + 1}`).html(info[0].empaque);

          $(`.otros${i + 1}`).html(info[0].id_otros);
          $(`.descripcion_otros${i + 1}`).html(info[0].otros);

          if ($(`.empaque${i + 1}`).html() == 50000)
            $(`.unidadesEmpaque${i + 1}`).html('0');
          else $(`.unidadesEmpaque${i + 1}`).html(multi[i].cantidad);

          if ($(`.otros${i + 1}`).html() == 50000)
            $(`.unidadesOtros${i + 1}`).html('0');
          else $(`.unidadesOtros${i + 1}`).html(multi[i].cantidad);
        }
      });
    }
  } else {
    $.ajax({
      type: 'POST',
      url: '../../html/php/envase.php',
      data: { referencia },
    }).done((data, status, xhr) => {
      if (data == '') return false;
      var info = JSON.parse(data);
      empaqueEnvasado = Math.round(cantidad_lote / info[0].unidad_empaque);
      unidades = cantidad_lote;

      $(`.empaque1`).html(info[0].id_empaque);
      $(`.descripcion_empaque1`).html(info[0].empaque);

      $(`.otros1`).html(info[0].id_otros);
      $(`.descripcion_otros1`).html(info[0].otros);

      $(`.unidadesEmpaque1`).html(unidades);
      $(`.unidadesOtros1`).html(unidades);
    });
  }
};

conciliacion = (multi) => {
  $.ajax({
    type: 'POST',
    url: '../../html/php/conciliacion_rendimiento.php',
    data: { operacion: 5, idBatch },

    success: function (response) {
      let info = JSON.parse(response);
      if (info.length === 0) return false;

      if (multi == undefined) {
        multi = [];
        obj = {};
        obj.referencia = info[0].ref_multi;
        multi.push(obj);
      }

      for (let j = 0; j < multi.length; j++) {
        let rendimiento = ((utilizada / cantidad_lote) * 100).toFixed(2) + '%';
        document.getElementById(`conciliacionRendimiento${j + 1}`).setAttribute('value', rendimiento);
        // $(`#conciliacionRendimiento${j + 1}`).val(rendimiento);

        for (let i = 0; i < info.length; i++) {
          if (info[i].modulo == 6) {
            if (idBatch >= 2599) fecha = info[i].fecha_registro;
            else fecha = info[i].fecha_nuevo_registro;

            $(`#f_realizoConciliacion${j + 1}`).prop('src', info[i].urlfirma); 
            $(`#user_realizoConciliacion${j + 1}`).html(
              `Realizó: <b>${info[i].nombre}</b>`
            );
            $(`#fecha${info[i].modulo}`).html(info[i].fecha_nuevo_registro);
            $(`#fecha${info[i].modulo}Conciliacion${j + 1}`).html(
              info[i].fecha_nuevo_registro
            );
          }
        }
      }
    },
  });
};

const despachos = () => {
  $.ajax({
    type: 'POST',
    url: '../../html/php/servicios/c_batch_pdf.php',
    data: { operacion: 13, idBatch },
    success: function (response) {
      info = JSON.parse(response);
      if (info.length > 0) {
        if (idBatch >= 2599) fecha = info[i].fecha_registro;
        else fecha = info[i].fecha_nuevo_registro;
        $('#fecha7').html(info[0].fecha_nuevo_registro);
        for (let i = 0; i < info.length; i++) {
          $(`#user_entrego`).html(
            `Realizó: <b>${info[i].nombre} ${info[i].apellido}</b>`
          );
          $(`#f_entrego`).prop('src', info[i].urlfirma);
        }
      } else {
        $(`#f_entrego`).hide();
        $(`#user_entrego`).html(`Verificó: <b>Sin firmar</b>`);
      }
    },
  });
};

observacionesAprobacion = () => {
  $.ajax({
    type: 'POST',
    url: '../../html/php/servicios/c_batch_pdf.php',
    data: { operacion: 12, idBatch },
    success: function (response) {
      if (response == '[]') return false;
      data = JSON.parse(response);
      $('#observacionesAprobacion').html(data[0].observaciones);
    },
  });
};

analisisMicrobiologico = () => {
  $.ajax({
    type: 'POST',
    url: '../../html/php/servicios/c_batch_pdf.php',
    data: { operacion: 14, idBatch },
    success: function (response) {
      if (response == '[]') {
        $(`#f_realizoMicro`).hide();
        $(`#f_verificoMicro1`).hide();

        $(`#user_realizoMicro`).html(`Realizó: <b>Sin Firmar</b>`);
        $(`#user_verificoMicro1`).html(`Verificó: <b>Sin Firmar</b>`);
        return false;
      }

      $('.chkAprobado').prop('disabled', true);
      $('.chkRechazado').prop('disabled', true);

      data = JSON.parse(response);
      let result1, result2, result3;
      data[0].pseudomona == 1
        ? (result1 = 'Ausencia')
        : (data[0].pseudomona = 2
            ? (result1 = 'Presencia')
            : (result1 = 'No Aplica'));

      data[0].escherichia == 1
        ? (result2 = 'Ausencia')
        : (data[0].escherichia = 2
            ? (result2 = 'Presencia')
            : (result2 = 'No Aplica'));

      data[0].staphylococcus == 1
        ? (result3 = 'Ausencia')
        : (data[0].staphylococcus = 2
            ? (result3 = 'Presencia')
            : (result3 = 'No Aplica'));

      $('#mesofilos').html(data[0].mesofilos);
      $('#pseudomona').html(result1);
      $('#escherichia').html(result2);
      $('#staphylococcus').html(result3);

      /* $("#fsiembra").val(data[0].fecha_siembra).css("text-align", "center"); */
      /* $("#fresultados")
                .val(data[0].fecha_resultados)
                .css("text-align", "center"); */

      if (data[0].realizo) {
        $(`#f_realizoMicro`).prop('src', data[0].realizo);
        $(`#user_realizoMicro`).html(
          `Realizó: <b>${data[0].nombre_realizo}</b>`
        );
      }

      if (data[0].verifico) {
        $(`#f_verificoMicro1`).prop('src', data[0].verifico);
        $(`#blank_rea8`).hide();
        $(`#blank_ver8`).hide();
        $(`#user_verificoMicro1`).html(
          `Verificó: <b>${data[0].nombre_verifico}</b>`
        );
      } else {
        $(`#f_verificoMicro1`).hide();
        $(`#blank_ver`).show();
        $(`#user_verificoMicro1`).html(`Verificó: <b>Sin firmar</b>`);
      }
      $('.chkAprobado').prop('checked', true);
      /* if (data[0].observaciones == "") $(".chkAprobado").prop("checked", true);
                      else $(".chkAprobado").prop("checked", true); */
    },
  });
};

const liberacion_lote = () => {
  $.post(
    '../../html/php/servicios/c_batch_pdf.php',
    { idBatch, operacion: 16 },
    function (data, textStatus, jqXHR) {
      if (data == 'false') {
        $(`#f_realizoPRO`).hide();
        $(`#f_realizoCA`).hide();
        $(`#f_realizoTEC`).hide();
        return false;
      }

      info = JSON.parse(data);
      let produccion = info['dirProd'];
      let calidad = info['dirCa'];
      let tecnica = info['dirTec'];

      if (idBatch >= 2599) fecha = info[i].fecha_registro;
      else fecha = info.fecha_nuevo_registro;

      $('.fechaHoraLiberacion').html(
        `fecha y Hora: <b>${info['fecha_nuevo_registro']}</b>`
      );

      info['aprobacion'] == 0
        ? $('#LiberacionNo').html('<b>X</b>')
        : $('#LiberacionSi').html('<b>X</b>');

      info['observaciones'] == ''
        ? $('#observacioneslote').html('<b>X</b>')
        : $('#observacioneslote').html(info['observaciones']);

      if (produccion != null) {
        $(`#dirNameProd`).html(`<b>${info['dirProd']}</b>`);
        $(`#f_realizoPRO`).prop('src', info['produccion']);
        $(`#blank_prod`).hide();
      } else {
        $(`#blank_prod`).show();
        $(`#f_realizoPRO`).hide();
      }

      if (calidad != null) {
        $(`#dirNameCa`).html(`<b>${info['dirCa']}</b>`);
        $(`#f_realizoCA`).prop('src', info['calidad']);
        $(`#blank_cal`).hide();
      } else {
        $(`#blank_cal`).show();
        $(`#f_realizoCA`).hide();
      }

      if (tecnica != null) {
        $(`#dirNameTec`).html(`<b>${info['dirTec']}</b>`);
        $(`#f_realizoTEC`).prop('src', info['tecnica']);
        $(`#blank_tec`).hide();
      } else {
        $(`#blank_tec`).show();
        $(`#f_realizoTEC`).hide();
      }

      $(`#f_verificoMicro`).hide();
      $(`#blank_ver`).show();
      $(`#user_verificoMicro`).html('Verificó: <b>Sin firmar</b>');
    }
  );
};

$(document).ready(function () {
  cargar_Alertas();

  multipresentacion().then((data) => {
    multi = JSON.parse(data);
    if (multi.length != 0) {
      cargarMultipresentacion(multi);
      informacion_producto().then(() => {
        entrega_material_envase(multi);
      }); 
      identificarDensidad(multi);
      muestras_envasado(multi);
      informacion_producto().then(() => {
        entrega_material_acondicionamiento(multi);
      });
      muestras_acondicionamiento(multi);
      conciliacion(multi);
    } else {
      informacion_producto().then(() => {
        entrega_material_envase();
      }); 
      identificarDensidad();
      informacion_producto().then(() => {
        entrega_material_acondicionamiento();
      });
      muestras_envasado();
      muestras_acondicionamiento();
      conciliacion();
    }
  });

  async function procesarInformacion() {
    try {
      const data = await informacion_producto();
      info_General(data);
      parametros_Control();
      lote_anterior(data);
      condiciones_medio();
      firmas();
      equipos();
      especificaciones_producto();
      control_proceso();
      ajustes();
      despachos();
      analisisMicrobiologico();
      liberacion_lote();
      ImprimirEtiquetasInvima();
      cargarObservaciones();
      cargar_version_PDF(data);
    
      let op = localStorage.getItem('opLiberacion');
      if (op) {
        await new Promise(resolve => setTimeout(resolve, 5000));
    
        downloadPdfBatch();
      }
    } catch (error) {
      console.error('Error al procesar la información:', error);
    }
  }

  procesarInformacion();
});
