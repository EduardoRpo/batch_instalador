let flagWeight = false
let lotes = []
modulo = 2

function cargar(btn, idbtn) {
  sessionStorage.setItem('idbtn', idbtn)
  id = btn.id

  //Validacion de control de tanques
  if (
    id == 'pesaje_realizado' ||
    id == 'preparacion_realizado' ||
    id == 'aprobacion_realizado'
  ) {
    validar = controlTanques()
    if (validar == 0) {
      return false
    }
  }

  /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

  let seleccion = $('#sel_producto_desinfeccion').val()

  if (seleccion == 'Seleccione') {
    alertify.set('notifier', 'position', 'top-right')
    alertify.error('Seleccione el producto para desinfección.')
    return false
  }

  if (id !== 'despeje_realizado' && id !== 'pesaje_realizado') {
    if (id !== 'despeje_verificado') {
      if ($('#despeje_verificado').is(':disabled') == false) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error(
          'Primero ejecute la firma para Calidad en la sección de Despeje de Lineas y Procesos.',
        )
        return false
      }
    }
  }

  /* Validar que todos los registros se han seleccionado */
  let filas = $(tablePesaje).find('tbody tr').length
  if (filas != lotes.length) {
    alertify.set('notifier', 'position', 'top-right')
    alertify.error('Ingrese todos los lotes, seleccionando cada materia prima.')
    return false
  }

  /* Carga el modal para la autenticacion */

  $('#usuario').val('')
  $('#clave').val('')
  $('#m_firmar').modal('show')
}

/* habilitar botones */

function habilitarbotones() {
  $('.pesaje_realizado').prop('disabled', false)
}

/* Carga de Cargos  */

$.ajax({
  url: `../../api/cargos`,
  type: 'GET',
}).done((data, status, xhr) => {
  data.forEach((cargo, indx) => {
    $(`#cargo-${indx + 1}`).val(cargo.cargo)
  })
})

/* Exportar Datatable Materia Prima */
/* Formula Materia Prima  */

$(document).ready(function () {
  batch_record()
  tablePesaje = $('#tablePesaje').dataTable({
    ajax: {
      url: `../../api/materiasp/${referencia}`,
      dataSrc: '',
    },
    paging: false,
    info: false,
    searching: false,
    sorting: false,

    columns: [
      {
        title: 'Referencia',
        data: 'referencia',
        className: 'uniqueClassName',
      },
      {
        title: 'Materia Prima',
        data: 'alias',
      },
      {
        title: 'Lote',
        defaultContent: '',
        className: 'uniqueClassName valor',
      },
      {
        title:
          'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
        className: 'conversion_weight_column',
        data: 'porcentaje',
        className: 'uniqueClassName',

        render: (data, type, row) => {
          let tnq = $('#Notanques').val()

          if (tnq === '') {
            $('#Notanques').val(tanques).prop('disabled', true)
          }

          if (flagWeight) {
            return ((data / 100) * batch.tamano_lote)
              .toFixed(2)
              .replace('.', ',')
          } else {
            return ((data / 100) * batch.tamano_lote * 1000)
              .toFixed(2)
              .replace('.', ',')
          }
        },
      },
      {
        title:
          '<input type="text" class="form-control" id="Notanques" placeholder="Tanques" style="width:52px; text-align:center" onkeydown="calcularxNoTanques();">',
        data: 'porcentaje',
        className: 'uniqueClassName',
        render: (data, type, row) => {
          if (flagWeight) {
            return (((data / 100) * batch.tamano_lote) / $('#Notanques').val())
              .toFixed(2)
              .replace('.', ',')
          } else {
            return (
              ((data / 100) * batch.tamano_lote * 1000) /
              $('#Notanques').val()
            )
              .toFixed(2)
              .replace('.', ',')
          }
        },
      },
    ],
  })

  /* Seleccion multiple */
  tablePesaje.on('click', 'tbody tr', function () {
    /* Validar seleccion de tanque */

    validar = controlTanques()
    if (validar == 0) return false

    let linea = this
    /* cargar lote */

    alertify
      .prompt(
        'Samara Cosmetics - Trazabilidad Lotes MP',
        'Ingrese el Número del lote. <br><p style="font-size:13px;color:coral">Si cuenta con más de un lote separelos con un doble asterisco (**)<p>',
        '',
        function (evt, value) {
          if (value == 0 || value == '') {
            if (linea.firstChild.innerText != 10003) {
              alertify.set('notifier', 'position', 'top-right')
              alertify.error('El Lote no puede ser cero(0) o vacio para materias primas diferentes al agua.')
              return false
            }
          }

          $(linea).addClass('tr_hover')
          $(linea).addClass('not-active')
          linea.cells[2].innerText = value

          let fila = {}
          fila.lote = value
          fila.batch = idBatch
          fila.referenciaMP = linea.firstChild.innerText
          fila.tanque = tanque
          lotes.push(fila)
        },
        function () {
          alertify.error('Ingrese el número del lote de la materia prima')
        },
      )
      .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
  })
})

Date.prototype.toDateInputValue = function () {
  var local = new Date(this)
  local.setMinutes(this.getMinutes() - this.getTimezoneOffset())
  return local.toJSON().slice(0, 10)
}

$('#in_fecha_pesaje').val(new Date().toDateInputValue())
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue())

//Conversion medidas de peso

function cambioConversion() {
  flagWeight = !flagWeight
  tablePesaje.api().ajax.reload()
  $(tablePesaje.api().column(2).header()).html(
    `Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${
      flagWeight ? 'Kg' : 'g'
    }</a>)`,
  )
}

/* Calcular los tanques */

function calcularxNoTanques() {
  let tanques = $('#Notanques').val()

  if (tanques < 11) {
    tablePesaje.api().ajax.reload()
  } else {
    $('#Notanques').val(1)
    alertify.set('notifier', 'position', 'top-right')
    alertify.error('El número de Tanques debe ser menor a 11.')
    return false
  }
}

function deshabilitarbtn() {
  $('.pesaje_realizado')
    .css({ background: 'lightgray', border: 'gray' })
    .prop('disabled', true)
  $('.pesaje_verificado').prop('disabled', false)
}
