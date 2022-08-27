$(document).ready(function() {
    $('#cmbreferencia').click(function(e) {
        e.preventDefault();

        let radio = $('#formula_r').prop('checked')

        if (!radio)
            radio = $('#formula_f').prop('checked')

        if (!radio) {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Seleccione la formula')
            return false
        }

    });
});