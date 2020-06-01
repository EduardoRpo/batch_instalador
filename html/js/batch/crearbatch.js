
/* Mostrar Modal y Ocultar select referencias */

function mostrarModal(){
    $("#referencia").css("display", "none");
    $("#cmbNoReferencia").css("display", "block");
    //$("#cmbNoReferencia").valor()
    $("#modalCrearBatch").find("input,textarea,select").val("");
    $('#guardarBatch').html('Crear');
    $('.tcrearBatch').html('Crear Batch Record');
    cargarReferencias();
     
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
                                
                $select.append('<option disabled selected>' + "Seleccione una opción" + '</option>');
                
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
    presentacion = document.getElementById('presentacioncomercial').value;
    total = (unidades * densidad * presentacion)/1000;

    document.getElementById('tamanototallote').value = total //formatter.format(total);
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
    if(ps < maxField){
        $("#addTanquePesaje tbody tr:eq(0)").clone().removeClass().appendTo('#addTanquePesaje');
        ps++;
    }    
});

$(document).on("click",".eliminarPesaje", function(){
    var parent = $(this).parents().get(0);
    if(ps != 1){
        $(parent).remove();
        ps--;
    }
});

$("#adicionarPreparacion").on('click', function(){
    if(pr < maxField){
        $("#addTanquePreparacion tbody tr:eq(0)").clone().removeClass().appendTo('#addTanquePreparacion');
        pr++;
    }    
});

$(document).on("click",".eliminarPreparacion", function(){
    var parent = $(this).parents().get(0);
    if(pr != 1){
        $(parent).remove();
        pr--;
    }
});

/* cerrar modal al crear Batch */

function cerrarModal(){
    $('#modalCrearBatch').modal('hide');
}
