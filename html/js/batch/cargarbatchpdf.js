/* Mostrar Batch para Impresion */

$(".pdf").click(function (e) {
  e.preventDefault();
  $("#m_batch_pdf").modal();
  /* $("#tabla_batch_pdf").dataTable().fnDestroy();
  cargartablabatch_pdf(); */
});

$("#buscar_batch").click(function (e) {
  e.preventDefault();
  v = $("#search").val();
  $.get(
    "../../../admin/sistema/php/certificado.php",
    { data: v },
    function (data, textStatus, jqXHR) {
      if ((textStatus = "success")) {
        data = JSON.parse(data);
        if (data) {
          $("#search").val("");
          $("#batchpdf").html(`Batch: ${data[0].id_batch}`);
          $("#ref").html(data[0].referencia);
          $("#prod").html(data[0].nombre_referencia);
          $("#lote").html(data[0].numero_lote);
          $("#accions").empty();
          $("#accions").append(
            `<a href="/pdf/${data[0].id_batch}/${data[0].referencia}" target="_blank"><i class="fas fa-external-link-alt"></i></a>`
          );
        } else {
          alertify.set("notifier", "position", "top-right");
          alertify.error("Valor buscado no existe.");
          $("#search").val("");
          $("#batchpdf").html("");
          $("#ref").html("");
          $("#prod").html("");
          $("#lote").html("");
          $("#accions").empty();
          $("#accions").append("");
        }
      }
    }
  );
});

$('[data-toggle="popover"]').popover();

/* Cargar tabla de eliminados */

/* function cargartablabatch_pdf() {
  $("#tabla_batch_pdf").DataTable({
        responsive: true,
    scrollCollapse: true,
    
    language: { url: "/admin/sistema/admin_componentes/es-ar.json" },

    ajax: {
      method: "POST",
      url: "php/servicios/c_batch_pdf.php",
      data: { operacion: 1 },
      dataSrc: "",
      order: [[1, "desc"]],
    },

    columns: [
      { data: "id_batch" },
      { data: "numero_orden", className: "centrado" },
      { data: "numero_lote", className: "centrado" },
      {
        data: "tamano_lote",
        render: $.fn.dataTable.render.number(".", ",", 0, ""),
      },
      { data: "id_producto" },
      {
        data: "lote_presentacion",
        render: $.fn.dataTable.render.number(".", ",", 0, ""),
      },
      {
        data: "unidad_lote",
        render: $.fn.dataTable.render.number(".", ",", 0, ""),
      },
      { data: "fecha_creacion", className: "centrado" },
      { data: "fecha_programacion", className: "centrado" },
      {
        defaultContent:
          "<a href='#' <i class='fa fa-file-text fa-2x link-ver' data-toggle='tooltip' title='Ver Batch Record' style='color:green;'></i></a>   <a href='#' <i class='fa fa-print fa-2x link-imprimir' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>",
      },
    ],
  });
} */

/* Visualizar pdf */

/* $(document).on("click", ".link-ver", function (e) {
  e.preventDefault();
  let id = $(this).parent().parent().children().first().text();
  let referencia = $(this).parent().parent().children().eq(4).text();

  $.ajax({
    type: "POST",
    url: "../../html/php/busqueda_multipresentacion.php",
    data: { idBatch: id },

    success: function (response) {
      data = JSON.parse(response);
      sessionStorage.setItem("id", id);
      sessionStorage.setItem("referencia", referencia);
      sessionStorage.setItem("multi", JSON.stringify(data));
      window.open("../html/pdf/formato.php", "_blank");
    },
  });
}); */

/* Imprimir pdf */

/* $(document).on("click", ".link-imprimir", function (e) {
  e.preventDefault();
  window.print();
  return false;
});
 */
