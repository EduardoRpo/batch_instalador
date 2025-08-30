$(document).ready(function() {
    /* Carga de Cargos  */
    console.log('🔍 cargos.js - Iniciando carga de cargos');

    $.ajax({
        url: `/html/php/cargos_fetch.php`,
        type: 'GET',
    }).done((data, status, xhr) => {
        console.log('✅ cargos.js - Cargos recibidos:', data);
        data.forEach((cargo, indx) => {
            console.log(`🔍 cargos.js - Procesando cargo ${indx + 1}:`, cargo);
            $(`#cargo-${indx + 1}`).val(cargo.cargo)
        });
        console.log('✅ cargos.js - Cargos cargados exitosamente');
    }).fail((xhr, status, error) => {
        console.error('❌ cargos.js - Error al cargar cargos:', error);
        console.error('❌ cargos.js - Status:', status);
        console.error('❌ cargos.js - Response:', xhr.responseText);
    });

});