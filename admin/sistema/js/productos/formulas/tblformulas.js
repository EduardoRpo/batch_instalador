cargarTablaTodasFormulas = (referencia) => {
    tabla = $('#tblFormulastodas').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        oLanguage: { sProcessing: "<div id='loader'></div>" },
        dom: 'Bfrtip',
        order: [
            [0, 'asc']
        ],
        buttons: [{
            extend: 'excel',
            className: 'btn btn-primary',
            exportOptions: {
                columns: [0, 1, 2, 4],
            },
        }, ],
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            url: `/api/formulatbl/${ referencia }`,
            dataSrc: '',
        },

        columns: [
            { title: 'Producto', data: 'id_producto' },
            { title: 'Referencia MP', data: 'referencia' },
            { title: 'Materia prima', data: 'nombre' },
            { title: 'Alias', data: 'alias' },
            {
                title: '%',
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                title: 'Acciones',
                defaultContent: "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],
    })
}
/* Cargue de Parametros de Control en DataTable */

cargarTablaFormulas = (referencia) => {
    tabla = $('#tblFormulas').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        /* dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excel',
            className: 'btn btn-primary',
            exportOptions: {
              columns: [0, 3],
            },
          },
        ], */
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            url: `/api/formulatbl/${ referencia }`,
            dataSrc: '',
        },

        columns: [
            { title: 'Referencia', data: 'referencia' },
            { title: 'Materia prima', data: 'nombre' },
            { title: 'Alias', data: 'alias' },
            {
                title: '%',
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                title: 'Acciones',
                defaultContent: "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],

        footerCallback: function(row, data, start, end, display) {
            total = this.api()
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b)
                }, 0)
            total = total.toFixed(2)
            $('#totalPorcentajeFormulas').val(`Total ${total}%`)
        },
    })
}
/* Cargue de Parametros de Control en DataTable */

cargar_formulas_f =(referencia) => {
    tabla = $('#tbl_formulas_f').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            url: `/api/formulaInvimatbl/${referencia}`,
            dataSrc: '',
        },

        columns: [
            { data: 'referencia' },
            { data: 'nombre' },
            { data: 'alias' },
            {
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                defaultContent: "<a href='#' <i class='large material-icons link-editar tf' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a><a href='#' <i class='large material-icons link-borrar tf' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],

        footerCallback: function(row, data, start, end, display) {
            total = this.api()
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b)
                }, 0)
            total = total.toFixed(2)
            $('#totalPorcentajeFormulasInvima').val(`Total ${total}%`)
        },
    })
}