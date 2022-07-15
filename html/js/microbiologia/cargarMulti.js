$(document).ready(function() {
    multi = () => {
        $.get(`/api/multi/${idBatch}`,
            function(data, textStatus, jqXHR) {
                if (data == 0)
                    return false
                else {
                    for (let i = 0; i < data.length; i++) {
                        $(`.m${i + 1}`).show();
                        $(`#ref${i + 1}`).html(`Ref: ${data[i]['referencia']} / Presentación: ${data[i]['presentacion']}`);
                    }
                }
                cantMulti = data
            },
        );
    }

});