let flagWeight = false;

function cargar(btn, idbtn) {
  localStorage.setItem("idbtn", idbtn);
  id = btn.id;

  //Validacion de control de tanques
  if (
    id == "pesaje_realizado" ||
    id == "preparacion_realizado" ||
    id == "aprobacion_realizado"
  ) {
    validar = controlTanques();
    if (validar == 0) {
      return false;
    }
  }

  /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

  let seleccion = $("#sel_producto_desinfeccion").val();

  if (seleccion == "Seleccione") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione el producto para desinfección.");
    return false;
  }

  /* Carga el modal para la autenticacion */

  $("#usuario").val("");
  $("#clave").val("");
  $("#m_firmar").modal("show");
}

/* habilitar botones */

function habilitarbotones() {
  $(".pesaje_realizado").prop("disabled", false);
}

/* Carga de Cargos  */

$.ajax({
  url: `../../api/cargos`,
  type: "GET",
}).done((data, status, xhr) => {
  data.forEach((cargo, indx) => {
    $(`#cargo-${indx + 1}`).val(cargo.cargo);
  });
});

/* Exportar Datatable Materia Prima */
/* Formula Materia Prima  */

$(document).ready(function () {
  batch_record();
  tablePesaje = $("#tablePesaje").dataTable({
    ajax: {
      url: `../../api/materiasp/${referencia}`,
      dataSrc: "",
    },
    paging: false,
    info: false,
    searching: false,
    sorting: false,

    columns: [
      {
        title: "Referencia",
        data: "referencia",
        className: "uniqueClassName",
      },
      {
        title: "Materia Prima",
        data: "alias",
        className: "uniqueClassName",
      },
      {
        title:
          'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
        className: "conversion_weight_column",
        data: "porcentaje",
        className: "uniqueClassName",

        render: (data, type, row) => {
          let tnq = $("#Notanques").val();

          if (tnq === "") {
            $("#Notanques").val(tanques).prop("disabled", true);
          }

          if (flagWeight) {
            return ((data / 100) * batch.tamano_lote)
              .toFixed(2)
              .replace(".", ",");
          } else {
            return ((data / 100) * batch.tamano_lote * 1000)
              .toFixed(2)
              .replace(".", ",");
          }
        },
      },
      {
        title:
          '<input type="text" class="form-control" id="Notanques" placeholder="Tanques" style="width:52px; text-align:center" onkeydown="calcularxNoTanques();">',
        data: "porcentaje",
        className: "uniqueClassName",
        render: (data, type, row) => {
          if (flagWeight) {
            return (((data / 100) * batch.tamano_lote) / $("#Notanques").val())
              .toFixed(2)
              .replace(".", ",");
          } else {
            return (
              ((data / 100) * batch.tamano_lote * 1000) /
              $("#Notanques").val()
            )
              .toFixed(2)
              .replace(".", ",");
          }
        },
      },
      {
        title: "Impresión",
        data: "",
        className: "uniqueClassName",
        render: (data, type, row) => {
          return `<a id="${row.referencia}" href="#" onclick="imprimirEtiquetas(this);"><i class="large material-icons">print</i></a>`;
          /* return `<a id="${row.referencia}" href="#" data-toggle="modal" data-target="#imprimirEtiquetas"><i class="large material-icons">print</i></a>` */
        },
      },
    ],

    dom: "Bfrtip",
    buttons: [
      /* $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ), */

      $.extend(
        true,
        {},
        {
          extend: "pdfHtml5",
          text: "Exportar PDF",
          title: "DISPENSACIÓN ", //+ batch.numero_orden,

          //messageTop: 'Ingrese el número de Tanque   _____ ', //VALIDAR PARA QUE SE PREGUNTE EL NÚMERO DE TANQUE

          exportOptions: {
            columns: [0, 1, 3],
          },
        }
      ),
    ],
  });

  /* Seleccion multiple */
  tablePesaje.on("click", "tbody tr", function () {
    $(this).toggleClass("tr_hover ");
  });
});

Date.prototype.toDateInputValue = function () {
  var local = new Date(this);
  local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
  return local.toJSON().slice(0, 10);
};

$("#in_fecha_pesaje").val(new Date().toDateInputValue());
$("#in_fecha_pesaje").attr("min", new Date().toDateInputValue());

//Conversion medidas de peso

function cambioConversion() {
  flagWeight = !flagWeight;
  tablePesaje.api().ajax.reload();
  $(tablePesaje.api().column(2).header()).html(
    `Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${
      flagWeight ? "Kg" : "g"
    }</a>)`
  );
}

/* Calcular los tanques */

function calcularxNoTanques() {
  let tanques = $("#Notanques").val();

  if (tanques < 11) {
    tablePesaje.api().ajax.reload();
  } else {
    $("#Notanques").val(1);
    alertify.set("notifier", "position", "top-right");
    alertify.error("El número de Tanques debe ser menor a 11.");
    return false;
  }
}

/* imprimir etiquetas virtuales */

$(document).ready(function () {
  $("#imprimirEtiquetasVirtuales").click(function () {
    window.frames["printf"].focus();
    window.frames["printf"].print();
  });
});

function deshabilitarbtn() {
  $(".pesaje_realizado")
    .css({ background: "lightgray", border: "gray" })
    .prop("disabled", true);
  $(".pesaje_verificado").prop("disabled", false);
}
