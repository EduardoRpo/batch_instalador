
$('#unidadesxlote').number(true, 0, ',', '.');
$('#unidadesxlote').keydown(function (event) {
    if (event.keyCode == 9) {
        event.preventDefault();
    }
});
$('#unidadesxlote').change(function () {
    $('#tamanototallote').val($(this).val() * $('#name-data6').val() * $('#densidad_in').val());
    $('#tamanototallote').number(true, 2, ',', '.');
});

function onSubmit() {
    let fecha = $('#fecha').val()
    if (fecha !== '') {
        $('#filtrar1').val(1);
    } else {
        $('#filtrar1').val(0);
    }

    $('#tamanolotepresentacion').val($('#name-data6').val())
    console.log($('#form-submit-batch').serialize());
    return true;
}

//Borrado de Batch Record

function deleteBatch(event) {
    let id = $(event.currentTarget).attr('attr-id');
    Swal.fire({
        title: 'Está seguro?',
        text: "Esta acción no podra reversarse!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar!',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminarlo!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: `savebatch.php?del=${id}`,
                type: 'GET'
            }).done((data, status, xhr) => {
                //refreshTableBatch();
                location.href = '/html/crear-batch.php';
                Swal.fire(
                    'Eliminado!',
                    'El Batch Record ha sido eliminado.',
                    'success'
                )
            });
        }
    })
 
    /* function refreshTableBatch() {
        $('#example').DataTable().clear();
        $('#example').DataTable().ajax.reload();
    } */ 

    /*$.confirm({
          title : '¿Está seguro de Eliminar?',
          content: '',
          buttons: {
              confirmar: function () {
                  $.ajax({
                      url: `savebatch.php?del=${id}`,
                      type: 'GET'
                  }).done((data, status, xhr) => {
                      location.href = '/html/crear-batch.php';
                  });

              },
              cancelar: function () {
                  //$.alert('Canceled!');
              }
          }
      }); */
}

$('#example').on('hidden.bs.modal', function (e) {
    // do something...
    history.pushState(null, '', '/html/crear-batch.php');
    location.reload();
})

//Clonar un Batch Record

function clonar() {
    if ($("input[name='optradio']:radio").is(':checked')) {
        $('#ClonarModal').modal('show');
    } else {
        //$.alert('Seleccione un batch');
        //alertify.set("notifier","position", "top-center"); alertify.error("Para Clonar seleccione un Batch Record");
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
            title: 'Selecciona el Batch record a Clonar'
        })
    }
}

$('input:radio[name=optradio]').click(function () {
    $('#example tbody tr').removeClass('selected')
    $(this).parent().parent().addClass('selected')
});

$('#form_clonar').submit(function (event) {
    event.preventDefault();
    let form = $(this);
    let obj = form.serializeToJSON();
    obj.idbatch = $('input:radio[name=optradio]:checked').val();
    console.log(obj)
    $.ajax({
        url: '/api/clonebatch',
        type: 'post',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(obj)
    }).done((data, status, xhr) => {
        if (data.success) {
            location.reload();
        } else {
            $.alert('Error al clonar');
        }
    });
});


//Filtro de busqueda por fechas

/*$(document).ready(function () {
    $('#btnFiltrado').click(function (event) {
        event.preventDefault;
        var datos = $('#formFechas').serialize();
        //var url = form.attr('action');
        /!* alert(datos);
        return false;


        //var form = $($this);

        $.ajax({
            type: "POST",
            url: 'filtradofechas.php',
            data: datos,
            success: function (data) {
                if (data != "") {
                    $('#tabla-resultado').html();
                    $('#tabla-resultado').append(data);
                }
                alert('error');
            }

        });
    });
});*/
