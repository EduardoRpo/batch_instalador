
/* Validar Batch Record y si existe Cargar Multipresentación */

$('#tablaBatch tbody').on( 'click', 'tr', function () {  
    data = tabla.row( this ).data();
});

function multipresentacion() {
    if ($("input[name='optradio']:radio").is(':checked')) {
        
        $.ajax({
            type: "POST",
            'url' : 'php/listarBatch.php',
            'data':{"operacion" : "8", id : data.id_batch},
            
            success: function(r){
                /* var $select = $('#MultiReferencia');
                $('#MultiReferencia').empty();*/
                var info = JSON.parse(r);  
                
                if(info!=''){
                    $('#Modal_Multipresentacion').modal('show');
                    
                   /*  $select.append('<option disabled selected>' + "Seleccione una opción" + '</option>');
                
                    $.each(info, function(i, value) {
                        $select.append('<option value=' + i.id + '>' + value.nombre_referencia + '</option>');
                    });
                    
                    $('#totalMulti').val('');
                    $('#Modal_Multipresentacion').modal('show'); */
                    }

                else{
                  alertify.set("notifier","position", "top-right"); alertify.error("No existen referencias asociadas para este producto.");
                } 
            }   
        });
                
    } else {
        alertify.set("notifier","position", "top-right"); alertify.error("Para Multipresentación seleccione un Batch Record");
    }
}

/* Adicionar y multipresentacion en un batch*/

var maxField = 5;
var ps = 1;
var pr = 1;
var cont=1;
var total = 0;

$("#masMulti").on('click', function(){
    //var unidades = $('#unidadesxlote').val(); 
    //var lote = $('#tamanototallote').val();
    
    /* if(unidades == "" || unidades == 0 || lote == 0 ){
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar Tanques, complete todos los campos.");
        return false;
    } */
    
    var template = '<select class="form-control" name="MultiReferencia" id=":cmbMultiReferencia:" onchange="cargarReferenciaM();" required>' +
                    '</select>' +
                    '<input type="text" class="form-control" id=":cantidadMulti:" name="cantidadMulti" placeholder="Unidades" onblur="CalculoloteMulti(this.value);">' +
                    '<input type="text" class="form-control" id=":tamanoloteMulti:" name="tamanoloteMulti" readonly placeholder="Lote">' +
                    '<input type="text" class="form-control" id=":densidadMulti:" name="densidadMulti" placeholder="Densidad" hidden >' + /* hidden */
                    '<input type="text" class="form-control" id=":presentacionMulti:" name="presentacionMulti" placeholder="Presentación" hidden >' + /* hidden */
                    '<button class="btn btn-warning eliminarMulti" type="button">X</button>'

    var nuevo = template.replace(':cmbMultiReferencia:', 'cmbMultiReferencia'+ cont).replace(':cantidadMulti:', 'cantidadMulti'+ cont).replace(':tamanoloteMulti:', 'tamanoloteMulti'+ cont).replace(':densidadMulti:', 'densidadMulti'+ cont ).replace(':presentacionMulti:', 'presentacionMulti'+ cont );
    var totaltl = $('input#transitoMulti').val();

    if(ps == 1) {
        $(".insertarRefMulti").append(nuevo);
        cargarMulti(cont)
        ps++;
        cont++;

    }else if(ps >= 2 && ps <= maxField && totaltl != 0 && totaltl != ""){
        $(".insertarRefMulti").append(nuevo);
        cargarMulti(cont)
        ps++;
        cont++;
        $('#transitoMulti').val(0);

    }else{
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar más referencias diligencie todos los campos vacios.");
        }        
});


/* Cargar Select Referencias con Multipresentacion */

function cargarMulti(cont) {
    
    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "8", id : data.id_batch},
        success: function(r){
            var $select = $('#cmbMultiReferencia' + cont);
            var info = JSON.parse(r);            

            $select.append('<option disabled selected>' + "Multipresentacion" + '</option>');
            
            $.each(info, function(i, value) {
                $select.append('<option value=' + i.id + '>' + value.nombre_referencia + '</option>');
            });
            
        }
    });
}

/* cargar datos de acuerdo con la seleccion de multipresentacion */

function cargarReferenciaM(){
    cont--;
    var combo = document.getElementById("cmbMultiReferencia" + cont);
    var sel = combo.options[combo.selectedIndex].text;

    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "11", "nombre_referencia" :  sel},
        
        success: function(r)
        {
            var info = JSON.parse(r);
            cont++;
                      
            $.ajax({
                type: "POST",
                'url' : 'php/listarBatch.php',
                'data':{"operacion" : "4", "id" : info[0].referencia},
                
                success: function(r)
                {
                    var info = JSON.parse(r);
                    cont--;
                    
                    $('#presentacionMulti'+cont).val(info[0].presentacion);
                    $('#densidadMulti'+cont).val(info[0].densidad);
                    $('#loteTotal').val(data.tamano_lote);
                }
            });
           
        }
    });

}

/* Calcular Lote de acuerdo con la seleccion y las unidades a fabricar */

/* calcular Tamaño del Lote */

function CalculoloteMulti (cantidad) {
    //cont--;

    var combo = document.getElementById("cmbMultiReferencia" + cont);
    var sel = combo.options[combo.selectedIndex].text;
    
    if (sel == "Multipresentacion"){
        cont++;
        return false;
    }

    var densidad = $('#densidadMulti' + cont).val();
    var presentacion = $('#presentacionMulti' + cont).val();
    
    total = ((densidad * cantidad * presentacion)/1000)*( 1 + 0.03);
    $('#tamanoloteMulti' + cont).val(total);    

    var sumaMulti = $('#sumaMulti').val();
    
    if(cont==1 ){
        sumaMulti=0;
    }
    
    
    sumaMulti = parseInt(sumaMulti) + total
    var cantidadLote = $('#loteTotal').val();
    
    if(sumaMulti > cantidadLote ){
        alertify.set("notifier","position", "top-right"); alertify.error("El tamaño del lote para Multipresentación supera el Tamaño del lote inicial");
        cont--;
        return false;
    }else{
        $('#sumaMulti').val(sumaMulti);    
    }

    //$('#txtTotal'+cont).val(total);
    $('#transitoMulti').val(total);
    
    /* if(sel!='Multipresentacion'){
        cont++;
    } */
        
}

    