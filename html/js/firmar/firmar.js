function enviar() {
    $('#m_firmar').modal('hide');
       
    datos = {
        email: $('#usuario').val(),
        password: $('#clave').val(),
        },

    $.ajax({
        type: 'POST',
        url: '../../html/php/firmar.php',
        data: datos,
        
        success: function (data) {
            //var value = JSON.parse(data);
            //console.log(resp.firma);
            let parent = $('#in_realizado').parent();
            $('#in_realizado').remove();
            //console.log(data);

            /* $.each(info, function(i, value) { */
                parent.append('<img id="in_verificado" src="data:image/png;base64;charset=utf-8,' + data +'">');
                //parent.append(`<img id="in_verificado" src="data:image/png;base64,` + resp.firma + `" height="130">`);
                //$select.append('<option>' + numeral(value.capacidad).format(',') + '</option>');
        /* }); */

            
            //parent.append(`<img id="in_verificado" src="data:image/png;base64",` + {info.firma} ` >`);
            //$('#in_realizado').val(resp.firma);
        }
    });
    return false;

}