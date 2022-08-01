/* Inicializar tabla Batch  */

var editar;
var datos;
var tabla;
var data;
var cont = 0;
var tanques;

$(document).ready(function() {
    $('#cardBatchCerrados').hide();
});

// Calcular numero de semana

$('#batch-list a').on('click', function(e) {
    e.preventDefault();
    let c = $(this).text();
    if (c == 'Cerrados') $('#cardBatchCerrados').show();
    else $('#cardBatchCerrados').hide();
    $(this).tab('show');
});

/* Cambiar puntero del mouse al tocar los botones de actualizar y eliminar */

$('.link-editar').css('cursor', 'pointer');
$('.link-editarMulti').css('cursor', 'pointer');

/* Cargar la data de la fila de acuerdo con la datatable */

$(document).on('click', '#tablaBatch tbody tr', function() {
    data = tablaBatch.row(this).data();
});

$(document).on('click', '#tablaPreBatch tbody tr', function() {
    fila = tablaPreBatch.row(this).data();
});

$(document).on('click', '#tablaBatchInactivos tbody tr', function() {
    data = tablaBatchInactivos.row(this).data();
});

$(document).ready(function() {

    /* Borrar registro */

    $(document).on('click', '.link-borrar', function(e) {
        e.preventDefault();
        e.stopPropagation();
        id_batch = this.id;
        const texto = $(this).parent().parent().children()[1];
        const id = $(texto).text();

        const confirm = alertify
            .confirm(
                `¿Está seguro de eliminar el Batch ${id}?`,
                `<label>Motivo de Eliminación: </label>
            <select style='width: 100%' class="form-control" id="motivoEliminacion">
            <option value='' disabled selected>Seleccione</option>
                    <option value='1'>Cancelado por el usuario</option>
                    <option value='2'>Falta de Materia Prima o Insumos</option>
                    <option value='3'>Producto descontinuado</option>
                    <option value='4'>Otros</option>
                    <option value='5'>Por prueba preinicio</option>
                    </select>`,
                null,
                null
            ).set('labels', { ok: 'Si', cancel: 'No' });

        confirm.set('onok', function(r) {
            let value = $('#motivoEliminacion').val();

            if (value == null) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(`Seleccione el motivo de <b>Eliminación</b>`);
                return false;
            }
            if (r) {
                $.ajax({
                    url: `/api/deleteBatch/${id_batch}/${value}`,
                    success: function(r) {
                        message(r);
                    },
                });
            }
        });
    });

    /* Cargar datos para Actualizar registros */

    $(document).on('click', '.link-editar', function(e) {
        e.preventDefault();
        editar = true;
        let id_batch = this.id;

        //limpiarTanques();
        $('#inpNombreReferencia').show();
        $('#nombrereferencia').hide();
        $('#calcTamanioLote').hide();
        $('#pedido').prop('disabled', true);

        cargarTanques();

        if (data.estado > 2) {
            f1 = new Date();
            f2 = new Date(data.fecha_programacion);
            f1.setHours(0, 0, 0, 0);
            f2.setHours(0, 0, 0, 0);
            if (f1.getTime() == f2.getTime()) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('Batch Record en proceso. No es posible actualizarlo.');
                return false;
            }
        }

        $.ajax({
            url: `/api/batch/${id_batch}`,
            success: function(data) {
                if (data.pedido) $('#pedido').val(data.pedido);
                else $('#pedido').val('');

                $('#idbatch').val(data.id_batch);
                $('#referencia').val(data.referencia);
                $('#inpNombreReferencia').val(data.nombre_referencia);
                $('#marca').val(data.marca);
                $('#propietario').val(data.propietario);
                $('#producto').val(data.nombre_referencia);
                $('#presentacioncomercial').val(data.presentacion);
                $('#linea').val(data.linea);
                $('#notificacionSanitaria').val(data.notificacion_sanitaria);
                $('#densidad_producto').val(data.densidad_producto);
                $('#ajuste').val(data.ajuste);

                $('#unidadesxlote').val(data.unidad_lote);
                $('#tamanototallote').val(data.tamano_lote);
                $('#fechaprogramacion').val(data.fecha_programacion);
                $('#fechaProgramacionSugerida').val(data.fecha_insumo);

                $('#cmbNoReferencia').css('display', 'none');
                $('#nombrereferencia').css('display', 'none');

                $('#referencia').css('display', 'block');
                $('#guardarBatch').html('Actualizar');
                $('.tcrearBatch').html('Actualizar Batch Record');

                $('#cmbTanque1').val(data.tanque);
                $('#txtCantidad1').val(data.cantidad);

                $('#txtCantidad1').click();
                $('#modalCrearBatch').modal('show');
            },
            error: function(response) {
                console.log(response);
            },
        });
    });

    /* Guardar datos de Crear y Actualizar batch*/

    guardarDatos = () => {
        if (data !== undefined) {
            if (data.estado > 2) {
                f1 = new Date();
                f2 = new Date(data.fecha_programacion);
                f1.setHours(0, 0, 0, 0);
                f2.setHours(0, 0, 0, 0);
                if (f1.getTime() == f2.getTime()) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Batch Record en proceso. No es posible actualizarlo.');
                    return false;
                }
            }
        }

        let ref = $('#cmbNoReferencia').val();

        if (ref == null) ref = $('#referencia').val();

        const id_batch = $('#idbatch').val();
        //const unidades = $("#unidadesxlote").val();
        const lote = $('#tamanototallote').val();

        if (total > 2500) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('El lote debe ser máximo de 2.500 kg');
            return false;
        }

        const pedido = $('#pedido').val();
        const presentacion = $('#presentacioncomercial').val();
        const presentacion_comercial = formatoGeneral(presentacion);
        const programacion = $('#fechaprogramacion').val();
        const tanque = $('#cmbTanque1').val();
        const cantidades = $('#txtCantidad1').val();
        const unidades = $('#unidadesxlote').val();
        let sumaTanques = $('.sumaTanques').val();

        if (!pedido) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese el Pedido para crear el Batch.');
            return false;
        }

        if (programacion) {
            if (!tanque) {
                $('#cmbTanque1').css('border-color', 'red');
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('Configure la cantidad de Tanques para el Batch.');
                return false;
            }
        }

        if (sumaTanques == '' || sumaTanques == 0) {
            $('#sumaTanques').css('border-color', 'red');
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Configure la cantidad de Tanques para el Batch.');
            return false;
        }

        if ((cont !== 0 && sumaTanques == '') || lote == '') {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese todos los datos.');
            return false;
        }

        multi = sessionStorage.getItem('multi');

        if (!editar) {
            datos = {
                ref,
                id_batch,
                pedido,
                unidades,
                lote: lote,
                presentacion: presentacion_comercial,
                programacion,
                tanque,
                cantidades,
                multi,
            };

            $.ajax({
                type: 'POST',
                url: '/api/saveBatch',
                data: { 0: datos },

                success: function(data) {
                    message(data);
                },
            });
        } else {
            datos = {
                ref,
                id_batch,
                unidades,
                lote: lote,
                programacion,
                tanque,
                cantidades,
                multi,
            };
            $.ajax({
                type: 'POST',
                url: '/api/updateBatch',
                data: datos,
                success: function(data) {
                    message(data);
                },
            });
        }
    }

    /* Mensaje de exito */

    message = (data) => {
        alertify.set('notifier', 'position', 'top-right');

        if (data.success == true) {
            actualizarTabla();
            cerrarModal();
            alertify.success(data.message);
        } else if (data.error == true) alertify.error(data.message);
        else if (data.info == true) alertify.info(data.message);
    };

    /* Actualizar tabla */

    actualizarTabla = () => {
        $('#tablaBatch').DataTable().clear();
        $('#tablaBatch').DataTable().ajax.reload();

        $('#tablaBatchInactivos').DataTable().clear();
        $('#tablaBatchInactivos').DataTable().ajax.reload();

        $('#tablaPreBatch').DataTable().clear();
        $('#tablaPreBatch').DataTable().ajax.reload();
    }
});