$("#select-Linea").change(function () {
    cargarEquipos();
})

let unidad = $('txtUnidadesProducidas').val();
/* validar unidades producidads vs la envasada - 
Enviar notificacion -- 
Texto (Existe una diferencia entre las unidades envasadas y las 
    acondicionadas de la orden de produccion XXX referencia XXXX)
 */

function conciliacionRendimiento(retencion) {
    let unidadEmpaque = 10; //se debe cargar desde envasado
    let UnidadesProducidas = $('#txtUnidadesProducidas').val()
    let totalCajas = Math.floor((UnidadesProducidas - retencion) / unidadEmpaque);
    let entregarBodega = (UnidadesProducidas - retencion);
    
    $('#txtTotal-Cajas').val(formatoCO(totalCajas));
    $('#txtEntrega-Bodega').val(formatoCO(entregarBodega));

    //txtReponsable, cargar el cargo de la tablar cargos el 1

}


