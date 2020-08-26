/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkDespeje').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir').show();

/* Cargue de Parametros de Control en DataTable */

$(document).ready(function () {
    $("#listarDespeje").DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_despejeLinea.php",
            data: { operacion: "1" },
        },

        "columns": [
            { "data": "id" },
            { "data": "pregunta" },
            {
                "data": "resp", className: "centrado",
                render: (data, type, row) => {
                    'use strict';
                    return data == 1 ? 'Si' : 'No';
                }
            },
            { "data": "modulo" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }

        ]
    });
});

/* Mostrar formulario adicionar preguntas */

$('#adicionarParametro').click(function (e) {
    e.preventDefault();
    $("#frmadParametro").slideToggle();
    $('#txtIdPregunta').val('');
    cargarSelectorProceso();
});

/* Cargar selector Proceso */

function cargarSelectorProceso() {

    $.ajax({
        method: 'POST',
        url: 'php/c_despejeLinea.php',
        data: { operacion: "2" },

        success: function (response) {
            var info = JSON.parse(response);

            let $select = $('#cmbProceso');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    let id = $(this).parent().parent().children().first().text();
    let pregunta = $(this).parent().parent().children().eq(1).text();
    let respuesta = $(this).parent().parent().children().eq(2).text();

    $('#frmadParametro').slideDown();
    $('#txtIdPregunta').val(id);
    $('#txtPregunta').val(pregunta);
    $('#txtRespuesta').val(respuesta);

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
                'url': 'php/c_despejeLinea.php',
                'data': { operacion: "3", id: id }
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });
});


/* Almacenar Registros */

$('#btnguardarProceso').click(function (e) {
    e.preventDefault();
    
    let id = $('#txtIdPregunta').val();


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