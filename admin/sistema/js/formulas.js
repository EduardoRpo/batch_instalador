let tabla
let editar
let tbl
let ref

/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style')
$('#link_formulas').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_productos').show()

$('.contenedor-menu .menu ul.menu_formulas').show()

/* $('#instructivos').click(function(e) {
    e.preventDefault();
    $(".contenedor-menu .menu ul.menu_instructivos").toogle();
    
}) */
;


/* Cargue select referencias */

$.ajax({
    url: '/api/granel',
    success: function(info) {
        let $selectProductos = $('#cmbReferenciaProductos')
        cargarSelect(info, $selectProductos)
    },
    error: function(response) {
        console.log(response)
    },
})

/* Crear Formulas */

$('#adicionarFormula').click(function(e) {
    e.preventDefault()
    editar = 0

    $('#frmadFormulas').slideToggle()
    $('#textReferencia').hide()
    $('#cmbreferencia').show()

    $('#txtMateria-Prima').attr('disabled', true)
    $('#alias').attr('disabled', true)
})

$('#formula_r').change(function(e) {
    e.preventDefault()
    $('#cardformula_f').hide()
    $('#cardformula_r').show()
    tbl = 'r'
    materiaPrima('r')
})

$('#formula_f').change(function(e) {
    e.preventDefault()
    $('#cardformula_r').hide()
    $('#cardformula_f').show()
    tbl = 'f'
    materiaPrima('f')
})


/* cargar Selects */

const cargarSelect = (data, select) => {
    ref = data
    select.empty()
    select.append(`<option disabled selected>Seleccione</option>`)
    select.append(`<option value='1'>Todos</option>`)
    $.each(data, function(i, value) {
        select.append(
            `<option value ="${value.referencia}">${value.referencia}</option>`,
        )
    })
}

/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$('#cmbReferenciaProductos').change(function(e) {
    e.preventDefault()
    let seleccion = $('select option:selected').val()

    const resultado = ref.find(refer => refer.referencia === seleccion);

    $("#txtnombreProducto").val("");

    if (seleccion != 1)
        $("#txtnombreProducto").val(resultado.nombre_referencia);


    /* $.ajax({
        type: 'POST',
        url: 'php/c_formulas.php',
        data: { operacion: '2', referencia: seleccion },

        success: function(response) {
            var info = JSON.parse(response)
            $('#txtnombreProducto').val('')
            $('#txtnombreProducto').val(info.nombre_referencia)
        },
    }) */

    if (seleccion == 1) {
        $('#formulas').hide()
        $('#formghost').hide()
        $('#allformulas').show()
        cargarTablaTodasFormulas(seleccion)
    } else {
        $('#formulas').show()
        $('#formghost').show()
        $('#allformulas').hide()
        cargarTablaFormulas(seleccion)
    }
    if (seleccion != 1) cargar_formulas_f(seleccion)
})

/* Cargar Materia prima a guardar con la seleccion de la referencia */

$('#cmbreferencia').change(function(e) {
    e.preventDefault()
    let referencia = $('#cmbreferencia option:selected').text()
    $.ajax({
        type: 'POST',
        url: 'php/c_formulas.php',
        data: { operacion: '5', referencia, tbl },

        success: function(response) {
            var info = JSON.parse(response)
            $('#txtMateria-Prima').val(info[0].nombre)
            $('#alias').val(info[0].alias)
        },
    })
})

/* Almacenar Registros */

function guardarFormulaMateriaPrima() {
    //let operacion = $("input:radio[name=formula]:checked").val();
    let operacion = 6
    let ref_producto = $('#cmbReferenciaProductos').val()
    let ref_materiaprima = $('#cmbreferencia').val()
    let porcentaje = parseFloat($('#porcentaje').val())

    ref_materiaprima === null ?
        (ref_materiaprima = $('#textReferencia').val()) :
        ref_materiaprima

    if (ref_producto === null) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Seleccione la referencia')
        return false
    }

    if (ref_materiaprima === null) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Seleccione la referencia de la materia prima')
        ref_materiaprima = $('#textReferencia').val()
        return false
    }

    if (
        porcentaje === undefined ||
        porcentaje === null ||
        porcentaje === '' ||
        isNaN(porcentaje)
    ) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('Ingrese todos los campos')
        return false
    }

    if (porcentaje <= 0) {
        alertify.set('notifier', 'position', 'top-right')
        alertify.error('El valor de porcentaje no es un número valido')
        return false
    }

    $.ajax({
        type: 'POST',
        url: 'php/c_formulas.php',
        data: {
            operacion,
            ref_producto,
            ref_materiaprima,
            porcentaje,
            tbl,
            editar,
        },

        success: function(r) {
            if (r == 1) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.success('Almacenada con éxito.')
            } else if (r == 3) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.success('Registro actualizado.')
                refreshTable()
            } else {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Error.')
            }

            $('#cmbreferencia').val('')
            $('#txtMateria-Prima').val('')
            $('#alias').val('')
            $('#porcentaje').val('')
            refreshTable()
        },
    })
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e) {
    e.preventDefault()

    editar = 1
    let id = $(this).parent().parent().children().first().text()
    let mp = $(this).parent().parent().children().eq(1).text()
    let alias = $(this).parent().parent().children().eq(2).text()
    let porcentaje = $(this).parent().parent().children().eq(3).text()
    porcentaje = parseFloat(porcentaje)
    if ($(this).hasClass('tr')) tbl = 'r'
    else tbl = 'f'

    $('#cmbreferencia').val('')
    $('#frmadFormulas').slideDown()
    $('#textReferencia').show()
    $('#cmbreferencia').hide()

    $('#textReferencia').val(id).prop('disabled', true)
    $('#txtMateria-Prima').val(mp).prop('disabled', true)
    $('#alias').val(alias).prop('disabled', true)
    $('#porcentaje').val(porcentaje)
})

