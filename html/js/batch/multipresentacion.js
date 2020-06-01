/* Multipresentacion */

$('#tablaBatch tbody').on( 'click', 'tr', function () {  
    data = tabla.row( this ).data();
});

function multipresentacion() {
    if ($("input[name='optradio']:radio").is(':checked')) {
        //console.log(data.id_batch);
        
        $.ajax({
            type: "POST",
            'url' : 'php/listarBatch.php',
            'data':{"operacion" : "8" , id : data.id_batch},
            
            success: function(r){
                var $select = $('#MultiReferencia');
                $('#MultiReferencia').empty();
                var info = JSON.parse(r);            
                
                $select.append('<option disabled selected>' + "Seleccione una opción" + '</option>');
                
                $.each(info, function(i, value) {
                    $select.append('<option value=' + i.id + '>' + value.nombre_referencia + '</option>');
                });
                
                $('#totalMulti').val('');
                $('#Modal_Multipresentacion').modal('show');
                }
            });
                

    } else {
        alertify.set("notifier","position", "top-right"); alertify.error("Para Multipresentación seleccione un Batch Record");
    }
}

/* Insertar campos dinamicos */

$(function(){

var maxField = 5;
var ps = 1;
var pr = 1;

$("#masMulti").on('click', function(){
    if(ps < maxField){
        $("#tablaMulti tbody tr:eq(0)").clone().removeClass().appendTo('#tablaMulti');
        ps++;
    }    
});

$(document).on("click",".menosMulti", function(){
    var parent = $(this).parents().get(0);
    if(ps != 1){
        $(parent).remove();
        ps--;
        }
    });
});
