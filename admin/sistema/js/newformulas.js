let materialSelect;

$("#verMateriasPrimas").click(function (e) {
  e.preventDefault();
  $("#materiasprimas").toggle(1000);
});

/* Cargue select referencias */

$.ajax({
  method: "POST",
  url: "php/desarrollo/newformulas.php",
  data: { operacion: "1" },

  success: function (response) {
    let info = JSON.parse(response);
    let $selectProductos = $("#cmbReferenciaProductos");
    const array = $.map(info, function (value, index) {
      return [value];
    });
    cargarSelect(array, $selectProductos);
  },
  error: function (response) {
    console.log(response);
  },
});

/* cargar Selects */

const cargarSelect = (data, select) => {
  select.empty();
  select.append(`<option disabled selected>Seleccione</option>`);
  $.each(data, function (i, value) {
    select.append(`<option value ="${value}">${value}</option>`);
  });
};

/* Cargue de Parametros de Control en DataTable */

const cargarMateriaPrima = () => {
  tabla = $("#tblMateriasPrimas").DataTable({
    destroy: true,
    scrollY: "40vh",
    scrollCollapse: true,
    paging: false,
    language: { url: "admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/desarrollo/newformulas.php",
      data: { operacion: "2" },
      dataSrc: "",
    },
    columns: [{ data: "referencia" }, { data: "nombre" }],
  });
};

cargarMateriaPrima();

$(`#tblMateriasPrimas tbody`).on("click", "tr", function () {
  materialSelect = tabla.row(this).data();
  cargartblMateriaprima();
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
  } else {
    tabla.$("tr.selected").removeClass("selected");
    $(this).addClass("selected");
  }
});

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
      $("#txtnombreProducto").val(info.nombre_referencia);
    },
  });
});

/* Cargar Materia prima a guardar con la seleccion de la referencia */
let sum = 0;
const cargartblMateriaprima = () => {
  const t = $("#tblFormula").DataTable();
  alertify.prompt(
    "Formula",
    "Ingrese el valor del porcentaje",
    "",
    function (evt, value) {
      sum = sum + parseFloat(value);
      t.row
        .add([
          materialSelect.referencia,
          materialSelect.nombre,
          value,
          `<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`,
        ])
        .draw(false);
      $("#totalPorcentajeFormulas").val(sum);
      if (sum > 100) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("La formula sobrepasa el 100%");
      }
    },
    function () {
      alertify.error("Cancel");
    }
  );
};

/* Calcular la suma de los porcentajes */
//const t = $("#tblFormula").DataTable();

/* Almacenar Registros */

function guardarFormulaMateriaPrima() {
  //let operacion = $("input:radio[name=formula]:checked").val();
  let operacion = 6;
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

  $.ajax({
    type: "POST",
    url: "php/c_formulas.php",
    data: {
      operacion,
      ref_producto,
      ref_materiaprima,
      porcentaje,
      tbl,
      editar,
    },

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

/* Borrar registros */

$(document).on("click", ".link-borrar", function (e) {
  e.preventDefault();
  let porcentaje = $(this).parent().parent().children().eq(2).text();

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
      const t = $("#tblFormula").DataTable();
      sum = sum - parseFloat(porcentaje);
      $("#totalPorcentajeFormulas").val(sum);
      t.row(":eq(0)").remove().draw();
      alertify.set("notifier", "position", "top-right");
      alertify.success("Eliminado");
    }
  });
});

/* Actualizar tabla */

function refreshTable() {
  $("#tblFormula").DataTable().clear();
  $("#tblFormula").DataTable().ajax.reload();
}
