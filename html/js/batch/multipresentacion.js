let multi;
let objetos;
editar = false;
let ajuste = 0;
let index = 0;

/* Modificar estilo de cursor */
$(document).on("mouseenter", ".link-editarMulti", function(e) {
    $('.link-editarMulti').css("cursor", "pointer");
})

$(document).on("mouseleave", ".link-editarMulti", function(e) {
    $('.link-editarMulti').css("cursor", "auto")
})


/* Almacenar referencias para los procesos de clonado y multipresentacion */

$(document).on("click", ".link-select", function(e) {
    var referencia = $(this).parent().parent().children().eq(3).text();
    localStorage.setItem("referencia", referencia);
});

/* Validar si un producto puede tener multipresentacion */

function multipresentacion(ref) {
    if (!ref) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Seleccione la referencia Granel");
        return false;
    }
    /* if (data.multi > 0 && editar === false) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Esta referencia ya tiene Multipresentación. Ingrese por el icono de Multipresentación para actualizar");
        return false;
    } */
    busquedaMulti(ref);
}


function busquedaMulti(ref) {

    $.ajax({
        url: `/api/multiref/${ref}`,
        success: function(resp) {
            if (resp == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("No se encuentra la multipresentación.");
                return false;
            } else {
                multi = resp
                $("#adicionarMultipresentacion").trigger("click");
            }
            $(`#sumaMulti`).val("");
            $("#Modal_Multipresentacion").modal("show");
        },
    });
}

/* Adicionar referencia para crear multipresentacion en un batch*/
$("#adicionarMultipresentacion").on("click", function() {
    objetos = $(".multi").length;
    !objetos ? (index = 1) : index++;
    createMulti(index)
});

/* Crear objetos multi */
createMulti = (index) => {
    if (index < 6) {
        $(".insertarRefMulti").append(
            `<select class="form-control multi" name="MultiReferencia" id="MultiReferencia${index}" onchange="cargarReferenciaM(${index});"></select>
            <input type="text" class="form-control text-center" id="cantidadMulti${index}" name="cantidadMulti" onkeyup="CalculoloteMulti(${index});">
            <input type="text" class="form-control text-center" id="tamanioloteMulti${index}" name="tamanioloteMulti" readonly placeholder="Lote">
            <input type="text" class="form-control" id="densidadMulti${index}" name="densidadMulti" placeholder="Densidad" hidden>
            <input type="text" class="form-control" id="presentacionMulti${index}" name="presentacionMulti" placeholder="Presentación" hidden>
            <button class="btn btn-warning btneliminarMulti${index}" onclick="eliminarMulti(${index});" type="button">X</button>`
        );
        cargarMulti(multi);
    }
}

//Cargar Select Referencias con Multipresentacion

async function cargarMulti(multi) {
    let $select = $(`#MultiReferencia${index}`);

    $select.empty();
    $select.append(
        "<option disabled selected>" + "Multipresentación" + "</option>"
    );

    $.each(multi, function(i, value) {
        $select.append(
            `<option value="${value.referencia}">${value.referencia} - ${value.nombre}</option>`
        );
    });
}

//cargar datos de acuerdo con la seleccion de multipresentacion

function cargarReferenciaM(id) {
    const referencia = $(`#MultiReferencia${id}`).val();
    const resultado = multi.find((obj) => obj.referencia === referencia);

    $(`#presentacionMulti${id}`).val(resultado.presentacion);
    $(`#densidadMulti${id}`).val(resultado.densidad);
    CalculoloteMulti(id);
}

//calcular Tamaño del Lote

function CalculoloteMulti(id) {

    const referencia = $(`#MultiReferencia${id}`).val();
    const densidad = $(`#densidadMulti${id}`).val();
    const presentacion = $(`#presentacionMulti${id}`).val();
    //const lote = $("#loteTotal").val();
    cantidad = $(`#cantidadMulti${id}`).val();

    let totalKg = 0;

    if (referencia == undefined) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Seleccione la presentación.");
        return false;
    }

    if (cantidad == 0) {
        alertify.set("notifier", "position", "top-right");
        alertify.notify("Ingrese las unidades por presentación.");
        return false;
    }

    /* Calcula el lote de la presentacion de acuerdo con la seleccion */

    let lotePresentacion = parseInt((densidad * cantidad * presentacion) / 1000);
    $(`#tamanioloteMulti${id}`).val(lotePresentacion);

    /* Suma todos los lotes */

    for (let i = 1; i <= id; i++)
        totalKg = parseFloat(totalKg) + parseFloat($(`#tamanioloteMulti${i}`).val());

    $("#sumaMulti").val(totalKg);

    /* Valida que un lote no este por fuera del rango */

    if (totalKg > 2500) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El total en Kg supera el tamaño máximo por lote");
        $("#sumaMulti").val("");
        $(`#cantidadMulti${id}`).val("");
        $(`#tamanioloteMulti${id}`).val("");
        return false;
    }
}

