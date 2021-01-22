

//valida que todos los campos esten diligenciados para el proceso y la firma

function cargar(btn, idbtn) {

    localStorage.setItem("idbtn", idbtn);
    id = btn.id;

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso*/

    let seleccion = $('#sel_producto_desinfeccion').val();
    if (modulo == 3 && seleccion != "Seleccione")
        seleccion = $('#select-Linea').val();

    if (seleccion == "Seleccione") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
        return false;
    }


    //Validacion de control de tanques
    if (id == "aprobacion_realizado") {
        validar = controlTanques();
        if (validar == 0) {
            return false;
        }
    }

    /* Validacion que el formulario se encuentre completamente lleno */

    if (id == 'aprobacion_realizado') {
        validar = validardatosresultadosPreparacion();
        if (validar == 0)
            return false;
    }

    //validar que todos los campso se encuentres completos en el formularios

    validarParametrosControl();

    /* Carga el modal para la autenticacion */

    $('#usuario').val('');
    $('#clave').val('');
    $('#m_firmar').modal('show');
}




/* Cargue control de Tanques */

function cargaTanquesControl(cantidad) {

    if (cantidad > 10) {
        cantidad = 10;
    }

    for (var i = 1; i <= cantidad; i++) {
        $(".checkbox-aprobacion").append(`<input type="checkbox" id="chkcontrolTanques${i}" class="chkcontrol" style="height: 30px; width:30px;">`);
    }
    tanques = i - 1;
}


/* Carga de tabla de propiedades del producto */

$.ajax({
    url: `/api/productsDetails/${referencia}`,
    type: 'GET'
}).done((data, status, xhr) => {
    $('#espec_color').html(data.color);
    $('#espec_olor').html(data.olor);
    $('#espec_apariencia').html(data.apariencia);
    $('#espec_poder_espumoso').html(data.poder_espumoso);
    $('#espec_untosidad').html(data.untosidad);

    $('#espec_ph').html(`${data.limite_inferior_ph} a ${data.limite_superior_ph}`);

    $('#in_ph').attr('min', data.limite_inferior_ph);
    $('#in_ph').attr('max', data.limite_superior_ph);

    $('#espec_densidad').html(`${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`);

    $('#in_densidad').attr('min', data.limite_inferior_densidad_gravedad);
    $('#in_densidad').attr('max', data.limite_superior_densidad_gravedad);

    $('#espec_grado_alcohol').html(`${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`);

    $('#in_grado_alcohol').attr('min', data.limite_inferior_grado_alcohol);
    $('#in_grado_alcohol').attr('max', data.limite_superior_grado_alcohol);

    $('#espec_viscidad').html(`${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`);

    $('#in_viscocidad').attr('min', data.limite_inferior_viscosidad);
    $('#in_viscocidad').attr('max', data.limite_superior_viscosidad);

    $('#espec_untosidad').html(data.untuosidad);
});

function deshabilitarbtn() {

    $('.aprobacion_realizado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    $('.aprobacion_verificado').prop('disabled', false);
}

/* validar min y max en densidad */

function validar_densidad() {
    min = $('#in_densidad').attr('min');
    max = $('#in_densidad').attr('max');
   
    min = parseFloat(min) - 0.05;
    max = parseFloat(max) + 0.05;

    densidad = parseFloat($('#in_densidad').val());

    if (densidad > max || densidad < min) {
        alertify.set("notifier", "position", "top-right"); alertify.error("La densidad se encuentra fuera de los rangos, valide nuevamente.");
        return false;
    }

}