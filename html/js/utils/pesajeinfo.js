let flagWeight = false;

$.ajax({
    url: `../../api/questions/1`,
    type: 'GET'
}).done((data, status, xhr) => {
    $('#preguntas-div').html('');
    data.forEach((question, indx) => {
        $('#preguntas-div').append(`<div class="col-md-10 col-2 align-self-right">
                    <a for="recipient-name" class="col-form-label">${question.pregunta}</a>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" class="questions" name="question-${question.id}" value="si"/>
                    </label>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" name="question-${question.id}" value="no"/>
                    </label>
                  </div>`);
    });

});

$.ajax({
    url: `../../api/cargos`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach((cargo, indx) => {
        $(`#cargo-${indx + 1}`).val(cargo.cargo);
    });

});



let tablePesaje = $('#tablePesaje').dataTable({
    ajax: {
        url: `../../api/materiasp/${referencia}`,
        dataSrc: ''
    },
    paging: false,
    info: false,
    searching: false,
    sorting: false,
    columns: [
        {
            title: 'Referencia',
            data: 'referencia'
        },
        {
            title: 'Materia Prima',
            data: 'alias'
        },
        {
            title: 'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">Kg</a>)',
            className: 'conversion_weight_column',
            data: 'porcentaje',
            render: (data, type, row) => {
                if (flagWeight) {
                    return data * batch.tamano_lote;
                } else {
                    return (data * batch.tamano_lote) / 1000;
                }

            }
        },
        {
            title: 'Impresión',
            defaultContent: '<a href="#" data-toggle="modal" data-target="#imprimirEtiquetas"><i class="large material-icons">print</i></a>'
        }
        
    ]
});

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
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'error',
                title: 'Completa todas las preguntas'
              })

            
            /* toastr.error("Antes de continuar, complete las preguntas", "Error", {
                "timeOut": "5000",
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true

            }); */
            /* swal({
                title: "",
                text: "Antes de seguir, Completa las preguntas",
                icon: "error",
                button: "Cerrar",
              }); */
            /* $.alert({
                title: 'Atencion!',
                content: 'Completa las preguntas primero',
            }); */
        }
    });

});


Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha_pesaje').val(new Date().toDateInputValue());
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue());

//Conversion medidas de peso

function cambioConversion() {
    flagWeight = !flagWeight;
    tablePesaje.api().ajax.reload();
    $(tablePesaje.api().column(2).header()).html(`Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${flagWeight ? 'Kg' : 'g'}</a>)`);
}


function enviar() {
    $('#myModal2').modal('hide');
    let usuario = $('#usuariomodal2').val();
    let contrasena = $('#contrasenamodal2').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {

            let parent = $('#in_realizado').parent();
            $('#in_realizado').remove();
            parent.append(`<img id="in_verificado" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar2() {

    $('#myModal3').modal('hide');
    let usuario = $('#usuariomodal3').val();
    let contrasena = $('#contrasenamodal3').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {
            let parent = $('#in_verificado').parent();
            $('#in_verificado').remove();
            parent.append(`<img id="in_verificado" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar3() {
    $('#myModal4').modal('hide');
    let usuario = $('#usuariomodal4').val();
    let contrasena = $('#contrasenamodal4').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {

            let parent = $('#in_realizado_2').parent();
            $('#in_realizado_2').remove();
            parent.append(`<img id="in_realizado_2" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar4() {

    $('#myModal5').modal('hide');
    let usuario = $('#usuariomodal5').val();
    let contrasena = $('#contrasenamodal5').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {
            let parent = $('#in_verificado_2').parent();
            $('#in_verificado_2').remove();
            parent.append(`<img  id="in_verificado_2" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}