
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
            {"data": "multi", className: "uniqueClassName",
            render: (data, type, row) => {
                'use strict';
                return data == 1 ? '<i class="fa fa-superscript aria-hidden="true" data-toggle="tooltip" title="Multipresentación" style="color:rgb(59, 131, 189)" aria-hidden="true"></i>' : '';
            }
            },
            {"defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 193, 7)'>&#xE254;</i></a>"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(234, 67, 54)'>delete_forever</i></a>"}
            
        ],

    });
});

/* Cambiar puntero del mouse al tocar los botones de actualizar y eliminar */

$('.link-editar').css('cursor','pointer');

/* Cargar datos para Actualizar registros */

$(document).on('click', '.link-editar', function(e){
    e.preventDefault();
    editar = true;
    limpiarTanques();

    var texto = $(this).parent().parent().children()[1];
    var id = $(texto).text();
    
    $.ajax({
        method: 'POST',
        url : 'php/listarBatch.php',
        data: {operacion : "6", id : id},  
        
        
         success: function(response){
            
            var info = JSON.parse(response);
            
            $('#idbatch').val(info[0].id_batch);
            $('#referencia').val(info[0].referencia);
            $('#nombrereferencia').val(info[0].nombre_referencia);
            $('#marca').val(info[0].marca);
            $('#propietario').val(info[0].propietario);
            $('#producto').val(info[0].nombre_referencia);
            $('#presentacioncomercial').val(info[0].presentacion);
            $('#linea').val(info[0].linea);
            $('#notificacionSanitaria').val(info[0].notificacion_sanitaria);
            $('#densidad').val(info[0].densidad);
            $('#unidadesxlote').val(info[0].unidad_lote);
            $('#tamanototallote').val(info[0].tamano_lote);
            $('#fechaprogramacion').val(info[0].fecha_programacion);
            unidades = info[0].unidad_lote;
            lote = info[0].tamano_lote;
                        
            for(k=1; k<info.length; k++){
                
                cont = k-1;
                               
                $('#adicionarPesaje').click();
                
                cmbTanque = $('#cmbTanque'+ k);

                cmbTanque.val('30');
                console.log(cmbTanque);

                tnque = info[k].tanque;
                cant = info[k].cantidad;
                
                $('#cmbTanque'+ k).val(tnque);
                console.log($('#cmbTanque'+ k).val());
                
                /* $('#cmbTanque'+k+' option')
                .filter(function() { console.log($(this).text()); return $.trim( $(this).text() ) == tnque; })
                .attr('selected',true); */

                $('#txtCantidad'+ k).val(cant);
                
                CalcularTanque();
            }

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

/* Asignar variables para actualizar */



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

    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes<10 ? '0' : '') + mes + '/' + (dia<10 ? '0' : '') + dia;
    var tqn = [];
    var tmn = [];

    var j=1;

    for(i=0; i<cont ; i++){
        tqn[i] = $('#cmbTanque' + j + ' option:selected').val();
        j++;
    }
    
    j=1;
    
    for(i=0; i<cont ; i++){
        tmn[i] = $('#txtCantidad'+ j).val();
        j++;
    }

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
            tqns: tqn, 
            tmn: tmn,
            
            };

    }else{
            datos = {
            operacion: "7",
            ref: $('#idbatch').val(),
            unidades: $('#unidadesxlote').val(),
            lote: $('#tamanototallote').val(),
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


/* Formateo de numeros */

const formatter = new Intl.NumberFormat('de-DE', {
    //style: 'currency',
    //currencySign: 'accounting'
    /* minimumFractionDigits: 2 */
  })