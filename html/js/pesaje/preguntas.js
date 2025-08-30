const preguntas = async (modulo) => {
    console.log('🔍 preguntas - Buscando preguntas para módulo:', modulo);
    console.log('🔍 preguntas - URL que se va a llamar:', `/html/php/questions_fetch.php?modulo=${modulo}&v=${Date.now()}`);
    
    try {
        const response = await $.ajax({
            url: `/html/php/questions_fetch.php?modulo=${modulo}&v=${Date.now()}`,
            type: 'GET',
            dataType: 'json'
        });
        
        console.log('✅ preguntas - Respuesta exitosa:', response);
        return response;
        
    } catch (error) {
        console.log('❌ preguntas - Error en la petición:', error);
        console.log('❌ preguntas - Status:', error.status);
        console.log('❌ preguntas - Response:', error.responseJSON);
        return null;
    }
}; 