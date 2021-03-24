let totallotexpresentacion = [];
editar = false;
/* Validar Batch Record y si existe Cargar Multipresentación */

$("#tablaBatch tbody").on("click", "tr", function () {
  data = tabla.row(this).data();
});

/* Almacenar referencias para los procesos de clonado y multipresentacion */

$(document).on("click", ".link-select", function (e) {
  var referencia = $(this).parent().parent().children().eq(3).text();
  localStorage.setItem("referencia", referencia);
});

/* Validar si un producto puede tener multipresentacion */

function multipresentacion() {
  if ($("input[name='optradio']:radio").is(":checked") || editar === true) {
    $.ajax({
      type: "POST",
      url: "php/multi.php",
      data: { operacion: "1", id: data.referencia },

      success: function (r) {
        var info = JSON.parse(r);

        if (info != "") {
          for (let i = 1; i < 6; i++) {
            $(`#txtcantidadMulti${i}`).val("");
            $(`#txttamanoloteMulti${i}`).val("");
          }
          $(`#sumaMulti`).val("");
          $("#Modal_Multipresentacion").modal("show");
          OcultarMultipresentacion();
          cargarMulti(info);
        } else {
          alertify.set("notifier", "position", "top-right");
          alertify.error(
            "No existen referencias asociadas para este producto."
          );
        }
      },
    });
  } else {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Para Multipresentación seleccione un Batch Record");
  }
}

/* Ocultar objetos para Multipresentacion */

function OcultarMultipresentacion() {
  $(".labelcenter").hide();
  $("#loteTotal").hide();
  $("#sumaMulti").hide();

  for (i = 1; i < 6; i++) {
    $("#cmbMultiReferencia" + i)
      .hide()
      .removeAttr("disable");
    $("#txtcantidadMulti" + i)
      .hide()
      .removeAttr("disable");
    $("#txttamanoloteMulti" + i)
      .hide()
      .removeAttr("disable");
    $("#txtdensidadMulti" + i)
      .hide()
      .removeAttr("disable");
    $("#txtpresentacionMulti" + i)
      .hide()
      .removeAttr("disable");
    $(".btneliminarMulti" + i)
      .hide()
      .removeAttr("disable");
  }
}

/* Adicionar referencia para crear multipresentacion en un batch*/

$("#adicionarMultipresentacion").on("click", function () {
  contarMultipresentacion();
  const cantidad = $("#txtcantidadMulti" + cont).val();
  $("#etiquetasMulti").css("display", "grid");

  if (cont == 0) {
    insertarMulti();
    insertarTotales();
  } else if (cont > 0 && cont < 6 && cantidad != "0" && cantidad != "") {
    insertarMulti();
    bloquearCeldasMulti();
  } else {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Diligencie todos los campos vacios.");
  }
});

/* Contar objetos creados para Multipresentacion */

function contarMultipresentacion() {
  cont = 0;
  for (i = 1; i < 6; i++) {
    if ($("#txttamanoloteMulti" + i).is(":visible")) {
      cont = cont + 1;
    }
  }
}

/* Insertar Multipresentacion Nueva */

function insertarMulti() {
  addMulti = cont + 1;

  $("#cmbMultiReferencia" + addMulti).show();
  $("#txtcantidadMulti" + addMulti).show();
  $("#txttamanoloteMulti" + addMulti).show();
  $(".btneliminarMulti" + addMulti).show();
}

function insertarTotales() {
  $(".labelcenter").show();
  $("#loteTotal").show().val(data.tamano_lote);

  $("#sumaMulti").show();
}

/* deshabilitar objetos configurada para multipresentacion al adicionar una nueva*/

function bloquearCeldasMulti() {
  $("#cmbMultiReferencia" + cont).attr("disabled", "disabled");
  $("#txtcantidadMulti" + cont).attr("disabled", "disabled");
  $("#txttamanoloteMulti" + cont).attr("disabled", "disabled");
  /* $('#txtdensidadMulti' + addMulti).attr('disabled', 'disabled');
    $('#txtpresentacionMulti' + addMulti).attr('disabled', 'disabled'); */
  $(".btneliminarMulti" + cont).attr("disabled", "disabled");
}

/* Cargar Select Referencias con Multipresentacion */

function cargarMulti(multi) {
  for (i = 1; i < 6; i++) {
    let $select = $(`#cmbMultiReferencia${i}`);

    $select.empty();
    $select.append(
      "<option disabled selected>" + "Multipresentación" + "</option>"
    );

    $.each(multi, function (i, value) {
      $select.append(
        `<option value="${value.referencia}">${value.nombre_referencia}</option>`
      );
    });
  }
}

/* cargar datos de acuerdo con la seleccion de multipresentacion */

function cargarReferenciaM(id) {
  const referencia = $("#cmbMultiReferencia" + id).val();

  $.ajax({
    type: "POST",
    url: "php/multi.php",
    data: { operacion: "3", referencia },

    success: function (r) {
      var info = JSON.parse(r);
      $("#txtpresentacionMulti" + id).val(info[0].presentacion);
      $("#txtdensidadMulti" + id).val(info[0].densidad);
    },
  });
  calcularMulti(id);
}

/* Calcular Lote de acuerdo con la seleccion y las unidades a fabricar */

function calcularMulti(id) {
  const cantidad = $("#txtcantidadMulti" + id).val();
  if (cantidad != "") {
    CalculoloteMulti(id, cantidad);
  }
}

/* calcular Tamaño del Lote */

