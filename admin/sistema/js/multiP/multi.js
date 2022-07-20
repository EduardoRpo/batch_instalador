$(document).ready(function() {

    let refNameMulti
    let Shref

    $('#adicionarMulti').click(function(e) {
        $('#ModalCrearMulti').modal('show');
        cargarSelectorProductos();
    });


    /* Eliminar multipresentacion */

    $("#cmbmulti").on('change', function() {
        refNameMulti = $(this).val();
        Shref = $(this).val();
    })

    $('#btnEliminarMulti').click(function(e) {
        e.preventDefault();
        let granel = refNameMulti[0].slice(0, -3)

        if (granel == 'Granel' || granel == 'Granel-') {
            alertify.set("notifier", "position", "top-right");
            alertify.error("No puede eliminar el granel como Multipresentación");
            return false; 
        }
        else
        { 
        $.ajax({

            url: `/api/deleteMulti/${Shref}`,
            success: function(data) {
                notificaciones(data)
            }
        });
    }
});
});

/* Cargar productos */

function cargarSelectorProductos() {

    $.ajax({
        url: '/api/adminProducts',
        success: function(response) {

            let $select = $('#cmbproductos');

            $.each(response, function(i, value) {
                $select.append('<option value ="' + value.referencia + '">' + value.referencia + ' - ' + value.nombre_referencia + '</option>');
            });
            iniciarselectorbusqueda();
        },
        error: function(response) {
            console.log(response);
        }
    })
}


/* Filtrar productos */

function iniciarselectorbusqueda() {
    opts = $('#cmbproductos option').map(function() {
        return [
            [this.value, $(this).text()]
        ];
    });
}

$('#busquedaproductos').keyup(function() {
    var rxp = new RegExp($('#busquedaproductos').val(), 'i');
    var optlist = $('#cmbproductos').empty();
    opts.each(function() {
        if (rxp.test(this[1])) {
            optlist.append($('<option/>').prop('value', this[0]).text(this[1]));
        }
    });
});


/* Seleccion y  pasar datos */

$().ready(function() {
    $('#seleccionar').click(function() {
        return !$('#cmbproductos option:selected').remove().appendTo('#cmbmulti');
    });
    $('#borrar').click(function() {
        return !$('#cmbmulti option:selected').remove().appendTo('#cmbproductos');
    });
    //('.quitartodos').click(function() { $('#cmbmulti option').each(function() { $(this).remove().appendTo('#cmbproductos'); }); });
    //$('.pasartodos').click(function() { $('#cmbproductos option').each(function() { $(this).remove().appendTo('#cmbmulti'); }); });
    //$('.submit').click(function() { $('#cmbmulti option').prop('selected', 'selected'); });
});

/* Ocultar y mostrar advertencias */

$("#busquedamulti").click(function() {
    $(".warning").prop('hidden', false);
});

/* Buscar multipresentaciones */

$('#btnBuscarMulti').click(function(e) {
    e.preventDefault();

    const busqueda = $('#busquedamulti').val();

    $.ajax({
        type: "POST",
        url: '/api/adminSearch',
        data: { referencia: busqueda },

        success: function(response) {

            if (response == 2 || response == 3) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("La referencia no tiene Multipresentación");
            } else {
                const info = JSON.parse(response);
                const $select = $('#cmbmulti');

                $.each(info, function(i, value) {
                    $select.append(`<option value =${value.referencia}>${value.referencia} - ${value.nombre_referencia} </option>`);
                });
            }

        }
    });
});

/* Crear multipresentacion */

$(document).ready(function() {
    $('#btnCrearMulti').click(function(e) {
        e.preventDefault();
        let multi = [];

        $("#cmbmulti option").each(function() {
            multi.push($(this).prop('value'));
        });

        if (multi.length < 2) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione al menos dos productos");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/api/saveMulti",
            data: { multi: multi },

            success: function(data) {
                notificaciones(data);
                
            }
        });
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#tblMulti').DataTable().clear();
    $('#tblMulti').DataTable().ajax.reload();
}