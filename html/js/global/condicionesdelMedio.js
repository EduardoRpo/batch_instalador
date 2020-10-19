
/* Mostrar ventana de Condiciones Medio de acuerdo con el tiempo establecido en la BD*/

function cargueCondicionesMedio() {
    $.ajax({
        'type': 'POST',
        'url': '../../html/php/condicionesmedio.php',
        'data': { operacion: "1", modulo: proceso },

        success: function (resp) {

            if (resp == 3) {
                return false;
            }
            let t = JSON.parse(resp);
            let tiempo = Math.round(Math.random() * (t.data[0].t_max - t.data[0].t_min) + parseInt(t.data[0].t_min));

            setTimeout(function () {
                $("#m_CondicionesMedio").modal("show");
            }, tiempo * 60000);
        }
    });
}

/* Almacenar informacion de condiciones del medio */

function guardar_condicionesMedio() {

    //let proceso = $('h1').text();
    let proceso = modulo;
    let temperatura = $('#temperatura').val();
    let humedad = $('#humedad').val();
    let url = $(location).attr('href');
    let id_batch = url.split("/");

    if (temperatura === "" || humedad === "") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Complete todos los datos para continuar con el proceso.");
        return false;
    }

    $('#m_CondicionesMedio').modal('hide');

    $.ajax({
        'type': 'POST',
        'url': '../../html/php/condicionesmedio.php',
        'data': {
            operacion: "2",
            modulo: proceso,
            temperatura: temperatura,
            humedad: humedad,
            id: id_batch[4]
        },

        success: function (resp) {
            if (resp == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Condiciones del Medio Almacenado");
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error");
            }

        }
    });
    //return false;
}