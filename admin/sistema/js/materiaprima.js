let editar;

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_materia_prima").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

/* Cargue de Parametros de Control en DataTable */

tablamp = $("#tblMateriaPrima").DataTable({
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
        "<a href='#' <i class='large material-icons link-editar-mp' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar-mp' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
      className: "centrado",
    },
    { data: "referencia", className: "centrado" },
    { data: "nombre" },
    { data: "alias" },
  ],
});

/* Enumera los registros en la tabla */

tablamp
  .on("order.dt search.dt", function () {
    tablamp
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
  $("#txtCodigo").prop("disabled", false);
});

/* Borrar registros */

$(document).on("click", ".link-borrar-mp", function (e){
  let id = this.id;
  let confirm = alertify
  .confirm(
      "Samara Cosmetics",
      "¿Está seguro de eliminar este registro?",
      null,
      null
  )
  .set("labels", { ok: "Si", cancel: "No" });

confirm.set("onok", function(r) {
  if (r) {
      $.ajax({
          url: `/api/deleteRawMateria/${id}`,
          success: function(data) {
              notificaciones(data);
          },
      });
  }
});
})

$(document).on("click", ".link-borrar-mpf", function(e){
  let id = this.id;
  let confirm = alertify
  .confirm(
      "Samara Cosmetics",
      "¿Está seguro de eliminar este registro?",
      null,
      null
  )
  .set("labels", { ok: "Si", cancel: "No" });


confirm.set("onok", function(r) {
  if (r) {
      $.ajax({
          url: `/api/deleteRawMaterialP/${id}`,
          success: function(data) {
              notificaciones(data);
          },
      });
  }
});
})
/*
$(document).on("click", ".link-borrar-mp", function (e) {
  e.preventDefault();
  tbl = 1;
  let id = $(this).parent().parent().children().eq(2).text();
  eliminarRegistro(id, tbl);
});

$(document).on("click", ".link-borrar-mpf", function (e) {
  tbl = 0;
  let id = $(this).parent().parent().children().eq(2).text();
  eliminarRegistro(id, tbl);
});

const eliminarRegistro = (id, tbl) => {
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
        data: { operacion: "2", id: id, tbmateriaPrima: tbl },
      });
      refreshTable();
      alertify.success("Registro Eliminado");
    }
  });
};
*/
/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar-mp", function (e) {
  e.preventDefault();
  rb = 1;
  let referencia = $(this).parent().parent().children().eq(2).text();
  let materiaprima = $(this).parent().parent().children().eq(3).text();
  let alias = $(this).parent().parent().children().eq(4).text();
  editarmp(rb, referencia, materiaprima, alias);
});

$(document).on("click", ".link-editar-mpf", function (e) {
  e.preventDefault();
  rb = 0;
  let referencia = $(this).parent().parent().children().eq(2).text();
  let materiaprima = $(this).parent().parent().children().eq(3).text();
  let alias = $(this).parent().parent().children().eq(4).text();
  editarmp(rb, referencia, materiaprima, alias);
});

const editarmp = (rb, referencia, materiaprima, alias) => {
  if (rb == 1) $("#mp").prop("checked", true);
  else $("#mpf").prop("checked", true);
  $("#txtCodigo").prop("disabled", true);
  $("#frmAdicionarMateriaPrima").slideDown();
  $("#txtId").val(rb);
  $("#txtCodigo").val(referencia);
  $("#txtMP").val(materiaprima);
  $("#txtAlias").val(alias);
  $("#btnguardarMateriaPrima").html("Actualizar");
};
/* Almacenar Registros */

$("#btnguardarMateriaPrima").click(function (e) {
  e.preventDefault();

  let ref = $("#txtCodigo").val();
  let materiaprima = $("#txtMP").val();
  let alias = $("#txtAlias").val();
  let tbmateriaPrima;
  if ($("#mp").prop("checked")) tbmateriaPrima = $("#mp").val();
  if ($("#mpf").prop("checked")) tbmateriaPrima = $("#mpf").val();

  if (
    ref == "" ||
    materiaprima == "" ||
    alias == "" ||
    tbmateriaPrima == undefined
  ) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese todos los datos.");
    return false;
  }

  $.ajax({
    type: "POST",
    url: "/api/save",
    data: { referencia:ref, materiaprima:materiaprima, alias:alias, controller:rb },

    success: function (data) {
      notificaciones(data);
    },
  });
});

/* Actualizar tabla */

function refreshTable() {
  $("#tblMateriaPrima").DataTable().clear();
  $("#tblMateriaPrima").DataTable().ajax.reload();
  $("#tblMateriaPrimaf").DataTable().clear();
  $("#tblMateriaPrimaf").DataTable().ajax.reload();
  $("#txtCodigo").val("");
  $("#txtMP").val("");
  $("#txtAlias").val("");
}

