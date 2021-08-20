let idBatch;
let referencia;
let cantidad;
let presentacion;
let densidad;
let tamanioLote;
let infoBatch;
let multi;

$(document).ready(function () {
  var pathname = window.location.pathname;
  idList = pathname.split("/");
  idBatch = idList[2];
  referencia = idList[3];

  $.ajax({
    type: "POST",
    url: "../../html/php/busqueda_multipresentacion.php",
    data: { idBatch },

    success: function (response) {
      data = JSON.parse(response);
      multi = JSON.stringify(data);
      //sessionStorage.setItem("multi", JSON.stringify(data));
    },
  });
});

/* bloquear inputs */
$("input").prop("readonly", true);

/* Imprimir pdf */

$(document).on("click", ".link-imprimir", function (e) {
  e.preventDefault();
  window.print();
  return false;
});

/* cerrar ventana */
$(document).on("click", ".link-cerrar", function (e) {
  e.preventDefault();
  window.close();
});

/* Mostrar multipresentacion */

$("#multi-envasado2").hide();
$("#multi-envasado3").hide();

$("#multi-acondicionamiento2").hide();
$("#multi-acondicionamiento3").hide();

$("#multi-despachos2").hide();
$("#multi-despachos3").hide();

/* Cargar data */

cargar_Alertas = () => {
  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    (data = { operacion: 7 }),
    function (data, textStatus, jqXHR) {
      info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        data = Object.values(JSON.parse(info[i].descripcion));

        $(`#title${info[i].ubicacion}`).html("<b>" + data[0] + "</b>");
        if (`${info[i].ubicacion}` == 3) $(".desin_titulo").html(data[0]);

        for (let j = 0; j < data[1].length; j++) {
          $(`#vinetas${info[i].ubicacion}`).append(`<li>${data[1][j]}</li>`);
          if (`${info[i].ubicacion}` == 3) {
            $(".desinfectante").append(`<li>${data[1][j]}</li>`);
          }
        }
      }
    }
  );
};

/* Multipresentacion */
const multipresentacion = () => {
  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    { idBatch, operacion: 18 },
    function (data, textStatus, jqXHR) {
      if (data == 0) {
        $(`#subtitle_envasado1`).hide();
        $(`#subtitle_acond1`).hide();
        info_General();
      } else {
        multi = JSON.parse(data);
        if (multi.length == 2) {
          $("#multi-envasado2").show();
          $("#multi-acondicionamiento2").show();
          $("#multi-despachos2").show();
        } else if (multi.length == 3) {
          $("#multi-envasado3").show();
          $("#multi-acondicionamiento3").show();
          $("#multi-despachos3").show();
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
        entrega_material_envase();
        material_envase_sobrante();
        obtenerMuestras();
        identificarDensidad();
      }
    }
  );
};

function info_General() {
  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    (data = { operacion: 2, idBatch }),
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
      let info = JSON.parse(data);
      infoBatch = info;
      cantidad_lote = info.unidad_lote;
      presentacion = info.presentacion;
      densidad = info.densidad;
      tamanioLote = info.tamano_lote;
      $(".ref").html(info.referencia);
      $("#nref").html(`<b>${info.nombre_referencia}</b>`);
      $("#marca").html(`<b>${info.marca}</b>`);
      $("#propietario").html(`<b>${info.propietario}</b>`);
      $("#notificacion").html(`<b>${info.notificacion}</b>`);
      $("#presentacion").html(`<b>${info.presentacion}</b>`);
      $(".orden").html(`<b>${info.numero_orden}</b>`);
      $(".lote").html(`<b>${info.numero_lote}</b>`);
      $(".fecha").html(`<b>${info.fecha_creacion}</b>`);
      $("#tamanolt").html(`<b>${info.tamano_lote}</b>`);
      $("#tamanol").html(`<b>${info.tamano_lote}</b>`);
      $("#unidadesLote").html(`<b>${info.unidad_lote}</b>`);
      //$(".unidades1").html(`<b>${info.unidad_lote}</b>`);
      $(".fecha").html(`<b>${info.fecha_creacion}</b>`);
      lote_anterior();
      desinfectante();
      observacionesAprobacion();
      ImprimirEtiquetasInvima();
      if (multi == undefined || multi == 0) {
        identificarDensidad();
        obtenerMuestras();
        entrega_material_envase();
        material_envase_sobrante();
      }
    }
  );
}

