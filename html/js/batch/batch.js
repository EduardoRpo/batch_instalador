/* Inicializar tabla Batch  */

var editar;
var datos;
var tabla;
var data;
var cont = 0;
var tanques;

$(document).ready(function() {
    crearTablaBatch();
    tablaBatchCerrados();
    cargarTanques();
    $("#cardBatchCerrados").hide();
});

$("#batch-list a").on("click", function(e) {
    e.preventDefault();
    let c = $(this).text();
    if (c == "Cerrados") $("#cardBatchCerrados").show();
    else $("#cardBatchCerrados").hide();
    $(this).tab("show");
});

function crearTablaBatch(
    columna_busqueda = "",
    minDateFilter = "",
    maxDateFilter = ""
) {
    tabla = $("#tablaBatch").DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: "../../../admin/sistema/admin_componentes/es-ar.json" },
        oSearch: { bSmart: false },

        ajax: {
            method: "POST",
            url: "php/listarBatch.php",
            data: {
                operacion: "1",
                proceso: "1",
                busqueda: columna_busqueda,
                inicio: minDateFilter,
                final: maxDateFilter,
            },
        },

        columns: [{
                defaultContent: "<input type='radio' id='express' name='optradio' class='link-select'>",
            },
            { data: "id_batch" },
            { data: "numero_orden", className: "uniqueClassName" },
            { data: "referencia", className: "uniqueClassName" },
            { data: "nombre_referencia" },
            { data: "numero_lote" },
            {
                data: "tamano_lote",
                className: "uniqueClassName",
                render: $.fn.dataTable.render.number(".", ",", 0, ""),
            },
            { data: "nombre" },
            { data: "fecha_creacion", className: "uniqueClassName" },
            { data: "fecha_programacion", className: "uniqueClassName" },
            {
                data: "estado",
                className: "uniqueClassName",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ?
                        "Sin Formula y/o Instructivo" :
                        data == 2 ?
                        "Inactivo" :
                        data == 3 ?
                        "Pesaje" :
                        data == 3.5 ?
                        "Preparación" :
                        data == 4 ?
                        "Preparación" :
                        data == 4.5 ?
                        "Aprobación" :
                        data == 5 ?
                        "Aprobación" :
                        data == 5.5 ?
                        "Envasado/Acondicionamiento" :
                        data == 6 ?
                        "Envasado/Acondicionamiento" :
                        data == 6.5 ?
                        "Microbiologia/Fisicoquimico" :
                        data == 7 ?
                        "Microbiologia/Fisicoquimico" :
                        data == 7.5 ?
                        "Microbiologia/Fisicoquimico" :
                        data == 8 ?
                        "Microbiologia/Fisicoquimico" :
                        data == 8.5 ?
                        "Microbiologia/Fisicoquimico" :
                        data == 10 ?
                        "Liberacion Lote" :
                        "Multimodulo";
                },
            },
            {
                data: "multi",
                className: "uniqueClassName",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ?
                        '<i class="fa fa-superscript link-editarMulti" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>' :
                        "";
                },
            },
            {
                title: 'Acciones',
                data: 'id_batch',
                className: 'uniqueClassName',
                render: function(data) {
                    return `
                    <a href='#' <i class='fa fa-pencil-square-o fa-2x link-editar' id=${data} data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7);'></i></a>
                    <a href='#' <i class='fa fa-trash link-borrar fa-2x' id=${data} data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'></i></a>`;
                },
            },
        ],
    });
}

function tablaBatchCerrados() {
    $("#tablaBatchCerrados").DataTable({
        pageLength: 50,
        responsive: true,
        scrollCollapse: true,
        language: { url: "../../../admin/sistema/admin_componentes/es-ar.json" },
        oSearch: { bSmart: false },
        bAutoWidth: false,

        ajax: {
            url: "/api/batchcerrados",
            dataSrc: "",
        },

        columns: [
            { data: "id_batch", className: "uniqueClassName" },
            { data: "numero_orden", className: "uniqueClassName" },
            { data: "referencia", className: "uniqueClassName" },
            { data: "nombre_referencia" },
            { data: "numero_lote" },
            {
                data: "tamano_lote",
                className: "uniqueClassName",
                render: $.fn.dataTable.render.number(".", ",", 0, ""),
            },
            { data: "nombre" },
            { data: "fecha_creacion", className: "uniqueClassName" },
            { data: "fecha_programacion", className: "uniqueClassName" },

            {
                data: "multi",
                className: "uniqueClassName",
                render: (data, type, row) => {
                    "use strict";
                    return data == 1 ?
                        '<i class="fa fa-superscript link-editarMulti" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>' :
                        "";
                },
            },
        ],
    });
}

/* Cambiar puntero del mouse al tocar los botones de actualizar y eliminar */

$(".link-editar").css("cursor", "pointer");
$(".link-editarMulti").css("cursor", "pointer");

/* Borrar registro */

