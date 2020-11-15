
/* Mostrar contraseña */

function mostrarPassword() {

    if ($('#clave').val()==='') {
        alertify.set("notifier","position", "top-right"); alertify.error("Ingrese la password");
        return false;        
    }


    $('#clave').attr('type', 'text');
    setTimeout(function () { $('#clave').attr('type', 'password'); }, 1000);

}