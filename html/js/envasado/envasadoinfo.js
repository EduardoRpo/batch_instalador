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
}

loadBatch()

almacenarControlProceso = async(user) => {
    modulo == 6 ? (operacion = 3) : (operacion = 1);
    let muestras = JSON.parse(sessionStorage.getItem(presentacion + ref_multi + modulo));
    result = await muestrasRecolectadas(muestras)
    if (result == true)
        result = await almacenarEquipos()
    if (result == true)
        firmaControlProcesoEnvasado(user)
}