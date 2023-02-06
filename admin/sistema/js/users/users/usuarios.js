$(document).ready(function () {
  let editar;
  let id = 0;

  $(document).ready(function () {
    //Crear usuarios
    $('#btnCrearUsuarios').click(function () {
      $('#ModalCrearUsuarios').modal('show');
      $('#btnguardarUsuarios').html('Crear');
      $('#nombres').val('');
      $('#apellidos').val('');
      $('#email').val('');
      $('#cargos option:contains(Seleccionar)').prop('selected', true);
      $('#usuarios_rols option:contains(Seleccionar)').prop('selected', true);
      $('#modulo').val('');
      $('#usuario').val('');
      $('#clave').val('');
    });

    $('#usuarios_rols').change(function (e) {
      e.preventDefault();
      let rol = $('#usuarios_rols').val();
      if (rol == 1 || rol == 2 || rol == 5)
        $('#firma_y_modulo').css('display', 'none');
      else $('#firma_y_modulo').css('display', 'flex');
    });

    $('#btnguardarUsuarios').click(function (e) {
      e.preventDefault();

      let nombres = $('#nombres').val();
      let apellidos = $('#apellidos').val();
      let email = $('#email').val();
      let cargos = $('#cargos').val();
      let modulo = $('#modulo').val();
      let user = $('#usuario').val();
      let clave = $('#clave').val();
      let rol = $('#usuarios_rols').val();

      if (rol == 1 || rol == 2 || rol == 5) {
        modulo = '1';
      }

      let datosIniciales =
        nombres.length *
        apellidos.length *
        cargos.length *
        modulo.length *
        user.length;

      if (editar == 1) {
        if (datosIniciales === 0) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error('Ingrese todos los datos.');
          return false;
        }
      } else {
        if (datosIniciales == 0 || clave === '' || rol === null) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error('Ingrese todos los datos.');
          return false;
        }
      }

      if (rol != 1 && rol != 2 && editar != 1 && rol != 5) {
        const archivo = $('#firma').val();
        let extensiones = archivo.substring(archivo.lastIndexOf('.'));

        if (
          extensiones != '.jpg' &&
          extensiones != '.png' &&
          extensiones != '.JPG' &&
          extensiones != '.PNG'
        ) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.error(`El archivo de tipo ${extensiones} no es válido`);
          $('#firma').val('');
          return false;
        }
      }

      //   const usuario = new FormData($('#frmagregarUsuarios')[0]);
      //   usuario.set('operacion', 3);
      //   usuario.set('editar', editar);
      //   usuario.set('id', id);

      //   if (rol == 1 || rol == 2 || rol == 5) usuario.set('modulo', '1');

      let usuario = $('#frmagregarUsuarios').serialize();
      usuario += `&operacion=3&editar=${editar}&id=${id}`;

      if (rol == 1 || rol == 2 || rol == 5) usuario += '&modulo=1';

      $.ajax({
        type: 'POST',
        url: '/api/saveUsers',
        data: usuario,
        // processData: false,
        // contentType: false,

        success: function (r) {
          alertify.set('notifier', 'position', 'top-right');

          if (r.success == true) {
            alertify.success(r.message);
            $('#ModalCrearUsuarios').modal('hide');
            refreshTable();
          } else if (r.error) alertify.error(r.message);
          else
            alertify.error(
              'Ocurrio un Error mientras guardaba. Intente nuevamente'
            );
        },
      });
    });

    /* evento click para actualizar registros */

    $(document).on('click', '.link-editar', function (e) {
      e.preventDefault();
      editar = 1;

      id = $(this).parent().parent().children().eq(1).text();
      let nombres = $(this).parent().parent().children().eq(2).text();
      let apellidos = $(this).parent().parent().children().eq(3).text();
      let email = $(this).parent().parent().children().eq(4).text();
      let cargo = $(this).parent().parent().children().eq(5).text();
      let modulo = $(this).parent().parent().children().eq(6).text();
      let usuario = $(this).parent().parent().children().eq(7).text();
      let rol = $(this).parent().parent().children().eq(8).text();

      $('#ModalCrearUsuarios').modal('show');
      $('#btnguardarUsuarios').html('Actualizar');
      $('#nombres').val(nombres);
      $('#apellidos').val(apellidos);
      $('#email').val(email);
      $('#cargos option:contains(' + cargo + ')').attr('selected', true);
      $('#modulo option:contains(' + modulo + ')').attr('selected', true);
      $('#usuarios_rols option:contains(' + rol + ')').attr('selected', true);
      $('#usuario').val(usuario);
      $(`#firma`).val('');

      rol == 'Superusuario'
        ? (id_rol = 1)
        : rol == 'Administrador'
        ? (id_rol = 2)
        : rol == 'Usuario'
        ? (id_rol = 3)
        : (id_rol = 4);

      $('#usuarios_rols').val(id_rol);
      $('#usuarios_rols').change();
    });

    /* evento click para borrar registros */

    $(document).on('click', '.link-borrar', function (e) {
      e.preventDefault();

      let id = $(this).parent().parent().children().eq(1).text();
      let confirm = alertify
        .confirm(
          'Samara Cosmetics',
          '¿Está seguro de eliminar este usuario?',
          null,
          null
        )
        .set('labels', { ok: 'Si', cancel: 'No' });

      confirm.set('onok', function (r) {
        if (r) {
          $.ajax({
            url: `/api/deleteUsers/${id}`,
          });
          refreshTable();
          alertify.success('Registro Eliminado');
        }
      });
    });

    /* Inactivar Usuarios */

    $(document).on('click', '.link-inactivar', function (e) {
      let idUser = $(this).parent().parent().children().eq(1).text();
      $.ajax({
        url: `/api/user/${idUser}`,
        type: 'GET',
      }).done((data, status, xhr) => {
        if (data) {
          alertify.set('notifier', 'position', 'top-right');
          alertify.success('Usuario Activado.');
        } else {
          alertify.set('notifier', 'position', 'top-right');
          alertify.success('Usuario Inactivado.');
        }
        refreshTable();
      });
    });

    /* Actualizar tabla */

    refreshTable = () => {
      $('#listaUsuarios').DataTable().clear();
      $('#listaUsuarios').DataTable().ajax.reload();
      $('#firma').val('');
    };

    /* Mostrar el nombre del archivo al seleccionarlo */

    $('.custom-file-input').on('change', function (event) {
      var inputFile = event.currentTarget;
      $(inputFile)
        .parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
    });

    $('.custom-file-label::after').val('Buscar');
  });
});
