/* Cargar imagenes */

$(document).ready(function() {

    $(".imgImportar").hide();

    $("#btnCargarImagenes").click(function(e) {
        e.preventDefault();
        $(".imgImportar").toggle(600);
    });

    $("#uploadForm").on("submit", function(e) {
        e.preventDefault();
        datos = new FormData(this);
        datos.append("operacion", "6");
        $.ajax({
            type: "POST",
            url: "../sistema/php/c_productos.php",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#uploadStatus").html(
                    '<img src="images/uploading.gif" style="height:100px"/>'
                );
            },
            error: function() {
                $("#uploadStatus").html(
                    '<span style="color:#EA4335;">No se cargaron las Imagenes correctamente, trate nuevamente.<span>'
                );
            },
            success: function(data) {
                if (data === "false") {
                    $("#uploadStatus").html(
                        '<span style="color:#EA4335;">No existe la referencia asociada a la imagen.<span>'
                    );
                    return false;
                }
                $("#uploadForm")[0].reset();
                $("#uploadStatus").html(
                    '<span style="color:#28A74B;">Imagenes cargadas correctamente.<span>'
                );
                /* $(".gallery").html(data); */
            },
        });
    });

    // File type validation
    $("#fileInput").change(function() {
        var fileLength = this.files.length;
        var match = ["image/jpeg"];
        var i;
        for (i = 0; i < fileLength; i++) {
            var file = this.files[i];
            var imagefile = file.type;
            if (!(
                    imagefile == match[0] ||
                    imagefile == match[1] ||
                    imagefile == match[2] ||
                    imagefile == match[3]
                )) {
                alert("Seleccione una imagen valida con formato (jpg).");
                $("#fileInput").val("");
                return false;
            }
        }
    });
});