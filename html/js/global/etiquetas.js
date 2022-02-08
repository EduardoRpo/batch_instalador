let flagE = 0;

$(document).ready(function() {
    imprimirEtiquetas = (data) => {
        tablePesaje.on("click", "tbody tr", function(e) {
            e.preventDefault();
            $(this).toggleClass("tr_hover ");

            arrayData = [];
            JSONData = {};
            let codMateriaPrima = $(this).find("td:first").html();
            let peso = $(this).find("td:nth-child(4)").html();
            JSONData.orden = batch.numero_orden;
            JSONData.referencia = codMateriaPrima;
            JSONData.peso = peso;
            arrayData.push(JSONData);
            sessionStorage.setItem("batch", batch);
            $("#imprimirEtiquetas").modal("show");
        });
    };
});

$("#btnimprimirEtiquetas").click(function(e) {
    e.preventDefault();
    exportarEtiquetas();
    //imprimirEtiquetasVirtuales();
});

const imprimirEtiquetasFull = (marmita) => {
    const ref = batch.referencia;
    $.ajax({
        url: `../../api/materiasp/${ref}`,
        success: function(materiaPrima) {
            $.ajax({
                url: `../../api/user/${modulo}/${idBatch}`,
                success: function(usuario) {
                    modulo == 2 ?
                        imprimirEtiquetasPesaje(materiaPrima, usuario) :
                        modulo == 3 ?
                        imprimirEtiquetasPreparacion(marmita, usuario) :
                        modulo == 4 ?
                        imprimirEtiquetasAprobacion(usuario) :
                        imprimirEtiquetasAcondicionamiento(usuario);
                },
            });
        },
    });
};

const imprimirEtiquetasPesaje = (materiaPrima, usuario) => {
    operacion = 1;
    arrayData = [];
    for (let i = 0; i < materiaPrima.length; i++) {
        pesaje = {};
        pesaje.orden = batch.numero_orden;
        pesaje.referencia = materiaPrima[i].referencia;
        pesaje.peso =
            ((materiaPrima[i].porcentaje / 100) * batch.tamano_lote) /
            $("#Notanques").val();
        pesaje.producto = batch.nombre_referencia;
        pesaje.user = usuario.nombres;
        arrayData.push(pesaje);
    }
    exportarEtiquetas(operacion, arrayData);
};

const imprimirEtiquetasPreparacion = (marmita, usuario) => {
    operacion = 2;
    let preparacion = batch;
    preparacion.tanque = marmita;
    preparacion.usuario = usuario.nombres;
    exportarEtiquetas(operacion, preparacion);
};

const imprimirEtiquetasAprobacion = (usuario) => {
    operacion = 3;
    arrayData = [];
    numero_tanques = parseInt($("#cantidad1").html());

    for (let i = 1; i <= numero_tanques; i++) {
        aprobacion = {};
        aprobacion.orden = batch.numero_orden;
        aprobacion.referencia = batch.referencia;
        aprobacion.producto = batch.nombre_referencia;
        aprobacion.tamanio_lote = batch.tamano_lote
        aprobacion.numero_lote = $("#in_numero_lote").val();
        aprobacion.numero_tanques = numero_tanques;
        aprobacion.user = usuario.nombres;
        arrayData.push(aprobacion);
    }
    exportarEtiquetas(operacion, arrayData);
};


const imprimirEtiquetasAcondicionamiento = (usuario) => {
    operacion = 4;
    let batch = sessionStorage.batch
    batch = JSON.parse(batch)
    batch.usuario = usuario.nombres;
    exportarEtiquetas(operacion, batch);
};

const imprimirEtiquetasRetencion = () => {
    operacion = 5;
    const referencia = batch.referencia;
    $.ajax({
        type: "POST",
        url: "../../../html/php/etiquetas.php",
        data: { idBatch, referencia },
        success: function(response) {
            $muestras_retencion = JSON.parse(response);
            arrayData = [];
            for (let i = 0; i < $muestras_retencion.length + 1; i++) {
                retencion = {};
                retencion.referencia = batch.referencia;
                retencion.producto = batch.nombre_referencia;
                retencion.presentacion = batch.presentacion;
                retencion.lote = batch.numero_lote;
                retencion.orden = batch.numero_orden;
                if (i < $muestras_retencion.length)
                    retencion.consecutivo = $muestras_retencion[i]["muestra"];
                else retencion.consecutivo = "Microbiología";
                retencion.codigo = `Microbiología/${batch.numero_orden}/${batch.numero_lote}/${batch.referencia}`;
                arrayData.push(retencion);
            }
            exportarEtiquetas(operacion, arrayData);
        },
    });
};

const exportarEtiquetas = (operacion, arrayData) => {
    $.ajax({
        type: "POST",
        url: "../../html/php/exportar.php",
        data: { operacion, array: arrayData },

        success: function(response) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Datos para etiquetas exportados correctamente");
        },
    });
};


$("#btnImprimirTodaslasEtiquetas").click(function(e) {
    e.preventDefault();
    imprimirEtiquetasFull();
});


const ImprimirEtiquetasInvima = () => {
    $.ajax({
        url: `../../api/etiquetasvirtualesinv/${referencia}/${idBatch}`,
        success: function(response) {
            if (!flagE) flagE = 1;
            else return false;

            for (let j = 0; j < response.length; j++) {
                if (response[j]["fecha_registro"])
                    fecha = response[j]["fecha_registro"];
                if (response[j]["urlfirma"]) verifico = response[j]["urlfirma"];
                if (response[j]["cantidad"]) cantidad = response[j]["cantidad"];
            }

            //$(".etiquetasV").empty();

            for (i = 0; i < response.length - 2; i++) {
                $(".etiquetasV").append(
                    `<div class="etiquetaUnica rounded-3">
            <div class="etiquetasVirtuales">
                <p><b>OP: </b>${infoBatch.numero_orden}</p>
                <p id="peso"><b>PESO: </b>${(((response[i]["porcentaje"] / 100) * tamanioLote) / cantidad).toFixed(2)}Kg</p>
                <p><b>REFERENCIA:</b> ${response[i]["referencia"]}</p>
                <p><b>NOMBRE MP:</b> ${response[i]["alias"]}</p>
                <p><b>FECHA: </b> ${fecha}</p>
                <p><b>VoBo QC: </b><img src="${verifico}" style="width:60%"></p>
            </div>
          </div>`
                );
            }
        },
    });
};