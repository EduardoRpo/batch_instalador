
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
    presentacion = parseInt(document.getElementById('presentacioncomercial').value);
    total = ((unidades * densidad * presentacion)/1000)*(1 + 0.03);

    (document.getElementById('tamanototallote').value) = numeral(total).format('0kb');
}

/* Limpiar datos al cambiar referencia en el modal de crear Batch */

$("#cmbNoReferencia").change(function(){
    $('#tamanototallote').val('');
    $('#unidadesxlote').val('');
    $('#fechaprogramacion').val('');
    
});


/* Adicionar y elimina campos para los tanques al crear batch record */

let maxField = 5;
let tnq = 1;
let pr = 1;
let cont=1;
let total = 0;

$("#adicionarPesaje").on('click', function(){
    let unidades = $('#unidadesxlote').val(); 
    let lote = $('#tamanototallote').val();
    
    if(unidades == "" || unidades == 0 || lote == 0 ){
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar Tanques, complete todos los campos.");
        return false;
    }
    
    let template = '<select class="form-control" name="cmbtanque" id=":cmbTanque:" onchange = "validarTanque();">' +
                    '</select>' +
                    '<input type="number" class="form-control" id=":txtCantidad:" name="txtCantidad[]" placeholder="Cantidad" value="0" onblur="CalcularTanque()">' +
                    '<input type="number" class="form-control" id=":txtTotal:" name="txtTotal[]" placeholder="Total" readonly>' +
                    '<button class="btn btn-warning eliminarTanque" type="button">X</button>'

    let nuevo = template.replace(':cmbTanque:', 'cmbTanque'+cont).replace(':txtCantidad:', 'txtCantidad'+cont).replace(':txtTotal:', 'txtTotal'+cont );
    let totaltl = $('input#transito').val();

    if(tnq == 1) {
        $(".insertarTanque").append(nuevo);
        cargarTanque(cont)
        tnq++;
        cont++;

    }else if(tnq >= 2 && tnq <= maxField && totaltl != 0 && totaltl != ""){
        $(".insertarTanque").append(nuevo);
        cargarTanque(cont)
        cont--
        $('#txtCantidad'+ cont).attr("readonly","readonly");
        $('#cmbTanque'+ cont).attr("disabled", true);
        cont++;
        tnq++;
        cont++;
        $('#transito').val(0);

    }else{
        alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar más tanques diligencie todos los campos vacios o corriga los datos.");
        }        
});

/* Cargar tanques */

function cargarTanque(cont) {
    
    $.ajax({
        type: "POST",
        'url' : 'php/listarBatch.php',
        'data':{"operacion" : "9"},
        success: function(r){
            var $select = $('#cmbTanque'+cont);
                //$('#cmbTanque'+contador).empty();
                var info = JSON.parse(r);            
                                
                $select.append('<option disabled selected>' + "Tanque" + '</option>');
                
                $.each(info, function(i, value) {
                    $select.append('<option>' + value.capacidad + '</option>');
            });
                
            //$('#modalCrearBatch').modal('show');
        }
    });
}

/* Calcular el valor de los tanques */

var tanque="";

function validarTanque(){
    cont--;
    let cant = $('#txtCantidad' + cont).val();
    if(cant!= ""){
        cont++;
        CalcularTanque();
    }
}

function CalcularTanque() {

    $('#sumaTanques').val('');
    cont--;

    let cambio = '#cmbTanque' + cont + ' option:selected';
    let tanque = $(cambio).val();
    let cantidad = $('#txtCantidad' + cont ).val();


    if (tanque == "Tanque"){
        cont++;
        return false;
    }

    total = tanque * cantidad;
    $('#txtTotal'+cont).val(total);
    $('#transito').val(total);

    let txtTotal1 = $('#txtTotal1').val();
    let txtTotal2 = $('#txtTotal2').val();
    let txtTotal3 = $('#txtTotal3').val();
    let txtTotal4 = $('#txtTotal4').val();
    let txtTotal5 = $('#txtTotal5').val();
    
    let sumaTanques = $('#sumaTanques').val();
    
    if(cont==1 ){
        sumaTanques=0;
    }

    if(txtTotal1 == undefined || txtTotal1==""){
        txtTotal1 = 0;
    }if(txtTotal2 == undefined || txtTotal2==""){
        txtTotal2 = 0;
    }if(txtTotal3 == undefined || txtTotal3==""){
        txtTotal3 = 0;
    }if(txtTotal4 == undefined || txtTotal4==""){
        txtTotal4 = 0;
    }if(txtTotal5 == undefined || txtTotal5==""){
        txtTotal5 = 0;
    }   
      
    sumaTanques =  parseInt(txtTotal1) + parseInt(txtTotal2) + parseInt(txtTotal3) + parseInt(txtTotal4) + parseInt(txtTotal5);
    //sumaTanques = parseInt(sumaTanques) + total
    
    let cantidadLote = $('#tamanototallote').val();
    
    if(sumaTanques > cantidadLote ){
        alertify.set("notifier","position", "top-right"); alertify.error("La configuración de Tanques supera el Tamaño del lote");
        $('input#transito').val('');
        cont++;
        return false;
    }else{
        $('#sumaTanques').val(sumaTanques);
    }
       
    if(tanque!='Tanque'){
        cont++;
    }
        
}

/* Eliminar Tanque */

$(document).on("click",".eliminarTanque", function(){
    cont--;
    
    $('#cmbTanque' + cont).remove();
    $('#txtCantidad'+ cont).remove();
    $('#txtTotal' + cont).remove();
    $(this).remove();
        
    tnq--;

    let temporal = $('#txtTotal1').val();
    $('#transito').val(temporal);

    let txtTotal1 = $('#txtTotal1').val();
    let txtTotal2 = $('#txtTotal2').val();
    let txtTotal3 = $('#txtTotal3').val();
    let txtTotal4 = $('#txtTotal4').val();
    let txtTotal5 = $('#txtTotal5').val();
    
    let sumaTanques = 0;

    if(txtTotal1 == undefined){
        txtTotal1 = 0;
    }if(txtTotal2 == undefined){
        txtTotal2 = 0;
    }if(txtTotal3 == undefined){
        txtTotal3 = 0;
    }if(txtTotal4 == undefined){
        txtTotal4 = 0;
    }if(txtTotal5 == undefined){
        txtTotal5 = 0;
    }   

    sumaTanques =  parseInt(txtTotal1) + parseInt(txtTotal2) + parseInt(txtTotal3) + parseInt(txtTotal4) + parseInt(txtTotal5)

    $('#sumaTanques').val(sumaTanques);
    cont--;
    $('#txtCantidad'+ cont).removeAttr("readonly");
    $('#cmbTanque'+ cont).attr("disabled", false);
    cont++;
});

/* cerrar modal al crear Batch */

function cerrarModal(){
    $('#modalCrearBatch').modal('hide');
}