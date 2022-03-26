$(document).ready(function() {

    /* Cargue tabla de versiones */

    tblVersionCert = $('#tblVersionCert').dataTable({
        pageLength: 50,
        ajax: {
            url: '/api/getAllVersions/2',
            dataSrc: '',
        },
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
        },
        columns: [{
                title: 'No.',
                "data": null,
                className: 'text-center',
                "render": function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Código',
                data: "codigo",
                className: 'uniqueClassName',
            },
            {
                title: 'Versión',
                data: "version",
                className: 'text-center',
            },
            {
                title: 'Fecha',
                data: "fecha",
                className: 'classCenter',
            },
            {
                title: 'Acciones',
                data: 'id_pdf_version',
                className: 'text-center',
                render: function(data) {
                    return `
                        <a href="javascript:;" <i id="${data}" class="large material-icons updateVersionCert" data-toggle='tooltip' title='Actualizar Versión Certificado' style="font-size: 30px;"></i>edit</a>
                        <a href="javascript:;" <i id="${data}" class="large material-icons deleteVersionCert" data-toggle='tooltip' title='Eliminar Versión Certificado' style="font-size: 30px;color:red"></i>clear</a>`
                },
            },
        ],
    })
});