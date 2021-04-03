let idBatch;

/* bloquear inputs */
$("input").prop("readonly", true);

/* Imprimir pdf */
$(document).on("click", ".link-imprimir", function (e) {
  e.preventDefault();
  //$(location).attr('href', "pdf.php");
  $("#pdf").printThis({
    debug: false, // show the iframe for debugging
    importCSS: true, // import parent page css
    importStyle: false, // import style tags
    printContainer: true, // print outer container/$.selector
    loadCSS: "", // path to additional css file - use an array [] for multiple
    pageTitle: "", // add title to print page
    removeInline: true, // remove inline styles from print elements
    removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
    printDelay: 333, // variable print delay
    header: null, // prefix to html
    footer: null, // postfix to html
    base: false, // preserve the BASE tag or accept a string for the URL
    formValues: true, // preserve input/form values
    canvas: false, // copy canvas content
    doctypeString: "...", // enter a different doctype for older markup
    removeScripts: false, // remove script tags from print content
    copyTagClasses: false, // copy classes from the html & body tag
    beforePrintEvent: null, // function for printEvent in iframe
    beforePrint: null, // function called before iframe is filled
    afterPrint: null, // function called before iframe is removed
  });
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
    (data = { operacion: 2, id }),
    function (data, textStatus, jqXHR) {
      if (data == "false") return false;
      let info = JSON.parse(data);
      idBatch = id;
      $("#ref").html(info.referencia);
      $("#nref").html("<b>" + info.nombre_referencia + "</b>");
      $("#marca").html("<b>" + info.marca + "</b>");
      $("#propietario").html("<b>" + info.propietario + "</b>");
      $("#notificacion").html("<b>" + info.notificacion + "</b>");
      $("#presentacion").html("<b>" + info.presentacion + "</b>");
      $("#orden").html("<b>" + info.numero_orden + "</b>");
      $("#lote").html("<b>" + info.numero_lote + "</b>");
      $(".fecha").html("<b>" + info.fecha_creacion + "</b>");
      $("#tamanolt").html("<b>" + info.tamano_lote + "</b>");
      $("#tamanol").html("<b>" + info.tamano_lote + "</b>");
      $("#unidades").html("<b>" + info.unidad_lote + "</b>");
      $(".fecha").html("<b>" + info.fecha_creacion + "</b>");
      especificaciones_producto();
      entrega_material_envase();
      obtenerMuestras();
      identificarDensidad();
      material_envase_sobrante();
      area_desinfeccion();
    }
  );
};

