$(document).ready(function() {

    /* habilitar botones */

    habilitarbotones = () => {
        $('.pesaje_realizado').prop('disabled', false)
    }

    deshabilitarbtn = () => {
        $('.pesaje_realizado')
            .css({ background: 'lightgray', border: 'gray' })
            .prop('disabled', true)
        $('.pesaje_verificado').prop('disabled', false)
    }
});