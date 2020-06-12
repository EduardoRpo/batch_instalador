
/* Mostrar Modal y Ocultar select referencias */

function mostrarModal(){
    $("#referencia").css("display", "none");
    $("#cmbNoReferencia").css("display", "block");
    //$("#cmbNoReferencia").valor()
    $("#modalCrearBatch").find("input,textarea,select").val("");
    $('#guardarBatch').html('Crear');
    $('.tcrearBatch').html('Crear Batch Record');
    cargarReferencias();
    cargarTanque();
     
}

/* Llenar el selector de referencias al crear Batch */

function cargarReferencias() {
    
    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "3"},
        success: function(r){
            var $select = $('#cmbNoReferencia');
                $('#cmbNoReferencia').empty();
                var info = JSON.parse(r);            
                                
                $select.append('<option disabled selected>' + "Referencia" + '</option>');
                
                $.each(info, function(i, value) {
                    $select.append('<option>' + value.referencia + '</option>');
            });
                
            $('#modalCrearBatch').modal('show');
        }
    });
}

/* Cargar tanques */

function cargarTanque() {
    
    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "9"},
        success: function(r){
            var $select = $('#cmbTanque');
                $('#cmbTanque').empty();
                var info = JSON.parse(r);            
                                
                $select.append('<option disabled selected>' + "Tanque" + '</option>');
                
                $.each(info, function(i, value) {
                    $select.append('<option>' + numeral(value.capacidad).format(',') + '</option>');
            });
                
            //$('#modalCrearBatch').modal('show');
        }
    });
}


/* Llenar campos de producto de acuerdo con la referencia del producto */

$(document).ready(function() {
    $('#cmbNoReferencia').change(function(){
        recargarDatos();
    });
});

function recargarDatos(){
    var combo = document.getElementById("cmbNoReferencia");
    var sel = combo.options[combo.selectedIndex].text;

    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "4", "id" : sel},
        
        success: function(r)
        {
            var info = JSON.parse(r);
            //console.log(info);


            $('#idbatch').val(info[0].referencia);
            $('#nombrereferencia').val(info[0].nombre);
            $('#marca').val(info[0].marca);
            $('#notificacionSanitaria').val(info[0].notificacion_sanitaria);
            $('#propietario').val(info[0].propietario);
            $('#producto').val(info[0].producto);          
            $('#presentacioncomercial').val(info[0].presentacion);
            $('#linea').val(info[0].linea);
            $('#densidad').val(info[0].densidad);
        }
    });
}

/* calcular Tamaño del Lote */

function CalculoTamanolote (valor) {
    var total = 0;	
    unidades = parseInt(valor);
	
    densidad = document.getElementById('densidad').value;
    console.log(densidad);
    presentacion = parseInt(document.getElementById('presentacioncomercial').value);
    console.log(presentacion);
    total = (unidades * densidad * presentacion)/1000;
    console.log(total);
    (document.getElementById('tamanototallote').value) = numeral(total).format('0kb');
    console.log(total);
}

/* Limpiar datos al cambiar referencia en el modal de crear Batch */

$("#cmbNoReferencia").change(function(){
    $('#tamanototallote').val('');
    $('#unidadesxlote').val('');
    $('#fechaprogramacion').val('');
    
});


/* Adicionar y elimina campos para los tanques al crear batch record */
var maxField = 5;
var ps = 1;
var pr = 1;


$("#adicionarPesaje").on('click', function(){
    
    var total = $('#txtTotal').val();
    
    if(ps==1  && total == ""){
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar más tanques diligencia todos los campos vacios.");
        
    }else{

        var trs = $("addTanquePesaje tbody tr");
        $.each(trs, function(i, tr) {
            if (!$(tr).attr('id')) {    
            $(tr).attr('id', i + 1);
            }
        });  
        
        if(ps < maxField){
            $("#addTanquePesaje tbody tr:eq(0)").clone().appendTo('#addTanquePesaje');
            ps++;
        }    
    }
});

$(document).on("click",".eliminarPesaje", function(){
/* function eliminarTanque(){  */    
    var parent = $(this).parents().get(0);
    if(ps != 1){
       /*  $("#txtCantidad").remove();
        $("#txtTotal").remove();
        $("#btnEliminarTanques").remove(); */
        $(parent).remove();
        ps--;
    /* } */ 
    }
});

/* cerrar modal al crear Batch */

function cerrarModal(){
    $('#modalCrearBatch').modal('hide');
}


/* Multiplica el tamaño de los tanques */

function CalcularTanque() {

    $('#addTanquePesaje tr').each(function(){

        var cantidad = $('#txtCantidad').val();
        var tanque = $('select[name=cmbtanque]').val()
        var total = tanque * cantidad;

        $('#txtTotal').val(total);

    })   
 }