/* Borrar registros */

$(document).on('click', '.link-borrar', function(e) {
    e.preventDefault()

    let ref_materiaprima = $(this).parent().parent().children().first().text()
    let ref_producto = $('#cmbReferenciaProductos').val()

    if ($(this).hasClass('tr')) tbl = 'r'
    else tbl = 'f'

    var confirm = alertify
        .confirm(
            'Samara Cosmetics',
            '¿Está seguro de eliminar este registro?',
            null,
            null,
        )
        .set('labels', { ok: 'Si', cancel: 'No' })
    confirm.set('onok', function(r) {
        if (r) {
            $.post(
                'php/c_formulas.php', { operacion: '8', ref_producto, ref_materiaprima, tbl },
                function(data, textStatus, jqXHR) {
                    refreshTable()
                    alertify.set('notifier', 'position', 'top-right')
                    alertify.success('Eliminado')
                },
            )
        }
    })
})

/* Carga tabla de formulas para todos los productos */

function cargarTablaTodasFormulas(referencia) {
    tabla = $('#tblFormulastodas').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        oLanguage: { sProcessing: "<div id='loader'></div>" },
        dom: 'Bfrtip',
        order: [
            [0, 'asc']
        ],
        buttons: [{
            extend: 'excel',
            className: 'btn btn-primary',
            exportOptions: {
                columns: [0, 1, 2, 4],
            },
        }, ],
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            method: 'POST',
            url: 'php/c_formulas.php',
            data: { operacion: '3', referencia },
            dataSrc: '',
        },

        columns: [
            { title: 'Producto', data: 'id_producto' },
            { title: 'Referencia MP', data: 'referencia' },
            { title: 'Materia prima', data: 'nombre' },
            { title: 'Alias', data: 'alias' },
            {
                title: '%',
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                title: 'Acciones',
                defaultContent: "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],
    })
}

/* Cargue de Parametros de Control en DataTable */
/*
function cargarTablaFormulas(referencia) {
    tabla = $('#tblFormulas').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excel',
            className: 'btn btn-primary',
            exportOptions: {
              columns: [0, 3],
            },
          },
        ], 
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            method: 'POST',
            url: 'php/c_formulas.php',
            data: { operacion: '3', referencia },
            dataSrc: '',
        },

        columns: [
            { title: 'Referencia', data: 'referencia' },
            { title: 'Materia prima', data: 'nombre' },
            { title: 'Alias', data: 'alias' },
            {
                title: '%',
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                title: 'Acciones',
                defaultContent: "<a href='#' <i class='large material-icons link-editar tr' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a> <a href='#' <i class='large material-icons link-borrar tr' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],

        footerCallback: function(row, data, start, end, display) {
            total = this.api()
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b)
                }, 0)
            total = total.toFixed(2)
            $('#totalPorcentajeFormulas').val(`Total ${total}%`)
            if (total != 100) $('.alertFormula').show()
            else $('.alertFormula').hide()

        },
    })
}

/* Cargue de Parametros de Control en DataTable */
/*
function cargar_formulas_f(referencia) {
    tabla = $('#tbl_formulas_f').DataTable({
        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        ajax: {
            method: 'POST',
            url: 'php/c_formulas.php',
            data: { operacion: '9', referencia },
            dataSrc: '',
        },

        columns: [
            { data: 'referencia' },
            { data: 'nombre' },
            { data: 'alias' },
            {
                data: 'porcentaje',
                className: 'centrado',
                render: $.fn.dataTable.render.number(',', '.', 3, '', '%'),
            },
            {
                defaultContent: "<a href='#' <i class='large material-icons link-editar tf' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a><a href='#' <i class='large material-icons link-borrar tf' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>",
            },
        ],
        columnDefs: [{ width: '10%', targets: 0 }],

        footerCallback: function(row, data, start, end, display) {
            total = this.api()
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b)
                }, 0)
            total = total.toFixed(2)
            $('#totalPorcentajeFormulasInvima').val(`Total ${total}%`)
        },
    })
}
*/

/* Actualizar tabla */

function refreshTable() {
    $('#tblFormulas').DataTable().clear()
    $('#tblFormulas').DataTable().ajax.reload()
    $('#tbl_formulas_f').DataTable().clear()
    $('#tbl_formulas_f').DataTable().ajax.reload()
}