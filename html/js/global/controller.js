$(document).ready(function() {
    /* Si el usuario existe, ejecuta la opción de acuerdo con la seleccion */

    controller = (datos) => {

        info = datos;

        if (btn_id == "firma1") {
            if (modulo === 7) guardar_despacho(info);
            if (modulo === 8) guardar_microbiologia(info);
            if (modulo === 9) firmar2daSeccion(info);
            if (modulo === 10) guardarLiberacion(info);
            else if (modulo !== 7 && modulo !== 8 && modulo !== 9) guardar_preguntas(info.id);
            if (modulo != 7 && modulo != 8) firmar(info);
            
            // Solo para pesaje (módulo 2): marcar automáticamente verificado del despeje
            if (modulo == 2) {
                marcarVerificadoDespejeComoAprobado();
            }
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
            if (modulo === 5 || modulo === 6) almacenarControlProceso(info);
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