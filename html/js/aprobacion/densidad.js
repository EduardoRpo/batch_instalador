$(document).ready(function() {

    promedioDensidad = () => {
        $.ajax({
            type: "POST",
            url: "../../html/php/promedioDensidad.php",
            data: { batch: idBatch },
            success: function(response) {
                data = JSON.parse(response);
                $("#in_densidad").val(data[0].densidad.toFixed(2));
            },
        });
    };
    //promedioDensidad();
});