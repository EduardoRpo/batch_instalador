$(document).ready(function () {
  $("#tblLiberacionLote").DataTable({
    pageLength: 50,
    order: [[0, "desc"]],

    ajax: {
      url: "/api/liberacionlote",
      dataSrc: "",
    },
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },

    columns: [
      {
        title: "Batch",
        data: "id_batch",
        className: "uniqueClassName",
      },
      {
        title: "Fecha Programación",
        data: "fecha_programacion",
        className: "uniqueClassName",
      },
      {
        title: "No Orden",
        data: "numero_orden",
        className: "uniqueClassName",
      },
      {
        title: "Referencia",
        data: "referencia",
        className: "uniqueClassName",
      },
      {
        title: "No Lote",
        data: "numero_lote",
        className: "uniqueClassName",
      },
      {
        title: "Firmas G",
        data: "cantidad_firmas",
        className: "uniqueClassName",
      },
      {
        title: "Firmas T",
        data: "total_firmas",
        className: "uniqueClassName",
      },
      {
        title: "Ingresar",
        data: "",
        className: "uniqueClassName",
        render: (data, type, row) => {
          return `<a href="liberacionloteinfo/${row.id_batch}/${row.referencia}" <i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">format_color_fill</i></a>`;
        },
      },
    ],
  });
  //table.destroy();
});
