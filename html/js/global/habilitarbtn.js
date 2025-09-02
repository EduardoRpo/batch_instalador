/* Habilitar Botones */

habilitarbotones = () => {
    for (let index = 1; index < 5; index++) {
        $(`.controlpeso_realizado${index}`).prop("disabled", false);
    }
}

habilitarbtn = (btn) => {
    if (btn == "firma1") {
        $(`.microbiologia_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.microbiologia_verificado`).prop("disabled", false);
    }

    if (btn == "firma3") {
        $(`.controlpeso_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.controlpeso_verificado${id_multi}`).prop("disabled", false);
        $(`.btnEntregasParciales${id_multi}`).prop("disabled", false);
        if (modulo == 6)
            $(`.devolucion_realizado${id_multi}`).prop("disabled", false);
    }

    if (btn === "firma5") {
        $(`.devolucion_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.devolucion_verificado${id_multi}`).prop("disabled", false);
        if (modulo === 6)
            $(`.conciliacion_realizado${id_multi}`).prop("disabled", false);
    }
};

function deshabilitarbtn() {
    btn = sessionStorage.getItem("btn");

    if (btn == "despeje_realizado")
        for (let i = 1; i < 5; i++)
            $(`.controlpeso_realizado${i}`).prop("disabled", false);

    if (btn == `controlpeso_realizado${id_multi}`) {
        $(`.controlpeso_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.controlpeso_verificado${id_multi}`).prop("disabled", false);
    }

    if (btn == `devolucion_realizado${id_multi}`) {
        $(`.devolucion_realizado${id_multi}`).css({ background: "lightgray", border: "gray" }).prop("disabled", true);
        $(`.devolucion_realizado${id_multi}`).prop("disabled", false);
    }
}