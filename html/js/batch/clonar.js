//obtener la fecha del dia
 
//var fechaHoy;

function fechaActual(){
    var d = new Date();

        var mes = d.getMonth() + 1;
        var dia = d.getDate();
        var fechaHoy = d.getFullYear() + '/' + (mes<10 ? '0' : '') + mes + '/' + (dia<10 ? '0' : '') + dia;
        return fechaHoy;
        
}

//Clonar un Batch Record

function clonar() {
    if ($("input[name='optradio']:radio").is(':checked')) {
        $('#ClonarModal').modal('show');
    } else {
        alertify.set("notifier","position", "top-right"); alertify.error("Para Clonar seleccione un Batch Record");
    }
}

$('#tablaBatch tbody').on( 'click', 'tr', function () {  
    data = tabla.row( this ).data();
});

$('#form_clonar').submit(function (event) {
    event.preventDefault();
    if ($("input[name='optradio']:radio").is(':checked')) {
       var duplicar = $("#txtCantidadCB").val();
       console.log(duplicar);
     
       fechaActual();
       console.log(fechaHoy);
       return false;

        $.ajax({
            type: "POST",
            'url' : 'php/listarBatch.php',
            'data': { operacion : "10", id : data.id_batch},
            
            success: function(r){
                var info = JSON.parse(r);
                
                $.ajax({
                    type: "POST",
                    'url' : 'php/listarBatch.php',
                    'data': { 
                        operacion : "5", 
                        
                        ref : info[0].id_producto,
                        unidades: info[0].unidad_lote,
                        lote: info[0].tamano_lote,
                        programacion: '',
                        presentacion: info[0].lote_presentacion,
                        fecha: fechaActual,
                        },
                    
                    success: function(r){
                        alertify.set("notifier","position", "top-right"); alertify.success("Batch Record Clonado.");
                        $('#ClonarModal').modal('hide');
                        actualizarTabla();

                    }
                });
            }   
        });

    } else {
        alertify.set("notifier","position", "top-right"); alertify.error("Imposible clonar");
    }
})