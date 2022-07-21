let btn_id;

$(document).ready(function() {

    /* Valida el usuario si existe en la base de datos */

    $(document).on('click', '.btnSignUser', function(e) {
        e.preventDefault();
        $("#m_firmar").modal("hide");

        btn_id = sessionStorage.getItem("idbtn");
        datos = { user: $("#usuario").val(), password: $("#clave").val(), btn_id }
        signUser(datos)
    });

    signUser = async(datos) => {
        result = await dataUser(datos)
        message(result)
    }

    dataUser = async() => {
        let result;
        try {
            result = await $.ajax({
                url: `/api/auth`,
                type: 'POST',
                data: datos
            })
            return result
        } catch (error) {
            console.error(error)
        }
    }

    message = (datos) => {
        alertify.set("notifier", "position", "top-right");

        if (datos.info == true) {
            alertify.warning(datos.message)
            return false
        }
        if (datos.error == true) {
            alertify.error(datos.message)
            return false
        }

        controller(datos);
        sessionStorage.setItem("firm", datos.id);
    }


});