parametros_Control = () => {
  let data = { operacion: 3, idBatch };

  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
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
            <th scope="row" class="centrado">${j}</th>
            <td>${info[i].pregunta}</td>
            <td class="centrado">${info[i].solucion == 1 ? "X" : ""}</td>
            <td class="centrado">${info[i].solucion == 0 ? "X" : ""}</td>
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

  lote = linea.concat("0", serie, fecha);
  area_desinfeccion(lote);
};

area_desinfeccion = (lote) => {
  let data = { operacion: 4 };

  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
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
    "../../html/php/servicios/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;

      let info = JSON.parse(data);
      for (let i = 0; i < info.length; i++) {
        $(`#blank_rea${info[i].modulo}`).hide();
        $(`#blank_ver${info[i].modulo}`).hide();

        $(`.desinfectante${info[i].modulo}`).html(info[i].desinfectante);
        $(`.concentracion${info[i].modulo}`).html(
          info[i].concentracion * 100 + "%"
        );
        $(`#fecha${info[i].modulo}`).html(info[i].fecha_registro);
      }

      let fecha = $("#fecha2").html();
      fecha = fecha.substr(0, 10);
      $(".fecha2").html(fecha);
    }
  );
};

const firmas = () => {
  let data = { operacion: 17, idBatch };

  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;

      let info = JSON.parse(data);
      for (let i = 0; i < info.length; i++) {
        if (info[i].realizo != 0) {
          $(`#f_realizo${info[i].modulo}`).prop("src", info[i].realizo);
          $(`#user_realizo${info[i].modulo}`).html(
            `Realizó: <b>${info[i].nombre_realizo}</b>`
          );
        } else if (info[i].realizo == 0) {
          $(`#f_realizo${info[i].modulo}`).prop("hide", true);
          $(`#blank_rea${info[i].modulo}`).show();
          $(`#user_realizo${info[i].modulo}`).html(
            `Realizó:<b> Sin firmar</b>`
          );
        }

        if (info[i].verifico != 0) {
          $(`#f_verifico${info[i].modulo}`).prop("src", info[i].verifico);
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
  if (multi)
    for (let i = 0; i < multi.length; i++)
      for (let j = 0; j < info.length; j++)
        if (multi[i]["referencia"] == info[j]["ref_multi"]) {
          $(`#multi_fecha${i + 1}`).html(info[j]["fecha_registro"]);
          $(`#multi_f_realizo${i + 1}`).prop("src", info[j].realizo);
          $(`#multi_user_realizo${i + 1}`).html(
            `Realizó: <b>${info[j].nombre_realizo}</b>`
          );
          $(`#multi_blank_realizo${i + 1}`).hide();

          /*  $(`#multi_f_realizo${i + 1}`).prop("hide", true);
          $(`#multi_blank_realizo${i + 1}`).show();
          $(`#multi_user_realizo${i + 1}`).html(`Realizó:<b> Sin firmar</b>`); */

          $(`#multi_f_verifico${info[i].modulo}`).prop("src", info[i].verifico);
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
};

function condiciones_medio() {
  let data = { operacion: 6, idBatch };
  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
      let info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        $(`.fecha_medio${info[i].modulo}`).html(info[i].fecha);
        $(`.temperatura${info[i].modulo}`).html(info[i].temperatura + " °C");
        $(`.humedad${info[i].modulo}`).html(info[i].humedad + " %");
      }
    }
  );
}

function equipos() {
  $.get(`/api/equipos/${idBatch}`, function (data, textStatus, jqXHR) {
    if (data.length == 0) return false;
    for (i = 0; i < data.length; i++) {
      if (data[i].tipo === "agitador") {
        $("#agitador").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "marmita") {
        $("#marmita").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "envasadora") {
        $(".envasadora").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "loteadora") {
        $(".loteadora").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "banda") {
        $("#banda").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "etiquetadora") {
        $("#etiquetadora").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "tunel") {
        $("#tunel").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "incubadora") {
        $("#incubadora").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "autoclave") {
        $("#autoclave").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "cabina") {
        $("#cabina").val(data[i].descripcion);
        continue;
      }
    }
  });
}

