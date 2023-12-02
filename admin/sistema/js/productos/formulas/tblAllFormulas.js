$(document).ready(function () {
  cargarTablaTodasFormulas = () => {
    tabla = $("#tblFormulastodas").DataTable({
      destroy: true,
      scrollY: "50vh",
      scrollCollapse: true,
      paging: false,
      oLanguage: { sProcessing: "<div id='loader'></div>" },
      dom: "Bfrtip",
      order: [[0, "asc"]],
      buttons: [
        {
          extend: "excel",
          className: "btn btn-primary",
          exportOptions: {
            columns: [0, 1, 2, 4],
          },
        },
      ],
      language: { url: "admin_componentes/es-ar.json" },

      ajax: {
        url: "/api/formulatbl",
        dataSrc: "",
      },

      columns: [
        { title: "Producto", data: "id_producto" },
        { title: "Referencia MP", data: "referencia" },
        { title: "Materia prima", data: "nombre" },
        { title: "Alias", data: "alias" },
        {
          title: "%",
          data: "porcentaje",
          className: "centrado",
          render: $.fn.dataTable.render.number(",", ".", 3, "", "%"),
        },
        {
          title: "Acciones",
          defaultContent:
            "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
        },
      ],
      columnDefs: [{ width: "10%", targets: 0 }],
    });
  };

  cargarTablaTodasFormulasF = () => {
    tabla = $("#tblFormulastodasf").DataTable({
      destroy: true,
      scrollY: "50vh",
      scrollCollapse: true,
      paging: false,
      oLanguage: { sProcessing: "<div id='loader'></div>" },
      dom: "Bfrtip",
      order: [[0, "asc"]],
      buttons: [
        {
          extend: "excel",
          className: "btn btn-primary",
          exportOptions: {
            columns: [0, 1, 2, 4],
          },
        },
      ],
      language: { url: "admin_componentes/es-ar.json" },

      ajax: {
        url: "/api/formulatblf",
        dataSrc: "",
      },

      columns: [
        { title: "Notificacion Sanitaria", data: "notificacion" },
        { title: "Id Notificacion", data: "notif_sanitaria" },
        { title: "Materia prima", data: "MP" },
        { title: "Alias", data: "alias" },
        {
          title: "%",
          data: "porcentaje",
          className: "centrado",
          render: $.fn.dataTable.render.number(",", ".", 3, "", "%"),
        },
        {
          title: "Acciones",
          defaultContent:
            "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
        },
      ],
      columnDefs: [{ width: "10%", targets: 0 }],
    });
  };
});
