/* Mostrar formulario adicionar preguntas */

$('#adicionarParametro').click(function(e) {
    e.preventDefault();
    $("#frmadicionarPreguntaModulo").slideToggle();
    $('#btnguardarProceso').html('Crear');
    cargarSelectorProceso();
    cargarSelectorPreguntas();
});

/* Cargar selector Proceso */

function cargarSelectorProceso() {

    $.ajax({
        url:'/api/modules',

        success: function(data) {

            let $select = $('#cmbProceso');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(data, function(i, value) {
                $select.append('<option value ="' + value.id + '">' + value.modulo + '</option>');
            });
        },
        error: function(response) {
            console.log(response);
        }
    })
}

/* Cargar selector Preguntas */

function cargarSelectorPreguntas() {

    $.ajax({
        url: '/api/questions',

        success: function(data) {
            let $select = $('#cmbPregunta');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(data, function(i, value) {
                $select.append('<option value ="' + value.id + '">' + value.pregunta + '</option>');
            });
        },
        error: function(response) {
            console.log(response);
        }
    })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault();
    let id = this.id;
    let pregunta = $(this).parent().parent().children().eq(1).text();
    let respuesta = $(this).parent().parent().children().eq(2).text();
    let modulo = $(this).parent().parent().children().eq(3).text();
    console.log (modulo);


    $("#frmadicionarPreguntaModulo").slideDown();

    $(`#cmbPregunta option:contains(${pregunta})`).attr('selected', true);
    $(`#cmbRespuesta option:contains(${respuesta})`).attr('selected', true);
    $(`#cmbProceso option:contains(${modulo})`).attr('selected', true);


});

/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault();
    const id = this.id;
    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });

    confirm.set('onok', function(r) {
        if (r) {
            $.ajax({
                'url': `/api/deletelinesC/${id}`,
                success: function(data) {
                    notificaciones(data)
                }
            });
        }
    });
});


/* Almacenar Registros */

$('#btnguardarDespeje').click(function(e) {
    e.preventDefault();

    let pregunta = $('#cmbPregunta').val();
    let respuesta = $('#cmbRespuesta').val();
    let modulo = $('#cmbProceso').val();

    if (pregunta === null || respuesta === null || modulo === null) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los datos.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/api/savelinesC",
        data: { pregunta: pregunta, respuesta: respuesta, modulo: modulo },
        success: function(data) {
            notificaciones(data);
        }
    });
});


/* Actualizar tabla */

function refreshTable() {
    $('#tblDespeje').DataTable().clear();
    $('#tblDespeje').DataTable().ajax.reload();
}