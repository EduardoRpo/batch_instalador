/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_explosion').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_explosion').show()

$('#tblExplosionMaterialesBatch').dataTable({
    pageLength: 50,
    order: [
        [1, 'desc']
    ],
    dom: 'Bfrtip',
    order: [
        [0, 'asc']
    ],
    ajax: {
        url: '/api/explosionMaterialesBatch',
        dataSrc: '',
    },
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
    },
    columns: [{
            title: 'No.',
            "data": null,
            className: 'uniqueClassName',
            "render": function(data, type, full, meta) {
                return meta.row + 1;
            }
        },
        {
            title: 'Referencia',
            data: 'id_materiaprima',
        },
        {
            title: 'Materia Prima',
            data: 'nombre',
        },
        {
            title: 'Cantidad (Kg)',
            data: 'cantidad',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 3)
        },
        {
            title: 'Uso (Kg)',
            data: 'uso',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 3)
        },
    ],
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
            data;

        // converting to interger to find total
        var intVal = function(i) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '') * 1 :
                typeof i === 'number' ?
                i : 0;
        };

        // computing column Total of the complete result 
        var CantidadMP = api
            .column(3)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var UsoMP = api
            .column(4)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer by showing the total with the reference of the column index 
        $(api.column(2).footer()).html('Total');
        $(api.column(3).footer()).html(CantidadMP.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));
        $(api.column(4).footer()).html(UsoMP.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));

    },
})