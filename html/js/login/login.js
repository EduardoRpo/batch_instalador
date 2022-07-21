/* Login */

/* Cargar select con modulos */

/* modulos = () => {
    $.ajax({
        type: "POST",
        url: "../../../admin/sistema/php/c_modulos.php",
        data: { operacion: 1 },

        success: function(resp) {
            data = JSON.parse(resp);
            data.forEach((equipo) => {
                $("#modulos").append(
                    `<option value="${equipo.id}">${equipo.modulo}</option>`
                );
            });
        },
    });
}; */

/* Mostrar contraseña */

function mostrarPassword() {
    if ($("#clave").val() === "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese el password");
        return false;
    }

    $("#clave").attr("type", "text");
    setTimeout(function() {
        $("#clave").attr("type", "password");
    }, 1000);
}

/* Tiempo de restablecimiento numero de intentos */

$(document).ready(function() {
    if (intentos > 5) {
        setTimeout(() => {
            $.ajax({
                type: "POST",
                url: "../../../html/php/loginTries.php",

                success: function(response) {
                    location.reload();
                },
            });
        }, 60000);
    }
});
//modulos();