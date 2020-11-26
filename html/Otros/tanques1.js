
/* tabla de observaciones en la pestaña de informacion del producto */

$(document).ready(function () {
    $('#txtobservacionesTanques').DataTable({
        "scrollY": "100px", "scrollCollapse": true, searching: false, paging: false, info: false, ordering: false,
        columnDefs: [{
            targets: "_all",
            sortable: false
        }],
    });

    $('.dataTables_length').addClass('bs-select');
});

/* Carga de tanques para mostrar en los proceso de pesaje, preparacion y aprobacion */

function validarTanques(modulo) {
    if (modulo == 2 || modulo == 3 || modulo == 4) {
        let cantidad = 0;
        ocultarfilasTanques(5);
    }

}

/* Ocultar filas tanques */

function ocultarfilasTanques(filas) {
    filas = filas + 1;
    for (let i = filas; i < 6; i++) {
        $(`#fila${i}`).attr("hidden", true);
    }
    cargarTanques();
}

/* Cargar Tanques de acuerdo al batch */

function cargarTanques() {
    $.ajax({

        'method': 'POST',
        'url': '../../html/php/tanques.php',
        'data': { id: idBatch },
        
        success: function (data) {
            var info = JSON.parse(data);
            
            if (info == '') { return false; }

            var j = 1;

            for (let i = 0; i < info.length; i++) {
                $(`#tanque${j}`).html(formatoCO(info[i].tanque));
                $(`#cantidad${j}`).html(info[i].cantidad);
                $(`#total${j}`).html(formatoCO(info[i].tanque * info[i].cantidad));
                j++;

                cantidad = cantidad + parseInt(info[i].cantidad);
            }
            ocultarfilasTanques(info.length);

            if (proceso === "2" || proceso === "3") {
                controlProceso(cantidad);
            } else if (proceso === "4") {
                cargaTanquesControl(cantidad);
            }


        },
        error: function (r) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar los tanques.");
        }

    });
}

/* Mostrar los checkbox de acuerdo con la cantidad de tanques */

function controlProceso(cantidad) {

    if (cantidad > 10) {
        cantidad = 10;
    }

    for (let i = 1; i <= cantidad; i++) {
        $(".chk-control").append(`<input type="checkbox" id="chkcontrolTanques${i}" style="height: 30px; width:30px;">`);
    }
}