//Actualizar Multipresentacion

$(document).on("click", ".link-editarMulti", function(e) {
    editar = true;
    id_batch = this.id

    $.ajax({
        url: `/api/multi/${id_batch}`,
        success: function(resp) {
            lote = 0
            for (let i = 0; i < resp.length; i++)
                multipresentacion(resp[i].referencia)

            setTimeout(function() {
                for (let i = 0; i < resp.length; i++) {
                    $(`#MultiReferencia${i + 1}`).val(resp[i].referencia);
                    $(`#cantidadMulti${i + 1}`).val(resp[i].cantidad);
                    $(`#tamanioloteMulti${i + 1}`).val(resp[i].total);
                    $(`#densidadMulti${i + 1}`).val(resp[i].densidad);
                    $(`#presentacionMulti${i + 1}`).val(resp[i].presentacion);
                    lote = lote + resp[i].total
                    $(`#sumaMulti`).val(lote);
                };
            }, 1000);

        },
    });

    //$("#Modal_Multipresentacion").modal("show");
});

//Eliminar Multipresentacion

function eliminarMulti(id) {
    var confirm = alertify
        .confirm(
            "Batch Record",
            `Está seguro de eliminar este registro. Está acción no podra reversarse`,
            null,
            null
        )
        .set("labels", { ok: "Si", cancel: "No" });

    confirm.set("onok", function() {
        let totalKg = 0;
        objetos = $(".multi").length;
        let ref = $(`#MultiReferencia${id}`).val();

        $(`#MultiReferencia${id}`).remove();
        $(`#cantidadMulti${id}`).remove();
        $(`#tamanioloteMulti${id}`).remove();
        $(`.btneliminarMulti${id}`).remove();
        $(`#densidadMulti${id}`).remove();
        $(`#presentacionMulti${id}`).remove();

        /* Suma todos los lotes */
        for (let i = 1; i <= objetos; i++) {
            tamaniolote = $(`#tamanioloteMulti${i}`).val();
            if (tamaniolote)
                totalKg =
                parseFloat(totalKg) + parseFloat($(`#tamanioloteMulti${i}`).val());
        }
        $("#sumaMulti").val(totalKg);
        data = { id: data.id_batch, ref, operacion: 5 };
        $.post("php/multi.php", data, function(data, textStatus, jqXHR) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Registro eliminado exitosamente");
        });
    });
}

//Guardar Multi

$('#btnCargarKg').click(function(e) {

    e.preventDefault();
    let totalCantidades = 0;
    const ref = [];
    let j = 1;

    //contar Multipresentacion
    objetos = $(".multi").length;
    totalKg = $('#sumaMulti').val();
    //obtener referencias

    for (i = 0; i < objetos; i++) {
        const multi = {};

        multi.referencia = $(`#MultiReferencia${j}`).val();
        multi.cantidadunidades = $(`#cantidadMulti${j}`).val();
        multi.tamaniopresentacion = $(`#tamanioloteMulti${j}`).val();

        totalCantidades = totalCantidades + parseInt($(`#cantidadMulti${j}`).val());

        if (multi.referencia || multi.cantidadunidades || multi.tamaniopresentacion)
            ref.push(multi);
        j++;
    }

    multi = JSON.stringify(ref)
    sessionStorage.setItem('multi', multi)
    $('#Modal_Multipresentacion').modal('hide');

    totalKg = $('#sumaMulti').val();
    totalTamaniolote = totalKg * (1 + ajuste)

    $('#tamanototallote').val(totalTamaniolote.toFixed(2));
    $('#unidadesxlote').val(totalCantidades);

});

function guardar_Multi(ref) {
    debugger
    $.ajax({
        type: "POST",
        url: "php/multi.php",
        data: { operacion: "4", ref, id: idBatch },

        success: function(r) {
            if (r == 1) {
                alertify.set("notifier", "position", "top-right");
                alertify.success("Multipresentación registrada con éxito.");
                cerrarModal();
                debugger
                const ajuste = $("#ajuste").val();
                $('#tamanototallote').val(totalKg * (1 + ajuste));
                //actualizarTabla();
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.error("No se registro la Multipresentacion. Valide nuevamente.");
            }
        },
        error: function(r) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Error al registrar la Multipresentación.");
        },
    });

}


//Recargar modal al cierre

$(".modal").on("hidden.bs.modal", function(e) {
    for (let i = 1; i < 6; i++) {
        $(`#MultiReferencia${i}`).remove();
        $(`#cantidadMulti${i}`).remove();
        $(`#tamanioloteMulti${i}`).remove();
        $(`.btneliminarMulti${i}`).remove();
        $(`#densidadMulti${i}`).remove();
        $(`#presentacionMulti${i}`).remove();
    }
    editar = false;
});