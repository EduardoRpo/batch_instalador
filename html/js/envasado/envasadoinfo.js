/* Variables globales */

let pres;
modulo = 5;
let flagEntregas = 0;
let equipos = [];

loadBatch = async () => {
  let resp = await cargarInfoBatch();

  if (resp == null) {
    result = await carguepreguntas(modulo);
    result = await cargarDesinfectantes();
    await busqueda_multi();
    await deshabilitarbotones();
    cargarBatchMulti();
    await validarMultiCompleta();
  }
};

loadBatch();
