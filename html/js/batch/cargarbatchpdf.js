/* Mostrar Batch para Impresion */

$(".pdf").click(function(e) {
    e.preventDefault();
    $("#m_batch_pdf").modal();
    /* $("#tabla_batch_pdf").dataTable().fnDestroy();
    cargartablabatch_pdf(); */
});

$('#titleBatchEliminado').hide();


$("#buscar_batch").click(function(e) {
    e.preventDefault();
    v = $("#search").val();
    $.get(
        "../../../admin/sistema/php/certificado.php", { data: v },
        function(data, textStatus, jqXHR) {
            if ((textStatus = "success")) {
                data = JSON.parse(data);
                if (data) {
                    $("#search").val("");
                    $("#batchpdf").html(`Batch: ${data[0].id_batch}`);
                    $("#ref").html(data[0].referencia);
                    $("#prod").html(data[0].nombre_referencia);
                    $("#lote").html(data[0].numero_lote);
                    $("#accions").empty();
                    $("#accions").append(
                        `<a href="/pdf/${data[0].id_batch}/${data[0].referencia}" target="_blank"><i class="fas fa-external-link-alt"></i></a>`
                    );
                    if (data[0].estado == 0)
                        $('#titleBatchEliminado').show();
                    else
                        $('#titleBatchEliminado').hide();

                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Valor buscado no existe.");
                    $("#search").val("");
                    $("#batchpdf").html("");
                    $("#ref").html("");
                    $("#prod").html("");
                    $("#lote").html("");
                    $("#accions").empty();
                    $("#accions").append("");
                }
            }
        }
    );
});

$('[data-toggle="popover"]').popover();