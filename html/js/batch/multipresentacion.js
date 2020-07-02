
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
                var info = JSON.parse(r);  
                
                if(info!=''){
                    $('#Modal_Multipresentacion').modal('show');
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

let maxRef = 5;
ps = 1;
pr = 1;
cont=0;
total = 0;

$("#masMulti").on('click', function(){
    cont++;

    if ($('#inputcalculoTotal').is(':hidden')) {
        $('#inputcalculoTotal').show();
    } 

    var template = '<select class="form-control" name="MultiReferencia" id=":cmbMultiReferencia:" onchange="cargarReferenciaM();" required>' +
                    '</select>' +
                    '<input type="text" class="form-control" id=":cantidadMulti:" name="cantidadMulti" placeholder="Unidades" onblur="CalculoloteMulti(this.value);">' +
                    '<input type="text" class="form-control" id=":tamanoloteMulti:" name="tamanoloteMulti" readonly placeholder="Lote">' +
                    '<input type="text" class="form-control" id=":densidadMulti:" name="densidadMulti" placeholder="Densidad" hidden>' + /* hidden */
                    '<input type="text" class="form-control" id=":presentacionMulti:" name="presentacionMulti" placeholder="Presentación" hidden>' + /* hidden */
                    '<button class="btn btn-warning eliminarMulti" type="button">X</button>'

    var nuevo = template.replace(':cmbMultiReferencia:', 'cmbMultiReferencia'+ cont).replace(':cantidadMulti:', 'cantidadMulti'+ cont).replace(':tamanoloteMulti:', 'tamanoloteMulti'+ cont).replace(':densidadMulti:', 'densidadMulti'+ cont ).replace(':presentacionMulti:', 'presentacionMulti'+ cont );
    var totaltl = $('input#transitoMulti').val();

    if(ps == 1) {
        $(".insertarRefMulti").append(nuevo);
        cargarMulti(cont)
        ps++;

    }else if(ps >= 2 && ps <= maxRef && totaltl != 0 && totaltl != ""){
        $(".insertarRefMulti").append(nuevo);
        cargarMulti(cont)
        cont--
        $('#cantidadMulti'+ cont).attr("readonly","readonly");
        $('#cmbMultiReferencia'+ cont).attr("disabled", true);
        cont++;
        ps++;
        $('#transitoMulti').val(0);

    }else{
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar otras Presentaciones diligencie todos los campos vacios o corriga los datos.");
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
            console.log(info);
            $select.append('<option disabled selected>' + "Multipresentacion" + '</option>');
            
            $.each(info, function(i, value) {
                $select.append('<option value=' + i.id + '>' + value.nombre_referencia + '</option>');
            });
            
        }
    });
}

/* cargar datos de acuerdo con la seleccion de multipresentacion */
var sel;

function cargarReferenciaM(){
    
    sel =  $("#cmbMultiReferencia"+ cont +" option:selected").text();

    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "11", "nombre_referencia" :  sel},
        
        success: function(r)
        {
            var info = JSON.parse(r);
                      
            $.ajax({
                type: "POST",
                'url' : 'php/listarBatch.php',
                'data':{"operacion" : "4", "id" : info[0].referencia},
                
                success: function(r)
                {
                    var info = JSON.parse(r);
                    
                    $('#presentacionMulti'+cont).val(info[0].presentacion);
                    $('#densidadMulti'+cont).val(info[0].densidad);
                    $('#loteTotal').val(data.tamano_lote);
                    
                }
            });
           
        }
    });
    validarMulti();
}

/* Calcular Lote de acuerdo con la seleccion y las unidades a fabricar */

function validarMulti(){

    var cant = $('#cantidadMulti' + cont).val();
    if(cant!= ""){
        CalculoloteMulti();
    }
}


/* calcular Tamaño del Lote */

