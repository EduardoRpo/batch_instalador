
/* Mostrar contraseña */

function mostrarPassword() {
    debugger
    if ($('#clave').val()==='') {
        alertify.set("notifier","position", "top-right"); alertify.error("Ingrese la password");
        return false;        
    }


    $('#clave').attr('type', 'text');
    setTimeout(function () { $('#clave').attr('type', 'password'); }, 1000);

}



/* $(document).on('ready', function(event){
    event.preventDefault();
    $('#iniciar').click(function(){
        $('.form-signin input:first').attr('id', 'usuario');




    })
})
 */


/* function loguears() {

    $(".form-signin")
        //.find('input')
        //.first()
        .attr("id", "usuario");

    return false;

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
                var firma = template.replace(':firma:', data.urlfirma);
                parent.append(firma).html
            }
        }
    });
    return false;
}*/