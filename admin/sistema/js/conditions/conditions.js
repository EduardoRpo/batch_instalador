//Cargar select modulo
$(document).ready(function() {
    let id;

    $.ajax({
        url: '/api/modules',
        success: function(info) {
            let $select = $("#moduloCondiciones");
            $select.empty();

            $select.append('<option disabled selected>Seleccionar</option>');

            for (let i = 0; i < info.length; i++)
                $select.append(`<option value=${info[i].id}>${info[i].modulo}</option>`);
        },
        error: function(response) {
            console.log(response);
        }
    })


    /* Mostrar objetos para adicionar/actualizar modulo */

    $('#adTiempos').click(function(e) {
        e.preventDefault();
        $('#btnguardarCondiciones').html('Crear');
        $("#frmadTiempos").slideToggle();
        $('#t_min').val('');
        $('#t_max').val('');
    });


    /* Cargar datos para Actualizar registros */

    $(document).on('click', '.link-editar', function(e) {
        e.preventDefault();

        id = this.id;
        let modulo = $(this).parent().parent().children().eq(1).text();
        let t_min = $(this).parent().parent().children().eq(2).text();
        let t_max = $(this).parent().parent().children().eq(3).text();

        $('#btnguardarCondiciones').html('Actualizar');
        $("#frmadTiempos").slideDown();
        $('input:text[name=txtModulo]').hide();
        $(`#moduloCondiciones option:contains(${modulo})`).prop('selected', true);
        $('#t_min').val(t_min);
        $('#t_max').val(t_max);

    });

    /* Almacenar Registros */

    $('#btnguardarCondiciones').click(function(e) {
        e.preventDefault();

        let modulo = $('#moduloCondiciones').val();
        let t_min = parseInt($('#t_min').val());
        let t_max = parseInt($('#t_max').val());

        if (modulo === null || isNaN(t_min) || isNaN(t_max)) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos.");
            return false;
        } else if (t_min >= t_max) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("El tiempo Máximo debe ser mayor al tiempo Mínimo.");
            return false;
        }


        $.ajax({
            type: "POST",
            //url: "php/c_condiciones.php",
            url: '/api/saveConditions',
            data: { id: id, modulo: modulo, t_min: t_min, t_max: t_max },

            success: function(data) {
                notifications(data)
  
            }
        });
    });


    /* Borrar registros */

    $(document).on('click', '.link-borrar', function(e) {
        e.preventDefault();

        let id = $(this).parent().parent().children().first().text();
        var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

        confirm.set('onok', function(r) {
            if (r) {
                $.ajax({
                    'method': 'POST',
                    'url': 'php/c_condiciones.php',
                    'data': { operacion: "2", id: id }
                });
                refreshTable();
                alertify.set("notifier", "position", "top-right");
                alertify.success("Registro Eliminado.");
            }
        });
    });

    /* Actualizar tabla */

    function refreshTable() {
        $('#listarCondiciones').DataTable().clear();
        $('#listarCondiciones').DataTable().ajax.reload();
    }

});