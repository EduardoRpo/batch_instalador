let id;
let btnOprimido;
let cont = 1;

function cargar(btn){
    id = btn.id;
    btnOprimido = id.split('_');

    if(btnOprimido[1]=='verificado' && cont == 1){
        alertify.set("notifier","position", "top-right"); alertify.error("Debe firmar en orden, primero el 'Realizado'.");
        return false;
    }else{
        //$('#plantillaEtiquetas').modal('show');
        //<a href="javascript:void(window.open('http://www.htmltopdfconverter.net/?convert='+window.location))">Convert To PDF</a>
        $('#m_firmar').modal('show');
        cont = 0;
    }
    
}


function enviar() {
   $('#m_firmar').modal('hide');
    
   let template = '<img id="" src="/html/firmas/BerneyMontoya/:firma:" alt="firma_usuario" height="130">'; 
    
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
            
            if(data==""){
                alertify.set("notifier","position", "top-right"); alertify.error("usuario y/o contraseña no coinciden.");
            }else{
                let parent = $('#'+id).parent();
                $('#'+id).remove();
                id='';
                let firma = template.replace(':firma:', data.urlfirma);
                parent.append(firma).html
                
                /* $('#imprimirEtiquetas').show(); /* Imprimir etiquetas */
                
                if(btnOprimido[1]=='verificado'){
                    cont = 1;
                }

            }
        }
    });
    return false;
}

function imprimirPDF(){
    $('#m_firmar').modal('show');
}