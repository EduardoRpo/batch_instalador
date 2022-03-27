/* Mostrar Menu seleccionadp */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_menu_certificado").css("background", "coral");
$(".contenedor-menu .menu ul.menu_pdf").show();

$("#buscar_cert").click(function(e) {
    e.preventDefault();
    val = $("#search").val();
    $.get(`/api/getCert/${val}`, function(data, textStatus, jqXHR) {
            if ((textStatus = "success")) {

                info = JSON.stringify(data)
                localStorage.setItem('batchCert', info)
                if (data) {
                    $("#search").val("");
                    $("#id_batch").html(data[0].id_batch);
                    $("#referencia").html(data[0].referencia);
                    $("#producto").html(data[0].nombre_referencia);
                    $("#lote").html(data[0].numero_lote);
                    $("#acciones").empty();
                    $("#acciones").append(
                        `<a href="/certificado/${data[0].id_batch}/${data[0].referencia}" target="_blank"><i class="fas fa-sign-in-alt" style="font-size: x-large;"></i></a>`
                    );
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Valor buscado no existe.");
                    $("#search").val("");
                    $("#id_batch").html("");
                    $("#referencia").html("");
                    $("#producto").html("");
                    $("#lote").html("");
                    $("#acciones").empty();
                    $("#acciones").append("");
                }
            }

        },

    );

});

$('[data-toggle="popover"]').popover();