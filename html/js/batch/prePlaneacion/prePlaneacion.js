$(document).ready(function() {
    $('.cardUpdatePrePlaneado').hide();
    let dataPrePlaneacion = [];
    sessionStorage.removeItem('id');

    /* Capturar Datos */
    $(document).on('click', '.link-select', function(e) {
        id = this.id;

        if (e.currentTarget.checked) {
            dataPrePlaneacion.push({ id: id });
        } else {
            for (i = 0; i < dataPrePlaneacion.length; i++) {
                if (dataPrePlaneacion[i].id == id) {
                    dataPrePlaneacion.splice(i, 1);
                }
            }
        }
    });

    // Limpiar información
    $('#btnLimpiar').click(function(e) {
        e.preventDefault();

        alertify
            .confirm(
                'Samara Cosmetics',
                `<p>Eliminar simulación</p><p><br></p>
                    <select id="simulacion" class="form-control">
                      <option selected disabled>Seleccionar</option>
                      <option value="1">Simulación 1</option>
                      <option value="2">Simulación 2</option>
                    </select>`,
                function() {
                    val = $('#simulacion').val();
                    if (!val || val == '') {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Seleccione la simulación');
                        return false;
                    }

                    clearData(val);
                },
                function() {
                    alertify.error('Cancel');
                }
            )
            .set('labels', { ok: 'Guardar', cancel: 'Cancelar' })
            .set({ closableByDimmer: false })
            .set('resizable', true);
    });

    clearData = (simulacion) => {
        $.get(
            `/api/clearPrePlaneados/${simulacion}`,
            function(data, textStatus, jqXHR) {
                message(data);
            }
        );
    };

    /* Planear pedido */
    $('#btnPlanear').click(function(e) {
        e.preventDefault();
        if (dataPrePlaneacion.length == 0) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Seleccione un pedido a planear');
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: '/api/updatePlaneados',
                data: { data: dataPrePlaneacion },
                success: function(resp) {
                    dataPrePlaneacion = [];
                    message(resp);
                },
            });
        }
    });

    /* Modificar pedido */
    $(document).on('click', '.link-editar-pre', function() {
        id = this.id;
        sessionStorage.setItem('id', id);
        $('.cardPlanning').hide(800);

        pedido = $(this).parent().parent().children().eq(2).text();
        granel = $(this).parent().parent().children().eq(3).text();
        referencia = $(this).parent().parent().children().eq(4).text();
        unidad = $(this).parent().parent().children().eq(6).text();

        $('#num_pedido').val(pedido);
        $('#name_granel').val(granel);
        $('#ref_product').val(referencia);
        $('#unity').val(unidad);

        $('.cardUpdatePrePlaneado').show(800);
        $('html, body').animate({
                scrollTop: 0,
            },
            1000
        );
    });

    $('#savePrePlaneado').click(function(e) {
        e.preventDefault();

        unidad = $('#unity').val();

        if (!unidad || unidad <= 0) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese unidad de lote valida');
            return false;
        }

        id = sessionStorage.getItem('id');

        prePlaneacion = { id: id, unidad: unidad };

        $.post(
            '/api/updateUnidadLote',
            prePlaneacion,
            function(data, textStatus, jqXHR) {
                $('.cardUpdatePrePlaneado').hide(800);
                $('.cardPlanning').show(800);
                $('#formUpdatePrePlaneado').trigger('reset');
                message(data);
            }
        );
    });

    /* Eliminar pedido */
    $(document).on('click', '.link-borrar-pre', function() {
        id = this.id;

        alertify
            .confirm(
                'Samara Cosmetic',
                '<p>¿ Estas seguro de eliminar este pedido ?</p><br>',
                function() {
                    $.get(
                        `/api/deletePrePlaneacion/${id}`,
                        function(data, textStatus, jqXHR) {
                            message(data);
                        }
                    );
                },
                function() {
                    alertify.error('Cancel');
                }
            )
            .set('labels', { ok: 'Eliminar', cancel: 'Cancelar' })
            .set({ closableByDimmer: false });
    });
});