let tnq = 1;
let total = 0;
let addtnq = 1;

/* Mostrar Modal y Ocultar select referencias */

function mostrarModal() {
  $("#referencia").css("display", "none");
  $("#cmbNoReferencia").css("display", "block");
  $("#modalCrearBatch").find("input,textarea,select").val("");
  $("#guardarBatch").html("Crear");
  $(".tcrearBatch").html("Crear Batch Record");
  batch_record();
  cargarReferencias();
  cargarTanques();
  OcultarTanques();
}

/* Ocultar Tanques al inicial el Batch Record */

function OcultarTanques() {
  $(".labelTotalTanques").hide();
  $(".labelTanques").hide();
  $(".sumaTanques").hide();

  for (i = 1; i < 6; i++) {
    $("#cmbTanque" + i)
      .hide()
      .removeAttr("disable");
    $("#txtCantidad" + i)
      .hide()
      .removeAttr("disable");
    $("#txtTotal" + i)
      .hide()
      .removeAttr("disable");
    $("#btnEliminar" + i)
      .hide()
      .removeAttr("disable");
  }
}

/* Eliminar los tanques generados */

function limpiarTanques() {
  $("#sumaTanques").val(" ");

  for (i = 1; i < 6; i++) {
    $("#cmbTanque" + i).val("Tanque");
    $("#txtCantidad" + i).val("");
    $("#txtTotal" + i).val("");
  }
}

/* Llenar el selector de referencias al crear Batch */

function cargarReferencias() {
  $.ajax({
    type: "POST",
    url: "php/listarBatch.php",
    data: {
      operacion: "3",
    },

    success: function (r) {
      var $select = $("#cmbNoReferencia");
      $("#cmbNoReferencia").empty();
      var info = JSON.parse(r);
      $select.append("<option disabled selected>" + "Referencia" + "</option>");

      $.each(info, function (i, value) {
        $select.append("<option>" + value.referencia + "</option>");
      });

      $("#modalCrearBatch").modal("show");
      addtnq = 1;
    },
  });
}

/* Llenar campos de producto de acuerdo con la referencia del producto */

$(document).ready(function () {
  $("#cmbNoReferencia").change(function () {
    recargarDatos();
  });
});

function recargarDatos() {
  var combo = document.getElementById("cmbNoReferencia");
  var sel = combo.options[combo.selectedIndex].text;
  
  $.ajax({
    type: "POST",
    url: "php/listarBatch.php",
    data: { operacion: "4", id: sel },

    success: function (r) {
      var info = JSON.parse(r);

      $("#idbatch").val(info[0].referencia);
      $("#nombrereferencia").val(info[0].nombre);
      $("#marca").val(info[0].marca);
      $("#notificacionSanitaria").val(info[0].notificacion_sanitaria);
      $("#propietario").val(info[0].propietario);
      $("#producto").val(info[0].producto);
      $("#presentacioncomercial").val(info[0].presentacion_comercial);
      $("#linea").val(info[0].linea);
      $("#densidad").val(info[0].densidad);
    },
  });
}

/* calcular Tamaño del Lote */

function CalculoTamanolote(valor) {
  var total = 0;
  unidades = parseInt(valor);
 
  densidad = $("#densidad").val();

  if (batch == undefined || batch == false) {
    presentacion = formatoGeneral($("#presentacioncomercial").val());
  } else {
    presentacion = batch[0].presentacion_comercial;
  }

  total = ((unidades * densidad * presentacion) / 1000) * (1 + 0.005);
  total1 = formatoCO(total.toFixed(2));

  $("#tamanototallote").val(total1);
}

/* Limpiar datos al cambiar referencia en el modal de crear Batch */

$("#cmbNoReferencia").change(function () {
  $("#tamanototallote").val("");
  $("#unidadesxlote").val("");
  $("#fechaprogramacion").val("");
});

/* Adicionar y elimina campos para los tanques al crear batch record */

$("#adicionarPesaje").on("click", function () {
  const unidades = $("#unidadesxlote").val();
  const lote = $("#tamanototallote").val();
  const sumaTanques = $("#sumaTanques").val();

  contarTanques();

  if (unidades === "" || unidades === 0 || lote === 0) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Complete todos los campos.");
    return false;
  }

  if (
    addtnq == 1 ||
    (addtnq > 1 && addtnq < 6 && sumaTanques != "0" && sumaTanques !== "")
  ) {
    insertar();
    bloquearCeldas();
  } else {
    alertify.set("notifier", "position", "top-right");
    alertify.error(
      "Diligencie todos los campos vacios o reconfigure los tanques."
    );
  }
});

