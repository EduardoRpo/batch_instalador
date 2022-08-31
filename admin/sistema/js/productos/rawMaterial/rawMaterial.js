$(document).ready(function () {
  /* Mostrar Menu seleccionado */
  $('.contenedor-menu .menu a').removeAttr('style');
  $('#link_materia_prima').css('background', 'coral');
  $('.contenedor-menu .menu ul.menu_productos').show();

  /* Ocultar */

  /* Borrar registros */

  $(document).on('click', '.link-borrar-mp', function (e) {
    let id = this.id;
    let confirm = alertify
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
          url: `/api/deleteRawMaterial/${id}`,
          success: function (data) {
            notificaciones(data);
          },
        });
      }
    });
  });

  $(document).on('click', '.link-borrar-mpf', function (e) {
    let id = this.id;
    let confirm = alertify
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
          url: `/api/deleteRawMaterialF/${id}`,
          success: function (data) {
            notificaciones(data);
          },
        });
      }
    });
  });
  /*
    $(document).on("click", ".link-borrar-mp", function (e) {
        e.preventDefault();
        tbl = 1;
        let id = $(this).parent().parent().children().eq(2).text();
      eliminarRegistro(id, tbl);
    });
 
    $(document).on("click", ".link-borrar-mpf", function (e) {
      tbl = 0;
      let id = $(this).parent().parent().children().eq(2).text();
      eliminarRegistro(id, tbl);
    });
 
    const eliminarRegistro = (id, tbl) => {
      let confirm = alertify
        .confirm(
          "Samara Cosmetics",
          "¿Está seguro de eliminar este registro?",
          null,
          null
        )
        .set("labels", { ok: "Si", cancel: "No" });
 
        confirm.set("onok", function (r) {
            if (r) {
                $.ajax({
                    method: "POST",
                    url: "php/c_materiaprima.php",
                    data: { operacion: "2", id: id, tbmateriaPrima: tbl },
                });
                refreshTable();
                alertify.success("Registro Eliminado");
            }
        });
    };
    */
  /* boton Adicionar*/

  $('#btnadicionarMateriaPrima').click(function (e) {
    e.preventDefault();
    operacion = 1;
    $('#frmAdicionarMateriaPrima').slideToggle();
    $('#txtId').val('');
    $('#txtCodigo').val('');
    $('#txtMP').val('');
    $('#txtAlias').val('');
    $('#btnguardarMateriaPrima').html('Crear');
    $('#txtCodigo').prop('disabled', false);
  });

  /* Cargar datos para Actualizar registros */

  $(document).on('click', '.link-editar-mp', function (e) {
    e.preventDefault();
    rb = 1;
    operacion = 2;
    let referencia = $(this).parent().parent().children().eq(0).text();
    let materiaprima = $(this).parent().parent().children().eq(1).text();
    let alias = $(this).parent().parent().children().eq(2).text();
    editarmp(operacion, rb, referencia, materiaprima, alias);
  });

  $(document).on('click', '.link-editar-mpf', function (e) {
    e.preventDefault();
    rb = 0;
    operacion = 2;
    let referencia = $(this).parent().parent().children().eq(0).text();
    let materiaprima = $(this).parent().parent().children().eq(1).text();
    let alias = $(this).parent().parent().children().eq(2).text();

    editarmp(operacion, rb, referencia, materiaprima, alias);
  });

  const editarmp = (operacion, rb, referencia, materiaprima, alias) => {
    if (rb == 1) $('#mp').prop('checked', true);
    else $('#mpf').prop('checked', true);
    $('#txtCodigo').prop('disabled', true);
    $('#frmAdicionarMateriaPrima').slideDown();
    $('#txtId').val(operacion);
    $('#txtCodigo').val(referencia);
    $('#txtMP').val(materiaprima);
    $('#txtAlias').val(alias);
    $('#btnguardarMateriaPrima').html('Actualizar');
  };
  /* Almacenar Registros */

  $('#btnguardarMateriaPrima').click(function (e) {
    e.preventDefault();

    let ref = $('#txtCodigo').val();
    let materiaprima = $('#txtMP').val();
    let alias = $('#txtAlias').val();
    let operacion = $('#txtId').val();
    if ($('#mp').prop('checked')) rb = $('#mp').val();
    if ($('#mpf').prop('checked')) rb = $('#mpf').val();

    if (ref == '' || materiaprima == '' || alias == '' || rb == undefined) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese todos los datos.');
      return false;
    }

    $.ajax({
      type: 'POST',
      url: '/api/SaveRawMaterial',
      data: {
        id: operacion,
        referencia: ref,
        materiaprima: materiaprima,
        alias: alias,
        controller: rb,
      },

      success: function (data) {
        notificaciones(data);
      },
    });
  });

  /* Actualizar tabla */

  refreshTable = () => {
    $('#tblMateriaPrima').DataTable().clear();
    $('#tblMateriaPrima').DataTable().ajax.reload();
    $('#tblMateriaPrimaf').DataTable().clear();
    $('#tblMateriaPrimaf').DataTable().ajax.reload();
    $('#frmAdicionarMateriaPrima').trigger('reset');
    $('#frmAdicionarMateriaPrima').hide(800);
  };
});
