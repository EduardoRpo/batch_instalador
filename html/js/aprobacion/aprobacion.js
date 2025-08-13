$("#aprobacionTable").dataTable({
  pageLength: 50,
  order: [[1, "desc"]],
  ajax: {
    url: "php/aprobacion_fetch.php",
    type: "POST",
    dataSrc: "data",
  },
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
  },
  columns: [
    {
      title: "Batch",
      data: 0,
      className: "uniqueClassName",
    },
    {
      title: "Fecha Programación",
      data: 1,
      className: "uniqueClassName",
    },
    {
      title: "No de Orden",
      data: 2,
      className: "uniqueClassName",
    },
    {
      title: "Referencia",
      data: 3,
      className: "uniqueClassName",
    },
    {
      title: "Nombre Referencia",
      data: 4,
      className: "uniqueClassName",
    },
    {
      title: "No Lote",
      data: 5,
      className: "uniqueClassName",
    },
    {
      title: "Firmas G",
      data: 6,
      className: "uniqueClassName",
    },
    {
      title: "Firmas T",
      data: 7,
      className: "uniqueClassName",
    },
    {
      title: "Ingresar",
      className: "uniqueClassName",
      data: 0,
      render: (data, type, row) => {
        "use strict";
        return `<a href="aprobacioninfo/${row[0]}/${row[3]}"><i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">check_circle</i></a>`;
      },
    },
  ],
});
