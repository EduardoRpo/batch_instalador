/* Inicializar tabla Batch  */

var editar;
var datos;
var tabla;
var data;
var cont = 0;
var tanques;

$(document).ready(function () {
  crearTablaBatch();
  cargarTanques();
});

function crearTablaBatch(
  columna_busqueda = "",
  minDateFilter = "",
  maxDateFilter = ""
) {
  tabla = $("#tablaBatch").DataTable({
    responsive: true,
    scrollCollapse: true,
    language: { url: "../../../admin/sistema/admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/listarBatch.php",
      data: {
        operacion: "1",
        proceso: "1",
        busqueda: columna_busqueda,
        inicio: minDateFilter,
        final: maxDateFilter,
      },
    },

    columns: [
      {
        defaultContent:
          "<input type='radio' id='express' name='optradio' class='link-select'>",
      },
      { data: "id_batch" },
      { data: "numero_orden", className: "uniqueClassName" },
      { data: "referencia", className: "uniqueClassName" },
      { data: "nombre_referencia" },
      { data: "numero_lote" },
      {
        data: "tamano_lote",
        className: "uniqueClassName",
        render: $.fn.dataTable.render.number(".", ",", 0, ""),
      },
      { data: "nombre" },
      { data: "fecha_creacion", className: "uniqueClassName" },
      { data: "fecha_programacion", className: "uniqueClassName" },
      {
        data: "estado",
        className: "uniqueClassName",
        render: (data, type, row) => {
          "use strict";
          return data == 1
            ? "Sin Formula y/o Instructivo"
            : data == 2
            ? "Inactivo"
            : data == 3
            ? "Pesaje"
            : data == 3.5
            ? "Preparación"
            : data == 4
            ? "Preparación"
            : data == 4.5
            ? "Aprobación"
            : data == 5
            ? "Aprobación"
            : data == 5.5
            ? "Multimodulo"
            : data == 6
            ? "Multimodulo"
            : data == 6.5
            ? "Multimodulo"
            : "Multimodulo";
        },
      },
      {
        data: "multi",
        className: "uniqueClassName",
        render: (data, type, row) => {
          "use strict";
          return data == 1
            ? '<i class="fa fa-superscript link-editarMulti" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>'
            : "";
        },
      },
      {
        defaultContent:
          "<a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7);'></i></a>",
      },
      {
        defaultContent:
          "<a href='#' <i class='fa fa-trash link-borrar fa-2x' data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>",
      },
    ],
  });
}

/* Cambiar puntero del mouse al tocar los botones de actualizar y eliminar */

$(".link-editar").css("cursor", "pointer");
$(".link-editarMulti").css("cursor", "pointer");

/* Borrar registro */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();

  //let id = $(this).parent().parent().children().first().text();
  const texto = $(this).parent().parent().children()[1];
  const id = $(texto).text();

  const confirm = alertify
    .confirm(
      `¿Está seguro de eliminar el Batch ${id}?`,
      `<label>Motivo de Eliminación: </label>
      <select style='width: 100%' class="form-control" id="motivoEliminacion">
        <option value='' disabled selected>Seleccione</option>
        <option value='1'>Cancelado por el usuario</option>
        <option value='2'>Falta de Materia Prima o Insumos</option>
        <option value='3'>Producto descontinuado</option>
        <option value='4'>Otros</option>
      </select>`,
      null,
      null
    )
    .set("labels", { ok: "Si", cancel: "No" });

  confirm.set("onok", function (r) {
    let value = $("#motivoEliminacion").val();
    if (value == null) {
      alertify.set("notifier", "position", "top-right");
      alertify.error(`Seleccione el motivo de <b>Eliminación</b>`);
      return false;
    }
    if (r) {
      $.ajax({
        method: "POST",
        url: "php/listarBatch.php",
        data: { operacion: "2", id: id, value },

        success: function (r) {
          alertify.set("notifier", "position", "top-right");
          alertify.success("Batch Record Eliminado.");
          actualizarTabla();
        },
        error: function (r) {
          alertify.set("notifier", "position", "top-right");
          alertify.error("Error al Eliminar el Batch Record.");
        },
      });
    }
  });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function (e) {
  e.preventDefault();
  editar = true;
  limpiarTanques();
  //OcultarTanques();

  if (data.estado > 2) {
    f1 = new Date();
    f2 = new Date(data.fecha_programacion);
    f1.setHours(0, 0, 0, 0);
    f2.setHours(0, 0, 0, 0);
    if (f1.getTime() == f2.getTime()) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Batch Record en proceso. No es posible actualizarlo.");
      return false;
    }
  }

  const texto = $(this).parent().parent().children()[1];
  const id = $(texto).text();

  $.ajax({
    method: "POST",
    url: "php/listarBatch.php",
    data: { operacion: "6", id: id },

    success: function (response) {
      const info = JSON.parse(response);
      const presentacion = formatoCO(info[0].presentacion_comercial);
      const tamano_lote = formatoCO(info[0].tamano_lote);
      batch = info;

      $("#idbatch").val(info[0].id_batch);
      $("#referencia").val(info[0].referencia);
      $("#nombrereferencia").val(info[0].nombre_referencia);
      $("#marca").val(info[0].marca);
      $("#propietario").val(info[0].propietario);
      $("#producto").val(info[0].nombre_referencia);
      $("#presentacioncomercial").val(presentacion);
      $("#linea").val(info[0].linea);
      $("#notificacionSanitaria").val(info[0].notificacion_sanitaria);
      $("#densidad").val(info[0].densidad);
      $("#unidadesxlote").val(info[0].unidad_lote);
      $("#tamanototallote").val(tamano_lote);
      $("#fechaprogramacion").val(info[0].fecha_programacion);
      $("#cmbNoReferencia").css("display", "none");
      $("#referencia").css("display", "block");
      $("#guardarBatch").html("Actualizar");
      $(".tcrearBatch").html("Actualizar Batch Record");
      if (info.length === 2) {
        $("#cmbTanque1").val(info[1].tanque);
        $("#txtCantidad1").val(info[1].cantidad);
        CalcularTanque(1);
      }
      $("#modalCrearBatch").modal("show");
    },
    error: function (response) {
      console.log(response);
    },
  });
});

