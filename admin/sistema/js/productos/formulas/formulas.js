let tabla;
let editar;
let tbl;
let ref;

$(document).ready(function () {
  /* Mostrar Menu seleccionado */

  $('.contenedor-menu .menu a').removeAttr('style');
  $('#link_formulas').css('background', 'coral');
  $('.contenedor-menu .menu ul.menu_productos').show();

  $('.contenedor-menu .menu ul.menu_formulas').show();

  $('.alertFormula').hide();

  $('#instructivos').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_instructivos').toogle();
  });

  /* Cargue select referencias */

  /* $.ajax({
        url: '/api/granel',
        success: function(info) {
            let $selectProductos = $('#cmbReferenciaProductos')
            cargarSelect(info, $selectProductos)
        },
        error: function(response) {
            console.log(response)
        },
    }) */

  /* Crear Formulas */

  $('#adicionarFormula').click(function (e) {
    e.preventDefault();
    editar = 0;

    $('#frmadFormulas').slideToggle();
    $('#textReferencia').hide();
    $('#cmbreferencia').show();

    $('#txtMateria-Prima').attr('disabled', true);
    $('#alias').attr('disabled', true);
    $('.radioFormula').prop('disabled', false);
    $('.radioFormula').prop('checked', false);
  });

  $('#formula_r').change(function (e) {
    e.preventDefault();
    $('#cardformula_f').hide();
    $('#cardformula_r').show();
    tbl = 'r';
    materiaPrima('r');
  });

  $('#formula_f').change(function (e) {
    e.preventDefault();
    $('#cardformula_r').hide();
    $('#cardformula_f').show();
    tbl = 'f';
    materiaPrima('f');
  });

  referenciasGranel();

  /* cargar Selects */

  /* const cargarSelect = (data, select) => {
        ref = data
        select.empty()
        select.append(`<option disabled selected>Seleccione</option>`)
        select.append(`<option value='1'>Todos</option>`)
        $.each(data, function(i, value) {
            select.append(
                `<option value ="${value.referencia}">${value.referencia}</option>`,
                )
            })
        } */

  /* Cargar nombre de producto de acuerdo con Seleccion Referencia */

  $('#cmbReferenciaProductos').change(function (e) {
    e.preventDefault();
    let seleccion = $('select option:selected').val();

    if (seleccion == 1) {
      $('#formulas').hide();
      $('#formghost').hide();
      $('#allformulas').show();
      cargarTablaTodasFormulas();
    } else {
      $('#formulas').show();
      $('#formghost').show();
      $('#allformulas').hide();
      cargarTablaFormulas(seleccion);
    }
    if (seleccion != 1) cargar_formulas_f(seleccion);

    //const resultado = ref.find(refer => refer.referencia === seleccion);

    // $("#txtnombreProducto").val("");

    // if (seleccion != 1)
    //     $("#txtnombreProducto").val(resultado.nombre_referencia);

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

    // if (seleccion == 1) {
    //     $('#formulas').hide()
    //     $('#formghost').hide()
    //     $('#allformulas').show()
    //     cargarTablaTodasFormulas(seleccion)
    // } else {
    //     $('#formulas').show()
    //     $('#formghost').show()
    //     $('#allformulas').hide()
    //     cargarTablaFormulas(seleccion)
    // }
    // if (seleccion != 1) cargar_formulas_f(seleccion)
  });

  /* Cargar Materia prima a guardar con la seleccion de la referencia */

  $('#cmbreferencia').change(function (e) {
    e.preventDefault();
    let referencia = $('#cmbreferencia option:selected').text();
    $.ajax({
      type: 'POST',
      url: '/api/SearchRawMaterial',
      data: { referencia: referencia, tabla: tbl },

      success: function (info) {
        $('#txtMateria-Prima').val(info['nombre']);
        $('#alias').val(info['alias']);
      },
    });
  });

  /* Almacenar Registros */

  guardarFormulaMateriaPrima = () => {
    //let operacion = $("input:radio[name=formula]:checked").val();
    let ref_producto = $('#cmbReferenciaProductos').val();
    let ref_materiaprima = $('#cmbreferencia').val();
    let porcentaje = parseFloat($('#porcentaje').val());

    ref_materiaprima === null
      ? (ref_materiaprima = $('#textReferencia').val())
      : ref_materiaprima;

    if (ref_producto === null) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione la referencia');
      return false;
    }

    if (ref_materiaprima === null) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione la referencia de la materia prima');
      ref_materiaprima = $('#textReferencia').val();
      return false;
    }

    if (
      porcentaje === undefined ||
      porcentaje === null ||
      porcentaje === '' ||
      isNaN(porcentaje)
    ) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese todos los campos');
      return false;
    }

    if (porcentaje <= 0) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('El valor de porcentaje no es un número valido');
      return false;
    }
    $.ajax({
      type: 'POST',
      url: '/api/SaveFormula',
      data: {
        ref_producto,
        ref_materiaprima,
        porcentaje,
        tbl,
      },
      success: function (data) {
        notificaciones(data);

        $('#cmbreferencia').val('');
        $('#txtMateria-Prima').val('');
        $('#alias').val('');
        $('#porcentaje').val('');
        refreshTable();
      },
    });
  };

  /* Cargar datos para Actualizar registros */

  $(document).on('click', '.link-editar', function (e) {
    e.preventDefault();

    let id = $(this).parent().parent().children().first().text();
    let mp = $(this).parent().parent().children().eq(1).text();
    let alias = $(this).parent().parent().children().eq(2).text();
    let porcentaje = $(this).parent().parent().children().eq(3).text();
    porcentaje = parseFloat(porcentaje);

    $('.radioFormula').prop('disabled', true);

    if ($(this).hasClass('tr')) {
      tbl = 'r';
      $('#formula_r').prop('checked', true);
      $('#formula_f').prop('checked', false);
      $('#formula_f').prop('checked', false);
    } else {
      tbl = 'f';
      $('#formula_f').prop('checked', true);
      $('#formula_r').prop('checked', false);
    }

    $('#cmbreferencia').val('');
    $('#frmadFormulas').slideDown();
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

    if ($(this).hasClass('tr')) tbl = 'r';
    else tbl = 'f';

    var confirm = alertify
      .confirm(
        'Samara Cosmetics',
        '¿Está seguro de eliminar este registro?',
        null,
        null
      )
      .set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function (r) {
      if (r) {
        $.ajax({
          type: 'POST',
          url: '/api/deleteformulas',
          data: {
            ref_materiaprima: ref_materiaprima,
            ref_producto: ref_producto,
            tbl: tbl,
          },
          success: function (data) {
            notificaciones(data);
          },
        });
      }
    });
  });

  /* Actualizar tabla */

  refreshTable = () => {
    $('#tblFormulas').DataTable().clear();
    $('#tblFormulas').DataTable().ajax.reload();
    $('#tbl_formulas_f').DataTable().clear();
    $('#tbl_formulas_f').DataTable().ajax.reload();
  };
});