$(document).on("click", ".link-borrar", function(e) {
    e.preventDefault();

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
        )
        .set("labels", { ok: "Si", cancel: "No" });

    confirm.set("onok", function(r) {
        let value = $("#motivoEliminacion").val();
        if (value == null) {
            alertify.set("notifier", "position", "top-right");
            alertify.error(`Seleccione el motivo de <b>Eliminación</b>`);
            return false;
        }
        if (r) {
            $.ajax({
                method: "POST",
                url: "php/listarBatch.php",
                data: { operacion: "2", id: id, value },

                success: function(r) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Batch Record Eliminado.");
                    actualizarTabla();
                },
                error: function(r) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Error al Eliminar el Batch Record.");
                },
            });
        }
    });
});

/* Cargar datos para Actualizar registros */

$(document).on("click", ".link-editar", function(e) {
    e.preventDefault();
    editar = true;
    let idBatch = this.id

    limpiarTanques();
    $('#inpNombreReferencia').show();
    $('#nombrereferencia').hide();

    $('#calcTamanioLote').hide();

    if (data.estado > 2) {
        f1 = new Date();
        f2 = new Date(data.fecha_programacion);
        f1.setHours(0, 0, 0, 0);
        f2.setHours(0, 0, 0, 0);
        if (f1.getTime() == f2.getTime()) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Batch Record en proceso. No es posible actualizarlo.");
            return false;
        }
    }

    $.ajax({
        url: `/api/batch/${idBatch}`,
        success: function(data) {

            $("#idbatch").val(data.id_batch);
            $("#referencia").val(data.referencia);
            $("#inpNombreReferencia").val(data.nombre_referencia);
            $("#marca").val(data.marca);
            $("#propietario").val(data.propietario);
            $("#producto").val(data.nombre_referencia);
            $("#presentacioncomercial").val(data.presentacion);
            $("#linea").val(data.linea);
            $("#notificacionSanitaria").val(data.notificacion_sanitaria);
            $("#densidad_producto").val(data.densidad_producto);
            $("#ajuste").val(data.ajuste);

            $("#unidadesxlote").val(data.unidad_lote);
            $("#tamanototallote").val(data.tamano_lote);
            $("#fechaprogramacion").val(data.fecha_programacion);

            $("#cmbNoReferencia").css("display", "none");
            $("#nombrereferencia").css("display", "none");

            $("#referencia").css("display", "block");
            $("#guardarBatch").html("Actualizar");
            $(".tcrearBatch").html("Actualizar Batch Record");


            $("#cmbTanque1").val(data.tanque);
            $("#txtCantidad1").val(data.cantidad);
            CalcularTanque(1);

            $("#modalCrearBatch").modal("show");
        },
        error: function(response) {
            console.log(response);
        },
    });
});

/* Guardar datos de Crear y Actualizar batch*/

function guardarDatos() {
    if (data !== undefined) {
        if (data.estado > 2) {
            f1 = new Date();
            f2 = new Date(data.fecha_programacion);
            f1.setHours(0, 0, 0, 0);
            f2.setHours(0, 0, 0, 0);
            if (f1.getTime() == f2.getTime()) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Batch Record en proceso. No es posible actualizarlo.");
                return false;
            }
        }
    }

    let ref = $("#cmbNoReferencia").val();

    if (ref == null)
        ref = $("#referencia").val();

    const id_batch = $("#idbatch").val();
    //const unidades = $("#unidadesxlote").val();
    const lote = $("#tamanototallote").val();

    if (total > 2500) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El lote debe ser máximo de 2.500 kg");
        return false
    }

    const presentacion = $("#presentacioncomercial").val();
    const presentacion_comercial = formatoGeneral(presentacion);
    const programacion = $("#fechaprogramacion").val();
    const tanque = $("#cmbTanque1").val();
    const cantidades = $("#txtCantidad1").val();
    let sumaTanques = $(".sumaTanques").val();

    if (sumaTanques == "" || sumaTanques == 0) {
        $("#sumaTanques").css("border-color", "red");
        alertify.set("notifier", "position", "top-right");
        alertify.error("Configure la cantidad de Tanques para el Batch.");
        return false;
    }

    if ((cont !== 0 && sumaTanques == "") || lote == "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los datos.");
        return false;
    }

    multi = sessionStorage.getItem('multi')

    if (!editar) {
        datos = {
            ref,
            id_batch,
            /* unidades, */
            lote: lote,
            presentacion: presentacion_comercial,
            programacion,
            tanque,
            cantidades,
            multi
        };

        $.ajax({
            type: "POST",
            url: "/api/saveBatch",
            data: datos,

            success: function(data) {
                message(data)
            }
        })
    } else {
        datos = {
            ref,
            id_batch,
            unidades,
            lote: tamano_lote,
            programacion,
            tanque,
            cantidades,
            multi
        };
        $.ajax({
            type: "POST",
            url: "api/updateBatch",
            data: datos,
            success: function(data) {
                debugger
                message(data)
            }
        })
    }
}

/* Mensaje de exito */

message = (data) => {
    if (data.success == true) {
        cerrarModal();
        alertify.success(data.message);
        actualizarTabla();
        return false;
    } else if (data.error == true)
        alertify.error(data.message);
    else if (data.info == true)
        alertify.info(data.message);
};

/* Actualizar tabla */

function actualizarTabla() {
    $("#tablaBatch").DataTable().clear();
    $("#tablaBatch").DataTable().ajax.reload();
}