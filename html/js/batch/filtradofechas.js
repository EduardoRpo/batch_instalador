
var x;
minDateFilter = "";
maxDateFilter = "";
typeFilter = "";

var checkCreacion;
var checkprograma;

/* Inicia con los elementos ocultos */

$(document).ready(function(){
    $("#filtrafechas").hide();
    var x = 0;
}) 

/* muestra elementos filtrado */

function filtrarfechas(){
    if(x==0){
        $("#filtrafechas").hide();
        x=1;
    }else{
        $("#filtrafechas").show();
        x=0;
    }   
}

/* Activar un solo checkbox */

$("#checkFechaCreacion").click(function () {
    $(this).prop("checked", true);
    $(this).prop("value", "1");
    $('#checkFechaProgramacion').prop("checked", false);
 });

$("#checkFechaProgramacion").click(function () {
    $(this).prop("checked", true);
    $(this).prop("value", "2");
    $('#checkFechaCreacion').prop("checked", false);
});


/* Filtrar de acuerdo con las fechas ingresadas */

$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(inicio, fin, label) {
    
    minDateFilter = inicio.format('YYYY-MM-DD');
    maxDateFilter = fin.format('YYYY-MM-DD');
    
    var checkCreacion = $('#checkFechaCreacion').prop('checked')
    var checkprograma = $('#checkFechaProgramacion').prop('checked')

    if( checkCreacion == false && checkprograma == false ) {
      alertify.set("notifier","position", "top-right"); alertify.error("Debe seleccionar algun checkbox para hacer el filtrado");
      return false;
    }else{
      if(checkCreacion == true){
        columna_busqueda = "fecha_creacion";}
      else{
        columna_busqueda = "fecha_programacion";}
      
      $('#tablaBatch').empty();
      $("#tablaBatch").dataTable().fnDestroy();
      
      crearTablaBatch(columna_busqueda, minDateFilter, maxDateFilter);
    }

    /* Eliminar filtro */

$("#btnfiltrar").click(function (e) {
  e.preventDefault();
  //$("#tablaBatch").datatable().clear().draw();
  $("#tablaBatch").dataTable().fnDestroy();
  
  crearTablaBatch("fecha_creacion", "2020-01-01", "2090-12-31");
  $('#checkFechaCreacion').prop("checked", false);
  $('#checkFechaProgramacion').prop("checked", false);

});
    

    


/*     $.ajax({
      type: "POST",
      'url' : 'php/filtrarBatch.php',
      'data': { 
        busqueda : columna_busqueda,
        inicio: minDateFilter,
        final: maxDateFilter
      },
      
      success: function(data){
          //var info = JSON.parse(data);
          console.log(data);
          //console.log(info);
          
          $("#tablaBatch").dataTable().fnDestroy();
          //$('#tablaBatch').empty();
          
          tabla_batch = $('#tablaBatch').DataTable( {
            "ajax": data
          });
          
      }   
  }); */
  
  
  
  });
});


/* $('#formFechas').submit(function (event) {
    event.preventDefault();
    typeFilter = $('input:radio[name=typeFilter]:checked').val();
    tabla.draw();
    //$('#filtrado').modal('hide');
 }); */


/* Filtrado de fechas */

/* minDateFilter = "";
maxDateFilter = ""; */

/* $.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[10]).getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
); */


/* 
$(function() { */
    /* var oTable = $('#tablaBatch').DataTable({
      "oLanguage": {
        "sSearch": "Filter Data"
      },
      "iDisplayLength": -1,
      "sPaginationType": "full_numbers",
  
    }); */
   
  
  
  
    /* $("#datepicker_from").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: false,
      "onSelect": function(date) {
        minDateFilter = new Date(date).getTime();
        //tabla.draw();
      }
    }).keyup(function() {
      minDateFilter = new Date(this.value).getTime();
      //tabla.draw();
    });
  
    $("#datepicker_to").datepicker({
      showOn: "button",
      buttonImage: "images/calendar.gif",
      buttonImageOnly: false,
      "onSelect": function(date) {
        maxDateFilter = new Date(date).getTime();
        //tabla.draw();
      }
    }).keyup(function() {
      maxDateFilter = new Date(this.value).getTime();
      //tabla.draw();
    });
  
  }); */
  
  // Date range filter
 /*  minDateFilter = "";
  maxDateFilter = "";
  
  $.fn.dataTableExt.afnFiltering.push(
    function(oSettings, aData, iDataIndex) {
      if (typeof aData._date == 'undefined') {
        aData._date = new Date(aData[9]).getTime();
      }
  
      if (minDateFilter && !isNaN(minDateFilter)) {
        if (aData._date < minDateFilter) {
          return false;
        }
      }
  
      if (maxDateFilter && !isNaN(maxDateFilter)) {
        if (aData._date > maxDateFilter) {
          return false;
        }
      }
  
      return true;
    }
  ); */

  $(document).ready(function() {
    var table = $('#tablaBatch').DataTable();

    // Add event listeners to the two range filtering inputs
    $('#min').keyup( function() { table.draw(); } );
    $('#max').keyup( function() { table.draw(); } );
  });