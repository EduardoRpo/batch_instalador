$(document).ready(function() {
    validarCierreProcesos2y3 = () => {
        $.ajax({
            url: `/api/validacionesCierreProceso/${idBatch}/${modulo}`,
            success: function(response) {
                if (response == true) {
                    ingresarUsuario()
                } else if (response == false) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(`No es posible cerrar este proceso para el Batch ${idBatch}. Los módulos de ${modulos} aún no se encuentran completamente firmados`);
                    return false;
                } else {
                    console.log(response)
                }

            }
        })
    }


});