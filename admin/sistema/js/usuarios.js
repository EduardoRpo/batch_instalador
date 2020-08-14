/* Mostrar Menu seleccionado */

$('.contenedor-menu .menu a').removeAttr('style');
$('#link16').css('text-decoration', 'revert')
$('.contenedor-menu .menu ul.abrir2').show();

//Cargue de datos Tabla Usuarios

$(document).ready(function() {
    $("#listaUsuarios").DataTable({
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        language: {url: 'admin_componentes/es-ar.json'},

    "ajax":{
      "method":"POST",
        "url":"php/listarUsuarios.php",
    },

    "columns":[
        {"data": "id"},
        {"data": "nombre"},
        {"data": "apellido"},
        {"data": "email"},
        {"data": "cargo"},
        {"data": "modulo"},
        /* {"defaultContent": "<a href='crearUsuarios.php' <i class='large material-icons' data-toggle='tooltip' title='Adicionar' style='color:rgb(0, 154, 68)'>how_to_reg</i></a>"}, */
        {"defaultContent": "<a href='#' <i class='large material-icons link-editar' data-toggle='tooltip' title='Editar' style='color:rgb(255, 165, 0)'>edit</i></a>"},
        {"defaultContent": "<a href='#' <i class='large material-icons link-borrar' data-toggle='tooltip' title='Eliminar' style='color:rgb(255, 0, 0)'>clear</i></a>"}  
      ]
    });
  });


//Almacenar los usuarios

$(document).ready(function(){
    $('#btnguardarUsuarios').click(function(){
        var datos = $('#frmagregarUsuarios').serialize();
        $.ajax({
            type: "GET",
            url: "guardarUsuarios.php",
            data: datos,
            success: function(r){
                if(r==1){
                    alertify.set("notifier","position", "top-right"); alertify.success("Agregado con éxito.");
                    document.getElementById("frmagregarUsuarios").reset();
                }else{
                    alertify.set("notifier","position", "top-right"); alertify.error("Usuario No Registrado.");
                }
            }
        });
        return false;
    });
});


/* evento click para actualizar registros */

$(document).on('click', '.link-editar', function(e){
    e.preventDefault();
    
     let id = $(this).parent().parent().children().first().text();
     
     
});


/* evento click para borrar registros */

$(document).on('click', '.link-borrar', function(e){
    e.preventDefault();
    
    let id = $(this).parent().parent().children().first().text();
 
    var confirm= alertify.confirm('Samara Cosmetics','¿Está seguro de eliminar este usuario?',null,null).set('labels', {ok:'Si', cancel:'No'}); 	
 
    confirm.set('onok', function(r){ 
        if(r){
            $.ajax({
                'method' : 'GET',
                'url' : `php/eliminarUsuarios.php?link-borrar=${id}`,
                'data' : 'id',
            });
            refreshTable();
            alertify.success('Registro Eliminado');
        }
    });       
});

/* Actualizar tabla */

function refreshTable() {
    $('#listaUsuarios').DataTable().clear();
    $('#listaUsuarios').DataTable().ajax.reload();
}