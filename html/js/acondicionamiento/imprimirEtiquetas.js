$(document).ready(function() {
    $(".sel_equipos").change(function(e) {
        e.preventDefault();
        if (flag == 0) {
            imprimirEtiquetasFull();
            flag = flag + 1;
        }
    });
});

/* Reimprimir Etiquetas */

reimprimirEtiquetas = () => {
    imprimirEtiquetasFull();
    alertify.set("notifier", "position", "top-right");
    alertify.success("Reimpresion de etiquetas correctamente");
}