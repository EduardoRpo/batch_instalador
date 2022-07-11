let editar;
let opts;
cargarSelectorProductos();

/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link_multipresentacion').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_productos').show();

/* Cargue de Multipresentacion en DataTable */

$(document).ready(function() {
    $("#tblMulti").DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_multipresentacion.php",
            data: { operacion: 6 },
        },

        "columns": [
            { "data": "referencia" },
            { "data": "nombre_referencia" },
            { "data": "multi", className: "centrado" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>", className: "centrado" },
        ]
    });
});

/* Cargar Modal */

$('#adicionarMulti').click(function(e) {
    e.preventDefault();
    $('#ModalCrearMulti').modal('show');

});

/* Actualizar Modal */


/* Eliminar multipresentacion */
$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();

    const referencia = $(this).parent().parent().children().first().text();

    $.ajax({
        type: "POST",
        url: 'php/c_multipresentacion.php',
        data: { referencia, operacion: 5 },

        success: function(response) {
            refreshTable();
            alertify.set("notifier", "position", "top-right");
            alertify.success("Multipresentacion Eliminada");
        }
    });
});



/* Cargar productos */

function cargarSelectorProductos() {

    $.ajax({
        method: 'POST',
        url: 'php/c_multipresentacion.php',
        data: { operacion: 1 },

        success: function(response) {
            var info = JSON.parse(response);

            let $select = $('#cmbproductos');
            $select.empty();

            $.each(info.data, function(i, value) {
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
            optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
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
    //$('.pasartodos').click(function() { $('#cmbproductos option').each(function() { $(this).remove().appendTo('#cmbmulti'); }); });
    //$('.quitartodos').click(function() { $('#cmbmulti option').each(function() { $(this).remove().appendTo('#cmbproductos'); }); });
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
        url: 'php/c_multipresentacion.php',
        data: { operacion: 4, referencia: busqueda },

        success: function(response) {

            if (response == 2 || response == 3) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("La referencia no tiene Multipresentación");
            } else {
                const info = JSON.parse(response);
                const $select = $('#cmbmulti');
                //$select.empty();

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
            multi.push($(this).attr('value'));
        });

        if (multi.length < 2) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione al menos dos productos");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "php/c_multipresentacion.php",
            data: { operacion: 2, multi: multi },

            success: function(r) {
                if (r > 1) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Multipresentación creada satisfactoriamente.");
                    $('#ModalCrearMulti').modal('hide');
                    refreshTable();
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Error.");
                }
            }
        });
    });
});


/* Eliminar multipresentacion */

$(document).ready(function() {
    $('#btnEliminarMulti').click(function(e) {
        e.preventDefault();
        let multi = [];

        $("#cmbmulti option").each(function() {
            multi.push($(this).attr('value'));
        });

        if (multi.length < 1) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione al menos dos productos");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "php/c_multipresentacion.php",
            data: { operacion: 3, multi: multi },

            success: function(r) {
                if (r > 1) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Multipresentacion eliminada.");
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Error.");
                }
            }
        });
    });
});

/* Actualizar tabla */

function refreshTable() {
    $('#tblMulti').DataTable().clear();
    $('#tblMulti').DataTable().ajax.reload();
}