function especificaciones_producto() {
  /* referencia = $("#ref").html(); */
  $.ajax({
    url: `/api/productsDetails/${referencia}`,
    type: "GET",
  }).done((data, status, xhr) => {
    $(".espec_color").html(data.color);
    $(".espec_olor").html(data.olor);
    $(".espec_apariencia").html(data.apariencia);
    $(".espec_ph").html(
      `${data.limite_inferior_ph} a ${data.limite_superior_ph}`
    );
    $(".espec_viscosidad").html(
      `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`
    );
    $(".espec_densidad").html(
      `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`
    );
    $(".espec_untuosidad").html(data.untuosidad);
    $(".espec_poder_espumoso").html(data.poder_espumoso);
    $(".espec_grado_alcohol").html(
      `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`
    );

    $("#in_ph").attr("min", data.limite_inferior_ph);
    $("#in_ph").attr("max", data.limite_superior_ph);
    $("#in_densidad").attr("min", data.limite_inferior_densidad_gravedad);
    $("#in_densidad").attr("max", data.limite_superior_densidad_gravedad);
    $("#in_grado_alcohol").attr("min", data.limite_inferior_grado_alcohol);
    $("#in_grado_alcohol").attr("max", data.limite_superior_grado_alcohol);
    $("#in_viscocidad").attr("min", data.limite_inferior_viscosidad);
    $("#in_viscocidad").attr("max", data.limite_superior_viscosidad);

    $("#espec1").html(data.mesofilos);
    $("#espec2").html(data.pseudomona);
    $("#espec3").html(data.escherichia);
    $("#espec4").html(data.staphylococcus);
  });
}

