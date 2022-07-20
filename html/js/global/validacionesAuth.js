$(document).ready(function() {
    cargar = (btn, idbtn) => {

        let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
        confirm.set('onok', function(r) {
            sessionStorage.setItem('idbtn', idbtn)
            id = btn.id
            auth()
        });
    }

    //Validacion de control de tanques

    verificacionControlTanques = (id) => {

        if (id == 'pesaje_realizado' || id == "preparacion_realizado" || id == "aprobacion_realizado") {
            validar = controlTanques()
            if (validar == 0) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Seleccione el Tanque.')
                return false
            } else
                return true
        } else
            return true
    }

    // Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion

    verificacionDesinfeccion = () => {

        let seleccion = $('#sel_producto_desinfeccion').val()

        if (seleccion == 'Seleccione') {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Seleccione el producto para desinfección.')
            return false
        } else
            return true
    }

    verificacionOrdenFirmas = (id) => {
        array = ['despeje_realizado', 'pesaje_realizado', "preparacion_realizado", "aprobacion_realizado"]

        if (!array.includes(id)) {
            if (id !== 'despeje_verificado') {
                if ($('#despeje_verificado').is(':disabled') == false) {
                    alertify.set('notifier', 'position', 'top-right')
                    alertify.error('Inicialmente ejecute la firma para Calidad en la sección de Despeje de Lineas y Procesos.')
                    return false
                } else
                    return true
            } else
                return true
        } else
            return true
    }

    /* Carga el modal para la autenticacion */

    auth = async() => {
        result = await verificacionControlTanques(id)
        if (!result) return false

        if (result) {
            result = await verificacionDesinfeccion()
            if (!result) return false
        }

        if (result) {
            result = await verificacionOrdenFirmas(id)
            if (!result) return false
        }

        if (modulo == 2 && result) {
            result = await verificacionCargaLotes(id)
            if (!result) return false
        }

        if (modulo == 3 && result) {
            result = await validacionInstructivo(id)
            if (!result) return false
        }

        if (modulo == 3 || modulo == 4 && result) {
            result = await validacionEspecificaciones(id)
            if (!result) return false
        }

        /* if (modulo == 4 && result) {
            result = await validarParametrosControl();
            if (!result) return false
        } */

        $('#usuario').val('')
        $('#clave').val('')
        $('#m_firmar').modal('show')
    }



});