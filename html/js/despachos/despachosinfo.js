modulo = 7;
let flag = 0;

loadBatch = async () => {
  let resp = await cargarInfoBatch();
  if (resp == null) {
    await busqueda_multi();
  }
};

loadBatch();

//$("#in_fecha_programacion").prop("min", new Date().toDateInputValue());