function control_proceso() {
  $.get(`/api/controlproceso/${idBatch}`, function (info, textStatus, jqXHR) {
    if (info == "false") return false;
    //info = data;
    for (let i = 0; i < info.length; i++) {
      $(`.color${info[i].modulo}`).html(
        info[i].color == 1
          ? "Cumple"
          : info[i].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.olor${info[i].modulo}`).html(
        info[i].olor == 1
          ? "Cumple"
          : info[i].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.apariencia${info[i].modulo}`).html(
        info[i].apariencia == 1
          ? "Cumple"
          : info[i].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.ph${info[i].modulo}`).html(info[i].ph);
      $(`.viscosidad${info[i].modulo}`).html(info[i].viscosidad);
      $(`.densidad${info[i].modulo}`).html(info[i].densidad);
      $(`.untuosidad${info[i].modulo}`).html(
        info[i].untuosidad == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.espumoso${info[i].modulo}`).html(
        info[i].espumoso == 1
          ? "Cumple"
          : info[i].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.alcohol${info[i].modulo}`).html(
        info[i].alcohol == 1
          ? "Cumple"
          : info[i].color == 2
          ? "No Cumple"
          : "No aplica"
      );
    }
  });
}

ajustes = () => {
  $.ajax({
    url: "../../html/php/ajustes.php",
    type: "POST",
    data: { batch: idBatch },
  }).done((data, status, xhr) => {
    info = JSON.parse(data);
    $(`#No3`).val("X");
    $(`#No4`).val("X");
    $(`#No9`).val("X");

    for (i = 0; i < info.length; i++) {
      $(`#Si${info[i].modulo}`).val("X");
      $(`#No${info[i].modulo}`).val("");
      $(`#materiaPrimaAjustes${info[i].modulo}`).val(info[i].materia_prima);
      $(`#procedimientoAjustes${info[i].modulo}`).val(info[i].procedimiento);
    }
  });
};

function entrega_material_envase() {
  if (multi != "0") {
    for (let i = 0; i < multi.length; i++) {
      ref = multi[i].referencia;
      $.ajax({
        url: "../../html/php/envase.php",
        type: "POST",
        data: { referencia: ref },
      }).done((data, status, xhr) => {
        if (data != "") {
          info = JSON.parse(data);
          $(`.envase${i + 1}`).html(info[0].id_envase);
          $(`.descripcion_envase${i + 1}`).html(info[0].envase);
          $(`.tapa${i + 1}`).html(info[0].id_tapa);
          $(`.descripcion_tapa${i + 1}`).html(info[0].tapa);
          $(`.etiqueta${i + 1}`).html(info[0].id_etiqueta);
          $(`.descripcion_etiqueta${i + 1}`).html(info[0].etiqueta);
          $(`.unidades${i + 1}`).html(multi[i].cantidad);
        }
      });
    }
  } else {
    $.ajax({
      url: "../../html/php/envase.php",
      type: "POST",
      data: { referencia: referencia },
    }).done((data, status, xhr) => {
      if (data != "") {
        info = JSON.parse(data);
        $(`.envase1`).html(info[0].id_envase);
        $(`.descripcion_envase1`).html(info[0].envase);
        $(`.tapa1`).html(info[0].id_tapa);
        $(`.descripcion_tapa1`).html(info[0].tapa);
        $(`.etiqueta1`).html(info[0].id_etiqueta);
        $(`.descripcion_etiqueta1`).html(info[0].etiqueta);
        $(`.unidades1`).html(cantidad_lote);
      }
    });
  }
}

/* Calcular peso minimo, maximo y promedio */

identificarDensidad = () => {
  let densidadAprobada = 0;
  $.ajax({
    type: "POST",
    url: "../../html/php/controlProceso.php",
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
  if ((multi = !"0")) {
    for (let i = 0; i < multi.length; i++) {
      //presentacion = $("#presentacion").html();
      //presentacion = getNumbersInString(presentacion);
      presentacion = multi[i]["presentacion_comercial"];
      let peso_min = presentacion * densidadAprobada;
      let peso_max = peso_min * (1 + 0.03);
      let prom = (parseInt(peso_min) + peso_max) / 2;

      $(`.minimo${i + 1}`).val(peso_min.toFixed(2));
      $(`.maximo${i + 1}`).val(peso_max.toFixed(2));
      $(`.medio${i + 1}`).val(prom.toFixed(2));
    }
  } else {
    presentacion = $("#presentacion").html();
    presentacion = getNumbersInString(presentacion);

    let peso_min = presentacion * densidadAprobada;
    let peso_max = peso_min * (1 + 0.03);
    let prom = (parseInt(peso_min) + peso_max) / 2;

    $(`.minimo1`).val(peso_min.toFixed(2));
    $(`.maximo1`).val(peso_max.toFixed(2));
    $(`.medio1`).val(prom.toFixed(2));
  }
}

function getNumbersInString(string) {
  var tmp = string.split("");
  var map = tmp.map(function (current) {
    if (!isNaN(parseInt(current))) {
      return current;
    }
  });

  var numbers = map.filter(function (value) {
    return value != undefined;
  });

  return numbers.join("");
}

/* Obtener muestras */

const obtenerMuestras = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/muestras.php",
    data: { operacion: 6, idBatch },

    success: function (response) {
      if (response == 3) return false;
      let promedio = 0;
      let cont = 0;
      let sum = 0;
      let info = JSON.parse(response);

      if (multi) {
        for (let i = 0; i < multi.length; i++) {
          sum = 0;
          promedio = 0;
          cont = 0;
          for (let j = 0; j < info.length; j++) {
            if (multi[i]["referencia"] == info[j]["referencia"]) {
              cont = cont + 1;
              $(`#muestrasEnvasado${i + 1}`).append(
                `<td class="centrado">${info[j]["muestra"]}</td>`
              );
              sum = sum + info[j]["muestra"];
              promedio = (sum / cont).toFixed(2);
              $(`#promedioMuestras${i + 1}`).val(promedio);
              $(`#cantidadMuestras${i + 1}`).val(cont);
            }
          }
        }
      } else {
        for (let j = 0; j < info.length; j++) {
          cont = cont + 1;
          $(`#muestrasEnvasado1`).append(
            `<td class="centrado">${info[j]["muestra"]}</td>`
          );
          sum = sum + info[j]["muestra"];
          promedio = (sum / cont).toFixed(2);
        }
        $(`#promedioMuestras1`).val(promedio);
        $(`#cantidadMuestras1`).val(cont);
      }
    },
  });
};

material_envase_sobrante = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/envasado.php",
    data: { operacion: 7, idBatch },

    success: function (response) {
      let info = JSON.parse(response);
      if (info.length === 0) return false;

      if (multi != "0") {
        for (let i = 0; i < multi.length; i++) {
          for (let j = 0; j < info.length; j++) {
            if (multi[i].referencia == info[j]["ref_producto"]) {
              $(`#usadaEnvase${i + 1}`).html(info[j].envasada);
              $(`#averiasEnvase${i + 1}`).html(info[j].averias);
              $(`#sobranteEnvase${i + 1}`).html(info[j].sobrante);

              $(`#usadaTapa${i + 1}`).html(info[j].envasada);
              $(`#averiasTapa${i + 1}`).html(info[j].averias);
              $(`#sobranteTapa${i + 1}`).html(info[j].sobrante);

              $(`#usadaEtiqueta${i + 1}`).html(info[j].envasada);
              $(`#averiasEtiqueta${i + 1}`).html(info[j].averias);
              $(`#sobranteEtiqueta${i + 1}`).html(info[j].sobrante);

              $(`#utilizada_empaque${i + 1}`).html(info[j].envasada);
              $(`#averias_empaque${i + 1}`).html(info[j].averias);
              $(`#sobrante_empaque${i + 1}`).html(info[j].sobrante);

              $(`#utilizada_otros${i + 1}`).html(info[j].envasada);
              $(`#averias_otros${i + 1}`).html(info[j].averias);
              $(`#sobrante_otros${i + 1}`).html(info[j].sobrante);
            }
          }
        }
      } else {
        for (let i = 0; i < info.length; i++) {
          if (info[i].modulo == 5) {
            /* let envase = $(`#envase1`).html();
            if (info[i].ref_material == envase) { */
            $(`#usadaEnvase1`).html(info[i].envasada);
            $(`#averiasEnvase1`).html(info[i].averias);
            $(`#sobranteEnvase1`).html(info[i].sobrante);
            /* continue;
            }
            let tapa = $(`#tapa1`).html();
            if (info[i].ref_material == tapa) { */
            $(`#usadaTapa1`).html(info[i].envasada);
            $(`#averiasTapa1`).html(info[i].averias);
            $(`#sobranteTapa1`).html(info[i].sobrante);
            /* continue;
            }
            let etiqueta = $(`#etiqueta1`).html();
            if (info[i].ref_material == etiqueta) { */
            $(`#usadaEtiqueta1`).html(info[i].envasada);
            $(`#averiasEtiqueta1`).html(info[i].averias);
            $(`#sobranteEtiqueta1`).html(info[i].sobrante);
            /* continue;
            }
          }
          if (info[i].modulo == 6) {
            let empaque = $(`#refempaque1`).html();
            empaque = empaque.trim();
            if (info[i].ref_material == empaque) { */
            $(`#utilizada_empaque1`).html(info[i].envasada);
            $(`#averias_empaque1`).html(info[i].averias);
            $(`#sobrante_empaque1`).html(info[i].sobrante);
            /* }
            let otros = $(`#refempaque2`).html();
            if (info[i].ref_material == otros) { */
            $(`#utilizada_otros1`).html(info[i].envasada);
            $(`#averias_otros1`).html(info[i].averias);
            $(`#sobrante_otros1`).html(info[i].sobrante);
            //}
          }
        }
      }
    },
  });
};