function CalculoloteMulti(id, cantidad) {
  const referencia = $("#cmbMultiReferencia" + id).val();
  const densidad = $("#txtdensidadMulti" + id).val();
  const presentacion = $("#txtpresentacionMulti" + id).val();
  const lote = $("#loteTotal").val();

  cantidad = $("#txtcantidadMulti" + id).val();
  let sumaMulti = 0;

  if (referencia == undefined) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione la presentación.");
    return false;
  }

  total = parseInt(((densidad * cantidad * presentacion) / 1000) * (1 + 0.005)); // guardar campo en nueva columna en base de datos para obterla en envasado como total (kg)
  totallotexpresentacion.push(total);
  //console.log(totallotexpresentacion);

  $("#txttamanoloteMulti" + id).val(total);

  for (i = 1; i < 6; i++) {
    totalMulti = $("#txttamanoloteMulti" + i).val();
    if (totalMulti == undefined || totalMulti == "") {
      totalMulti = 0;
    }

    sumaMulti = parseInt(sumaMulti) + parseInt(totalMulti);
  }

  if (sumaMulti > lote) {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "El tamaño del lote para esta referencia de Multipresentación supera el Tamaño del lote inicial"
    );
    sumaMulti = 0;
    return false;
  } else {
    $("#sumaMulti").val(sumaMulti);
  }
}

/* Eliminar Multipresentacion */

function eliminarMulti(id) {
  let totallote = 0;

  $("#cmbMultiReferencia" + id)
    .hide()
    .val("")
    .removeAttr("disabled");
  $("#txtcantidadMulti" + id)
    .hide()
    .val("")
    .removeAttr("disabled");
  $("#txttamanoloteMulti" + id)
    .hide()
    .val("")
    .removeAttr("disabled");
  $(".btneliminarMulti" + id)
    .hide()
    .removeAttr("disabled");
  $("#txtdensidadMulti" + id)
    .hide()
    .val("")
    .removeAttr("disabled");
  $("#txtpresentacionMulti" + id)
    .hide()
    .val("")
    .removeAttr("disabled");

  for (i = 1; i < 6; i++) {
    const loteMulti = $("#txttamanoloteMulti1").val();

    if (loteMulti != "") {
      totallote = totallote + parseInt(loteMulti);
    }
  }

  $("#sumaMulti").val(totallote);

  $("#cmbMultiReferencia" + (id - 1)).attr("disabled", false);
  $("#txtcantidadMulti" + (id - 1)).removeAttr("disabled");
  $("#txtdensidadMulti" + (id - 1))
    .val("")
    .removeAttr("disabled");
  $("#txtpresentacionMulti" + (id - 1))
    .val("")
    .removeAttr("disabled");
  $(".btneliminarMulti" + (id - 1)).removeAttr("disabled");
}

/* Guardar Multi */

function guardar_Multi() {
  let ref = [];
  let cant = [];
  let totalpresentacion = [];
  let j = 1;

  contarMultipresentacion();

  //obtener referencias

  for (i = 0; i < cont; i++) {
    ref[i] = $(`#cmbMultiReferencia${j} option:selected`).text();
    cant[i] = $(`#txtcantidadMulti${j}`).val();
    totalpresentacion[i] = $(`#txttamanoloteMulti${j}`).val();
    j++;
  }

  if (!editar) {
    datos = {
      operacion: "4",
      ref: ref,
      cant: cant,
      tot: totalpresentacion,
      id: data.id_batch,
    };
  } else {
    datos = {
      operacion: "5",
      ref: ref,
      cant: cant,
      tot: totalpresentacion,
      id: data.id_batch,
    };
  }

  $.ajax({
    type: "POST",
    url: "php/multi.php",
    data: datos,

    success: function (r) {
      alertify.set("notifier", "position", "top-right");
      alertify.success("Multipresentación registrada con éxito.");
      cerrarModal();
      actualizarTabla();
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Error al registrar la Multipresentación.");
    },
  });
}

//Actualizar Multipresentacion

$(document).on("click", ".link-editarMulti", function (e) {
  editar = true;
  texto = $(this).parent().parent().children()[6];
  tamano = formatoGeneral($(texto).text());

  limpiarMultipresentacion();
  OcultarMultipresentacion();
  multipresentacion();

  $.ajax({
    method: "POST",
    url: "php/multi.php",
    data: { operacion: "6", id: data.id_batch },

    success: function (response) {
      cont = 0;
      let cantidadTotal = 0;
      const info = JSON.parse(response);

      insertarTotales();

      for (let k = 1; k <= info.length; k++) {
        insertarMulti();
        let referencia = info[cont].referencia;
        $(`#loteTotal`).val(tamano);
        $(`#cmbMultiReferencia${k} option[value=${referencia}]`).attr(
          "selected",
          true
        );
        $("#txtcantidadMulti" + k).val(info[cont].cantidad);
        $("#txttamanoloteMulti" + k).val(info[cont].total);
        cantidadTotal = cantidadTotal + info[cont].total;
        $("#sumaMulti").val(cantidadTotal);

        cont++;
        bloquearCeldasMulti();
      }
    },
  });

  $("#Modal_Multipresentacion").modal("show");
});

/* Limpiar campos de Multipresentacion */

function limpiarMultipresentacion() {
  $("#loteTotal").val(" ");
  $("#sumaMulti").val(" ");

  contarMultipresentacion();

  for (i = 1; i <= cont; i++) {
    $("#cmbMultiReferencia" + i)
      .hide()
      .val("");
    $("#cantidadMulti" + i)
      .hide()
      .val("");
    $("#tamanoloteMulti" + i)
      .hide()
      .val("");
    $("#densidadMulti" + i)
      .hide()
      .val("");
    $("#presentacionMulti" + i)
      .hide()
      .val("");
  }
}
