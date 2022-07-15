/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_preguntas").css("background", "coral");
$(".contenedor-menu .menu ul.menu_generales").show();

/* Cargue de Preguntas en DataTable */

$(document).ready(function () {
  tabla = $("#tblPreguntas").DataTable({
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/c_preguntas.php",
      data: { operacion: "1" },
    },

    columns: [
      { data: "id", className: "centrado" },
      {
        defaultContent: `<a id ="1" href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> 
             <a id = "2" href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`,
      },
      { data: "pregunta" },
    ],
  });
  /* Enumera los registros en la tabla */

  /* tabla
    .on("order.dt search.dt", function () {
      tabla
        .column(0, { search: "applied", order: "applied" })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw(); */
});

/* Mostrar formulario adicionar preguntas */

$("#adicionarParametro").click(function (e) {
  e.preventDefault();
  editar = 0;
  $("#frmadicionarPregunta").slideToggle();
  $("#txtIdPregunta").val("");
  $("#txtPregunta").val("");
  $("#btnAlmacenarPregunta").html("Crear");
});

/* Cargar datos para Actualizar registros */

$("#tblPreguntas tbody").on("click", "tr", function () {
  datos = tabla.row(this).data();
});

$(document).on("click", ".link-editar", function (e) {
  e.preventDefault();

  let id = $(this).parent().parent().children().eq(0).text();
  let pregunta = $(this).parent().parent().children().eq(2).text();

  $("#frmadicionarPregunta").slideDown();
  $("#btnAlmacenarPregunta").html("Actualizar");

  $("#txtIdPregunta").val(id);
  $("#txtPregunta").val(pregunta);
});

/* Borrar registros */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();

  const id = $(this).parent().parent().children().eq(0).text();
  var confirm = alertify
    .confirm(
      "Samara Cosmetics",
      "¿Está seguro de eliminar este registro?",
      null,
      null
    )
    .set("labels", { ok: "Si", cancel: "No" });

  confirm.set("onok", function (r) {
    if (r) {
      $.ajax({
        method: "POST",
        url: "php/c_preguntas.php",
        data: { operacion: "2", id },
      });
      refreshTable();
      alertify.success("Registro Eliminado");
    }
  });
});

/* Almacenar Registros */

$("#btnAlmacenarPregunta").click(function (e) {
  e.preventDefault();

  let id = $("#txtIdPregunta").val();
  let pregunta = $("#txtPregunta").val();

  $.ajax({
    type: "POST",
    url: "php/c_preguntas.php",
    data: { operacion: 3, id, pregunta },

    success: function (r) {
      if (r == 1) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Almacenado con éxito.");
        refreshTable();
      } else if (r == 3) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro actualizado.");
        refreshTable();
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Error. Intentelo nuevamente");
      }
    },
  });
});

/* Actualizar tabla */

function refreshTable() {
  $("#tblPreguntas").DataTable().clear();
  $("#tblPreguntas").DataTable().ajax.reload();
  $("#txtIdPregunta").val("");
  $("#txtPregunta").val("");
  $("#btnAlmacenarPregunta").html("Adicionar");
}
