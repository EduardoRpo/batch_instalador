$(document).ready(function() {
    const pedidosProgramar = [];

    // Seleccionar checkbox
    $(document).on('blur', '.cantProgram', function(e) {
        e.preventDefault();
        id_input = this.id;
        id_checkbox = id_input.substr(5, 13);
        referencia = id_input.substr(-7, 7);
        cantidad = $(`#${id_input}`).val();
        numPedido = id_checkbox.slice(0, -8);

        if (cantidad == 0) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('La cantidad a programar no puede ser cero (0)');
            $(this).prop('checked', false);
            return false;
        }

        // Si ya existe una cantidad en esa fila remplazarla
        if (pedidosProgramar.length > 0) {
            // Eliminar objeto del array
            for (i = 0; i < pedidosProgramar.length; i++) {
                if (
                    referencia == pedidosProgramar[i].referencia &&
                    numPedido == pedidosProgramar[i].numPedido &&
                    cantidad != pedidosProgramar[i].cantidad
                ) {
                    deleteArray(numPedido);
                    arrayPreprogramados(referencia, cantidad, numPedido)
                }
            }
        }

        if ($(`#${id_checkbox}`).is(':checked')) {
            if (cantidad == '')
                $(`#${id_checkbox}`).prop('checked', false);
        } else
            $(`#${id_checkbox}`).prop('checked', true);

        arrayPreprogramados(referencia, cantidad, numPedido)
    });


    //Eliminar registros en el array

    $(document).on('change', '.checkboxPedidos', function(e) {
        e.preventDefault();
        id_input = this.id;
        id_checkbox = id_input.substr(5, 13);
        numPedido = id_checkbox.slice(0, -8);
        $(`#cant-${id_input}`).val('');
        deleteArray(numPedido);
    })


    arrayPreprogramados = (referencia, cantidad, numPedido) => {

        /* validar que el numero de pedido y referencia no esten en el array e insertar 
          de los contrario actualizar la cantidad */

        for (i = 0; i < pedidosProgramar.length; i++) {
            if (
                referencia == pedidosProgramar[i].referencia &&
                //cantidad == pedidosProgramar[i].cantidad &&
                numPedido == pedidosProgramar[i].numPedido
            )
                deleteArray(numPedido);
        }

        pedidos = {};
        granel = fila.granel;

        pedidos.referencia = referencia;
        pedidos.cantidad = cantidad;
        pedidos.granel = granel;
        pedidos.numPedido = numPedido;

        pedidosProgramar.push(pedidos);

    }



    $(document).on('click', '#calcLote', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/api/calcTamanioLote',
            data: { data: pedidosProgramar },
            success: function(resp) {
                // Ventana alert confirm
                alertConfirm(resp);
            },
        });
    });

    deleteArray = (numPedido) => {
        for (i = 0; i < pedidosProgramar.length; i++) {
            if (pedidosProgramar[i].numPedido == numPedido) {
                pedidosProgramar.splice(i, 1);
            }
        }
    };

    // Fecha inicio
    $(document).on('blur', '.dateInsumos', function(e) {
        e.preventDefault();
        id_date = this.id;
    });
});