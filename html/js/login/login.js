/* Login */

/* $('.btnLogin').click(function (e) {
    e.preventDefault();

    let usuario = $('#usuario').val();
    let pass = $('#clave').val();
    let val = usuario.length * pass.length

    if (val > 0) {
        $.ajax({
            type: "POST",
            url: "/html/php/login.php",
            data: { usuario, pass },

            success: function (r) {
                if (r == 0) {
                    alertify.set("notifier", "position", "top-right"); alertify.error("usuario y/o contraseña incorrectos");
                    return false;
                } else
                    document.location.href = r;
            }
        })
    } else {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese el usuario y/o contraseña");
        return false;
    }

    ;
}); */



/* Mostrar contraseña */

function mostrarPassword() {

    if ($('#clave').val() === '') {
        alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese la password");
        return false;
    }


    $('#clave').attr('type', 'text');
    setTimeout(function () { $('#clave').attr('type', 'password'); }, 1000);

}