function insertar() {
  insertarTanques();
  $(".sumaTanques").val("");
  $(".labelTotalTanques").show();
  $(".labelTanques").show();
}

function insertarTanques() {
  $("#cmbTanque" + addtnq).show();
  $("#txtCantidad" + addtnq).show();
  $("#txtTotal" + addtnq).show();
  $("#btnEliminar" + addtnq).show();
  $("#sumaTanques").show();
  addtnq++;
}

function bloquearCeldas() {
  addtnq = addtnq - 2;
  $("#cmbTanque" + addtnq).attr("disabled", "disabled");
  $("#txtCantidad" + addtnq).attr("disabled", "disabled");
  $("#txtTotal" + addtnq).attr("disabled", "disabled");
  $("#btnEliminar" + addtnq).attr("disabled", "disabled");
}

/* Cargar tanques */

function cargarTanques() {
  $.ajax({
    type: "POST",
    url: "php/listarBatch.php",
    data: { operacion: "9" },
    success: function (r) {
      var info = JSON.parse(r);

      for (i = 1; i < 6; i++) {
        let $select = $("#cmbTanque" + i);
        $select.empty();

        $("#txtCantidad" + i).val(0);
        $("#txtTotal" + i).val(0);

        $select.append("<option disabled selected>" + "Tanque" + "</option>");
        $.each(info, function (i, value) {
          $select.append(
            '<option value ="' +
              value.capacidad +
              '">' +
              value.capacidad +
              "</option>"
          );
        });
      }
    },
  });
}
/* Calcular el valor de los tanques */

function validarTanque(id) {
  const cant = $("#txtCantidad" + id).val();

  if (cant != "") {
    CalcularTanque(id);
  }
}

function CalcularTanque(id) {
  const tanque = $("#cmbTanque" + id).val();
  const cantidad = $("#txtCantidad" + id).val();

  if (cantidad >= 11) {
    $("#txtTotal1").val("");
    $("#sumaTanques").val("");
    alertify.set("notifier", "position", "top-right");
    alertify.error("Supera el número de tanques");
    return false;
  }

  if (tanque == "" || cantidad == "" || cantidad == 0) {
    return false;
  }

  $("#sumaTanques").val("");

  if (tanque == "null") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione el Tanque");
    return false;
  }

  total = tanque * cantidad;
  $("#txtTotal" + id).val(total);

  var sumaTanques = 0;

  for (i = 1; i <= id; i++) {
    let total = $("#txtTotal" + i).val();
    sumaTanques = parseInt(sumaTanques) + parseInt(total);
  }

  let cantidadLote = $("#tamanototallote").val();
  cantidadLote = formatoGeneral(cantidadLote);

  if (sumaTanques > cantidadLote) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("La configuración de Tanques supera el Tamaño del lote");
    return false;
  } else {
    $("#sumaTanques").val(sumaTanques);
  }
}

/* Eliminar Tanque */
function eliminarTanque(id) {
  contarTanques();

  $("#cmbTanque" + id)
    .hide()
    .val("");
  $("#txtCantidad" + id)
    .hide()
    .val("");
  $("#txtTotal" + id)
    .hide()
    .val("");
  $("#btnEliminar" + id).hide();

  $("#cmbTanque" + (id - 1)).removeAttr("disabled");
  $("#txtCantidad" + (id - 1)).removeAttr("disabled");
  $("#txtTotal" + (id - 1)).removeAttr("disabled");
  $("#btnEliminar" + (id - 1)).removeAttr("disabled");

  Notanques--;

  if (Notanques == 0) {
    $(".labelTotalTanques").hide();
    $(".labelTanques").hide();
    $("#sumaTanques").hide();
  }

  sumaTanques = 0;

  for (i = 1; i < 6; i++) {
    var total = $("#txtTotal" + i).val();
    if (total != "") sumaTanques = parseInt(sumaTanques) + parseInt(total);
  }

  $("#sumaTanques").val(sumaTanques);
}

/* cerrar modal al crear Batch */

function cerrarModal() {
  $("#modalCrearBatch").modal("hide");
  $("#Modal_Multipresentacion").modal("hide");
}
