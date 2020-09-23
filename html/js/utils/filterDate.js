minDateFilter = "";
maxDateFilter = "";
typeFilter = "";

$('#fechaInicial').change(function () {
    $('#fechaFinal').attr('min', $('#fechaInicial').val());
});

$.fn.dataTableExt.afnFiltering.push(
    function (oSettings, aData, iDataIndex) {
        let _date = NaN;
        if (typeFilter && !isNaN(typeFilter)) {
            // si es por fecha de creacion
            if (typeFilter == 1) {
                _date = new Date(aData[8]).getTime();
            } else {
                // fecha de programacion
                _date = new Date(aData[9]).getTime();
            }
        } else {
            _date = new Date(aData[9]).getTime();
        }


        if (minDateFilter && !isNaN(minDateFilter)) {
            if (_date < minDateFilter) {
                return false;
            }
        }

        if (maxDateFilter && !isNaN(maxDateFilter)) {
            if (_date > maxDateFilter) {
                return false;
            }
        }

        return true;
    }
);

$('#formFechas').submit(function (event) {
    event.preventDefault();
    typeFilter = $('input:radio[name=typeFilter]:checked').val();
    minDateFilter = new Date($('#fechaInicial').val()).getTime();
    maxDateFilter = new Date($('#fechaFinal').val()).getTime();
    table.draw();
    $('#filtrado').modal('hide');
});