$(document).ready(function() {
    /* Si el usuario existe, ejecuta la opción de acuerdo con la seleccion */

    // const QUESTIONS = { firma1: [2, 3, 4, 5, 6, 7] }
    // const ROUTES1 = { firma1: [7, 8, 9] }
    // const ROUTES2 = { firma2: [8, 9, 10] }
    // const FIRMAR1 = { firma1: [2, 3, 4, 5, 6, 9, 10] }
    // const FIRMAR2 = { firma2: [2, 3, 4, 5, 6, 9, 10] }

    controller = (datos) => {

        info = datos;

        // QUESTIONS[btn_id].includes(modulo) ? guardar_preguntas(info) :
        //     ROUTES1[btn_id].includes(modulo) ? guardar_despacho(info) :
        //     ROUTES1[btn_id].includes(modulo) ? guardar_microbiologia(info) :
        //     ROUTES1[btn_id].includes(modulo) ? firmar2daSeccion(info) :
        //     FIRMAR1[btn_id].includes(modulo) ? firmar(info) : 'false'


        // ROUTES2[btn_id].includes(modulo) ? guardar_microbiologia_calidad(info) :
        //     ROUTES2[btn_id].includes(modulo) ? almacenarfirma(info) :
        //     ROUTES2[btn_id].includes(modulo) ? guardarLiberacion(info) :
        //     FIRMAR2[btn_id].includes(modulo) ? firmarVerficadoDespeje(info.id) :
        //     FIRMAR2[btn_id].includes(modulo) ? firmar(info) : 'false'



        if (btn_id == "firma1") {
            if (modulo === 7) guardar_despacho(info);
            if (modulo === 8) guardar_microbiologia(info);
            if (modulo === 9) firmar2daSeccion(info);
            if (modulo === 10) guardarLiberacion(info);
            else if (modulo !== 8 && modulo !== 9) guardar_preguntas(info.id);
            if (modulo != 7 && modulo != 8) firmar(info);
        }

        if (btn_id == "firma2") {
            if (modulo === 8) guardar_microbiologia_calidad(info);
            if (modulo === 9) almacenarfirma(info);
            if (modulo === 10) guardarLiberacion(info);
            else if (modulo !== 8 && modulo !== 9) {
                firmarVerficadoDespeje(info.id);
                firmar(info);
            }
        }

        if (btn_id == "firma3") {
            if (modulo === 5 || modulo === 6) almacenar_muestras(info);
            else if (modulo == 10) guardarLiberacion(info);
            else firmar2daSeccion(info);
        }

        if (btn_id == "firma4") almacenarfirma(info);


        if (btn_id == "firma5") {
            if (modulo != 5 && modulo != 6) {
                info.id;
                firmar(info);
            } else {
                registrar_material_sobrante(info.id);
                observaciones_incidencias(info);
                firmar(info);
            }
        }

        if (btn_id == "firma6") {
            firmaCalidad(info.id);
            firmar(info);
        }

        if (btn_id == "firma7") registrar_conciliacion(info);

    }
});