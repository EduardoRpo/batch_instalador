$(document).ready(function() {
    //Conversion medidas de peso

    cambioConversion = () => {
        flagWeight = !flagWeight
        tablePesaje.api().ajax.reload()
        $(tablePesaje.api().column(3).header()).html(
            `Peso (<a href="javascript:cambioConversion();" class="conversion_weight">${flagWeight ? 'Kg' : 'g'
            }</a>)`,
        )
    }
});