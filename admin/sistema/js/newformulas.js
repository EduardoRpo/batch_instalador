let materialSelect

$('#instructivosBase').click(function(e) {
    e.preventDefault()
    $(location).prop('href', 'bases.php')
})

$('#instructivosPersonalizados').click(function(e) {
    e.preventDefault()
    $(location).prop('href', 'instructivo.php')
})

$('.contenedor-menu .menu a').removeAttr('style')
    /* $('#link_formulas').css('background', 'coral') */
$('.contenedor-menu .menu ul.menu_formulas').show()
$('#link_bases').css('background', 'coral')

/* Cargue select referencias */

granelNoFormulas()

/* const selectReferencias = () => {
    $.ajax({
        method: 'POST',
        url: 'php/desarrollo/newformulas.php',
        data: { operacion: '1' },

        success: function(response) {
            let info = JSON.parse(response)
            let $selectProductos = $('#cmbReferenciaProductos')
            const array = $.map(info, function(value, index) {
                return [value]
            })
            cargarSelect(array, $selectProductos)
        },
        error: function(response) {
            console.log(response)
        },
    })
} */

//selectReferencias()

/* cargar Selects */

/* const cargarSelect = (data, select) => {
    select.empty()
    select.append(`<option disabled selected>Seleccione</option>`)
    $.each(data, function(i, value) {
        select.append(`<option value ="${value}">${value}</option>`)
    })
} */

/* Cargue de Parametros de Control en DataTable */

const cargarMateriaPrima = () => {
    tabla = $('#tblMateriasPrimas').DataTable({
        destroy: true,
        scrollY: '40vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            method: 'POST',
            url: 'php/desarrollo/newformulas.php',
            data: { operacion: '2' },
            dataSrc: '',
        },
        columns: [{ data: 'referencia' }, { data: 'nombre' }],
    })
}

cargarMateriaPrima()

$(`#tblMateriasPrimas tbody`).on('click', 'tr', function() {
    materialSelect = tabla.row(this).data()
    cargartblMateriaprima()
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected')
    } else {
        tabla.$('tr.selected').removeClass('selected')
        $(this).addClass('selected')
    }
})

/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

/* $('#cmbReferenciaProductos').change(function(e) {
    e.preventDefault()
    let seleccion = $('select option:selected').val()

    $.ajax({
        type: 'POST',
        url: 'php/c_formulas.php',
        data: { operacion: '2', referencia: seleccion },

        success: function(response) {
            var info = JSON.parse(response)
            $('#txtnombreProducto').val('')
            $('#txtnombreProducto').val(info.nombre_referencia)
        },
    })
}) */

/* Cargar Materia prima a guardar con la seleccion de la referencia */
let sum = 0
const cargartblMateriaprima = () => {
    const t = $('#tblFormula').DataTable()
    alertify.prompt(
        'Formula',
        'Ingrese el valor del porcentaje',
        '',
        function(evt, value) {
            if (value <= 0) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('El valor ingresado debe ser mayor a cero')
                return false
            }
            sum = sum + parseFloat(value)
            t.row
                .add([
                    materialSelect.referencia,
                    materialSelect.nombre,
                    value,
                    `<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>`,
                ])
                .draw(false)
            $('#totalPorcentajeFormulas').val(sum)
            if (sum > 100) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('La formula sobrepasa el 100%')
            }
        },
        function() {
            alertify.error('Cancel')
        },
    )
}

/* Almacenar Registros */

$('#guardarFormula').click(function(e) {
    e.preventDefault()
    let operacion = 3
    let ref_producto = $('#cmbReferenciaProductos').val()
    const t = $('#tblFormula').DataTable()
    var data = t.rows().data()
    array = []

    for (let i = 0; i < data.length; i++) {
        data[i].pop()
        array.push(data[i])
    }

    if (ref_producto === null) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Seleccione la referencia')
        return false
    }

    if (data.length == 0) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Cargue la formula')
        return false
    }

    $.ajax({
        type: 'POST',
        url: 'php/desarrollo/newformulas.php',
        data: { operacion, ref_producto, array },

        success: function(r) {
            if (r == 1) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.success('Almacenada con éxito.')
            } else {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('No almacenado. Valide nuevamente.')
            }
            limpiarDatatable(data.length)
        },
    })
})

/* Borrar registros */

$('#tblFormula tbody').on('click', '.link-borrar', function(e) {
    e.preventDefault()
    let porcentaje = $(this).parent().parent().children().eq(2).text()

    const t = $('#tblFormula').DataTable()
    sum = sum - parseFloat(porcentaje)
    $('#totalPorcentajeFormulas').val(sum)
    t.row($(this).parents('tr')).remove().draw()

    alertify.set('notifier', 'position', 'top-right')
    alertify.success('Eliminado')
})

limpiarDatatable = (rows) => {
    const t = $('#tblFormula').DataTable()
    for (let i = 0; i <= rows; i++) t.row().remove().draw()
    selectReferencias()
    $('#txtnombreProducto').val('')
}

/* Actualizar tabla */

function refreshTable() {
    $('#tblFormula').DataTable().clear()
    $('#tblFormula').DataTable().ajax.reload()
}

/* Cargar referencias programadas */

const referenciaProgramada = () => {
    $.ajax({
        type: 'POST',
        url: 'php/desarrollo/newformulas.php',
        data: { operacion: 4 },
        success: function(r) {
            data = JSON.parse(r)
            if (data.length == 0) {
                $('#sinformula').hide()
            } else {
                for (let i = 0; i < data.length; i++) {
                    $('#sinformula').append(
                        `Referencia:<b> ${data[i].id_producto}</b> Nombre Referencia:<b> ${data[i].nombre_referencia}<b><br> `,
                    )
                }
            }
        },
    })
}

referenciaProgramada()