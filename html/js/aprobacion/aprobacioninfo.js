modulo = 4;

loadBatch = async () => {
  let resp = await cargarInfoBatch();
  if (resp == null) {
    cargarTanques();
  }
};

loadBatch();
