/* tablePesaje = $('#tablePesaje').dataTable({
    ajax: {
        url: `/api/materiasp/${referencia}`,
        dataSrc: '',
    },
    paging: false,
    info: false,
    searching: false,
    sorting: false,

    columns: [{
            title: 'Referencia',
            data: 'referencia',
            className: 'uniqueClassName',
        },
        {
            title: 'Materia Prima',
            data: 'alias',
        },
        {
            title: 'Lote',
            defaultContent: '',
            className: 'uniqueClassName',
        },
        {
            title: 'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
            className: 'conversion_weight_column',
            data: 'porcentaje',
            className: 'uniqueClassName',

            render: (data, type, row) => {
                let tnq = $('#Notanques').val()

                if (tnq === '') {
                    $('#Notanques').val(tanques).prop('disabled', true)
                }

                if (flagWeight) {
                    return ((data / 100) * batch.tamano_lote)
                        .toFixed(2)
                        .replace('.', ',')
                } else {
                    return ((data / 100) * batch.tamano_lote * 1000)
                        .toFixed(2)
                        .replace('.', ',')
                }
            },
        },
        {
            title: '<input type="text" class="form-control" id="Notanques" placeholder="Tanques" style="width:52px; text-align:center" onkeydown="calcularxNoTanques();">',
            data: 'porcentaje',
            className: 'uniqueClassName',
            render: (data, type, row) => {
                if (flagWeight) {
                    return (((data / 100) * batch.tamano_lote) / $('#Notanques').val())
                        .toFixed(2)
                        .replace('.', ',')
                } else {
                    return (
                            ((data / 100) * batch.tamano_lote * 1000) /
                            $('#Notanques').val()
                        )
                        .toFixed(2)
                        .replace('.', ',')
                }
            },
        },
    ],
}) */