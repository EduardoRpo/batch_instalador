
function cargar(btn, idbtn) {

    localStorage.setItem("idbtn", idbtn);
    id = btn.id;

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso*/

    let seleccion = $('#sel_producto_desinfeccion').val();
    if (modulo == 3 && seleccion != "Seleccione")
        seleccion = $('#select-Linea').val();

    if (seleccion == "Seleccione") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
        return false;
    }


    //Validacion de control de tanques
    /*  if (id == "aprobacion_realizado") {
         validar = controlTanques();
         if (validar == 0) {
             return false;
         }
     } */

    /* Validacion que el formulario se encuentre completamente lleno */

    /* if (id == 'aprobacion_realizado') {
        validar = validardatosresultadosPreparacion();
        if (validar == 0)
            return false;
    }*/

    //validar que todos los campso se encuentres completos en el formularios

    validarParametrosControl();

    /* Carga el modal para la autenticacion */

    $('#usuario').val('');
    $('#clave').val('');
    $('#m_firmar').modal('show');
}


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


