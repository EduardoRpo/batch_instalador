
/* Inicializar tabla Batch  */

var editar;
var datos;
var tabla;
var data;
var cont = 0;
var tanques;

$(document).ready(function() {
    crearTablaBatch();
    cargarTanques();
});


function crearTablaBatch(columna_busqueda='', minDateFilter='', maxDateFilter=''){ 
    tabla = $("#tablaBatch").DataTable({
        
        responsive: true,
        scrollCollapse: true,
        language: {url: '/admin/sistema/admin_componentes/es-ar.json'},

        ajax:{
            method : "POST",
            url : "php/listarBatch.php",
            data : {"operacion" : "1", 
                    "proceso" : "1",
                    "busqueda" : columna_busqueda,
                    "inicio" : minDateFilter,
                    "final" : maxDateFilter
                },
        },

        columns:[
            {"defaultContent": "<input type='radio' id='express' name='optradio'>"},
            {"data": "id_batch"},
            {"data": "numero_orden", className: "uniqueClassName"},
            {"data": "referencia", className: "uniqueClassName"},
            {"data": "nombre_referencia"},
            /* {"data": "presentacion"}, */
            {"data": "numero_lote"},
            {"data": "tamano_lote", className: "uniqueClassName" , render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
            {"data": "nombre"},
            {"data": "fecha_creacion", className: "uniqueClassName"},
            {"data": "fecha_programacion", className: "uniqueClassName"},
            {"data": "estado", 
            className: "uniqueClassName",
            render: (data, type, row) => {
                'use strict';
                return data == 1 ? 'Activo' : 'Inactivo';
            }
            },
            {"data": "multi", className: "uniqueClassName",
            render: (data, type, row) => {
                'use strict';
                return data == 1 ? '<i class="fa fa-superscript link-editarMulti" aria-hidden="true" data-toggle="tooltip" title="Editar Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>' : '';
            }
            },
            {"defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar Batch Record' style='color:rgb(255, 193, 7)'>&#xE254;</i></a>"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar Batch Record' style='color:rgb(234, 67, 54)'>delete_forever</i></a>"}
            
        ],

    });
}

/* Cambiar puntero del mouse al tocar los botones de actualizar y eliminar */

$('.link-editar').css('cursor','pointer');

/* Borrar registro */

$(document).on('click', '.link-borrar', function(e){
    e.preventDefault();
    
    //let id = $(this).parent().parent().children().first().text();
    const texto = $(this).parent().parent().children()[1];
    const id = $(texto).text();
    
    const confirm = alertify.confirm('Samara Cosmetics','¿Está seguro de eliminar este registro?',null,null).set('labels', {ok:'Si', cancel:'No'});
 
    confirm.set('onok', function(r){ 
        if(r){
            $.ajax({
                'method' : 'POST',
                'url' : 'php/listarBatch.php',
                'data':{operacion : "2", id : id},
            
                success: function(r){
                    alertify.set("notifier","position", "top-right"); alertify.success("Batch Record Eliminado.");
                    actualizarTabla();
                    
                },
                error: function(r){
                    alertify.set("notifier","position", "top-right"); alertify.error("Error al Eliminar el Batch Record.");
                } 
            });            
        }
    });       
});


/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e){
    e.preventDefault();
    editar = true;
    limpiarTanques();
    OcultarTanques();
    
    const texto = $(this).parent().parent().children()[1];
    const id = $(texto).text();
    
    $.ajax({
        method: 'POST',
        url : 'php/listarBatch.php',
        data: {operacion : "6", id : id},  
                
         success: function(response){
            
            const info = JSON.parse(response);
            const presentacion = formatoCO(info[0].presentacion);
            const tamano_lote = formatoCO(info[0].tamano_lote);
            batch = info;
            
            $('#idbatch').val(info[0].id_batch);
            $('#referencia').val(info[0].referencia);
            $('#nombrereferencia').val(info[0].nombre_referencia);
            $('#marca').val(info[0].marca);
            $('#propietario').val(info[0].propietario);
            $('#producto').val(info[0].nombre_referencia);
            $('#presentacioncomercial').val(presentacion);
            $('#linea').val(info[0].linea);
            $('#notificacionSanitaria').val(info[0].notificacion_sanitaria);
            $('#densidad').val(info[0].densidad);
            $('#unidadesxlote').val(info[0].unidad_lote);
            $('#tamanototallote').val(tamano_lote);
            $('#fechaprogramacion').val(info[0].fecha_programacion);
       
            mostrarTanques(info);
            
             },
        error: function(response){
            console.log(response);
       
        }
    });
    
});

