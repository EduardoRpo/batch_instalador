let envase;
let presentacion;
let r1 = 0;
let r2 = 0;
let r3 = 0;
let r4 = 0;

$(document).ready(function() {

    /* Cargar referencia */

    $(".ref_multi1").click(function(e) {
        e.preventDefault();
        ref_multi = $(`.ref1`).val();
        id_multi = 1;
        sessionStorage.setItem('id_multi', id_multi)
        r1++;
        if (modulo == 5) identificarDensidad(batch);
        presentacion_multi();
    });

    $(".ref_multi2").click(function(e) {
        e.preventDefault();
        ref_multi = $(`.ref2`).val();
        id_multi = 2;
        sessionStorage.setItem('id_multi', id_multi)
        r2++;
        if (modulo == 5) identificarDensidad(batch);
        presentacion_multi();
    });

    $(".ref_multi3").click(function(e) {
        e.preventDefault();
        ref_multi = $(`.ref3`).val();
        id_multi = 3;
        sessionStorage.setItem('id_multi', id_multi)
        r3++;
        if (modulo == 5) identificarDensidad(batch);
        presentacion_multi();
    });

    $(".ref_multi4").click(function(e) {
        e.preventDefault();
        ref_multi = $(`.ref4`).val();
        id_multi = 4;
        sessionStorage.setItem('id_multi', id_multi)
        r4++;
        if (modulo == 5) identificarDensidad(batch);
        presentacion_multi();
    });

    presentacion_multi = () => {
        if (batchMulti) {
            batch = batchMulti.find((elemento) => elemento.referencia == ref_multi);
            presentacion = batch.presentacion;
        } else presentacion = batch.presentacion;
        cargarImagen(ref_multi);
        if (modulo !== 7) cargarfirma2();
        if (modulo === 7) {
            cargar_despacho();
            /* cargarBatch(); */
        }
    }

});