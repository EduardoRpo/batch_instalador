/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link5').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

$(document).ready(function () {
    let tabla;
    for (i = 1; i < 9; i++) {
        tabla = $(`#tbl${i}`);
        if (i <= 4)
            cargarTablas(tabla, i);
        else
            cargarTablas2(tabla, i);


    }
})

/* Cargue de Nombre Productos*/

function cargarTablas(tabla, operacion) {
    $(tabla).DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_propiedades-producto.php",
            data: { operacion: operacion },
        },

        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
};


function cargarTablas2(tabla, operacion) {
    $(tabla).DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_propiedades-producto.php",
            data: { operacion: operacion },
        },

        "columns": [
            { "data": "id" },
            { "data": "min" },
            { "data": "max" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
};

/* Ocultar */

$('#adNombreProducto').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    cargarSelectorLinea();
});

function cargarSelectorLinea() {

    $.ajax({
        method: 'POST',
        url: 'php/c_maquinaria.php',
        data: { operacion: "4" },

        success: function (response) {
            var info = JSON.parse(response);

            let $select = $('#cmbLinea');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.linea + '</option>');
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
}

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


/*      var confirm= alertify.confirm('Samara Cosmetics','¿Está seguro de actualizar este registro?',null,null).set('labels', {ok:'Si', cancel:'No'});

     confirm.set('onok', function(r){
         if(r){
             $.ajax({
                 'method' : 'GET',
                 'url' : `php/accionesDespejedeLinea.php?link-editar=${id}`,
                 'data' : 'id',
             });
             refreshTable();
             alertify.success('Registro Eliminado');
         }
     });   */