let selectedFile

/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_explosion_consolidado').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_explosion').show()

$('.excelImportar').hide()

$('#btnCargarExcel').click(function(e) {
    e.preventDefault()
    $('.excelImportar').toggle(600)
})

/* Importar pedidos */

$('#importarFile').on('click', function(e) {
    if (selectedFile) {
        let fileReader = new FileReader()
        fileReader.readAsBinaryString(selectedFile)

        fileReader.onload = (e) => {
            let data = e.target.result
            let workbook = XLSX.read(data, { type: 'binary' })

            workbook.SheetNames.forEach((sheet) => {
                let rowObject = XLSX.utils.sheet_to_row_object_array(
                    workbook.Sheets[sheet],
                )
                data = rowObject

                $.ajax({
                    type: 'POST',
                    url: '../../../admin/sistema/php/explosion_materiales/pedidos.php',
                    data: { data: data },
                    beforeSend: function() {
                        $('#uploadStatus').html(
                            '<img src="images/uploading.gif" style="height:100px"/>',
                        )
                    },
                    error: function() {
                        $('#uploadStatus').html(
                            '<span style="color:#EA4335;">No se importó el archivo correctamente, trate nuevamente.<span>',
                        )
                    },
                    success: function(response) {
                        $('#uploadStatus').html(
                            '<span style="color:#28A74B;">Datos importados correctamente.<span>',
                        )
                        $('#fileInput').val('')
                        setTimeout(() => {
                            $('.excelImportar').toggle(600)
                        }, 700)
                    },
                })
            })
        }
    }
})

// File type validation
$('#fileInput').change(function(e) {
    selectedFile = e.target.files[0]
    archivo = $('#fileInput').val()
    let extensiones = archivo.substring(archivo.lastIndexOf('.'))

    if (extensiones != '.xlsx') {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Seleccione una imagen valida con formato (xlsx).')
        $('#fileInput').val('')
        return false
    }
})

/* $("#example").append(
  $('<tfoot/>').append( $("#example thead tr").clone() )
); */

/* Datatable consolidado */

let tableConsolidado = $('#tblExplosionMaterialesPedidos').dataTable({
    pageLength: 50,
    order: [
        [1, 'desc']
    ],
    dom: 'Bfrtip',
    order: [
        [0, 'asc']
    ],
    buttons: [{
        extend: 'excel',
        text: 'Exportar',
        className: 'btn btn-primary',
        exportOptions: {
            columns: [0, 1, 5, 6],
        },
    }, ],

    ajax: {
        url: '/api/explosionMaterialesPedidos',
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
            className: 'uniqueClassName',
        },
        {
            title: 'Materia Prima',
            data: 'nombre',
            className: 'uniqueClassName',
        },

        {
            title: '0. MP Requerida Pedidos',
            data: 'cantidad_pedidos',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 2),
        },
        {
            title: '1. MP Requerida Batch',
            data: 'cantidad_batch',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 2),
        },
        {
            title: '2. MP Pesada',
            data: 'uso_batch',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 2),
        },
        {
            title: 'Gap Pedidos <br/> (0 - 2)',
            data: 'gap_pedidos',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 2),
        },
        {
            title: 'Gap Batch <br/> (1 - 2)',
            data: 'gap_batch',
            className: 'uniqueClass',
            render: $.fn.dataTable.render.number('.', ',', 2),
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
        var mpRequeridaPedidos = api
            .column(3)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var mpRequeridaBatch = api
            .column(4)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var mpPesada = api
            .column(5)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var gapPedidos = api
            .column(6)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var gapBatch = api
            .column(7)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer by showing the total with the reference of the column index 
        $(api.column(2).footer()).html('Total');
        $(api.column(3).footer()).html(mpRequeridaPedidos.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));
        $(api.column(4).footer()).html(mpRequeridaBatch.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));
        $(api.column(5).footer()).html(mpPesada.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));
        $(api.column(6).footer()).html(gapPedidos.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));
        $(api.column(7).footer()).html(gapBatch.toLocaleString("de-DE", { minimumFractionDigits: 2, 'maximumFractionDigits': 2 }));

    },
})

async function referencias() {
    let result

    result = await $.ajax({
        url: '/api/explosionMaterialesReferencias',
    })

    return result
}

/* Referencias sin formula */

$('#btnReferenciasSinFormula').click(function(e) {
    e.preventDefault()

    data = sessionStorage.getItem('referencias')

    if (data === null) {
        referencias().then((data) => {
            sessionStorage.setItem('referencias', JSON.stringify(data))
            referenciasSinFormula(data)
        })
    } else {
        data = JSON.parse(data)
        referenciasSinFormula(data)
    }
})

/* Cargar excel */

const referenciasSinFormula = (Data) => {
    let ws = XLSX.utils.json_to_sheet(Data)
    let wb = XLSX.utils.book_new()
    XLSX.utils.book_append_sheet(wb, ws, 'Referencias')

    XLSX.writeFile(wb, 'referenciasSinFormula.xlsx')
}

/* Calcular referencias Batch y Pedidos*/

$.get("/api/explosionMaterialesCantidades",
    function(data, textStatus, jqXHR) {
        $('#cantidadesExplosion').append(` 
            <p id="batchExplosion"><b>Batch:</b> ${data[0].total_batch}</p>
            <p id="pedidosExplosion"><b>Pedidos:</b>  ${data[2].total_pedidos}</p>
            <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[1].total_id_materiaprima}</p>
            <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[3].total_MP_pedidos}</p>
            `);
    },
);