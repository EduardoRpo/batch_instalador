let flagWeight = false;

/* Carga de Cargos  */

$.ajax({
    url: `../../api/cargos`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach((cargo, indx) => {
        $(`#cargo-${indx + 1}`).val(cargo.cargo);
    });

});

/* Exportar Datatable Materia Prima */
/* Formula Materia Prima  */

$(document).ready(function () {

    tablePesaje = $('#tablePesaje').dataTable({

        ajax: {
            url: `../../api/materiasp/${referencia}`,
            dataSrc: ''
        },
        paging: false,
        info: false,
        searching: false,
        sorting: false,

        columns: [{
            title: 'Referencia',
            data: 'referencia', className: 'uniqueClassName'
        },
        {
            title: 'Materia Prima',
            data: 'alias', className: 'uniqueClassName'
        },
        {
            title: 'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
            className: 'conversion_weight_column',
            data: 'porcentaje', className: 'uniqueClassName',

            render: (data, type, row) => {
                let tnq = $('#Notanques').val();

                if (tnq === "") {
                    $('#Notanques').val(1);
                }

                if (flagWeight) {
                    return (data * batch.tamano_lote / 1000).toFixed(2).replace('.', ',');
                } else {
                    return (data * batch.tamano_lote).toFixed(2).replace('.', ',');
                }
            },

        },
        {
            title: '<input type="text" class="form-control" id="Notanques" placeholder="Tanques" style="width:52px; text-align:center" onkeydown="calcularxNoTanques();">',
            data: 'porcentaje', className: 'uniqueClassName', //colocar numero limite de tanques a 10; y por defecto quede con 1
            render: (data, type, row) => {

                if (flagWeight) {
                    return (data * batch.tamano_lote / 1000 / $('#Notanques').val()).toFixed(2).replace('.', ',');
                } else {
                    return (data * batch.tamano_lote / $('#Notanques').val()).toFixed(2).replace('.', ',');
                }

            },

        },
        {
            title: 'Impresión',
            defaultContent: '<a href="#" data-toggle="modal" data-target="#imprimirEtiquetas"><i class="large material-icons">print</i></a>', className: 'uniqueClassName'
        }

        ],

        dom: 'Bfrtip',
        buttons: [
            /* $.extend( true, {}, buttonCommon, {
                extend: 'copyHtml5'
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5'
            } ), */

            $.extend(true, {}, {
                extend: 'pdfHtml5',
                text: 'Exportar PDF',
                title: 'DISPENSACIÓN ', //+ batch.numero_orden,  

                //messageTop: 'Ingrese el número de Tanque   _____ ', //VALIDAR PARA QUE SE PREGUNTE EL NÚMERO DE TANQUE

                exportOptions: {
                    columns: [0, 1, 3]
                }
            })
        ]

    });

});



Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha_pesaje').val(new Date().toDateInputValue());
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue());

//Conversion medidas de peso

function cambioConversion() {
    flagWeight = !flagWeight;
    tablePesaje.api().ajax.reload();
    $(tablePesaje.api().column(2).header()).html(`Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${flagWeight ? 'Kg' : 'g'}</a>)`);
}

/* Calcular los tanques */

function calcularxNoTanques() {

    let tanques = $('#Notanques').val();

    if (tanques < 11) {
        tablePesaje.api().ajax.reload();
    } else {
        $('#Notanques').val(1);
        alertify.set("notifier", "position", "top-right"); alertify.error("El número de Tanques debe ser menor a 11.");
        return false;
    }
}

/* imprimir etiquetas virtuales */

$(document).ready(function () {
    $('#imprimirEtiquetasVirtuales').click(function () {
        window.frames["printf"].focus();
        window.frames["printf"].print();
    });
});