muestras_acondicionamiento = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/muestras.php",
    data: { operacion: 7, idBatch },
    success: function (response) {
      data = JSON.parse(response);
      for (i = 0; i < data.length; i++) {
        data.map(function (dato) {
          if (dato.apariencia_etiquetas == 1)
            dato.apariencia_etiquetas = "Cumple";
          if (dato.apariencia_etiquetas == 2)
            dato.apariencia_etiquetas = "No Cumple";
          if (dato.apariencia_etiquetas == 3)
            dato.apariencia_etiquetas = "No aplica";

          if (dato.apariencia_termoencogible == 1)
            dato.apariencia_termoencogible = "Cumple";
          if (dato.apariencia_termoencogible == 2)
            dato.apariencia_termoencogible = "No Cumple";
          if (dato.apariencia_termoencogible == 3)
            dato.apariencia_termoencogible = "No Aplica";

          if (dato.cumplimiento_empaque == 1)
            dato.cumplimiento_empaque = "Cumple";
          if (dato.cumplimiento_empaque == 2)
            dato.cumplimiento_empaque = "No Cumple";
          if (dato.cumplimiento_empaque == 3)
            dato.cumplimiento_empaque = "No Aplica";

          if (dato.posicion_producto == 1) dato.posicion_producto = "Cumple";
          if (dato.posicion_producto == 2) dato.posicion_producto = "No Cumple";
          if (dato.posicion_producto == 3) dato.posicion_producto = "No Aplica";

          if (dato.rotulo_caja == 1) dato.rotulo_caja = "Cumple";
          if (dato.rotulo_caja == 2) dato.rotulo_caja = "No Cumple";
          if (dato.rotulo_caja == 3) dato.rotulo_caja = "No Aplica";
          return dato;
        });

        $(`#muestrasAcondicionamiento1`).append(
          `<tr>
            <th class="centrado">${i + 1}</th>
            <th class="centrado">${data[i].apariencia_etiquetas}</th>
            <th class="centrado">${data[i].apariencia_termoencogible}</th>
            <th class="centrado">${data[i].cumplimiento_empaque}</th>
            <th class="centrado">${data[i].posicion_producto}</th>
            <th class="centrado">${data[i].rotulo_caja}</th>
          </tr>`
        );
      }
    },
  });
};

