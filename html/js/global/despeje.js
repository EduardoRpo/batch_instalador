
/* cargue de preguntas */

function carguepreguntas(data) {
    proceso = data;

    $.ajax({
        url: `../../api/questions/${proceso}`,
        type: 'GET'
    }).done((data, status, xhr) => {
        cantidadpreguntas = data.length;
        
        $('#preguntas-div').html('');
        data.forEach((question, indx) => {
            $('#preguntas-div').append(`
                    <a for="recipient-name" class="col-form-label" id="${question.id}">${question.pregunta}</a>
                    <label class="checkbox"> 
                    <input type="radio" class="questions" name="question-${question.id}" id="${question.id_pregunta}" value="1"/></label>
                    <label class="checkbox"> 
                    <input type="radio" name="question-${question.id}" id="${question.id_pregunta}" value="0"/></label>`
            );
        });

    });
}


/* Cargar desinfectantes */

function desinfectantes() {

    $.ajax({
        url: `../../api/desinfectantes`,
        type: 'GET'
    }).done((data, status, xhr) => {
        data.forEach(desinfectante => {
            $('#sel_producto_desinfeccion').append(`<option value="${desinfectante.id}">${desinfectante.nombre}</option>`);
        });
    });
}

//Validacion campos de preguntas diligenciados

$('.in_desinfeccion').click((event) => {
    event.preventDefault();

    let flag = false;
    $('.questions').each((indx, question) => {
        if (flag) {
            return;
        }
        let name = $(question).attr('name');
        if (!$(`input[name='${name}']:radio`).is(':checked')) {
            flag = true;

            $.alert({
                theme: 'white',
                icon: 'fa fa-warning',
                title: 'Samara Cosmetics',
                content: 'Antes de continuar, complete todas las preguntas',
                confirmButtonClass: 'btn-info',
            });
        }
    });
});


function validarParametrosControl() {
    let flag = false;
    $('.questions').each((indx, question) => {
        if (flag) {
            return;
        }
        let name = $(question).attr('name');
        if (!$(`input[name='${name}']:radio`).is(':checked')) {
            flag = true;

            $.alert({
                theme: 'white',
                icon: 'fa fa-warning',
                title: 'Samara Cosmetics',
                content: 'Antes de continuar, complete todas las preguntas',
                confirmButtonClass: 'btn-info',
            });
            completo = 0;
            return false;
        }
        completo = 1;
    });
}
