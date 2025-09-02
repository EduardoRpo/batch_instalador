var cantidad = 0
var tanques = 0
var tanque = 0

$(document).ready(function() {
    console.log('🔍 Document ready - Iniciando script de tanques')
    console.log('🔍 Document ready - Módulo actual:', modulo)
    console.log('🔍 Document ready - ID Batch:', idBatch)
    
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
        console.log('🔍 cargarTanques - Iniciando función')
        const data = await cantidadTanques()
        console.log('🔍 cargarTanques - Datos recibidos:', data)
        
        if (data == '' || modulo == 5 || modulo == 6) {
            console.log('🔍 cargarTanques - Condición de salida cumplida, retornando false')
            return false
        }
        
        /* cargar tabla de tanques en info */
        let info = JSON.parse(data)
        console.log('🔍 cargarTanques - Info parseada:', info)

        tanques = info[0].cantidad
        sessionStorage.setItem('tanques', info[0].cantidad)
        console.log('🔍 cargarTanques - Cantidad de tanques:', tanques)
        
        tblTanquesInfo(info)
        await checksTanques(info)
        
        if (modulo == 2) {
            console.log('🔍 cargarTanques - Llamando a tblPesaje')
            tblPesaje()
        } else {
            console.log('🔍 cargarTanques - Módulo no es 2, valor:', modulo)
        }
    }

    tblTanquesInfo = (info) => {
        $(`#tanque1`).html(formatoCO(info[0].tanque))
        $(`#cantidad1`).html(info[0].cantidad)
        $(`#total1`).html(formatoCO(info[0].tanque * info[0].cantidad))
    }

    checksTanques = (info) => {
        /* iniciar proceso para colocar checks de tanques */
        cantidad = parseInt(info[0].cantidad)
        console.log('🔍 checksTanques - Cantidad de tanques:', cantidad)
        console.log('🔍 checksTanques - Módulo actual:', modulo)

        if (modulo == '2' || modulo == '3') {
            console.log('🔍 checksTanques - Llamando a controlProceso')
            controlProceso(cantidad)
        } else if (modulo == '4') {
            console.log('🔍 checksTanques - Llamando a cargaTanquesControl')
            cargaTanquesControl(cantidad)
        }
    }

    /* Mostrar los checkbox de acuerdo con la cantidad de tanques */

    controlProceso = (cantidad) => {
        console.log('🔍 controlProceso - Iniciando con cantidad:', cantidad)
        
        if (cantidad > 10) {
            cantidad = 10
            console.log('🔍 controlProceso - Cantidad limitada a 10')
        }

        console.log('🔍 controlProceso - Buscando elemento .chk-control')
        const chkControlElement = $('.chk-control')
        console.log('🔍 controlProceso - Elemento .chk-control encontrado:', chkControlElement.length > 0)
        console.log('🔍 controlProceso - HTML del elemento:', chkControlElement.html())

        for (i = 0; i < cantidad; i++) {
            const checkboxHTML = `<input type="checkbox" id="chkcontrolTanques${i + 1}" class="chkcontrol" style="height: 30px; width:30px;" onclick="validar_condicionesMedio();">`
            console.log(`🔍 controlProceso - Agregando checkbox ${i + 1}:`, checkboxHTML)
            $('.chk-control').append(checkboxHTML)
        }
        
        console.log('🔍 controlProceso - Checkboxes agregados. HTML final:', $('.chk-control').html())
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