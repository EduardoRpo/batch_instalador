$(document).ready(function() {
    verificacionCargaLotes = (id) => {
        /* Validar que todos los registros se han seleccionado */
        if (id == 'pesaje_realizado') {
            let filas = $(tablePesaje).find('tbody tr').length
            if (filas != lotes.length) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Ingrese todos los lotes, seleccionando cada materia prima.')
                return false
            } else
                return true
        } else
            return true
    }
});