/* Mostrar Batch para Impresion */

$(".pdf").click(function (e) {
    e.preventDefault();

    /* function batch_pdf() { */
    $('#m_batch_pdf').modal()
    $("#tabla_batch_pdf").dataTable().fnDestroy();
    cargartablabatch_pdf();
    /* } */

});
/* Cargar tabla de eliminados */

function cargartablabatch_pdf() {
    $("#tabla_batch_pdf").DataTable({
        //scrollY: '100vh',
        responsive: true,
        scrollCollapse: true,
        //paging: false,
        language: { url: '/admin/sistema/admin_componentes/es-ar.json' },

        ajax: {
            method: "POST",
            url: "php/c_batch_pdf.php",
            data: { operacion: 1 },
        },

        columns: [
            { "data": "id_batch" },
            { "data": "numero_orden", className: "centrado" },
            { "data": "numero_lote", className: "centrado" },
            { "data": "tamano_lote", render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { "data": "id_producto" },
            { "data": "lote_presentacion", render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { "data": "unidad_lote", render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { "data": "fecha_creacion", className: "centrado" },
            { "data": "fecha_programacion", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='fa fa-file-text fa-2x link-ver' data-toggle='tooltip' title='Ver Batch Record' style='color:green;'></i></a>   <a href='#' <i class='fa fa-print fa-2x link-imprimir' data-toggle='tooltip' title='Imprimir Batch Record' style='color:green;'></i></a>" },
        ],
    });
};

/* Visualizar pdf */

$(document).on('click', '.link-ver', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().first().text();
    sessionStorage.setItem('id', id);
    window.open("../../html/pdf/formato.php", '_blank');
});

/* Imprimir pdf */

$(document).on('click', '.link-imprimir', function (e) {
    e.preventDefault();

});

