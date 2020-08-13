/* Cargue de Parametros de Control en DataTable */

$(document).ready(function() {
    $("#modulosBR").DataTable({
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        language: {url: 'admin_componentes/es-ar.json'},

        "ajax":{
            method : "POST",
            url : "php/modulos.php",
            data : {operacion : "1"},
        },

        "columns":[
            {"data": "id"},
            {"data": "modulo"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>"}
            
        ]
    });
});

$(document).ready(function() {
    $("#lineasBR").DataTable({
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        language: {url: 'admin_componentes/es-ar.json'},

        "ajax":{
            method : "POST",
            url : "php/modulos.php",
            data : {operacion : "4"},
        },

        "columns":[
            {"data": "id"},
            {"data": "nombre_linea"},
            {"data": "densidad"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-editar' style='color:rgb(255, 165, 0)'>edit</i></a>"},
            {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>"}
            
        ]
    });
});