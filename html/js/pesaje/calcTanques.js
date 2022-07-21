/* $(document).ready(function() {
    // Calcular los tanques

    calcularxNoTanques = () => {
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
}); */