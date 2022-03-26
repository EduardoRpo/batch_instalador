$(document).ready(function() {

    $('#frmNewVersion').hide();

    $(".contenedor-menu .menu a").removeAttr("style");
    $("#versionCert").css("background", "coral");
    $(".contenedor-menu .menu ul.menu_pdf").show();

    $('#addVersion').click(function(e) {
        e.preventDefault();
        $('#frmNewVersion').toggle(800);
        sessionStorage.removeItem('id_version_pdf');
        $("#frmNewVersion")[0].reset();

    });

    $("#btnCreateVersion").on("click", function(e) {
        codigo = $('#codigo').val();
        version = $('#version').val();
        fecha = $('#fecha').val();

        emptyVar = emptyVariable(codigo)
        emptyVar = emptyVariable(version)
        emptyVar = emptyVariable(fecha)

        if (emptyVar == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos.");
            return false;
        }

        id = sessionStorage.getItem('id_version_pdf');

        if (!id) {
            data = $('#frmNewVersion').serialize();
            data = `${data}&type=2`
            $.ajax({
                type: "POST",
                url: "/api/saveVersion",
                data: data,
                success: function(resp) {
                    message(resp)
                }
            });

        } else {
            updateVersionPDF(id)
        }
    })

    $(document).on("click", ".updateVersionCert", function(e) {
        $('#frmNewVersion').show(800);

        idVersionPDF = this.id;
        $('#btnCreateVersion').html('Actualizar');
        sessionStorage.setItem('id_version_pdf', idVersionPDF);

        let row = $(this).parent().parent()[0];
        let data = tblVersionCert.fnGetData(row);

        $('#codigo').val(data.codigo);
        $('#version').val(data.version);
        $('#fecha').val(data.fecha);
    })


    $(document).on("click", ".deleteVersionCert", function(e) {
        let id_version = this.id;

        alertify.confirm('Samara Cosmetics', 'Esta seguro de eliminar esta version? <br><b style="color:red">Está acción no podra ser reversada</b>', function() {
            $.get(`/api/deleteVersion/${id_version}`, function(data, textStatus, jqXHR) {
                message(data);
            });
        }, function() {
            alertify.error('Acción Cancelada')
        }).set("labels", { ok: "Si", cancel: "No", });
    })

    updateVersionPDF = (id_version) => {
        debugger
        data = $('#frmNewVersion').serialize();
        data = `${data}&id_pdf_version=${id_version}`

        $.ajax({
            type: "POST",
            url: "/api/updateVersion",
            data: data,
            success: function(resp) {
                message(resp)
            }
        });
    }


    message = (data) => {
        if (data.success == true) {
            $('#frmNewVersion').hide(800);
            $('#frmNewVersion')[0].reset();
            alertify.set("notifier", "position", "top-right");
            alertify.success(data.message);
            updateTable();
            return false;
        } else if (data.error == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.error(data.message);
        } else if (data.info == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.warning(data.message);
        }
    }

    /* Actualizar tabla */

    function updateTable() {
        $('#tblVersionCert').DataTable().clear();
        $('#tblVersionCert').DataTable().ajax.reload();
    }

});