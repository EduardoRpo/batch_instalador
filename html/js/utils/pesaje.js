$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var est = parseInt($('#est').val(), 10);
        var max = parseInt($('#est').val(), 10);
        var age = parseFloat(data[10]) || 0; // use data for the age column

        if ((isNaN(est) && isNaN(max)) ||
            (isNaN(est) && age <= max) ||
            (est <= age && isNaN(max)) ||
            (est <= age && age <= max)) {
            return true;
        }
        return false;
    }
);

$(document).ready(function () {
    var table = $('#tablePesajes').DataTable({
        ajax: {
            url: '/api/pesajes',
            dataSrc: ''
        },
        columns: [
            {
                title: 'Fecha Creación',
                data: 'fecha_creacion'
            },
            {
                title: 'No Orden',
                data: 'numero_orden'
            },
            {
                title: 'Referencia',
                data: 'referencia'
            },
             {
                title: 'No Lote',
                data: 'numero_lote'
            },
            /*{
                title: 'Estado',
                data: 'estado',
                render: (data, type, row) => {
                    return data == 1 ? "Activo" : "Inactivo";
                }
            },*/ 
            {
                title: 'Ingresar',
                data: '',
                render: (data, type, row) => {
                    return `<a href="pesajeinfo/${row.id_batch}/${row.referencia}" <i class="large material-icons" data-toggle="tooltip" title="Ingresar" style="color:rgb(0, 154, 68)">border_color</i></a>`;
                }
            }
        ]
    });
    table.destroy();

// Event listener to the two range filtering inputs to redraw on input
$('#est').keyup(function () {
        table.draw();
    });
});