/* Actualizar tabla */

function actualizarTabla() {
  $("#tablaBatch").DataTable().clear();
  $("#tablaBatch").DataTable().ajax.reload();
}

/* Guardar datos de Crear y Actualizar batch*/

function guardarDatos() {
  if (data !== undefined) {
    if (data.estado > 2) {
      f1 = new Date();
      f2 = new Date(data.fecha_programacion);
      f1.setHours(0, 0, 0, 0);
      f2.setHours(0, 0, 0, 0);
      if (f1.getTime() == f2.getTime()) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Batch Record en proceso. No es posible actualizarlo.");
        return false;
      }
    }
  }

  let ref = $("#cmbNoReferencia").val();
  if (ref == null) ref = $("#referencia").val();
  const id_batch = $("#idbatch").val();
  const unidades = $("#unidadesxlote").val();
  const lote = $("#tamanototallote").val();
  const tamano_lote = formatoGeneral(lote);
  const presentacion = $("#presentacioncomercial").val();
  const presentacion_comercial = formatoGeneral(presentacion);
  const programacion = $("#fechaprogramacion").val();
  const tanque = $("#cmbTanque1").val();
  const cantidades = $("#txtCantidad1").val();
  let sumaTanques = $(".sumaTanques").val();

  if (sumaTanques == "" || sumaTanques == 0) {
    $("#sumaTanques").css("border-color", "red");
    alertify.set("notifier", "position", "top-right");
    alertify.error("Configure la cantidad de Tanques para el Batch.");
    return false;
  }

  if ((cont !== 0 && sumaTanques == "") || lote == "") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese todos los datos.");
    return false;
  }

  if (!editar) {
    datos = {
      operacion: "5",
      ref,
      id_batch,
      unidades,
      lote: tamano_lote,
      presentacion: presentacion_comercial,
      programacion,
      tanque,
      cantidades,
    };
  } else {
    datos = {
      operacion: "7",
      ref,
      id_batch,
      unidades,
      lote: tamano_lote,
      programacion,
      tanque,
      cantidades,
    };
  }

  $.ajax({
    type: "POST",
    url: "php/listarBatch.php",
    data: datos,

    success: function (r) {
      if (r == 3) {
        cerrarModal();
        alertify.set("notifier", "position", "top-right");
        alertify.error(
          "Batch Record en proceso. No es posible actualizarlo..."
        );
      } else {
        cerrarModal();
        actualizarTabla();
        alertify.set("notifier", "position", "top-right");
        alertify.success("Batch Record registrado con éxito.");
      }
    },
    error: function (r) {
      alertify.set("notifier", "position", "top-right");
      alertify.error("Error al registrar el Batch Record.");
    },
  });
}