entrega_material_acondicionamiento = () => {
  $.ajax({
    url: "../../html/php/envase.php",
    type: "POST",
    data: { referencia },
  }).done((data, status, xhr) => {
    if (data == "") return false;
    var info = JSON.parse(data);
    empaqueEnvasado = Math.round(cantidad / info[0].unidad_empaque);
    unidades = cantidad;

    $(`.empaque1`).html(info[0].id_empaque);
    $(`.descripcion_empaque1`).html(info[0].empaque);

    $(`.otros1`).html(info[0].id_otros);
    $(`.descripcion_otros1`).html(info[0].otros);

    //$(`.unidades1`).html(unidades);
    //$(`.unidades1e`).html(empaqueEnvasado);
  });
};

conciliacion = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/conciliacion_rendimiento.php",
    data: { operacion: 5, idBatch },

    success: function (response) {
      let info = JSON.parse(response);
      if (info.length === 0) return false;
      let rendimiento = (presentacion * cantidad_lote * densidad) / 1000;
      rendimiento = ((rendimiento / tamanioLote) * 100).toFixed(2) + "%";
      $(`#conciliacionRendimiento1`).val(rendimiento);

      for (let i = 0; i < info.length; i++) {
        if (info[i].modulo == 6) {
          $(`#f_realizoConciliacion`).prop("src", info[i].urlfirma);
          $(`#user_realizoConciliacion`).html(
            `Realizó: <b>${info[i].nombre}</b>`
          );
        }
      }
    },
  });
};

const despachos = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/servicios/c_batch_pdf.php",
    data: { operacion: 13, idBatch },
    success: function (response) {
      info = JSON.parse(response);
      if (info.length > 0) {
        $("#fecha7").html(info[0].fecha_registro);
        for (let i = 0; i < info.length; i++) {
          $(`#user_entrego`).html(
            `Realizó: <b>${info[i].nombre} ${info[i].apellido}</b>`
          );
          $(`#f_entrego`).prop("src", info[i].urlfirma);
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
    type: "POST",
    url: "../../html/php/servicios/c_batch_pdf.php",
    data: { operacion: 12, idBatch },
    success: function (response) {
      if (response == "[]") return false;
      data = JSON.parse(response);
      $("#observacionesAprobacion").html(data[0].observaciones);
    },
  });
};

