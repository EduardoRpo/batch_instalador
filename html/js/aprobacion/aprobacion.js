$("#aprobacionTable").dataTable({
  pageLength: 50,
  order: [[1, "desc"]],
  ajax: {
    url: "/api/aprobacion",
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
      title: "No de Orden",
      data: "numero_orden",
      className: "uniqueClassName",
    },
    {
      title: "Referencia",
      data: "referencia",
      className: "uniqueClassName",
    },
    {
      title: "Nombre Referencia",
      data: "nombre_referencia",
      className: "uniqueClassName",
    },
    {
      title: "No Lote",
      data: "numero_lote",
      className: "uniqueClassName",
    },
    {
      title: "Firmas",
      data: "cantidad_firmas",
      className: "uniqueClassName",
    },
    {
      title: "Ingresar",
      className: "uniqueClassName",
      data: "",
      render: (data, type, row) => {
        "use strict";
        return `<a href="aprobacioninfo/${row.id_batch}/${row.referencia}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">check_circle</i></a>`;
      },
    },
  ],
});
