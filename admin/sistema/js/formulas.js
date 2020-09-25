var tabla;
var editar;

/* Mostrar Menu seleccionadp */

$('.contenedor-menu .menu a').removeAttr('style');
$('#linkFormulas').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir1').show();

/* Cargue select referencias */

//function cargarSelectorModulo() {

$.ajax({
    method: 'POST',
    url: 'php/c_formulas.php',
    data: { operacion: "1" },

    success: function (response) {
        debugger;
        var info = JSON.parse(response);

        let $selectProductos = $('#cmbReferenciaProductos');

        $selectProductos.empty();
        $selectProductos.append('<option disabled selected>' + "Seleccionar" + '</option>');

        $.each(info.data, function (i, value) {
            $selectProductos.append('<option value ="' + value.referencia + '">' + value.referencia + '</option>');
        });
    },
    error: function (response) {
        console.log(response);
    }
});
//}


/* Cargar nombre de producto de acuerdo con Seleccion Referencia */

$('#cmbReferenciaProductos').change(function (e) {
    e.preventDefault();
    let seleccion = $("select option:selected").val();

    $.ajax({
        type: "POST",
        url: "php/c_formulas.php",
        data: { operacion: "2", referencia: seleccion },

        success: function (response) {
            var info = JSON.parse(response);
            $('#txtnombreProducto').val('');
            $('#txtnombreProducto').val(info.data[0].nombre_referencia);
        }
    });

    cargarTablaFormulas(seleccion);
});


/* Cargue de Parametros de Control en DataTable */

function cargarTablaFormulas(referencia) {
    tabla = $("#tblFormulas").DataTable({

        destroy: true,
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false,
        language: { url: 'admin_componentes/es-ar.json' },

        "ajax": {
            method: "POST",
            url: "php/c_formulas.php",
            data: { operacion: "3", referencia: referencia },
        },

        "columns": [
            { "data": "referencia" },
            { "data": "nombre" },
            { "data": "alias" },
            { "data": "porcentaje", className: "centrado" , render: $.fn.dataTable.render.number(',', '.', 1, '', '%') },
            { "defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Actualizar' style='color:rgb(255, 165, 0)'>edit</i></a>" },
            { "defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>" }
        ],
        columnDefs: [
            { width: "10%", "targets": 0 },
        ]
    });
}

/* Ocultar */

$('#adicionarFormula').click(function (e) {
    e.preventDefault();
    editar = 0;

    $("#frmadFormulas").slideToggle();
    $('#textReferencia').hide();
    $('#cmbreferencia').show();

    $('#txtMateria-Prima').attr('disabled', true);
    $('#alias').attr('disabled', true);

    /* Cargar datos para Adicionar Materia Prima */

    $.ajax({
        method: 'POST',
        url: 'php/c_formulas.php',
        data: { operacion: "4" },

        success: function (response) {
            var info = JSON.parse(response);
            let $selectReferencia = $('#cmbreferencia');

            $selectReferencia.empty();
            $selectReferencia.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $selectReferencia.append('<option value ="' + value.referencia + '">' + value.referencia + '</option>');
            });
        },
        error: function (response) {
            console.log(response);
        }
    })
});

/* Cargar Materia prima a guardar con la seleccion de la referencia */

$('#cmbreferencia').change(function (e) {
    e.preventDefault();
    let referencia = $("#cmbreferencia option:selected").text();

    $.ajax({
        type: "POST",
        url: "php/c_formulas.php",
        data: { operacion: "5", referencia: referencia },

        success: function (response) {
            var info = JSON.parse(response);
            $('#txtMateria-Prima').val(info.data[0].nombre);
            $('#alias').val(info.data[0].alias);
        }
    });
});

/* Almacenar Registros */

function guardarFormulaMateriaPrima() {
    let ref_producto = $('#cmbReferenciaProductos').val();
    let ref_materiaprima = $('#cmbreferencia').val();
    let porcentaje = $('#porcentaje').val();

    if (ref_materiaprima === null) {
        ref_materiaprima = $('#textReferencia').val();
    }

    $.ajax({
        type: "POST",
        url: "php/c_formulas.php",
        data: { operacion: "6", ref_producto: ref_producto, ref_materiaprima: ref_materiaprima, porcentaje: porcentaje, editar: editar },

        success: function (r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Almacenada con éxito.");
                refreshTable();
            } else if (r == 2) {
                alertify.set("notifier", "position", "top-right"); alertify.error("Código ya existe.");
            } else if (r == 3) {
                alertify.set("notifier", "position", "top-right"); alertify.success("Registro actualizado.");
                refreshTable();
            } else {
                alertify.set("notifier", "position", "top-right"); alertify.error("Error.");
            }
        }
    });
}

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function (e) {
    e.preventDefault();
    
    editar = 1;
    let id = $(this).parent().parent().children().first().text();
    let mp = $(this).parent().parent().children().eq(1).text();
    let alias = $(this).parent().parent().children().eq(2).text();
    let porcentaje = $(this).parent().parent().children().eq(3).text();

    $('#cmbreferencia').val('');
    $("#frmadFormulas").slideDown();
    $('#textReferencia').show();
    $('#cmbreferencia').hide();

    $('#textReferencia').val(id).prop('disabled', true);
    $('#txtMateria-Prima').val(mp).prop('disabled', true);
    $('#alias').val(alias).prop('disabled', true);
    $('#porcentaje').val(porcentaje);
});

/* Borrar registros */

$(document).on('click', '.link-borrar', function (e) {
    e.preventDefault();

    let ref_materiaprima = $(this).parent().parent().children().first().text();
    let ref_producto = $('#cmbReferenciaProductos').val();

    var confirm = alertify.confirm('Samara Cosmetics', '¿Está seguro de eliminar este registro?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function (r) {
        if (r) {
            $.ajax({
                'method': 'POST',
                'url': 'php/c_formulas.php',
                'data': { operacion: "7", ref_producto: ref_producto, ref_materiaprima: ref_materiaprima }
            });
            refreshTable();
            alertify.set("notifier", "position", "top-right"); alertify.success("Eliminado");
        }
    });
});

/* Actualizar tabla */

function refreshTable(tabla) {
    $('#tblFormulas').DataTable().clear();
    $('#tblFormulas').DataTable().ajax.reload();
}