analisisMicrobiologico = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/servicios/c_batch_pdf.php",
    data: { operacion: 14, idBatch },
    success: function (response) {
      if (response == "[]") return false;

      $(".chkAprobado").prop("disabled", true);
      $(".chkRechazado").prop("disabled", true);

      data = JSON.parse(response);
      let result1, result2, result3;
      data[0].pseudomona == 1
        ? (result1 = "Ausencia")
        : (data[0].pseudomona = 2
            ? (result1 = "Presencia")
            : (result1 = "No Aplica"));

      data[0].escherichia == 1
        ? (result2 = "Ausencia")
        : (data[0].escherichia = 2
            ? (result2 = "Presencia")
            : (result2 = "No Aplica"));

      data[0].staphylococcus == 1
        ? (result3 = "Ausencia")
        : (data[0].staphylococcus = 2
            ? (result3 = "Presencia")
            : (result3 = "No Aplica"));

      $("#mesofilos").html(data[0].mesofilos);
      $("#pseudomona").html(result1);
      $("#escherichia").html(result2);
      $("#staphylococcus").html(result3);
      $("#fsiembra").val(data[0].fecha_siembra).css("text-align", "center");
      $("#fresultados")
        .val(data[0].fecha_resultados)
        .css("text-align", "center");

      if (data[0].realizo) {
        $(`#f_realizoMicro`).prop("src", data[0].realizo);
        $(`#user_realizoMicro`).html(
          `Realizó: <b>${data[0].nombre_realizo}</b>`
        );
      }

      if (data[0].verifico) {
        $(`#f_verificoMicro1`).prop("src", data[0].verifico);
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
      $(".chkAprobado").prop("checked", true);
      /* if (data[0].observaciones == "") $(".chkAprobado").prop("checked", true);
      else $(".chkAprobado").prop("checked", true); */
    },
  });
};

const liberacion_lote = () => {
  $.post(
    "../../html/php/servicios/c_batch_pdf.php",
    { idBatch, operacion: 16 },
    function (data, textStatus, jqXHR) {
      if (data == "false") {
        $(`#f_realizoPRO`).hide();
        $(`#f_realizoCA`).hide();
        $(`#f_realizoTEC`).hide();
        return false;
      }
      info = JSON.parse(data);
      let produccion = info["dirProd"];
      let calidad = info["dirCa"];
      let tecnica = info["dirTec"];

      $(".fechaHoraLiberacion").html(
        `fecha y Hora: <b>${info["fecha_registro"]}</b>`
      );

      info["aprobacion"] == 0
        ? $("#LiberacionNo").html("<b>X</b>")
        : $("#LiberacionSi").html("<b>X</b>");

      info["observaciones"] == ""
        ? $("#observacioneslote").html("<b>X</b>")
        : $("#observacioneslote").html(info["observaciones"]);

      if (produccion != null) {
        $(`#dirNameProd`).html(`<b>${info["dirProd"]}</b>`);
        $(`#f_realizoPRO`).prop("src", info["produccion"]);
        $(`#blank_prod`).hide();
      } else {
        $(`#blank_prod`).show();
        $(`#f_realizoPRO`).hide();
      }

      if (calidad != null) {
        $(`#dirNameCa`).html(`<b>${info["dirCa"]}</b>`);
        $(`#f_realizoCA`).prop("src", info["calidad"]);
        $(`#blank_cal`).hide();
      } else {
        $(`#blank_cal`).show();
        $(`#f_realizoCA`).hide();
      }

      if (tecnica != null) {
        $(`#dirNameTec`).html(`<b>${info["dirTec"]}</b>`);
        $(`#f_realizoTEC`).prop("src", info["tecnica"]);
        $(`#blank_tec`).hide();
      } else {
        $(`#blank_tec`).show();
        $(`#f_realizoTEC`).hide();
      }

      $(`#f_verificoMicro`).hide();
      $(`#blank_ver`).show();
      $(`#user_verificoMicro`).html("Verificó: <b>Sin firmar</b>");
    }
  );
};

$(document).ready(function () {
  cargar_Alertas();
  info_General();
  parametros_Control();
  especificaciones_producto();
  condiciones_medio();
  control_proceso();
  equipos();
  ajustes();
  muestras_acondicionamiento();
  despachos();
  analisisMicrobiologico();
  multipresentacion();
  setTimeout(() => {
    entrega_material_acondicionamiento();
    conciliacion();
    liberacion_lote();
    firmas();
  }, 50);
});
