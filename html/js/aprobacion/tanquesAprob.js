$(document).ready(function() {

    /* Cargue control de Tanques */

    cargaTanquesControl = (cantidad) => {
        if (cantidad > 10) {
            cantidad = 10;
        }

        for (var i = 1; i <= cantidad; i++) {
            $(".checkbox-aprobacion").append(
                `<input type="checkbox" id="chkcontrolTanques${i}" onclick="validar_condicionesMedio();" class="chkcontrol" style="height: 30px; width:30px;">`
            );
        }
        tanques = i - 1;
    }

});