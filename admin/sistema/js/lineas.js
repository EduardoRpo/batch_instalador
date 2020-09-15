$('.contenedor-menu .menu a').removeAttr('style');
$('#link4').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

/* Cargue de lineas*/

$(document).ready(function () {
    $("#listarLineas").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_lineas.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "densidad" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Ocultar */

$('#adLineas').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    
});

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/operacionesDespejedelinea.php',
                'data': { operacion: "2", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().first().text();

    $.ajax({
        method: 'POST',
        url: 'php/operacionesDespejedelinea.php',
        data: { operacion: "3", id: id },

        success: function (response) {
            var info = JSON.parse(response);
            $('#pregunta').val(info.pregunta);
            $('#resp').val(info.resp);
            $('#btnguardarPregunta').html('Actualizar');
            $('.tpregunta').html('Actualizar Registros');
            $('#modalDespejedeLinea').modal('show');
            refreshTable();
        },
        error: function (response) {
            console.log(response);
        }
    });
});


/* Almacenar Registros */

$(document).ready(function () {
    $('#btnguardarPregunta').click(function (e) {
        e.preventDefault();
        var datos = $('#frmpreguntas').serialize();
        $.ajax({
            type: "POST",
            url: "php/operacionesDespejedelinea.php",
            data: datos,
            //data: {operacion : "3", id : id},
            success: function (r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right"); alertify.success("Agregado con éxito.");
                    document.getElementById("frmagregarUsuarios").reset();
                } else {
                    alertify.set("notifier", "position", "top-right"); alertify.error("Usuario No Registrado.");
                }
            }
        });
        //return false;
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#listarDespeje').DataTable().clear();
    $('#listarDespeje').DataTable().ajax.reload();
}