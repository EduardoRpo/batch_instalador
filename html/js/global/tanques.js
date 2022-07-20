var cantidad = 0
var tanques = 0
var tanque = 0

$(document).ready(function() {
    /* tabla de observaciones en la pestaña de informacion del producto */


    $('#txtobservacionesTanques').DataTable({
        scrollY: '120px',
        scrollCollapse: true,
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        columnDefs: [{
            targets: '_all',
            sortable: false,
        }, ],
    })

    $('.dataTables_length').addClass('bs-select')


    /* Carga de tanques para mostrar en los proceso de pesaje, preparacion y aprobacion */


    cantidadTanques = async() => {
        let result
        try {
            result = await $.ajax({
                url: `/html/php/tanques.php`,
                type: 'POST',
                data: { idBatch: idBatch }
            })
            return result
        } catch (error) {
            console.error(error)
        }
    }

    cargarTanques = async() => {
        const data = await cantidadTanques()
        if (data == '' || modulo == 5 || modulo == 6) {
            return false
        }
        /* cargar tabla de tanques en info */
        let info = JSON.parse(data)

        tanques = info[0].cantidad
        sessionStorage.setItem('tanques', info[0].cantidad)
        await tblTanquesInfo(info)
        await checksTanques(info)
        modulo == 2 ? tblPesaje() : modulo
    }

    tblTanquesInfo = (info) => {
        $(`#tanque1`).html(formatoCO(info[0].tanque))
        $(`#cantidad1`).html(info[0].cantidad)
        $(`#total1`).html(formatoCO(info[0].tanque * info[0].cantidad))
    }

    checksTanques = (info) => {
        /* iniciar proceso para colocar checks de tanques */
        cantidad = parseInt(info[0].cantidad)

        if (modulo == '2' || modulo == '3')
            controlProceso(cantidad)
        else if (modulo == '4')
            cargaTanquesControl(cantidad)
    }

    /* Mostrar los checkbox de acuerdo con la cantidad de tanques */

    controlProceso = (cantidad) => {

        if (cantidad > 10)
            cantidad = 10

        for (i = 0; i < cantidad; i++)
            $('.chk-control').append(`<input type="checkbox" id="chkcontrolTanques${i + 1}" class="chkcontrol" style="height: 30px; width:30px;" onclick="validar_condicionesMedio();">`)

    }

    /* Control de Tanques seleccionados */

    controlTanques = () => {
        let count = 0
        for (let i = 0; i < tanques; i++) {
            if ($(`#chkcontrolTanques${i + 1}`).is(':checked')) {
                let isDisabled = $(`#chkcontrolTanques${i + 1}`).prop('disabled')
                if (!isDisabled) count++
            }
        }

        if (count > 1) {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error(`Chequee un solo tanque`)
            count = 0
            return false
        }

        for (let i = 0; i < tanques; i++) {
            /* Valida los tanques que ya han sido aprobados */
            if ($(`#chkcontrolTanques${i + 1}`).is(':disabled')) {
                for (let j = 0; j < tanques; j++) {
                    if ($(`#chkcontrolTanques${j + 1}`).is(':disabled')) {
                        i++
                    }
                }
            }

            /* Continua el proceso si el tanque va a ser ejecutado */
            if ($(`#chkcontrolTanques${i + 1}`).is(':checked')) {
                return tanque = i + 1
            } else {
                if (count != 0) {
                    alertify.set('notifier', 'position', 'top-right')
                    alertify.error(`Chequee el Tanque No. ${i}`)
                }
                return 0
            }
        }
    }
});