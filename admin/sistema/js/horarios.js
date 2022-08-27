let hora1
let hora2
const tiempos = []

/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_horarios').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_horarios').show()

/* Cargar horarios */

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'php/horarios.php',
        data: { operacion: 1 },
        success: function(response) {
            if (response == '0') return false
            data = JSON.parse(response)

            $('#hora1').html(data[0].tiempo)
            $('#hora2').html(data[1].tiempo)
        },
    })
})

$('#btnSeleccionarHorariosBatch').click(function(e) {
    e.preventDefault()

    time1 = $('#hora1').html()
    time2 = $('#hora2').html()
    time = $('#timeOne').val()

    if (time == '') {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Ingrese una hora.')
        return false
    }

    if (time1 == '') $('#hora1').html(time)
    else {
        if (time < time2) {
            $('#hora1').html(time)
        } else {
            $('#hora2').html(time)
        }
    }
})

$(document).on('click', '.link-eliminar', function(e) {
    e.preventDefault()
    id = $(this).prop('id')
    id == 1 ? tiempos.shift() : tiempos.pop()
    id == 1 ? $('#hora1').html('') : $('#hora2').html('')
})

$('#btnEliminarHorariosBatch').click(function(e) {
    e.preventDefault()
    tiempos.push(tiempo)
})

$('#btnGuardarHorariosBatch').click(function(e) {
    e.preventDefault()

    time1 = $('#hora1').html()
    time2 = $('#hora2').html()

    if (time1 == '' && time2 == '') {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Establezca los tiempos para la carga de los pedidos.')
        return false
    }

    tiempos.push(time1)
    tiempos.push(time2)

    $.ajax({
        type: 'POST',
        url: 'php/horarios.php',
        data: { tiempos, operacion: 3 },
        success: function(response) {
            if (response == 1) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.success('Horarios Almacenados Correctamente.')
            } else {
                alertify.set('notifier', 'position', 'top-right')
                alertify.success('Error al almacenar los horarios, intente de nuevo.')
            }
        },
    })
})

/* $("#btnEjecutarHorariosBatch").click(function (e) {
  e.preventDefault();

  $.when(ejecutarPedidos()).then(function () {
    alertify.success("Pedidos cargados y/o actualizados correctamente.");
  });
}); */

//setTimeout("ejecutarPedidos", primeraHora());
//setTimeout("ejecutarPedidos", segundaHora());

function primeraHora() {
    horaActual = new Date()
    horaProgramada = new Date()
    horaProgramada.setHours(hora1[0])
    horaProgramada.setMinutes(hora1[1])
    horaProgramada.setSeconds(0)
    tiempoEjecucion = horaProgramada.getTime() - horaActual.getTime()
    return tiempoEjecucion
}

function segundaHora() {
    horaActual = new Date()
    horaProgramada = new Date()
    horaProgramada.setHours(hora2[0])
    horaProgramada.setMinutes(hora2[1])
    horaProgramada.setSeconds(0)
    tiempoEjecucion = horaProgramada.getTime() - horaActual.getTime()
    return tiempoEjecucion
}

function ejecutarPedidos() {
    $.post('/api/pedidos/nuevos', function(data, textStatus, jqXHR) {})
}