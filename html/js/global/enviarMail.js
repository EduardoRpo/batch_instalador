
/* Enviar Email */

function enviarEmail(email, nombre, asunto, cuerpo){
    
    datos = {
        email: email,
        nombre: nombre,
        asunto: asunto,
        cuerpo: cuerpo
        },

    $.ajax({
        type: 'POST',
        url: '../../html/php/enviarEmail.php',
        data: datos,
    
        success: function (datos) {
            data = JSON.parse(datos);
            
            
        }
    });
    return false;
}