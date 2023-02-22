/* Mostrar Batch Eliminados */

function batchEliminados() {
  $("#m_batchEliminados").modal();
  $("#tablabatchEliminados").dataTable().fnDestroy();
  cargartablaEliminados();
}

/* Cargar tabla de eliminados */

function cargartablaEliminados() {
  $("#tablabatchEliminados").DataTable({
    responsive: true,
    scrollCollapse: true,
    language: { url: "/admin/sistema/admin_componentes/es-ar.json" },

    ajax: {
      url: "/api/batchEliminados",
      dataSrc: '',
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
      { data: "fecha_eliminacion", className: "centrado" },
      {
        data: "motivo",
        className: "centrado",
        render: (data, type, row) => {
          if (data == "1") return "Cancelado por el usuario";
          if (data == "2") return "Falta de Materia Prima o Insumos";
          if (data == "3") return "Producto Descontinuado";
          if (data == "4") return "Otros";
          if (data == "5") return "Por prueba preinicio";
          else return " ";
        },
      },
    ],
  });
}
