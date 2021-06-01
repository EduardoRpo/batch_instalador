let idBatch;
let referencia;
let cantidad;
let presentacion;
let densidad;
let tamanioLote;
let infoBatch;

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

/* Cargar data */

cargar_Alertas = () => {
  $.post(
    "../../html/php/c_batch_pdf.php",
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

info_General = () => {
  $.post(
    "../../html/php/c_batch_pdf.php",
    (data = { operacion: 2, idBatch }),
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
      let info = JSON.parse(data);
      infoBatch = info;
      cantidad = info.unidad_lote;
      presentacion = info.presentacion;
      densidad = info.densidad;
      tamanioLote = info.tamano_lote;
      $(".ref").html(info.referencia);
      $("#nref").html("<b>" + info.nombre_referencia + "</b>");
      $("#marca").html("<b>" + info.marca + "</b>");
      $("#propietario").html("<b>" + info.propietario + "</b>");
      $("#notificacion").html("<b>" + info.notificacion + "</b>");
      $("#presentacion").html("<b>" + info.presentacion + "</b>");
      $(".orden").html("<b>" + info.numero_orden + "</b>");
      $(".lote").html("<b>" + info.numero_lote + "</b>");
      $(".fecha").html("<b>" + info.fecha_creacion + "</b>");
      $("#tamanolt").html("<b>" + info.tamano_lote + "</b>");
      $("#tamanol").html("<b>" + info.tamano_lote + "</b>");
      $("#unidadesLote").html("<b>" + info.unidad_lote + "</b>");
      $(".unidades1").html("<b>" + info.unidad_lote + "</b>");
      $(".fecha").html("<b>" + info.fecha_creacion + "</b>");
      lote_anterior();
      desinfectante();
      observacionesAprobacion();
    }
  );
};

parametros_Control = () => {
  let data = { operacion: 3, idBatch };

  $.post(
    "../../html/php/c_batch_pdf.php",
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

  lote = linea.concat("00", serie, fecha);
  area_desinfeccion(lote);
};

area_desinfeccion = (lote) => {
  let data = { operacion: 4 };

  $.post(
    "../../html/php/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;

      let info = JSON.parse(data);

      for (let i = 0; i < info.data.length; i++) {
        $(`#area_desinfeccion${info.data[i].modulo}`).append(`
          <tr>
            <td>${info.data[i].descripcion}</td>
            <td class="centrado desinfectante${info.data[i].modulo}"></td>
            <td class="centrado concentracion${info.data[i].modulo}"></td>
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
    "../../html/php/c_batch_pdf.php",
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

        if (info[i].realizo != 0) {
          $(`#f_realizo${info[i].modulo}`).prop("src", info[i].realizo);
          $(`#user_realizo${info[i].modulo}`).html(
            "Realizó: " + "<b>" + info[i].nombre_realizo + "</b>"
          );
        } else if (info[i].realizo == 0) {
          $(`#f_realizo${info[i].modulo}`).prop("hide", true);
          $(`#blank_rea${info[i].modulo}`).show();
          $(`#user_realizo${info[i].modulo}`).html(
            "Realizó: " + "<b> Sin firmar</b>"
          );
        }

        if (info[i].verifico != 0) {
          $(`#f_verifico${info[i].modulo}`).prop("src", info[i].verifico);
          $(`#user_verifico${info[i].modulo}`).html(
            "Verificó: " + "<b>" + info[i].nombre_verifico + "</b>"
          );
        } else {
          $(`#f_verifico${info[i].modulo}`).hide();
          $(`#blank_ver${info[i].modulo}`).show();
          $(`#user_verifico${info[i].modulo}`).html(
            "Verificó: " + "<b>Sin firmar</b>"
          );
        }
      }

      let fecha = $("#fecha2").html();
      fecha = fecha.substr(0, 10);
      $(".fecha2").html(fecha);
    }
  );
};

despachos = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/c_batch_pdf.php",
    data: { operacion: 13, idBatch },
    success: function (response) {
      info = JSON.parse(response);
      for (let i = 0; i < info.length; i++) {
        $(`#user_entrego`).html(
          "Realizó: " + "<b>" + info[i].nombre + " " + info[i].apellido + "</b>"
        );
        $(`#f_entrego`).prop("src", info[i].urlfirma);
      }
    },
  });
};

function condiciones_medio() {
  let data = { operacion: 6, idBatch };
  $.post(
    "../../html/php/c_batch_pdf.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
      let info = JSON.parse(data);

      for (let i = 0; i < info.length; i++) {
        $(`#fecha_medio${info[i].modulo}`).html(info[i].fecha);
        $(`#temperatura${info[i].modulo}`).html(info[i].temperatura + " °C");
        $(`#humedad${info[i].modulo}`).html(info[i].humedad + " %");
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
        $("#envasadora").val(data[i].descripcion);
        continue;
      }
      if (data[i].tipo === "loteadora") {
        $("#loteadora").val(data[i].descripcion);
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
  /* referencia = $("#ref").html(); */
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
    }
  });
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
  presentacion = $("#presentacion").html();
  presentacion = getNumbersInString(presentacion);

  var peso_min = presentacion * densidadAprobada;
  var peso_max = peso_min * (1 + 0.03);
  var prom = (parseInt(peso_min) + peso_max) / 2;

  $(`.minimo`).val(peso_min.toFixed(2));
  $(`.maximo`).val(peso_max.toFixed(2));
  $(`.medio`).val(prom.toFixed(2));
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

