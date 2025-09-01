/* Variables globales */

let pres;
modulo = 5;
let flagEntregas = 0;
let equipos = [];

loadBatch = async () => {
  let resp = await cargarInfoBatch();
  if (resp != null) {
    cargarTanques();
  }
};

loadBatch();
