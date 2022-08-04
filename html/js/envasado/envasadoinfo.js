/* Variables globales */

let pres;
modulo = 5;
let flagEntregas = 0
let equipos = [];

loadBatch = async() => {
    await cargarInfoBatch();
    result = await carguepreguntas(modulo);
    result = await cargarDesinfectantes();
    await busqueda_multi();
    await deshabilitarbotones();
    cargarBatchMulti()
        //validarMultiCompleta()
}

loadBatch()