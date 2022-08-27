$("#cmbReferenciaProductos").change(function (e) {
    e.preventDefault();
    let referencia = $("select option:selected").val();
  
    tabla = $('#tabla_bases_instructivo').DataTable({
      destroy: true,
      scrollY: "50vh",
      scrollCollapse: true,
      paging: false,
      language: { url: "admin_componentes/es-ar.json" },
  
      ajax: {
        url: `/api/getNameBase/${referencia}`,
        dataSrc: '',
      },    
      language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
  
      columns: [
        {
          defaultContent:
            "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
        },
        { data: "id",
          title:"id" },
        { data: "pasos",
          title: "pasos"},
        { data: "tiempo", className: "centrado",
      title:"tiempo" },
      ],
  });
  });