function CalculoloteMulti () {

    var cantidad = $('#cantidadMulti' + cont ).val();
    var densidad = $('#densidadMulti' + cont).val();
    var presentacion = $('#presentacionMulti' + cont).val();

    if (sel == "Multipresentacion"){
        return false;
    }

    total = parseInt(((densidad * cantidad * presentacion)/1000)*( 1 + 0.03));
    $('#tamanoloteMulti' + cont).val(total);    
    $('#transitoMulti').val(total);

    var txtTotalm1 = $('#tamanoloteMulti1').val();
    var txtTotalm2 = $('#tamanoloteMulti2').val();
    var txtTotalm3 = $('#tamanoloteMulti3').val();
    var txtTotalm4 = $('#tamanoloteMulti4').val();
    var txtTotalm5 = $('#tamanoloteMulti5').val();

    var sumaMulti = $('#sumaMulti').val();
    
    if(cont==1 ){
        sumaMulti=0;
    }
    
    if(txtTotalm1 == undefined || txtTotalm1==""){
        txtTotalm1 = 0;
    }if(txtTotalm2 == undefined || txtTotalm2==""){
        txtTotalm2 = 0;
    }if(txtTotalm3 == undefined || txtTotalm3==""){
        txtTotalm3 = 0;
    }if(txtTotalm4 == undefined || txtTotalm4==""){
        txtTotalm4 = 0;
    }if(txtTotalm5 == undefined || txtTotalm5==""){
        txtTotalm5 = 0;
    }  
    
    sumaMulti =  parseInt(txtTotalm1) + parseInt(txtTotalm2) + parseInt(txtTotalm3) + parseInt(txtTotalm4) + parseInt(txtTotalm5);
    
    var cantidadLote = $('#loteTotal').val();
    
    if(sumaMulti > cantidadLote ){
        alertify.set("notifier","position", "top-right"); alertify.error("El tamaño del lote para esta referencia de Multipresentación supera el Tamaño del lote inicial");
        $('input#transitoMulti').val('');
        return false;
    }else{
        $('#sumaMulti').val(sumaMulti);    
    }
 
}

/* Eliminar Multipresentacion */

$(document).on("click",".eliminarMulti", function(){
    
    $('#cmbMultiReferencia' + cont).remove();
    $('#cantidadMulti'+ cont).remove();
    $('#tamanoloteMulti' + cont).remove();
    $('#densidadMulti' + cont).remove();
    $('#presentacionMulti' + cont).remove();
    $(this).remove();
        
    cont--;

    var temp = $('#txtTotalm' + cont).val();
    $('#transito').val(temp);

    var txtTotalm1 = $('#tamanoloteMulti1').val();
    var txtTotalm2 = $('#tamanoloteMulti2').val();
    var txtTotalm3 = $('#tamanoloteMulti3').val();
    var txtTotalm4 = $('#tamanoloteMulti4').val();
    var txtTotalm5 = $('#tamanoloteMulti5').val();
    
    var sumaPresentaciones = 0;

    if(txtTotalm1 == undefined){
        txtTotalm1 = 0;
    }if(txtTotalm2 == undefined){
        txtTotalm2 = 0;
    }if(txtTotalm3 == undefined){
        txtTotalm3 = 0;
    }if(txtTotalm4 == undefined){
        txtTotalm4 = 0;
    }if(txtTotalm5 == undefined){
        txtTotalm5 = 0;
    }   

    sumaPresentaciones =  parseInt(txtTotalm1) + parseInt(txtTotalm2) + parseInt(txtTotalm3) + parseInt(txtTotalm4) + parseInt(txtTotalm5)

    $('#sumaMulti').val(sumaPresentaciones);
    $('#cantidadMulti'+ cont).removeAttr("readonly");
    $('#cmbMultiReferencia'+ cont).attr("disabled", false);
});

/* cerrar modal al crear Batch */

/* function cerrarModal(){
    $('#modalCrearBatch').modal('hide');
    $('#Modal_Multipresentacion').modal('hide');

} */ 

function guardar_Multi() {  
    var ref = [];
    var cant = [];

    var j=1;

    for(i=0; i<cont ; i++){
        //ref[i] = $('#cmbMultiReferencia' + j).text();
        ref[i] = $('#cmbMultiReferencia' + j + ' option:selected').text();
        j++;
    }
    
    j=1;
    
    for(i=0; i<cont ; i++){
        cant[i] = $('#cantidadMulti'+ j).val();
        j++;
    }
    
    if(!editar){
        datos = {
            operacion: "12",
            ref: ref, 
            cant: cant,
            id : data.id_batch
        };

    }else{
            datos = {
            operacion: "13",
            ref: ref, 
            cant: cant,
            id : data.id_batch
            };
    }

    $.ajax({
        type: "POST",
        url: "php/listarBatch.php",
        data: datos,
        
        success: function(r){
            alertify.set("notifier","position", "top-right"); alertify.success("Multipresentación registrada con éxito.");
            cerrarModal();
            //actualizarTabla();
            
        },
        error: function(r){
            alertify.set("notifier","position", "top-right"); alertify.error("Error al registrar la Multipresentación.");
        } 
    });


}