parametros_Control = () => {
  let data = { operacion: 3, id };

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

function area_desinfeccion() {
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
              <td></td>
          </tr>`);
      }
    }
  );
  desinfectante();
}

function desinfectante() {
  let data = { operacion: 5, id };

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
    }
  );
}

function condiciones_medio() {
  let data = { operacion: 6, id };
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
  $.get(`/api/equipos/${id}`, function (data, textStatus, jqXHR) {
    if (data.length == 0) return false;
    $("#agitador").val(data[0].descripcion);
    $("#marmita").val(data[1].descripcion);
    $("#envasadora").val(data[2].descripcion);
    $("#loteadora").val(data[3].descripcion);
    $("#banda").val(data[4].descripcion);
    $("#etiquetadora").val(data[5].descripcion);
    $("#tunel").val(data[6].descripcion);
  });
}

function especificaciones_producto() {
  referencia = $("#ref").html();
  $.ajax({
    url: `/api/productsDetails/${referencia}`,

    type: "GET",
  }).done((data, status, xhr) => {
    $("#espec_color").html(data.color);
    $("#espec_olor").html(data.olor);
    $("#espec_apariencia").html(data.apariencia);
    $("#espec_poder_espumoso").html(data.poder_espumoso);

    $("#espec_untosidad").html(data.untuosidad);
    $("#espec_ph").html(
      `${data.limite_inferior_ph} a ${data.limite_superior_ph}`
    );

    $("#in_ph").attr("min", data.limite_inferior_ph);
    $("#in_ph").attr("max", data.limite_superior_ph);

    $("#espec_densidad").html(
      `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`
    );

    $("#in_densidad").attr("min", data.limite_inferior_densidad_gravedad);
    $("#in_densidad").attr("max", data.limite_superior_densidad_gravedad);

    $("#espec_grado_alcohol").html(
      `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`
    );

    $("#in_grado_alcohol").attr("min", data.limite_inferior_grado_alcohol);
    $("#in_grado_alcohol").attr("max", data.limite_superior_grado_alcohol);

    $("#espec_viscidad").html(
      `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`
    );

    $("#in_viscocidad").attr("min", data.limite_inferior_viscosidad);
    $("#in_viscocidad").attr("max", data.limite_superior_viscosidad);
  });
}

function control_proceso() {
  $.get(`/api/controlproceso/${id}`, function (info, textStatus, jqXHR) {
    if (info == "false") return false;
    //info = data;
    for (let i = 0; i < info.length; i++) {
      $(`.color${info[i].modulo}`).html(
        info[0].color == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.olor${info[i].modulo}`).html(
        info[0].olor == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.apariencia${info[i].modulo}`).html(
        info[0].apariencia == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.ph${info[i].modulo}`).html(info[0].ph);
      $(`.viscosidad${info[i].modulo}`).html(info[0].viscosidad);
      $(`.densidad${info[i].modulo}`).html(info[0].densidad);
      $(`.untuosidad${info[i].modulo}`).html(
        info[0].untuosidad == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.espumoso${info[i].modulo}`).html(
        info[0].espumoso == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
      $(`.alcohol${info[i].modulo}`).html(
        info[0].alcohol == 1
          ? "Cumple"
          : info[0].color == 2
          ? "No Cumple"
          : "No aplica"
      );
    }
  });
}

function entrega_material_envase() {
  referencia = $("#ref").html();
  $.ajax({
    url: "../../html/php/envase.php",
    type: "POST",
    data: { referencia },
  }).done((data, status, xhr) => {
    info = JSON.parse(data);
    $(`.envase`).html(info[0].id_envase);
    $(`.descripcion_envase`).html(info[0].envase);

    $(`.tapa`).html(info[0].id_tapa);
    $(`.descripcion_tapa`).html(info[0].tapa);

    $(`.etiqueta`).html(info[0].id_etiqueta);
    $(`.descripcion_etiqueta`).html(info[0].etiqueta);

    $(`.unidades`).html(unidades);
    //$(`.unidadese`).html(empaqueEnvasado);
  });
}

/* Calcular peso minimo, maximo y promedio */

identificarDensidad = (batch = "") => {
  let densidadAprobada = 0;
  idBatch = id;
  $.ajax({
    type: "POST",
    url: "../../html/php/controlProceso.php",
    data: { modulo: 4, idBatch },

    success: function (response) {
      if (response == 0) return false;
      else {
        let espec = JSON.parse(response);
        for (let i = 0; i < espec.data.length; i++) {
          densidadAprobada = densidadAprobada + espec.data[i].densidad;
        }
        densidadAprobada = densidadAprobada / espec.data.length;
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
  idBatch = id;
  $.ajax({
    type: "POST",
    url: "../../html/php/muestras.php",
    data: { operacion: 6, idBatch },

    success: function (response) {
      if (response == 3) return false;

      let promedio = 0;
      let info = JSON.parse(response);
      j = 1;

      $(`#muestrasEnvasado1`).append(`
        <thead class="head">
          <tr>
            <th colspan="${info.length}" class="centrado">Resultados</th>
          </tr>
        </thead>`);

      for (let i = 0; i < info.length; i++) {
        //if (i === 10) $(`#muestrasEnvasado1`).append(`<th></th>`);
        $(`#muestrasEnvasado1`).append(
          `<td class="centrado">${info[i].muestra}</td>`
        );

        //$(`#txtMuestra${j}`).val(info[i].muestra);
        promedio = promedio + info[i].muestra;
        j++;
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
      info.forEach((item) => {
        if (item.modulo == 5) {
          $(`#devolucionMaterialSorbrante`).append(`
            <tr>
              <td class="centrado">${item.ref_material}</td>
              <td></td>
              <td class="der">${item.envasada}</td>
              <td class="der">${item.envasada}</td>
              <td class="der">${item.averias}</td>
              <td class="der">${item.sobrante}</td>
            </tr>`);
        }
      });
    },
  });
};

entrega_material_acondicionamiento = () => {};

$(document).ready(function () {
  id = sessionStorage.getItem("id");

  cargar_Alertas();
  info_General();
  parametros_Control();
  /* area_desinfeccion(); */
  //desinfectante();
  condiciones_medio();
  control_proceso();
  equipos();
});
