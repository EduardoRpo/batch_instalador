
/* Inicializar tabla Batch  */

var editar;
var datos;
var tabla;
var data;

$(document).ready(function() {   
    tabla = $("#tablaBatch").DataTable({
        
        responsive: true,
        scrollCollapse: true,
        language: {url: '/admin/sistema/admin_componentes/es-ar.json'},

        ajax:{
            method : "POST",
            url : "php/listarBatch.php",
            data : {"operacion" : "1", "proceso" : "1"},
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
            
            {"defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 193, 7)'>&#xE254;</i></a>"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(234, 67, 54)'>delete_forever</i></a>"}
        ],

    });
});



/*  */
/* 
$(document).ready(function() {
    var table = $('#tablaBatch').dataTable();

    // Sort in the order that was origially in the HTML
    var nTd = table.fnGetTd( $('#tablaBatch tbody tr:eq(1)')[0], 1 );
    console.log( nTd );
} ); */

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e){
    e.preventDefault();
    editar = true;

    
    //let id = $(this).parent().parent().children().first().text();
    var texto = $(this).parent().parent().children()[1];
    var id = $(texto).text();
    
    $.ajax({
        method: 'POST',
        url : 'php/listarBatch.php',
        data: {operacion : "6", id : id},  
        
        
         success: function(response){
            var info = JSON.parse(response);            
            $('#idbatch').val(info.id_batch);
            $('#referencia').val(info.referencia);
            $('#nombrereferencia').val(info.nombre_referencia);
            $('#marca').val(info.marca);
            $('#propietario').val(info.propietario);
            $('#producto').val(info.nombre_referencia);
            $('#presentacioncomercial').val(info.presentacion);
            $('#linea').val(info.linea);
            $('#notificacionSanitaria').val(info.notificacion_sanitaria);
            $('#densidad').val(info.densidad);
            $('#unidadesxlote').val(info.unidad_lote);
            $('#tamanototallote').val(info.tamano_lote);
            $('#fechaprogramacion').val(info.fecha_programacion);

            $("#cmbNoReferencia"). css("display", "none");
            $("#referencia"). css("display", "block");
            $('#guardarBatch').html('Actualizar');
            $('.tcrearBatch').html('Actualizar Batch Record');
            $('#modalCrearBatch').modal('show');
            actualizarTabla();
        },
        error: function(response){
            console.log(response);
        } 
    });
});

/* Borrar registro */

$(document).on('click', '.link-borrar', function(e){
    e.preventDefault();
    
    //let id = $(this).parent().parent().children().first().text();
    var texto = $(this).parent().parent().children()[1];
    var id = $(texto).text();
    
    var confirm = alertify.confirm('Samara Cosmetics','¿Está seguro de eliminar este registro?',null,null).set('labels', {ok:'Si', cancel:'No'});
 
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


/* Actualizar tabla */

function actualizarTabla() {
    $('#tablaBatch').DataTable().clear();
    $('#tablaBatch').DataTable().ajax.reload();
}

  /* Guardar datos de Crear y Actualizar batch*/

function guardarDatos(){         
        //e.preventDefault();
        var d = new Date();

        var mes = d.getMonth() + 1;
        var dia = d.getDate();
        var fechaActual = d.getFullYear() + '/' + (mes<10 ? '0' : '') + mes + '/' + (dia<10 ? '0' : '') + dia;

        if(!editar){
            datos = {
                operacion: "5",
                ref: $('#idbatch').val(),
                unidades: $('#unidadesxlote').val(),
                lote: $('#tamanototallote').val(),
                presentacion: $('#presentacioncomercial').val(),
                programacion: $('#fechaprogramacion').val(),
                fecha : fechaActual,
                cantidad: "1",
                
                };
                //console.log(datos.cantidad);
        }else{
             datos = {
                operacion: "7",
                ref: $('#idbatch').val(),
                unidades: $('#unidadesxlote').val(),
                lote: $('#tamanototallote').val(),
                programacion: $('#fechaprogramacion').val(),
                fecha : fechaActual,
                
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


/* Formateo de numeros */

const formatter = new Intl.NumberFormat('de-DE', {
    //style: 'currency',
    //currencySign: 'accounting'
    /* minimumFractionDigits: 2 */
  })