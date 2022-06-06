let flagWeight = false
let lotes = []
modulo = 2

function cargar(btn, idbtn) {

    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {

        sessionStorage.setItem('idbtn', idbtn)
        id = btn.id

        //Validacion de control de tanques
        if (
            id == 'pesaje_realizado' ||
            id == 'preparacion_realizado' ||
            id == 'aprobacion_realizado'
        ) {
            validar = controlTanques()
            if (validar == 0) {
                return false
            }
        }

        /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

        let seleccion = $('#sel_producto_desinfeccion').val()

        if (seleccion == 'Seleccione') {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Seleccione el producto para desinfección.')
            return false
        }

        if (id !== 'despeje_realizado' && id !== 'pesaje_realizado') {
            if (id !== 'despeje_verificado') {
                if ($('#despeje_verificado').is(':disabled') == false) {
                    alertify.set('notifier', 'position', 'top-right')
                    alertify.error(
                        'Primero ejecute la firma para Calidad en la sección de Despeje de Lineas y Procesos.',
                    )
                    return false
                }
            }
        }

        /* Validar que todos los registros se han seleccionado */
        if (id == 'pesaje_realizado') {
            let filas = $(tablePesaje).find('tbody tr').length
            if (filas != lotes.length) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error(
                    'Ingrese todos los lotes, seleccionando cada materia prima.',
                )
                return false
            }
        }
        /* Carga el modal para la autenticacion */

        $('#usuario').val('')
        $('#clave').val('')
        $('#m_firmar').modal('show')
    });
}

/* habilitar botones */

function habilitarbotones() {
    $('.pesaje_realizado').prop('disabled', false)
}

/* Carga de Cargos  */

$.ajax({
    url: `/api/cargos`,
    type: 'GET',
}).done((data, status, xhr) => {
    data.forEach((cargo, indx) => {
        $(`#cargo-${indx + 1}`).val(cargo.cargo)
    })
})

/* Exportar Datatable Materia Prima */
/* Formula Materia Prima  */

$(document).ready(function() {
    //batch_record()


    /* Seleccion multiple */
    tablePesaje.on('click', 'tbody tr', function() {
        /* Validar seleccion de tanque */

        validar = controlTanques()
        if (validar == 0) return false

        let linea = this
            /* cargar lote */

        alertify
            .prompt(
                'Samara Cosmetics - Trazabilidad Lotes MP',
                `Ingrese el Número del lote para la MP ${linea.firstChild.innerText}<br><p style="font-size:13px;color:coral">Si cuenta con más de un lote separelos con un doble asterisco (**)<p>`,
                '',
                function(evt, value) {
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
                },
                function() {
                    alertify.error('Ingrese el número del lote de la materia prima')
                },
            )
            .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
    })
})

Date.prototype.toDateInputValue = function() {
    var local = new Date(this)
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset())
    return local.toJSON().slice(0, 10)
}

$('#in_fecha_pesaje').val(new Date().toDateInputValue())
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue())

//Conversion medidas de peso

function cambioConversion() {
    flagWeight = !flagWeight
    tablePesaje.api().ajax.reload()
    $(tablePesaje.api().column(3).header()).html(
        `Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${flagWeight ? 'Kg' : 'g'
        }</a>)`,
    )
}

/* Calcular los tanques */

function calcularxNoTanques() {
    let tanques = $('#Notanques').val()

    if (tanques < 11) {
        tablePesaje.api().ajax.reload()
    } else {
        $('#Notanques').val(1)
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('El número de Tanques debe ser menor a 11.')
        return false
    }
}

function deshabilitarbtn() {
    $('.pesaje_realizado')
        .css({ background: 'lightgray', border: 'gray' })
        .prop('disabled', true)
    $('.pesaje_verificado').prop('disabled', false)
}