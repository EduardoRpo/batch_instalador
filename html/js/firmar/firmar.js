function enviar() {
   $('#m_firmar').modal('hide');
    
   var template = '<img id="in_verificado" src="/html/firmas/BerneyMontoya/:firma:" alt="firma_usuario" height="130">'; 
    
    datos = {
        email: $('#usuario').val(),
        password: $('#clave').val(),
        },

    $.ajax({
        type: 'POST',
        url: '../../html/php/firmar.php',
        data: datos,
    
        success: function (datos) {
            data = JSON.parse(datos);
            let parent = $('#in_realizado').parent();
            $('#in_realizado').remove();
            var firma = template.replace(':firma:', data.urlfirma);
            parent.append(firma).html
        }
    });
    return false;

}