function mostrarTanques(info){
    let sum=0;
    for(k=1; k<info.length; k++){
        const cantidad = info[k].cantidad;
        const tanque= info[k].tanque;
        const total = cantidad * tanque;

        $('#cmbTanque' + k).show().val(tanque);
        $('#txtCantidad' + k).show().val(cantidad);
        $('#txtTotal' + k).show().val(total);
        $('#btnEliminar' + k).show();
          
        sum = sum + total;
        $('.sumatanques').val(sum);
        $('.labelTanques').show();
        $('.labelTotalTanques').show();
        $('.sumaTanques').show();
    }

    contarTanques();

    for(k=1; k<(info.length-1); k++){
        $('#cmbTanque' + k).attr('disabled', 'disabled');
        $('#txtCantidad' + k).attr('disabled', 'disabled');
        $('#txtTotal' + k).attr('disabled', 'disabled');
        $('#btnEliminar' + k).attr('disabled', 'disabled');
    }

    $("#cmbNoReferencia"). css("display", "none");
    $("#referencia"). css("display", "block");
    $('#guardarBatch').html('Actualizar');
    $('.tcrearBatch').html('Actualizar Batch Record');
    $('#modalCrearBatch').modal('show');
}





/* Actualizar tabla */

function actualizarTabla() {
    $('#tablaBatch').DataTable().clear();
    $('#tablaBatch').DataTable().ajax.reload();
}

  /* Guardar datos de Crear y Actualizar batch*/

function guardarDatos(){    

    const lote = $('#tamanototallote').val();
    const tamano_lote  = formatoGeneral(lote);

    const presentacion = $('#presentacioncomercial').val();
    const presentacion_comercial = formatoGeneral(presentacion);
    
    const sumaTanques = $('.sumaTanques').val();
    let tqn = [];
    let tmn = [];
    
    contarTanques();

    if(cont !== 0 && sumaTanques == '' || lote == ''){
        alertify.set("notifier","position", "top-right"); alertify.error("Ingrese todos los datos.");
        return false;
    }

    var d = new Date();
    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes<10 ? '0' : '') + mes + '/' + (dia<10 ? '0' : '') + dia;

    var j=0;

    for(i=1; i<=Notanques ; i++){
        let tanque = $('#cmbTanque'+i).val();
        tqn[j] = tanque;  
        j++;
    }
    
    j=0;
    
    for(i=1; i<=Notanques ; i++){
        let cantidad = $('#txtCantidad' + i).val();    
        tmn[j] = cantidad;
        j++;
    }
    
    j=1;
    
   if(!editar){
        datos = {
            operacion: "5",
            ref: $('#idbatch').val(),
            unidades: $('#unidadesxlote').val(),
            lote: tamano_lote,
            presentacion: presentacion_comercial,
            programacion: $('#fechaprogramacion').val(),
            fecha : fechaActual,
            cantidad: "1",
            tqns: tqn, 
            tmn: tmn,
            
            };

    }else{
            datos = {
            operacion: "7",
            ref: $('#idbatch').val(),
            unidades: $('#unidadesxlote').val(),
            lote: tamano_lote,
            programacion: $('#fechaprogramacion').val(),
            fecha : fechaActual,
            tqns: tqn, 
            tmn: tmn,
            };
    }
    
    $.ajax({
        type: "POST",
        url: "php/listarBatch.php",
        data: datos,
        
        success: function(r){
            alertify.set("notifier","position", "top-right"); alertify.success("Batch Record registrado con éxito.");
            cerrarModal();
            actualizarTabla();
            
        },
        error: function(r){
            alertify.set("notifier","position", "top-right"); alertify.error("Error al registrar el Batch Record.");
        } 
    }); 
}

/* Contar Tanques */

function  contarTanques(){
    addtnq = 0;
    cont = 0;
    Notanques = 0;

    for(i=1; i<6; i++){
        const txtTotal = $('#txtTotal'+i).val();
        parseInt(txtTotal, 10);
        
        if( txtTotal !='' && txtTotal != "0" && txtTotal > 0 ){
            addtnq++;
            cont++;
            }
        if($('#txtTotal'+i).is(":visible")){
            Notanques++;
        }
         
         }
         addtnq++;
}

