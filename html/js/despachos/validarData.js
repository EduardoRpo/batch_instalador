$(document).ready(function() {

    validarData = () => {
        unidades = $(`#unidades_recibidas${id_multi}`).val();
        cajas = $(`#cajas${id_multi}`).val();
        mov_acond = $(`#mov_inventario_acond${id_multi}`).val();
        movimiento = $(`#mov_inventario${id_multi}`).val();
        total = unidades * cajas * movimiento;

        if (total == 0) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Complete todos los campos");
            return false;
        }

        if (mov_acond != movimiento) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Números de movimiento no son iguales, revise nuevamente");
            return false;
        } else
            return true
    }

});