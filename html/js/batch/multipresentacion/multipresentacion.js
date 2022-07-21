var multi;
let objetos;
editar = false;
let ajuste = 0;
let index = 0;
let result

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

validarMulti = (ref) => {
    if (!ref) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Seleccione la referencia Granel");
        return false;
    }

    cargarMulti(ref);
}


busquedaMulti = async(ref) => {
    //let result
    try {
        result = await $.ajax({ url: `/api/multiref/${ref}` })
        return result
    } catch (error) {
        console.error(error)
    }
}

cargarMulti = async(ref) => {
    resp = await busquedaMulti(ref)
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
};


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