obtenerMuestras = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/muestras.php",
    data: { operacion: 6, idBatch },

    success: function (response) {
      if (response == 3) return false;
      let promedio = 0;
      let info = JSON.parse(response);
      $("#cantidadMuestras1").val(info.length);

      for (let i = 0; i < info.length; i++) {
        $(`#muestrasEnvasado1`).append(
          `<td class="centrado">${info[i].muestra}</td>`
        );

        promedio = promedio + info[i].muestra;
      }
      promedio = promedio / info.length;
      $(`#promedioMuestras1`).val(promedio);
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

      $("#usadaEnvase1").html(info[0].envasada);
      $("#averiasEnvase1").html(info[0].averias);
      $("#sobranteEnvase1").html(info[0].sobrante);

      $("#usadaTapa1").html(info[1].envasada);
      $("#averiasTapa1").html(info[1].averias);
      $("#sobranteTapa1").html(info[1].sobrante);

      $("#usadaEtiqueta1").html(info[2].envasada);
      $("#averiasEtiqueta1").html(info[2].averias);
      $("#sobranteEtiqueta1").html(info[2].sobrante);

      $("#utilizada_empaque1").html(info[3].envasada);
      $("#averias_empaque1").html(info[3].averias);
      $("#sobrante_empaque1").html(info[3].sobrante);

      $("#utilizada_otros1").html(info[4].envasada);
      $("#averias_otros1").html(info[4].averias);
      $("#sobrante_otros1").html(info[4].sobrante);
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
            <th class="centrado">${data[i].id}</th>
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
    var info = JSON.parse(data);
    empaqueEnvasado = Math.round(cantidad / info[0].unidad_empaque);
    unidades = cantidad;

    $(`.empaque1`).html(info[0].id_empaque);
    $(`.descripcion_empaque1`).html(info[0].empaque);

    $(`.otros1`).html(info[0].id_otros);
    $(`.descripcion_otros1`).html(info[0].otros);

    $(`.unidades1`).html(unidades);
    $(`.unidades1e`).html(empaqueEnvasado);
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
      let rendimiento = (presentacion * cantidad * densidad) / 1000;
      rendimiento = ((rendimiento / tamanioLote) * 100).toFixed(2) + "%";
      $(`#conciliacionRendimiento1`).val(rendimiento);

      for (let i = 0; i < info.length; i++) {
        if (info[i].modulo == 6) {
          $(`#f_realizoConciliacion`).prop("src", info[i].urlfirma);
          $(`#user_realizoConciliacion`).html(info[i].nombre);
        } else if (info[i].modulo == 7) {
          $(`#user_entrego`).html(
            "Realizó: " + "<b>" + info[i].nombre + "</b>"
          );
          $(`#f_entrego`).prop("src", info[i].urlfirma);
        }
      }
    },
  });
};

observacionesAprobacion = () => {
  $.ajax({
    type: "POST",
    url: "../../html/php/c_batch_pdf.php",
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
    url: "../../html/php/c_batch_pdf.php",
    data: { operacion: 14, idBatch },
    success: function (response) {
      if (response == "[]") return false;

      $("#chkAprobado").prop("disabled", true);
      $("#chkRechazado").prop("disabled", true);

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

      $(`#f_realizoMicro`).prop("src", data[0].realizo);
      $(`#f_verificoMicro`).prop("src", data[0].verifico);
      $(`#user_realizoMicro`).html(
        "Realizó: " + "<b>" + data[0].nombre_realizo + "</b>"
      );
      $(`#user_verificoMicro`).html(
        "Verificó: " + "<b>" + data[0].nombre_verifico + "</b>"
      );

      if (data[0].observaciones == "") $("#chkAprobado").prop("checked", true);
      else $("#chkAprobado").prop("checked", true);
    },
  });
};

$(document).ready(function () {
  idBatch = sessionStorage.getItem("id");
  let referencias = sessionStorage.getItem("multi");
  referencias = JSON.parse(referencias);
  if (!referencias) referencia = sessionStorage.getItem("referencia");

  cargar_Alertas();
  info_General();
  //area_desinfeccion();
  parametros_Control();
  especificaciones_producto();
  entrega_material_envase();
  obtenerMuestras();
  identificarDensidad();
  material_envase_sobrante();
  condiciones_medio();
  control_proceso();
  equipos();
  ajustes();
  muestras_acondicionamiento();
  //despachos();
  analisisMicrobiologico();

  setTimeout(() => {
    entrega_material_acondicionamiento();
    conciliacion();
  }, 50);
});
