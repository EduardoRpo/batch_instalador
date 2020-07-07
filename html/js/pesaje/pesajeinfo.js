let flagWeight = false;

/* cargue de preguntas */

$.ajax({
    url: `../../api/questions/1`,
    type: 'GET'
}).done((data, status, xhr) => {
    $('#preguntas-div').html('');
    data.forEach((question, indx) => {
        $('#preguntas-div').append(`<div class="col-md-10 col-2 align-self-right">
                    <a for="recipient-name" class="col-form-label">${question.pregunta}</a>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" class="questions" name="question-${question.id}" value="si"/>
                    </label>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" name="question-${question.id}" value="no"/>
                    </label>
                  </div>`);
    });

});

/* Carga de Cargos  */

$.ajax({
    url: `../../api/cargos`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach((cargo, indx) => {
        $(`#cargo-${indx + 1}`).val(cargo.cargo);
    });

});

/* Formula Materia Prima  */


let tablePesaje = $('#tablePesaje').dataTable({
    ajax: {
        url: `../../api/materiasp/${referencia}`,
        dataSrc: ''
    },
    paging: false,
    info: false,
    searching: false,
    sorting: false,
    
    /*dom: 'Bfrtilp',
    
    buttons: [
        'print'
        {
            extend: 'pdfHtml5',
            text: '<i class="fas fa-file-pdf"></i>',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'

        },
        {
            extend: 'print',
            text: '<i class="fas fa-print"></i>',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'

        }, 
        ],*/
    columns: [
        {
            title: 'Referencia',
            data: 'referencia', className: 'uniqueClassName'
        },
        {
            title: 'Materia Prima',
            data: 'alias', className: 'uniqueClassName'
        },
        {
            title: 'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
            className: 'conversion_weight_column',
            data: 'porcentaje', className: 'uniqueClassName',
            
            render: (data, type, row) => {
                
                if (flagWeight) {
                    return (data * batch.tamano_lote) ;
                } else {
                    return (data * batch.tamano_lote)/ 1000;
                }
                
            },
            
            /* render: $.fn.dataTable.render.number( ',', '.', 3), */
            
        },
        {
            title: 'No TQ',
            data: 'porcentaje', className: 'uniqueClassName',
            render: (data, type, row) => {
                
                if (flagWeight) {
                    return data * batch.tamano_lote * 10;
                    //$.fn.dataTable.render.number( '.', ',', 2, '' )}
                } else {
                    return ((data * batch.tamano_lote) / 1000) / 10;
                }
            
            },
            /* render: $.fn.dataTable.render.number( '.', ',', 2, '' ) */
            
        },
        {
            title: 'Impresión',
            defaultContent: '<a href="#" data-toggle="modal" data-target="#imprimirEtiquetas"><i class="large material-icons">print</i></a>', className: 'uniqueClassName'
        }
        
    ]
});

/* Creacion de botones para exportar */




Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha_pesaje').val(new Date().toDateInputValue());
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue());

//Conversion medidas de peso

function cambioConversion() {
    flagWeight = !flagWeight;
    tablePesaje.api().ajax.reload();
    $(tablePesaje.api().column(2).header()).html(`Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${flagWeight ? 'Kg' : 'g'}</a>)`);
}