var tabla;
var editar;

/* Mostrar Menu seleccionadp */

$(".contenedor-menu .menu a").removeAttr("style");
$("#link_formulas").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

/* Cargue select referencias */

//function cargarSelectorModulo() {

$.ajax({
  method: "POST",
  url: "php/c_formulas.php",
  data: { operacion: "1" },

  success: function (response) {
    var info = JSON.parse(response);

    let $selectProductos = $("#cmbReferenciaProductos");

    $selectProductos.empty();
    $selectProductos.append(
      "<option disabled selected>" + "Referencia" + "</option>"
    );

    $.each(info.data, function (i, value) {
      $selectProductos.append(
        '<option value ="' +
          value.referencia +
          '">' +
          value.referencia +
          "</option>"
      );
    });
  },
  error: function (response) {
    console.log(response);
  },
});
//}

/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$("#cmbReferenciaProductos").change(function (e) {
  e.preventDefault();
  let seleccion = $("select option:selected").val();

  $.ajax({
    type: "POST",
    url: "php/c_formulas.php",
    data: { operacion: "2", referencia: seleccion },

    success: function (response) {
      var info = JSON.parse(response);
      $("#txtnombreProducto").val("");
      $("#txtnombreProducto").val(info.data[0].nombre_referencia);
    },
  });

  cargarTablaFormulas(seleccion);
  cargar_formulas_f(seleccion);
});

/* Cargue de Parametros de Control en DataTable */

function cargarTablaFormulas(referencia) {
  tabla = $("#tblFormulas").DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/c_formulas.php",
      data: { operacion: "3", referencia },
    },

    columns: [
      { data: "referencia" },
      { data: "nombre" },
      { data: "alias" },
      {
        data: "porcentaje",
        className: "centrado",
        render: $.fn.dataTable.render.number(",", ".", 3, "", "%"),
      },
      {
        defaultContent:
          "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
      },
    ],
    columnDefs: [{ width: "10%", targets: 0 }],
  });
}

/* Cargue de Parametros de Control en DataTable */

function cargar_formulas_f(referencia) {
  tabla = $("#tbl_formulas_f").DataTable({
    destroy: true,
    scrollY: "50vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/c_formulas.php",
      data: { operacion: "9", referencia },
    },

    columns: [
      { data: "referencia" },
      { data: "nombre" },
      { data: "alias" },
      {
        data: "porcentaje",
        className: "centrado",
        render: $.fn.dataTable.render.number(",", ".", 3, "", "%"),
      },
      {
        defaultContent:
          "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a><a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
      },
    ],
    columnDefs: [{ width: "10%", targets: 0 }],

    footerCallback: function (row, data, start, end, display) {
      var api = this.api(),
        data;

      // Remove the formatting to get integer data for summation
      /* var intVal = function (i) {
        return typeof i === "string"
          ? i.replace(/[\$,]/g, "") * 1
          : typeof i === "number"
          ? i
          : 0;
      }; */

      // Total over all pages
      total = api
        .column(4)
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Total over this page
      pageTotal = api
        .column(3, { page: "current" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(3).footer()).html(`${pageTotal}`);
    },
  });
}

/* Ocultar */

$("#adicionarFormula").click(function (e) {
  e.preventDefault();
  editar = 0;

  $("#frmadFormulas").slideToggle();
  $("#textReferencia").hide();
  $("#cmbreferencia").show();

  $("#txtMateria-Prima").attr("disabled", true);
  $("#alias").attr("disabled", true);

  /* Cargar datos para Adicionar Materia Prima */

  $.ajax({
    method: "POST",
    url: "php/c_formulas.php",
    data: { operacion: "4" },

    success: function (response) {
      var info = JSON.parse(response);
      let $selectReferencia = $("#cmbreferencia");

      $selectReferencia.empty();
      $selectReferencia.append(
        "<option disabled selected>" + "Seleccionar" + "</option>"
      );

      $.each(info.data, function (i, value) {
        $selectReferencia.append(
          '<option value ="' +
            value.referencia +
            '">' +
            value.referencia +
            "</option>"
        );
      });
    },
    error: function (response) {
      console.log(response);
    },
  });
});

/* Cargar Materia prima a guardar con la seleccion de la referencia */

$("#cmbreferencia").change(function (e) {
  e.preventDefault();
  let referencia = $("#cmbreferencia option:selected").text();

  $.ajax({
    type: "POST",
    url: "php/c_formulas.php",
    data: { operacion: "5", referencia: referencia },

    success: function (response) {
      var info = JSON.parse(response);
      $("#txtMateria-Prima").val(info.data[0].nombre);
      $("#alias").val(info.data[0].alias);
    },
  });
});

/* Almacenar Registros */

function guardarFormulaMateriaPrima() {
  let operacion = $("input:radio[name=formula]:checked").val();
  let ref_producto = $("#cmbReferenciaProductos").val();
  let ref_materiaprima = $("#cmbreferencia").val();
  let porcentaje = parseFloat($("#porcentaje").val());

  ref_materiaprima === null
    ? (ref_materiaprima = $("#textReferencia").val())
    : ref_materiaprima;

  if (ref_producto === null) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione la referencia");
    return false;
  }

  if (ref_materiaprima === null) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione la referencia de la materia prima");
    ref_materiaprima = $("#textReferencia").val();
    return false;
  }

  if (
    porcentaje === undefined ||
    porcentaje === null ||
    porcentaje === "" ||
    isNaN(porcentaje)
  ) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Ingrese todos los campos");
    return false;
  }

  if (operacion === undefined) {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione la tabla para insertar el dato");
    return false;
  }

  $.ajax({
    type: "POST",
    url: "php/c_formulas.php",
    data: { operacion, ref_producto, ref_materiaprima, porcentaje, editar },

    success: function (r) {
      if (r == 1) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Almacenada con éxito.");
      } else if (r == 3) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("Registro actualizado.");
        refreshTable();
      } else {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Error.");
      }

      $("#cmbreferencia").val("");
      $("#txtMateria-Prima").val("");
      $("#alias").val("");
      $("#porcentaje").val("");
      refreshTable();
    },
  });
}

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function (e) {
  e.preventDefault();

  editar = 1;
  let id = $(this).parent().parent().children().first().text();
  let mp = $(this).parent().parent().children().eq(1).text();
  let alias = $(this).parent().parent().children().eq(2).text();
  let porcentaje = $(this).parent().parent().children().eq(3).text();
  porcentaje = parseInt(porcentaje);

  $("#cmbreferencia").val("");
  $("#frmadFormulas").slideDown();
  $("#textReferencia").show();
  $("#cmbreferencia").hide();

  $("#textReferencia").val(id).prop("disabled", true);
  $("#txtMateria-Prima").val(mp).prop("disabled", true);
  $("#alias").val(alias).prop("disabled", true);
  $("#porcentaje").val(porcentaje);
});

/* Borrar registros */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();

  let ref_materiaprima = $(this).parent().parent().children().first().text();
  let ref_producto = $("#cmbReferenciaProductos").val();

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
        url: "php/c_formulas.php",
        data: {
          operacion: "8",
          ref_producto: ref_producto,
          ref_materiaprima: ref_materiaprima,
        },
      });
      refreshTable();
      alertify.set("notifier", "position", "top-right");
      alertify.success("Eliminado");
    }
  });
});

/* Actualizar tabla */

function refreshTable() {
  $("#tblFormulas").DataTable().clear();
  $("#tblFormulas").DataTable().ajax.reload();
  $("#tbl_formulas_f").DataTable().clear();
  $("#tbl_formulas_f").DataTable().ajax.reload();
}
