$(document).ready(function() {

    let linea
    pesoTotalGr = 0
    pesoTotalKg = 0

    /* Formula Materia Prima  */

    tblPesaje = () => {

        tablePesaje = $('#tablePesaje').dataTable({
            destroy: true,
            ajax: {
                url: `/api/pesajeDispensacion/${referencia}/${batch.tamano_lote}`,
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
                    data: 'pesoTotal',
                    className: 'text-right',
                    render: (data, type, row) => {
                        tanques = sessionStorage.getItem('tanques')
                        $('#Notanques').val(tanques).prop('disabled', true)
                        if (flagWeight)
                            return (data).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                        else
                            return (data * 1000).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                    },
                },
                {
                    title: '<input type="text" class="form-control" id="Notanques" style="width:52px; text-align:center">',
                    data: 'pesoTotal',
                    className: 'text-right',
                    render: (data, type, row) => {
                        if (flagWeight)
                            return (data / tanques).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                        else
                            return ((data * 1000) / tanques).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                    },
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
                var peso = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var pesoTanque = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(0).footer()).html('<b>Total</b>');
                $(api.column(3).footer()).html(`<b>${peso.toLocaleString("de-DE", { maximumFractionDigits: 0 })} Kg </b>`);
                $(api.column(4).footer()).html(`<b>${pesoTanque.toLocaleString("de-DE", { maximumFractionDigits: 0 })} Kg</b>`);
            }
        })


        /* Ingreso de lotes  */

        tablePesaje.on('click', 'tbody tr', function() {
            // Validar seleccion de tanque 

            tanque = controlTanques()
            if (tanque == 0) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Seleccione el Tanque.')
                return false
            }

            linea = this

            alertify
                .prompt(
                    'Samara Cosmetics - Trazabilidad Lotes MP',
                    `Ingrese el Número del lote para la MP $ { linea.firstChild.innerText } < br > < p style = "font-size:13px;color:coral" > Si cuenta con más de un lote separelos con un doble asterisco( ** ) < p > `,
                    '',
                    function(evt, value) { numeroLote(value) },
                    function() { alertify.error('Ingrese el número del lote de la materia prima') },
                )
                .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
        })
    }

    numeroLote = (value) => {
        if (value == 0 || value == '') {
            if (linea.firstChild.innerText != 10003) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('El Lote no puede ser cero(0) o vacio para materias primas diferentes al agua.')
                return false
            }
        }

        flag = 0
        $(linea).addClass('tr_hover')
            //$(linea).addClass('not-active')
        linea.cells[2].innerText = value
        mp = linea.firstChild.innerText

        for (let i = 0; i < lotes.length; i++) {
            if (lotes[i].batch == idBatch && lotes[i].referenciaMP == mp && lotes[i].tanque == tanque) {
                lotes[i].lote = value
                flag = 1
            }
        }

        if (flag == 0) {
            let fila = {}
            fila.lote = value
            fila.batch = idBatch
            fila.referenciaMP = mp
            fila.tanque = tanque
            lotes.push(fila)
        }
    }


});