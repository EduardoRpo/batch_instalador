var array = [];

//recoge la informacion del formulario de control de proceso

guardarControlProcesoPreparacion = () => {

    $("#tblControlProcesoPreparacion tr").each(function() {
        let control = ($(this).find("td:eq(2) select option:selected").val());

        if (control == undefined) {
            let valor = $(this).find("td:eq(2) input").val();
            if (valor !== '')
                array.push(valor);
        } else {
            if (control !== '')
                array.push(control);
        }
        console.log(array);
    })

    /* Validar que toda la informacion esta completa */

    if (array.length < 10) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese todos los campos");
        return 0;
    } else
        return 1;

}