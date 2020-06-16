
var x;
minDateFilter = "";
maxDateFilter = "";
typeFilter = "";

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

$("#exampleCheck1").click(function () {
    $(this).prop("checked", true);
    $(this).prop("value", "1");
    $('#exampleCheck2').prop("checked", false);
 });

$("#exampleCheck2").click(function () {
    $(this).prop("checked", true);
    $(this).prop("value", "2");
    $('#exampleCheck1').prop("checked", false);
});

/* Obtener fechas de inicio y final */

$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(inicio, fin, label) {
    //console.log("inicio.format('YYYY-MM-DD') + fin.format('YYYY-MM-DD'));
    minDateFilter = inicio.format('YYYY-MM-DD');
    maxDateFilter = fin.format('YYYY-MM-DD');
    //console.log(minDateFilter);
    //console.log(maxDateFilter)
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