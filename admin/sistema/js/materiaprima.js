let editar;

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_materia_prima").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

/* Cargue de Parametros de Control en DataTable */

tabla = $("#tblMateriaPrima").DataTable({
  destroy: true,
  scrollY: "50vh",
  scrollCollapse: true,
  paging: false,
  language: { url: "admin_componentes/es-ar.json" },

  ajax: {
    method: "POST",
    url: "php/c_materiaprima.php",
    data: { operacion: "1" },
  },

  columns: [
    { data: "referencia", className: "centrado" },
    {
      defaultContent:
        "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
      className: "centrado",
    },
    { data: "referencia", className: "centrado" },
    { data: "nombre" },
    { data: "alias" },
  ],
});

/* Enumera los registros en la tabla */

tabla
  .on("order.dt search.dt", function () {
    tabla
      .column(0, { search: "applied", order: "applied" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1;
      });
  })
  .draw();

/* Ocultar */

$("#btnadicionarMateriaPrima").click(function (e) {
  e.preventDefault();
  editar = 0;
  $("#frmAdicionarMateriaPrima").slideToggle();
  $("#txtId").val("");
  $("#txtCodigo").val("");
  $("#txtMP").val("");
  $("#txtAlias").val("");
  $("#btnguardarMateriaPrima").html("Crear");
});

/* Borrar registros */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();

  let id = $(this).parent().parent().children().eq(2).text();
  let confirm = alertify
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
        url: "php/c_materiaprima.php",
        data: { operacion: "2", id: id },
      });
      refreshTable();
      alertify.success("Registro Eliminado");
    }
  });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function (e) {
  e.preventDefault();
  
  let referencia = $(this).parent().parent().children().eq(2).text();
  let materiaprima = $(this).parent().parent().children().eq(3).text();
  let alias = $(this).parent().parent().children().eq(4).text();

  $("#txtCodigo").prop("disabled", true);
  $("#frmAdicionarMateriaPrima").slideDown();
  $("#txtId").val(referencia);
  $("#txtCodigo").val(referencia);
  $("#txtMP").val(materiaprima);
  $("#txtAlias").val(alias);
  $("#btnguardarMateriaPrima").html("Actualizar");
});

/* Almacenar Registros */

$("#btnguardarMateriaPrima").click(function (e) {
  e.preventDefault();
  let id = $("#txtId").val();
  let ref = $("#txtCodigo").val();
  let materiaprima = $("#txtMP").val();
  let alias = $("#txtAlias").val();

  if (ref == "" || materiaprima == "" || alias == "") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese todos los datos.");
    return false;
  }

  $.ajax({
    type: "POST",
    url: "php/c_materiaprima.php",
    data: { operacion: 3, editar, id, ref, materiaprima, alias },

    success: function (r) {
      if (r == 1) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Almacenado con éxito.");
        refreshTable();
      } else if (r == 2) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El número de referencia ya existe.");
      } else if (r == 3) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro actualizado.");
        refreshTable();
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Error.");
      }
    },
  });
});

/* Actualizar tabla */

function refreshTable(tabla) {
  $("#tblMateriaPrima").DataTable().clear();
  $("#tblMateriaPrima").DataTable().ajax.reload();
}
